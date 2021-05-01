<?php

namespace App\Http\Controllers;

use App\Events\AmountOfShiftsUpdated;
use App\Events\CallShiftAgain;
use App\Events\ShiftAssignedToUser;
use App\Models\Category;
use App\Models\Shift;
use ArrayObject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShiftController extends Controller
{

    public function index()
    {   
        $shifts = Shift::CurrentListOfShifts();

        return view('shifts.index', compact('shifts'));
    }

    public function create(){
        $categories = Category::all();
        
        return view('shifts.create', compact('categories'));
    }

    public function store(Request $request){
        $today = (string) Carbon::today();
        $var = explode(' ', $today);

        $request->validate([
            'category' => 'required'
        ]);
        
        $number = DB::table('shifts') //crea un auto incremente para cada categoria
            ->select('*')
            ->where('category_id', '=', $request->category)
            ->whereRaw("date(shifts.created_at) = '$var[0]'")
            ->get()->count() + 1;
        
        $category = DB::table('categories') //obtiene el nombre de la categoria
        ->select('name')
        ->where('id', '=', $request->category)
        ->take(1)
        ->get();

        $firstDigit = $category[0]->name[0]; //primer digito del digito de la categoria
        $lastDigit = $category[0]->name[strlen($category[0]->name) - 1]; //ultimo digito del nombre de la categoria
        $character = "";

        if($request->category > 26){ //codigo para generar el caracter intermedio, en caso de que se repita duplica e
            $contador = 0;
            $alternative = $request->category;

            while($alternative > 26){                
                $contador += 1;
                $alternative -= 26;
            }

            for ($i=0; $i <= $contador; $i++) { 
                $character = $character . chr($alternative + 96);
            }
        }
        else{
            $character = chr($request->category + 96); //crea una letra minuzcula con el codigo ascii
        }     
       
        $ticket_code = strtoupper($firstDigit . $character . $lastDigit . '-' . $number);  
        $date_time = Carbon::now();
        $user_id = null;
        $category_id = $request->category;


        $shift = Shift::create([
            'ticket_code' => $ticket_code,
            'category_id' => $category_id,
            'date_time' => $date_time,
            'user_id' => $user_id
        ]);
        
        $ShiftList = Shift::QueueShiftList();

        broadcast(new AmountOfShiftsUpdated($ShiftList));

        return redirect()->route('shifts.create');
    }

    public function callNext()
    {
        $canceledListShift = Shift::CanceledShifts();

        $shift = DB::table('shifts') //selecciono el turno siguiente sin asignar
            ->join('categories', 'shifts.category_id', '=', 'categories.id')
            ->select('shifts.ticket_code', 'categories.priority', 'shifts.id', 'shifts.status', 'shifts.user_id')
            ->where('shifts.status', '=', '1')
            ->where('shifts.user_id', '=', null)
            ->orderBy('categories.priority', 'asc')
            ->orderBy('shifts.id', 'asc')
            ->take(1)
            ->get();

        if(empty($shift[0])){ //si no hay turnos por asignar

            $values = ['ticket_code' => 'VACIO', 'place' => 'VACIO', 'priority' => 'VACIO', 'status' => '2'];
            $values = (object) $values;

            $shift = array();
            array_push($shift, $values);
           
            $ShiftList = Shift::QueueShiftList();

            return view('shifts.show', compact('shift', 'ShiftList', 'canceledListShift'));
        }
        else{

            if ($shift[0]->user_id == null) { //Si el turno siguiente no se ha asignado a ninguna caja, asignalo al usuario logueado
                $shift_register = Shift::find($shift[0]->id);
    
                $shift_register->user_id = Auth::user()->id;
                $shift_register->save();
    
                $shift = DB::table('shifts') //refrescando la consulta con el userd_id actualizado en la vista del cajero
                    ->join('categories', 'shifts.category_id', '=', 'categories.id')
                    ->join('users', 'shifts.user_id', '=', 'users.id')
                    ->select('shifts.ticket_code', 'users.place', 'categories.priority', 'shifts.id', 'shifts.status', 'shifts.user_id')
                    ->where('shifts.id', '=', $shift[0]->id)
                    ->orderBy('categories.priority', 'asc')
                    ->orderBy('shifts.id', 'asc')
                    ->take(1)
                    ->get();
            }

            $ShiftList = Shift::QueueShiftList();

            $shifts = Shift::CurrentListOfShifts();     

            broadcast(new ShiftAssignedToUser($shifts));

            return view('shifts.show', compact('shift', 'ShiftList', 'canceledListShift'));
        }

    }

    public function callAgain(){

        //refrescando la consulta con el userd_id actualizado en la vista del cajero
        $shift = Shift::LatestShiftCalledByCashier();

        $ShiftList = Shift::QueueShiftList();
        
        $canceledListShift = Shift::CanceledShifts();

        if(empty($shift[0])){ //si no hay turnos por asignar

            $values = ['ticket_code' => 'VACIO', 'place' => 'VACIO', 'priority' => 'VACIO', 'status' => '2'];
            $values = (object) $values;

            $shift = array();
            array_push($shift, $values);

            return view('shifts.show', compact('shift', 'ShiftList', 'canceledListShift'));
        }
        else{

            /* $shifts = Shift::CurrentListOfShifts();

            broadcast(new ShiftAssignedToUser($shifts)); */
            broadcast(new CallShiftAgain($shift));

            return view('shifts.show', compact('shift', 'ShiftList', 'canceledListShift'));
        }
        
    }

    public function attented(){

        $shift = Shift::LatestShiftCalledByCashier();

        $ShiftList = Shift::QueueShiftList();

        $canceledListShift = Shift::CanceledShifts();

        if(empty($shift[0])){ //si no hay turnos por asignar

            $values = ['ticket_code' => 'VACIO', 'place' => 'VACIO', 'priority' => 'VACIO'];
            $values = (object) $values;

            $shift = array();
            array_push($shift, $values);
        
            return redirect()->route('shifts.show', compact('shift', 'ShiftList', 'canceledListShift'))->with('info', 'No hay turno seleccionado por atender');
        }
        else{
            $affected = DB::table('shifts')
                ->where('id', $shift[0]->id)
                ->update(['status' => '2']);

            
                $ShiftList = Shift::QueueShiftList();

                broadcast(new AmountOfShiftsUpdated($ShiftList));

            return redirect()->route('shifts.show', compact('ShiftList', 'canceledListShift'))->with('info', 'El turno '. $shift[0]->ticket_code. ' ha sido atendido con éxito');
        }
    }

    public function cancel(){
        $shift = Shift::LatestShiftCalledByCashier();

        $ShiftList = Shift::QueueShiftList();

        if(empty($shift[0])){ //si no hay turnos por asignar

            $values = ['ticket_code' => 'VACIO', 'place' => 'VACIO', 'priority' => 'VACIO'];
            $values = (object) $values;

            $shift = array();
            array_push($shift, $values);
            
            $canceledListShift = Shift::CanceledShifts();


            return redirect()->route('shifts.show', compact('shift', 'ShiftList', 'canceledListShift'))->with('info', 'No hay turno seleccionado por cancelar');
        }
        else{
            $affected = DB::table('shifts')
                ->where('id', $shift[0]->id)
                ->update(['status' => '0']);

            $canceledListShift = Shift::CanceledShifts();
           
            return redirect()->route('shifts.show', compact('shift', 'ShiftList', 'canceledListShift'))->with('info', 'El turno '. $shift[0]->ticket_code. ' ha sido cancelado con éxito');
        }
    }

    public function show(){

        $values = ['ticket_code' => '', 'place' => '', 'priority' => '', 'status' => '2'];
        $values = (object) $values;

        $shift = array();
        array_push($shift, $values);

        $ShiftList = Shift::QueueShiftList();
        $canceledListShift = Shift::CanceledShifts();

        return view('shifts.show', compact('shift', 'ShiftList', 'canceledListShift'));
    }

    public function update(Request $request){
        $request->validate([
            'canceled_shifts' => 'required',
        ]);

        $affected = DB::table('shifts')
                ->where('id', $request->canceled_shifts)
                ->update(['status' => '2']);


        $aux = $request->ticket_code;

        $values = ['ticket_code' => '', 'place' => '', 'priority' => '', 'status' => '2'];
        $values = (object) $values;

        $shift = array();
        array_push($shift, $values);

        $ShiftList = Shift::QueueShiftList();
        $canceledListShift = Shift::CanceledShifts();

        return redirect()->route('shifts.show', compact('shift', 'ShiftList', 'canceledListShift'))->with('info', 'Turno '. $aux .'ha sido actualizado con exito');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = DB::table('shifts')
            ->join('categories', 'shifts.category_id', '=', 'categories.id')
            ->join('users', 'shifts.user_id', '=', 'users.id')
            ->select('shifts.ticket_code', 'users.place', 'categories.priority', 'shifts.id', 'shifts.status')
            ->where('shifts.status', '=', '1')
            ->latest('shifts.updated_at', 'asc')
            ->take(5)
            ->get();

        return view('shifts.index', compact('shifts'));
    }

    public function create(){
        $categories = Category::all();
        
        return view('shifts.create', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'category' => 'required'
        ]);
        
        $number = DB::table('shifts') //crea un auto incremente para cada categoria
            ->select('*')
            ->where('category_id', '=', $request->category)
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

        return redirect()->route('shifts.create');
    }

    public function callNext()
    {
        $shift = DB::table('shifts') //selecciono el turno siguiente sin asignar
            ->join('categories', 'shifts.category_id', '=', 'categories.id')
            ->select('shifts.ticket_code', 'categories.priority', 'shifts.id', 'shifts.status', 'shifts.user_id')
            ->where('shifts.status', '=', '1')
            ->where('shifts.user_id', '=', null)
            ->orderBy('categories.priority', 'asc')
            ->orderBy('shifts.id', 'asc')
            ->take(1)
            ->get();

        if ($shift[0]->user_id == null) { //Si el turno siguiente no se ha asignado a ninguna caja, asignalo al usuario logueado
            $shift_register = Shift::find($shift[0]->id);

            $shift_register->user_id = Auth::user()->id;
            $shift_register->save();

            $shift = DB::table('shifts') //refrescando la consulta con el userd_id actualizado en la vista del cajero
                ->join('categories', 'shifts.category_id', '=', 'categories.id')
                ->join('users', 'shifts.user_id', '=', 'users.id')
                ->select('shifts.ticket_code', 'users.place', 'categories.priority', 'shifts.id', 'shifts.status')
                ->where('shifts.id', '=', $shift[0]->id)
                ->orderBy('categories.priority', 'asc')
                ->orderBy('shifts.id', 'asc')
                ->take(1)
                ->get();
        }

        return view('shifts.show', compact('shift'));
    }

    public function callAgain(){

        $shift = DB::table('shifts') //selecciono el turno siguiente sin asignar
            ->join('categories', 'shifts.category_id', '=', 'categories.id')
            ->join('users', 'shifts.user_id', '=', 'users.id')
            ->select('shifts.ticket_code', 'users.place', 'categories.priority', 'shifts.id', 'shifts.status', 'shifts.user_id')
            ->where('shifts.status', '=', 1)
            ->where('shifts.user_id', '=',  Auth::user()->id)
            ->latest('shifts.updated_at')
            ->orderBy('categories.priority', 'asc')
            ->orderBy('shifts.id', 'asc')
            ->take(1)
            ->get();    
        
        return view('shifts.show', compact('shift'));
    }

    public function show(){
        return view('shifts.show');
    }
}

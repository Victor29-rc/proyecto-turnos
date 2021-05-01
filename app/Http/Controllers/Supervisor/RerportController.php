<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RerportController extends Controller
{
    public function index()
    {
        $users = User::all('name', 'id');

        return view('reports.index', compact('users'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'report_type' => 'required',
            'reportrange' => 'required'
        ]);

        $dates = explode('-', (string) $request->reportrange);

        for ($i = 0; $i < sizeof($dates); $i++) {
            $dates[$i] = trim($dates[$i]);
        }

        $startDate = $dates[0];
        $endDate = $dates[1];

        $aux = explode('/', $startDate);
        $startDate = $aux[2] . '-' . $aux[0] . '-' . $aux[1]; //cambiando el formato de fecha a YY-DD-MM
        $startDateToShow = $aux[1] . '-' . $aux[0] . '-' . $aux[2];

        $aux2 = explode('/', $endDate);
        $endDate = $aux2[2] . '-' . $aux2[0] . '-' . $aux2[1]; //cambiando el formato de fecha a YY-DD-MM
        $endDateToShow = $aux2[1] . '-' . $aux2[0] . '-' . $aux2[2];

        $AmountOfShiftsAttendedByCashier =  DB::table('shifts') #cantidad de turnos atendidos por cajeros en un rango de fecha sin detalle
            ->join('users', 'shifts.user_id', '=', 'users.id')
            ->selectRaw("users.name as 'Cajero', users.place as 'Puesto',  count(*) as 'TurnosAtendidos'")
            ->whereRaw("shifts.status = '2' and date(shifts.updated_at) between '$startDate' and '$endDate'")
            ->groupBy('users.name', 'users.place')
            ->get();

        
        $AmountOfShiftsAttended = DB::table('shifts') #cantidad de turnos totales atendidos en un rango de fecha sin detalle
            ->selectRaw("count(*) as 'TurnosAtendidos'")
            ->whereRaw("shifts.status = '2' and date(shifts.updated_at) between '$startDate' and '$endDate'")
            ->get();

        $AmountOfShiftsAttendedByCashierDetailed =  DB::table('shifts') ##cantidad de turnos atendidos por cajeros al detalle
            ->join('users', 'shifts.user_id', '=', 'users.id')
            ->selectRaw("shifts.ticket_code as 'Codigo del ticket', shifts.created_at as 'fechaCreacion', shifts.updated_at 'FechaAtendido', users.name as 'AtendidoPor', users.place as 'Puesto'")
            ->whereRaw("shifts.status = '2' and date(shifts.updated_at) between '$startDate' and '$endDate'")
            ->groupBy('shifts.ticket_code', 'shifts.created_at', 'shifts.updated_at', 'users.name', 'users.place')
            ->get();

        $AmountOfShiftsCanceled = DB::table('shifts') #cantidad de turnos totales atendidos en un rango de fecha sin detalle
            ->selectRaw("count(*) as 'TurnosCancelados'")
            ->whereRaw("shifts.status = '0' and date(shifts.updated_at) between '$startDate' and '$endDate'")
            ->get();

        $AmountOfShiftsCanceledDetailed = DB::table('shifts') #cantidad de turnos totales atendidos en un rango de fecha sin detalle
            ->selectRaw("shifts.ticket_code as 'Codigo del ticket', shifts.created_at as 'fecha y hora de creacion', shifts.updated_at 'Fecha y hora de cancelado'")
            ->whereRaw("shifts.status = '0' and date(shifts.updated_at) between '$startDate' and '$endDate'")
            ->get();

        
        /* return view('reports.create', compact('AmountOfShiftsAttendedByCashier', 'AmountOfShiftsAttended', 'AmountOfShiftsCanceled', 'startDateToShow', 'endDateToShow')); */
        $pdf = \PDF::loadView('reports.create', compact('AmountOfShiftsAttendedByCashier', 'AmountOfShiftsAttended', 'AmountOfShiftsCanceled', 'startDateToShow', 'endDateToShow'));
        return $pdf->download('reporte.pdf');
    }

}

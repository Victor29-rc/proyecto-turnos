<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $shifts = DB::table('shifts')
        ->join('categories', 'shifts.category_id', '=', 'categories.id')
        ->join('users', 'shifts.user_id', '=', 'users.id')
        ->select('shifts.ticket_code', 'users.place', 'categories.priority', 'shifts.id', 'shifts.status')
        ->where('shifts.status', '=', '1')
        ->latest('shifts.updated_at', 'asc')
        ->take(5)
        ->get(); */
        $shifts = Shift::CurrentListOfShifts(); 
  
        return $shifts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shift = Shift::find($id);
        return $shift;
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shift = Shift::find($id);

        $shift->status = '0';
        $shift->save();

        return $shift;
    }

}

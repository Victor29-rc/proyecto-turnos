<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ShowShifts extends Component
{
    protected $listeners = ['re-load' => 'render']; //evento que esta esperando, metodo que ejecutara al escuchar ese evento

    public function render()
    {
        $shifts = DB::table('shifts')
            ->join('categories', 'shifts.category_id', '=', 'categories.id')
            ->join('users', 'shifts.user_id', '=', 'users.id')
            ->select('shifts.ticket_code', 'users.place', 'categories.priority', 'shifts.id', 'shifts.status')
            ->where('shifts.status', '=', '1')
            ->latest('shifts.updated_at', 'asc')
            ->take(5)
            ->get();

        return view('livewire.show-shifts', compact('shifts'));
    }
}

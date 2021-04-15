<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowShifts extends Component
{
    public $shifts;

    public function render()
    {
        return view('livewire.show-shifts');
    }
}

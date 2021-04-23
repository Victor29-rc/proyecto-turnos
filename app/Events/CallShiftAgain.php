<?php

namespace App\Events;

use App\Models\Shift;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CallShiftAgain implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $shift;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($shift)
    {
        $this->shift = $shift;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        /* \Log::debug("turno {$this->shift}"); */
        return new Channel('listOfShiftsUpdated');
    }
}

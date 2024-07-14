<?php

namespace App\Livewire;

use Livewire\Component;

class Room extends Component
{
    protected $listeners = [
        'room-updated' => 'mount'
    ];

    public \App\Models\Room $room;

    public function mount(\App\Models\Room $room)
    {
        $this->room = $room;
    }

    public function render()
    {
        return view('livewire.pages.room.view');
    }
}

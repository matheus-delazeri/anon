<?php

namespace App\Livewire\Forms;

use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class RoomForm extends Component
{
    use Toastable;

    public string $name = "";
    public string $description = "";

    protected array $rules = [
        'name' => 'required|string|max:30',
        'description' => 'required|string|max:255'
    ];

    public function save()
    {
        $this->validate();

        $room = Room::create([
            'name' => $this->name,
            'description' => $this->description
        ]);

        $this->dispatch('room-updated');
        $this->dispatch('show-room', $room->id);
        $this->success('Room successfully created!');
    }

    public function render()
    {
        return view('livewire.pages.room.form');
    }
}

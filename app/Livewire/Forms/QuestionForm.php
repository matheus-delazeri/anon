<?php

namespace App\Livewire\Forms;

use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class QuestionForm extends Component
{
    use Toastable;

    public Room $room;
    public string $content = "";

    protected $listeners = [
        'room-updated' => 'mount'
    ];

    protected array $rules = [
        'content' => 'required|string|max:255'
    ];

    public function mount(Room $room)
    {
        $this->room = $room;
    }

    public function save()
    {
        $this->validate();

        $this->room->questions()->create([
            'user_id' => Auth::id(),
            'content' => $this->content
        ]);

        $this->dispatch('show-room', $this->room->id);
        $this->success('Question successfully created!');
    }

    public function render()
    {
        return view('livewire.pages.room.question');
    }
}

<?php

namespace App\Livewire\Room;

use App\Enums\UserRoleEnum;
use Livewire\Component;

class Invite extends Component
{
    public \App\Models\Room $room;
    public int $role;
    public \App\Models\Room\Invite $invite;

    public function mount(\App\Models\Room $room, int $role)
    {
        $this->room = $room;
        $this->role = $role;
    }

    public function render()
    {
        return view('livewire.pages.room.invite');
    }

    public function generate()
    {
        $this->invite = $this->room->invites()->create([
            'role_granted' => $this->role
        ]);
    }

}

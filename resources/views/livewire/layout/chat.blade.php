<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new class extends Component {

    public \Illuminate\Database\Eloquent\Collection $rooms;
    public \App\Models\Room $room;
    public string $slot = "";

    protected $listeners = [
        'room-updated' => 'mountRooms',
        'show-room' => 'showRoom'
    ];

    public function mount()
    {
        $this->mountRooms();
    }

    public function showRoom(int $roomId)
    {
        $this->switch('room', $roomId);
    }

    public function switch(string $slot, int $roomId = null)
    {
        $this->slot = $slot;

        if (!is_null($roomId)) {
            $this->room = \App\Models\Room::findOrFail($roomId);
            $this->dispatch('room-updated', $this->room);
        }
    }

    public function mountRooms()
    {
        $this->rooms = Auth::user()->rooms;
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.layout.chat');
    }
}

?>
<div class="h-full w-full flex p-2">
    <div class="flex-none flex flex-col gap-2 relative h-full pt-1 pl-2 pr-4 overflow-y-auto w-1/5 bg-white dark:bg-gray-900">
        @foreach($rooms as $cardRoom)
            <x-room-card :room="$cardRoom"/>
        @endforeach
        <x-primary-button title="{{__('Add room')}}" wire:click="switch('new-room')" class="absolute bottom-2 right-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor"
                 class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
        </x-primary-button>
    </div>
    <div class="flex-none h-full overflow-y-auto w-4/5 bg-gray-100 dark:bg-gray-700 rounded-md">
        @if($slot === 'new-room')
            <div class="p-10">
                <livewire:forms.room-form/>
            </div>
        @elseif($slot === 'room')
            <livewire:room :room="$room"/>
        @endif
    </div>
</div>

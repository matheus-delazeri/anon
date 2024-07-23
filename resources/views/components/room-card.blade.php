@props(['room' => null])

<x-secondary-button wire:click="showRoom({{$room->id}})" class="flex flex-col align-middle justify-start items-start">
    <span>{{ $room->name }}</span>
    <span style="font-size: 0.5rem; text-overflow: ellipsis;" class="text-gray-400 overflow-hidden w-full text-start">{{ $room->description  }} </span>
</x-secondary-button>

@props(['room' => null])

<x-secondary-button wire:click="showRoom({{$room->id}})">
    <span>{{ $room->name }}</span>
</x-secondary-button>

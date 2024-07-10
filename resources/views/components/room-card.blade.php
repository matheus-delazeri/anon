@props(['room' => null])

<div class="bg-gray-200 dark:bg-gray-700 border rounded-md p-4">
    <h2 class="text-md font-medium text-gray-900 dark:text-gray-100">{{ $room->name }}</h2>
    <p class="text-xs">{{ $room->updated_at }}</p>
</div>

<?php

use Illuminate\Support\Facades\Auth;

?>
<div class="h-full w-full flex p-2">
    <div class="flex-none h-full pr-2 overflow-y-auto w-1/5 bg-white dark:bg-gray-900 border-r border-gray-200">
        @foreach(Auth::user()->rooms as $room)
            <x-room-card :room="$room"></x-room-card>
        @endforeach
    </div>
    <div class="flex-none h-full overflow-y-auto w-4/5 bg-gray-100 dark:bg-gray-700 rounded-md">

    </div>
</div>

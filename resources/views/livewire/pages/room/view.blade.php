<div class="flex flex-col h-full">
    <nav x-data="{ open: false }"
         class="bg-white h-20 dark:bg-gray-800 border rounded-md border-gray-100 dark:border-gray-700">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto px-4 sm:px-6">
            <div class="flex justify-between">
                <div class="flex">
                    <div class="shrink-0 py-2">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $room->name }}</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $room->description }}</p>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"></div>
                </div>

                <div class="sm:flex sm:items-center sm:ms-6">
                    <button wire:click="settings"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd"
                                  d="M8.34 1.804A1 1 0 0 1 9.32 1h1.36a1 1 0 0 1 .98.804l.295 1.473c.497.144.971.342 1.416.587l1.25-.834a1 1 0 0 1 1.262.125l.962.962a1 1 0 0 1 .125 1.262l-.834 1.25c.245.445.443.919.587 1.416l1.473.294a1 1 0 0 1 .804.98v1.361a1 1 0 0 1-.804.98l-1.473.295a6.95 6.95 0 0 1-.587 1.416l.834 1.25a1 1 0 0 1-.125 1.262l-.962.962a1 1 0 0 1-1.262.125l-1.25-.834a6.953 6.953 0 0 1-1.416.587l-.294 1.473a1 1 0 0 1-.98.804H9.32a1 1 0 0 1-.98-.804l-.295-1.473a6.957 6.957 0 0 1-1.416-.587l-1.25.834a1 1 0 0 1-1.262-.125l-.962-.962a1 1 0 0 1-.125-1.262l.834-1.25a6.957 6.957 0 0 1-.587-1.416l-1.473-.294A1 1 0 0 1 1 10.68V9.32a1 1 0 0 1 .804-.98l1.473-.295c.144-.497.342-.971.587-1.416l-.834-1.25a1 1 0 0 1 .125-1.262l.962-.962A1 1 0 0 1 5.38 3.03l1.25.834a6.957 6.957 0 0 1 1.416-.587l.294-1.473ZM13 10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <div
        class="h-64 min-h-64 relative p-4 bg-white dark:bg-gray-800 border border-t-0 rounded-md border-gray-100 dark:border-gray-700" style="margin-top: -1px">
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"><span
                class="font-bold">{{ __('Created at')}}:</span> {{$room->created_at}}</p>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"><span
                class="font-bold">{{ __('Creator')}}:</span> {{$room->creator()->name}}</p>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"><span
                class="font-bold">{{ __('Nº of Moderators')}}:</span> {{$room->moderators()->count()}}</p>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"><span
                class="font-bold">{{ __('Nº of Participants')}}:</span> {{$room->participants()->count()}}</p>

        <div class="absolute bottom-0 pb-2">
            @if(Auth::user()->id === $room->creator()->id)
                <x-primary-button
                    x-on:click.prevent="$dispatch('open-modal', 'invite-moderator')"
                ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path d="M12.232 4.232a2.5 2.5 0 0 1 3.536 3.536l-1.225 1.224a.75.75 0 0 0 1.061 1.06l1.224-1.224a4 4 0 0 0-5.656-5.656l-3 3a4 4 0 0 0 .225 5.865.75.75 0 0 0 .977-1.138 2.5 2.5 0 0 1-.142-3.667l3-3Z" />
                        <path d="M11.603 7.963a.75.75 0 0 0-.977 1.138 2.5 2.5 0 0 1 .142 3.667l-3 3a2.5 2.5 0 0 1-3.536-3.536l1.225-1.224a.75.75 0 0 0-1.061-1.06l-1.224 1.224a4 4 0 1 0 5.656 5.656l3-3a4 4 0 0 0-.225-5.865Z" />
                    </svg>&nbsp{{ __('Invite Moderator') }}</x-primary-button>
                <x-primary-button
                    x-on:click.prevent="$dispatch('open-modal', 'invite-participant')"
                ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path d="M12.232 4.232a2.5 2.5 0 0 1 3.536 3.536l-1.225 1.224a.75.75 0 0 0 1.061 1.06l1.224-1.224a4 4 0 0 0-5.656-5.656l-3 3a4 4 0 0 0 .225 5.865.75.75 0 0 0 .977-1.138 2.5 2.5 0 0 1-.142-3.667l3-3Z" />
                        <path d="M11.603 7.963a.75.75 0 0 0-.977 1.138 2.5 2.5 0 0 1 .142 3.667l-3 3a2.5 2.5 0 0 1-3.536-3.536l1.225-1.224a.75.75 0 0 0-1.061-1.06l-1.224 1.224a4 4 0 1 0 5.656 5.656l3-3a4 4 0 0 0-.225-5.865Z" />
                    </svg>&nbsp{{ __('Invite Participant') }}</x-primary-button>
            @else
                <x-danger-button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd" d="M17 4.25A2.25 2.25 0 0 0 14.75 2h-5.5A2.25 2.25 0 0 0 7 4.25v2a.75.75 0 0 0 1.5 0v-2a.75.75 0 0 1 .75-.75h5.5a.75.75 0 0 1 .75.75v11.5a.75.75 0 0 1-.75.75h-5.5a.75.75 0 0 1-.75-.75v-2a.75.75 0 0 0-1.5 0v2A2.25 2.25 0 0 0 9.25 18h5.5A2.25 2.25 0 0 0 17 15.75V4.25Z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M14 10a.75.75 0 0 0-.75-.75H3.704l1.048-.943a.75.75 0 1 0-1.004-1.114l-2.5 2.25a.75.75 0 0 0 0 1.114l2.5 2.25a.75.75 0 1 0 1.004-1.114l-1.048-.943h9.546A.75.75 0 0 0 14 10Z" clip-rule="evenodd" />
                    </svg>&nbsp{{ __('Leave') }}
                </x-danger-button>
            @endif
        </div>
    </div>
    <x-modal name="invite-moderator" :show="$errors->isNotEmpty()" focusable>
        <livewire:room.invite :room="$room" :role="2" />
    </x-modal>
    <x-modal name="invite-participant" :show="$errors->isNotEmpty()" focusable>
        <livewire:room.invite :room="$room" :role="1"/>
    </x-modal>

    <div class="h-full overflow-y-auto">
        @foreach($room->questions as $question)
            <div class="m-2 p-4 rounded rounded-md bg-white shadow">
                <p class="mt-1 w-3/4 text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">{{__('Question')}}: </span>{{ $question->content }}
                </p>
                <p class="mt-1 w-3/4 text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">{{__('Status')}}: </span>{{ $question->status->label() }}
                </p>
                <p class="mt-3 w-3/4 text-sm text-gray-600 dark:text-gray-400">
                    <span>{{ $question->created_at }}</span>
                </p>
            </div>
        @endforeach
    </div>

    <livewire:forms.question-form :room="$room"/>
</div>

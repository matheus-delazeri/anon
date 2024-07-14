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

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 6h16M4 12h16M4 18h16"/>
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <button wire:click="settings" class="w-full text-start">
                                <x-dropdown-link>
                                    {{ __('Settings') }}
                                </x-dropdown-link>
                            </button>

                            <!-- Authentication -->
                            <button wire:click="leave" class="w-full text-start">
                                <x-dropdown-link>
                                    {{ __('Leave') }}
                                </x-dropdown-link>
                            </button>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="mt-3 space-y-1">
                    <button wire:click="settings" class="w-full text-start">
                        <x-responsive-nav-link>
                            {{ __('Settings') }}
                        </x-responsive-nav-link>
                    </button>

                    <button wire:click="leave" class="w-full text-start">
                        <x-responsive-nav-link>
                            {{ __('Leave') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="h-full">
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

<div class="flex flex-col h-full">
    <nav x-data="{ open: false }"
         class="bg-white h-[10%] dark:bg-gray-800 border rounded-md border-gray-100 dark:border-gray-700">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto px-4 sm:px-6 h-full">
            <div class="flex justify-between h-full items-center">
                <div class="flex">
                    <div class="shrink-0 py-2">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $room->name }}</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $room->description }}</p>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"></div>
                </div>

                <div class="sm:flex sm:items-center sm:ms-6">
                    <button wire:click="$toggle('settings')"
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
        @if($settings)
            <div wire:transition
                 class="h-64 min-h-64 relative p-4 bg-white dark:bg-gray-800 border-b-2 border-gray-100 dark:border-gray-700 "
                 style="margin-top: -1px">
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
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="size-5">
                                <path
                                    d="M12.232 4.232a2.5 2.5 0 0 1 3.536 3.536l-1.225 1.224a.75.75 0 0 0 1.061 1.06l1.224-1.224a4 4 0 0 0-5.656-5.656l-3 3a4 4 0 0 0 .225 5.865.75.75 0 0 0 .977-1.138 2.5 2.5 0 0 1-.142-3.667l3-3Z"/>
                                <path
                                    d="M11.603 7.963a.75.75 0 0 0-.977 1.138 2.5 2.5 0 0 1 .142 3.667l-3 3a2.5 2.5 0 0 1-3.536-3.536l1.225-1.224a.75.75 0 0 0-1.061-1.06l-1.224 1.224a4 4 0 1 0 5.656 5.656l3-3a4 4 0 0 0-.225-5.865Z"/>
                            </svg>
                            &nbsp{{ __('Invite Moderator') }}</x-primary-button>
                        <x-primary-button
                            x-on:click.prevent="$dispatch('open-modal', 'invite-participant')"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="size-5">
                                <path
                                    d="M12.232 4.232a2.5 2.5 0 0 1 3.536 3.536l-1.225 1.224a.75.75 0 0 0 1.061 1.06l1.224-1.224a4 4 0 0 0-5.656-5.656l-3 3a4 4 0 0 0 .225 5.865.75.75 0 0 0 .977-1.138 2.5 2.5 0 0 1-.142-3.667l3-3Z"/>
                                <path
                                    d="M11.603 7.963a.75.75 0 0 0-.977 1.138 2.5 2.5 0 0 1 .142 3.667l-3 3a2.5 2.5 0 0 1-3.536-3.536l1.225-1.224a.75.75 0 0 0-1.061-1.06l-1.224 1.224a4 4 0 1 0 5.656 5.656l3-3a4 4 0 0 0-.225-5.865Z"/>
                            </svg>
                            &nbsp{{ __('Invite Participant') }}</x-primary-button>
                    @else
                        <x-danger-button wire:click="leave">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="size-5">
                                <path fill-rule="evenodd"
                                      d="M17 4.25A2.25 2.25 0 0 0 14.75 2h-5.5A2.25 2.25 0 0 0 7 4.25v2a.75.75 0 0 0 1.5 0v-2a.75.75 0 0 1 .75-.75h5.5a.75.75 0 0 1 .75.75v11.5a.75.75 0 0 1-.75.75h-5.5a.75.75 0 0 1-.75-.75v-2a.75.75 0 0 0-1.5 0v2A2.25 2.25 0 0 0 9.25 18h5.5A2.25 2.25 0 0 0 17 15.75V4.25Z"
                                      clip-rule="evenodd"/>
                                <path fill-rule="evenodd"
                                      d="M14 10a.75.75 0 0 0-.75-.75H3.704l1.048-.943a.75.75 0 1 0-1.004-1.114l-2.5 2.25a.75.75 0 0 0 0 1.114l2.5 2.25a.75.75 0 1 0 1.004-1.114l-1.048-.943h9.546A.75.75 0 0 0 14 10Z"
                                      clip-rule="evenodd"/>
                            </svg>
                            &nbsp{{ __('Leave') }}
                        </x-danger-button>
                    @endif
                </div>
            </div>
            <x-modal name="invite-moderator" :show="$errors->isNotEmpty()" focusable>
                <livewire:room.invite :room="$room" :role="2"/>
            </x-modal>
            <x-modal name="invite-participant" :show="$errors->isNotEmpty()" focusable>
                <livewire:room.invite :room="$room" :role="1"/>
            </x-modal>
        @endif
    </nav>

    <div class="h-[80%] overflow-y-auto">
        @foreach($room->questions as $question)
            @if($question->approved()
            || $question->user->id == Auth::user()->id
            || $room->hasPrivileges(Auth::user()) )
                <div class="m-2 p-4 rounded rounded-md bg-white shadow flex">
                    <div class="w-2/4">
                        <p class="mt-1 w-3/4 text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">{{__('Question')}}: </span>{{ $question->content }}
                        </p>
                        <p class="mt-1 w-3/4 text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">{{__('Status')}}: </span>{{ $question->status->label() }}
                        </p>
                        <p class="mt-3 mb-2 w-3/4 text-sm text-gray-600 dark:text-gray-400">
                            <span>{{ $question->created_at }}</span>
                        </p>
                        @if($question->approved() && $room->hasPrivileges(Auth::user()))
                            <livewire:forms.answer-form :question="$question"/>
                        @elseif($question->answered())
                            <p class="mt-1 w-3/4 text-sm text-gray-600 dark:text-gray-400 border-t py-2">
                                <span class="font-semibold">{{__('Answer')}}: </span>{{ $question->answer }}
                            </p>
                        @endif
                    </div>
                    <div class="w-2/4 flex flex-col items-end">
                        @if($question->pending() && $room->hasPrivileges(Auth::user()))
                            <x-primary-button wire:click="approve({{$question}})">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                     class="size-5">
                                    <path fill-rule="evenodd"
                                          d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </x-primary-button>
                            <x-danger-button wire:click="decline({{$question}})">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                     class="size-5">
                                    <path
                                        d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z"/>
                                </svg>
                            </x-danger-button>
                        @elseif($question->approved())
                            <x-primary-button wire:click="upvote({{$question}})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z"/>
                                </svg>
                                &nbsp{{$question->upvotesCount()}}
                            </x-primary-button>
                            <x-danger-button wire:click="downvote({{$question}})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54"/>
                                </svg>
                                &nbsp{{$question->downvotesCount()}}
                            </x-danger-button>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <livewire:forms.question-form :room="$room"/>
</div>

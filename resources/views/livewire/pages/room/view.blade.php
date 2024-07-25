<div class="flex flex-col h-full">
    <nav x-data="{ open: false }"
         class="bg-white h-[10%] dark:bg-gray-800 border rounded-md border-gray-100 dark:border-gray-700">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto px-4 py-2 sm:px-6 h-full">
            <div class="flex justify-between h-full items-center">
                <div class="flex">
                    <div class="shrink-0">
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

    <div class="h-full overflow-y-auto flex flex-col scrollbar-thin scrollbar-thumb-gray-900 scrollbar-track-gray-100" style="gap: 1rem; padding: 0.5rem 1rem;">
        @foreach($room->questions as $question)
            @if($question->approved()
            || ($question->user->id == Auth::user()->id && $question->pending())
            || $room->hasPrivileges(Auth::user()))
                <div class="flex flex-row w-full h-fit justify-end items-center" style="gap: 1rem">
                    @if($question->pending() && $room->hasPrivileges(Auth::user()))
                        {{-- Moderator options --}}
                        <div class="flex flex-row w-fit h-full align-middle justify-center items-center" style="gap: 0.75rem;">
                            <svg width="55" height="55" viewBox="0 0 55 55"xmlns="http://www.w3.org/2000/svg" wire:click="decline({{$question}})" class="cursor-pointer">
                                <g clip-path="url(#clip0_97_389)" class="group cursor-pointer">
                                    <path class="fill-gray-900" d="M49.3254 0.218262H5.67461C2.66543 0.218262 0.218262 2.66543 0.218262 5.67461V54.7818L11.131 43.8691H49.3254C52.3346 43.8691 54.7818 41.4219 54.7818 38.4127V5.67461C54.7818 2.66543 52.3346 0.218262 49.3254 0.218262Z"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" class="fill-white group-hover:fill-red-400" d="M28 25.8903L37.7222 35.6125C38.2381 36.1283 38.9378 36.4182 39.6674 36.4182C40.397 36.4182 41.0967 36.1283 41.6125 35.6125C42.1284 35.0966 42.4183 34.3969 42.4183 33.6673C42.4183 32.9377 42.1284 32.238 41.6125 31.7221L31.8867 22L41.6107 12.2778C41.866 12.0223 42.0685 11.7191 42.2067 11.3854C42.3448 11.0517 42.4159 10.6941 42.4158 10.3329C42.4157 9.97173 42.3445 9.61411 42.2062 9.28047C42.0679 8.94683 41.8652 8.6437 41.6098 8.38837C41.3544 8.13305 41.0511 7.93054 40.7174 7.79241C40.3837 7.65428 40.0261 7.58322 39.6649 7.58331C39.3037 7.58339 38.9461 7.65461 38.6125 7.79291C38.2788 7.9312 37.9757 8.13385 37.7204 8.38929L28 18.1115L18.2779 8.38929C18.0243 8.12652 17.721 7.91688 17.3855 7.7726C17.0501 7.62832 16.6893 7.55229 16.3241 7.54894C15.959 7.5456 15.5968 7.61501 15.2588 7.75312C14.9208 7.89124 14.6136 8.09529 14.3553 8.35337C14.097 8.61145 13.8927 8.9184 13.7542 9.25629C13.6158 9.59419 13.546 9.95628 13.549 10.3214C13.552 10.6866 13.6277 11.0475 13.7717 11.383C13.9157 11.7186 14.125 12.0222 14.3875 12.276L24.1134 22L14.3894 31.724C14.1269 31.9778 13.9175 32.2813 13.7735 32.6169C13.6296 32.9525 13.5539 33.3134 13.5509 33.6785C13.5479 34.0436 13.6176 34.4057 13.7561 34.7436C13.8945 35.0815 14.0988 35.3885 14.3572 35.6465C14.6155 35.9046 14.9226 36.1087 15.2606 36.2468C15.5987 36.3849 15.9608 36.4543 16.326 36.451C16.6911 36.4476 17.0519 36.3716 17.3874 36.2273C17.7228 36.083 18.0262 35.8734 18.2797 35.6106L28 25.8903Z"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_97_389">
                                        <rect width="55" height="55" class="fill-white"/>
                                    </clipPath>
                                </defs>
                            </svg>

                            <svg width="55" height="55" viewBox="0 0 55 55" xmlns="http://www.w3.org/2000/svg" wire:click="approve({{$question}})">
                                <g clip-path="url(#clip0_97_391)" class="cursor-pointer group">
                                    <path class="fill-gray-900" d="M49.3254 0.218262H5.67461C2.66543 0.218262 0.218262 2.66543 0.218262 5.67461V54.7818L11.131 43.8691H49.3254C52.3346 43.8691 54.7818 41.4219 54.7818 38.4127V5.67461C54.7818 2.66543 52.3346 0.218262 49.3254 0.218262Z"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" class="fill-white group-hover:fill-blue-400" d="M45.501 9.37017C46.0165 9.88587 46.3061 10.5852 46.3061 11.3144C46.3061 12.0436 46.0165 12.743 45.501 13.2587L24.8888 33.8708C24.6164 34.1433 24.293 34.3594 23.9371 34.5069C23.5811 34.6543 23.1997 34.7302 22.8144 34.7302C22.4291 34.7302 22.0476 34.6543 21.6917 34.5069C21.3358 34.3594 21.0124 34.1433 20.74 33.8708L10.499 23.6317C10.2363 23.378 10.0268 23.0745 9.88269 22.739C9.73856 22.4035 9.6627 22.0427 9.65953 21.6775C9.65635 21.3124 9.72593 20.9503 9.86421 20.6123C10.0025 20.2743 10.2067 19.9673 10.4649 19.7091C10.7231 19.4509 11.0301 19.2467 11.3681 19.1084C11.7061 18.9701 12.0682 18.9006 12.4333 18.9037C12.7985 18.9069 13.1593 18.9828 13.4948 19.1269C13.8303 19.271 14.1338 19.4805 14.3875 19.7432L22.8135 28.1692L41.6106 9.37017C41.866 9.11462 42.1693 8.9119 42.503 8.77359C42.8368 8.63528 43.1945 8.56409 43.5558 8.56409C43.9171 8.56409 44.2748 8.63528 44.6086 8.77359C44.9423 8.9119 45.2456 9.11462 45.501 9.37017Z"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_97_391">
                                        <rect width="55" height="55" class="fill-white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                    @elseif($question->pending())
                        {{-- User question wait spinner --}}
                        <span class="rounded-full animate-spin" style="opacity: 60%; border: 5px solid rgb(107 114 128); border-left-color: white; flex: 0 0 50px; height: 50px; width: 50px;"></span>
                    @endif

                    <div class="flex flex-col w-full h-fit">
                        <div class="p-4 rounded-md bg-white dark:bg-gray-800 flex">
                            <div class="w-full h-fit flex flex-col">
                                <p class="w-full text-sm text-gray-600 dark:text-gray-400" style="word-break: break-all">
                                    {{ $question->content }}
                                </p>
                                <p class="w-full text-xs text-gray-600 dark:text-gray-400 text-opacity-75 text-end">
                                    @if($question->declined()) <span class="text-red-500 text-opacity-50">{{__("Declined")}}</span>@elseif($question->pending()) {{__('Pending')}} @endif -
                                    <span>{{ $question->created_at }}</span>
                                </p>
                            </div>
                        </div>

                        @if(!$question->pending() && !$question->declined())
                            <div class="h-fit flex flex-row justify-end py-2 px-4 rounded-b bg-white dark:bg-gray-800 shadow items-center w-auto" style="gap: 0.75rem; margin: 0 0.5rem; border-radius: 0 0 0.375rem 0.375rem; border-top: 1px solid black;">
                                @if($question->answered())
                                    <div class="w-full">
                                        <p class="w-full text-sm text-gray-600 dark:text-gray-400" style="word-break: break-all">
                                            <span class="font-semibold">{{__("Answer")}}</span><br>
                                            {{ $question->answer }}
                                        </p>
                                    </div>
                                @else
                                    @if($room->hasPrivileges(Auth::user()))
                                        <livewire:forms.answer-form :question="$question"/>
                                    @endif

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
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <livewire:forms.question-form :room="$room"/>
</div>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Anon</title>

    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans">
<div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
    <div class="relative min-h-screen flex flex-col items-center selection:bg-[#FF2D20] selection:text-white">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
            <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                <div class="flex lg:justify-center lg:col-start-2">

                    <svg fill="#444444" height="75px" width="75px" version="1.1" id="Capa_1"
                         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         viewBox="-14.92 -14.92 179.09 179.09" xml:space="preserve" stroke="#444444"
                         stroke-width="0.0014924600000000001"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path
                                    d="M74.623,0C33.476,0,0,33.476,0,74.623s33.476,74.623,74.623,74.623s74.623-33.476,74.623-74.623S115.771,0,74.623,0z M74.623,137.246C40.093,137.246,12,109.153,12,74.623S40.093,12,74.623,12s62.623,28.093,62.623,62.623 S109.153,137.246,74.623,137.246z"></path>
                                <path
                                    d="M74.623,22.983c-4.227,0-8.433,0.513-12.5,1.524c-2.145,0.533-3.45,2.703-2.917,4.847c0.532,2.144,2.707,3.45,4.847,2.917 c3.438-0.854,6.993-1.288,10.57-1.288c24.063,0,43.64,19.577,43.64,43.64c0,10.553-3.815,20.737-10.744,28.677 c-1.453,1.665-1.281,4.191,0.384,5.644c0.758,0.662,1.695,0.986,2.628,0.986c1.115,0,2.225-0.464,3.016-1.37 c8.2-9.397,12.717-21.45,12.717-33.937C126.263,46.149,103.098,22.983,74.623,22.983z"></path>
                                <path
                                    d="M74.623,118.263c-24.063,0-43.64-19.577-43.64-43.64c0-2.209-1.791-4-4-4s-4,1.791-4,4c0,28.474,23.165,51.64,51.64,51.64 c2.209,0,4-1.791,4-4S76.832,118.263,74.623,118.263z"></path>
                                <path
                                    d="M74.623,92.177c16.309,0,29.063-14.305,29.597-14.914c1.327-1.51,1.327-3.77,0-5.279 c-0.534-0.609-13.288-14.914-29.597-14.914S45.561,71.374,45.026,71.983c-1.327,1.51-1.327,3.77,0,5.279 C45.561,77.872,58.314,92.177,74.623,92.177z M83.965,67.099c4.922,2.064,9.033,5.27,11.554,7.531 c-2.518,2.267-6.628,5.477-11.569,7.536c1.669-2.062,2.673-4.684,2.673-7.543C86.623,71.772,85.625,69.158,83.965,67.099z M65.296,67.08c-1.669,2.062-2.673,4.684-2.673,7.543c0,2.851,0.999,5.465,2.659,7.524c-4.923-2.064-9.035-5.271-11.554-7.531 C56.245,72.35,60.356,69.139,65.296,67.08z"></path>
                            </g>
                        </g></svg>
                </div>
                @if (Route::has('login'))
                    <livewire:welcome.navigation/>
                @endif
            </header>

            <main class="mt-6">
                <div class="grid gap-6 lg:grid-cols-1 lg:gap-8">
                    <div
                        id="docs-card"
                        class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                    >
                        <div class="relative flex items-center gap-6 lg:items-end">
                            <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                                <div class="pt-3 sm:pt-5 lg:pt-0">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">{{ __('Welcome to Anon') }}</h2>

                                    <p class="mt-4 text-sm/relaxed">
                                        {{ __('Ask questions anonymously!') }}
                                    </p>

                                    <div class="mt-6">
                                        <a href="{{ route('register') }}"
                                           class="text-black dark:text-white font-bold hover:underline">{{ __('Create your account') }}</a>
                                        <span class="mx-2">{{ __('or') }}</span>
                                        <a href="{{ route('login') }}"
                                           class="text-black dark:text-white font-bold hover:underline">{{ __('Log in') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
</body>
</html>

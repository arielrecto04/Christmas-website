<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Innovato Christmas Party</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Eagle+Lake&family=Norican&display=swap" rel="stylesheet">


    <link rel="shortcut icon" href="{{ asset('images/2.png') }}" type="image/x-icon">

    @stack('css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>

<body class="bg-gray-100 relative h-auto w-full">

    {{-- <x-size /> --}}

    <div class="flex flex-col gap-2 w-full max-w-screen overflow-hidden h-auto">
        <div class="flex items-center shadow-lg bg-red-500 opacity-95 p-5 justify-between sticky top-0 z-30"
            x-data="backMusic">
            <div class="flex items-center relative" x-init="loadAudio(`{{ asset('song.mp3') }}`)">
                <a href="/" class="text-sm md:text-base lg:text-3xl font-bold text-white flex items-center gap-5">
                    <span>
                        <img src="{{ asset('images/2.png') }}" alt="" srcset=""
                            class="w-14 lg:w-12 aspect-square">
                    </span> <span>
                        Innovato Christmas Party</span>
                </a>

                <img src="{{ asset('images/santa-claus.png') }}" alt="" srcset=""
                    class="absolute z-10 -right-14 animate-bounce w-12 aspect-square mb-2">
            </div>

            <div class="md:flex items-center gap-2 text-xs lg:text-lg hidden">
                <a href="/"
                    class="font-semibold text-white p-2 uppercase tracking-wider  hover:link hover:link-white hover:scale-105  duration-700">
                    Home
                </a>
                <a href="{{ route('attendance.index') }}"
                    class="font-semibold text-white p-2 uppercase tracking-wider  hover:link hover:link-white hover:scale-105  duration-700">
                    Attendances
                </a>
                <a href="https://plotest.odoo.com/survey/start/c7586999-5a14-432b-b656-c3f8ac11f23d"
                    class="font-semibold text-white p-2 uppercase tracking-wider  hover:link hover:link-white hover:scale-105  duration-700">
                    Survey
                </a>
            </div>

            <a href="{{ route('login') }}" class="md:flex bg-white text-red-500 btn hidden">
                login
            </a>


            <div class="flex flex-col gap-2 md:hidden" x-ref="menu" x-data="{ open: false }">
                <button class="text-white" @click="open = !open">
                    <i class="fi fi-rr-menu-burger"></i>
                </button>

                <div x-show="open" x-anchor="$refs.menu"
                    class="flex flex-col gap-2 bg-white p-2 rounded-lg shadow-lg w-[20rem]" x-transition.duration.700>
                    <a href="/"
                        class="p-5 rounded-lg hover:bg-red-500 hover:text-white font-bold text-red-500 uppercase duration-700">Home</a>
                    <a href="{{ route('attendance.index') }}"
                        class="p-5 rounded-lg hover:bg-red-500 hover:text-white font-bold text-red-500 uppercase duration-700">Attendance</a>
                    <a href="https://plotest.odoo.com/survey/start/c7586999-5a14-432b-b656-c3f8ac11f23d"
                        class="p-5 rounded-lg hover:bg-red-500 hover:text-white font-bold text-red-500 uppercase duration-700">Survey</a>
                    <a href="{{ route('login') }}"
                        class="p-5 rounded-lg bg-red-500 text-white font-bold hover:scale-105 uppercase duration-700">Login</a>

                </div>
            </div>
        </div>
        <div class="min-h-screen  bg-cover bg-fixed" style="background-image: url({{ asset('images/bg4.jpg') }})">


            <div
                class="flex flex-col lg:flex-row items-center justify-start md:justify-center h-[60rem] md:min-h-screen relative w-full">

                <img src="{{ asset('images/b2.png') }}" alt="" srcset=""
                    class="absolute z-10 top-0 -left-[14rem] rotate-[100deg] w-[40rem] opacity-80">
                {{ $slot }}

            </div>
        </div>

        <img src="{{ asset('images/snow.gif') }}" alt="" srcset=""
            class="w-screen h-screen absolute z-15 top-0">
    </div>

</body>

@stack('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

</html>

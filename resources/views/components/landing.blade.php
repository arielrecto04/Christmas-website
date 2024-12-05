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


    @stack('css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>

<body class="bg-gray-100 relative">

    <div class="flex items-center shadow-lg bg-red-500 opacity-95 p-5 flex justify-between sticky top-0 z-20" x-data="backMusic">
        <div class="flex items-center relative" x-init="loadAudio(`{{asset('song.mp3')}}`)">
            <a href="/" class="text-3xl font-bold text-white flex items-center gap-5">
                <span>
                    <img src="{{ asset('images/2.png') }}" alt="" srcset=""
                        class="w-12 aspect-square">
                </span> <span>
                    Innovato Christmas Party</span>
            </a>

            <img src="{{ asset('images/santa-claus.png') }}" alt="" srcset=""
                class="absolute z-10 -right-14 animate-bounce w-12 aspect-square mb-2">
        </div>

        <div class="flex items-center gap-2">
            <a href="/" class="text-lg font-semibold text-white p-2 uppercase tracking-wider  hover:link hover:link-white hover:scale-105  duration-700">
               Home
            </a>
            <a href="{{route('attendance.index')}}" class="text-lg font-semibold text-white p-2 uppercase tracking-wider  hover:link hover:link-white hover:scale-105  duration-700">
                Attendances
            </a>
            <a href="https://plotest.odoo.com/survey/start/c7586999-5a14-432b-b656-c3f8ac11f23d" class="text-lg font-semibold text-white p-2 uppercase tracking-wider  hover:link hover:link-white hover:scale-105  duration-700">
                Survey
            </a>
        </div>

        <a href="{{route('login')}}" class="bg-white text-red-500 btn">
            login
        </a>
    </div>
    <div class="min-h-screen w-full max-x-screen overflow-hidden bg-cover bg-fixed"
        style="background-image: url({{ asset('images/bg4.jpg') }})">


        <div class="flex items-center justify-center min-h-screen relative w-full">

            <img src="{{ asset('images/b2.png') }}" alt="" srcset=""
                class="absolute z-10 top-0 -left-[14rem] rotate-[100deg] w-[40rem] opacity-80">
                {{$slot}}

        </div>
    </div>

    <img src="{{ asset('images/snow.gif') }}" alt="" srcset=""
        class="w-screen h-screen absolute z-15 top-0">
</body>

@stack('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

</html>

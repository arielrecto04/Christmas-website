<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Chelsea+Market&display=swap');

        body {
            font-family: "Chelsea Market", cursive, system-ui;
        }
    </style>
</head>

<body>
    <div class="w-screen h-screen">
        <video autoplay muted loop playsinline preload="metadata" poster="{{ asset('images/black.jpg') }}"
            class="w-full h-full object-cover fixed top-0 left-0">
            <source src="{{ asset('videos/disco-loop.mp4') }}" type="video/mp4">
            Disco Loop
        </video>

        <div class="fixed top-0 left-0 w-full h-full py-8 sm:px-8">
            <div class="flex flex-col w-full h-full items-center pt-20 pb-10 overflow-auto">
                <div class="max-w-[12rem] sm:max-w-[18rem]">
                    <img src="{{ asset('gifs/innovato-disco-logo.gif') }}" alt="Innovato Disco Logo" class="w-full">
                </div>
                <div class="max-w-[48rem] mb-4">
                    <img src="{{ asset('images/title.png') }}" alt="Innovato Christmas Party" class="w-full">
                </div>
                <a href="{{ route('login') }}"
                    class="w-[100px] h-[40px] sm:w-[184px] sm:h-[60px] flex items-center justify-center gap-4 text-base md:text-3xl font-extrabold tracking-[2px] text-white bg-violet-700 border-2 border-violet-900 rounded-xl shadow-[0_8px_0_#4C1D95] transform -skew-x-[10deg] transition-all duration-100 ease-in filter drop-shadow-[0_15px_20px_#654dff63] active:tracking-[0px] active:translate-y-2 active:shadow-none active:-skew-x-[10deg] cursor-pointer">
                    LOGIN
                </a>
            </div>
        </div>
    </div>
</body>

</html>
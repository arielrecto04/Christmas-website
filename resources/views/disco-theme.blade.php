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

        <div class="fixed top-0 left-0 w-full h-full p-8">
            <div class="flex flex-col w-full h-full items-center pt-20 overflow-auto">
                <div class="max-w-[15rem] sm:max-w-[20rem]">
                    <img src="{{ asset('gifs/innovato-disco-logo.gif') }}" alt="Innovato Disco Logo" class="w-full">
                </div>
                <div class="max-w-[48rem] mb-4">
                    <img src="{{ asset('images/title.png') }}" alt="Innovato Christmas Party" class="w-full">
                </div>
                <button
                    class="font-bold text-base md:text-3xl bg-purple-900 text-white border-4 border-white rounded-3xl py-2 px-6">LOGIN</button>
            </div>
        </div>
    </div>
</body>

</html>
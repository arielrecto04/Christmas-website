<x-landing>
    <div class="flex flex-col items-center gap-5">
        <h1 class="ml1" x-data="textAnimation">
            <span class="text-wrapper eagle-lake-regular">
                <span class="line line1 border-red-500 hidden md:flex"></span>
                <span class="letters text-red-500 text-2xl md:text-4xl lg:text-6xl">Merry Christmas!</span>
                <span class="line line2 hidden md:flex"></span>
            </span>
        </h1>

        <img src="{{asset('images/poster.png')}}" alt="" class="w-5/6 lg:w-1/2 aspect-auto rounded-lg shadow-xl
         hover:scale-105 hover:shadow-red-500 duration-700 z-20">
    </div>
    
</x-landing>

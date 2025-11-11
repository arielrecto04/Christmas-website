<x-landing>
    <div class="flex flex-col gap-2">
        <div class="bg-white rounded-lg shadow-lg p-5 flex flex-col lg:flex-row items-center gap-5 w-full lg:min-w-[30rem] lg:max-w-[60rem]">
            <div class="w-full lg:w-auto rounded-lg p-5 lg:p-2 rounded-lg flex item-center bg-red-500 text-white font-bold">
                {{ $user->ticket->ticket_number }}
            </div>


            <div class="flex flex-col gap-5">

                <div class="flex items-center justify-between">

                    <h1 class="text-4xl text-red-500 font-bold">Attendance</h1>

                </div>

                <h1 class="font-bold text-2xl">
                    <span>Name : </span> <span>{{ $user->name }}</span>
                </h1>
                <h1 class="text-gray-500">
                    <span>Arrival Time : </span>
                    <span>{{ date('F d, Y h:s A', strtotime($user->attendance->arrival_date)) }}</span>
                </h1>



            </div>
        </div>

        <div class="flex items-center justify-between">

            <a href="/" class="link link-error z-20">Go to Homepage </a>
            <a href="https://plotest.odoo.com/survey/start/c7586999-5a14-432b-b656-c3f8ac11f23d"
                class="link link-success z-20">Go to Survey</a>
        </div>

    </div>

</x-landing>

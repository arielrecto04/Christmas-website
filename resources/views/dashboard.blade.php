<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-2">

            <div class="grid grid-cols-2 grid-flow-row gap-2 w-full">
                <x-card label="Total Attendees" :total="$totalAttendees" sub_label="Attendances" />
                <x-card label="Total Employees" :total="$totalEmployees" 
                sub_label="Employees" />
            </div>


            <div class="bg-white rounded-lg shadow-lg flex flex-col gap-2">
                <div class="overflow-x-auto p-2">
                    <h1 class="text-lg font-bold gap-2">
                        Employee Attendance
                    </h1>
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Ticket Number</th>
                                <th>Arrival Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->

                            @forelse ($employeeAttendances as $employeeAttendance)
                                <tr>
                                    <th></th>
                                    <td>{{$employeeAttendance->name}}</td>
                                    <td>{{$employeeAttendance->ticket_number}}</td>
                                    <td>{{date('F d, Y h:s A',  strtotime($employeeAttendance->attendance->arrival_date))}}</td>
                                </tr>

                            @empty
                                <tr>
                                    No Attendance
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

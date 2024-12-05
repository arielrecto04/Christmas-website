<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-2">

            <div class="grid grid-cols-2 grid-flow-row gap-2 w-full">
                <x-card label="Total Attendees" :url="route('dashboard')" :total="$totalAttendees" sub_label="Attendances" />
                <x-card label="Total Employees" :url="route('employees.index')" :total="$totalEmployees" sub_label="Employees" />
            </div>

            {{-- <div class="bg-white p-5 rounded-lg shadow-lg flex items-center justify-center">
                <x-pie-chart :data="$attendanceDataSet"/>
            </div> --}}

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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->

                            @forelse ($employeeAttendances as $employeeAttendance)
                                <tr>
                                    <th></th>
                                    <td>{{ $employeeAttendance->name }}</td>
                                    <td>{{ $employeeAttendance->ticket_number }}</td>
                                    <td>{{ date('F d, Y h:s A', strtotime($employeeAttendance->attendance->arrival_date)) }}
                                    </td>
                                    <td class="flex items-center gap-2">

                                        <form
                                            action="{{ route('attendance.destroy', ['attendance' => $employeeAttendance->attendance->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-xs btn-error">
                                                <i class="fi fi-rr-trash"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td> No Attendance</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

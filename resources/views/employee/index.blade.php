<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-2">



            <div class="bg-white rounded-lg shadow-lg flex flex-col gap-2">
                <div class="overflow-x-auto p-2">
                    <div class="flex items-center justify-between">
                        <h1 class="text-lg font-bold gap-2">
                            Employees
                        </h1>
                        <div class="flex items-center gap-2" x-data="{
                            tooltipID : null,
                        }">
                            <div class="tooltip tooltip-close tooltip-left" data-tip="Print Ticket">
                                <a href="{{route('print-ticket')}}" class="btn" >
                                    <i class="fi fi-rr-print"></i>
                                </a>
                              </div>
                        </div>
                    </div>

                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Ticket Number</th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->

                            @forelse ($employees as $employee)
                                <tr>
                                    <th></th>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->ticket_number }}</td>
                                </tr>

                            @empty
                                <tr>
                                    No Attendance
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                    {!! $employees->links() !!}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

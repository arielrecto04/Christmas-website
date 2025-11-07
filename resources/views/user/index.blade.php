<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-2">



            <div class="bg-white rounded-lg shadow-lg flex flex-col gap-2">
                <div class="overflow-x-auto p-2">
                    <div class="flex items-center justify-between">
                        <h1 class="text-lg font-bold gap-2">
                            Users
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
                                <th>Role</th>
                                <th>Ticket Number</th>
                                <th>Attendance</th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->

                            @forelse ($users as $user)
                                <tr>
                                    <th></th>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            @if($role->name == 'admin')
                                            <span class="badge badge-primary">{{ $role->name }}</span>`
                                            @else
                                            <span class="badge badge-secondary">{{ $role->name }}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $user->ticket_number }}</td>
                                    <td>
                                        @if($user->attendance)
                                            {{ date('F d, Y h:s A', strtotime($user->attendance->arrival_date)) }}
                                        @else
                                            <span class="text-gray-400">No Attendance</span>
                                        @endif
                                </tr>

                            @empty
                                <tr>
                                    No Attendance
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                    {!! $users->links() !!}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

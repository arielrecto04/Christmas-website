<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-2">
            <x-container>
                <div class="flex flex-col gap-6">
                    <div class="flex flex-row">
                        <div class="join">
                            <a href="{{ route('christmas.index') }}" class="btn join-item">Surveys</a>
                            <a href="{{ route('christmas.attendance') }}" class="btn join-item">Attendance</a>
                            <a href="{{ route('christmas.vote') }}" class="btn join-item">Vote</a>
                        </div>
                    </div>
                    <div class="flex flex-col items-center gap-8">
                        <div class="w-[20rem] aspect-square">
                            <x-clock />
                        </div>
                        <form method="POST" action="{{ route('attendance.store') }}">
                            @csrf
                            <button type="submit" class="btn {{ auth()->user()->attendance ? 'btn-disabled' : '' }}">
                                {{ auth()->user()->attendance ? 'Attendance Submitted' : 'Submit Attendance' }}
                            </button>
                        </form>
                    </div>
                </div>
            </x-container>
        </div>
    </div>
</x-app-layout>
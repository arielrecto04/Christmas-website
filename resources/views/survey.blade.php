<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Survey') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-2">
            <div class="bg-white rounded-lg shadow-lg flex flex-col gap-2">
                <div>
                    <div class="join">
                        <a href="{{ route('survey.index') }}" class="btn join-item">Surveys</a>
                        <a href="{{ route('survey.vote') }}" class="btn join-item">Vote</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
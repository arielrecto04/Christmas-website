<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Vote') }}
        </h2>
    </x-slot>

<<<<<<< HEAD
    <div class="py-12">
        <div class="flex flex-col gap-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-container>
                <div class="flex flex-col gap-6">
                    <div class="flex flex-row justify-between">
                        <div class="join">
                            <a href="{{ route('christmas.survey') }}" class="btn join-item">Surveys</a>
                            <a href="{{ route('christmas.attendance') }}" class="btn join-item">Attendance</a>
                            <a href="{{ route('christmas.vote') }}" class="btn join-item">Vote</a>
                        </div>
                    </div>
                    <div>
                        <div class="overflow-x-auto">
                            <table class="table">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th>Survey Name</th>
                                        <th>Description</th>
                                        <th>Year</th>
                                        <th>You Voted</th>
                                        <th class="w-32 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($surveys as $survey)
=======
    <div x-data="{ surveyName: '', surveyId: '', openVoteModal() { this.$refs.voteModal.showModal(); } }">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-2">
                <x-container>
                    <div class="flex flex-col gap-6">
                        <x-survey-tabs />
                        <div class="flex flex-col gap-2">
                            <div class="overflow-x-auto">
                                <table class="table">
                                    <!-- head -->
                                    <thead>
                                        <tr>
                                            <th>Survey Name</th>
                                            <th>Description</th>
                                            <th>Year</th>
                                            <th>You Voted</th>
                                            <th class="w-32 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($surveys as $survey)
>>>>>>> backend
                                        <tr>
                                            <td>{{ $survey->id }}</td>
                                            <td>{{ $survey->name }}</td>
                                            <td>{{ $survey->year }}</td>
                                            <td>{{ $survey->candidates()->whereHas('votes', function ($q) {
                                                    $q->where('user_id', auth()->user()->id);
                                                })->latest()->first()->user->name ?? 'You did not vote yet.' }}
                                            </td>
                                            <td>


                                                <div class="flex justify-center">
                                                    @if (
                                                        $survey->candidates()->whereHas('votes', function ($q) {
                                                                $q->where('user_id', auth()->user()->id);
                                                            })->exists())
                                                        <button class="btn" disabled>
                                                            Already Voted
                                                        </button>
                                                    @else
                                                        <button class="btn"
                                                            onclick="vote_modal_{{ $survey->id }}.showModal()">
                                                            Vote
                                                        </button>
                                                    @endif


                                                    <dialog x-data x-ref="voteModal" id="vote_modal_{{ $survey->id }}"
                                                        class="modal">
                                                        <div class="modal-box">
                                                            <div class="flex gap-2 justify-between items-center">
                                                                <h3 class="mb-8 text-lg font-bold">Vote</h3>

                                                                <form method="dialog">
                                                                    <button class="btn btn-sm">Close</button>
                                                                </form>



                                                                <div class="grid grid-cols-3 grid-flow-row gap-2">

                                                                    @forelse ($survey->candidates as $candidate)
                                                                        <div
                                                                            class="flex flex-col gap-2 p-5 rounded-lg border-2 border-gray-500">
                                                                            <h1>{{ $candidate->user->name }}</h1>

                                                                            <p class="font-bold"># {{ $candidate->id }}
                                                                            </p>

                                                                            <form
                                                                                action="{{ route('christmas.vote.store', ['candidate_id' => $candidate->id]) }}"
                                                                                method="POST">
                                                                                @csrf

                                                                                <button class="btn btn-sm">Vote</button>
                                                                            </form>

                                                                        </div>

                                                                    @empty
                                                                        <div
                                                                            class="flex justify-center items-center p-5 w-full bg-gray-50 rounded-lg shadow-lg">
                                                                            <h1 class="text-xl font-bold capitalize">No
                                                                                Candidate</h1>
                                                                        </div>
                                                                    @endforelse
                                                                </div>



                                                            </div>
                                                    </dialog>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </x-container>
        </div>
    </div>
</x-app-layout>

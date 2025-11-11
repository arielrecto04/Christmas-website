<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vote') }}
        </h2>
    </x-slot>

    <div x-data="{ surveyName: '', surveyId: '', openVoteModal() { this.$refs.voteModal.showModal(); } }">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-2">
                <x-container>
                    <div class="flex flex-col gap-6">
                        <div class="flex flex-row justify-between">
                            <div class="join">
                                <a href="{{ route('christmas.survey') }}" class="btn join-item">Surveys</a>
                                <a href="{{ route('christmas.attendance') }}" class="btn join-item">Attendance</a>
                                <a href="{{ route('christmas.vote') }}" class="btn join-item">Vote</a>
                            </div>
                        </div>
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
                                        <tr>
                                            <td>{{ $survey->name }}</td>
                                            <td>{{ $survey->description ?? 'No Description' }}</td>
                                            <td>{{ $survey->year }}</td>
                                            <td>
                                                {{ $survey->candidates->first()->user->name }}</td>
                                            <td>
                                                <div class="flex justify-center gap-2">               
                                                    @if($survey->candidates()->whereHas('votes', function($q){
                                                    $q->where('user_id', auth()->id());
                                                    })->exists())
                                                        <button class="btn" disabled>
                                                            Vote
                                                        </button>
                                                    @else
                                                        <button class="btn"  onclick="vote_modal_{{ $survey->id }}.showModal()">
                                                            Vote
                                                        </button>
                                                    @endif
                                                    <dialog x-data x-ref="voteModal" id="vote_modal_{{ $survey->id }}" class="modal">
                                                        <div class="modal-box">
                                                            <div class="flex items-center justify-between gap-2 mb-8">
                                                                <h3 class="text-lg font-bold">Vote</h3>

                                                                <form method="dialog">
                                                                    <button class="btn btn-sm">Close</button>
                                                                </form>

                                                            </div>
                                                            <div class="grid grid-cols-3 grid-flow-row gap-2">
                                                                @forelse ($survey->candidates as $candidate)
                                                                <div class="flex flex-col gap-2 rounded-lg border-2 border-gray-500 p-5">
                                                                    <h1>{{ $candidate->user->name }}</h1>

                                                                    <p class="font-bold"># {{ $candidate->id }}</p>

                                                                    <form action="{{ route('christmas.vote.store', ['candidate_id' => $candidate->id]) }}" method="post">
                                                                        @csrf

                                                                        <button class="btn btn-sm">Vote</button>
                                                                    </form>

                                                                </div>

                                                                @empty
                                                                <div class="w-full p-5 rounded-lg shadow-lg bg-gray-50 flex items-center justify-center">
                                                                    <h1 class="text-xl font-bold capitalize">No Candidate</h1>
                                                                </div>

                                                                @endforelse
                                                            </div>
                                                    </dialog>

                                                    <button class="btn btn-error">
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-gray-500">
                                                No surveys available.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </x-container>
        </div>
    </div>

</x-app-layout>
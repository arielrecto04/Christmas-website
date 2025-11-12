<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Vote') }}
        </h2>
    </x-slot>

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
                                            <th class="w-64 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($surveys as $survey)
                                        @php
                                        $hasVoted = $survey->candidates()->whereHas('votes', function ($q) {
                                        $q->where('user_id', auth()->id());
                                        })->exists();
                                        @endphp
                                        <tr>
                                            <td>{{ $survey->id }}</td>
                                            <td>{{ $survey->name }}</td>
                                            <td>{{ $survey->year }}</td>
                                            <td>{{ $survey->candidates()->whereHas('votes', function ($q) {
                                                $q->where('user_id', auth()->user()->id);
                                                })->latest()->first()->user->name ?? 'You did not vote yet.' }}
                                            </td>
                                            <td>
                                                <div class="flex justify-center gap-2">
                                                    @if ($hasVoted)
                                                    <button class="btn" onclick="ranking_modal.showModal()">View
                                                        Ranking</button>
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
                                                            <div class="flex gap-2 mb-8 justify-between items-center">
                                                                <h3 class="text-lg font-bold">Vote</h3>

                                                                <form method="dialog">
                                                                    <button class="btn btn-sm">Close</button>
                                                                </form>

                                                            </div>
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
                                                    </dialog>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </x-container>
            </div>
        </div>
        <dialog x-data x-ref="rankingModal" id="ranking_modal" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold mb-8">Hello!</h3>
                <div class="modal-action">
                    <button class="btn" @click="$refs.rankingModal.close()">Close</button>
                </div>
            </div>
        </dialog>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Vote') }}
        </h2>
    </x-slot>

    <div x-data="{ surveyName: '', surveyId: '', openVoteModal() { this.$refs.voteModal.showModal(); } }">

        <div class="py-12">
            <div class="flex flex-col gap-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <x-container>
                    <div class="flex flex-col gap-6">
                        <x-survey-tabs />


                        @if (Session::has('error'))
                            <div class="alert alert-error">
                                <div class="flex gap-2 item-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-current shrink-0"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span>{{ Session::get('error') }}</span>
                                </div>
                            </div>
                        @endif
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
                                                $hasVoted = $survey
                                                    ->candidates()
                                                    ->whereHas('votes', function ($q) {
                                                        $q->where('user_id', auth()->id());
                                                    })
                                                    ->exists();
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
                                                    <div class="flex gap-2 justify-center">
                                                        @if ($hasVoted)
                                                            <button class="btn"
                                                                onclick="ranking_modal_{{ $survey->id }}.showModal()">View
                                                                Ranking</button>

                                                            <dialog id="ranking_modal_{{ $survey->id }}"
                                                                class="modal" x-data="rankingData()">
                                                                <div class="w-11/12 max-w-5xl modal-box"
                                                                    x-init="getRankingData({{ $survey->id }})">
                                                                    <h3 class="mb-6 text-2xl font-bold text-center">
                                                                        {{ $survey->name }} Voting Results</h3>
                                                                    <div class="overflow-x-auto">
                                                                        <table class="table w-full">
                                                                            <thead>
                                                                                <tr class="text-lg">
                                                                                    <th class="w-16">Rank</th>
                                                                                    <th>Candidate</th>
                                                                                    <th class="text-right">Votes</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                                <template
                                                                                    x-for="ranking, index in rankings">



                                                                                    <tr class="hover"
                                                                                        :key="index">

                                                                                        <template x-if="index == 0">

                                                                                            <td
                                                                                                class="text-2xl font-bold text-amber-400">

                                                                                                <div
                                                                                                    class="flex justify-center items-center">


                                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                        class="w-8 h-8"
                                                                                                        viewBox="0 0 20 20"
                                                                                                        fill="currentColor">

                                                                                                        <path
                                                                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />

                                                                                                    </svg>




                                                                                                </div>

                                                                                            </td>
                                                                                        </template>

                                                                                        <template x-if="index == 1">

                                                                                            <td
                                                                                                class="text-2xl font-bold text-gray-500">

                                                                                                <div
                                                                                                    class="flex justify-center items-center">


                                                                                                    <div
                                                                                                        class="flex justify-center items-center">

                                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                            class="w-6 h-6"
                                                                                                            viewBox="0 0 20 20"
                                                                                                            fill="currentColor">

                                                                                                            <path
                                                                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />

                                                                                                        </svg>

                                                                                                    </div>



                                                                                                </div>

                                                                                            </td>
                                                                                        </template>

                                                                                        <template x-if="index == 2">
                                                                                            <td
                                                                                                class="text-2xl font-bold text-amber-600">

                                                                                                <div
                                                                                                    class="flex justify-center items-center">

                                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                        class="w-5 h-5"
                                                                                                        viewBox="0 0 20 20"
                                                                                                        fill="currentColor">

                                                                                                        <path
                                                                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />

                                                                                                    </svg>

                                                                                                </div>

                                                                                            </td>
                                                                                        </template>

                                                                                        <template x-if="index > 2">
                                                                                            <td
                                                                                                class="text-lg font-semibold text-center">

                                                                                                <span
                                                                                                    x-text="index + 1"></span>
                                                                                            </td>

                                                                                        </template>

                                                                                        <td
                                                                                            class="text-lg font-semibold">

                                                                                            <span
                                                                                                x-text="ranking.user.name"></span>
                                                                                        </td>

                                                                                        <td class="text-right">

                                                                                            <span
                                                                                                class="px-3 py-1 font-semibold text-white bg-blue-500 rounded-full">

                                                                                                <span
                                                                                                    x-text="ranking.votes.length"></span>
                                                                                                votes

                                                                                            </span>

                                                                                        </td>

                                                                                    </tr>






                                                                                </template>





                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="flex justify-end mt-6">
                                                                        <button class="btn"
                                                                            onclick="ranking_modal_{{ $survey->id }}.close()">
                                                                            Close
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </dialog>

                                                            <button class="btn" disabled>
                                                                Already Voted
                                                            </button>
                                                        @else
                                                            <button class="btn"
                                                                onclick="vote_modal_{{ $survey->id }}.showModal()">
                                                                Vote
                                                            </button>
                                                        @endif


                                                        <dialog x-data x-ref="voteModal"
                                                            id="vote_modal_{{ $survey->id }}" class="modal">
                                                            <div class="modal-box">
                                                                <div
                                                                    class="flex gap-2 justify-between items-center mb-8">
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

                                                                            <p class="font-bold">#
                                                                                {{ $candidate->id }}
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




        @push('js')
            <script>
                const rankingData = () => ({
                    rankings: [],
                    getRankingData(surveyId) {
                        axios.get(`/christmas/ranking/${surveyId}`)
                            .then(response => {
                                this.rankings = response.data.ranking;
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    }
                });
            </script>
        @endpush
</x-app-layout>

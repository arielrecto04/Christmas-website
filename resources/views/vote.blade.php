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
                                        <tr>
                                            <td>{{ $survey->name }}</td>
                                            <td>{{ $survey->description }}</td>
                                            <td>{{ $survey->year }}</td>
                                            <td
                                                class="{{ $survey->voted_candidate_name === 'Not Yet Voted' ? 'text-gray-500' : '' }}">
                                                {{ $survey->voted_candidate_name }}</td>
                                            <td>
                                                <div class="flex justify-center">
                                                    <button
                                                        class="btn {{ $survey->voted_candidate_name !== 'Not Yet Voted' ? 'btn-disabled' : '' }}"
                                                        @click="surveyName = '{{ $survey->name }} {{ $survey->year }}'; surveyId = '{{ $survey->id }}'; openVoteModal()">
                                                        Vote
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
                            {{ $surveys->links() }}
                        </div>
                    </div>
                </x-container>
            </div>
        </div>
        <dialog x-ref="voteModal" id="vote_modal" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold mb-8">Vote</h3>
                <form method="POST" action="{{ route('vote.store') }}">
                    @csrf

                    <input type="hidden" name="survey_id" :value="surveyId" />

                    <div class="flex flex-col gap-6">
                        <div class="flex flex-col gap-2">
                            <label for="survey" class="label-text font-semibold">Survey Type</label>
                            <input type="text" :value="surveyName" class="input input-bordered w-full" disabled />
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="candidates" class="label-text font-semibold">Candidates</label>
                            <select class="select select-bordered w-full" id="candidates" name="candidate_id">
                                <option selected disabled>Select a user</option>
                                @foreach($attendees as $attendance)
                                <option value="{{ $attendance->user->id }}">{{ $attendance->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-action">
                        <button type="button" class="btn" @click="$refs.voteModal.close()">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </dialog>
    </div>
</x-app-layout>
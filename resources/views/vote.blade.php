<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vote') }}
        </h2>
    </x-slot>

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
                                        <td>{{ $survey->description }}</td>
                                        <td>{{ $survey->year }}</td>
                                        <td>{{ $survey->voted_candidate_name }}</td>
                                        <td>
                                            <div class="flex justify-center">
                                                <button class="btn" onclick="vote_modal.showModal()">Vote</button>
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
    <dialog x-data x-ref="voteModal" id="vote_modal" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-8">Vote</h3>
            <form method="POST" action="{{ route('survey.store') }}">
                @csrf

                <div class="flex flex-col gap-2">
                    <label for="candidates">Candidates</label>
                    <select class="select select-bordered w-full" id="candidates">
                        <option selected>Who shot first?</option>
                        <option>Han Solo</option>
                        <option>Greedo</option>
                    </select>
                </div>
                <div class="modal-action">
                    <button type="button" class="btn" @click="$refs.voteModal.close()">Close</button>
                </div>
            </form>
        </div>
    </dialog>
</x-app-layout>
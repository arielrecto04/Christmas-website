<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Survey') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-2">
            <x-container>
                <div class="flex flex-col gap-6">
                    <div class="flex flex-row justify-between">
                        <x-survey-tabs />
                        <button class="btn" onclick="add_survey_modal.showModal()">Add Survey</button>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Survey Name</th>
                                        <th>Description</th>
                                        <th class="w-32 text-center">Active</th>
                                        <th class="w-48 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($surveys as $survey)
                                    <tr>
                                        <td>{{ $survey->name }}</td>
                                        <td>{{ $survey->description }}</td>
                                        <td 
                                            class="text-center" 
                                            x-data="toggleActiveSurvey({{ $survey->id }}, 
                                            {{ $survey->is_active ? '
                                            true' 
                                            : 
                                            'false' 
                                            }})"
                                        >
                                            <input 
                                                type="checkbox" 
                                                x-model="is_active"
                                                @change="toggle()" 
                                                class="toggle" {{ $survey->is_active ? 'checked' :
                                            ''}}
                                            />
                                        </td>
                                        <td>
                                            <div class="flex flex-row justify-center gap-2">
                                                <button class="btn" onclick="edit_survey_{{ $survey->id }}_modal.showModal()">
                                                    <svg id='Edit_Write_2_20' width='20' height='20' viewBox='0 0 20 20'
                                                        xmlns='http://www.w3.org/2000/svg'
                                                        xmlns:xlink='http://www.w3.org/1999/xlink'>
                                                        <rect width='20' height='20' stroke='none' fill='#000000'
                                                            opacity='0' />


                                                        <g transform="matrix(1.14 0 0 1.14 10 10)">
                                                            <g style="">
                                                                <g transform="matrix(1 0 0 1 2 -1.98)">
                                                                    <path
                                                                        style="stroke: rgb(0,0,0); stroke-width: 1; stroke-dasharray: none; stroke-linecap: round; stroke-dashoffset: 0; stroke-linejoin: round; stroke-miterlimit: 4; fill: none; fill-rule: nonzero; opacity: 1;"
                                                                        transform=" translate(-9, -5.02)"
                                                                        d="M 7.5 9 L 4.5 9.54 L 5 6.5 L 10.73 0.79 C 10.917766599905557 0.6006873491769036 11.173362463629442 0.49420167565833006 11.440000000000001 0.49420167565833006 C 11.70663753637056 0.49420167565833006 11.962233400094444 0.6006873491769037 12.15 0.7900000000000001 L 13.21 1.85 C 13.399312650823097 2.037766599905556 13.50579832434167 2.2933624636294416 13.50579832434167 2.5599999999999996 C 13.50579832434167 2.826637536370558 13.399312650823097 3.0822334000944442 13.21 3.2700000000000005 Z"
                                                                        stroke-linecap="round" />
                                                                </g>
                                                                <g transform="matrix(1 0 0 1 -0.75 0.75)">
                                                                    <path
                                                                        style="stroke: rgb(0,0,0); stroke-width: 1; stroke-dasharray: none; stroke-linecap: round; stroke-dashoffset: 0; stroke-linejoin: round; stroke-miterlimit: 4; fill: none; fill-rule: nonzero; opacity: 1;"
                                                                        transform=" translate(-6.25, -7.75)"
                                                                        d="M 12 9.5 L 12 12.5 C 12 13.052284749830793 11.552284749830793 13.5 11 13.5 L 1.5 13.5 C 0.9477152501692065 13.5 0.5 13.052284749830793 0.5 12.5 L 0.5 3 C 0.5 2.4477152501692068 0.9477152501692065 2 1.5 2 L 4.5 2"
                                                                        stroke-linecap="round" />
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </button>
                                                <dialog id="edit_survey_{{ $survey->id }}_modal" class="modal">
                                                    <div class="modal-box">
                                                        <h3 class="text-lg font-bold mb-8">Edit Survey</h3>
                                                        <form method="POST" action="{{ route('survey.update', ['survey_id' => $survey->id]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="flex flex-col gap-6">
                                                                <div class="flex flex-col gap-2">
                                                                    <label for="survey-name" class="label-text font-semibold">Name</label>
                                                                    <input 
                                                                        type="text" 
                                                                        name="name" 
                                                                        placeholder="Enter survey name" 
                                                                        id="survey-name"
                                                                        value="{{ $survey->name }}"
                                                                        class="input input-bordered w-full" 
                                                                    />
                                                                </div>
                                                                <div class="flex flex-col gap-2">
                                                                    <label for="description" class="label-text font-semibold">Description</label>
                                                                    <input 
                                                                        type="text" 
                                                                        name="description" 
                                                                        placeholder="Enter survey description" 
                                                                        value="{{ $survey->description }}"
                                                                        id="description"
                                                                        class="input input-bordered w-full" 
                                                                    />
                                                                </div>
                                                                <div class="flex flex-col gap-2">
                                                                    <label class="label-text font-semibold">Candidates</label>
                                                                    <div class="grid grid-cols-2 gap-1">
                                                                        @foreach ($users as $user)
                                                                            <label class="flex items-center gap-2">
                                                                                <input 
                                                                                    type="checkbox" 
                                                                                    name="candidates[]" 
                                                                                    value="{{ $user->id }}"
                                                                                    @if(in_array($user->id, $survey->candidates->pluck('user_id')->toArray())) checked @endif
                                                                                    class="checkbox checkbox-primary"
                                                                                >
                                                                                <span>{{ $user->name }}</span>
                                                                            </label>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            <div class="modal-action">
                                                                <button type="button" class="btn" onClick="edit_survey_{{ $survey->id }}_modal.close()">Close</button>
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </dialog>
                                                <form method="POST"
                                                    action="{{ route('surveys.destroy', $survey->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn">
                                                        <svg id='Trash_20' width='20' height='20' viewBox='0 0 20 20'
                                                            xmlns='http://www.w3.org/2000/svg'
                                                            xmlns:xlink='http://www.w3.org/1999/xlink'>
                                                            <rect width='20' height='20' stroke='none' fill='#000000'
                                                                opacity='0' />


                                                            <g transform="matrix(0.8 0 0 0.8 10 10)">
                                                                <path
                                                                    style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                                    transform=" translate(-12, -12)"
                                                                    d="M 10 2 L 9 3 L 4 3 L 4 5 L 20 5 L 20 3 L 15 3 L 14 2 L 10 2 z M 5 7 L 5 20 C 5 21.1 5.9 22 7 22 L 17 22 C 18.1 22 19 21.1 19 20 L 19 7 L 5 7 z M 8 9 L 10 9 L 10 20 L 8 20 L 8 9 z M 14 9 L 16 9 L 16 20 L 14 20 L 14 9 z"
                                                                    stroke-linecap="round" />
                                                            </g>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-gray-500">
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
    <dialog id="add_survey_modal" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-8">Add Survey</h3>
            <form method="POST" action="{{ route('survey.store') }}">
                @csrf

                @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="flex flex-col gap-6">
                    <h3>Survey</h3>
                    <div class="flex flex-col gap-2">
                        <label for="survey-name" class="label-text font-semibold">Name</label>
                        <input type="text" name="name" placeholder="Enter survey name" id="survey-name"
                            class="input input-bordered w-full" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="description" class="label-text font-semibold">Description</label>
                        <input type="text" name="description" placeholder="Enter survey description" id="description"
                            class="input input-bordered w-full" />
                    </div>
                    <div class="flex flex-col gap-2 items-start">
                        <label class="label cursor-pointer gap-2">
                            <input type="checkbox" name="is_active" checked="checked" class="checkbox" />
                            <span class="label-text">Active</span>
                        </label>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="candidates">Candidates</label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach ($users as $user)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="candidates[]" value="{{ $user->id }}" class="checkbox">
                                    <span>{{ $user->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-action">
                    <button type="button" class="btn" onClick="add_survey_modal.close()">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </dialog>



    @push('js')
    <script>

        const toggleActiveSurvey = (id, currentState) => ({
            is_active:currentState,

            async toggle() {
                axios.post(`/survey/${id}/toggle`, {
                    is_active: this.is_active
                })
                .then(response => {
                    console.log('Survey toggled successfully:', response.data);
                })
                .catch(error => {
                    console.error('Survey toggled error', error);
                })
            }


        })

    </script>

    @endpush
</x-app-layout>
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
                        <div class="join">
                            <a href="{{ route('christmas.survey') }}" class="btn join-item">Surveys</a>
                            <a href="{{ route('christmas.attendance') }}" class="btn join-item">Attendance</a>
                            <a href="{{ route('christmas.vote') }}" class="btn join-item">Vote</a>
                        </div>
                        <button class="btn" onclick="add_survey_modal.showModal()">Add Survey</button>
                    </div>
                    <div>
                        <div class="overflow-x-auto">
                            <table class="table">
                                <!-- head -->
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
                                        <td class="text-center">
                                            <input type="checkbox" class="toggle" {{ $survey->is_active ? 'checked' :
                                            ''}}/>
                                        </td>
                                        <td>
                                            <div class="flex flex-row justify-center gap-2">
                                                <button class="btn">
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
                                                <button class="btn">
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
                    </div>
                </div>
            </x-container>
        </div>
    </div>
    <dialog x-data id="add_survey_modal" x-ref="addSurveyModal" class="modal">
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
                </div>
                <div class="modal-action">
                    <button type="button" class="btn" @click="$refs.addSurveyModal.close()">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </dialog>
</x-app-layout>
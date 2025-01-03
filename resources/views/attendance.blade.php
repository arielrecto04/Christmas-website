<x-landing>
    <form action="{{ route('attendance.store') }}" method="POST"
        class="flex flex-col gap-10 bg-white shadow-lg rounded-lg w-full md:w-1/2 lg:w-2/5 z-20" x-data="timeIn">

        @csrf

        <h1 class="text-4xl text-center py-4 font-bold text-white tracking-wider uppercase bg-red-500 rounded-t-lg">
            Attendance
        </h1>

        <div class="flex item-center justify-center">
            <div class="w-[20rem] aspect-square z-10">
                <x-clock />
            </div>
        </div>




        {{-- <div class="flex flex-col gap-2">
            <label for="" class="text-gray-400">Arrival Time</label> --}}
        <input x-ref="timeContainer" type="hidden" name="arrival_date" class="input border-red-500">
        {{-- </div> --}}


        <input type="hidden" name="selected_employee" x-model="JSON.stringify(selectedEmployee)">
        <label class="form-control w-full">



            <div class="flex flex-col gap-3 p-5">
                @if (Session::has('error'))
                    <p class="text-xs text-error">
                        {{ Session::get('error') }}
                    </p>
                @endif

                <p x-text="error?.hasAttendance" class="text-xs text-error">

                </p>
                <div x-show="selectedEmployee">
                    <div
                        class="flex p-5 rounded-lg shadow-lg justify-between items-center hover:scale-105 hover:shadow-red-500 duration-700">
                        <h1 x-text="selectedEmployee?.name" class="text-lg font-bold"></h1>

                        <button type="button" @click="selectedEmployee = null" class="btn btn-error btn-xs">
                            x
                        </button>
                    </div>

                </div>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 grid-flow-row items-center gap-2 w-full p-5">
                <div class="relative group" x-show="!selectedEmployee">
                    <button @click="toggleDropdown" type="button"
                        class="inline-flex justify-center w-full
                         px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-red-500 
                         rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2
                          focus:ring-offset-gray-100 focus:ring-blue-500">


                        <span class="mr-2 text-red-500 text-sm md:text-base lg:text-xl" x-show="!isOpen">Find your name</span>
                        <span class="mr-2 text-red-500 text-sm md:text-base lg:text-xl" x-show="isOpen">Find your name</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="isOpen" x-init=" laodEmployees({{ json_encode($employees) }})"
                        class="absolute rigth-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5
                        w-full p-1 space-y-1 overflow-y-auto max-h-44">
                        <!-- Search input -->
                        <input id="search-input"
                            class="block w-full sticky top-0 px-4 py-2 text-gray-800 border rounded-md  border-gray-300 focus:outline-none"
                            type="text" x-model.debounce="search" placeholder="Search..." autocomplete="off">
                        <!-- Dropdown content goes here -->
                        <template x-if="!search">
                            <template x-for="employee in employees">
                                <button type="button" @click="pickEmployee(employee)"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 
                                     w-full active:bg-blue-100 cursor-pointer rounded-md">
                                    <span x-text="employee.name"></span>
                                </button>
                            </template>
                        </template>
                        <template x-if="search">
                            <template x-for="employee in results">
                                <button type="button" @click="pickEmployee(employee)"
                                    class="block px-4 py-2
                                    w-full text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">
                                    <span x-text="employee.name"></span>
                                </button>
                            </template>
                        </template>


                    </div>
                </div>
                <template x-if="selectedEmployee?.attendance == null">
                    <button class="btn btn-error  text-white text-sm lg:text-xl">Submit</button>
                </template>

                <template x-if="selectedEmployee?.attendance != null">
                    <button class="btn btn-error text-sm lg:text-xl" disabled>Submit</button>
                </template>
            </div>

        </label>
        {{-- <div class="flex flex-col gap-2">
            <label for="" class="text-gray-400">Full Name</label>
            <input type="text" class="input border-red-500" disabled placeholder="ex: Ariel Recto">
        </div> --}}




    </form>

    @push('js')
        <script>
            const timeIn = () => ({
                initTime: null,
                employees: [],
                search: null,
                results: [],
                isOpen: false,
                selectedEmployee: null,
                error: {

                },
                init() {
                    const timeInEl = this.$refs.timeContainer;

                    timeInEl.value = new Date();

                    // const dropdownButton = document.getElementById('dropdown-button');
                    // const dropdownMenu = document.getElementById('dropdown-menu');
                    // const searchInput = document.getElementById('search-input');



                    this.$watch('search', () => {
                        this.results = [...this.employees.filter((item) => {
                            const text = item.name.toLowerCase();
                            if (text.includes(this.search.toLowerCase())) {
                                return item;
                            }
                        })];

                    })

                    this.$watch('selectedEmployee', () => {
                        if (this.selectedEmployee.attendance != null) {
                            this.error = {
                                hasAttendance: 'You have attendance already'
                            }
                        }
                    });
                },
                laodEmployees(data) {

                    this.employees = [...data];
                },
                toggleDropdown() {
                    this.isOpen = !this.isOpen;
                },
                pickEmployee(data) {
                    this.selectedEmployee = {
                        ...data
                    };



                    // this.search = null;

                    // this.results = []
                }
            })
        </script>
    @endpush
</x-landing>

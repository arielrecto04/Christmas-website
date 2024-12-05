<x-app-layout>

    <div class="py-12" x-data="printItem">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-2">
            <div class="bg-white rounded-lg show-lg flex flex-col gap-2 p-5">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold uppercase">Tickets</h1>

                    <div x-ref="actionContainer">
                        <button @click="print" class="btn">
                            <i class="fi fi-rr-print"></i>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-4 grid-flow-row gap-5">
                    @foreach ($employeesTicket as $ticket)
                        <p class="p-5 rounded-lg border">
                            {{$ticket->ticket_number}}
                        </p>
                    @endforeach
                </div>
            </div>
        
        </div>
    </div>
   


    @push('js')
        <script>
            const printItem = () => ({
                print(){
                    const navEl = document.getElementById('nav');
                    const actionCon = this.$refs.actionContainer;
                    navEl.classList.add('hidden');
                    actionCon.classList.add('hidden');


                    window.print()

                    navEl.classList.remove('hidden')
                    actionCon.classList.remove('hidden')
                }
            });
        </script>
    @endpush
</x-app-layout>

<x-app-layout>
    <div class="max-w-7xl py-6 mx-auto px-2 sm:px-6 lg:px-8">



        <div class="mb-4">
            <Strong class="text-indigo-500">Turnos en cola: </Strong><input id="AmountShifts" type="button"
                value="{{ $ShiftList }}"
                class="rounded-full py-2 px-4 mb-4 border-2 border-indigo-500 bg-gray-100 text-indigo-500">
        </div>

        <!-- This example requires Tailwind CSS v2.0+ -->

        @if (session('info'))
            <div class="bg-green-500 mb-4">
                <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between flex-wrap">
                        <div class="w-0 flex-1 flex items-center">
                            <p class="ml-3 font-medium text-white truncate">
                                <span class="md:hidden">
                                    {{ session('info') }}
                                </span>
                                <span class="hidden md:inline">
                                    {{ session('info') }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="mb-4">

            @if (isset($shift))
                @if ($shift[0]->status != '1')
                    <a href="{{ route('shifts.callNext') }}"><input class="bg-blue-300 px-4 py-2 rounded"
                            type="button" value="SIGUIENTE"></a>
                @else
                    <input class="px-4 py-2 rounded" type="button" value="SIGUIENTE">
                @endif

            @endif

            <a href="{{ route('shifts.callAgain') }}"><input class="bg-yellow-500 px-4 py-2 ml-4 rounded"
                    type="button" value="LLAMAR"></a>

            <a href="{{ route('shifts.cancel') }}"><input class="float-right bg-red-500 px-4 ml-4 py-2 rounded"
                    type="button" value="CANCELAR"></a>
            <a href="{{ route('shifts.attented') }}"><input class="float-right bg-green-300 px-4 py-2 rounded"
                    type="button" value="ATENDIDO"></a>

        </div>

        <div>
            <!-- This example requires Tailwind CSS v2.0+ -->

            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">

                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            CODIGO DEL TICKET
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            PUESTO
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            PRIORIDAD
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        @if (isset($shift[0]) && $shift[0] != null)
                                                            {{ $shift[0]->ticket_code }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            @if (isset($shift) && $shift != null)
                                                {{ $shift[0]->place }}
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            @if (isset($shift) && $shift != null)
                                                {{ $shift[0]->priority }}
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- More items... -->
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <form action="{{route('shifts.update')}}" method="GET">
           
            <select class="rounded mt-12" name="canceled_shifts" id="canceled_shifts">
                <option value="">-- Turnos cancelados --</option>
                @foreach ($canceledListShift as $shift2)
                    <option value="{{ $shift2->id }}">{{ $shift2->ticket_code }}</option>
                @endforeach
            </select>

            @if (isset($shift))
                @if ($shift[0]->status != '1')
                    <input class="bg-green-300 px-4 py-2 rounded" type="submit" value="Cambiar a atendido">
                @else
                    <input class="px-4 py-2 rounded" type="button" value="Cambiar a atendido">
                @endif

            @endif

        </form>
       
            

    </div>

    <script>
        window.Echo.channel('listOfShiftsUpdated')
            .listen('AmountOfShiftsUpdated', (e) => {
                console.log(e.totalShifts);

                let shifts = document.getElementById('AmountShifts');
                shifts.value = e.totalShifts;
            });

    </script>
</x-app-layout>

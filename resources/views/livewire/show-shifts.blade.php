<div>   
        <div>
           <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">         

                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    CODIGO DEL TICKET
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    PUESTO
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    PRIORIDAD
                                    </th>
                                </tr>
                            </thead>

                            @foreach ($shifts as $shift)

                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr @if ($loop->first) class="bg-blue-600" @endif>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{$shift->ticket_code}}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{$shift->place}}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{$shift->priority}}
                                        </td>
                                    </tr>
                                <!-- More items... -->
                                </tbody>
                            @endforeach

                        </table>
                    </div>
                </div>
                </div>
            </div>
   
        </div>
</div>

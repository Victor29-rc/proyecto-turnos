<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}"></script>

        <title>Document</title>
    </head>

    <body>
        <main>
            <div class="grid lg:grid-cols-5 gap-6 mt-2 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:col-span-5">
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

                                           {{--  @foreach ($shifts as $shift) --}}

                                                <tbody id="show_tickets" class="bg-white divide-y divide-gray-200">
                                                   {{--  <tr id="shift" @if ($loop->first) class="bg-blue-300" @endif>
                                                        <td class="px-6 py-4">
                                                            <div class="flex items-center">
                                                                <div class="ml-4">
                                                                    <div id="ticket_code" class="text-sm font-medium text-gray-900">
                                                                       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td id="place" class="px-6 py-4 text-sm text-gray-500">
                                                            
                                                        </td>

                                                        <td id="priority" class="px-6 py-4 text-sm text-gray-500">
                                                           
                                                        </td>
                                                    </tr> --}}



                                                    <!-- More items... -->
                                                </tbody>
                                           {{--  @endforeach --}}

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </main>

        <script>
            window.Echo.channel('listOfShiftsUpdated')

                .listen('ShiftAssignedToUser', (e) => {
                    
                    let shifts = document.getElementById("show_tickets");
                    shifts.innerHTML = "";

                    let count = 0;

                    e.shifts.forEach(element => {

                        let row = document.createElement("tr");
                        if(count == 0){
                            row.className = "bg-blue-300";

                            var code = element.ticket_code;
                            var place = element.place;

                            let utterance = new SpeechSynthesisUtterance(code +", puesto, "+ place);
                            speechSynthesis.speak(utterance);
                        }

                        count++;

                        let cell_ticket = document.createElement("td");
                            cell_ticket.className += "px-6 py-4 text-sm text-gray-500";    

                        let cell_place = document.createElement("td");
                            cell_place.className += "px-6 py-4 text-sm text-gray-500";

                        let cell_priority = document.createElement("td");
                            cell_priority.className += "px-6 py-4 text-sm text-gray-500";

                        let value_ticket = document.createTextNode(element.ticket_code);
                        let value_place = document.createTextNode(element.place);
                        let value_priority = document.createTextNode(element.priority);

                        cell_ticket.appendChild(value_ticket);
                        cell_place.appendChild(value_place);
                        cell_priority.appendChild(value_priority);

                        row.appendChild(cell_ticket);
                        row.appendChild(cell_place);
                        row.appendChild(cell_priority);
                        
                        shifts.appendChild(row);
                        
                    });
                });
        </script>
    </body>

    </html>
</x-app-layout>

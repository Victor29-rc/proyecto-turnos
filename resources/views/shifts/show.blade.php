<x-app-layout>
    <div class="max-w-7xl py-6 mx-auto px-2 sm:px-6 lg:px-8">
        <div class="grid-cols-1">

            <div class="mb-4">
                <a href="{{route('shifts.callAgain')}}"><input class="bg-green-300 px-4 py-2 rounded" type="button" value="LLAMAR"></a>
                <a href="{{route('shifts.callNext')}}"><input class="bg-blue-300  px-4 py-2 ml-4 rounded" type="button" value="SIGUIENTE"></a>
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

                                <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            @if (isset($shift[0]) && $shift[0] != null)
                                                                {{$shift[0]->ticket_code}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                @if (isset($shift) && $shift != null)
                                                    {{$shift[0]->place}}
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                @if (isset($shift) && $shift != null)
                                                    {{$shift[0]->priority}}
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
        </div>
    </div>
</x-app-layout>
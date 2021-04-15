<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            
            <link rel="stylesheet" href="{{ mix('css/app.css') }}">

            <title>Document</title>
        </head>
        <body>
            <main>
                <div class="grid lg:grid-cols-5 gap-6 mt-2 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="lg:col-span-3">
                        @livewire('show-shifts', ['shifts' => $shifts])
                    </div>  
            
                    <div class="lg:col-span-2 bg-red-300">
                        Anuncios
                    </div>
                </div>
            </main>
        </body>
    </html>
</x-app-layout>
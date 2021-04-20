<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body class=" m-0 h-screen bg-white-300">
    <div style="background-color: rgb(31, 41, 55)" class=" font-bold text-2xl h-20 text-white mx-auto px-4 sm:px-6 lg:px-8">
        <div class="">Sistema de turnos</div> 
    </div>

    <div class="container h-5/6 mx-auto mt-4 rounded grid-cols-1 drop-shadow-2xl">

        <div class="bg-gray-100 h-5/6 rounded mt-2">
            <form class="h-full w-full" action="{{ route('shifts.store') }}" method="post" >
                @method('put')
                @csrf
                
                
                <div class="text-center">
                    <input class="font-medium my-10 t-14 w-2/6 px-6 py-2 bg-blue-300 rounded text-black text-base" type="submit" value="Tomar turno">  
                    
                    <select class=" rounded w-5/6" name="category" id="">
                        <option value="">
                            -- Seleccione una opción --
                        </option>
        
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select><br>       
                    
                    @error('category')
                        <br><span>{{ $message }}</span>
                    @enderror
                </div>
                   
            </form>
        </div>
    </div>

</body>

</html>

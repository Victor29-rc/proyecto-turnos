<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>

    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <form action="{{route('shifts.store')}}" method="post">
            @method('put')
            @csrf

            <select name="category" id="">
                <option value="">
                    -- Seleccione una opción --
                </option>

                @foreach ($categories as $category)
                    <option value="{{$category->id}}">
                        {{$category->name}}
                    </option>
                @endforeach
            </select><br>

            <input class="bg-blue-600 rounded py-2 px-4 my-6" type="submit" value="Tomar turno">

            @error('category')
                <br><span>{{$message}}</span>
            @enderror
        </form>
    </div>

</body>
</html>
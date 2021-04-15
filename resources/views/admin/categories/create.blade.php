@extends('adminlte::page')

@section('title', 'Sistema de turnos - Admin')

@section('content_header')
    <h1>Crear categoría</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.categories.store']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la categoría']) !!}
                </div>

                @error('name')
                    <span class="text-danger">{{$message}}</span><br><br>
                @enderror

                <div class="form-group">
                    {!! Form::label('priority', 'Prioridad') !!}
                    {!! Form::text('priority', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nivel de prioridad']) !!}
                </div>

                @error('priority')
                    <span class="text-danger">{{$message}}</span><br><br>
                @enderror

                {!! Form::submit('Crear categoría', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

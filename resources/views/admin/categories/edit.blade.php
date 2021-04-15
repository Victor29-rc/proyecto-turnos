@extends('adminlte::page')

@section('title', 'Sistema de turnos - Admin')

@section('content_header')
    <h1>Editar categoría</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif

        <div class="card">
            <div class="card-body">
                {!! Form::model($category, ['route' => ['admin.categories.update', $category], 'method' => 'put']) !!}
        
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
        
                    {!! Form::submit('Actualizar categoría', ['class' => 'btn btn-primary']) !!}
        
                {!! Form::close() !!}
            </div>
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
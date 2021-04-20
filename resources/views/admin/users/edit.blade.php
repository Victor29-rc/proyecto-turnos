@extends('adminlte::page')

@section('title', 'Sistema de turnos - Admin')

@section('content_header')
    <h1>Editar usuario</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif

        <div class="card">
            <div class="card-body">
                {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}
        
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del usuario']) !!}
                </div>

                @error('name')
                    <span class="text-danger">{{$message}}</span><br><br>
                @enderror

                <div class="form-group">
                    {!! Form::label('id_document', 'Cedula') !!}
                    {!! Form::text('id_document', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la cedula del usuario (sin gruiones)']) !!}
                </div>

                @error('id_document')
                    <span class="text-danger">{{$message}}</span><br><br>
                @enderror

                <div class="form-group">
                    {!! Form::label('phone', 'Teléfono') !!}
                    {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el telefono del usuario (sin gruiones)']) !!}
                </div>

                @error('phone')
                    <span class="text-danger">{{$message}}</span><br><br>
                @enderror

                <div class="form-group">
                    {!! Form::label('email', 'Correo') !!}
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el correo electrónico del usuario']) !!}
                </div>

                @error('email')
                    <span class="text-danger">{{$message}}</span><br><br>
                @enderror

                <div class="form-group">
                    {!! Form::label('email', 'Contraseña') !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Ingrese la contraseña del usuario']) !!}
                </div>

                @error('password')
                    <span class="text-danger">{{$message}}</span><br><br>
                @enderror

                <div class="form-group">
                    {!! Form::label('place', 'Puesto') !!}
                    {!! Form::text('place', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el puesto del usuario']) !!}
                </div>

                @error('place')
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
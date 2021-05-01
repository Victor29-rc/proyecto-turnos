@extends('adminlte::page')

@section('title', 'Sistema de turnos - Admin')

@section('content_header')
    <h1>Crear usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <h2 class="h5">
                Listado de roles
            </h2>

            {!! Form::open(['route' => 'admin.users.store']) !!}

                @foreach ($roles as $role)
                    <div>
                        <label>
                            {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                            {{$role->name}}
                        </label>
                    </div>
                @endforeach

                <h2 class="h5">
                    Datos del usuario
                </h2>

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

                {!! Form::submit('Crear usuario', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
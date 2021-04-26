@extends('adminlte::page')

@section('title', 'Sistema de turnos - Admin')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.users.create')}}">Agregar Usuario</a>
    <h1>Lista de categorías</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif

    <div class="card">

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cedula</th>
                        <th>Telefono</th>
                        <th>Mail</th>
                        <th>Puesto</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->id_document }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->place }}</td>
                            <td width="10px">
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('admin.users.edit', $user) }}">Editar
                                </a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.users.destroy', $user) }}" method="post">
                                    @method('delete')
                                    @csrf

                                    <input class="btn btn-danger btn-sm" type="submit" value="Eliminar">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@extends('adminlte::page')

@section('title', 'Sistema de turnos - Admin')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.categories.create')}}">Agregar categoría</a>
    <h1>Generar reportes</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            <input class="date form-control" type="text">

            <script type="text/javascript">
                $('.date').datepicker({  
                   format: 'mm-dd-yyyy'
                 });  
            </script> 
        </div>
    </div>
@stop

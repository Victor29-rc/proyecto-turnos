@extends('adminlte::page')

@section('title', 'Sistema de turnos - Admin')

@section('plugins.Daterangepicker', true)

@section('content_header')
    <h1>Generar reportes</h1>
@stop

@section('content')

    <div class="card ">
        <div class="card-body">
            <form class="h-96" action="{{ route('admin.reports.create') }}" method="get">
                <fieldset>
                    <legend>Tipo de reporte</legend>
                    
                    <input type="radio" name="report_type" id="resumed" value="resumed" checked="checked">
                    <label for="resumed">Resumido</label>
                    
                    
                   {{--  <input class="ml-4" type="radio" name="report_type" value="detailed" id="detailed">
                    <label for="detailed">Detallado</label> --}}

                </fieldset>

                <label for="reportrange">Elija el rango de fechas</label><br>
                <input class="inline-block" type="text" id="reportrange" name="reportrange"
                    style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 40%" />

                <input class="float-right btn btn-primary mt-12" type="submit" value="Crear reporte">
            </form>
        </div>
    </div>

@stop

@section('js')
    <script type="text/javascript">
        $(function() {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });

    </script>
@endsection

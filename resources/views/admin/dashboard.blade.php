@extends('layouts.admin.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor text-capitalize">
            Benvenid@: {{ Auth::user()->fullName }}
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active">
                Dashboard
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('contratos.listar_contratos') }}">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-info">
                            <i class="fas fa-file-pdf">
                            </i>
                        </div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-light">
                                {{ $panel['por_autorizar'] }}
                            </h3>
                            <h5 class="text-muted m-b-0">
                                Contratos por autorizar
                            </h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('ventas') }}">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-warning">
                            <i class="fas fa-file-pdf">
                            </i>
                        </div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-lgiht">
                                {{ $panel['contratos_hoy'] }}
                            </h3>
                            <h5 class="text-muted m-b-0">
                                Ventas de hoy
                            </h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-primary">
                        <i class="fas fa-users">
                        </i>
                    </div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">
                            {{ $panel['clientes'] }}
                        </h3>
                        <h5 class="text-muted m-b-0">
                            Clientes registrados hoy
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-success">
                        <i class="fas fa-dollar">
                        </i>
                    </div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">
                            {{ $panel['pagado'] }}
                        </h3>
                        <h5 class="text-muted m-b-0">
                            Ingresos hoy
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Ventas
                </h4>
                <div class="chart-container">
                    <canvas id="myChart">
                    </canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Ventas de hoy por equipo
                </h4>
                <div class="chart-container">
                    <canvas id="ventas_por_equipo" style="height:80vh;">
                    </canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {

        var datos =  @json($grafica);
        var fecha = [];
        var ventas = [];
        var colores = [];
        var back = [];
        // var back = [];
      
        $.each(datos, function(index, val) {
            fecha.push(val.fecha);
            ventas.push(val.ventas);
            var r = Math.round(Math.random()*255);
            var g = Math.round(Math.random()*255);
            var b = Math.round(Math.random()*255);
            var rgb1="rgba("+r+", "+g+", "+b+", "+.9+")"
;           var rgb ="rgba("+r+", "+g+", "+b+", "+.8+")";
            back.push(rgb1);
            colores.push(rgb);
        });

       
        var ctx = document.getElementById('myChart').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: fecha,
                datasets: [{
                    label: 'Ventas del mes ',
                    data: ventas,
                    backgroundColor: colores,
                    borderColor: back,
                    borderWidth: 1
                }]
            },
            options: {
                tooltips: {
                    mode: 'point'
                }
            }
        });


        var ventas_data =  @json($ventas_equipo);
        var equipos = [];
        var ventas_e = [];
        var colores_e = [];

        $.each(ventas_data, function(index, val) {
            ventas_e.push(val.ventas);
            equipos.push(val.equipo);
            var r = Math.round(Math.random()*255);
            var g = Math.round(Math.random()*255);
            var b = Math.round(Math.random()*255);
            var rgb="rgba("+r+", "+g+", "+b+", "+.8+")";
            var rgb="rgba("+r+", "+g+", "+b+", "+.8+")";
            colores_e.push(rgb);
        });


        var ventas_por_equipo = document.getElementById('ventas_por_equipo').getContext('2d');

        var myChart = new Chart(ventas_por_equipo, {
            type: 'pie',
            data: {
                labels: equipos,
                datasets: [{
                    label: 'Ventas por equipo',
                    data: ventas_e,
                    backgroundColor: colores_e,
                    borderColor: colores_e,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                tooltips: {
                    mode: 'point'
                }
            }
        });
    });
</script>
@stop

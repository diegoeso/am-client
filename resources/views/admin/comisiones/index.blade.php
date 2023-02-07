@extends('layouts.admin.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">
            Comisiones
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active">
                Comisiones
            </li>
        </ol>
    </div>
</div>
<div class="row">
    {{-- @if (Auth::user()->role == 'conveniant') --}}
    <div class="col-md">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-b-0">
                    Filtrar comisiones
                </h4>
            </div>
            <div class="card-body">
                <form id="formComisiones" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="inputEmail4">
                                Fecha de inicio
                            </label>
                            <input autocomplete="off" class="form-control datepicker" data-date-format="yyyy-mm-dd" data-provide="datepicker" id="inputEmail4" name="fecha_inicio" type="text" value="{{ date('Y-m-d') }}">
                            </input>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPassword4">
                                Fecha de fin
                            </label>
                            <input autocomplete="off" class="form-control datepicker" data-date-format="yyyy-mm-dd" data-provide="datepicker" id="inputPassword4" name="fecha_fin" type="text" value="{{ date('Y-m-d') }}">
                            </input>
                        </div>
                    </div>
                    <div class="row">
                        {{-- @if (Auth::user()->can('create', App\Comision::class)) --}}
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">
                                Ejecutivos
                            </label>
                            <select class="form-control custom-select select2 m-b-10 select2-multiple select2-hidden-accessible" multiple="" name="ejecutivos[]" style="width: 100%; height: 200px;">
                                @if (Auth::user()->role == 'conveniant' || Auth::user()->role == 'sales')
                                <option selected="" value="'{{ Auth::user()->username }}'">
                                    {{ Auth::user()->fullName .' '. Auth::user()->username}}
                                </option>
                                @else
                                @foreach ($ejecutivos as $ejecutivo)
                                <option value="'{{ $ejecutivo->username }}'">
                                    {{ $ejecutivo->fullName .' '. $ejecutivo->username}}
                                </option>
                                @endforeach

                                @endif
                            </select>
                        </div>
                        {{-- @endif --}}
                    </div>
                    <button class="btn btn-primary btn-sm" type="submit">
                        Filtrar
                    </button>
                    <button class="btn btn-dark btn-sm" id="btnDescargarComisiones" type="button">
                        <i class="fas fa-file-excel-o">
                        </i>
                        Descargar
                    </button>
                </form>
            </div>
        </div>
    </div>
    {{-- @endif --}}
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display nowrap table table-hover dataTable" id="table_comisiones" role="grid" style="width:100%">
                        <thead>
                            <tr role="row">
                                <th>
                                    Folio
                                </th>
                                <th>
                                    Llamada
                                </th>
                                <th>
                                    Fecha de venta
                                </th>
                                <th>
                                    Primero pago
                                </th>
                                <th>
                                    Comisionista
                                </th>
                                <th>
                                    Equipo
                                </th>
                                <th>
                                    Empresa
                                </th>
                                <th>
                                    Vendedor
                                </th>
                                <th>
                                    Cliente
                                </th>
                                <th>
                                    Estatus
                                </th>
                                <th>
                                    Motivo
                                </th>
                                <th>
                                    Modificación
                                </th>
                                <th>
                                    Cantidad
                                </th>
                                <th>
                                    Campañas
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            orientation: 'bottom',
        });

        // pintarDatos($('#formComisiones').serialize());

        $('#formComisiones').submit(function(event) {
            event.preventDefault();
            var request = $(this).serialize();
            pintarDatos(request);
        });

        $('#btnDescargarComisiones').on('click', function(event) {
            event.preventDefault();
            var request = $(this).serialize();
            $.ajax({
                url: "{{ route('comisiones.export') }}",
                type: 'GET',
                dataType: 'json',
                data: $('#formComisiones').serialize(),
                beforeSend:function(){
                    $("#overlay").css("display", "block");
                },
                success:function(res){
                    if (res.success == true) {
                        alertify.alert('Descargando...','Descargando filtrado, no actualice ni cierre esta pestaña hasta que se descargue el archivo.');
                        window.location.href = res.url;
                    }
                }
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
        });
    });

    function pintarDatos(request) {
        $.ajax({
            url: baseuri + "admin/listar-comisiones",
            type: 'GET',
            dataType: 'json',
            data: request,
            beforeSend:function(){
                $("#overlay").css("display", "block");
            },
            success:function(res){
                // console.log(res);
                var tabla = $('#table_comisiones').DataTable({
                    'responsive': true,
                    'searching': true,
                    "processing": true,
                    'lengthMenu': [[10, 50, -1], [10, 50, "Todo"]],
                    'pageLength': 10,
                    "order": [[ 0, "desc" ]],
                    "aoColumns": [{
                        "mData": "0"
                        }, {
                        "mData": "1"
                        },{
                        "mData": "2"
                        }, {
                        "mData": "3"
                        }, {
                        "mData": "4"
                        }, {
                        "mData": "5"
                        }, {
                        "mData": "6"
                        }, {
                        "mData": "7"
                        }, {
                        "mData": "8"
                        }, {
                        "mData": "9"
                        }, {
                        "mData": "10"
                        }, {
                        "mData": "11"
                        }, {
                        "mData": "12"
                        }, {
                        "mData": "13"
                        }
                    ],
                    "data": res.aaData,
                    "bDestroy": true
                });

            }
        })
        .always(function() {
            $("#overlay").css("display", "none");
        });

    }
</script>
@endsection

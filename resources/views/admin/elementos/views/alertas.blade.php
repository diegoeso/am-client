@extends('layouts.admin.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">
            <a href="#">
                Alertas
            </a>
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active">
                Filtrado de alertas
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-b-0">
                    Filtrado de alertas
                </h4>
            </div>
            <div class="card-body">
                <div>
                    <form action="{{ route('alertas.show') }}" id="formFiltrado" method="get">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputAddress">
                                    Fecha de inicio
                                </label>
                                <input autocomplete="off" class="form-control datepicker" id="fecha_inicio" name="fecha_inicio" type="text" value="{{ date('Y-m-d') }}"/>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputAddress2">
                                    Fecha de fin
                                </label>
                                <input autocomplete="off" class="form-control datepicker" id="fecha_fin" name="fecha_fin" type="text" value="{{ date('Y-m-d') }}"/>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm" type="submit">
                            Filtrar
                        </button>
                        <button class="btn btn-success btn-sm" id="export">
                            <i class="fas fa-file-excel-o">
                            </i>
                            Exportar
                        </button>
                    </form>
                </div>
                <hr/>
                <div class="table-responsive mt-3">
                    <table class="table table-hover dataTable" id="tabla_ventas" role="grid" style="width:100%">
                        <thead>
                            <tr role="row">
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Cliente
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Correo electronico
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Telefono
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Empresa
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Enviado a
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Creado
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
        var tabla_ventas;
        $('#convenio_id').select2({
            // Funcionamiento correcto dentro de modales 
            dropdownParent: $('#modalSorteo'),
            allowClear: true,
            placeholder: 'Selecciona algun convenio',
            width: 'resolve',
            heigh:'resolve',
        });



        $('.datepicker').datepicker({
            dateFormat: "yy-mm-dd",
            startDate: '-1d',
            endDate: '+2m',
            autoclose:true,
            language: 'es'
        });

        pintar_ventas($('#formFiltrado').serialize(), $('#formFiltrado').attr('action'));

        $('#formFiltrado').on('submit', function(event) {
            event.preventDefault();
            pintar_ventas($('#formFiltrado').serialize(), $('#formFiltrado').attr('action'));
        });


        $('#export').on('click', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('alertas.export') }}",
                type: 'GET',
                dataType: 'json',
                data: $('#formFiltrado').serialize(),
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



    function pintar_ventas(data, url) {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: data,
            beforeSend:function(){
                $("#overlay").css("display", "block");
            },
            success:function(res){
                tabla_ventas = $('#tabla_ventas').dataTable({
                    'responsive': true,
                    'searching': true,
                    // 'serverSide': true,
                    "aoColumns": [{
                        "mData": "0"
                    },{
                        "mData": "1"
                    }, {
                        "mData": "2"
                    }, {
                        "mData": "3"
                    }, {
                        "mData": "4"
                    }, {
                        "mData": "5"
                    }],
                    data: res.aaData,
                    destroy: true,
                }).DataTable();
            }
        })
        .always(function() {
            $("#overlay").css("display", "none");
        });
    }
</script>
@endsection

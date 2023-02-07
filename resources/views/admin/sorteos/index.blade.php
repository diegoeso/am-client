@extends('layouts.admin.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">
            <a href="{{ route('sorteos.index') }}">
                Sorteos
            </a>
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active">
                Sorteos
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-actions">
                    {{-- @if (Auth::user()->can('create', App\Tarjeta::class)) --}}
                    <button class="btn btn-info btn-xs" data-toggle="modal" id="btnAddSorteo">
                        <span>
                            <i class="fas fa-plus">
                            </i>
                            Nuevo sorteo
                        </span>
                    </button>
                    {{-- @endif --}}
                </div>
                <h4 class="card-title m-b-0">
                    Sorteos registrados
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover dataTable" id="table_sorteos" role="grid" style="width:100%">
                        <thead>
                            <tr role="row">
                                <th aria-sort="ascending" class="sorting_asc">
                                    Folio
                                </th>
                                <th aria-controls="" aria-label="" aria-sort="ascending" class="sorting_asc" colspan="1" rowspan="1" tabindex="0">
                                    Convenio
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Llave
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Fecha de inicio
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Fecha de fin
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Estatus
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Registros
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0" width="80">
                                    Opciones
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
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="sorteoModalTitle" class="modal fade" id="modalSorteo" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sorteoModalTitle">
                    Crear nuevo sorteo
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>
            <form action="{{ route('sorteos.store') }}" id="formSorteo" method="post">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">
                                Convenio
                            </label>
                            {{--
                            <input class="typeahead form-control" id="empresa_nombre" name="empresa_nombre" type="text">
                            </input>
                            --}}
                         {{--
                            <select class="form-control select2 select2-hidden-accessible " id="convenio_id" name="convenio_id" style="width:100%">
                                @foreach ($convenios as $convenio)
                                <option value="{{ $convenio->id }}">
                                    {{ $convenio->empresa_nombre }}
                                </option>
                                @endforeach
                            </select>
                            --}}
                            <select class="form-control select2 select2-hidden-accessible custom-select" id="convenio_id" name="convenio_id" style="width: 95%;">
                                <option value="">
                                    Selecciona un convenio
                                </option>
                                @foreach ($convenios as $convenio)
                                <option value="{{$convenio->id}}">
                                    {{$convenio->empresa_nombre}}
                                </option>
                                @endforeach
                            </select>
                            <br>
                                <span class="text-danger error-convenio_id errors">
                                </span>
                            </br>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fecha_inicio">
                                Fecha de inicio
                            </label>
                            <input autocomplete="off" class="form-control datepicker" id="fecha_inicio" name="fecha_inicio" type="text">
                            </input>
                            <span class="text-danger error-fecha_inicio errors">
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha_fin">
                                Fecha de fin
                            </label>
                            <input autocomplete="off" class="form-control datepicker" id="fecha_fin" name="fecha_fin" type="text">
                            </input>
                            <span class="text-danger error-fecha_fin errors">
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" id="num_empleado" name="num_empleado" type="checkbox" value="1">
                                <label class="form-check-label" for="num_empleado">
                                    Numero de empleado obligatorio
                                </label>
                            </input>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">
                        Cerrar
                    </button>
                    <button class="btn btn-primary btn-sm" type="submit">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function() {
        var user_id = "{{ Auth::user()->id }}";
        
        $('#convenio_id').select2({
            // Funcionamiento correcto dentro de modales 
            dropdownParent: $('#modalSorteo')
        });

        $('.datepicker').datepicker({
            dateFormat: "yy-mm-dd",
            startDate: '-1d',
            endDate: '+2m',
            autoclose:true,
            language: 'es'
        });
        /**
         * Autor: Isw. Diego Enrique Sanchez
         * Creado: 2022-05-30
         * Listar  sorteos registrados en DB
         */
        var tabla = $('#table_sorteos').DataTable({
            'responsive': true,
            'searching': true,
            'lengthMenu': [[10, 50, -1], [10, 50, "Todo"]],
            'pageLength': 10,
            "order": [ 0, 'DESC' ],
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
                "mData": "7"
                }, {
                "mData": "6"
                }
            ],
            "ajax": {
                url: baseadmin + "sorteos-listar/" + user_id,
                type: "get",
                dataType: "json",
                error: function(e) {
                  console.log(e.responseText);
                }
            },
        });


        $('#btnAddSorteo').on('click', function(event) {
            event.preventDefault();
            $('#modalSorteo').modal('show');
        });

        $('#formSorteo').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                dataType: 'JSON',
                data: $(this).serialize(),
                beforeSend:function(){
                    $("#overlay").css("display", "block");
                },
                success:function(res){
                    if (res.success == false) {
                        pintar_errores(res.errors);
                    }else{                    
                        $('#formSorteo').trigger('reset');
                        $('#modalSorteo').modal('hide');
                        toastr["success"]('¡Se ha registrado un nuevo sorteo exitosamente!');
                        tabla.ajax.reload();
                    }
                }
            })
            .always(function() {
                $("#overlay").css("display", "none");
            });
            
        });
    });
</script>
@endsection

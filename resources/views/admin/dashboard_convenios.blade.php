@extends('layouts.admin.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">
            Benvenid@ {{ Auth::user()->fullName }}
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
                <a href="{{ route('concals.index') }}">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-success">
                            <i class="fas fa-check">
                            </i>
                        </div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-lgiht">
                                {{ $panel['seguimientos'] }}
                            </h3>
                            <h5 class="text-muted m-b-0">
                                Mis seguimientos
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
                <a href="{{ route('convenios.index') }}">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-info">
                            <i class="fas fa-list-alt">
                            </i>
                        </div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-light">
                                {{ $panel['num_convenios'] }}
                            </h3>
                            <h5 class="text-muted m-b-0">
                                Convenios
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
                    <div class="round round-lg align-self-center round-warning">
                        <i class="fas fa-file-pdf">
                        </i>
                    </div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-lgiht">
                            {{ $panel['ventas_total'] }}
                        </h3>
                        <h5 class="text-muted m-b-0">
                            Ventas totales
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('actividades.index') }}">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-primary">
                            <i class="fas fa-book">
                            </i>
                        </div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-lgiht">
                                {{ $panel['actividades'] }}
                            </h3>
                            <h5 class="text-muted m-b-0">
                                Mis actividades
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
                <a href="{{ asset('files/manual_convenios.pdf') }}" target="_blank">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-success">
                            <i class="fas fa-file-pdf">
                            </i>
                        </div>
                        <div class="m-l-10 align-self-center">
                            <h5 class="text-muted m-b-0">
                                Manual de Convenios
                            </h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<listar-convenios>
</listar-convenios>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap">
                    <div>
                        <h4 class="card-title">
                            Mis convenios
                        </h4>
                    </div>
                    <div class="ml-auto">
                        <a class="btn btn-primary btn-sm" href="{{ route('concals.index') }}" type="button">
                            Nuevo convenio
                        </a>
                        <button class="btn btn-dark btn-sm" id="btnReload" type="button">
                            <i class="fa fa-refresh">
                            </i>
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table aria-describedby="example2_info" class="table table-hover dataTable" id="convenios_table" role="grid" style="width:100%">
                        <thead>
                            <tr role="row">
                                <th aria-controls="" aria-label="" aria-sort="ascending" class="sorting_asc" colspan="1" rowspan="1" tabindex="0">
                                    ID
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Pais
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Llave
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Empresa
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    Liga
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    # Contratos
                                </th>
                                <th aria-controls="" aria-label="" class="sorting" colspan="1" rowspan="1" style="width:120px;" tabindex="0" width="100">
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
@endsection
@section('script')
<script>
    $(document).ready(function() {
        var user = @json(Auth::user());
        var table;
        //////
        // Funciona correctamete //
        //////
        table = $('#convenios_table').DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            order: [0, 'desc'],
            bInfo: false,
            ajax: baseadmin + "convenios-listar/"+user.id,
            columns: [
                {data: 'id', name: 'id'},
                {data: 'pais', name: 'pais'},
                {data: 'llave', name: 'llave'},
                {data: 'convenio', name: 'convenio'},
                {data: 'liga', name: 'liga'},
                {data: 'contratos_vendidos', name: 'contratos_vendidos'},
                {data: 'actions', name: 'actions'},
            ],
            // columnDefs: [         // see https://datatables.net/reference/option/columns.searchable
            //     {
            //         orderable: false, targets: [8]
            //     },
            //     {
            //         visible:false, targets: [9]
            //     },

            //     {className: "dt-left", targets: [3]},
            //     {className: "dt-center45", targets: [0,1,2,4,5,6,7,8]}


            // ],
            "drawCallback": function() {
                if (this.fnSettings().fnRecordsTotal() < 11) {
                    $('.dataTables_paginate').hide();
                }
            },
        });

  


        $('#btnReload').click(function(event){
            event.preventDefault();
            table.ajax.reload();
            toastr['info']('¡Recargando datos de convenios!')
        });
    });
</script>
@endsection

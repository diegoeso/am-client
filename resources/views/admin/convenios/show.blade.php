@extends('layouts.admin.app')
@section('content')
<style>
    #convenios_table_processing{
        color: red;
        font-size: 1.5em;
        align-items: center;
        align-content: center;
        left: 50%;
    }
</style>
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">
            Dashboard
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('convenios.index') }}">
                    Convenios
                </a>
            </li>
            <li class="breadcrumb-item active text-capitalize">
                {{ $convenio->empresa_nombre }}
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30">
                    <img class="img-circle" src="{{ $convenio->logo != null ? asset('images/empresas/'.$convenio->logo) : asset('images/empresas/sin-imagen.png') }}" width="150"/>
                    <h4 class="card-title m-t-10 text-uppercase">
                        {{ $convenio->empresa_nombre }}
                    </h4>
                    <h6 class="card-subtitle">
                        <a href="{{ env('PRODUCT_URL') . $convenio->llave }}" target="_blank">
                            {{  $convenio->llave }}
                        </a>
                    </h6>
                    <div class="row text-center justify-content-md-center">
                        <div class="col-4">
                            <a class="link" href="javascript:void(0)">
                                Contratos
                                <font class="font-medium">
                                    {{ count($convenio->contratos) }}
                                </font>
                            </a>
                        </div>
                    </div>
                </center>
            </div>
            <div>
                <hr/>
            </div>
            <div class="card-body">
                <small class="text-muted">
                    Conveniador
                </small>
                <h6>
                    {{ $convenio->user->fullName }}
                </h6>
                <small class="text-muted db">
                    Activo hasta
                </small>
                <h6>
                    {{ $convenio->activo_hasta }}
                </h6>
                <small class="text-muted db">
                    Estatus
                </small>
                <h6>
                    {{ ($convenio->disponible == 1) ? 'Activo' : 'Inactivo' }}
                </h6>
                <small class="text-muted db">
                    Conveniador
                </small>
                <h6>
                    {{ $convenio->user->fullName }}
                </h6>
                <small class="text-muted db">
                    Campaña
                </small>
                <h6>
                    {{ $convenio->campana_inicio ." al ". $convenio->campana_fin }}
                </h6>
                <small class="text-muted db">
                    Creado
                </small>
                <h6>
                    {{ $convenio->creado() }}
                </h6>
                <small class="text-muted db">
                    Modificado
                </small>
                <h6>
                    {{ $convenio->modificado()  }}
                </h6>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item">
                    <a aria-expanded="false" class="nav-link active" data-toggle="tab" href="#home" role="tab">
                        Contratos generados
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div aria-expanded="false" class="tab-pane active" id="home" role="tabpanel">
                    <div class="card-body">
                        <div class="">
                            <div class="sl-item">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="table_contratos">
                                        <thead>
                                            <tr>
                                                <th>
                                                    # Folio
                                                </th>
                                                <th>
                                                    Cliente
                                                </th>
                                                <th>
                                                    Estancia
                                                </th>
                                                <th>
                                                    Estatus
                                                </th>
                                                <th>
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
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        var tabla = $('#table_contratos').DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            order: [0, 'desc'],
            ajax: baseadmin + "contrato-por-convenio/" + {{ $convenio->id  }},
            columns: [
                {data: 'id', name: 'id'},
                {data: 'cliente', name: 'cliente'},
                {data: 'estancia', name: 'estancia'},
                {data: 'estatus', name: 'estatus'},
                {data: 'creado', name: 'creado'},
            ],
        });
    });
</script>
@endsection

@extends('layouts.admin.app')
@section('content')
<style>
    button > .infoPago{
        display: none;
    }

    #btnPago:hover{
        /*background-color: red;*/
    }

    #btnPago:hover  > .infoPago{
        display: block;
    }
</style>
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor text-capitalize">
            Benvenid@: {{ Auth::user()->fullName }}
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active">
                Cobranza
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-actions">
                    <button class="btn btn-info btn-xs" data-target="#modalUnlock" data-toggle="modal" style="color: white;">
                        <i class="fas fa-unlock-alt">
                        </i>
                        Desbloquear
                    </button>
                </div>
                <h4 class="card-title m-b-0">
                    Filtrado Terminal
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('cobranza.index') }}" id="formTerminal" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">
                                        Inicio del rango
                                    </label>
                                    <input autocomplete="off" class="form-control" id="fecha_inicio" name="fecha_inicio" type="text" value="{{ date('Y-m-d') }}">
                                        <span class="text-danger error-titular errors">
                                        </span>
                                    </input>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">
                                        Fin del rango
                                    </label>
                                    <input autocomplete="off" class="form-control" id="fecha_fin" name="fecha_fin" type="text" value="{{ date('Y-m-d') }}">
                                        <span class="text-danger error-numero_tarjeta errors">
                                        </span>
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5 class="card-title mb-2 mt-2">
                                Método de compra:
                            </h5>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-info btn-sm ">
                                    <input name="nomina" type="checkbox">
                                        Nomina
                                    </input>
                                </label>
                                <label class="btn btn-info btn-sm">
                                    <input name="terminal" type="checkbox">
                                        Terminal
                                    </input>
                                </label>
                                <label class="btn btn-info btn-sm ">
                                    <input name="viaserfin" type="checkbox">
                                        Via Serfin
                                    </input>
                                </label>
                            </div>
                            <h5 class="card-title mb-2 mt-2">
                                Estatus de pago:
                            </h5>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-info btn-sm active ">
                                    <input checked="" name="pagosRechazados" type="checkbox">
                                        Rechazados
                                    </input>
                                </label>
                                <label class="btn btn-info btn-sm active">
                                    <input checked="" name="pagosPagados" type="checkbox">
                                        Pagados
                                    </input>
                                </label>
                                <label class="btn btn-info btn-sm active ">
                                    <input checked="" name="pagosPendientes" type="checkbox">
                                        Pendientes
                                    </input>
                                </label>
                                <label class="btn btn-info btn-sm active ">
                                    <input checked="" name="pagosAnomalías" type="checkbox">
                                        Anomalías
                                    </input>
                                </label>
                            </div>
                            <h5 class="card-title mb-2 mt-2">
                                Tipo de tarjeta:
                            </h5>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-info btn-sm ">
                                    <input name="tipoTarjeta" type="radio" value="Credito">
                                        Crédito
                                    </input>
                                </label>
                                <label class="btn btn-info btn-sm">
                                    <input name="tipoTarjeta" type="radio" value="Debito">
                                        Débito
                                    </input>
                                </label>
                                <label class="btn btn-info btn-sm active">
                                    <input checked="" name="tipoTarjeta" type="radio" value="0">
                                        Sin segmentar
                                    </input>
                                </label>
                            </div>
                            <h5 class="card-title mb-2 mt-2">
                                Red bancaria:
                            </h5>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-info btn-sm ">
                                    <input name="red_bancaria" type="radio" value="MasterCard">
                                        Crédito
                                    </input>
                                </label>
                                <label class="btn btn-info btn-sm">
                                    <input name="red_bancaria" type="radio" value="VISA">
                                        Débito
                                    </input>
                                </label>
                                <label class="btn btn-info btn-sm active">
                                    <input checked="" name="red_bancaria" type="radio" value="0">
                                        Sin segmentar
                                    </input>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5 class="card-title mb-2 mt-2">
                                Filtrado extra:
                            </h5>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-info btn-sm active">
                                    <input checked="" id="btnNinguno" type="radio" value="ninguno">
                                        Ninguno
                                    </input>
                                </label>
                                <label class="btn btn-info btn-sm">
                                    <input id="btnPais" type="radio" value="pais">
                                        País
                                    </input>
                                </label>
                                <label class="btn btn-info btn-sm ">
                                    <input id="btnConvenio" type="radio" value="convenio">
                                        Convenio
                                    </input>
                                </label>
                            </div>
                            <div id="contenedor_filtro" style="display:none">
                                <h5 class="card-title mb-2 mt-2">
                                    Filtrado extra:
                                </h5>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-info btn-sm active">
                                        <input checked="" id="btnNinguno" type="radio" value="ninguno">
                                            Ninguno
                                        </input>
                                    </label>
                                    <label class="btn btn-info btn-sm">
                                        <input id="btnPais" type="radio" value="pais">
                                            País
                                        </input>
                                    </label>
                                    <label class="btn btn-info btn-sm ">
                                        <input id="btnConvenio" type="radio" value="convenio">
                                            Convenio
                                        </input>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ml-auto">
                        <div class="float-right">
                            <button class="btn btn-dark btn-sm" type="submit">
                                Filtrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Resultados
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover" id="tableTerminal">
                    <thead>
                        <tr>
                            <th scope="col">
                                Segmento
                                <br/>
                                <small>
                                    # Pago
                                </small>
                            </th>
                            <th scope="col">
                                # Contrato
                                <br/>
                                <small>
                                    Clave Serfin
                                </small>
                            </th>
                            <th scope="col">
                                Cliente
                                <br/>
                                <small>
                                    Convenio
                                </small>
                            </th>
                            <th scope="col">
                                Cantidad
                                <br/>
                                <small>
                                    Cantidad total
                                </small>
                            </th>
                            <th scope="col">
                                Tarjeta asignada
                                <br/>
                                <small>
                                    Entidad bancaria
                                </small>
                            </th>
                            <th scope="col">
                                Estatus
                                <br/>
                                <small>
                                    Motivo del rechazo
                                </small>
                            </th>
                            <th scope="col">
                                F. programada
                                <br/>
                                <small>
                                    Fecha cobro exitoso
                                </small>
                            </th>
                            <th scope="col" width="140px">
                                Acciones
                                <br/>
                                <small>
                                    Avance de pagos
                                </small>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagos as $pago)
                        <tr>
                            <td>
                                <span class="text-capitalize"><button type="button" id="btnPago" data-pago_id="{{ $pago->id }}"  data-user_id="{{ $pago->contrato->cliente->id }}"  data-contrato_id="{{ $pago->contrato->id }}" class="btn btn-dark btn-xs"><snall>Segmento:</snall>{{ $pago->segmento }}</button> </span><br/><small>{{ $pago->id }}</small>
                            </td>
                            <td>
                                <a href="{{ route('users.show', $pago->contrato->cliente->id) }}"> 
                                    # {{ $pago->contrato->id }} 
                                </a>
                                <br/>
                                <small>
                                    {{ $pago->contrato->sys_key }}
                                </small>
                            </td>
                            <td>    
                                <a href="{{ route('users.show', $pago->contrato->cliente->id) }}" class="btn btn-sm btn-dark">{{ $pago->contrato->cliente->fullName }}
                                </a>
                                <br/>
                                <small>S/A</small>
                            </td>
                            <td>
                                <span class="">{{ $pago->contrato->divisa  .''. number_format($pago->cantidad, 2) }}</span>
                                <br/>
                                <small>De: {{ $pago->contrato->divisa . ''. number_format($pago->contrato->precio_de_compra, 2) }}</small>
                            </td>
                            <td>
                                <span>{{ $pago->contrato->tarjeta->unlockCard() }}</span><br/><small>{{ $pago->contrato->tarjeta->r_banco->title}}</small>
                            </td>
                            <td>
                                <?php 
                                 switch ($pago->estatus) {
                                        case 'Pagado':
                                            $class = 'success';
                                            break;
                                        case 'Rechazado':
                                            $class = 'danger';
                                            break;
                                        case 'Anomalias':
                                            $class = 'info';
                                            break;
                                        default:
                                            $class = 'inverse';
                                            break;
                                    }
                                    $sfr = '<ul class="list-unstyled" style="font-size:10px;">';
                                    if (count($pago->historial_limit) >= 1) {
                                        foreach ($pago->historial_limit as $key => $historial) {
                                            $sfr .= '<li>' . $historial->motivo_del_rechazo . '</li>';
                                        }
                                    } else {
                                        $sfr .= '<li> Sin información</li>';
                                    }
                                     $sfr .= '</ul>';
                                 ?>
                                 <button class="btn btn-xs btn-{{ $class }} btnMostratPagos" data-id="all" id="btnTotal" value="{{ $pago->contrato->id }}">{{ $pago->estatus }}</button><br/><small>{!! $sfr !!}</small>
                            </td>
                            <td>
                                <span>{{ $pago->fecha_de_cobro }}</span><br/><small>{{ $pago->fecha_de_pago }}</small>
                            </td>
                            <td>
                                <?php 
                                 $btn = '<button class="btn btn-success btn-xs mr-1" value="' . $pago->id . '" data-pago_id="' . $pago->id . '" data-tarjeta_id="' . $pago->contrato->tarjeta->id . '" data-contrato_id="' . $pago->contrato->id . '" id="btnEditarPago" type="button"><i class="fas fa-edit"></i></button>';
                                $btn .= '<button class="btn btn-info btn-xs mr-1" data-pago_id="' . $pago->id . '" data-tarjeta_id="' . '' . '" data-contrato_id="' . $pago->contrato->id . '" id="btnMetodoPago" type="button"><i class="fas fa-arrows-alt-h"></i></button>';
                                $btn .= '<button class="btn btn-dark btn-xs" data-pago_id="' . $pago->id . '" data-tarjeta_id="' . '' . '" data-contrato_id="' . $pago->contrato->id . '" id="btnUpdate" type="button"><i class="fas fa-cog"></i></button>';
                                $btn .= '<br><span class="label label-info">' . $pago->contrato->divisa . number_format($pago->contrato->precio_de_compra, 2) . '</span><br><span class="label label-success">' . $pago->contrato->divisa . number_format($pago->total_pagos_contrato($pago->contrato->id, 'pagados'), 2) . '</span><br/><span class="label label-danger">' . $pago->contrato->divisa . number_format($pago->total_pagos_contrato($pago->contrato->id, 'por_pagar'), 2) . ' </span>';
                                 ?>

                                 {!! $btn !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $pagos->links() !!}
            </div>
        </div>
    </div>
</div>
<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="modalUnlock" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Desbloquear tarjetas
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>
            <form action="{{ route('unlocked') }}" id="formUnlock" method="post">
                @csrf
                <div class="modal-body">
                    <small>
                        Para desbloquear las tarjetas ingrese la contraseña.
                    </small>
                    <input class="form-control" id="unlock" name="unlock" type="password">
                    </input>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">
                        Cerrar
                    </button>
                    <button class="btn btn-primary btn-sm" type="submit">
                        Desbloquear
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

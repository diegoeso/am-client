@extends('layouts.admin.app')
<style type="text/css">
    .dropdown-toggle{
        padding: 5px 1rem;
    }
</style>
@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">
            Dashboard
        </h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('users.index') }}">
                    Users
                </a>
            </li>
            <li class="breadcrumb-item active">
                {{ $user->fullName }}
            </li>
        </ol>
    </div>
</div>
<div class="">
    <div class="row">
        <div class="col-lg-3 col-xlg-3 col-md-12">
            @include('admin.users.elementos.info_user')
            @include('admin.users.elementos.info_access_user')
        </div>
        <div class="col-lg-9 col-xlg-9 col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-actions">
                        @if (Auth::user()->can('create', App\Tarjeta::class))
                        <button class="btn btn-info btn-xs" data-toggle="modal" data-user_id="{{ $user->id }}" id="btnAddTarjeta">
                            <span>
                                <i class="fas fa-plus">
                                </i>
                                {{ __('messages.user.show.agregar_tarjeta') }}
                            </span>
                        </button>
                        @endif
                        <button class="btn btn-dark btn-sm" data-user_id="{{ $user->id }}" id="btnReloadT">
                            <i class="fa fa-spin fa-refresh">
                            </i>
                        </button>
                        <a class="" data-action="collapse">
                            <i class="ti-minus">
                            </i>
                        </a>
                        <a class="btn-close" data-action="close">
                            <i class="ti-close">
                            </i>
                        </a>
                    </div>
                    <h4 class="card-title m-b-0">
                        {{ __('messages.user.show.tarjetas') }}
                    </h4>
                </div>
                <div class="card-body collapse show">
                    <div class="table-responsive">
                        <table class="table product-overview" id="table_tarjetas" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>
                                        {{ __('messages.user.show.titular_numero') }}
                                    </th>
                                    <th>
                                        {{ __('messages.user.show.banco') }}
                                    </th>
                                    <th>
                                        {{ __('messages.user.show.estatus') }}
                                    </th>
                                    <th>
                                        {{ __('messages.user.show.tipo') }}
                                    </th>
                                    <th>
                                        {{ __('messages.user.show.opciones') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-actions">
                        {{-- @if (Auth::user()->can('create', App\Contrato::class)) --}}
                        <button class="btn btn-info btn-xs" data-user_id="{{ $user->id }}" id="btnAddContrato">
                            <span>
                                <i class="fas fa-plus">
                                </i>
                                {{ __('messages.user.show.agregar_contrato') }}
                            </span>
                        </button>
                        <button class="btn btn-dark btn-sm" data-user_id="{{ $user->id }}" id="btnReloadC">
                            <i class="fa fa-spin fa-refresh">
                            </i>
                        </button>
                        <a class="" data-action="collapse">
                            <i class="ti-minus">
                            </i>
                        </a>
                        <a class="btn-close" data-action="close">
                            <i class="ti-close">
                            </i>
                        </a>
                        {{-- @endif --}}
                    </div>
                    <h4 class="card-title m-b-0">
                        {{ __('messages.user.show.contratos') }}
                    </h4>
                </div>
                <div class="table-responsive">
                    <div class="card-body collapse show">
                        <table class="table table-hover" id="table_contratos" style="width: 100%;  min-height: 220px;">
                            <thead>
                                <tr>
                                    <th class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    </th>
                                    <th class="sorting" colspan="1" rowspan="1" tabindex="0">
                                        {{ __('messages.user.show.folio') }}
                                    </th>
                                    <th class="sorting" colspan="1" rowspan="1" tabindex="0">
                                        {{ __('messages.user.show.estancia') }}
                                    </th>
                                    <th class="sorting" colspan="1" rowspan="1" tabindex="0">
                                        {{ __('messages.user.show.estatus') }}
                                    </th>
                                    <th class="sorting" colspan="1" rowspan="1" tabindex="0">
                                        {{-- {{ __('messages.user.show.metodo_de_compra') }} --}}
                                        {{ __('messages.user.show.precio') }}
                                    </th>
                                    <th class="sorting" colspan="1" rowspan="1" tabindex="0">
                                        {{ __('messages.user.show.pagos') }}
                                    </th>
                                    <th class="sorting" colspan="1" rowspan="1" tabindex="0">
                                        {{ __('messages.user.show.opciones') }}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            @can('show_reservations', Auth::user())
            <div class="card">
                <div class="card-header">
                    <div class="card-actions">
                        <button class="btn btn-info btn-xs" data-user_id="{{ $user->id }}" id="btnAddReservacion">
                            <span>
                                <i class="fas fa-plus">
                                </i>
                                Agregar reservación
                            </span>
                        </button>
                        {{--
                        <a class="btn btn-info btn-xs" href="{{ route('reservations.create', $user->id) }}">
                            <span>
                                <i class="fas fa-plus">
                                </i>
                                Agregar reservación
                            </span>
                        </a>
                        --}}
                        <button class="btn btn-dark btn-sm" data-user_id="{{ $user->id }}" id="btnReloadR">
                            <i class="fa fa-spin fa-refresh">
                            </i>
                        </button>
                        <a class="" data-action="collapse">
                            <i class="ti-minus">
                            </i>
                        </a>
                        <a class="btn-close" data-action="close">
                            <i class="ti-close">
                            </i>
                        </a>
                    </div>
                    <h4 class="card-title m-b-0">
                        {{ __('messages.reservaciones') }}
                    </h4>
                </div>
                <div class="card-body collapse show">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table_reservaciones" style="width: 100%; min-height: 220px;">
                            <thead>
                                <tr>
                                    <th class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    </th>
                                    <th class="sorting" colspan="1" rowspan="1" tabindex="0">
                                    </th>
                                    <th class="sorting" colspan="1" rowspan="1" tabindex="0">
                                        {{ __('messages.estatus') }}
                                    </th>
                                    <th class="sorting" colspan="1" rowspan="1" tabindex="0">
                                        {{ __('messages.fecha_de_reservacion') }}
                                    </th>
                                    <th class="sorting" colspan="1" rowspan="1" tabindex="0">
                                        {{ __('messages.destino') }}
                                    </th>
                                    <th class="sorting" colspan="1" rowspan="1" tabindex="0">
                                        {{ __('messages.user.show.opciones') }}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>
</div>
<div class="modal fade" id="modalVendedor">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVendedorLabel">
                    Cambiar ejecutivo
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
            </div>
        </div>
    </div>
</div>
@include('admin.reservaciones.elementos.modal_reasignar')
@endsection

@section('script')
@include('admin.users.script')
@include('admin.users.reservaciones_script')
<script>
    var cliente = @json($user);
    $('body').on('click', '#addName', function(event) {
        event.preventDefault();
        $('#nombre_adquisitor').val(cliente.nombre + ' ' + cliente.apellidos);
    });
    

    // $('#form_editar_segmento').submit(function(event){
    //     event.preventDefault();
    //     // console.log('entro');
    //     $.ajax({
    //         url: $(this).attr('action'),
    //         type: $(this).attr('method'),
    //         dataType: 'JSON',
    //         data: $(this).serialize(),
    //         beforeSend:function(){

    //         },
    //         success:function(res){
    //             if (res.success != true) {
    //                 toastr['error']('¡Intentarlo más tarde!');
    //             }
    //             toastr['success']('¡Registro exitoso!');

    //             $('#modalGeneral').modal('hide');
    //             $('#modalShowPagos').modal('show');
    //         }
    //     })
    //     .always(function() {
    //         console.log("complete");
    //     });
    // });
</script>
@endsection

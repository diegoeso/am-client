<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="mt-3 mb-4" id="form_editar_segmento" action="{{ route('pagos.update', $pago->id) }}" method="PUT" data-contrato_id="{{ $pago->contrato->id }}">
                <div class="row">
                    <div class="col-md-12">
                        <dl class="row">
                            <dt class="col-sm-5">
                                No. Contrato:
                            </dt>
                            <dd class="col-sm-7">
                                <a href="{{ route('users.show', $pago->contrato->cliente->id) }}">
                                    {{ $pago->contrato->id }}
                                </a>
                            </dd>
                            {{--
                            <dt class="col-sm-5">
                                Cliente:
                            </dt>
                            <dd class="col-sm-7">
                                {{ $pago->contrato->cliente->fullName }}
                            </dd>
                            --}}

                            <dt class="col-sm-5 text-truncate">
                                ID Pago:
                            </dt>
                            <dd class="col-sm-7">
                                {{ $pago->id }}
                            </dd>
                            <dt class="col-sm-5 text-truncate">
                                Segmento:
                            </dt>
                            <dd class="col-sm-7">
                                # {{ $pago->segmento }}
                            </dd>
                            <dt class="col-sm-5 text-truncate">
                                Cantidad:
                            </dt>
                            <dd class="col-sm-7">
                                <input class="form-control" name="cantidad" type="text" value="{{ $pago->cantidad }}"/>
                            </dd>
                            <dt class="col-sm-6 text-truncate">
                                Fecha de cobro:
                            </dt>
                            <dd class="col-sm-6">
                                <input class="form-control datepicker" name="fecha_de_cobro" type="text" value="{{ $pago->fecha_de_cobro }}"/>
                            </dd>
                            <dt class="col-sm-6 text-truncate">
                                Fecha de cobro efectivo:
                            </dt>
                            <dd class="col-sm-6">
                                <input class="form-control datepicker" name="fecha_de_pago" type="text" value="{{ date('Y-m-d') }}"/>
                            </dd>
                            <dt class="col-sm-5">
                                Estatus del cobro:
                            </dt>
                            <dd class="col-sm-7">
                                <select class="form-control" id="estatus_pago" name="estatus_pago">
                                    @foreach ($estatus_pagos as $estatus => $val)
                                    <option value="{{ $estatus }}" {{ ($pago->estatus == $estatus) ? 'selected' : '' }}>
                                        {{ $val }}
                                    </option>
                                    @endforeach
                                </select>
                            </dd>
                        </dl>
                    </div>
                    <div class="col-md-12 pull-right">
                        <button class="btn btn-secondary btn-sm" id="btnCerrar" type="button">
                            Cerrar
                        </button>
                        <button class="btn btn-primary btn-sm" type="submit" >
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('body .datepicker').datepicker({
        format: 'yyyy-mm-dd',
        // startDate: '-1d',
        // endDate: '+1m +15d',
        autoclose:true,
        language: 'es'
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

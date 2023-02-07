@extends('layouts.pagina.app')
@section('content')

<style>
    .owl-alto{
        height: 60px;
    }
    .owl-alto img{
        max-height: 60px;
        max-width: 70%;
    }

    .breadcrumb .overlay_h {
        opacity: .01;
    }
    .breadcrumb_bg {
/*         background-image: url({{ asset('images/am/banner.jpg') }});*/
         background-image: url('https://assets.airtrfx.com/media-em/vb/cities/acapulco-ACA.png');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
/*        background-position-y: -310px;*/
/*        height: 80%;*/
    }

    .font_info{
        line-height: 2em;
        font-size:20px;
    }
</style>

<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item text-center">
                        <h2>
                            ¡Estas a un paso de planificar tus próximas vacaciones!
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@switch($data['fecha_inicio'])
    @case('sep')
        @php
            $segmentos = 12;
        @endphp
    @break
    @case('oct')
        @php
            $segmentos = 14;
        @endphp
    @break
    @case('nov')
    @php
            $segmentos = 17;
        @endphp
    @break
    @default
        @php
            $segmentos = 20;
        @endphp
@endswitch
@php
    $num_adultos = $data['adultos'] * $info['adulto'];  
    $num_menores =  (isset($data['menores'])) ? $data['menores'] * $info['menor'] : 0;
    $num_infantes =  (isset($data['infantes'])) ? $data['infantes'] * $info['infante'] :0 ;

    $total= $num_adultos + $num_menores + $num_infantes;
@endphp
<section class="hotel_list mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-5">
                <div class="cardt">
                    <div class="card-header">
                        <div class="d-flex pull-right">
                            <h3>
                                Información de compra
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="single_ihotel_list">
                            <div class="hotel_text_iner">
                                <h3 class="text-primary">
                                    {{ $estancia->title }}
                                </h3>
                                <div>
                                    {!! $estancia->descripcion !!}
                                </div>
                                <strong class="lead">
                                    Total:
                                    <span class="text-danger">
                                        ${{ $total }}.00
                                    </span>
                                    {{ $estancia->divisa }}
                                </strong>
                                <br/>
                                <strong class="lead">
                                    {{ $segmentos  }} Pagos quincenal:
                                    <span class="text-danger">
                                        ${{ number_format($total / $segmentos,2) }}
                                    </span>
                                    {{ $estancia->divisa }}
                                </strong>
                                <br/>
                                <p>
                                    Por concepto de:
                                </p>
                                <ul class="list-unstyled">
                                    <li>{{ $data['adultos'] }} Adultos x {{ number_format($info['adulto'], 2) . $estancia->divisa}}</li>
                                    <li>{{ $data['menores'] }} Menores x {{ number_format($info['menor'], 2) . $estancia->divisa}}</li>
                                    <li>{{ $data['infantes'] }} Infantes x {{ number_format($info['infante'], 2) . $estancia->divisa}}</li>
                                </ul>
                                <p>
                                    *Los cargos seran domicialiados al metodo de pago ingresado quincenalmente.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 mb-5">
                <form action="{{ route('tienda.store_grupo') }}" id="form_card_mx" method="post">
                    @csrf
                    <input type="hidden" name="segmentos" value="{{ $segmentos }}">
                    <input type="hidden" name="total" value="{{ $total }}">
                    <input type="hidden" name="adultos" value="{{ $data['adultos'] }}">
                    <input type="hidden" name="menores" value=" {{ $data['menores'] }}">
                    <input type="hidden" name="infantes" value="{{ $data['infantes'] }}">
                    <div class="cardt">
                        <div class="card-header text-center">
                            <h3>
                                Método de pago
                            </h3>
                        </div>
                       {{--  @if (count($tarjetas)>=1)
                        <div class="card-body">
                            <h6 class="card-title">
                                Selecciona un método de pago
                            </h6>
                            <select class="form-control" id="tarjeta_id" name="tarjeta_id">
                                @foreach ($tarjetas as $tarjeta)
                                <option value="{{ $tarjeta->id }}">
                                    {{ $tarjeta->numeroTarjeta }}
                                </option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary btn-sm mt-1" id="btnAddCard">
                                <i class="fas fa-credit-card">
                                </i>
                                Agregar tarjeta
                            </button>
                        </div>
                        @endif --}}
                        <div class="card-body" id="card_form"{{--  style="display:  {{ (count($tarjetas)>=1) ? 'none' : 'block' }}" --}}>
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="card-title">
                                        Tarjetas de Crédito
                                    </h6>
                                    <img alt="" class="img-fluid" src="{{ asset('images/cards1.png') }}">
                                    </img>
                                </div>
                                <div class="col-md-8" style="border-left: 1px solid #ccc;">
                                    <h6 class="card-title">
                                        Tarjetas de Débito
                                    </h6>
                                    <img alt="" class="img-fluid" src="{{ asset('images/cards2.png') }}" width="">
                                    </img>
                                </div>
                            </div>
                            <hr/>

                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                    <label for="formGroupExampleInput">
                                        Titular
                                    </label>
                                    <input aria-describedby="titular" autocomplete="off" data-openpay-card="holder_name" class="form-control" id="titular" name="titular" placeholder="Titular" type="text">
                                        <small class="form-text text-muted">
                                        </small>
                                    </input>
                                    <span class="text-danger error-titular errors">
                                    </span>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                    <label for="numero_tarjeta">
                                        Numero de tarjeta
                                    </label>
                                    <input aria-describedby="numero_tarjeta"   autocomplete="off" data-openpay-card="card_number" class="form-control" data-placement="right" data-toggle="tooltip" id="numero_tarjeta" name="numero_tarjeta" placeholder="1111222233334444" title="Tus datos estan cifrados de lado a lado" type="text">
                                        <small class="form-text text-muted">
                                        </small>
                                    </input>
                                    <span class="text-danger error-numero_tarjeta errors">
                                    </span>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">
                                        Fecha de vencimiento
                                    </label>
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <input class="form-control" id="mes" name="mes"  data-openpay-card="expiration_month" placeholder="Mes" type="text">
                                            </input>
                                            <span class="text-danger error-mes errors">
                                            </span>
                                        </div>
                                        <div class="col-lg-5 col-md-6">
                                            <input class="form-control" id="anio" name="anio" data-openpay-card="expiration_year"  placeholder="Año" type="text">
                                            </input>
                                            <span class="text-danger error-anio errors">
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="formGroupExampleInput2">
                                        CVV
                                    </label>
                                    <input autocomplete="off" class="form-control" data-openpay-card="cvv2" id="cvv2" maxlength="4" name="cvv2" placeholder="CVV" type="password"/>
                                    <span class="text-danger error-cvv2 errors">
                                    </span>
                                </div>
                               {{--  <div class="col-md-4 form-group">
                                    <label for="password">
                                        Tipo de Tarjeta
                                    </label>
                                    <select class="form-control" id="tipo" name="tipo">
                                        <option value="Debito">
                                            Debido
                                        </option>
                                        <option value="Credito">
                                            Crédito
                                        </option>
                                    </select>
                                    <span class="text-danger error-tipo errors">
                                    </span>
                                </div> --}}
                                <div class="col-md-4 form-group">
                                    <label for="password">
                                        Tipo de Tarjeta
                                    </label>
                                    <select class="form-control" id="red_bancaria" name="red_bancaria">
                                        <option value="VISA">
                                            Visa
                                        </option>
                                        <option value="Master Card">
                                            Master Card
                                        </option>
                                    </select>
                                    <span class="text-danger error-tipo errors">
                                    </span>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="email">
                                        Banco
                                    </label>
                                    <select class="js-example-responsive js-states form-control" id="banco" name="banco">
                                        @foreach ($bancos as $banco)
                                        <option value="{{ $banco->id }}">
                                            {{ $banco->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-banco errors">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row ml-2">
                            <div class="col-md-6 form-group">
                                {{-- <label for="confirmar_password">
                                    Fecha de primer descuento
                                </label> --}}
                                <input class="form-control datepicker" id="primer_descuento" name="primer_descuento" placeholder=""  type="hidden" value="2023-02-15">
                                </input>
                                {{-- <span class="text-danger error-primer_descuento errors">
                                </span> --}}
                            </div>
                            <div class="col-md-12 form-group form-check" style="margin-left: 12px">
                                <input class="form-check-input" id="terminos" name="terminos" type="checkbox">
                                    <label class="form-check-label" for="terminos">
                                        Acepto términos y condiciones
                                    </label>
                                </input>
                                <br/>
                                <span class="text-danger error-terminos errors">
                                </span>
                            </div>
                            <div class="col-md-12 form-group form-check" style="margin-left: 12px">
                                <input checked="" class="form-check-input" id="ofertas" name="ofertas" type="checkbox">
                                    <label class="form-check-label" for="ofertas">
                                        Recibir ofertas de
                                        <b>
                                            Mis Beneficios Vacacionales
                                        </b>
                                    </label>
                                </input>
                            </div>
                            <div class="form-group col-md-12 mt-2">
                                {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                <span class="text-danger error-g-recaptcha-response errors">
                                </span>
                            </div>
                            <div class="col-md-4 text-center">
                                {{-- {!! NoCaptcha::displaySubmit('Enviar', ['class' => 'btn btn-primary btn-block'])!!} --}}
                                <button class="btn btn-primary btn-block" type="submit">
                                    <i class="fa fa-credit-card">
                                    </i>
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#primer_descuento_old').datepicker({
            format: "yyyy-mm-dd",
            autoUpdateInput: true,
            startDate: '-1d',
            endDate: '+2m',
            autoclose:true,
            language: 'es'
        });
        var element = document.getElementById('numero_tarjeta');
        var maskOptions = {
            mask: '0000000000000000'
        };
        var mask = IMask(element, maskOptions);
        var element2 = document.getElementById('cvv2');
        var maskOptions2 = {
            mask: '0000'
        };
        var mask = IMask(element2, maskOptions2);
        var element3 = document.getElementById('mes');
        var maskOptions3 = {
            mask: '00'
        };
        var mask = IMask(element3, maskOptions3);
        var element3 = document.getElementById('anio');
        var maskOptions3 = {
            mask: '00'
        };
        var mask = IMask(element3, maskOptions3);

        $('#btnAddCard').click(function(event) {
            event.preventDefault();
            $('#card_form').css('display', 'block');
        });

        $('body').on('submit', '#form_card_mx', function(e) {
            e.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $("#overlay").css("display", "block");
                },
                success: function(res) {
                    if (res.success == false) {
                        $("#overlay").css("display", "none");
                        pintar_errores(res.errors);
                    }
                    if (res.success == true) {
                        $('#form_card_mx').trigger('reset');
                        Swal.fire({
                            icon: 'success',
                            title: '¡Registro exitosamente!',
                            showConfirmButton: true,
                        });

                        setTimeout(function() {
                            window.location.href = res.url;
                        }, 1000);
                    }
                }
            })
            .done(function() {

            })
            .fail(function() {

            })
            .always(function() {
                $("#overlay").css("display", "none");
            });


        });

    });


</script>
@endsection

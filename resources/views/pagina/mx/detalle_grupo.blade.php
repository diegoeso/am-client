@extends('layouts.pagina.app')
<style>
    .errors {
        font-size: 12px;
    }
</style>
@section('content')
@php
    switch ($title) {
        case 'sep':
           $img = asset('images/estancias/acapulco_sep.png');
            break;
        
        case 'oct':
          $img = asset('images/estancias/acapulco_oct.png');
            break;
        
        case 'nov':
           $img = asset('images/estancias/acapulco_nov.png');
            break;
        
        default:
              $img = asset('images/estancias/acapulco_dic.png');
            break;
    }
@endphp
<form id="form_compra">
    <section class="event_part">
        <h2 class="text-center">
            {{ $estancia->title }}
        </h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single_event_slider">
                        <div class="row justify-content-end">
                            <div class="col-lg-5 col-md-6">
                                <div class="event_slider_content text-center">
                                    <p>Fecha seleccionada</p>
                                    <img alt="" id="img_grupo" class="img-fluid img-thumbnail" src="{{ $img }}">
                                    </img>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 ">
                                <div class="event_slider_content">
                                    <p>
                                        {!! $estancia->descripcion !!}
                                    </p>
                                    <div class="row ">
                                         <div class="col-md-10 form-group">
                                            <label for="nombre">
                                                Selecciona la fecha ideal para ti
                                            </label>
                                            <select name="fecha_inicio" id="fecha_inicio" class="form-control">
                                                <option value="sep" @if ($title == "sep") selected @endif>07 al 10 de septiembre, 2023</option>
                                                <option value="oct" @if ($title == "oct") selected @endif>19 al 22 octubre, 2023</option>
                                                <option value="nov" @if ($title == "nov") selected @endif>09 al 12 noviembre, 2023</option>
                                                <option value="dic" @if ($title == "dic") selected @endif>14 al 17 diciembre, 2023</option>
                                            </select>
                                        </div>
                                        <div class="col-md-10 form-group">
                                            <label for="nombre">
                                                Numero de adultos
                                            </label>
                                            <select name="adultos" id="adultos" class="form-control">
                                                <option value="2" selected>2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                        <div class="col-md-10 form-group">
                                            <label for="nombre">
                                                Infante o menor de 0 a 5 años y 11 meses cumplidos
                                            </label>
                                            <select name="infantes" id="infantes" class="form-control">
                                                <option value="0">0</option>
                                                <option value="2">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                        <div class="col-md-10 form-group">
                                            <label for="nombre">
                                               Menor de edad entre los 6 y 12 años
                                            </label>
                                            <select name="menores" id="menores" class="form-control">
                                                 <option value="0">0</option>
                                                <option value="2">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{--
                                    <a class="btn_1" href="#">
                                        Plan Details
                                    </a>
                                    --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="hotel_list single_page_hotel_list mb-5">
        <div class="container">
            <div class="row justify-content-between">
                @guest()
                <div class="col-xl-12" style="margin-bottom: -20px;">
                    <div class="section_tittle" id="titulo">
                        <h2 class="text-center">
                            Paso 1
                        </h2>
                        <p class="text-center">
                            Datos personales
                        </p>
                    </div>
                </div>
                @endguest
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-12">
                            @csrf
                            <input name="estancia_id" type="hidden" value="{{ $estancia->id }}"/>
                            <input type="hidden" value="{{ $title }}" name="title">
                            <input type="hidden" value="{{ $fecha }}" name="fecha">
                            <input type="hidden" value="{{ $segmentos }}" name="segmentos">
                            @guest()
                            <div class="row" id="form_data">
                                <div class="col-lg-4 col-md-6 form-group">
                                    <label for="nombre">
                                        Nombre
                                    </label>
                                    <input aria-describedby="Nombre" class="form-control error" id="nombre" name="nombre" placeholder="Nombre (s)" type="text" value="">
                                        <span class="text-danger error-nombre errors">
                                        </span>
                                    </input>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group">
                                    <label for="apellidos">
                                        Apellidos
                                    </label>
                                    <input aria-describedby="apellidos" class="form-control" id="apellidos" name="apellidos" placeholder="Apellido (s)" type="text" value="">
                                        <span class="text-danger error-apellidos errors">
                                        </span>
                                    </input>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group">
                                    <label for="telefono">
                                        Teléfono
                                    </label>
                                    <input aria-describedby="telefono" class="form-control" id="telefono" name="telefono" placeholder="1234567890" type="text" value="">
                                        <span class="text-danger error-telefono errors">
                                        </span>
                                    </input>
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">
                                    <label for="username">
                                        Correo Electrónico
                                    </label>
                                    <input aria-describedby="username" class="form-control" id="username" name="username" placeholder="ejemplo@dominio.com" type="email" value="">
                                        <span class="text-danger error-username errors">
                                        </span>
                                    </input>
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">
                                    <label for="password">
                                        Contraseña
                                    </label>
                                    <input aria-describedby="password" class="form-control" id="password" name="password" type="password">
                                        <span class="text-danger error-password errors">
                                        </span>
                                    </input>
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">
                                    <label for="confirmar_password">
                                        Confirmar Contraseña
                                    </label>
                                    <input class="form-control" id="password_confirmation" name="password_confirmation" type="password">
                                    </input>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6 form-group">
                                    <label for="cp">
                                        {{ __('messages.user.show.cp') }}
                                    </label>
                                    <input aria-describedby="codigo_postal" class="form-control" id="cp" name="cp" onkeyup="buscar_cp()" placeholder="12345" type="text" value="">
                                    </input>
                                    <span class="text-danger error-cp errors">
                                    </span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cp">
                                        {{ __('messages.user.show.ciudad') }}
                                    </label>
                                    <input class="form-control" id="estado" name="estado" placeholder="Estado" type="text" value=""/>
                                    <span class="text-danger error-estado errors">
                                    </span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cp">
                                        {{ __('messages.user.show.estado') }}
                                    </label>
                                    <input class="form-control" id="delegacion" name="delegacion" placeholder="Delegación" type="text" value=""/>
                                    <span class="text-danger error-delegacion errors">
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cp">
                                        Colonia
                                    </label>
                                    <select class="form-control" id="colonia" name="colonia">
                                        <option value="0">
                                            SELECCIONA TU COLONIA
                                        </option>
                                    </select>
                                    <span class="text-danger error-colonia errors">
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Dirección
                                        </label>
                                        <textarea class="form-control" cols="20" id="direccion" name="direccion" placeholder="Dirección" rows="2"></textarea>
                                        <span class="text-danger error-direccion errors">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endguest
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary mr-2" data-id="user_data" id="btnSiguiente" type="button">
                                        Siguiente
                                        <i class="fas fa-arrow-right">
                                        </i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                  
            </div>
        </div>
    </section>
  </form>
@endsection

@section('script')
<script>
    $(document).ready(function() {
            $('body').on('click', '.btnDetalles', function(event) {
                event.preventDefault();
                var id_estancia = $('#btnDetalles').attr('value');
                $('#modalDetalles').modal('show');
            });

            $('body').on('click', '#btnSiguiente', function(event) {
                event.preventDefault();
                $.ajax({
                    url: baseuri + 'tienda-grupo',
                    type: 'GET',
                    dataType: 'json',
                    data: $('#form_compra').serialize(),
                    beforeSend: function() {
                        $("#overlay").css("display", "block");
                    },
                    success: function(res) {
                        if (res.success == false) {
                            $("#overlay").css("display", "none");
                            if (res.exceptions) {
                                toastr['error'](res.exceptions);
                                toastr['error']('Intentar nuevamente mas tarde.');
                            }else{
                                pintar_errores(res.errors);
                            }
                        }
                        if (res.success == true) {
                            window.location.href = res.card;
                        }
                    }
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    $("#overlay").css("display", "none");
                    toastr['error'](errorThrown);
                    toastr['error'](jqXHR.responseJSON.message);
                })
                .always(function(){
                    $("#overlay").css("display", "none");
                });
            });


            $(document).on('click', '#btnRegistrar', function(event) {
                event.preventDefault();
                $.ajax({
                    url: baseuri + 'tienda',
                    type: 'POST',
                    dataType: 'json',
                    data: $('#form_compra').serialize(),
                    success: function(res) {
                        if (res.success == false) {
                            pintar_errores(res.errors);
                        }
                    }
                });
            });

            $(document).on('change', '#fecha_inicio', function(event) {
                event.preventDefault();
                var select = $(this).val();

                switch (select) {
                    case 'sep':
                       $img = "{{ asset('images/estancias/acapulco_sep.png') }}";
                        break;
                    
                    case 'oct':
                      $img = "{{ asset('images/estancias/acapulco_oct.png') }}";
                        break;
                    
                    case 'nov':
                       $img = "{{ asset('images/estancias/acapulco_nov.png') }}";
                        break;
                    
                    default:
                          $img = "{{ asset('images/estancias/acapulco_dic.png') }}";
                        break;
                }

                $('#img_grupo').attr('src', $img);
            });


        });

        function buscar_cp(cp) {
            var cp = $("#cp").val();
            if (cp.length < 5) return 0;
            $.ajax({
                url: baseuri + 'cp/' + cp,
                type: 'GET',
                dataType: 'json',
                beforeSend:function(){
                },
                success: function(res) {
                    console.log(res);
                    $('#colonia').html('');
                    $("#estado").val(res.info[0].id_estado);
                    $("#delegacion").val(res.info[0].id_municipio);
                    if (res.colonia.length > 0) {
                        for (var i = 0; i < res.colonia.length; i++) {
                            $('#colonia').append('<option value=' + res.colonia[i].id + '>' + res.colonia[i]
                                .colonia + '</option>');
                        }
                    }
                }
            })
            .always(function() {
            });
        }

        function pintar_errores(errores = null) {
            $(".errors").html('');
            $(".errors").parent().removeClass('has-error');
            $.each(errores, function(k, v) {
                $(".error-" + k).html(v + ' <br/>');
                $(".error-" + k).parent().addClass('has-error');
            });
        }
</script>
@endsection

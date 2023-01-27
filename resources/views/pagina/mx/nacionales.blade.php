@extends('layouts.pagina.app')

@section('content')
<section class="breadcrumb breadcrumb_bg" style="background-image: url({{ asset('images/portada_am.png') }})">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item text-center">
                        <h2>
                            Conoce nuestros paquetes para destinos nacionales
                        </h2>
                        <p class="lead">
                            @if ($convenio != null)
                                    {{ $convenio->welcome }}
                                @else
                                    {{ session()->get('convenio_id') != '1208' ? (session()->get('welcome') != null ? session()->get('convenio_nombre') : session()->get('welcome')) : '' }}
                                @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="hotel_list single_page_hotel_list mt-5">
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-xl-12">
                <div class="section_tittle">
                    <h2 class="">
                        Destinos Nacionales
                            {{ $convenio->empresa_nombre != 'Cliente MX Referido 2018' ? $convenio->empresa_nombre : ' Mis Beneficios Vacacionales' }}
                    </h2>
                    <p>
                        <ul>
                            <li>
                                • {{ env('CUOTAS') }} cómodos pagos quincenales para 2 personas y 2 menores.
                            </li>
                            <li>
                                • Los paquetes son totalmente transferibles.
                            </li>
                            <li>
                                • Precios muy por debajo de las tarifas que ofrecen los hoteles que manejamos.
                            </li>
                            <li>
                                • No es necesario decidir fecha o destino del viaje al momento de la inscripción.
                            </li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($estancias as $estancia)
                @if ($estancia->title != 'Angel Viajero')
            <div class="col-lg-12 col-sm-12 mb-5">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <div class="single_ihotel_list">
                            <img alt="" src="{{ asset($estancia->imagen_de_reemplazo) }}">
                            </img>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="hotel_text_iner">
                            <h3 class="mt-3">
                                <a href="{{ route('detalle_estancia', $estancia->id) }}">
                                    {{ $estancia->title }}
                                </a>
                            </h3>
                            <p>
                                <strong>
                                    Destinos:
                                </strong>
                                <br/>
                                {!! $estancia->descripcion !!}
                            </p>
                            <h5>
                                <span>
                                    Desde: ${{ number_format(($estancia->precio/$estancia->cuotas),2) .' '. $estancia->divisa}} Quincenales
                                </span>
                            </h5>
                            <a class="genric-btn info" href="{{ route('detalle_estancia', $estancia->id) }}">
                                Seleccionar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            @endif
            @endforeach
        </div>
    </div>
</section>
<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="modalDetalles" style="margin-top: 80px;" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="estancia_titulo" style="color: black;">
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">
                    Cerrar
                </button>
                <a class="btn btn-primary btn-sm" id="bntInscribir" type="button">
                    Inscribirse
                </a>
            </div>
        </div>
    </div>
</div>
@include('pagina.mx.elementos.modal_preregistro')
@endsection


@section('script')
<script>
    $('body').on('click', '#btnDetalles', function(event) {
            event.preventDefault();
            var id_estancia = $(this).attr('value');
            var titulo = $(this).data('titulo');
            $.ajax({
                url: baseuri + 'estancia-detalles/' + id_estancia,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    $("#overlay").css("display", "block");
                },
                success: function(res) {
                    $("#overlay").css("display", "none");
                    if (res.success == true) {
                        $('#modalDetalles #estancia_titulo').html('Detalles: ' + titulo);
                        $('#modalDetalles #modal_content').html(res.estancia.descripcion);
                        $('#bntInscribir').attr('href', baseuri + 'detalle-estancia/' + res.estancia
                            .id);
                        $('#modalDetalles').modal('show');
                    }
                },
            });
        });
</script>
@endsection

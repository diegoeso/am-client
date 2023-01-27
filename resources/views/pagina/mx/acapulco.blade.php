@extends('layouts.pagina.app')
@section('content')
    <style>
        .breadcrumb_bg_1 {
            background-image: url("{{ asset('images/portada_am.png') }}");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .errors {
            font-size: 12px;
        }
    </style>
    <section class="breadcrumb breadcrumb_bg" style="background-image: url({{ asset('images/portada_am.png') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item text-center">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="hotel_list single_page_hotel_list mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="section_tittle">
                        <h2 class="text-danger">
                            Bienvenido {{($convenio->empresa_nombre != 'Cliente MX Referido 2018') ? $convenio->empresa_nombre : 'a Amando a México'}}
                        </h2>
                        <p>
                            ¿Por qué debo registrarme a este beneficio?
                        <ul class="list-unstyled">
                            <li>
                                Confia en nuestra marca, tu compañia lo hizo primero.
                            </li>
                            <li>
                                NO verificamos historial crediticio.
                            </li>
                            <li>
                                Regístrate ahora decide fecha y destino después
                            </li>
                            <li>
                                Paga a plazos con CERO intereses
                            </li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
            <section class="mb-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 heading-section text-center ftco-animate">
                            <h2 class="mb-4_ text-uppercase text-info">
                                Selecciona tu destino
                            </h2>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-md-4 col-sm-6 ftco-animate mb-3">
                            <div class="project-destination">
                                <a class="img" href="{{ route('nacionales') }}" style="background-image: url(https://leosystem.travel/wp-content/uploads/2020/08/1061776562.jpg);">
                                    <div class="text">
                                    <span>
                                        Destinos Nacionales
                                    </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 ftco-animate mb-3">
                            <div class="project-destination">
                                <a class="img" href="{{ route('internacionales') }}" style="background-image: url(https://u.realgeeks.media/mykeybrokers/Miami_BEach.jpg);">
                                    <div class="text">
                                    <span>
                                        Destinos Internacionales
                                    </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        {{--
                        <div class="col-lg-3 col-md-4 col-sm-6 ftco-animate mb-3">
                            <div class="project-destination">
                                <a class="img" href="{{ route('cruceros') }}" style="background-image: url(http://www.miramarcruceros.com/blog/wp-content/uploads/2016/03/RN-Exterior.jpg);">
                                    <div class="text">
                                        <span>
                                            Cruceros
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 ftco-animate mb-3">
                            <div class="project-destination">
                                <a class="img" href="{{ route('cotizador') }}" style="background-image: url(https://dicas.viagempronta.com/wp-content/uploads/2020/01/Iberostar-Punta-Cana.jpg);">
                                    <div class="text">
                                        <span>
                                            Cotizador
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        --}}
                    </div>
                </div>
            </section>
        </div>
    </section>
    @include('pagina.mx.elementos.modal_preregistro')
@endsection


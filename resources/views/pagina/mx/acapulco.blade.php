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
                        <h2 class="text-danger text-center">
                            Bienvenido a {{ env('APP_NAME') }} y  conozcamos juntos Acapulco, un paraíso mexicano.
                        </h2>
                        <p>
                            ¿Por qué debo registrarme a este beneficio?
                        <ul class="list-unstyled">
                            <li>
                                Confía en nuestra marca, tu compañia lo hizo primero.
                            </li>
                            <li>
                                NO verificamos historial crediticio.
                            </li>
                         {{--    <li>
                                Regístrate ahora decide fecha y destino después
                            </li> --}}
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
                                Selecciona tu fecha ideal
                            </h2>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-4 col-sm-6 ftco-animate mb-3">
                            <div class="project-destination">
                                <a class="img" href="{{ route('grupo.acapulco',['sep', '12', '2023-02-15'] ) }}" style="background-image: url({{ asset('images/acapulco_sep.png') }});">
                                  {{--   <div class="text">
                                    <span>
                                        Seleccionar
                                    </span>
                                    </div> --}}
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 ftco-animate mb-3">
                            <div class="project-destination">
                                <a class="img" href="{{ route('grupo.acapulco',['oct', '14', '2023-02-15'] ) }}" style="background-image: url({{ asset('images/acapulco_oct.png') }});">
                                  {{--   <div class="text">
                                    <span>
                                        Seleccionar
                                    </span>
                                    </div> --}}
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 ftco-animate mb-3">
                            <div class="project-destination">
                                <a class="img" href="{{ route('grupo.acapulco',['nov', '17', '2023-02-15'] ) }}" style="background-image: url({{ asset('images/acapulco_nov.png') }});">
                                   {{--  <div class="text">
                                        <span>
                                            Seleccionar
                                        </span>
                                    </div> --}}
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 ftco-animate mb-3">
                            <div class="project-destination">
                                <a class="img" href="{{ route('grupo.acapulco',['dic', '20', '2023-02-15'] ) }}" style="background-image: url({{ asset('images/acapulco_dic.png') }});">
                                {{--     <div class="text">
                                        <span>
                                            Seleccionar
                                        </span>
                                    </div> --}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    @include('pagina.mx.elementos.modal_preregistro')
@endsection


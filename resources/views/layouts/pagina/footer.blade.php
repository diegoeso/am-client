<footer class="footer-area">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-sm-4 col-md-4">
                <img alt="" class="img-fluid" src="{{ asset('images/mis_beneficios.png') }}">
                </img>
                <div class="single-footer-widget footer_icon mt-3">
                    {{--
                    <h4>
                        {{ env('APP_NAME') }}
                    </h4>
                    --}}
                    <p>
                        Heriberto Frías #408, Interior 3, Colonia Narvarte Poniente CDMX. CP: 03020
                    </p>

                    <span>
                        Teléfono sin costo desde el interior:
                        <br/>
                        <a href="tel:5589263266">
                            5589263266
                        </a>
                        <br/>
                        <a href="tel:5541708423">
                            5541708423
                        </a>
                    </span>

                    <div class="social-icons">
                        <a href="https://www.facebook.com/Misbeneficiosvacacionales" target="_blank">
                            <i class="ti-facebook">
                            </i>
                        </a>
                        <a href="https://www.instagram.com/misbeneficios_vacacionalesmx/" target="_blank">
                            <i class="ti-instagram">
                            </i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FMisbeneficiosvacacionales&tabs=timeline&width=0&height=0&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="0" height="0" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
            </div>
            <div class="col-sm-6 col-md-4">

                <div class="single-footer-widget">
                    <h4>
                        Mapa del sitio
                    </h4>
                    <ul>
                        <li>
                            <a href="{{ route('nosotros') }}">
                                Nosotros
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('fraude') }}">
                                Alerta de fraude
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('mision') }}">
                                Misión  y Visión
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('privacidad') }}">
                                Aviso de privacidad
                            </a>
                        </li>
                        <li>
                            <a href="https://bolsa.beneficiosvacacionales.mx/">
                                Bolsa de trabajo
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('empresas_afiliadas') }}">
                                Empresas afiliadas
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('beneficios_empresa') }}">
                                Beneficios
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('hoteles') }}">
                                Hoteles amigo
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('preguntas') }}">
                                Preguntas Frecuentes
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('productos') }}">
                                Nuestros productos
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="copyright_part_text text-center">
                    <p class="footer-text m-0">
                        Copyright ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        @if (env('APP_PAIS')=='mx')
                                :: Todos los Derechos Reservados
                        <b>
                            {{ env('APP_NAME') }}
                        </b>
                        @else
                               All rights reserved
                               @if (env('APP_ID') == 'optucorp')
                        <b>
                            {{ env('APP_NAME_OPT') }}
                        </b>
                        @else
                        <b>
                            {{ env('APP_NAME_USA') }}
                        </b>
                        @endif
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

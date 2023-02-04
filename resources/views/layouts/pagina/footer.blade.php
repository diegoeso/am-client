<footer class="footer-area">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-sm-4 col-md-4">
                <img alt="" class="img-fluid" src="{{ asset('images/am/logo_am.png') }}">
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

                    <span class="text-white">
                        Teléfono sin costo desde el interior:
                        <a href="tel:5541708423" class="text-white">
                            5541708423
                        </a>
                    </span>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/amandoamexicoficial" target="_blank">
                            <i class="ti-facebook">
                            </i>
                        </a>
                        <a href="https://www.instagram.com/amandoamexico_/" target="_blank">
                            <i class="ti-instagram">
                            </i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
             <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Famandoamexicoficial&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=758684681966172" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
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
                <div class="copyright_part_text text-center" >
                    <p class="footer-text m-0 text-white">
                        Copyright ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        :: Todos los Derechos Reservados
                        <b class="text-success">
                            {{ env('APP_NAME') }}
                        </b>
                        
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

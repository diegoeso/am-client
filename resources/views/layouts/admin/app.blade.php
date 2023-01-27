<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="" name="Sistema administrativo Beneficios Vacacionales"/>
        <meta content="" name="ISW. Diego Enrique Sanchez"/>
        <meta content="{{ csrf_token() }}" name="csrf-token"/>
        {{--
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
        --}}
        @switch(env('APP_ID'))
            @case('usoptucorp')
                <link href="{{ asset('images/icono01.png') }} " rel="icon" sizes="16x16" type="image/png"/>
            @break
            @case('mytravel')
                <link href="{{ asset('images/icono01.png') }} " rel="icon" sizes="16x16" type="image/png"/>
            @break
            @case('am')
                <link href="{{ asset('images/am/icono.png') }} " rel="icon" sizes="16x16" type="image/png"/>
            @break
            @default
                <link href="{{ asset('images/icono01.png') }} " rel="icon" sizes="16x16" type="image/png"/>
            @endswitch
        <title>
            Bienvenido {{ env('APP_NAME') }}
        </title>
        <!-- Scripts -->
        {{-- @yield('scriptvuejs') --}}
        @include('layouts.admin.head')
        <style type="text/css">
            table{
                font-size: 14px;
            }
            .table{
                font-size: 14px;
            }

            .dataTables_filter .dataTables_length .dataTables_info{
                font-size: 12px;
            }

            .dataTables_paginate .paging_simple_numbers{
                font-size: 12px;
            }
            /*.historico h2{
                font-size: 14px;
                color: #009efb;
                line-height: 20px;
            }

            .historico h2::before { 
                content: '\A';
                white-space: pre;
             }
            
            .historico h2 > ul >li{
                font-size: 13px;
                color: black;
            }
            .historico h2 > span{
                font-size: 12px;
                color: black;
            }*/
            #loading {
                position: fixed;
                display: flex;
                text-align: center;
                top: 0;
                left: 0;
                z-index: 9999;
                /*100*/
                background-color: #1f1f1f85;
                width: 100%;
                color: #fff;
                height: 100vh;
                justify-content: center;
                align-items: center;
            }

 
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #222222bf;
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                transition: 1s all;
                opacity: 0.9;
            }

            .overlay__inner {
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                position: absolute;
            }

            .overlay__content {
                left: 50%;
                position: absolute;
                top: 50%;
                transform: translate(-50%, -50%);
            }

            .overlay__content >img {
                animation-name: example;
                animation-duration: 0.8s;
                animation-iteration-count: infinite;
                opacity: 1;
                width: 20em;
                display: block;
                margin:auto;
                vertical-align: middle; /*Vertically centered*/
                text-align: center;
            @keyframes example {
                from {
                    opacity: 0.2;
                }

                to {
                    opacity: 1;
                }
            }
            }

            .fondo{

            }

            .errors{
                font-size: 12px;
            }
           /* .dataTable thead{
                font-size: 11px;
            }

            .dataTable tbody tr{
                font-size: 11px;
            }*/

             .form-control {
                border-radius: 0;
                box-shadow: none;
                border-color: #d2d6de
            }

            .select2-hidden-accessible {
                border: 0 !important;
                clip: rect(0 0 0 0) !important;
                height: 1px !important;
                margin: -1px !important;
                overflow: hidden !important;
                padding: 0 !important;
                position: absolute !important;
                width: 1px !important
            }

            .form-control {
                display: block;
                width: 100%;
                height: 34px;
                padding: 6px 12px;
                font-size: 14px;
                line-height: 1.42857143;
                color: #555;
                background-color: #fff;
                background-image: none;
                border: 1px solid #ccc;
                border-radius: 4px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
                -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s
            }

            .select2-container--default .select2-selection--single,
            .select2-selection .select2-selection--single {
                border: 1px solid #d2d6de;
                border-radius: 0;
                padding: 6px 12px;
                height: 34px
            }

            .select2-container--default .select2-selection--single {
                background-color: #fff;
                border: 1px solid #aaa;
                border-radius: 4px
            }

            .select2-container .select2-selection--single {
                box-sizing: border-box;
                cursor: pointer;
                display: block;
                height: 28px;
                user-select: none;
                -webkit-user-select: none
            }

            .select2-container .select2-selection--single .select2-selection__rendered {
                padding-right: 10px
            }

            .select2-container .select2-selection--single .select2-selection__rendered {
                padding-left: 0;
                padding-right: 0;
                height: auto;
                margin-top: -3px
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                color: #444;
                line-height: 28px
            }

            .select2-container--default .select2-selection--single,
            .select2-selection .select2-selection--single {
                border: 1px solid #d2d6de;
                border-radius: 0 !important;
                padding: 6px 12px;
                height: 40px !important
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 26px;
                position: absolute;
                top: 6px !important;
                right: 1px;
                width: 20px
            }
        </style>
    </head>
    <body class="fix-header card-no-border logo-center">
        <canvas style="position: absolute;">
        </canvas>
        @include('admin.elementos.views.efecto_nieve')
        <div class="preloader">
            <svg class="circular" viewbox="25 25 50 50">
                <circle class="path" cx="50" cy="50" fill="none" r="20" stroke-miterlimit="10" stroke-width="2">
                </circle>
            </svg>
        </div>
        <div class="overlay" id="overlay" style="display: none;">
            <div class="overlay__inner">
                <div class="overlay__content">
                    {{-- @if (env('APP_PAIS_ID') == 1)--}}
                    <img src="{{asset('images/icono01.png')}}" style="width: 350px;"/>
                    {{--     @else
                    <img src="{{asset('images/eu/my_travel.png')}}"/>
                    @endif --}}
                </div>
            </div>
        </div>
        <div id="main-wrapper">
            <header class="topbar">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            @switch(env('APP_ID'))
                                 @case('usoptucorp')
                                    <img alt="homepage" class="dark-logo hidden-sm-down" src="{{ asset('images/mis_beneficios.png') }}" width="150px"/>
                                     <img alt="homepage" class="light-logo hidden-sm-down" src="{{ asset('images/mis_beneficios.png') }}" width="150px"/>
                                @break
                                @case('mytravel')
                                   <img alt="homepage" class="dark-logo hidden-sm-down" src="{{ asset('images/mis_beneficios.png') }}" width="150px"/>
                                     <img alt="homepage" class="light-logo hidden-sm-down" src="{{ asset('images/mis_beneficios.png') }}" width="150px"/>
                                @break
                                @case('am')
                                    <img alt="homepage" class="dark-logo hidden-sm-down" src="{{ asset('images/am/logo_banner_am.png') }}" width="300px"/>
                                    <img alt="homepage" class="light-logo hidden-sm-down" src="{{ asset('images/am/logo_banner_am.png') }}" width="300px"/>
                                @break
                                @default
                                    <img alt="homepage" class="dark-logo hidden-sm-down" src="{{ asset('images/mis_beneficios.png') }}" width="150px"/>
                                     <img alt="homepage" class="light-logo hidden-sm-down" src="{{ asset('images/mis_beneficios.png') }}" width="150px"/>
                            @endswitch
                            {{--  @if (env('APP_PAIS_ID') == 1)--}}
                          
                            {{--   @else
                            <img alt="homepage" class="dark-logo hidden-sm-down" src="{{ asset('images/eu/my_travel.png') }}" width="120px"/>
                            <img alt="homepage" class="light-logo hidden-sm-down" src="{{ asset('images/eu/my_travel.png') }}" width="120px"/>
                            @endif --}}
                        </a>
                    </div>
                    <div class="navbar-collapse">
                        <ul class="navbar-nav mr-auto mt-md-0">
                            <li class="nav-item">
                                <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)">
                                    <i class="mdi mdi-menu">
                                    </i>
                                </a>
                            </li>
                            @if (Auth::user()->role != 'client')
                            <li class="nav-item hidden-sm-down search-box">
                                <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)">
                                    <i class="ti-search">
                                    </i>
                                </a>
                                <form class="app-search" id="app_search">
                                    <input class="form-control" id="text_search" name="text_search" placeholder="Buscar..." type="text">
                                        <a class="srh-btn">
                                            <i class="ti-close">
                                            </i>
                                        </a>
                                    </input>
                                </form>
                            </li>
                            @endif
                        </ul>
                        <ul class="navbar-nav my-lg-0">
                            <li class="nav-item dropdown">
                                <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle text-muted waves-effect waves-dark" data-toggle="dropdown" href="">
                                    <i class="fas fa-user">
                                    </i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right scale-up">
                                    <ul class="dropdown-user">
                                        <li>
                                            <div class="dw-user-box">
                                                <div class="u-text">
                                                    <h4>
                                                        {{ Auth::user()->fullName }}
                                                    </h4>
                                                    <p class="text-muted">
                                                        {{ Auth::user()->username }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        @if (env('APP_PAIS_ID') != 7)
                                        <li class="divider" role="separator">
                                        </li>
                                        <li>
                                            <a data-target="#modalColor" data-toggle="modal" href="javascript():;">
                                                <i aria-hidden="true" class="fa fa-paint-brush">
                                                </i>
                                                Cambiar color
                                            </a>
                                        </li>
                                        @endif
                                        <li class="divider" role="separator">
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="fa fa-power-off">
                                                </i>
                                                {{ __('messages.cliente.salir') }}
                                            </a>
                                            <form action="{{ route('logout') }}" class="d-none" id="logout-form" method="POST">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            @if (Auth::user()->username == 'dsanchez@pacifictravels.mx')
            <div class="">
                <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10">
                    <i class="ti-settings text-white">
                    </i>
                </button>
            </div>
            @endif
            <aside class="left-sidebar">
                <div class="scroll-sidebar">
                    @include('layouts.admin.menus.'.Auth::user()->role)
                </div>
            </aside>
            <div class="page-wrapper" id="">
                <div class="container-fluid" id="main">
                    {{--
                    <div class="row">
                        <div class="alert alert-info mt-2">
                            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                <span aria-hidden="true">
                                    ×
                                </span>
                            </button>
                            <h3 class="text-info">
                                <i class="fa fa-exclamation-circle">
                                </i>
                                Información
                            </h3>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </div>
                    </div>
                    --}}
                    @yield('content')
                    <!-- ============================================================== -->
                    <!-- Right sidebar -->
                    <!-- ============================================================== -->
                    <!-- .right-sidebar -->
                    <div class="right-sidebar">
                        <div class="slimscrollright">
                            <div class="rpanel-title">
                                Opciones de sistema
                                <span>
                                    <i class="ti-close right-side-toggle">
                                    </i>
                                </span>
                            </div>
                            <div class="r-panel-body">
                                <ul class="m-t-20">
                                    <li>
                                        <a class="btn btn-rounded btn-outline-primary btn-block" href="javascript:void(0)">
                                            <i class="fas fa-trash">
                                            </i>
                                            Eliminar cache
                                        </a>
                                    </li>
                                    <li>
                                        <a class="btn btn-rounded btn-outline-warning btn-block" href="javascript:void(0)">
                                            <i class="fas fa-cogs">
                                            </i>
                                            Tabla de procesos
                                        </a>
                                    </li>
                                    <li>
                                        <a class="btn btn-rounded btn-outline-info btn-block" href="javascript:void(0)">
                                            <i class="fa fa-terminal">
                                            </i>
                                            Notificaciones
                                        </a>
                                    </li>
                                    <li>
                                        <a class="btn btn-rounded btn-outline-success btn-block" href="{{ url('log-viewer') }}">
                                            <i class="fa fa-warning">
                                            </i>
                                            Log Viewer
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Right sidebar -->
                    <!-- ============================================================== -->
                </div>
                <footer class="footer" style="width: 100%">
                    <p class="footer-text pull-left m-0">
                        Copyright ©
                        2022
                        Todos los Derechos Reservados ::
                        <b>
                            {{ env('APP_NAME') }}
                        </b>
                    </p>
                    <b class="pull-right hidden-xs-down hidden-sm-down hidden-md-down">
                        Design & Development by:
                        <a href="">
                            Isw. Diego Sanchez
                        </a>
                    </b>
                </footer>
            </div>
        </div>
        @include('admin.elementos.modales.modalSearch')
        @include('admin.elementos.modales.modalHistorial')
        @include('admin.elementos.modales.modalHistorialEmpresa')
        @include('admin.elementos.modales.modalHistorialPagos')
        @include('admin.elementos.modales.modalLog')
        @include('admin.elementos.modales.modalAddTarjeta')
        @include('admin.elementos.modales.modalAddContrato')
        @include('admin.elementos.modales.modalCalculador')
        @include('admin.elementos.modales.modalShowPagos')
        @include('admin.elementos.modales.modalVerContrato')
        @include('admin.elementos.modales.modalBuscarCliente')
        @include('admin.elementos.modales.modalCambioEstancia')
        @include('admin.elementos.modales.modalAddPago')
        @include('admin.elementos.modales.modalGeneral')
        @include('admin.elementos.modales.modalAutorizar')
        @include('admin.elementos.modales.modalDesTarjetas')
        @include('admin.elementos.modales.modalRechazarPago')
        @include('admin.elementos.modales.modalColor')
        @include('admin.elementos.modales.modalEmpresa')
        @include('admin.elementos.modales.modalAddReservacion')
        <script>
            var userAgent = new UserAgent().parse(navigator.userAgent);

            // console.log(userAgent);
            if(@json(config('app.locale')) == 'es'){
                $.extend( $.fn.dataTable.defaults, {
                    language:{
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });

                $.datepicker.regional['es'] = {
                    closeText: 'Cerrar',
                    prevText: '< Ant',
                    nextText: 'Sig >',
                    currentText: 'Hoy',
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                    weekHeader: 'Sm',
                    dateFormat: 'dd/mm/yy',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''
                };

                $.datepicker.setDefaults($.datepicker.regional['es']);
            }
            

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                // "positionClass": "toast-top-center",
                "positionClass": "toast-top-full-width",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "500",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            $('[data-toggle="tooltip"]').tooltip();
            // $.fn.select2.defaults.set("theme", "bootstrap4");
            // 
            // 
            // console.log(userAgent['isDesktop']);

            if(userAgent['isDesktop'] == true){
                $('.custom-select').select2();
                $('.custom-select').addClass('select2');
                $('.custom-select').addClass('select2-hidden-accessible');
            }else{
                $('.custom-select').removeClass('select2');
                $('.custom-select').removeClass('select2-hidden-accessible');
                $('.custom-select').removeAttr("style");
            }

            $('.datepicker').datepicker({
                dateFormat: "yy-mm-dd",
                autoclose:true,
                autoUpdateInput: true,
                language: 'es'
            });
        </script>
        @if (!isset($_COOKIE['color_system']) && env('APP_ADMIN') == true && Auth::user()->role != 'client')
        <script>
            setTimeout(function() {
                $('#modalColor').modal('show');
            }, 1000);
        </script>
        @endif
        <script src="{{asset('js/custom_admin.js')}}">
        </script>
        @yield('script')
    </body>
</html>

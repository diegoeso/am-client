@extends('layouts.pagina.app')
@section('content')
<section class="top_place">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="section_tittle text-center">
                    <h2>
                        Alerta de prevención de fraude
                    </h2>
                    <p class="text-justify">
                        La marca
                        <b>
                            “ {{ env('APP_NAME') }}”
                        </b>
                        es líder reconocida por su experiencia en comercialización de paquetes de viajes nacionales e internacionales.  {{ env('APP_NAME') }} garantiza la protección de sus clientes y sus datos confidenciales. Coherentemente con esto, le invitamos a estar alerta ante el potencial comportamiento fraudulento de terceros que con mala intención utilizan la marca
                        <b>
                            “ {{ env('APP_NAME') }}”
                        </b>
                        . Asi como sus imágenes, colores y productos a fin de realizar comercio por confusión, pretendiendo crear descontrol haciendo creer que son extensión, sucursal o división de  {{ env('APP_NAME') }}, siendo esto inexistente.
                    </p>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12 mt-1 mb-3 btn-block wow bounceInRight text-justify" style="visibility: visible; animation-name: bounceInRight;">
                        <p class="alert alert-primary" style="background-color:#fb1a1a;">
                            <a aria-controls="collapseExample1" aria-expanded="true" c="" data-toggle="collapse" href="#collapseExample1" lass="" role="button" style="color:white">
                                Uso de la marca
                            </a>
                        </p>
                        <div class="collapse show" id="collapseExample1" style="">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="text-justify">
                                            Uso fraudulento de la marca  {{ env('APP_NAME') }} Se han producido tentativas de fraude a varios compradores en Internet y de forma telefónica al hacer uso de gráficos y productos similares a los que usa  {{ env('APP_NAME') }} para su difusión y promociones, sin autorización expresa de la marca  {{ env('APP_NAME') }}, por medio de mensajes enviados por correo electrónico y otros medios que por su aspecto exterior parecen provenir de  {{ env('APP_NAME') }}.
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <img alt="Logo pacifictravels" class="img-fluid" src="{{ asset('images/am/icono.png') }}">
                                        </img>
                                    </div>
                                    <div class="col-md-12">
                                        <p>
                                            En la mayoría de los casos, los mensajes se refieren a la venta de productos similares a los que ofrece  {{ env('APP_NAME') }} a través de Internet, donde se solicita el pago por transferencia de efectivo antes de efectuar la entrega de los productos, o con las modalidades de pago que usa  {{ env('APP_NAME') }}. Por favor, recuerde que  {{ env('APP_NAME') }} nunca solicita el pago de esta forma.  {{ env('APP_NAME') }} solamente cobra el dinero relacionado a las compras relacionadas con los productos y servicios que maneja. Además de que cada compra deberá estar avalada por el contrato correspondiente, y las medidas de seguridad con las que cuentan los clientes de  {{ env('APP_NAME') }}. Este aviso de seguridad no afecta la obligación del comprador a pagar las tarifas acordadas y respaldadas por el contrato entregado de forma física o electrónica, las tarifas extras en los casos que oportunamente son revisados con el comprador, el IVA o cargas similares, cuando corresponda que éstos se paguen en el momento de la reservación.  {{ env('APP_NAME') }} no asume ninguna responsabilidad por costos, cargas o pagos indebidamente incurridos como resultado de actividades fraudulentas.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-1 mb-3 btn-block wow bounceInRight text-justify" style="visibility: visible; animation-name: bounceInRight;">
                        <p class="alert alert-primary" style="background-color:#fb1a1a;">
                            <a aria-controls="collapseExample2" aria-expanded="false" class="" data-toggle="collapse" href="#collapseExample2" role="button" style="color:white">
                                Alerta sobre SPAM
                            </a>
                        </p>
                        <div class="collapse show" id="collapseExample2">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="text-justify">
                                            Si usted recibe un correo electronico, de una empresa distinta de  {{ env('APP_NAME') }}, que esta solicitando información de un paquete o requiriendo que descargue un archivo adjunto, es un correo fraudulento  {{ env('APP_NAME') }}, solo envia correos que correspondan a nuestro dominio, ejemplo:
                                            <b>
                                                "asesor@beneficiosvacacionales.mx"
                                            </b>
                                            , de lo contrario podria ser victima de fraude o descargar un virus.
                                        </p>
                                        <p class="text-justify">
                                            <strong>
                                                No abra ni desacargue ningún archivo que no corresponda a lo anterior.
                                            </strong>
                                        </p>
                                    </div>
                                    <div class="col-md-3 offset-1">
                                        <img alt="" class="img-fluid" src="https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fwww.email-support-desk.com%2Fblog%2Fwp-content%2Fuploads%2F2017%2F04%2Fspam-yahoo-mail.jpg&f=1&nofb=1">
                                        </img>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-1 mb-3 btn-block wow bounceInRight text-justify" style="visibility: visible; animation-name: bounceInRight;">
                        <p class="alert alert-primary" style="background-color:#fb1a1a;">
                            <a aria-controls="collapseExample3" aria-expanded="false" class="" data-toggle="collapse" href="#collapseExample3" role="button" style="color:white">
                                Sitio Web
                            </a>
                        </p>
                        <div class="collapse show" id="collapseExample3">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="text-justify">
                                            Si tiene alguna duda con respecto a la autenticidad de un sitio web que utiliza la marca " {{ env('APP_NAME') }}", por favor, acceda siempre a los sitios web de
                                            <a href="{{ url('/') }}" target="_blank">
                                                 {{ env('APP_NAME') }}
                                            </a>
                                            por vía de nuestro sitio web internacional.
                                        </p>
                                        <p class="text-justify">
                                            Visita el sitio oficial de
                                            <a href="{{ url('/') }}" target="_blank">
                                                 {{ env('APP_NAME') }}
                                            </a>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <img alt="" class="img-fluid" src="{{ asset('images/pagina.png') }}">
                                        </img>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-1 mb-3 btn-block wow bounceInRight text-justify" style="visibility: visible; animation-name: bounceInRight;">
                        <p class="alert alert-primary" style="background-color:#fb1a1a;">
                            <a aria-controls="collapseExample3" aria-expanded="false" class="" data-toggle="collapse" href="#collapseExample4" role="button" style="color:white">
                                Denuncia de fraude
                            </a>
                        </p>
                        <div class="collapse show" id="collapseExample4">
                            <div class="card card-body">
                                <p class="text-justify">
                                    Favor de informar al servicio al cliente de  {{ env('APP_NAME') }}, si recibe llamadas, correo electronicos o publicidad que pueda ser fraudulenta, al correo
                                    <a href="mailto:atencionalcliente@amandoamexico.com.mx">
                                        atencionalcliente@amandoamexico.com.mx
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
@endsection

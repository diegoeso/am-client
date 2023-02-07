<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        </meta>
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
        </meta>
        <title>
            Cupon de pago
        </title>
        <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" rel="stylesheet">
        </link>
        {{--
        <link href="https://fonts.googleapis.com" rel="preconnect"/>
        <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"/>
        --}}
    </head>
    <body>
        <img alt="" src="{{ asset('images/header_cobro.png') }}" style="width:100%">
        </img>
        <div style="text-align: justify;">
            <h4 style="font-family: 'Roboto', sans-serif;">
                Estimado(a) Sr(a): {{ $reservacion->cliente->fullName }}
            </h4>
            <p>
                Por medio del presente reciba un cordial saludo, así mismo nos permitimos notificarle que tenemos una reservación a nombre de
                <b>
                    {{ $reservacion->nombre_de_quien_sera_la_reservacion }}
                </b>
            </p>
            <p>
                Con fecha de viaje del:
                <b>
                    {{ $data['entrada'] }}
                </b>
                al
                <b>
                    {{ $data['salida'] }}
                </b>
                de
                <b>
                    {{ $data['mes'] }}
                </b>
            </p>
            <p>
                Con destino a:
                <b>
                    {{ $reservacion->destino }}
                </b>
            </p>
            <p>
                La reservación está solicitada y en proceso. Para concluir el trámite y liberar el cupón de reservación, es necesario liquidar la cantidad de:
                <b>
                    ${{ number_format($reservacion->cantidad, 2) }}
                </b>
                por concepto de:
                <b>
                    {{ $reservacion->detalle }}
                </b>
            </p>
        </div>
        <div>
            <p>
                El cargo se puede aplicar a alguna tarjeta de débito o crédito o bien depositar en nuestra cuenta en:
            </p>
            <table style="width:100%">
                <tr>
                    <td style="border-left: 5px solid #e95b35; ">
                        <ul style="list-style:none; color: #0480be">
                            <li>
                                <b>
                                    BBVA
                                </b>
                            </li>
                            <li>
                                <b>
                                    Optu Travel Benefits S.A. de C.V.
                                </b>
                            </li>
                            <li>
                                <b>
                                    Número de cuenta: 0117518781
                                </b>
                            </li>
                            <li>
                                <b>
                                    Clabe Interbancaria: 012375001175187813
                                </b>
                            </li>
                        </ul>
                    </td>
                    <td style="padding: 10px; text-align:center; padding: 15px; background-color:#e95b35; border-radius: 15px; color: white; font-size: 18px; width:40%">
                        <p>
                            Favor de pagar
                            <b>
                                {{ '$'.number_format($reservacion->cantidad, 2) }}
                            </b>
                            antes del
                            <b>
                                {{ $fecha_limite }}
                            </b>
                            antes de las 12:00 del medio día.
                        </p>
                    </td>
                </tr>
            </table>
        </div>
        <br/>
        <div>
            <p>
                En caso de hacer el depósito directamente en el banco, es necesario que nos envie la ficha anotando nombre y fecha de viaje.
            </p>
            <p>
                De no recibir el pago en la fecha antes mencionada, lamentablemente la reservación quedará cancelada y se tendrá que iniciar el trámite nuevamente con los tiempos estipulados por el contrato.
            </p>
            <b>
                Para cualquier aclaración llamar al
                <a href="tel:5541698290">
                    55 41 698290
                </a>
                y al Whatsapp 322 111 5496
            </b>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script crossorigin="anonymous" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
        </script>
        <script crossorigin="anonymous" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js">
        </script>
        <script crossorigin="anonymous" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js">
        </script>
    </body>
</html>
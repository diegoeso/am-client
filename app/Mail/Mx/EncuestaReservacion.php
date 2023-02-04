<?php

namespace App\Mail\Mx;

use App\Models\Reservacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EncuestaReservacion extends Mailable
{
    use Queueable, SerializesModels;

    public $reservacion;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservacion $reservacion)
    {
        $this->reservacion = $reservacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'))
            ->subject('Encuesta de satisfaccion ' . env('APP_NAME'))
            ->bcc('dsanchez@pacifictravels.mx')
            ->view('mails.mx.encuesta_reservacion');
    }
}

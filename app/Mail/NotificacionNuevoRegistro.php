<?php

namespace App\Mail;

use App\Models\Contrato;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionNuevoRegistro extends Mailable
{
    use Queueable, SerializesModels;

    public $contrato;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contrato $contrato)
    {
        $this->contrato = $contrato;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->contrato->estancia->estancia_paise_id == 1) {
            $pais = 'México';
        } else {
            $pais = 'Usa';
        }

        return $this->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'))
            ->subject('Alerta: nuevo registro de compra ' . $pais)
            ->view('mails.nueva_compra');
    }
}

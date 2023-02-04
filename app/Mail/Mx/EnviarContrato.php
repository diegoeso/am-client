<?php

namespace App\Mail\Mx;

use App\Models\Contrato;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviarContrato extends Mailable
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
        $subject       = "Contrato de compra en " . env('MAIL_FROM_NAME') . " #" . $this->contrato->id;
        $contrato_send = $this->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'))
            ->subject($subject)
            ->view('mails.mx.nueva_compra')
            ->cc('contratos@pacifictravels.mx')
            ->cc('mailer@beneficiosvacacionales.mx')
            ->attach(public_path() . '/files/contratos_mx/' . 'C' . $this->contrato->id . '.pdf', [
                'as'   => 'C' . $this->contrato->id . '.pdf',
                'mime' => 'application/pdf',
            ]);

        return $contrato_send;
    }
}

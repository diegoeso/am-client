<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistroCliente extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $subject = "Bievenido a " . env('MAIL_FROM_NAME', 'beneficio Vacacionales');

        return $this->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'))
            ->subject($subject)
            ->view('mails.registro_cliente');
    }
}

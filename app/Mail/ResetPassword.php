<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create resetPassword object instance.
     *
     * @return ResetPassword
     */
    public $resetPassword;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($resetPassword)
    {
        $this->resetPassword = $resetPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.reset_password')
            ->subject('Esto es una prueba')
            ->text('mails.reset_password_plain');
    }
}

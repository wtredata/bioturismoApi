<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemoEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create demo object instance.
     *
     * @return Demo
     */
    public $demo;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($demo)
    {
        $this->demo = $demo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.demo')
            ->subject('Esto es una prueba')
            ->text('mails.demo_plain')->with(
                [
                        'testVarOne' => '1',
                        'testVarTwo' => '2',
                ]);
    }
}

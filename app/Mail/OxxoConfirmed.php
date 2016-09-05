<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OxxoConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url_oxxo)
    {
        $this->url_oxxo = $url_oxxo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('douglas.silvio@gmail.com')
            ->text('oxxo-email')
            ->with(['url_oxxo' => $this->url_oxxo]);

    }

}

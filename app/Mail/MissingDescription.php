<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MissingDescription extends Mailable
{
    use Queueable, SerializesModels;

    public $libro;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($libro)
    {
        $this->libro = $libro;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.missing_description');
    }
}

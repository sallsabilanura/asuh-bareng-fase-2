<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PenugasanAsuhMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kakakAsuh;
    public $anakAsuhNames;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($kakakAsuh, $anakAsuhNames)
    {
        $this->kakakAsuh = $kakakAsuh;
        $this->anakAsuhNames = $anakAsuhNames;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pemberitahuan Penugasan Asuh Baru')
                    ->view('emails.penugasan_asuh');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ArchitectAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $architect;
    public $tempPassword;

    public function __construct($architect, $tempPassword)
    {
        $this->architect = $architect;
        $this->tempPassword = $tempPassword;
    }

    public function build()
    {
        return $this->subject('Your ArchiTrack Account')
            ->view('emails.architect-account');
    }
}
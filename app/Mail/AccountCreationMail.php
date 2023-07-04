<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class AccountCreationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private String $name;
    private String $email;
    public function __construct($name, $email)
    {
        $this->email = $email;
        $this->name  = $name;
    }

   
    public function build()
    {
        return  $this->markdown('emails.registration.account_created_notice') ->with('name',$this->name)->with('email',$this->email);
    }
}

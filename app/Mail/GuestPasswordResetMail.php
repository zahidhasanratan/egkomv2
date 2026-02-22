<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuestPasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $name)
    {
        $this->token = $token;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $resetUrl = url('/guest/password/reset/' . $this->token);
        
        return $this->subject('Reset Your Password - EZBOOKING')
                    ->view('emails.guest-password-reset')
                    ->with([
                        'name' => $this->name,
                        'resetUrl' => $resetUrl,
                    ]);
    }
}

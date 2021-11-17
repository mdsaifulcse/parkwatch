<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetOptMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $name;
    public $otp;
    public $expired_at;

    public function __construct($optData)
    {
        $this->name=$optData['name'];
        $this->otp=$optData['otp'];
        $this->expired_at=$optData['expired_at'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name=$this->name;
        $otp=$this->otp;
        $expired_at=$this->expired_at;
        return $this->view('mail.password-reset-opt',compact('name','otp','expired_at'));
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Otp;

class ResetPasswordNotification extends Notification
{
    use Queueable;
    public $message;
    public $subject;
    public $fromEmail;
    public $mailer;
    private $otp;


    public function __construct()
    {
        $this->message = "Use this code to reset ur password";
        $this->subject = "Reset Password";
        $this->fromEmail = "mohameda7my@gmail.com";
        $this->mailer = "smtp";
        $this->otp = new Otp;
    }


    public function via(object $notifiable): array
    {
        return ['mail'];
    }


    public function toMail(object $notifiable): MailMessage
    {
        $otp = $this->otp->generate($notifiable->email , 6 , 30);
        return (new MailMessage)
            ->mailer('smtp')
            ->subject($this->subject)
            ->greeting('Hello,' . $notifiable->first_name)
            ->line($this->message)
            ->line('OTP: ' . $otp->token);
    }


    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

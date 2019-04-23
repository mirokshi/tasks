<?php

namespace App\Notifications;

use App\CodesGenerator\MobileCodesGenerator;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyMobile extends Notification
{
    use Queueable;


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['nexmo'];
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        $code = MobileCodesGenerator::generate();
        return (new NexmoMessage)
            ->content($code ." es tu codigo de verficación de la aplicación de Task")
            ->unicode();
    }
}

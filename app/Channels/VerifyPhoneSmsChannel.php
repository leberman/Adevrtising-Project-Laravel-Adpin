<?php

declare(strict_types=1);

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Ipecompany\Smsirlaravel\Smsirlaravel;

class VerifyPhoneSmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);
        Smsirlaravel::ultraFastSend(['verificationCode'=>$message['phone_token']], 19120, $message['phone_number']);
    }
}

<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Advertising;
use App\Channels\SaleSmsChannel;
use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewSaleAdver extends Notification
{
    use Queueable;
    public $advertising;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Advertising $advertising)
    {
        $this->advertising = $advertising;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SaleSmsChannel::class];
    }

    /**
     * send sms to user
     *
     * @param $notifiable
     * @return array
     */
    public function toSms($notifiable)
    {
        return [
            'phone_number' => $notifiable->phone_number,
            'message'  =>  'آگهی شما با موفقیت ثبت شد ، پس از تایید کارشناسان ادپین در سایت قرار خواهد گرفت. '
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

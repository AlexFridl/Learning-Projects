<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReminderMailNotification extends Notification
{
    use Queueable;

    protected $reminder;

    public function __construct($reminder)
    {
        $this->reminder = $reminder;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {

        $url = '/vehicles/' . $this->reminder->vehicle_id . '/reminders/' . $this->reminder->id;

        return (new MailMessage)
                    ->subject('Podsetnik')
                    ->line('Podsećamo Vas da rok za ' . $this->reminder->description . ' ističe za ' . $this->reminder->notify_days . ' dana.')
                    ->action('Pogledajte podsetnik', url($url));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

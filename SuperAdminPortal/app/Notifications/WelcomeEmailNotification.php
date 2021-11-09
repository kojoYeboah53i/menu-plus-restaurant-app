<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject("Welcome To MenuPlus")
                    ->greeting("Hello " . ($notifiable->fullname ? $notifiable->fullname : ($notifiable->firstname . ' ' . $notifiable->lastname)) . ',')
                    ->line('You have been added as a ' . $this->data['type'] . ' on MenuPlus.')
                    ->line('Kindly login with your password: ' . $this->data['password'])
                    ->action('Login',$this->data['login_url'])
                    ->line('Thank you!');
                    // ->action('Login', config('app.url') . '/login')
                    // ->line('Thank you!');
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

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The variable that holds all the generated password.
     *
     * @var string $password
     */
    public $password;

    /**
     * Create a new notification instance.
     *
     * @param  string $password The variable for the generatec password
     * @return void
     */
    public function __construct(string $password)
    {
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via(): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable Accessor variable for the user information
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Er is een login aangemaakt voor u op ' . config('app.name'))
            ->greeting('Hallo,')
            ->line('Een administrator heeft een login aangemaakt voor u op'  . config('app.name'))
            ->line("Je kan inloggen met je email adres en het volgende wachtwoord: `" . $this->password . '``')
            ->action('Aanmelden', route('login'));
    }
}

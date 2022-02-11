<?php

namespace Koraycicekciogullari\HydroAdministrator\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdministratorCreated extends Notification
{
    use Queueable;

    private $password;
    private $email;

    public function __construct($password, $email)
    {
        $this->password = $password;
        $this->email    = $email;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('E-Posta Adresiniz: ' . $this->email)
                    ->line('Geçici Parola: ' . $this->password)
                    ->action('Yönetim Paneli', 'https://kuponcam.com/admin')
                    ->line('Lütfen Yönetim Paneli Girişi Sonrası Parolanızı değiştirin!');
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}

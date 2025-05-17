<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Restablecimiento de Contraseña')
            ->greeting('Hola,')
            ->line('Hemos recibido una solicitud para restablecer tu contraseña.')
            ->action('Restablecer Contraseña', url('/password/reset/' . $this->token))
            ->line('Si no solicitaste este cambio, ignora este mensaje.');
    }
}

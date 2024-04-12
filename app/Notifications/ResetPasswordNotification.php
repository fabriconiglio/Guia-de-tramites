<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        $token = $this->token;

        // Creamos la URL de restablecimiento de contraseña.
        $url = url('/password/reset/' . $token . '?email=' . urlencode($notifiable->getEmailForPasswordReset()));

        return (new MailMessage)
            ->subject(__('Notificación de restablecimiento de contraseña'))
            ->greeting(__('Hola!'))
            ->line(__('Está recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.'))
            ->action(__('Restablecer la contraseña'), $url)
            ->line(__('Este enlace para restablecer la contraseña caducará en 60 minutos.'))
            ->line(__('Si no solicitó un restablecimiento de contraseña, no se requiere ninguna otra acción.'));
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

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyStatusNotification extends Notification
{
    use Queueable;

    public $status;
    public $feedback;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($status, $feedback = null)
    {
        $this->status = $status;
        $this->feedback = $feedback;
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
        $message = (new MailMessage)
            ->subject('Estado de la Revisión de Empresa')
            ->line('El estado de la empresa que registraste ha cambiado.')
            ->line('Estado: ' . $this->status);

        if ($this->feedback) {
            $message->line('Retroalimentación: ' . $this->feedback);
        }

        return $message;
    }
}

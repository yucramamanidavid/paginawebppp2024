<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyReviewStatusUpdate extends Notification
{
    protected $review;

    public function __construct($review)
    {
        $this->review = $review;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Estado de Revisión de Empresa')
                    ->line('La revisión de la empresa ha cambiado de estado.')
                    ->line('Estado actual: ' . $this->review->status)
                    ->action('Ver Revisión', url('/reviews/' . $this->review->id))
                    ->line('Gracias por utilizar nuestro sistema.');
    }

    public function toArray($notifiable)
    {
        return [
            'review_id' => $this->review->id,
            'status' => $this->review->status,
            'student_company' => $this->review->studentCompany->name,
        ];
    }
}

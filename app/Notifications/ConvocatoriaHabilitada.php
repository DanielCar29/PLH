<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ConvocatoriaHabilitada extends Notification
{
    public $fecha_inicio;
    public $fecha_cierre;

    public function __construct($fecha_inicio, $fecha_cierre)
    {
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_cierre = $fecha_cierre;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Convocatoria Habilitada')
            ->line('Se ha habilitado una nueva convocatoria de becas.')
            ->line('Fecha de inicio: ' . $this->fecha_inicio)
            ->line('Fecha de cierre: ' . $this->fecha_cierre)
            ->action('Ver Convocatoria', url('/convocatoria'))
            ->line('Gracias por usar nuestra plataforma.');
    }
}

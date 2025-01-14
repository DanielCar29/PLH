<?php

namespace App\Mail;

use App\Models\DetallesBeca;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConvocatoriaAbierta extends Mailable
{
    use Queueable, SerializesModels;

    public $fecha_inicio;
    public $fecha_cierre;

    public function __construct(DetallesBeca $detallesBeca)
    {
        $this->fecha_inicio = $detallesBeca->inicio_convocatoria;
        $this->fecha_cierre = $detallesBeca->fin_convocatoria;
    }

    public function build()
    {
        return $this->view('emails.convocatoriaAbierta');
    }
}

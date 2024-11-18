<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaAlumno extends Model
{
    use HasFactory;

    protected $fillable = ['preguntas_id', 'supervisor_id', 'respuesta'];

    public function pregunta()
    {
        return $this->belongsTo(PreguntaDeSolicitudDelAlumno::class, 'preguntas_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
    }
}

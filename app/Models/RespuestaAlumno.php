<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaAlumno extends Model
{
    use HasFactory;
    protected $table = 'respuestas_alumno';
    protected $fillable = ['preguntas_id', 'supervisor_id', 'respuesta', 'alumno_solicitud_beca_id'];

    public function pregunta()
    {
        return $this->belongsTo(PreguntaDeSolicitudDelAlumno::class, 'preguntas_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
    }

    public function respuestasSolicitud()
    {
        return $this->hasMany(RespuestaSolicitud::class, 'respuestas_alumno_id');
    }

    public function alumnoSolicitudBeca()
    {
        return $this->belongsTo(AlumnoSolicitudBeca::class, 'alumno_solicitud_beca_id');
    }
}

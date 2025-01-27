<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoSolicitudBeca extends Model
{
    use HasFactory;

    protected $table = 'alumno_solicitudbeca';

    protected $fillable = ['solicitud_de_beca_id', 'alumno_id', 'estado', 'envio'];

    public function solicitudDeBeca()
    {
        return $this->belongsTo(SolicitudDeBeca::class, 'solicitud_de_beca_id');
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function respuestasAlumno()
    {
        return $this->hasManyThrough(RespuestaAlumno::class, RespuestaSolicitud::class, 'solicitud_de_beca_id', 'id', 'solicitud_de_beca_id', 'respuestas_alumno_id');
    }
}

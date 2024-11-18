<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaSolicitud extends Model
{
    use HasFactory;

    protected $fillable = ['solicitud_de_beca_id', 'respuestas_alumno_id'];

    public function solicitudDeBeca()
    {
        return $this->belongsTo(SolicitudDeBeca::class, 'solicitud_de_beca_id');
    }

    public function respuestasAlumno()
    {
        return $this->belongsTo(RespuestaAlumno::class, 'respuestas_alumno_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreguntaDeSolicitudDelAlumno extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si es diferente del plural del modelo
    protected $table = 'preguntas_de_solicitud_del_alumno';

    // Los campos que son asignables en masa
    protected $fillable = [
        'pregunta', // El campo de la pregunta
    ];

    // Relación con las respuestas
    public function respuestas()
    {
        return $this->hasMany(RespuestaAlumno::class, 'preguntas_id');
    }
}

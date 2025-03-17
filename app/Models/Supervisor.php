<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla ya que no sigue la convención plural de Laravel
    protected $table = 'supervisores'; 

    // Definir los campos que son asignables en masa
    protected $fillable = [
        'usuario_id',
    ];

    // Relación con el modelo User (Un supervisor pertenece a un usuario)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Relación con las respuestas de los alumnos
    public function respuestas()
    {
        return $this->hasMany(RespuestaAlumno::class);
    }

    // Relación con las carreras a través de una tabla intermedia
    // En el modelo Supervisor
    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'carreras_supervisor', 'supervisor_id', 'carreras_id');
    }

    // Relación para obtener los alumnos de las mismas carreras que el supervisor
    public function alumnos()
    {
        return $this->hasManyThrough(
            Alumno::class,
            CarrerasAlumno::class,
            'carreras_id', // Foreign key on CarrerasAlumno table...
            'id', // Foreign key on Alumno table...
            'id', // Local key on Supervisor table...
            'alumno_id' // Local key on CarrerasAlumno table...
        );
    }
}

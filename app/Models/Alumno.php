<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';

    protected $fillable = [
        'numero_de_control',
        'semestre',
        'usuario_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'carreras_alumno', 'alumno_id', 'carreras_id');
    }

    public function becas()
    {
        return $this->belongsToMany(Beca::class, 'alumno_beca', 'alumno_id', 'beca_id');
    }

    public function solicitudesBeca()
    {
        return $this->hasMany(AlumnoSolicitudBeca::class, 'alumno_id');
    }
}

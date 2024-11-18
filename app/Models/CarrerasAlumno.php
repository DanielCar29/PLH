<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarrerasAlumno extends Model
{
    use HasFactory;

    protected $table = 'carreras_alumno';

    protected $fillable = [
        'alumno_id',
        'carreras_id',
    ];

    public $timestamps = false;

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carreras_id');
    }
}

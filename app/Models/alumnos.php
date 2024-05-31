<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\carreras;
use App\Models\solicitudes_de_beca;
use App\Models\becas;
use App\Models\reportes;
use App\Models\respuestas_alumno;


class alumnos extends Model
{
    use HasFactory;

    protected $table = 'alumnos';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

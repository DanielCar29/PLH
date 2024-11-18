<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudDeBeca extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_de_beca';

    protected $fillable = [
        'estado',
        'fecha_creacion',
    ];
}

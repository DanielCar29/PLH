<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaSolicitud extends Model
{
    use HasFactory;

    protected $fillable = [
        'carreras_id',
        'solicitud_de_beca_id',
    ];

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carreras_id');
    }

    public function solicitudBeca()
    {
        return $this->belongsTo(SolicitudDeBeca::class, 'solicitud_de_beca_id');
    }
}

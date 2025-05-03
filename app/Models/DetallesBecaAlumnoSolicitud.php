<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesBecaAlumnoSolicitud extends Model
{
    use HasFactory;

    protected $table = 'detallesbeca_alumnosolicitud';

    protected $fillable = [
        'detalles_beca_id',
        'alumno_solicitudbeca_id',
    ];

    public function detallesBeca()
    {
        return $this->belongsTo(DetallesBeca::class, 'detalles_beca_id');
    }

    public function alumnoSolicitudBeca()
    {
        return $this->belongsTo(AlumnoSolicitudBeca::class, 'alumno_solicitudbeca_id');
    }
}

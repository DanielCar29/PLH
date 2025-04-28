<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DetallesBeca extends Model
{
    use HasFactory;

    protected $fillable = [
        'administrador_general_id',
        'estado_convocatoria',
        'inicio_convocatoria',
        'fin_convocatoria',
        'inicio_uso_beca', // Nuevo campo
        'fin_uso_beca' // Nuevo campo
    ];

    public function administradorGeneral()
    {
        return $this->belongsTo(AdministradorGeneral::class, 'administrador_general_id');
    }

    public function isConvocatoriaActiva()
    {
        $now = Carbon::now();
        return $this->estado_convocatoria === 'activa' &&
               $now->between(Carbon::parse($this->inicio_convocatoria), Carbon::parse($this->fin_convocatoria));
    }

    public function isConvocatoriaFinalizada()
    {
        $now = Carbon::now();
        return $now->greaterThan(Carbon::parse($this->fin_convocatoria));
    }
}

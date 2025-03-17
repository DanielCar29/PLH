<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $table = 'reportes';

    protected $fillable = [
        'fecha_uso_beca',
        'alumno_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $existingReport = self::where('alumno_id', $model->alumno_id)
                ->whereDate('fecha_uso_beca', $model->fecha_uso_beca)
                ->first();

            if ($existingReport) {
                throw new \Exception('Ya existe un reporte para este alumno en la fecha especificada.');
            }
        });
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id')->withDefault();
    }
}

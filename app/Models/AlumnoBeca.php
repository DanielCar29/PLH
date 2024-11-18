<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoBeca extends Model
{
    use HasFactory;

    protected $table = 'alumno_beca';

    protected $fillable = [
        'alumno_id',
        'beca_id',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function beca()
    {
        return $this->belongsTo(Beca::class, 'beca_id');
    }
}

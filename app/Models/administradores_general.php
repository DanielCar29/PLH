<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class administradores_general extends Model
{
    use HasFactory;

    protected $table = 'administradores_generales';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

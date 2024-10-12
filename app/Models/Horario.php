<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'hora_ingreso',
        'hora_salida',
        'descripcion',
        'user_id',
        'descanso',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    use HasFactory;

    protected $fillable = [
        'reserva_id',
        'user_id',
        'cambios',
        'fecha',
    ];

    protected $casts = [
        'cambios' => 'array', // Para manejar el JSON como array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

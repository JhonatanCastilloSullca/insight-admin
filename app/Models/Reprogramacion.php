<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reprogramacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'reserva_id',
        'user_id',
        'reserva_ant_id',
        'fecha',
        'comentarios'
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class,'reserva_id');
    }

    public function reservaanterior()
    {
        return $this->belongsTo(Reserva::class,'reserva_ant_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

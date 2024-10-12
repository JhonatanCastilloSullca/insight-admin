<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'cupon',
        'cantidad',
        'descuento',
        'maximo',
        'fechaInicio',
        'fechaFin',
        'montoSoles',
        'montoDolares',
        'tipo',
        'finalizado',
        'user_id',
        'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
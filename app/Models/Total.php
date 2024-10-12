<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Total extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'reserva_id',
        'moneda_id',
        'cupon_id',
        'acuenta',
        'saldo',
        'total',
        'descuento',
        'estado',
    ];

    public function moneda()
    {
        return $this->belongsTo(Moneda::class);
    }
}
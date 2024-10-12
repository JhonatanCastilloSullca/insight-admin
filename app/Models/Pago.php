<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'moneda_id',
        'medio_id',
        'reserva_id',
        'fecha',
        'monto',
        'monto_porcentaje',
        'num_operacion',
        'factura',
        'contabilidad',
        'overview',
        'comentarios',
        'estado',
    ];

    public function medio()
    {
        return $this->belongsTo(Medio::class);
    }

    public function moneda()
    {
        return $this->belongsTo(Moneda::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
}

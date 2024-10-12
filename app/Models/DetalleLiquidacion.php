<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleLiquidacion extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'liquidacion_id',
        'ejecutable',
        'cantidad',
        'precio',
        'ingreso',
        'ingresoAnterior',
        'servicio_id',
        'operar',
        'moneda_id',
        'precioAnterior',
        'moneda_id_anterior',
        'comentarios',
        'estado',
    ];

    public function ejecutable()
    {
        return $this->morphTo();
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}

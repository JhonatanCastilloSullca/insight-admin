<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperarServicio extends Model
{
    use HasFactory;

    protected $fillable = [

        'operar_id',
        'servicio_id',
        'proveedor_id',
        'precio',
        'observacion',
        'recojo',
        'tipo',
        'estado',
        'codigo',
        'idioma',
        'imagen',
        'acuenta',
        'saldo',
        'fechaPago',
        'pagado',
        'detalle_reserva_id',
        'cantidad',
        'noches',
        'moneda_id',

    ];

    public function operar()
    {
        return $this->belongsTo(Operar::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function detalles()
    {
        return $this->belongsTo(OperarDetalleReserva::class)->withPivot('recojo','ingreso','cantidad','noches');
    }

    public function detalleReserva()
    {
        return $this->belongsTo(DetalleReserva::class,'detalle_reserva_id');
    }

    public function moneda()
    {
        return $this->belongsTo(Moneda::class);
    }

    public function operarPasajeros()
    {
        return $this->hasMany(OperarPasajero::class);
    }

    public function pagosServicio()
    {
        return $this->hasMany(Devolucion::class);
    }
}

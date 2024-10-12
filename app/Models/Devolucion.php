<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'user_id',
        'moneda_id',
        'medio_id',
        'reserva_id',
        'fecha',
        'monto',
        'num_operacion',
        'factura',
        'comentarios',
        'estado',
        'liquidacion_id',
        'operar_servicio_id',
        'imagen',
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

    public function operarServicioHotel()
    {
        return $this->belongsTo(OperarServicio::class,'operar_servicio_id');
    }
}

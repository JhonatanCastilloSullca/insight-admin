<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperarDetalleReserva extends Model
{
    use HasFactory;
    protected $fillable = [
        'operar_id',
        'detalle_reserva_id',
        'recojo',
        'ingresos',
        'cantidad',
        'noches',
        'observacion'
        
    ];

    public function detallereserva()
    {
        return $this->belongsTo('App\Models\DetalleReserva', 'detalle_reserva_id');
    }
    public function operar()
    {
        return $this->belongsTo('App\Models\Operar');
    }
}

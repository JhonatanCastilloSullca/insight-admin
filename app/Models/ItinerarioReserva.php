<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItinerarioReserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'detalle_reserva_id',
        'dia',
    ];

    public function servicio()
    {
        return $this->belongsTo(DetalleReserva::class);
    }
    
    public function incluyes(){
        return $this->belongsToMany('App\Models\Servicio','detalle_reserva_incluyes','itinerario_reserva_id','servicio_incluido_id');
    }
    
    public function noincluyes(){
        return $this->belongsToMany('App\Models\Servicio','detalle_reserva_no_incluyes','itinerario_reserva_id','servicio_no_incluido_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItinerarioPaquete extends Model
{
    use HasFactory;

    protected $fillable = [
        'detalle_paquete_id',
        'dia',
    ];

    public function detalle()
    {
        return $this->belongsTo(DetallePaquete::class);
    }
    
    public function incluyes(){
        return $this->belongsToMany('App\Models\Servicio','detalle_paquete_incluyes','itinerario_paquete_id','servicio_incluido_id');
    }
    
    public function noincluyes(){
        return $this->belongsToMany('App\Models\Servicio','detalle_paquete_no_incluyes','itinerario_paquete_id','servicio_no_incluido_id');
    }
}

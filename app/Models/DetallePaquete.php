<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePaquete extends Model
{
    use HasFactory;
    protected $fillable = [

        'paquete_id',
        'servicio_id',
        'fecha_viaje',
        'fecha_viajefin',
        'dia_servicio',
        'paxservicionacional',
        'paxservicioextranjero',
        'moneda_id',
        'preciosoles',
        'preciodolares',
        'tipo',
        'adulto',
        'descripcion',
        'equipaje',
    ];

    public function servicio()
    {
        return $this->belongsTo('App\Models\Servicio');
    }
    public function paquete()
    {
        return $this->belongsTo('App\Models\Paquete');
    }
    public function detallesIncluidos()
    {
        return $this->hasMany('App\Models\DetallePaqueteIncluye');
    }
    public function detallesNoIncluidos()
    {
        return $this->hasMany('App\Models\DetallePaqueteNoIncluye');
    }
    public function moneda()
    {
        return $this->belongsTo('App\Models\Moneda');
    }

    public function itinerarios()
    {
        return $this->hasMany(ItinerarioPaquete::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePaqueteIncluye extends Model
{
    use HasFactory;
    protected $fillable = [
        'itinerario_paquete_id',
        'servicio_incluido_id',
    ];
    public function detallePaquete()
    {
        return $this->belongsTo('App\Models\DetallePaquete');
    }
    public function paquete()
    {
        return $this->belongsTo('App\Models\Paquete');
    }
    public function servicioIncluido()
    {
        return $this->belongsTo('App\Models\Servicio', 'servicio_incluido_id');
    }
}

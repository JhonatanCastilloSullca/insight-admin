<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePaqueteNoIncluye extends Model
{
    use HasFactory;
    protected $fillable = [
        'itinerario_paquete_id',
        'servicio_no_incluido_id',
    ];
    public function detallePaquete()
    {
        return $this->belongsTo('App\Models\DetallePaquete');
    }
    public function servicioNoIncluido()
    {
        return $this->belongsTo('App\Models\Servicio', 'servicio_no_incluido_id');
    }
}


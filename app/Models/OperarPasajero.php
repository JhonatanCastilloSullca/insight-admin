<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperarPasajero extends Model
{
    use HasFactory;
    protected $fillable = [
        'operar_id',
        'pasajero_id',
        'operar_servicio_id',
        'recojo',
    ];

    public function pasajero()
    {
        return $this->belongsTo('App\Models\Pasajero', 'pasajero_id');
    }

    public function operar()
    {
        return $this->belongsTo(Operar::class);
    }

    public function operarServicio()
    {
        return $this->belongsTo(OperarServicio::class);
    }
}

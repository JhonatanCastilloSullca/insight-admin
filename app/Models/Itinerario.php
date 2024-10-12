<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerario extends Model
{
    use HasFactory;

    protected $fillable = [
        'servicio_id',
        'dia',
        'template',
    ];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
    
    public function incluyes(){
        return $this->belongsToMany('App\Models\Servicio','incluye','itinerario_id','incluye_id');
    }
    
    public function noincluyes(){
        return $this->belongsToMany('App\Models\Servicio','noincluye','itinerario_id','noincluye_id');
    }
}

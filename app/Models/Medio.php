<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medio extends Model
{
    use HasFactory;

    protected $fillable = [        

        'nombre',
        'banco',
        'numero',
        'cci',
        'porcentaje',
        'descripcion',
        'moneda_id',
        'estado',
    ];

    public function moneda()
    {
        return $this->belongsTo(Moneda::class);
    }
}

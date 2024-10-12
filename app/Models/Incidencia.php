<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'descripcion',
        'cantidad',
        'operar_id',
        'moneda_id',
        'costo',
        'proveedor_id',
        'operar_servicio_id',
    ];
}

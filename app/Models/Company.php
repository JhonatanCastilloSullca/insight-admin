<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [

        'razon_social',
        'ruc',
        'direccion',
        'sol_user',
        'sol_pass',
        'client_id',
        'client_secret',
        'distrito',
        'provincia',
        'departamento',
        'ubigeo',
        'production',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aeropuertos extends Model
{
    use HasFactory;
    protected $fillable = ['ciudad', 'abrev', 'nombre'];

}




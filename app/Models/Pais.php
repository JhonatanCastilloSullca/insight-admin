<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = "pais";
    use HasFactory;

    protected $fillable = [
        
        'iso',
        'nombre',
        'code',
        'text',
        'textIncaRail',
        'codeMinisterio',
        'textMinisterio',
        'codeConsetur',
        'textConsetur',
    ];
}

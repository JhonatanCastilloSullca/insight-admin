<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfDatos extends Model
{
    use HasFactory;
    protected $fillable = [
        'img_principal',
        'ruc',
        'razon_social',
        'rec_cancel1',
        'rec_cancel2',
        'poli_ven1',
        'poli_ven2',
        'poli_nota',
    ];
}










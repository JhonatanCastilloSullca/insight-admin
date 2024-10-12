<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    use HasFactory;
    protected $fillable = [
        'nroCuota',
        'fecha',
        'monto',
        'pagado',
        'moneda_id',
        'pagable',
    ];

    public function pagable()
    {
        return $this->morphTo();
    }

    public function moneda()
    {
        return $this->belongsTo(Moneda::class);
    }
}

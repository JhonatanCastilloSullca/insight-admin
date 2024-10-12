<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [

        'reserva_id',
        'cliente_id',
        'user_id',
        'medio_id',
        'document_id',
        'nume_doc',
        'fecha',
        'total',
        'sunat',
        'descripcion',
        'code_note',
        'factura_id',
        'estado',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }

    public function medio()
    {
        return $this->belongsTo(Medio::class);
    }

    public function detalleventas()
    {
        return $this->hasMany(DetalleVenta::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class,'factura_id');
    }

    public function documentosunat()
    {
        return $this->hasOne(DocumentoSunat::class);
    }
}

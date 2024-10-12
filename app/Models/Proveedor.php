<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $fillable = [

        
        'nombre',
        'celular',
        'direccion',
        'email',
        'ruc',
        'razon_social',
        'categoria_id',
        'categoria_id',
        'ubicacion_id',
        'ubicacion_id',
        'checkinn',
        'checkout',
        'cumpleanos',
        'detalle_hotel',
        'correo',
        'imagen',
        'estado',

    ];

    protected function nombre(): Attribute
    {
        return new Attribute(
            set: function ($value) {
                return mb_strtoupper($value);
            }
        );
    }

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }

    public function ubicacion()
    {
        return $this->belongsTo('App\Models\Ubicacion');
    }
    public function ProveedoresDeHoteles()
    {
        $categoriasHotel = Categoria::where('categoria_id', '2')->pluck('id');
        $proveedoresHotel = Proveedor::whereIn('categoria_id', $categoriasHotel)->get();
        return $proveedoresHotel;
    }
    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Categoria extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'categoria_id'
    ];

    protected function nombre(): Attribute
    {
        return new Attribute(
            set: function($value){
                return mb_strtoupper($value);
            }
        );
    }
    protected function tabla(): Attribute
    {
        return new Attribute(
            set: function($value){
                return mb_strtoupper($value);
            }
        );
    }

    public function categoriapadre()
    {
        return $this->belongsTo(Categoria::class,'categoria_id');
    }

    public function categoriashijos()
    {
        return $this->hasMany(Categoria::class);
    }

    public function proveedores()
    {
        return $this->hasMany(Proveedor::class);
    }

    public function proveedoresCiudad($ubicacion_id)
    {
        return $this->hasMany(Proveedor::class)->where('ubicacion_id',$ubicacion_id)->get();
    }

    public function proveedoresSelect()
    {
        return $this->hasMany(Proveedor::class)->select('id','nombre as text');
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
}

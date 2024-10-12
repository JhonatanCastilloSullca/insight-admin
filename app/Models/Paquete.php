<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    use HasFactory;

    protected $fillable = [
        

        'titulo',
        'mensaje_bienvenida',
        'fecha_disponibilidad',
        'fecha_inicio',
        'fecha_viaje',
        'fecha_registro',
        'video',
        'descripcion',
        'img_principal',
        'img_secundario',
        'publico',
        'tipo',
        'pagoweb',
        'cantidad_pax',
        'cantpaxniños',
        'regularsoles',
        'regulardolares',
        'precio_soles',
        'precio_dolares',
        'precio_soles_niño',
        'precio_dolares_niño',
        'estado',
        'moneda_id',
        'user_id',
        'pasajero_id',

    ];

    protected function titulo(): Attribute
    {
        return new Attribute(
            set: function ($value) {
                return mb_strtoupper($value);
            }
        );
    }
    public function detalles()
    {
        return  $this->hasMany('App\Models\DetallePaquete');
    }
    public function detallestours()
    {
        return  $this->hasMany('App\Models\DetallePaquete')->where(function ($query) {
            $query->whereRelation('servicio', 'categoria_id', '=', 5)
                ->orWhereRelation('servicio', 'categoria_id', '=', 6);
        })
            ->orderBy('fecha_viaje', 'asc');
    }
    public function detalleshoteles()
    {
        return  $this->hasMany('App\Models\DetallePaquete')->where(function ($query) {
            $query->whereRelation('servicio', 'categoria_id', '=', 2);
        })
            ->orderBy('fecha_viaje', 'asc');
    }
    public function detallestoursTitulo()
    {
        return $this->hasMany('App\Models\DetallePaquete')
            ->where(function($query) {
                $query->whereRelation('servicio', 'categoria_id', '=', 5);
            })
            ->orderBy('fecha_viaje', 'asc');
    }
    public function detallesvuelos()
    {
        return  $this->hasMany('App\Models\DetallePaquete')->where(function ($query) {
            $query->whereRelation('servicio', 'categoria_id', '=', 3);
        })
            ->orderBy('fecha_viaje', 'asc');
    }
    public function detallesIncluidos()
    {
        return $this->hasMany('App\Models\DetallePaqueteIncluye');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function moneda()
    {
        return $this->belongsTo('App\Models\Moneda');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function cuotas()
    {
        return $this->morphMany(Cuota::class, 'pagable');
    }

    public function pasajeros()
    {
        return $this->belongsToMany(Pasajero::class);
    }
}

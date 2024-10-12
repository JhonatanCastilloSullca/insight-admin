<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'titulo',
        'descripcion',
        'img_principal',
        'template',
        'video',
        'recojo',
        'horario',
        'categoria_id',
        'user_id',
        'condicion',
        'color',
        'descuento',
        'operar',
        'plantillaOperar',
        'servicio_id',
        'proveedor_id',
        'incluye',
        'plantillaOverview',
        'duracion',
        'ubicacion_id',
        'estado',

    ];
    protected function titulo(): Attribute
    {
        return new Attribute(
            set: function($value){
                return mb_strtoupper($value);
            }
        );
    }
    protected function subtitulo(): Attribute
    {
        return new Attribute(
            set: function($value){
                return mb_strtoupper($value);
            }
        );
    }
    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function ubicaciones() {
        return $this->belongsToMany('App\Models\Ubicacion');
    }
    public function etiquetas() {
        return $this->belongsToMany('App\Models\Etiqueta');
    }

    public function incluyes(){
        return $this->belongsToMany('App\Models\Servicio','incluye','incluye_id','servicio_id');
    }

    public function incluyesOperar()
    {
        return Servicio::query()
        ->join('incluye', 'servicios.id', '=', 'incluye.incluye_id')
        ->join('itinerarios', 'itinerarios.id', '=', 'incluye.itinerario_id')
        ->whereIn('itinerarios.id', $this->itinerarios->pluck('id')) // Obtener los IDs de los itinerarios asociados
        ->where('servicios.operar', 1) // Filtrar donde operar = 1
        ->select('servicios.*')
        ->get();
    }

    public function incluyesOperarSinIngresos()
    {
        return Servicio::query()
        ->join('incluye', 'servicios.id', '=', 'incluye.incluye_id')
        ->join('itinerarios', 'itinerarios.id', '=', 'incluye.itinerario_id')
        ->whereIn('itinerarios.id', $this->itinerarios->pluck('id')) // Obtener los IDs de los itinerarios asociados
        ->where('servicios.operar', 1) // Filtrar donde operar = 1
        ->where('servicios.categoria_id','!=', 17)
        ->select('servicios.*')
        ->get();
    }

    public function incluyesOperarIngresos()
    {
        return Servicio::query()
        ->join('incluye', 'servicios.id', '=', 'incluye.incluye_id')
        ->join('itinerarios', 'itinerarios.id', '=', 'incluye.itinerario_id')
        ->whereIn('itinerarios.id', $this->itinerarios->pluck('id')) // Obtener los IDs de los itinerarios asociados
        ->where('servicios.operar', 1) // Filtrar donde operar = 1
        ->where('servicios.categoria_id', 17)
        ->select('servicios.*')
        ->get();
    }

    public function noincluyes(){
        return $this->belongsToMany('App\Models\Servicio','noincluye','noincluye_id','servicio_id');
    }

    public function precios()
    {
        return $this->belongsToMany(Precio::class)->withPivot('moneda_id','precio_minimo','precio','privado','nacional','pax');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function itinerarios()
    {
        return $this->hasMany(Itinerario::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function detallesreserva()
    {
        return $this->hasMany(DetalleReserva::class);
    }
}
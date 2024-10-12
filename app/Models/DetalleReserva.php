<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleReserva extends Model
{
    use HasFactory;

    protected $fillable = [

        'reserva_id',
        'servicio_id',
        'moneda_id',
        'fecha_viaje',
        'fecha_viajefin',
        'pax',
        'precio',
        'descripcion',
        'equipaje',
        'comentarios',
        'pago',
        'tipo',
        'adulto',
        'confirmado',
        'estado',
        'operado',
        'hotelJisa',
        'overview',
        'orden',
        'proveedor_id',
        'reprogramado',
        'adicional',
        'precio_id',
    ];

    // public function incluyes()
    // {
    //     return $this->belongsToMany(Servicio::class,'detalle_reserva_incluyes','detalle_reserva_id','servicio_incluido_id');
    // }

    public function noincluyes()
    {
        return $this->belongsToMany(Servicio::class,'detalle_reserva_no_incluyes','detalle_reserva_id','servicio_no_incluido_id');
    }

    public function detallesoperar()
    {
        return $this->hasOne(OperarDetalleReserva::class,'detalle_reserva_id');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function moneda()
    {
        return $this->belongsTo(Moneda::class);
    }

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }

    public function itinerarios()
    {
        return $this->hasMany(ItinerarioReserva::class);
    }

    public function precioTarifa()
    {
        return $this->belongsTo(Precio::class,'precio_id');
    }

    public function hotel()
    {
        return $this->belongsTo(Proveedor::class,'proveedor_id');
    }

    public function operarServicio()
    {
        return $this->hasOne(OperarServicio::class);
    }

    public function operarServicios()
    {
        return $this->hasMany(OperarServicio::class);
    }

    public function getIncluyesAttribute()
    {
        return Servicio::query()
            ->join('detalle_reserva_incluyes', 'detalle_reserva_incluyes.servicio_incluido_id', '=', 'servicios.id')
            ->join('itinerario_reservas', 'itinerario_reservas.id', '=', 'detalle_reserva_incluyes.itinerario_reserva_id')
            ->where('itinerario_reservas.detalle_reserva_id', $this->id)  // Filtramos por la ID de la DetalleReserva actual
            ->select('servicios.*')
            ->get();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'fecha',
        'observacion',
        'paquete_id',
        'descripcion',
        'numero',
        'confirmado',
        'cotizacion',
        'correo',
        'pagado',
        'contabilidad',
        'estado',
    ];
    public function cuotas()
    {
        return $this->morphMany(Cuota::class, 'pagable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pasajeros()
    {
        return $this->belongsToMany(Pasajero::class);
    }

    public function pasajeroprincipal()
    {
        return $this->pasajeros()->where('principal', 1)->first();
    }

    public function pasajeroscumpleaños($fecha)
    {
        $fecha_hoy = date("m-d",strtotime($fecha));
        return $this->belongsToMany(Pasajero::class)
                ->whereRaw("DATE_FORMAT(nacimiento, '%m-%d') = ?", [$fecha_hoy])
                ->exists();
    }

    public function totales()
    {
        return $this->hasMany(Total::class);
    }

    public function totalesConSaldo()
    {
        return $this->hasMany(Total::class)->where('saldo', '>', 0);
    }

    public function getSaldoCeroAttribute()
    {
        return $this->totales->every(function ($total) {
            return $total->saldo == 0;
        });
    }

    public function detalles()
    {
        return $this->hasMany(DetalleReserva::class);
    }

    public function operarServicios()
    {
        return $this->hasManyThrough(OperarServicio::class, DetalleReserva::class, 'reserva_id', 'detalle_reserva_id');
    }

    public function descripcionFactura()
    {
        $descripcion = "Anticipo ";
        $ultimafecha = "";
        $detalles = $this->detallestours()->get();
        foreach($detalles as $detalle){
            $descripcion = $descripcion.$detalle->servicio->titulo.', ';
            $ultimafecha = $detalle->fecha_viaje;
        }
        $descripcion = $descripcion. ' del '.date("d/m/Y",strtotime($this->primerafecha()->fecha_viaje)).' al '.date("d/m/Y",strtotime($ultimafecha));
        return $descripcion;
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function devoluciones()
    {
        return $this->hasMany(Devolucion::class);
    }

    public function primerafecha()
    {
        return $this->detallestours->sortBy('fecha_viaje')->first();
    }

    public function sumarPaxPrimerFecha()
    {
        // Obtener el primer detalle de tour basado en la fecha más cercana
        $primerDetalleTour = $this->detallestours->sortBy('fecha_viaje')->first();

        if (!$primerDetalleTour) {
            // Si no hay detalles de tours, retornamos null o 0
            return 0;
        }

        // Filtrar los tours que tengan la misma 'fecha_viaje' y 'tour_id' que el primer detalle
        $mismaFechaYTour = $this->detallestours
            ->where('fecha_viaje', $primerDetalleTour->fecha_viaje)
            ->where('servicio_id', $primerDetalleTour->servicio_id);

        // Sumar los 'pax' de todos los tours con la misma fecha y tour_id
        return $mismaFechaYTour->sum('pax');
    }

    public function ultimafecha()
    {
        return $this->detallestours->sortByDesc('fecha_viaje')->first();
    }

    public function detallestours()
    {
        return $this->hasMany('App\Models\DetalleReserva')
            ->where(function($query) {
                $query->whereRelation('servicio', 'categoria_id', '=', 5)
                ->orWhereRelation('servicio', 'categoria_id', '=', 6);
            })
            ->orderBy('fecha_viaje', 'asc')
            ->orderBy('orden', 'asc');
    }

    public function detallestraslados()
    {
        return $this->hasMany('App\Models\DetalleReserva')
            ->where(function($query) {
                $query->whereRelation('servicio', 'categoria_id', '=', 6);
            })
            ->orderBy('fecha_viaje', 'asc')
            ->orderBy('orden', 'asc');
    }

    public function detallestoursreporte()
    {
        return $this->hasMany('App\Models\DetalleReserva')
            ->where(function($query) {
                $query->whereRelation('servicio', 'categoria_id', '=', 5);
            })
            ->orderBy('fecha_viaje', 'asc')
            ->orderBy('orden', 'asc');
    }

    public function detallestoursItinerario()
    {
        return $this->hasMany('App\Models\DetalleReserva')
            ->selectRaw('fecha_viaje, servicio_id, MIN(id) as id, SUM(pax) as pax,MIN(orden) as orden') // Ajustar select con agregación
            ->where(function($query) {
                $query->whereRelation('servicio', 'categoria_id', '=', 5)
                    ->orWhereRelation('servicio', 'categoria_id', '=', 6);
            })
            ->groupBy('fecha_viaje', 'servicio_id') // Agrupar por fecha_viaje y servicio_id
            ->orderBy('fecha_viaje', 'asc')
            ->orderBy('orden', 'asc');
    }

    public function detallestoursTitulo()
    {
        return $this->hasMany('App\Models\DetalleReserva')
        ->whereHas('servicio', function($query) {
            $query->where('categoria_id', '=', 5);
        })
        ->orderBy('fecha_viaje', 'asc')
        ->get()
        ->unique('servicio_id');
    }

    public function detallestourspdf()
    {
        return $this->hasMany('App\Models\DetalleReserva')
            ->where(function($query) {
                $query->whereRelation('servicio', 'categoria_id', '=', 5)
                ->orWhereRelation('servicio', 'categoria_id', '=', 6);
            })
            ->orderBy('fecha_viaje', 'asc');
    }

    public function detalleshoteles()
    {
        return  $this->hasMany('App\Models\DetalleReserva')->where(function($query) {
            $query->whereRelation('servicio', 'categoria_id', '=', 2);
        })
        ->orderBy('fecha_viaje', 'asc');
    }

    public function detalleshotelesSinConfimar()
    {
        return  $this->hasMany('App\Models\DetalleReserva')->where(function($query) {
            $query->whereRelation('servicio', 'categoria_id', '=', 2);
        })
        ->where('confirmado',0)
        ->orderBy('fecha_viaje', 'asc');
    }

    public function detallesvuelos()
    {
        return  $this->hasMany('App\Models\DetalleReserva')->where(function($query) {
            $query->whereRelation('servicio', 'categoria_id', '=', 3);
        })
        ->orderBy('fecha_viaje', 'asc');
    }

    public function paquete()
    {
        return $this->belongsTo(Paquete::class);
    }

    public function historias()
    {
        return $this->hasMany(Historia::class);
    }

    public function reprogramaciones()
    {
        return $this->hasMany(Reprogramacion::class,'reserva_id');
    }

    public function reprogramacionesinversas()
    {
        return $this->hasMany(Reprogramacion::class,'reserva_ant_id');
    }

    public function operarHotel()
    {
        return $this->hasOne(Operar::class)->where('hotel', 1);
    }

    public function operarTickets()
    {
        return $this->hasMany(Operar::class)->where('hotel',0)->where('operado',0)->where('traslado',0)->where('vuelo',0);
    }

    public function tieneServicioMachuPicchu()
    {
        foreach ($this->detallestours as $detalle) {
            // Verificamos si el título del servicio contiene alguna de las variantes
            if (stripos($detalle->servicio->titulo, 'MACHUPICCHU') !== false || 
                stripos($detalle->servicio->titulo, 'MACHU PICCHU') !== false) {
                return true; // Si se encuentra, retornamos true
            }
        }

        return false; // Si no se encuentra, retornamos false
    }

}

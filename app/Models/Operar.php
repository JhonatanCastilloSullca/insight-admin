<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Operar extends Model
{
    use HasFactory;
    protected $fillable = [
        

        'fecha',
        'cantidad_pax',
        'observacion',
        'precioSoles',
        'servicio_id',
        'user_id',
        'estado',
        'operado',
        'endose',
        'machupicchu',
        'otros',
        'ingresos',
        'traslado',
        'ubicacion_id',
        'hotel',
        'vuelo',
        'reserva_id',
        'noches',
        'pagado',
        'precioDolares',
    ];
    public function servicio()
    {
        return $this->belongsTo('App\Models\Servicio', 'servicio_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function operarPasajeros()
    {
        return $this->hasMany('App\Models\OperarPasajero', 'operar_id');
    }

    public function operarServicios()
    {
        return $this->hasMany('App\Models\OperarServicio', 'operar_id');
    }

    public function operarServiciosProveedor()
    {
        return $this->operarServicios()
        ->get()
        ->groupBy('proveedor_id');
    }

    public function operarServiciosProveedorTraslados()
    {
        $agrupados = $this->operarServicios()
        ->with('proveedor')
        ->get()
        ->groupBy('proveedor_id');

        return $agrupados->map(function ($servicios, $proveedorId) {
            $nombreProveedor = $servicios->first()->proveedor->nombre ?? 'Sin nombre';
            $celularProveedor = $servicios->first()->proveedor->celular ?? '';
            return [
                'proveedor_id' => $proveedorId,
                'nombre_proveedor' => $nombreProveedor,
                'celular' => $celularProveedor,
                'servicios' => $servicios,
            ];
        });
    }

    public function operarHotelsPrecio()
    {
        return $this->hasMany('App\Models\OperarServicio', 'operar_id')
            ->whereHas('detallereserva', function ($query) {
                $query->where('confirmado', 1);
            });
    }

    public function operarEditarHotel()
    {
        return $this->hasMany('App\Models\OperarServicio', 'operar_id')
            ->whereHas('detallereserva', function ($query) {
                $query->where('confirmado','<',2);
            });
    }

    public function pagarHotelsPrecio()
    {
        return $this->hasMany('App\Models\OperarServicio', 'operar_id')
            ->whereHas('detallereserva', function ($query) {
                $query->where('confirmado', 2);
            });
    }

    public function saldoOperarHotel()
    {
        return $this->hasMany('App\Models\OperarServicio', 'operar_id')
        ->whereHas('detallereserva', function ($query) {
            $query->where('confirmado', 2);
        })
        ->select('operar_servicios.proveedor_id', 'proveedors.nombre as proveedor_nombre', 'operar_servicios.moneda_id','monedas.abreviatura', \DB::raw('SUM(saldo) as total_pagar'), \DB::raw('SUM(precio) as total_precio'), \DB::raw('SUM(acuenta) as total_acuenta'))
        ->where('saldo', '>', 0)
        ->join('proveedors', 'operar_servicios.proveedor_id', '=', 'proveedors.id')
        ->join('monedas', 'operar_servicios.moneda_id', '=', 'monedas.id')
        ->groupBy('operar_servicios.proveedor_id', 'proveedors.nombre', 'operar_servicios.moneda_id','monedas.abreviatura');
    }

    public function detalles()
    {
        return $this->hasMany('App\Models\OperarDetalleReserva', 'operar_id');
    }

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }

    public function operarProveedorNombre()
    {
        $proveedores = $this->operarServicios()
            ->join('proveedors', 'operar_servicios.proveedor_id', '=', 'proveedors.id') // Asegúrate de ajustar los nombres de tablas y campos según tu base de datos
            ->distinct()
            ->pluck('proveedors.nombre');

        return $proveedores;
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }
}

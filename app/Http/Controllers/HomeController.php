<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\Liquidacion;
use App\Models\Pago;
use App\Models\Pais;
use App\Models\Paquete;
use App\Models\Proveedor;
use App\Models\Servicio;
use App\Models\Total;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // $token = config('services.apisunat.token');
        // $urldni = config('services.apisunat.urlcambio');

        // // $response = Http::timeout(10)->withHeaders([
        // //     'Referer' => 'http://apis.net.pe/api-ruc',
        // //     'Authorization' => 'Bearer ' . $token
        // // ])->get($urldni . '48507551');
        // // $fecha = ($response->json());
        // $response = Http::timeout(10)->withHeaders([
        //     'Referer' => 'https://api.apis.net.pe',
        //     'Authorization' => 'Bearer ' . $token
        // ])->get($urldni . '2024-08-09');
        // $fecha = ($response->json());

        // dd($fecha);


        $fechaInicio2 = $request->fechaInicio ?? now()->format('Y-m-d');
        $fechaFin2 = $request->fechaFin ?? now()->format('Y-m-d');

        $usuarios = User::with('roles')->where('estado',1)->orderBy('nombre')->get();
        $reservasPorUsuario = User::select('users.usuario', DB::raw('COALESCE(SUM(reservas.id IS NOT NULL), 0) as cantidad_reservas'))
        ->leftJoin('reservas', 'users.id', '=', 'reservas.user_id')
        ->whereBetween('reservas.fecha', [$fechaInicio2.' 00:00:00', $fechaFin2.' 23:59:59'])
        ->where('reservas.confirmado',1)
        ->where('reservas.estado',1)
        ->groupBy('users.id', 'users.usuario')
        ->orderBy('users.usuario')
        ->get();

        $cantidadDinero = Total::join('reservas', 'totals.reserva_id', '=', 'reservas.id')
        ->join('users', 'reservas.user_id', '=', 'users.id')
        ->where('reservas.confirmado',1)
        ->select('users.usuario', 
            DB::raw('SUM(CASE WHEN moneda_id = 1 THEN totals.total ELSE 0 END) AS total_soles'),
            DB::raw('SUM(CASE WHEN moneda_id = 2 THEN totals.total ELSE 0 END) AS total_dolares')
        )
        ->whereBetween('reservas.fecha', [$fechaInicio2.' 00:00:00', $fechaFin2.' 23:59:59'])
        ->groupBy('users.usuario')
        ->get();

        $paisesconsumo = Pais::join('pasajeros','pais.id','=','pasajeros.pais_id')
        ->join('pasajero_reserva','pasajero_reserva.pasajero_id','=','pasajeros.id')
        ->join('reservas','pasajero_reserva.reserva_id','=','reservas.id')
        ->select('pais.nombre',DB::raw('COUNT(reserva_id) as total'))
        ->where('reservas.confirmado',1)
        ->groupBy('pais.nombre')
        ->orderBy('total','desc')->limit(10)->get();

        $tourmasVendido = Servicio::join('detalle_reservas','servicios.id','=','detalle_reservas.servicio_id')
        ->join('reservas','detalle_reservas.reserva_id','=','reservas.id')
        ->select('servicios.titulo',DB::raw('COUNT(pax) as total'))
        ->where('servicios.categoria_id',5)
        ->where('reservas.confirmado',1)
        ->groupBy('servicios.titulo')
        ->orderBy('total','desc')->limit(5)->get();

        $paquetemasVendido = Paquete::join('reservas','paquetes.id','=','reservas.paquete_id')
        ->select('paquetes.titulo',DB::raw('COUNT(paquetes.id) as total'))
        ->where('reservas.confirmado',1)
        ->groupBy('paquetes.titulo')
        ->orderBy('total','desc')->limit(5)->get();

        $frecuenciaGuias = Proveedor::join('operar_servicios','proveedors.id','=','operar_servicios.proveedor_id')
        ->select('proveedors.nombre',DB::raw('COUNT(operar_servicios.id) as total'))
        ->where('proveedors.categoria_id',11)
        ->groupBy('proveedors.nombre')
        ->orderBy('total','desc')->get();

        $frecuenciaTransporte = Proveedor::join('operar_servicios','proveedors.id','=','operar_servicios.proveedor_id')
        ->select('proveedors.nombre',DB::raw('COUNT(operar_servicios.id) as total'))
        ->where('proveedors.categoria_id',9)
        ->groupBy('proveedors.nombre')
        ->orderBy('total','desc')->get();

        $frecuenciaAgencias = Proveedor::join('operar_servicios','proveedors.id','=','operar_servicios.proveedor_id')
        ->select('proveedors.nombre',DB::raw('COUNT(operar_servicios.id) as total'))
        ->where('proveedors.categoria_id',5)
        ->groupBy('proveedors.nombre')
        ->orderBy('total','desc')->get();

        $frecuenciaHoteles = Proveedor::join('operar_servicios','proveedors.id','=','operar_servicios.proveedor_id')
        ->select('proveedors.nombre',DB::raw('COUNT(operar_servicios.id) as total'))
        ->where('proveedors.categoria_id',2)
        ->groupBy('proveedors.nombre')
        ->orderBy('total','desc')->get();

        $incidencias = Incidencia::select('descripcion',DB::raw('SUM(cantidad) as total'))->groupBy('descripcion')->get();

        $pagos = Pago::sum('monto');
        $cobros = Liquidacion::where('tipo',2)->sum('total');
        

        // dd($frecuenciaTransporte);
        return view('dashboard', compact('pagos','cobros','incidencias','frecuenciaHoteles','frecuenciaAgencias','frecuenciaTransporte','frecuenciaGuias','paquetemasVendido','tourmasVendido','paisesconsumo','usuarios','fechaInicio2','fechaFin2','reservasPorUsuario','cantidadDinero'));
    }
}

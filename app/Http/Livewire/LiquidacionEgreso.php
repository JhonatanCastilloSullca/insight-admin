<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\DetalleLiquidacion;
use App\Models\Liquidacion;
use App\Models\OperarServicio;
use App\Models\Proveedor;
use Livewire\Component;
use DB;
use Carbon\Carbon;

class LiquidacionEgreso extends Component
{
    public $idCategoria;
    public $idProveedor;
    public $categorias;
    public $fecha;
    public $observacion;
    public $detalles;
    public $totalliquidacionSoles=0;
    public $totalliquidacionDolares=0;
    public $totalliquidacionIngresos=0;
    public $push=array(["id"=>"","text"=>"SELECCIONE..."]);

    public $precio=[];
    public $ingresos=[];
    public $monedaId=[];
    public $comentarios=[];

    public function mount()
    {
        $this->fecha=date('Y-m-d');
        $this->categorias=Categoria::where('id','>','12')->get();
    }

    public function updatedidCategoria($value)
    {
        if($value==1){
            $proveedors=Proveedor::select('id','nombre as text')->where('categoria_id','=',$value)->where('precio','>',0)->get();
        }else{
            $proveedors=Proveedor::select('id','nombre as text')->where('categoria_id','=',$value)->get();
        }
        $this->push=collect($this->push);
        $datos=$this->push->concat($proveedors);
        $this->emit('aumentar',$datos);
        $this->detalles=[];
        $this->totalliquidacionSoles=0;
        $this->totalliquidacionDolares=0;
        $this->totalliquidacionIngresos=0;
    }

    public function updatedfecha($value)
    {
        $this->buscarDetalles();
    }

    public function updatedidProveedor($value)
    {
        $this->buscarDetalles();
    }

    public function buscarDetalles()
    {
        if($this->idProveedor && $this->fecha){
            $this->precio = [];
            $this->ingresos = [];
            $this->monedaId = [];
            $this->comentarios = [];
            $this->detalles=[];
            $detalles=OperarServicio::where('proveedor_id',$this->idProveedor)->where('pagado',0)->whereRelation('operar','fecha','<=',$this->fecha)->get();
            $this->totalliquidacionSoles=$detalles->where('moneda_id',1)->sum('precio');
            $this->totalliquidacionDolares=$detalles->where('moneda_id',2)->sum('precio');
            $totalIngresos=0;
            foreach($detalles as $i => $detalle){
                $nuevoDetalle=[
                    'id' => $detalle->id,
                    'fecha' => $detalle->operar->fecha,
                    'hora' => $detalle->recojo,
                    'titulo' => $detalle->operar->servicio ? $detalle->operar->servicio->titulo : $detalle->servicio->titulo,
                    'pax' => $detalle->operar->servicio ? $detalle->operar->cantidad_pax : $detalle->cantidad,
                    'precio' => $detalle->precio,
                    'operar' => count($detalle->operar->detalles)>0 ? 1 : 0,
                    'servicio_id' => $detalle->operar->servicio ? $detalle->operar->servicio->id : $detalle->servicio->id,
                    'moneda_id' => $detalle->moneda_id,
                    'ingresos' => $detalle->operar->ingresos,
                ];
                $pax=[];
                if(count($detalle->operar->detalles)>0){
                    foreach($detalle->operar->detalles as $detail){
                        $pax[]=[
                            'pasajero' => $detail->detalleReserva?->reserva?->pasajeroprincipal()?->nombreCompleto,
                            'paxs' => $detail->detalleReserva?->reserva?->sumarPaxPrimerFecha(),
                        ];
                    }
                }else{
                    $pax[]=[
                        'pasajero' => $detalle->detalleReserva?->reserva?->pasajeroprincipal()?->nombreCompleto,
                        'paxs' => $detalle->detalleReserva?->reserva?->sumarPaxPrimerFecha(),
                    ];
                }
                $nuevoDetalle['pasajeros']= $pax;
                $this->precio[$i] = $detalle->precio;
                $this->ingresos[$i] = $detalle->operar->ingresos;
                $this->monedaId[$i] = $detalle->moneda_id;
                $this->comentarios[$i] = '';
                $this->detalles[]=$nuevoDetalle;
                $totalIngresos += $detalle->operar->ingresos;
            }
            $this->totalliquidacionIngresos = $totalIngresos;
        }
    }

    public function calcularTotales()
    {
        $ingresos =0;
        $totalSoles =0;
        $totalDolares =0;
        foreach($this->detalles as $i => $detalle){
            if($this->monedaId[$i] == 2){
                $totalDolares += $this->precio[$i];
            }else{
                $totalSoles += $this->precio[$i];
            }
            $ingresos += $this->ingresos[$i];
        }
        $this->totalliquidacionSoles=$totalSoles;
        $this->totalliquidacionDolares=$totalDolares;
        $this->totalliquidacionIngresos=$ingresos;
    }

    public function cambiarTipoMoneda($i)
    {
        $this->monedaId[$i] = $this->monedaId[$i] == 1 ? 2:1;
        $this->calcularTotales();
    }

    public function updatedingresos()
    {
        $this->calcularTotales();
    }

    public function precio()
    {
        $this->calcularTotales();
    }

    // public function remove($i)
    // {
    //     $this->totalliquidacion=$this->totalliquidacion-$this->detalles[$i]->precio;
    //     unset($this->detalles[$i]);
    // }

    public function register()
    {
        try{
            DB::beginTransaction();
            $mytime= Carbon::now('America/Lima');

            $liquidacion=Liquidacion::create([
                'fecha' => $mytime->toDateTimeString(),
                'acuenta' => 0,
                'saldo' => 0,
                'total' => $this->totalliquidacionSoles,
                'totalDolares' => $this->totalliquidacionDolares,
                'totalIngresos' => $this->totalliquidacionIngresos,
                'proveedor_id' => $this->idProveedor,
                'user_id' => \Auth::user()->id,
                'tipo' => 2,
                'observacion' => $this->observacion,
            ]);

            foreach($this->detalles as $i => $detalle1){
                $detalless=DetalleLiquidacion::create([
                    'liquidacion_id' => $liquidacion->id,
                    'ejecutable_type' => 'App\Models\OperarServicio',
                    'ejecutable_id'  => $detalle1['id'],
                    'cantidad' => $detalle1['pax'],
                    'precio'  => $this->precio[$i],
                    'moneda_id'  => $this->monedaId[$i],
                    'precioAnterior'  => $detalle1['precio'],
                    'operar'  => $detalle1['operar'],
                    'servicio_id'  => $detalle1['servicio_id'],
                    'moneda_id_anterior'  => $detalle1['moneda_id'],
                    'comentarios'  => $this->comentarios[$i],
                    'ingresoAnterior'  => $detalle1['ingresos'],
                    'ingreso'  => $this->ingresos[$i],
                ]);
                $detalle=OperarServicio::find($detalle1['id']);
                $detalle->pagado=1;
                $detalle->save();
            }

            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }

        return redirect()->route('liquidacion.salida')->with('success', 'Operacion creado exitosamente.');
    }

    public function render()
    {
        return view('livewire.liquidacion-egreso');
    }
}

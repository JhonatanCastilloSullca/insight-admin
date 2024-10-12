<?php

namespace App\Http\Livewire;

use App\Exports\ConseturExport;
use App\Models\DetalleReserva;
use App\Models\Servicio;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class CrearOperacionOtros extends Component
{
    public $servicios;
    public $detalles = [];

    public $servicioid;
    public $fecha;
    public $observacion;

    public $ingresos;
    public $horarios;
    public $observaciones;

    public $paxTotal = 0;
    public $totalIngresos = 0;
    public $totalSoles = 0;
    public $totalDolares = 0;
    public $precioTipoCambio = 0;

    public function mount()
    {
        $this->servicios = Servicio::where('incluye',1)->whereNotIn('categoria_id',[2,3])->orderBy('titulo','asc')->get();
    }

    public function updatedservicioid()
    {
        $this->buscarDetalles();
    }

    public function updatedfecha()
    {
        $this->buscarDetalles();
    }

    public function buscarDetalles()
    {
        if($this->servicioid != '' && $this->fecha != '')
        {
            $detalles = DetalleReserva::whereRelation('servicio', 'categoria_id', 5)
            ->where('operado', 0)
            ->whereDate('fecha_viaje', $this->fecha)
            ->whereRelation('reserva', 'confirmado', 1)
            ->whereHas('itinerarios', function($query) {
                $query->whereHas('incluyes', function($subquery) {
                    $subquery->where('servicio_incluido_id', $this->servicioid);
                });
            })
            ->get();
            $this->paxTotal = $detalles->sum('pax');
            foreach($detalles as $i => $detalle)
            {
                if($detalle->moneda_id == 2){
                    $this->totalDolares += $detalle->precio * $detalle->pax;
                }else{
                    $this->totalSoles += $detalle->precio * $detalle->pax;
                }
                $nuevoServicio = [
                    'id' => $detalle->id,
                    'reservaid' => $detalle->reserva->id,
                    'pax' => $detalle->pax,
                    'fecha' => $detalle->fecha_viaje,
                    'precio' => $detalle->precio * $detalle->pax,
                    'moneda' => $detalle->moneda->abreviatura ,
                    'tipo' => $detalle->tipo,
                    'servicio' => $detalle->servicio->titulo,
                    'celular' => $detalle->reserva->pasajeroprincipal()->celular,
                    'hotel' => $detalle->hotel?->nombre.' '.$detalle->hotel?->direccion,
                ];
                $this->observaciones[$i] = $detalle->comentarios;
                $this->ingresos[$i] = 0;
                $this->horarios[$i] = null;

                $incluyes=[];
                foreach($detalle->itinerarios as $i => $itinerario)
                {
                    foreach($itinerario->incluyes as $id)
                    {
                        $incluye = [
                            'id' => $id->id,
                            'servicio' => $id->titulo
                        ];
                        $incluyes[] = $incluye;
                    }
                }

                $pasajeros=[];
                foreach($detalle->reserva->pasajeros as $i => $pasajero)
                {
                    $pasajero = [
                        'nombreCompleto' => $pasajero->nombrePaterno,
                        'apellidoPaterno' => $pasajero->apellidoPaterno,
                        'apellidoMaterno' => $pasajero->apellidoMaterno,
                        'nombres' => $pasajero->nombres,
                        'tipo_documento' => $pasajero->documento->tipo_documento,
                        'num_documento' => $pasajero->documento->num_documento,
                        'nacimiento' => $pasajero->nacimiento,
                        'idPais' => $pasajero->pais->codeConsetur,
                        'genero' => $pasajero->genero,
                        'cumpleaños' => $pasajero->pasajeroscumpleaño($this->fecha),
                        'edad' => $pasajero->edad,
                        'pais' => $pasajero->pais->nombre,
                    ];
                    $pasajeros[] = $pasajero;
                }

                $nuevoServicio['incluyes'] = $incluyes;
                $nuevoServicio['pasajeros'] = $pasajeros;
                $this->detalles[] = $nuevoServicio;
            }
            $this->precioTipoCambio = (($this->totalDolares * 3.70) + $this->totalSoles ) - (($this->totalDolares * 3.70 * 6) /100);
        }
    }

    public function plantillaConsetur()
    {
        return Excel::download(new ConseturExport($this->detalles), 'consetur.xlsx');
    }

    public function render()
    {
        return view('livewire.crear-operacion-otros');
    }
}

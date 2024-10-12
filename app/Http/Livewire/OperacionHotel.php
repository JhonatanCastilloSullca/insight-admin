<?php

namespace App\Http\Livewire;

use App\Mail\HotelMailable;
use App\Models\Operar;
use App\Models\OperarDetalleReserva;
use App\Models\OperarPasajero;
use App\Models\OperarServicio;
use App\Models\Proveedor;
use App\Models\Reserva;
use Carbon\Carbon;
use Livewire\Component;
use DB;
use Illuminate\Support\Facades\Mail;

class OperacionHotel extends Component
{
    public $reserva;
    public $operar;
    public $detalles = [];
    public $comentario = [];
    public $pasajeros = [];
    public $notificacion=1;
    public $selectedServicios = [];

    public function mount(Reserva $reserva)
    {
        $this->reserva = $reserva;
        $this->operar = $reserva->operarHotel;
        $this->detalles = $reserva->detalleshotelesSinConfimar;
        // Usa colecciones para mantener la reactividad adecuada
        foreach($this->detalles as $i => $detalle) {
            $this->comentario[$i] = $detalle->servicio->titulo;
            foreach($detalle->reserva->pasajeros as $pasajero){
                $this->pasajeros[$i][] = [
                    'id' => $pasajero->id,
                    'nombreCompleto' => $pasajero->nombreCompleto,
                    'tipo_documento' => $pasajero->documento->tipo_documento,
                    'num_documento' => $pasajero->documento->num_documento,
                    'nacimiento' => $pasajero->nacimiento,
                    'celular' => $pasajero->celular,
                    'pais' => $pasajero->pais->nombre,
                    'comentario' => $pasajero->comentario,
                ];
            }
        }
    }

    public function remove($detalleIndex, $pasajeroIndex)
    {
        if (isset($this->pasajeros[$detalleIndex])) {
            $pasajeros = collect($this->pasajeros[$detalleIndex]);
            if ($pasajeros->has($pasajeroIndex)) {
                $pasajeros->forget($pasajeroIndex);
                $this->pasajeros[$detalleIndex] = $pasajeros->values()->all();
            }
        }
        
    }

    public function notificar($operar)
    {
        $serviciosANotificar = OperarServicio::whereIn('id', $this->selectedServicios)->get()->groupBy('proveedor_id');

        foreach ($serviciosANotificar as $proveedorId => $detalles)
        {
            $proveedor = Proveedor::find($proveedorId);
            if ($proveedor->correo == 2)
            {
                $mensaje = "Estimado equipo del Hotel *{$proveedor->nombre}*,\n\n";
                $mensaje .= "Reciban un cordial saludo de parte de la *Agencia de Viajes Cuzco Travel*. Nos dirigimos a ustedes para solicitar la reserva de las siguientes habitaciones:\n\n";
                
                foreach ($detalles as $detalle) {
                    $mensaje .= "Tipo de Habitación: *{$detalle->observacion}*\n";
                    $mensaje .= "Incluye:\n";
                    
                    foreach ($detalle->servicio->itinerarios as $itinerario) {
                        foreach ($itinerario->incluyes as $incluye) {
                            $mensaje .= "- {$incluye->titulo}\n";
                        }
                    }

                    $mensaje .= "\nDetalles de la Reserva:\n\n";
                    $mensaje .= "*{$detalle->detalleReserva?->pax} HABITACION {$detalle->observacion}*\n";
                    $mensaje .= "*Check-in:* " . date("d-m-Y", strtotime($detalle->detalleReserva?->fecha_viaje)) . "\n";
                    $mensaje .= "*Check-out:* " . date("d-m-Y", strtotime($detalle->detalleReserva?->fecha_viajefin)) . "\n";
                    $mensaje .= "*Total:* {$detalle->detalleReserva?->equipaje} noches\n\n";
                    $mensaje .= "Nº Pasajeros: *" . count($detalle->operarPasajeros) . "*\n";

                    foreach ($detalle->operarPasajeros as $i => $pasajero) {
                        $mensaje .= "*Pasajero " . ($i + 1) . ":* {$pasajero->pasajero->nombreCompleto} (" . \Carbon\Carbon::parse($pasajero->pasajero->nacimiento)->diffInYears(\Carbon\Carbon::now()) . " años)\n";
                        $mensaje .= "*Número de {$pasajero->pasajero->documento?->tipo_documento}:* {$pasajero->pasajero->documento?->num_documento}\n";
                        $mensaje .= "*Nacionalidad:* {$pasajero->pasajero->pais?->nombre}\n";
                    }
                }

                $mensaje .= "Agradecemos su atención y esperamos su confirmación a la brevedad posible.\n\n";
                $mensaje .= "El presente mensaje ha sido enviado por *{$operar->user->nombre} de Cuzco Travel*.\n";
                $mensaje .= "Quedamos a su disposición para cualquier consulta adicional.\n\n";
                $mensaje .= "Atentamente,\n";
                $mensaje .= "*{$operar->user->nombre}*\n";
                $mensaje .= "Agencia de Viajes Cuzco Travel\n";
                $mensaje .= "Teléfono: +51 926 561 020\n";
                $mensaje .= "Correo electrónico: ventas@cuscoinsight.com\n";
                $mensaje .= "http://www.cuscoinsight.com\n";
            
                // Codifica el mensaje para URL
                $mensajeCodificado = urlencode($mensaje);

                $telefono = preg_replace('/[^0-9]/', '', $proveedor->celular);

                $link = 'https://api.whatsapp.com/send/?phone=' . $telefono . '&text=' . $mensajeCodificado . '&type=phone_number';
                
                $this->emit('abrirLink', $link);
            }
            if($proveedor->correo == 1)
            {
                Mail::mailer('operaciones')->to($proveedor->email)->send(new HotelMailable($detalles,$proveedor,$operar));
            }
        }

        return redirect()->route('operacion.tours')->with('success', 'Operacion de hotel creado exitosamente.');
    }

    public function registerNotificar()
    {        
        $operar = $this->guardar();
        $this->notificar($operar);
    }

    public function register()
    {
        $this->guardar();
        return redirect()->route('operacion.tours')->with('success', 'Operacion de hotel creado exitosamente.');
    }

    public function guardar()
    {
        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');

            if(isset($this->operar->id)){
                $operar = Operar::find($this->operar->id);
            }else{
                $operar = Operar::create([
                    'cantidad_pax'      => count($this->reserva->pasajeros),
                    'fecha'             => $mytime->toDateTimeString(),
                    'user_id'           => \Auth::id(),
                    'precioSoles'       => 0,
                    'precioDolares'     => 0,
                    'operado'           => 0,
                    'tipo'           => 1,
                    'estado'            => 0,
                    'reserva_id'        => $this->reserva->id,
                    'noches'            => $this->reserva->detalleshoteles()->sum('equipaje'),
                    'hotel'            => 1,
                ]);
            }
            
    
            foreach($this->reserva->detalleshotelesSinConfimar as $i => $detalle)
            {
                $operarservicio = OperarServicio::where('operar_id',$operar->id)->where('detalle_reserva_id',$detalle->id)->first();
                if($operarservicio){
                    $operarservicio->servicio_id = $detalle->servicio_id;
                    $operarservicio->proveedor_id = $detalle->servicio->proveedor_id;
                    $operarservicio->observacion = $this->comentario[$i];
                    $operarservicio->save();
                }else{
                    $operarservicio = OperarServicio::create([
                        'operar_id' => $operar->id,
                        'servicio_id' => $detalle->servicio_id,
                        'proveedor_id' => $detalle->servicio->proveedor_id,
                        'precio' => 0,
                        'observacion' => $this->comentario[$i],
                        'tipo' => 0,
                        'detalle_reserva_id' => $detalle->id,
                        'cantidad' => $detalle->pax,
                        'noches' => $detalle->equipaje,
                    ]);
                }

                $this->selectedServicios[] = $operarservicio->id;
                
                $operarservicio->operarPasajeros()->delete();

                foreach($this->pasajeros[$i] as $pasajero){
                    OperarPasajero::create([
                        'operar_servicio_id' => $operarservicio->id,
                        'pasajero_id' => $pasajero['id'],
                        'recojo'  => '10:00:00',
                    ]);
                }
        
                $detalle->update([
                    'confirmado'      => '1',
                ]);
            }
            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }

        return $operar;
    }

    public function render()
    {
        return view('livewire.operacion-hotel');
    }
}

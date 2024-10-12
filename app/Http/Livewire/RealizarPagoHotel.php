<?php

namespace App\Http\Livewire;

use App\Mail\PagoHotelMailable;
use App\Models\Devolucion;
use App\Models\Medio;
use App\Models\OperarServicio;
use App\Models\Proveedor;
use App\Models\Reserva;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use DB;
use Illuminate\Support\Facades\Mail;

class RealizarPagoHotel extends Component
{
    use WithFileUploads;

    public $reserva;
    public $operar;
    public $detalles=[];
    public $medio;
    public $imagen;
    public $num_operacion;
    public $comentarios;
    public $total;
    public $pagos=[];
    public $proveedor;
    public $monedaId;

    public function mount(Reserva $reserva)
    {
        $this->reserva = $reserva;
        $this->operar = $reserva->operarHotel;
        foreach($this->operar->saldoOperarHotel as $detalle)
        {
            $this->detalles[]=[
                'proveedor_id' => $detalle->proveedor_id,
                'proveedor_nombre' => $detalle->proveedor_nombre,
                'total_precio' => $detalle->total_precio,
                'total_acuenta' => $detalle->total_acuenta,
                'total_pagar' => $detalle->total_pagar,
                'moneda_id' => $detalle->moneda_id,
                'abreviatura' => $detalle->abreviatura,
            ];
        }
    }

    public function agregarPago($proveedorId,$monedaId,$total)
    {
        $this->pagos = OperarServicio::where('proveedor_id',$proveedorId)
        ->where('operar_id',$this->operar->id)->where('saldo','>',0)
        ->get();
        $this->proveedor = Proveedor::find($proveedorId);
        $this->monedaId = $monedaId;
        $this->total = $total;
        $data=Medio::select('id','nombre as text')->where('moneda_id',$monedaId)->where('estado',1)->get();
        $data = $data->toArray();
        array_unshift($data, ['id' => '', 'text' => 'Seleccione']);
        $this->num_operacion = '';
        $this->comentarios = '';
        $this->imagen = '';
        $this->emit('abrir-modal-pago',$data);
    }

    public function guardarPago()
    {
        $this->validate([
            'medio' => 'required|exists:medios,id',
            'total' => 'required|min:1|numeric',
        ]);
        try{
            DB::beginTransaction();
            $totalPagado = $this->total;
            foreach($this->pagos as $pago)
            {
                if($this->imagen){
                    $nombreimg=$pago->id.'.'.$this->imagen->getClientOriginalExtension();
                    $ruta=$this->imagen->storeAs('img/pagosHoteles',$nombreimg);
                }else{
                    $nombreimg='';
                }
                $totalPagado = $totalPagado - $pago->saldo;
                if($totalPagado >= 0){
                    $pago->acuenta = $pago->precio;
                    $pago->saldo = 0;
                    $pago->pagado = 1;

                    $pago->detalleReserva->confirmado = 3;
                    $pago->detalleReserva->save();
                }else{
                    $pago->acuenta = $this->total;
                    $pago->saldo = $pago->saldo - $this->total;
                }
                $pago->save();

                $mytime= Carbon::now('America/Lima');

                $nuevopago = new Devolucion();
                $nuevopago->user_id =\Auth::user()->id;
                $nuevopago->moneda_id = $pago->moneda_id;
                $nuevopago->medio_id = $this->medio;
                $nuevopago->fecha =  $mytime->toDateTimeString();
                if($totalPagado >= 0){
                    $nuevopago->monto = $pago->precio;
                }else{
                    $nuevopago->monto = $this->total;
                }
                $nuevopago->num_operacion = $this->num_operacion;
                $nuevopago->factura = 0;
                $nuevopago->comentarios = $this->comentarios;
                $nuevopago->operar_servicio_id = $pago->id;
                $nuevopago->imagen = $nombreimg;
                $nuevopago->save();
            }
            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }
        $pagos = $this->pagos;
        $proveedor = $this->proveedor;
        $user = User::find(\Auth::user()->id);

        if($proveedor->correo == 1){
            Mail::mailer('operaciones')->to($pago->proveedor->email)->send(new PagoHotelMailable($pagos,$proveedor,$user,$mytime->toDateTimeString(),$this->total,$this->monedaId));
        }
        if($proveedor->correo == 2){
            $mensaje = "Estimado equipo del Hotel *{$proveedor->nombre}*,\n\n";
            $mensaje .= "Les informamos que hemos realizado el pago correspondiente a la reserva de las siguientes habitaciones:\n\n";
            
            foreach ($pagos as $detalle) {
                $mensaje .= "\nDetalles de la Reserva:\n\n";
                $mensaje .= "*{$detalle->detalleReserva?->pax} HABITACION {$detalle->observacion}*\n";
                $mensaje .= "*Check-in:* " . date("d-m-Y", strtotime($detalle->detalleReserva?->fecha_viaje)) . "\n";
                $mensaje .= "*Check-out:* " . date("d-m-Y", strtotime($detalle->detalleReserva?->fecha_viajefin)) . "\n";
                $mensaje .= "*Total:* {$detalle->detalleReserva?->equipaje} noches\n\n";
                $mensaje .= "Nº Pasajeros: *" . count($detalle->operarPasajeros) . "*\n";
                foreach ($detalle->operarPasajeros as $i => $pasajero) {
                    $mensaje .= "*Pasajero " . ($i + 1) . ":* {$pasajero->pasajero->nombreCompleto} (" . \Carbon\Carbon::parse($pasajero->pasajero->nacimiento)->diffInYears(\Carbon\Carbon::now()) . " años)\n";
                }
            }
            $fechaa = date("d-m-Y",strtotime($mytime->toDateTimeString())); 
            $montoo=$this->monedaId == 2 ? '$ '.$this->total : 'S/ '.$this->total;
            $mensaje .= "Monto Total Pagado: {$montoo} .\n";
            $mensaje .= "Fecha de Pago: {$fechaa} .\n\n";
            $mensaje .= "Agradecemos confirmar la recepción del pago y las reservas. Quedamos atentos a su respuesta.\n\n";
            $mensaje .= "Atentamente,\n";
            $mensaje .= "*{$user->nombre}*\n";
            $mensaje .= "Agencia de Viajes Jisa Adventure\n";
            $mensaje .= "Teléfono: +51 926 561 020\n";
            $mensaje .= "Correo electrónico: operaciones@cuscoinsight.com\n";
        
            // Codifica el mensaje para URL
            $mensajeCodificado = urlencode($mensaje);

            $telefono = preg_replace('/[^0-9]/', '', $proveedor->celular);

            $link = 'https://api.whatsapp.com/send/?phone=' . $telefono . '&text=' . $mensajeCodificado . '&type=phone_number';
            
            $this->emit('abrirLink', $link);
        }

        return redirect()->route('operacion.realizarpagohotel',['reserva' => $this->reserva])->with('success', 'Pagos de hotel agregados exitosamente.');
    }

    public function render()
    {
        return view('livewire.realizar-pago-hotel');
    }
}

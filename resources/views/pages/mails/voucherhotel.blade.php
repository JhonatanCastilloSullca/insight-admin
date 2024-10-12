@component('mail::message')

Estimado equipo del Hotel **{{ $proveedor->nombre }}**,

Reciban un cordial saludo de parte de la **Agencia de Viajes Jisa Adventure**. Nos dirigimos a ustedes para solicitar la reserva de las siguientes habitaciones:

@foreach($detalles as $detalle)
Tipo de Habitación: **{{ $detalle->observacion }}**  
Incluye: 
@foreach($detalle->servicio->itinerarios as $itinerario)
@foreach($itinerario->incluyes as $incluye)
- {{ $incluye->titulo }}
@endforeach
@endforeach

Detalles de la Reserva:

**{{ $detalle->detalleReserva?->pax }} HABITACION {{ $detalle->observacion }}**  
**Check-in:** {{ date("d-m-Y", strtotime($detalle->detalleReserva?->fecha_viaje)) }}  
**Check-out:** {{ date("d-m-Y", strtotime($detalle->detalleReserva?->fecha_viajefin)) }}  
**Total:** {{ $detalle->detalleReserva?->equipaje }} noches    
Nº Pasajeros: {{ count($detalle->operarPasajeros) }}  
@foreach($detalle->operarPasajeros as $i => $pasajero)
**Pasajero {{ $i + 1 }}:** {{ $pasajero->pasajero->nombreCompleto }} ({{ \Carbon\Carbon::parse($pasajero->pasajero->nacimiento)->diffInYears(\Carbon\Carbon::now()) }})  
**Número de {{ $pasajero->pasajero->documento?->tipo_documento }}:** {{ $pasajero->pasajero->documento?->num_documento }}  
**Nacionalidad:** {{ $pasajero->pasajero->pais?->nombre }}  
@endforeach


@endforeach

Agradecemos su atención y esperamos su confirmación a la brevedad posible con la *fecha limite de pago*.

El presente correo ha sido enviado por **{{ $operar->user->nombre }} de Jisa Adventure**. Quedamos a su disposición para cualquier consulta adicional.

Atentamente,  
**{{ $operar->user->nombre }}**  
Agencia de Viajes Jisa Adventure  
Teléfono: [+51 926 561 020](https://wa.me/51926561020)  
Correo electrónico: ventas@cuscoinsight.com  
[www.cuscoinsight.com](http://www.cuscoinsight.com)

@endcomponent
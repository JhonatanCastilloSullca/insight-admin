@component('mail::message')

Estimado equipo del Hotel **{{ $proveedor->nombre }}**,

Les informamos que hemos realizado el pago correspondiente a la reserva de las siguientes habitaciones:

Detalles de la Reserva:  
@foreach($pago as $detalle)
**{{ $detalle->detalleReserva?->pax }} HABITACION {{ $detalle->observacion }}**
**Check-in:** {{ date("d-m-Y", strtotime($detalle->detalleReserva?->fecha_viaje)) }}  
**Check-out:** {{ date("d-m-Y", strtotime($detalle->detalleReserva?->fecha_viajefin)) }}  
**Total:** {{ $detalle->detalleReserva?->equipaje }} noches    
Nº Pasajeros: {{ count($detalle->operarPasajeros) }}  
@foreach($detalle->operarPasajeros as $i => $pasajero)
**Pasajero {{ $i + 1 }}:** {{ $pasajero->pasajero->nombreCompleto }} ({{ \Carbon\Carbon::parse($pasajero->pasajero->nacimiento)->diffInYears(\Carbon\Carbon::now()) }})  
@endforeach


@endforeach

Monto Total Pagado: {{$monedaId == 2 ? '$ '.$monto : 'S/ '.$monto}}  
Fecha de Pago: {{date("d-m-Y",strtotime($fecha))}}  

Agradecemos confirmar la recepción del pago y las reservas. Quedamos atentos a su respuesta.

Atentamente,  
**{{ $user->nombre }}**  
Agencia de Viajes Jisa Adventure  
Teléfono: [+51 926 561 020](https://wa.me/51926561020)  
Correo electrónico: operaciones@cuscoinsight.com  

@endcomponent
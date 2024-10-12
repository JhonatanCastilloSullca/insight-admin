@component('mail::message')
# Estimado/a {{$pasajero->nombreCompleto}}
¡Gracias por elegir Cuzco Travel para su próxima aventura en Perú! Nos complace confirmar que hemos recibido su reserva. A continuación, encontrará los detalles de su compra:

# Detalles de la Reserva

<strong style="font-size: 14px;">Encagardo de Reserva:</strong> <span style="font-size: 14px;">{{$reserva->pasajeroprincipal()->nombreCompleto}}</span>  
<strong style="font-size: 14px;">Número de Reserva:</strong> <span style="font-size: 14px;">{{$reserva->numero}}-{{date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje))}}</span>  
<strong style="font-size: 14px;">Fecha de Viaje:</strong> <span style="font-size: 14px;">{{date("d/m/Y",strtotime($reserva->primerafecha()->fecha_viaje))}} - {{date("d/m/Y",strtotime($reserva->ultimafecha()->fecha_viaje))}}</span>  
<strong style="font-size: 14px;">Número de Participantes:</strong> <span style="font-size: 14px;">{{$reserva->sumarPaxPrimerFecha()}}</span>  
<strong style="font-size: 14px;">Monto Total del Paquete:</strong> 
<span style="font-size: 14px;">
@foreach($reserva->totales as $total)
    {{$total->moneda_id == 1 ? 'PEN':'USD'}} {{$total->total}}  
@endforeach
</span>
<strong>Adelanto de Reserva:</strong> 
<span style="font-size: 14px;">
@foreach($reserva->totales as $total)
    {{$total->moneda_id == 1 ? 'PEN':'USD'}} {{$total->acuenta}}  
@endforeach
</span>
<strong>Pago Restante {{count($reserva->cuotas)>0 ? '':'(Oficina en efectivo)'}}:</strong> 
<span style="font-size: 14px;">
@if(count($reserva->cuotas) > 0)
    {{$total->moneda_id == 1 ? 'PEN':'USD'}} {{$total->saldo}}  
    
    @foreach($reserva->cuotas as $cuota)
        {{$cuota->moneda_id == 1 ? 'PEN':'USD'}} {{$cuota->monto}}  - {{$cuota->fecha}}  
    @endforeach
@else
    @foreach($reserva->totales as $total)
        {{$total->moneda_id == 1 ? 'PEN':'USD'}} {{$total->saldo}}  
    @endforeach
@endif
    
</span>


# Política de Pago:
- La primera comisión por el uso de pasarelas de pago la asumimos nosotros.
- El segundo pago, si se realiza en oficina, debe ser en efectivo.
- En caso de usar link de pago o POS, se incrementará un 6% por comisión de pasarela de pago.

# Política de Cancelación:
Si necesita realizar algún cambio o cancelar su reserva, por favor consulte nuestra política de cancelación en [terminos y condiciones](https://cuscoinsight.com/terminos-y-condiciones/) o contáctenos directamente.

# Recomendaciones:
# Puntos de Recojo en Cusco:
- Aseguramos el recojo dentro del casco histórico para los tours de Machupicchu. Para la mayoría de nuestros tours tradicionales y caminatas, garantizamos el recojo dentro del casco histórico, siempre que el acceso sea fácil y la ubicación cuente con pista automovilística. El área de programaciones le informará la noche anterior al tour sobre la hora de recojo y si su alojamiento cumple con las condiciones establecidas, o en su defecto, se le indicará un punto de encuentro.
- Para el City Tour, el punto de encuentro es en la Plaza de Armas de Cusco, previa coordinación del encargado de programaciones.

# Puntos de Recojo en Lima:
- Todos los tours empiezan en los distritos de Miraflores y San Isidro. Si desea ser recogido de un distrito no especificado aquí, deberá pagar un adicional que le indicará nuestro área de programaciones.

El guiado es en español. Si lo requiere en inglés, deberá especificarlo al momento de su reserva.
<br>El guiado en Machu Picchu solo se brinda en español. En caso de desear el guiado en inglés, deberá ser en servicio privado, el cual posee un precio adicional a consultar con su asesora.

# Contacto

Si tiene alguna pregunta o necesita asistencia adicional, no dude en contactarnos. Para nuestros clientes que ya han comprado su paquete o tour, tenemos un contacto exclusivo para ustedes: [+51 926 561 020](https://wa.me/51926561020?text=Hola%20soy%20%2A{{urlencode($pasajero->nombreCompleto)}}%2A,%20tengo%20una%20reserva%20con%20ustedes,%20fecha%20de%20viaje:%20{{date("d/m/Y",strtotime($reserva->primerafecha()->fecha_viaje))}}%20-%20{{date("d/m/Y",strtotime($reserva->ultimafecha()->fecha_viaje))}}). Este número pertenece a nuestra área de programaciones, encargada de brindarle un overview del tour que posee el día siguiente y de hacer el seguimiento durante su estancia en Perú. Estamos aquí para asegurarnos de que su experiencia sea inolvidable y sin contratiempos.

Nuevamente, le agradecemos por confiar en Cuzco Travel. Estamos emocionados de ser parte de su experiencia en Cusco y esperamos brindarle un servicio excepcional.


Atentamente,

Counter: {{$reserva->user->nombre}}

# Equipo de Cuzco Travel  
Calle Garcilaso 265 of 12, Cusco, Perú  
ventas@cuscoinsight.com  
+51926561020  
[www.cuscoinsight.com](http://www.cuscoinsight.com)

@endcomponent
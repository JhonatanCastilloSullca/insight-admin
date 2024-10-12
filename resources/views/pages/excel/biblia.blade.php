<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biblia</title>
    <style>
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <tbody>
                            <tr>
                                <th>Operado</th>
                                <th>Fecha</th>
                                <th>Acuenta</th>
                                <th>Saldo</th>
                                <th>Total</th>
                                <th>Pagado</th>
                                <th class="no-wrap">Celular</th>
                                <th class="no-wrap">Nombre Pasajero</th>
                                <th>Edad</th>
                                <th>Pais</th>
                                <th>Pax</th>
                                <th>Hotel / Recojo</th>
                                <th class="no-wrap">Servicio</th>
                                <th class="no-wrap">Recojo</th>
                                <th>Counter</th>
                                <th>Operadores</th>
                                <th>Comentarios</th>
                                <th>Overview</th>
                            </tr>
                            @foreach($detalles as $i => $detallereserva)
                                <tr style="background: {{$detallereserva->servicio->color}} ">
                                    <td>
                                        @if($detallereserva->operado == 0)
                                            No
                                        @else
                                            Si
                                        @endif
                                    </td>
                                    <td class="no-wrap">
                                        {{date("d-m-Y",strtotime($detallereserva->fecha_viaje))}}
                                    </td>
                                    <td class="no-wrap">
                                        @foreach($detallereserva->reserva->totales as $total)
                                            {{$total->moneda->abreviatura}} {{$total->acuenta}} 
                                            @if(!$loop->last)
                                            <br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="no-wrap">
                                        @foreach($detallereserva->reserva->totales as $total)
                                            {{$total->moneda->abreviatura}} {{$total->saldo}}
                                        @endforeach
                                    </td>
                                    <td class="no-wrap">
                                        @foreach($detallereserva->reserva->totales as $total)
                                            {{$total->moneda->abreviatura}} {{$total->total}} 
                                            @if(!$loop->last)
                                            <br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <h6>{{$detallereserva->reserva->pagado == 0 ? 'COBRAR':'PAGADO'}}</h6>
                                    </td>
                                    <td class="no-wrap">
                                        '{{$detallereserva->reserva->pasajeroprincipal()?->celular}}'
                                    </td>                                    
                                    <td class="no-wrap">
                                        {{$detallereserva->reserva->pasajeroprincipal()?->nombreCompleto}} {{ $detallereserva->reserva->pasajeroscumpleaños($detallereserva->fecha_viaje) ? '(Si)' : '(No)'}}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($detallereserva->reserva->pasajeroprincipal()?->nacimiento)->diffInYears(\Carbon\Carbon::now()) }} 
                                    </td>
                                    <td class="no-wrap">
                                        {{$detallereserva->reserva->pasajeroprincipal()?->pais->nombre}}
                                    </td>
                                    <td>
                                        {{$detallereserva->pax}}
                                    </td>
                                    <td>
                                        {{isset($detallereserva->hotel->nombre) ? $detallereserva->hotel->nombre : '+'}} {{$detallereserva->hotelJisa == 1 ? '(Si)':'(No)' }}
                                    </td>
                                    <td class="no-wrap">
                                        {{$detallereserva->servicio?->titulo}}
                                    </td>
                                    <td class="no-wrap">
                                        @if($detallereserva->detallesoperar)
                                            @if($detallereserva->servicio->categoria_id == 5)
                                                {{$detallereserva->detallesoperar->recojo ? date("h:i a",strtotime($detallereserva->detallesoperar->recojo)) : null}}
                                            @endif
                                        @endif
                                        @if($detallereserva->operarServicio)
                                            @if($detallereserva->servicio->categoria_id == 6)
                                                {{$detallereserva->operarServicio->recojo ? date("h:i a",strtotime($detallereserva->operarServicio->recojo)) : null}}
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        {{$detallereserva->reserva?->user->usuario}}
                                    </td>
                                    <td>
                                        @if($detallereserva->detallesoperar)
                                            @foreach($detallereserva->detallesoperar?->operar?->operarServicios as $operar)
                                                {{$operar?->proveedor?->nombre}}, 
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        {{$detallereserva->comentarios}}
                                    </td>
                                    <td>
                                        {{$detallereserva->overview == 1 ? 'Si':'No' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

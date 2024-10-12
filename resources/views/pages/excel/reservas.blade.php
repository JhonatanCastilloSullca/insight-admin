<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Reservas </title>
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
                                <td rowspan="2">
        
                                </td>
                                <td colspan="8">
                                    <h3 class="text-uppercase m0">
                                        A.V.T. JISA ADVENTURE E.I.R.L.
                                    </h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8">
                                    20600769317
                                </td>
                            </tr>
                            <tr >
                                <th colspan="9">REPORTE DE RESERVAS</th>
                            </tr>
                            <tr>
                            <tr>
                                <td class="w-25"><b>Desde:</b> </td>
                                <td class="w-25">{{date("d-m-Y ",strtotime($fechaInicio2))}} </td>
                                <td class="w-25"><b>Hasta:</b> </td>
                                <td class="w-25">{{date("d-m-Y ",strtotime($fechaFin2))}} </td>
                                <td class="w-25"><b>Counter:</b> </td>
                                <td class="w-25">{{$counter?->nombre}} </td>
                            </tr>
                            <tr>
                                <td class="w-25"><b>Pasajero:</b> </td>
                                <td class="w-25">{{$pasajero}} </td>
                                <td class="w-25"><b>Estado:</b> </td>
                                <td class="w-25">
                                    @if($estado == 1)
                                        Registrado
                                    @elseif($estado == 2)
                                        Cancelado
                                    @elseif($estado == 3)
                                        Reprogramado
                                    @elseif($estado == 4)
                                        Con Devolucion
                                    @elseif($estado == 5)
                                        Finalizado
                                    @endif
                                </td>
                                <td class="w-25"><b></b> </td>
                                <td class="w-25"> </td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td>Reserva</td>
                                <td>Pasajero</td>
                                <td>Fecha Contrato</td>
                                <td>Fecha Viaje</td>
                                <td>Counter</td>
                                <th>Acuenta S/</th>
                                <th>Saldo S/</th>
                                <th>Total S/</th>
                                <th>Acuenta $</th>
                                <th>Saldo $</th>
                                <th>Total $</th>
                                <td>Total Tours</td>
                                <td>Total Detalles</td>
                                <td>Alojamiento</td>
                                <td>Machupicchu</td>
                                <td>Pagos</td>
                                <td>Detalles</td>
                            </tr>
                            @php $acuentaSoles = 0 @endphp
                            @php $saldoSoles = 0 @endphp
                            @php $totalSoles = 0 @endphp
                            @php $acuentaDolares = 0 @endphp
                            @php $saldoDolares = 0 @endphp
                            @php $totalDolares = 0 @endphp
                            @php $totalTours = 0 @endphp
                            @php $totalDetalles = 0 @endphp
                            @foreach ($reservas as $reserva)
                                @php $totalTours +=  count($reserva->detallestoursTitulo()) @endphp
                                @php $totalDetalles += count($reserva->detalles) @endphp
                                <tr>
                                    <td>{{ $reserva->numero }}-{{date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje))}}</td>
                                    <td>{{ $reserva->pasajeroprincipal()?->nombreCompleto }}</td>
                                    <td>{{ date('d-m-Y H:i', strtotime($reserva->fecha)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($reserva->primerafecha()->fecha_viaje)) }}</td>
                                    <td>{{ $reserva->user->nombre }}</td>
                                    @if(count($reserva->totales->where('moneda_id',1)) > 0)
                                        @foreach($reserva->totales->where('moneda_id',1) as $total)
                                            @php $acuentaSoles += $total->acuenta @endphp
                                            @php $saldoSoles += $total->saldo @endphp
                                            @php $totalSoles += $total->total @endphp
                                            <td>
                                                {{ $total->acuenta }}
                                            </td>
                                            <td>
                                                {{ $total->saldo }}
                                            </td>
                                            <td>
                                                {{ $total->total }}
                                            </td>
                                        @endforeach
                                    @else
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @endif
                                    @if(count($reserva->totales->where('moneda_id',2)) > 0)
                                        @foreach($reserva->totales->where('moneda_id',2) as $total)
                                            @php $acuentaDolares += $total->acuenta @endphp
                                            @php $saldoDolares += $total->saldo @endphp
                                            @php $totalDolares += $total->total @endphp
                                            <td>
                                                {{ $total->acuenta }}
                                            </td>
                                            <td>
                                                {{ $total->saldo }}
                                            </td>
                                            <td>
                                                {{ $total->total }}
                                            </td>
                                        @endforeach
                                    @else
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    @endif
                                    <td>
                                        {{count($reserva->detallestoursTitulo())}}
                                    </td>
                                    <td>
                                        {{count($reserva->detalles)}}
                                    </td>
                                    <td>
                                        {{count($reserva->detalleshoteles) > 0 ? 'Si':'No'}}
                                    </td>
                                    <td>
                                        {{$reserva->tieneServicioMachuPicchu() ? 'Si':'No'}}
                                    </td>
                                    <td>
                                        @foreach($reserva->pagos as $pago)
                                            {{date("d-m-Y",strtotime($pago->fecha))}} / {{$pago->moneda->abreviatura}} {{$pago->monto}} {{$pago->contabilidad == 1 ? 'Si':'No'}}
                                            @if(!$loop->last)
                                                <br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($reserva->detalles as $detalle)
                                            {{$detalle->servicio->titulo}}, 
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6">Totales</td>
                                <th>{{$acuentaSoles}}</th>
                                <th>{{$saldoSoles}}</th>
                                <th>{{$totalSoles}}</th>
                                <th>{{$acuentaDolares}}</th>
                                <th>{{$saldoDolares}}</th>
                                <th>{{$totalDolares}}</th>
                                <td>{{$totalTours}}</td>
                                <td>{{$totalDetalles}}</td>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <th colspan="6"></th>
                                <th>Acuenta S/</th>
                                <th>Saldo S/</th>
                                <th>Total S/</th>
                                <th>Acuenta $</th>
                                <th>Saldo $</th>
                                <th>Total $</th>
                                <td>Total Tour</td>
                                <td>Total Detalles</td>
                                <td colspan="4"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

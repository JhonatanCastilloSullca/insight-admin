<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Reservas</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.6rem;
            font-weight: normal;
            line-height: .05;
            color: #151b1e;
            writing-mode: tb-rl;
            size:landscape;
            width:100%;
            height:100%;
            TEXT-TRANSFORM:UPPERCASE;

        }

        .table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 0.3rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #c2cfd6;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table th, .table td {
            padding: 0.05rem;
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 1px solid #c2cfd6;
        }
        .table-bordered thead th, .table-bordered thead td {
            border-bottom-width: 1px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #c2cfd6;
        }
        th, td {
            display: table-cell;
            vertical-align: inherit;
            line-height: 1.6;
        }
        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: left;
            line-height: 1.6;
        }
        tbody {
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
            line-height: 1.6;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .izquierda{
            float:left;
        }
        .derecha{
            float:right;
        }
        .resumen{
            page-break-inside: avoid;
        }
        .w-85
        {
            width: 85%;
        }
        .w-15
        {
            width: 85%;
        }
        .w-100{
            width: 100%;
        }

        .w-50{
            width: 100%;
        }
        .w-25{
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
    <div class="card">
        <div class="row">
            <h3 style="text-align:center; font-size: 1rem"> Reporte de Reservas</h3>
            <table class="w-100">
                <tr>
                    <td class="w-85">
                        <table class="w-100">
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
                        </table>
                    </td>
                    <td class="w-15">
                        <img class="derecha" style="padding-top:0; margin-top:0; margin-right:1rem;" src="{{ asset('img/brand/logo.png')}}"  width="405px"  alt="admin@bootstrapmaster.com">
                    </td>
                </tr>
            </table>
            <div class="card-body">
                    <div style="overflow-x:auto;">
                            <div class="table-responsive" >
                                <table id="egresos" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr style="background-color: #858C43; color:#ffffff; font-size:0.6rem">
                                            <th>#</th>
                                            <th>Reserva</th>
                                            <th>Pasajero</th>
                                            <th>Fecha Contrato</th>
                                            <th>Fecha Viaje</th>
                                            <th>Counter</th>
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
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                                <td>{{ ++$i }}</td>
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
                                                        {{date("d-m-Y",strtotime($pago->fecha))}} / {{$pago->moneda->abreviatura}} {{$pago->monto}} {{$pago->contabilidad == 1 ? 'Si':'No'}}<br>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                            <tr>
                                                <th colspan="6">Totales</th>
                                                <th>{{$acuentaSoles}}</th>
                                                <th>{{$saldoSoles}}</th>
                                                <th>{{$totalSoles}}</th>
                                                <th>{{$acuentaDolares}}</th>
                                                <th>{{$saldoDolares}}</th>
                                                <th>{{$totalDolares}}</th>
                                                <td>{{$totalTours}}</td>
                                                <td>{{$totalDetalles}}</td>
                                                <td colspan="3"></td>
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
                                                <td colspan="3"></td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>

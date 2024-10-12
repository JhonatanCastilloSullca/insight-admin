<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Files</title>
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
            <h3 style="text-align:center; font-size: 1rem"> Reporte de Files</h3>
            <table class="w-100">
                <tr>
                    <td class="w-85">
                        <table class="w-100">
                            <tr>
                                <td class="w-25"><b>Desde:</b> </td>
                                <td class="w-25">{{date("d-m-Y ",strtotime($fechaInicio2))}} </td>
                                <td class="w-25"><b></b> </td>
                                <td class="w-25"> </td>
                                <td class="w-25"></td>
                                <td class="w-25"></td>
                            </tr>
                            <tr>
                                <td class="w-25"><b>Hasta:</b></td>
                                <td class="w-25"><b>{{date("d-m-Y ",strtotime($fechaFin2))}}</b></td>
                                <td class="w-25"><b></b></td>
                                <td class="w-25"><b></b></td>
                                <td class="w-25"><b></b></td>
                                <td class="w-25"><b></b></td>
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
                                            <th>File</th>
                                            <th>Fecha Venta</th>
                                            <th>Pasajero</th>
                                            <th>Pax</th>
                                            <th>Servicio</th>
                                            <th>Fecha Viaje</th>
                                            <th>Incluye</th>
                                            <th>Moneda</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($files as $file)
                                            @foreach($file->detallestraslados as $detalle)
                                                <tr>
                                                    <td>
                                                        {{ $file->numero }}-{{ $file->primerafecha()?->fecha_viaje ? date("d-m-Y",strtotime($file->primerafecha()?->fecha_viaje)) : ''}}
                                                    </td>
                                                    <td>
                                                        {{ $file->fecha ? date("d-m-Y",strtotime($file->fecha)) : null }}
                                                    </td>
                                                    <td>
                                                        {{ $file->pasajeroprincipal()?->nombreCompleto }}
                                                    </td>
                                                    <td>
                                                        {{ $detalle->pax }}
                                                    </td>
                                                    <td>
                                                        {{ $detalle->servicio->titulo }}
                                                    </td>
                                                    <td>
                                                        {{ $detalle->fecha_viaje ? date("d-m-Y",strtotime($detalle->fecha_viaje)) : null }}
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                        {{ $detalle->moneda_id == 1 ? 'PEN' : 'USD' }}
                                                    </td>
                                                    <td>
                                                        {{ $detalle->precio * $detalle->pax }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @foreach($file->detallestoursreporte as $detalle)
                                                @foreach($detalle->incluyes as $incluye)
                                                    <tr>
                                                        <td>
                                                            {{ $file->numero }}-{{ $file->primerafecha()?->fecha_viaje ? date("d-m-Y",strtotime($file->primerafecha()?->fecha_viaje)) : ''}}
                                                        </td>
                                                        <td>
                                                            {{ $file->fecha ? date("d-m-Y",strtotime($file->fecha)) : null }}
                                                        </td>
                                                        <td>
                                                            {{ $file->pasajeroprincipal()?->nombreCompleto }}
                                                        </td>
                                                        <td>
                                                            {{ $detalle->pax }}
                                                        </td>
                                                        <td>
                                                            {{ $detalle->servicio->titulo }}
                                                        </td>
                                                        <td>
                                                            {{ $detalle->fecha_viaje ? date("d-m-Y",strtotime($detalle->fecha_viaje)) : null }}
                                                        </td>
                                                        <td>
                                                            {{ $incluye->titulo }}
                                                        </td>
                                                        @if($loop->first)
                                                            <td>
                                                                {{ $detalle->moneda_id == 1 ? 'PEN' : 'USD' }}
                                                            </td>
                                                            <td>
                                                                {{ $detalle->precio * $detalle->pax }}
                                                            </td>
                                                        @else
                                                            <td></td>
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                            @foreach($file->detalleshoteles as $detalle)
                                                <tr>
                                                    <td>
                                                        {{ $file->numero }}-{{ $file->primerafecha()?->fecha_viaje ? date("d-m-Y",strtotime($file->primerafecha()?->fecha_viaje)) : ''}}
                                                    </td>
                                                    <td>
                                                        {{ $file->fecha ? date("d-m-Y",strtotime($file->fecha)) : null }}
                                                    </td>
                                                    <td>
                                                        {{ $file->pasajeroprincipal()?->nombreCompleto }}
                                                    </td>
                                                    <td>
                                                        {{ $detalle->pax }}
                                                    </td>
                                                    <td>
                                                        {{ $detalle->servicio->titulo }}
                                                    </td>
                                                    <td>
                                                        {{ $detalle->fecha_viaje ? date("d-m-Y",strtotime($detalle->fecha_viaje)) : null }}
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                        {{ $detalle->moneda_id == 1 ? 'PEN' : 'USD' }}
                                                    </td>
                                                    <td>
                                                        {{ $detalle->precio * $detalle->pax * $detalle->equipaje + $detalle->adicional}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @foreach($file->detallesvuelos as $detalle)
                                                <tr>
                                                    <td>
                                                        {{ $file->numero }}-{{ $file->primerafecha()?->fecha_viaje ? date("d-m-Y",strtotime($file->primerafecha()?->fecha_viaje)) : ''}}
                                                    </td>
                                                    <td>
                                                        {{ $file->fecha ? date("d-m-Y",strtotime($file->fecha)) : null }}
                                                    </td>
                                                    <td>
                                                        {{ $file->pasajeroprincipal()?->nombreCompleto }}
                                                    </td>
                                                    <td>
                                                        {{ $detalle->pax }}
                                                    </td>
                                                    <td>
                                                        {{ $detalle->servicio->titulo }}
                                                    </td>
                                                    <td>
                                                        {{ $detalle->fecha_viaje ? date("d-m-Y",strtotime($detalle->fecha_viaje)) : null }}
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                        {{ $detalle->moneda_id == 1 ? 'PEN' : 'USD' }}
                                                    </td>
                                                    <td>
                                                        {{ $detalle->precio * $detalle->pax + $detalle->adicional }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
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

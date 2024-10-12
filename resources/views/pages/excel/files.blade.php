<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Files </title>
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
                                        A.V.T. CUZCO TRAVEL E.I.R.L.
                                    </h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8">
                                    20600769317
                                </td>
                            </tr>
                            <tr >
                                <th colspan="9">REPORTE DE SERVICIOS</th>
                            </tr>
                            <tr>
                            <tr>
                                <td class="w-25"><b>Desde:</b> </td>
                                <td class="w-25">{{date("d-m-Y ",strtotime($fechaInicio2))}} </td>
                                <td class="w-25"><b>Hasta:</b> </td>
                                <td class="w-25">{{date("d-m-Y ",strtotime($fechaFin2))}} </td>
                                <td class="w-25"> </td>
                                <td class="w-25"></td>
                            </tr>
                            <tr></tr>
                            <tr>
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
                                            {{ $detalle->servicio->titulo }} {{ $detalle->servicio?->proveedor?->nombre }}
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
                                            {{ $detalle->servicio->titulo }} {{ $detalle->servicio?->proveedor?->nombre }}
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
</body>

</html>

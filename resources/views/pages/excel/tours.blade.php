<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Servicios </title>
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
                                <td colspan="7">
                                    <h3 class="text-uppercase m0">
                                        A.V.T. CUZCO TRAVEL E.I.R.L.
                                    </h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    20600769317
                                </td>
                            </tr>
                            <tr >
                                <th colspan="8">REPORTE DE SERVICIOS</th>
                            </tr>
                            <tr>
                            <tr>
                                <td class="w-25"><b>Desde:</b> </td>
                                <td class="w-25">{{date("d-m-Y ",strtotime($fechaInicio2))}} </td>
                                <td class="w-25"><b>Hasta:</b> </td>
                                <td class="w-25">{{date("d-m-Y ",strtotime($fechaFin2))}} </td>
                                <td class="w-25"><b>Servicio:</b> </td>
                                <td class="w-25">{{$tour?->titulo}} </td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td>Reserva</td>
                                <td>Fecha Contrato</td>
                                <td>Servicio</td>
                                <td>Pax</td>
                                <td>Fecha Viaje</td>
                                <td>Precio Unit.</td>
                                <td>Counter</td>
                                <td>Estado Reserva</td>
                            </tr>
                            @foreach ($reservas as $reserva)
                                <tr>
                                    <td>{{ $reserva->reserva->numero }}-{{\Carbon\Carbon::parse($reserva->reserva->primerafecha()->fecha_viaje)->locale('es')->translatedFormat('F-Y')}}</td>
                                    <td>{{ date('d-m-Y H:i', strtotime($reserva->reserva->fecha)) }}</td>
                                    <td>{{ $reserva->servicio->titulo }}</td>
                                    <td>{{ $reserva->pax }}</td>
                                    <td>{{ date('d-m-Y', strtotime($reserva->fecha_viaje)) }}</td>
                                    <td>
                                        {{ $reserva->moneda->abreviatura }} {{ $reserva->precio }}
                                    </td>
                                    <td>
                                        {{ $reserva->reserva->user->nombre }}
                                    </td>
                                    <td>
                                        @if($reserva->reserva->estado==1)
                                            <span class="badge bg-primary me-1 my-2">Registrado</span>
                                        @elseif($reserva->reserva->estado==2)
                                            <span class="badge bg-danger me-1 my-2">Cancelado</span>
                                        @elseif($reserva->reserva->estado==3)
                                            <span class="badge bg-info me-1 my-2">Repogramado</span>
                                        @elseif($reserva->reserva->estado==4)
                                            <span class="badge bg-warning me-1 my-2">Con Devolución</span>
                                        @else
                                            <span class="badge bg-dark me-1 my-2">Finalizado</span>
                                        @endif
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

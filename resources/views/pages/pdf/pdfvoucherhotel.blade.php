<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voucher de Reserva {{$reserva->numero}}-{{date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje))}}</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.6rem;
            font-weight: normal;
            color: #151b1e;
            size:landscape;
            width:100%;
            height:100%;
        }
        .pasajeros-table {
        width: 100%;
        border-collapse: collapse;
        }
        .pasajeros-table th, .pasajeros-table td {
        padding: 12px;
        border-bottom: 1px solid #179a9d;
        }
        .pasajeros-table th {
        background-color: #179a9d;
        color: #FFFFFF;
        border:1px solid;
        }
        .tdcenter{
            text-align:center;
        }
        .tdleft{
            text-align:left;
        }
        .pasajeros-table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
        }
        .pasajeros-table tbody tr:hover {
        background-color: #ddd;
        }
        .container-fluid{
            margin-top: 120px;
        }
        .title-table{
            margin: 0;
            padding: 0;
            margin-top: 20px;
        }
    </style>
</head>
<body>
@php
    $totalPrecio = 0;
    $totalPago = 0;
@endphp

<div class="container-fluid" >
    <div class="card">
        <div class="row" >
            {{ $reserva }}
            <h3 style="text-align:center; font-size:15px"> Voucher de Reserva Nº {{$reserva->numero}}-{{date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje))}}</h3>
            <h4 class="title-table">PASAJEROS</h4>
            <table class="pasajeros-table">
                <thead>
                    <tr>
                    <th class="thnro" >N°</th>
                    <th class="tdcenter">Nombres</th>
                    <th class="tdcenter">Nacionalidad</th>
                    <th class="tdcenter">Documentos</th>
                    <th class="tdcenter">Edad</th>
                    <th class="tdcenter">Género</th>
                    <th class="tdcenter">Teléfono</th>
                    <th class="tdcenter">Correo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reserva->pasajeros as $i => $pasajero)
                    <tr>
                        <td class="thnro">{{ ++$i }}</td>
                        <td>{{ $pasajero->nombres }}</td>
                        <td>{{ $pasajero->pais->nombre }}</td>
                        <td>{{ $pasajero->documento?->num_documento }}</td>
                        <td>{{ \Carbon\Carbon::parse($pasajero->nacimiento)->diffInYears(\Carbon\Carbon::now()) }} años</td>
                        <td>{{ $pasajero->genero }}</td>
                        <td>{{ $pasajero->celular }}</td>
                        <td>{{ $pasajero->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row" >
            <h4 class="title-table">SERVICIOS REGISTRADOS</h4>
            <table class="pasajeros-table">
                <thead>
                    <tr>
                    <th class="thnro" >N°</th>
                    <th class="tdcenter">Pax</th>
                    <th class="tdcenter">Servicio</th>
                    <th class="tdcenter">Fecha Inicio</th>
                    <th class="tdcenter">Incluye</th>
                    <th class="tdcenter">No Incluye</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reserva->detallestours as $i => $detalle)
                    <tr>
                        <td class="thnro">{{ ++$i }}</td>
                        <td>{{ $detalle->pax }}</td>
                        <td>{{ $detalle->servicio->titulo }}</td>
                        <td>
                            {{date("d-m-Y",strtotime($detalle->fecha_viaje))}} /
                            {{date("d-m-Y",strtotime($detalle->fecha_viajefin))}}

                        </td>
                        <td>
                            @foreach ($detalle->incluyes as $incluye)
                                - {{ $incluye->titulo }}<br>
                            @endforeach
                        </td>
                        <td class="tdcenter">
                            @foreach ($detalle->noincluyes as $noincluye)
                                - {{ $noincluye->titulo }}<br>
                            @endforeach
                        </td>

                        @php
                            $totalPrecio += $detalle->precio;
                        @endphp
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row" >
            <h4 class="title-table">HOTELES REGISTRADOS</h4>
            <table class="pasajeros-table">
                <thead>
                    <tr>
                    <th class="thnro" >N°</th>
                    <th class="tdcenter">Pax</th>
                    <th class="tdcenter">Servicio</th>
                    <th class="tdcenter">Fecha Inicio</th>
                    <th class="tdcenter">Incluye</th>
                    <th class="tdcenter">No Incluye</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reserva->detalleshoteles as $i => $detalle)
                    <tr>
                        <td class="thnro">{{ ++$i }}</td>
                        <td>{{ $detalle->pax }}</td>
                        <td>{{ $detalle->servicio->titulo }}</td>
                        <td>{{ $detalle->fecha_viaje }}</td>
                        <td>
                            @foreach ($detalle->incluyes as $incluye)
                                - {{ $incluye->titulo }}<br>
                            @endforeach
                        </td>
                        <td class="tdcenter">
                            @foreach ($detalle->noincluyes as $noincluye)
                                - {{ $noincluye->titulo }}<br>
                            @endforeach
                        </td>

                        @php
                            $totalPrecio += $detalle->precio;
                        @endphp
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row" >
            <h4 class="title-table">VUELOS REGISTRADOS</h4>
            <table class="pasajeros-table">
                <thead>
                    <tr>
                        <th class="thnro" >N°</th>
                        <th class="tdcenter">Pax</th>
                        <th class="tdcenter">Servicio</th>
                        <th class="tdcenter">Fecha Inicio</th>
                        <th class="tdcenter">Incluye</th>
                        <th class="tdcenter">No Incluye</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reserva->detallesvuelos as $i => $detalle)
                    <tr>
                        <td class="thnro">{{ ++$i }}</td>
                        <td>{{ $detalle->pax }}</td>
                        <td>{{ $detalle->servicio->titulo }}</td>
                        <td>{{ $detalle->fecha_viaje }}</td>
                        <td>
                            @foreach ($detalle->incluyes as $incluye)
                                - {{ $incluye->titulo }}<br>
                            @endforeach
                        </td>
                        <td class="tdcenter">
                            @foreach ($detalle->noincluyes as $noincluye)
                                - {{ $noincluye->titulo }}<br>
                            @endforeach
                        </td>

                        @php
                            $totalPrecio += $detalle->precio;
                        @endphp
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row" >
            <h4 class="title-table">PAGOS REGISTRADOS</h4>
            <table class="pasajeros-table">
                <thead>
                    <tr>
                    <th class="thnro" >N°</th>
                    <th>Medio de pago</th>
                    <th>Fecha de pago</th>
                    <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reserva->pagos as $i => $pago)
                        <tr>
                            <td class="thnro">{{ ++$i }}</td>
                            <td>{{ $pago->medio->nombre}} {{ $pago->medio->banco }} {{ $pago->medio->moneda->nombre }}</td>
                            <td>{{ $pago->fecha }}</td>
                            <td>{{ $pago->monto }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row" >
            <h4 class="title-table">RESUMEN</h4>
            <table class="pasajeros-table">
                <thead>
                    <tr>
                        <th>PRECIO TOTAL DEL PAQUETE </th>
                        <th>MONTO TOTAL PAGADO </th>
                        <th>SALDO PENDIENTE</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td class="tdcenter">{{$totalPrecio}}</td>
                            <td class="tdcenter">{{$totalPago}}</td>
                            <td class="tdcenter">{{$totalPrecio - $totalPago}}</td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

</html>

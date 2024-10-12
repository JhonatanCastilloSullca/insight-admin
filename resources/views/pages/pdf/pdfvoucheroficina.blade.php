<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voucher de Reserva Nº {{ $reserva->numero }}-{{date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje))}}</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0px;
            right: 0px;
            height: 3cm;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 6cm;
        }

        body {
            margin: 2px;
            margin-top: 390px;
            margin-bottom: 250px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.55rem;
            font-weight: normal;
            color: #151b1e;
            size: landscape;
            width: 100%;
            height: 100%;
        }

        .pasajeros-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pasajeros-table th,
        .pasajeros-table td {
            padding: 3px 10px;
            border-bottom: 1px solid #179a9d;
        }

        tr {
            margin: 0;
            padding: 2px;
        }

        td>* {
            padding: 2px;
            margin: 0;
        }

        .pasajeros-table th {
            background-color: #179a9d;
            color: #FFFFFF;
            border: 1px solid;
        }

        .tdcenter {
            text-align: center;
        }

        .tdleft {
            text-align: left;
        }

        .pasajeros-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .pasajeros-table tbody tr:hover {
            background-color: #ddd;
        }


        .title-table {
            margin: 0;
            padding: 2px;
            margin-top: 20px;
        }

        .logoarriba {
            height: 50px;
        }


        .parrafo-termino {
            font-size: 35px;
            color: #464646;
            line-height: 38px;
        }

        .parrafo-titulo {
            font-size: 45px;
            color: #375a64;
            line-height: 50px;
            font-weight: bold;
        }

        .parrafo-subtitulo {
            font-size: 35px;
            color: #179a9d;
            line-height: 41px;
            font-weight: bold;
        }


        main {
            z-index: 2;
            margin-left: 5%;
            margin-right: 5%;
        }

        .text-dia{
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #C1D96C;
            font-size: 255px;
            margin: 0;
        }
    </style>
</head>

<body>
    <header>
        <div class="header" style="position: relative; width: 100%;">
            <img src="{{ asset('img/brand/head.png') }}" alt="admin@bootstrapmaster.com" style="width: 100%;">
    
            <!-- Texto encima de la imagen -->
            <h2 class="text-dia">
                {{date("d",strtotime($reserva->primerafecha()?->fecha_viaje))}}
            </h2>
        </div>
    </header>
    <footer>
        <div class="footer">
            <div class="">
                <img src="{{ asset('img/brand/footer.png') }}" alt="admin@bootstrapmaster.com" style="width: 100%;">
            </div>
        </div>
    </footer>
    <main>
        <div class="container-fluid">
            <div class="card">
                <div class="row">
                    <h3
                        style="text-align:center; font-size:75px !important; color: #179a9d !important; line-height:80px; margin-bottom: 10px;">
                        Voucher de Reserva Nº {{ $reserva->numero }}-{{date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje))}}</h3>
                    <h4
                        style="margin-top: 25px !important ;font-size:35px !important; color: #000000 !important; line-height:40px;">
                        COUNTER ASESOR: {{ $reserva->user->nombre }}</h4>
                    <div class="row">
                        <table class="pasajeros-table" style="margin-bottom: 25px;font-size: 0.85rem;">
                            <tbody>
                                <tr>
                                    <td>Nº Voucher</td>
                                    <td>{{ $reserva->numero }}-{{date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje))}}</td>
                                    <td>F. Registro</td>
                                    <td>{{ date('d/m/Y H:i', strtotime($reserva->fecha)) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h4 class="title-table">RESUMEN</h4>
                        <table class="pasajeros-table" style="font-size: 0.85rem;">
                            <thead>
                                <tr>
                                    <th>PRECIO TOTAL DEL PAQUETE </th>
                                    <th>MONTO TOTAL PAGADO </th>
                                    <th>SALDO PENDIENTE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reserva->totales as $total)
                                    <tr>
                                        <td>{{ $total->moneda->abreviatura }} {{ $total->total }}</td>
                                        <td>{{ $total->moneda->abreviatura }} {{ $total->acuenta }}</td>
                                        <td>{{ $total->moneda->abreviatura }} {{ $total->saldo }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h4 class="title-table">PASAJEROS</h4>
                    <table class="pasajeros-table">
                        <thead>
                            <tr>
                                <th class="thnro">N°</th>
                                <th class="tdcenter">Nombres</th>
                                <th class="tdcenter">Nacionalidad</th>
                                <th class="tdcenter">Documentos</th>
                                <th class="tdcenter">Edad</th>
                                <th class="tdcenter">Género</th>
                                <th class="tdcenter">Teléfono</th>
                                <th class="tdcenter">Correo</th>
                                <th class="tdcenter">Comentarios</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reserva->pasajeros as $i => $pasajero)
                                <tr>
                                    <td class="thnro">{{ ++$i }}</td>
                                    <td>{{ $pasajero->nombreCompleto }}</td>
                                    <td>{{ $pasajero->pais->nombre }}</td>
                                    <td>{{ $pasajero->documento?->tipo_documento }}
                                        {{ $pasajero->documento?->num_documento }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pasajero->nacimiento)->diffInYears(\Carbon\Carbon::now()) }} / {{date("d-m-Y",strtotime($pasajero->nacimiento))}}
                                    </td>
                                    <td>{{ $pasajero->genero == 'MASCULINO' ? 'M' : 'F' }}</td>
                                    <td>{{ $pasajero->celular }}</td>
                                    <td>{{ $pasajero->email }}</td>
                                    <td>{{ $pasajero->comentario }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <h4 class="title-table">SERVICIOS REGISTRADOS</h4>
                    <table class="pasajeros-table">
                        <thead>
                            <tr>
                                <th class="thnro">N°</th>
                                <th class="tdcenter">Pax</th>
                                <th class="tdcenter">Servicio</th>
                                <th class="tdcenter">Fecha Inicio</th>
                                <th class="tdcenter">Incluye</th>
                                <th class="tdcenter">No Incluye</th>
                                <th class="tdcenter">Comentarios</th>
                                <th class="tdcenter">P. Unitario</th>
                                <th class="tdcenter">P. Venta</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reserva->detallestours as $i => $detalle)
                                <tr>
                                    <td class="thnro">{{ ++$i }}</td>
                                    <td>{{ $detalle->pax }}</td>
                                    <td>{{ $detalle->servicio->titulo }}</td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($detalle->fecha_viaje)) }}

                                    </td>
                                    <td>
                                        @foreach ($detalle->itinerarios as $itinerario)
                                            @foreach ($itinerario->incluyes as $incluye)
                                                - {{ $incluye->titulo }}<br>
                                            @endforeach
                                        @endforeach
                                    </td>
                                    <td class="tdcenter">
                                        @foreach ($detalle->itinerarios as $itinerario)
                                            @foreach ($itinerario->noincluyes as $noincluye)
                                                - {{ $noincluye->titulo }}<br>
                                            @endforeach
                                        @endforeach
                                    </td>
                                    <td>{!! $detalle->comentarios !!}</td>
                                    <td>{{ $detalle->moneda_id == 1 ? 'S/ ' : '$ '}} {{ number_format($detalle->precio,2) }}</td>
                                    <td>{{ $detalle->moneda_id == 1 ? 'S/ ' : '$ '}} {{ number_format($detalle->precio * $detalle->pax,2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if (count($reserva->detalleshoteles))
                    <div class="row">
                        <h4 class="title-table">HOTELES REGISTRADOS</h4>
                        <table class="pasajeros-table">
                            <thead>
                                <tr>
                                    <th class="thnro">N°</th>
                                    <th class="tdcenter">Cant.</th>
                                    <th class="tdcenter">Noches</th>
                                    <th class="tdcenter">Servicio</th>
                                    <th class="tdcenter">Check Inn</th>
                                    <th class="tdcenter">Check Out</th>
                                    <th class="tdcenter">Comentarios</th>
                                    <th class="tdcenter">P. Unitario</th>
                                    <th class="tdcenter">P. Venta</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reserva->detalleshoteles as $i => $detalle)
                                    <tr>
                                        <td class="thnro">{{ ++$i }}</td>
                                        <td>{{ $detalle->pax }}</td>
                                        <td>{{ $detalle->equipaje }}</td>
                                        <td>{{ $detalle->servicio->proveedor?->nombre }}
                                            {{ $detalle->servicio->proveedor?->ubicacion?->nombre }}
                                            {{ $detalle->servicio->titulo }}</td>
                                        <td>{{ date('d-m-Y H:i', strtotime($detalle->fecha_viaje)) }} </td>
                                        <td class="tdcenter">
                                            {{ date('d-m-Y H:i', strtotime($detalle->fecha_viajefin)) }}
                                        </td>
                                        <td>{!! $detalle->comentarios !!}</td>
                                        <td>{{ $detalle->moneda_id == 1 ? 'S/ ' : '$ '}} {{ number_format($detalle->precio,2)}}</td>
                                        <td>{{ $detalle->moneda_id == 1 ? 'S/ ' : '$ '}} {{ number_format($detalle->precio * $detalle->pax * $detalle->equipaje + $detalle->adicional,2)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                @if (count($reserva->detallesvuelos))
                    <div class="row">
                        <h4 class="title-table">VUELOS REGISTRADOS</h4>
                        <table class="pasajeros-table">
                            <thead>
                                <tr>
                                    <th class="thnro">N°</th>
                                    <th class="tdcenter">Pax</th>
                                    <th class="tdcenter">Servicio</th>
                                    <th class="tdcenter">Fecha Ida</th>
                                    <th class="tdcenter">Fecha Retorno</th>
                                    <th class="tdcenter">Incluye</th>
                                    <th class="tdcenter">No Incluye</th>
                                    <th class="tdcenter">Comentarios</th>
                                    <th class="tdcenter">P. Venta</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reserva->detallesvuelos as $i => $detalle)
                                    <tr>
                                        <td class="thnro">{{ ++$i }}</td>
                                        <td>{{ $detalle->pax }}</td>
                                        <td>{{ $detalle->servicio->titulo }}</td>
                                        <td>{{ date('d-m-Y H:i', strtotime($detalle->fecha_viaje)) }}</td>
                                        <td>{{ date('d-m-Y H:i', strtotime($detalle->fecha_viajefin)) }}</td>
                                        <td>
                                            @foreach ($detalle->itinerarios as $itinerario)
                                                @foreach ($itinerario->incluyes as $incluye)
                                                    - {{ $incluye->titulo }}<br>
                                                @endforeach
                                            @endforeach
                                        </td>
                                        <td class="tdcenter">
                                            @foreach ($detalle->itinerarios as $itinerario)
                                                @foreach ($itinerario->noincluyes as $noincluye)
                                                    - {{ $noincluye->titulo }}<br>
                                                @endforeach
                                            @endforeach
                                        </td>
                                        <td>{!! $detalle->comentarios !!}</td>
                                        <td>{{ $detalle->moneda_id == 1 ? 'S/ ' : '$ ' }} {{ number_format($detalle->precio, 2) }}
                                        <td>{{ $detalle->moneda_id == 1 ? 'S/ ' : '$ ' }} {{ number_format($detalle->precio * $detalle->pax + $detalle->adicional, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                <div class="row">
                    <h4 class="title-table">PAGOS REGISTRADOS</h4>
                    <table class="pasajeros-table" style="font-size: 0.85rem;">
                        <thead>
                            <tr>
                                <th class="thnro">N°</th>
                                <th>Medio de pago</th>
                                <th>Fecha de pago</th>
                                <th>Monto</th>
                                <th>Nº Operacion</th>
                                <th>Comentario</th>
                                <th>Counter</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reserva->pagos as $i => $pago)
                                <tr>
                                    <td class="thnro">{{ ++$i }}</td>
                                    <td>{{ $pago->medio->nombre }} {{ $pago->medio->banco }}
                                        {{ $pago->medio->moneda->nombre }}</td>
                                    <td>{{ $pago->fecha }}</td>
                                    <td>{{ $pago->moneda->abreviatura }} {{ $pago->monto }}</td>
                                    <td>{{ $pago->num_operacion }}</td>
                                    <td>{{ $pago->comentarios }}</td>
                                    <td>{{ $pago->user->nombre }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if(count($reserva->cuotas)>0)
                    <div class="row">
                        <h4 class="title-table">CRONOGRAMA DE PAGOS POR REALIZAR</h4>
                        <table class="pasajeros-table">
                            <thead>
                                <tr>
                                    <th class="thnro">N°</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th>Comentario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reserva->cuotas as $i => $cuota)
                                    <tr>
                                        <td class="thnro">{{ $cuota->nroCuota }}</td>
                                        <td>{{ $cuota->fecha }}</td>
                                        <td>{{ $cuota->moneda->abreviatura }} {{ $cuota->monto }}</td>
                                        <td>{{ $cuota->comentarios }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </main>

</body>

</html>

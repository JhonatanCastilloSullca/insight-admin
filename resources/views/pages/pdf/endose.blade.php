<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Endose</title>
    <style>



body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.8rem;
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
            padding: 0.3rem;
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
            line-height: 1.5;
        }
        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: left;
            line-height: 1.5;
        }
        tbody {
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
            line-height: 1.5;
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
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <div class="row">
            <h1 style="TEXT-ALIGN: CENTER; color:#375a64; line-height: 70px; padding-bottom: 20px;"> Tour Endosado: {{$operar->servicio->titulo}} / {{ date('d/m/Y', strtotime($operar->fecha)) }}</h1>
            <div class="card-body">
                <div class="table-responsive" >
                    <table  class="table table-sm">
                        <tbody>
                            <tr>
                                <td class="id_pasajero" style="border-top:0px; font-size:0.65rem; color:#375a64;"><b>Cantidad Pax.:</b> {{ $operar->cantidad_pax }}</td>
                                <td class="id_pasajero"style="border-top:0px; font-size:0.65rem; color:#375a64;"><b>Ingresos:</b> S/ {{ $operar->ingresos }}</td>
                                <td class="id_pasajero" style="border-top:0px; font-size:0.65rem; color:#375a64;"><b>Usuario: </b>{{ $operar->user->nombre }}</td>
                                <td class="id_pasajero" style="border-top:0px; font-size:0.65rem; color:#375a64;"></td>
                                <td rowspan="2" style="border-top:0px;"><img class="derecha" style="padding-top:0; margin-right:1rem"  src="{{ asset('img/brand/logo.png')}}"width="600px"  alt="admin@bootstrapmaster.com"></td>
                            </tr>
                            <tr>
                                <td style="border-top:0px; font-size:0.65rem;color:#375a64;"><b >Agencia: </b>{{$agencia->proveedor->nombre}}</td>
                            </tr>
                        
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive" >
                    <h4 class="mb-4">DETALLES</h4> 
                    <table id="detalles" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr style="background-color:#375a64; color:#ffffff; font-size: 0.8rem;">
                                <th><label class="form-label"> PAXS</label></th>
                                <th><label class="form-label"> PAX PRINCIPAL</label></th>
                                <th><label class="form-label"> NACIONALIDAD</label></th>
                                <th><label class="form-label"> TELELFONO</label></th>
                                <th><label class="form-label"> HOTEL</label></th>
                                <th><label class="form-label"> INGRESOS</label></th>
                                <th><label class="form-label"> HORA DE RECOJO</label></th>
                                <th><label class="form-label"> OBSERVACIONES</label></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($operar->detalles as $detalle)
                            <tr>
                                <td>
                                    {{$detalle->detallereserva?->pax}}
                                </td>
                                <td>
                                    {{$detalle->detallereserva?->reserva?->pasajeroprincipal()->nombreCompleto}}
                                </td>
                                <td>
                                    {{$detalle->detallereserva?->reserva?->pasajeroprincipal()->pais->nombre}}
                                </td>
                                <td>
                                    {{$detalle->detallereserva?->reserva?->pasajeroprincipal()->celular}}
                                </td>
                                <td>
                                    {{$detalle->detallereserva?->hotel?->nombre}} {{$detalle->detallereserva?->hotel?->direccion}}
                                </td>
                                <td>
                                    {{$detalle->ingresos}}
                                </td>
                                <td>
                                    {{$detalle->recojo ? date("h:i a",strtotime($detalle->recojo)) : null}}
                                </td>
                                <td>
                                    {{$detalle->observacion}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        

                </div>
            </div>
            <span style="line-height: 50px; font-size: 0.8rem"><b>Observaciones: </b>{{$operar->observacion}}</span>
        </div>
    </div>
</div>
</body>

</html>
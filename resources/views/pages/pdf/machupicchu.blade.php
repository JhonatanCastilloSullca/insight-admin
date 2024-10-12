<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Operacion Machu picchu</title>
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
            <h1 style="TEXT-ALIGN: CENTER; line-height: 70px; color:#375a64; padding-bottom: 20px;"> Tour Operado: MACHUPICCHU</h1>
            <div class="card-body">
                <div class="table-responsive" >
                    <table  class="table table-sm">
                        <tbody>
                            <tr>
                                <td class="id_pasajero" style="border-top:0px; font-size:0.65rem; color:#375a64;"><b>Fecha Operacion:</b> {{date("d-m-Y",strtotime($operacion->fecha))}}</td>
                                <td class="id_pasajero"style="border-top:0px; font-size:0.65rem; color:#375a64;"><b>Usuario:</b> {{$operacion->user->nombre}}</td>
                                <td class="id_pasajero" style="border-top:0px; font-size:0.65rem; color:#375a64;"></td>
                                <td class="id_pasajero" style="border-top:0px; font-size:0.65rem; color:#375a64;"></td>
                                <td rowspan="2" style="border-top:0px;"><img class="derecha" style="padding-top:0; margin-right:1rem"  src="{{ asset('img/brand/logo.png')}}"width="600px"  alt="admin@bootstrapmaster.com"></td>
                            </tr>                        
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive" >
                    <h4 class="mb-4">DETALLES</h4> 
                    <table id="detalles" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr style="background-color:#375a64; color:#ffffff; font-size: 0.8rem;">
                                <th><label class="form-label"> FECHA</label></th>
                                <th><label class="form-label"> NOMBRE</label></th>
                                <th><label class="form-label"> Nº PAX</label></th>
                                <th><label class="form-label"> SERVICIO</label></th>
                                <th><label class="form-label"> COSTO</label></th>
                                <th><label class="form-label"> TELEFONO</label></th>
                                <th><label class="form-label"> PAIS</label></th>
                                <th><label class="form-label"> IDIOMA</label></th>
                                @foreach($operacion->servicio->incluyesOperarIngresos() as $ser)
                                    <th><label class="form-label"> {{$ser->titulo}}</label></th>
                                @endforeach
                                <th><label class="form-label"> COMENTARIO</label></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($operacion->operarServicios as $detalle)
                                <tr>
                                    <td>
                                        {{$detalle->detallereserva?->fecha_viaje ? date("d-m-Y",strtotime($detalle->detallereserva?->fecha_viaje)) : ''}}
                                    </td>
                                    <td>
                                        {{$detalle->detallereserva?->reserva?->pasajeroprincipal()->nombreCompleto}}
                                    </td>
                                    <td>
                                        {{$detalle->detallereserva?->pax}}
                                    </td>
                                    <td>
                                        {{$detalle->servicio?->titulo}}
                                    </td>
                                    <td>{{ $detalle->moneda_id == 2 ? '$' : 'S/' }} {{ $detalle->precio }}</td>
                                    <td>
                                        {{$detalle->detallereserva?->reserva?->pasajeroprincipal()->celular}}
                                    </td>
                                    <td>
                                        {{$detalle->detallereserva?->reserva?->pasajeroprincipal()->pais->nombre}}
                                    </td>
                                    <td>
                                        {{$detalle->idioma}}
                                    </td>
                                    @foreach($operacion->servicio->incluyesOperarIngresos() as $ser)
                                        <td>
                                            @foreach($detalle->detallereserva?->reserva?->operarTickets as $detallea)
                                                @php $operarser = \App\Models\OperarServicio::where('servicio_id',$detallea->servicio_id)
                                                    ->where('operar_id',$detallea->id)->first();
                                                    $serviciosss = \App\Models\Servicio::find($detallea->servicio_id);
                                                @endphp
                                                @if($serviciosss->id == $ser->id || $serviciosss->servicio_id  == $ser->id )
                                                    {{$operarser->recojo}} {{$operarser->observacion}}
                                                @endif
                                            @endforeach
                                        </td>
                                    @endforeach
                                    <td>
                                        {{$detalle->observacion}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <span style="line-height: 50px; font-size: 0.8rem"><b>Observaciones: </b>{{$operacion->observacion}}</span>
        </div>
    </div>
</div>
</body>

</html>
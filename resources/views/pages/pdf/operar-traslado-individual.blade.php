<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Traslados {{$proveedor->nombre}}</title>
    <style>



body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.65rem;
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
            <h1 style="TEXT-ALIGN: CENTER; line-height: 70px; color:#1b4474; padding-bottom: 20px;"> Traslados {{$proveedor->nombre}} </h1>
            <div class="card-body">
                <div class="table-responsive" >
                    <table  class="table table-sm">
                        <tbody>
                            <tr>
                                <td class="id_pasajero" style="border-top:0px; font-size:0.7rem; color:#375a64;"></td>
                                <td class="id_pasajero"style="border-top:0px; font-size:0.7rem; color:#375a64;"></td>
                            </tr>
                            <tr>
                                <td class="id_pasajero" style="border-top:0px; font-size:0.7rem; color:#375a64;"></td>
                                <td class="id_pasajero"style="border-top:0px; font-size:0.7rem; color:#375a64;"></td>
                                <td rowspan="2" style="border-top:0px;"><img class="derecha" style="padding-top:0; margin-top:-2rem; margin-right:1rem"  src="{{ asset('img/brand/logo.png')}}"width="505px"  alt="admin@bootstrapmaster.com"></td>
                            </tr>                        
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive" >
                            
                    <table id="detalles" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr style="background-color:#2ba5b0; color:#ffffff; font-size: 0.9rem;">
                                
                                <th colspan="9" class="text-center"><label class="text-center"> {{$proveedor->nombre}}</label></th>
                            </tr>
                            <tr style="background-color:#2ba5b0; color:#ffffff; font-size: 0.7rem;">
                                
                                <th><label class="text-center"> Fecha</label></th>
                                <th><label class="text-center"> Servicio</label></th>
                                <th><label class="text-center"> Nombre y Apellido</label></th>
                                <th><label class="text-center"> Cant.</label></th>
                                <th><label class="text-center"> Hotel</label></th>
                                <th><label class="text-center"> Teléfono</label></th>
                                <th><label class="text-center"> Nacionalidad</label></th>
                                <th><label class="text-center"> Hora Recojo</label></th>
                                <th><label class="text-center"> Observaciones</label></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($servicios  as $servicio)
                                <tr>
                                    <td>{{date("d-m-Y",strtotime($servicio->detalleReserva->fecha_viaje))}}</td>
                                    <td>{{ $servicio->servicio->titulo }}</td>
                                    <td>{{ $servicio->detalleReserva->reserva->pasajeroprincipal()->nombreCompleto }}</td>
                                    <td>{{ $servicio->cantidad }}</td>
                                    <td>{{ $servicio->detalleReserva->hotel?->nombre}} {{ $servicio->detalleReserva->hotel?->direccion}}</td>
                                    <td>{{ $servicio->detalleReserva->reserva->pasajeroprincipal()?->celular }}</td>
                                    <td>{{ $servicio->detalleReserva->reserva->pasajeroprincipal()?->pais->nombre }}</td>
                                    <td>{{ date("h:i a",strtotime($servicio->recojo)) }}</td>
                                    <td>{{ $servicio->observacion }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
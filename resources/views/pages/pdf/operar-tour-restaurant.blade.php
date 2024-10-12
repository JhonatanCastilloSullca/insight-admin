<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Operacion Servicio</title>
    <style>



body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.8rem;
            font-weight: normal;
            line-height: .05;
            color: #151b1e;   
            writing-mode: tb-rl;
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
            <h1 style="TEXT-ALIGN: CENTER; line-height: 70px; color:#375a64; padding-bottom: 20px;"> RESTAURANTE: {{$operar->proveedor->nombre}}</h1>
            <div class="card-body">
                <div class="table-responsive" >
                    <table  class="table table-sm">
                        <tbody>
                            <tr>
                                <td class="id_pasajero" style="border-top:0px; font-size:0.65rem; color:#375a64;"></td>
                                <td class="id_pasajero"style="border-top:0px; font-size:0.65rem; color:#375a64;"></td>
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
                        <tbody>
                            <tr style="font-size: 0.8rem;">
                                <th style="background-color: #375a64; color: #ffffff;">GRUPO</th>
                                <th><label class="form-label">JISA ADVENTURE</label></th>
                            </tr>
                            <tr style="font-size: 0.8rem;">
                                <th style="background-color: #375a64; color: #ffffff;">FECHA</th>
                                <th><label class="form-label">{{date("d/m/Y",strtotime($operar->operar->fecha))}}</label></th>
                            </tr>
                            <tr style="font-size: 0.8rem;">
                                <th style="background-color: #375a64; color: #ffffff;">Nº PAXS</th>
                                <th><label class="form-label">{{$operar->operar->cantidad_pax}} PAX + 1 GUIA</label></th>
                            </tr>
                            <tr style="font-size: 0.8rem;">
                                <th style="background-color: #375a64; color: #ffffff;">RESERVA</th>
                                <th><label class="form-label">{{$operar->servicio->titulo}}</label></th>
                            </tr>
                            <tr style="font-size: 0.8rem;">
                                <th style="background-color: #375a64; color: #ffffff;">RUTA</th>
                                <th><label class="form-label">{{$operar->operar->servicio->titulo}}</label></th>
                            </tr>
                            <tr style="font-size: 0.8rem;">
                                <th style="background-color: #375a64; color: #ffffff;">SOLICITADO</th>
                                <th><label class="form-label">{{$operar->operar->user->nombre}}</label></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
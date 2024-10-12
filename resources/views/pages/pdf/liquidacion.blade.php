<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Liquidacion</title>
<style>



body{
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
            <h1 style="TEXT-ALIGN: CENTER; line-height: 70px; color:#4CAF50; padding-bottom: 20px;"> Liquidacion: {{$liquidacion->proveedor->nombre}} / {{date("d-m-Y H:m",strtotime($liquidacion->fecha))}}</h1>
            <div class="card-body">
                <div class="table-responsive" >
                    <table  class="table table-sm">
                        <tbody>
                            <tr>
                                <td class="id_pasajero" style="border-top:0px; font-size:0.7rem; color:#1b4474;"></td>
                                <td class="id_pasajero"style="border-top:0px; font-size:0.7rem; color:#2A3787;"></td>
                                <td rowspan="2" style="border-top:0px;"></td>
                            </tr>
                            <tr>
                                <td class="id_pasajero" style="border-top:0px; font-size:0.7rem; color:#1b4474;"><b>Usuario: </b>{{ $liquidacion->user->nombre }}</td>
                                <td class="id_pasajero"style="border-top:0px; font-size:0.7rem; color:#2A3787;"><b  >Total: </b>{{$liquidacion->total}}</td>
                                <td rowspan="2" style="border-top:0px;"><img class="derecha" style="padding-top:0; margin-top:-2rem; margin-right:1rem"   src="{{ asset('img/brand/logo.png')}}" width="205px"  alt="admin@bootstrapmaster.com"></td>
                            </tr>
                        
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive" >
                            
                    <table id="detalles" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr style="background-color:#1b4474; color:#ffffff; font-size: 0.7rem;">
                                <th><label class="form-label"> FECHA</label></th>
                                <th><label class="form-label"> SERVICIO</label></th>
                                <th><label class="form-label"> PAX</label></th>
                                <th><label class="form-label"> NOMBRES</th>
                                <th><label class="form-label"> PRECIO</label></th>
                                <th><label class="form-label"> INGRESOS S/</label></th>
                                <th><label class="form-label"> COMENTARIOS</label></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($liquidacion->detallesliquidacion as $detalle)
                                <tr>
                                    <td>{{date("d-m-Y",strtotime($detalle->ejecutable->operar?->fecha))}}</td>
                                    <td>{{$detalle->servicio->titulo}}</td>
                                    <td>{{$detalle->cantidad}}</td>
                                    <td>
                                    @if($detalle->operar == 1)
                                        @foreach($detalle->ejecutable->operar->detalles as $detail)
                                        {{$detail->detalleReserva?->reserva?->pasajeroprincipal()?->nombreCompleto}} (x{{$detail->detalleReserva?->reserva?->sumarPaxPrimerFecha()}})
                                        @if(!$loop->last)
                                            <br>
                                        @endif
                                        @endforeach
                                    @else
                                        {{$detalle->ejecutable->detalleReserva?->reserva?->pasajeroprincipal()?->nombreCompleto}} (x{{$detalle->ejecutable->detalleReserva?->reserva?->sumarPaxPrimerFecha()}})
                                    @endif
                                    </td>
                                    <td>{{$detalle->moneda_id == 2 ? 'USD' : 'PEN'}} {{$detalle->precio}}</td>
                                    <td>PEN {{$detalle->ingreso}}</td>
                                    <td>{{$detalle->comentarios}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">Totales</td>
                                <td>USD {{$liquidacion->detallesliquidacion->where('moneda_id',2)->sum('precio')}}</td>
                                <td>PEN {{$liquidacion->detallesliquidacion->where('moneda_id',1)->sum('precio')}}</td>
                                <td>PEN {{$liquidacion->detallesliquidacion->sum('ingreso')}}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
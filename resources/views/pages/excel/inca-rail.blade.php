<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inca Rail</title>
    <style>
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <div class="row">
            <div class="table-responsive" >
            <table  class="table table-bordered table-striped table-sm">
                <tbody>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>NOMBRES</td>
                        <td>APELLIDOS</td>
                        <td>TIPO DE DOCUMENTO</td>
                        <td>NUMERO DE DOCUMENTO</td>
                        <td>PAIS ORIGEN</td>
                        <td>FECHA NACIMIENTO (dia/mes/año) </td>
                        <td>TIPO DE PASAJERO</td>
                        <td>RUTA IDA</td>
                        <td>RUTA REGRESO</td>
                    </tr>
                    @foreach($reserva->pasajeros as $i => $pax)
                        <tr>
                            <td>{{$pax->nombres}}</td>
                            <td>{{$pax->apellidoPaterno}}</td>
                            <td>{{$pax->documento->tipo_documento=="CARNET E." ? 'CEX' : ($pax->documento->tipo_documento=="PASAPORTE" ? 'PAS' : ($pax->documento->tipo_documento=="DNI" ? 'DNI' : 'OTR' )) }}</td>
                            <td>{{$pax->documento->num_documento}}</td>
                            <td>{{$pax->pais->textIncaRail}}</td>
                            <td>{{date("d/m/Y",strtotime($pax->nacimiento))}}</td>
                            <td>{{$pax->tarifa}}</td>
                            <td></td>
                            <td></td>
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

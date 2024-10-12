<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formato</title>
    <style>
    </style>
</head>
<body>
<div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
    <div class="card">
        <div class="row">
            <div class="table-responsive" >
            <table  class="table table-bordered table-striped table-sm">
                <tbody>
                    <tr>
                        <td>Booking</td>
                        <td>Apellido Paterno</td>
                        <td>Apellido Materno</td>
                        <td>Nombres</td>
                        <td>IdTipoDoc</td>
                        <td>NroDoc</td>
                        <td>Fecha de Nacimiento</td>
                        <td>IdPais</td>
                        <td>Ciudad</td>
                        <td>Sexo</td>
                    </tr>
                    @foreach($detalles as $i => $detalle)
                        @foreach($detalle->reserva->pasajeros as $pax)
                            <tr>
                                <td>{{$detalle->reserva->id}}</td>
                                <td>{{$pax->apellidoPaterno}}</td>
                                <td>{{$pax->apellidoMaterno}}</td>
                                <td>{{$pax->nombres}}</td>
                                <td>{{$pax->documento->tipo_documento=="CARNET E." ? '2' : ($pax->documento->tipo_documento=="PASAPORTE" ? '4' : ($pax->documento->tipo_documento=="DNI" ? '1' : '' )) }}</td>
                                <td>{{ str_replace(' ', '', $pax->documento->num_documento) }}</td>
                                <td>{{date("Y-m-d",strtotime($pax->nacimiento))}}</td>
                                <td>{{$pax->pais->codeConsetur}}</td>
                                <td>1596</td>
                                <td>{{$pax->genero =='MASCULINO' ? 'M' : 'F'}}</td>
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

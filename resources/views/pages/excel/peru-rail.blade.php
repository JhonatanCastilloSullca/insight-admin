<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PASAJEROS</title>
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
                    <tr>
                        <td>TIPO PASAJERO</td>
                        <td>GENERO(F/M)</td>
                        <td>TIPO DOC</td>
                        <td>NRO DOC</td>
                        <td>PRIMER NOMBRE</td>
                        <td>PRIMER APELLIDO</td>
                        <td>FECHA NAC.</td>
                        <td>NACIONALIDAD</td>
                    </tr>
                    @foreach($reserva->pasajeros as $i => $pax)
                        <tr>
                            <td>{{ $pax->tarifa == 'ADULTO' ? '1-Adult' : '2-Child ( sharing )' }}</td>
                            <td>{{ $pax->genero == 'FEMENINO' ? 'F-Female' : 'M-Male' }}</td>
                            <td>{{$pax->documento->tipo_documento=="CARNET E." ? 'CEX' : ($pax->documento->tipo_documento=="PASAPORTE" ? 'PAS' : ($pax->documento->tipo_documento=="DNI" ? 'DNI' : 'ID' )) }}</td>
                            <td>{{$pax->documento->num_documento}}</td>
                            <td>{{ explode(' ', $pax->nombres)[0] }}</td>
                            <td>{{$pax->apellidoPaterno}}</td>
                            <td>{{ date('d/m/Y', strtotime($pax->nacimiento)) }}</td>
                            <td>{{ $pax->pais?->code }}-{{ $pax->pais?->text }}</td>
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

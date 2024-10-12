<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Ventas </title>
    <style>
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
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
                            @foreach ($reserva->pasajeros as $pasajero)
                                <tr>
                                    <td>{{ $pasajero->tarifa == 'ADULTO' ? '1-Adult' : '2-Child ( sharing )' }}</td>
                                    <td>{{ $pasajero->genero == 'FEMENINO' ? 'F-Female' : 'M-Male' }}</td>
                                    <td>{{ $pasajero->documento?->tipo_documento }}</td>
                                    <td>{{ $pasajero->documento?->num_documento }}</td>
                                    <td>{{ $pasajero->nombres }}</td>
                                    <td>{{ $pasajero->nombres }}</td>
                                    <td>{{ date('d/m/Y', strtotime($pasajero->nacimiento)) }}</td>
                                    <td>{{ $pasajero->pais?->id }}-{{ $pasajero->pais?->nombre }}</td>
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

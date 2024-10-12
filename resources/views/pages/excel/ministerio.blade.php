<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Plantilla Ministerio</title>
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
                        <td colspan="4">
                            Plantilla Carga Masiva - Llaqta
                        </td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Item</td>
                        <td>Procedencia</td>
                        <td>idProcedencia</td>
                        <td>País</td>
                        <td>idPais</td>
                        <td>Tarifa</td>
                        <td>idTarifa</td>
                        <td>Tipo de Documento</td>
                        <td>idTipoDocumento</td>
                        <td>Nro Documento</td>
                        <td>Fecha de nacimiento dd-mm-aaaa</td>
                        <td>Nombres</td>
                        <td>Apellido Paterno</td>
                        <td>Apellido Materno</td>
                        <td>Cod File</td>
                        <td>Sexo</td>
                    </tr>
                    @foreach($reserva->pasajeros as $i => $pasajero)
                        <tr>
                            <td></td>
                            <td>{{$i+1}}</td>
                            <td>{{$pasajero->obtenerValorPais() == 1 ? "Extranjero":($pasajero->obtenerValorPais() == 2 ? "Peruano":"Países CAN y Residente extranjero")}}</td>
                            <td>{{$pasajero->obtenerValorPais()}}</td>
                            <td>{{$pasajero->pais->textMinisterio}}</td>
                            <td>{{$pasajero->pais->codeMinisterio}}</td>
                            <td>
                                @if($pasajero->obtenerValorPais() == 1 )
                                    {{$pasajero->tarifa=="ADULTO" ? 'General' : 'Menor de edad entre 3 - 17 años'}}
                                @else
                                    {{$pasajero->tarifa=="ADULTO" ? 'General promocional' : 'Menor de edad entre 3-17 años promocional'}}
                                @endif
                            </td>
                            <td>
                                @if($pasajero->obtenerValorPais() == 1)
                                    {{$pasajero->tarifa=="ADULTO" ? '1' : '3'}}
                                @else
                                    {{$pasajero->tarifa=="ADULTO" ? '4' : '6'}}
                                @endif
                            </td>
                            <td>{{$pasajero->documento->tipo_documento=="CARNET E." ? 'CE' : ($pasajero->documento->tipo_documento=="PASAPORTE" ? 'PAS' : $pasajero->documento->tipo_documento ) }}</td>
                            <td>{{$pasajero->documento->tipo_documento=="CARNET E." ? '2' : ($pasajero->documento->tipo_documento=="PASAPORTE" ? '3' : ($pasajero->documento->tipo_documento=="DNI" ? '1' : '4' )) }}</td>
                            <td>{{$pasajero->documento->num_documento}}</td>
                            <td>{{date("d-m-Y",strtotime($pasajero->nacimiento))}}</td>
                            <td>{{$pasajero->nombres}}</td>
                            <td>{{$pasajero->apellidoPaterno}}</td>
                            <td>{{$pasajero->apellidoMaterno}}</td>
                            <td></td>
                            <td>{{ ucfirst(strtolower($pasajero->genero)) }}</td>
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

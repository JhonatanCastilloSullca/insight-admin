@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-3" >
                                <label class="form-label" for="servicioid">Fecha Operacion:</label>
                                <p class="h6">{{date("d-m-Y",strtotime($operacion->fecha))}} </p>
                            </div>
                            <div class="mb-3 col-md-3" >
                                <label class="form-label" for="servicioid">Usuario:</label>
                                <p class="h6">{{$operacion->user->nombre}}</p>
                            </div>
                            <div class="mb-3 col-md-3" >
                                <label class="form-label" for="servicioid">Total Soles:</label>
                                <p class="h6">{{$operacion->precioSoles}}</p>
                            </div>
                            <div class="mb-3 col-md-3" >
                                <label class="form-label" for="servicioid">Total Dolares:</label>
                                <p class="h6">{{$operacion->precioDolares}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($operacion->operarServiciosProveedorTraslados() as $proveedor)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12 d-flex justify-content-end">
                                <div class="btn-group mb-3">
                                    <a href="{{ route('operacion.whatsappoperaciontraslado', ['proveedor_id' => $proveedor['proveedor_id'], 'operacion_id' => $operacion->id]) }}" target="_blank">
                                        <button type="button" class="btn btn-success btn-icon me-2">
                                            <i class="fab fa-whatsapp"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('operacion.notificarpdfoperaciontraslado', ['proveedor_id' => $proveedor['proveedor_id'], 'operacion_id' => $operacion->id]) }}" target="_blank">
                                        <button type="button" class="btn btn-warning btn-icon me-2">
                                            <i class="fe fe-file"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-info table-striped mg-b-0 text-md-nowrap">
                                        <thead>
                                            <tr class="text-center">
                                                <th colspan="10">{{$proveedor['nombre_proveedor']}}</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th>Fecha</th>
                                                <th>Servicio</th>
                                                <th>Nombre y Apellido</th>
                                                <th>Cant.</th>
                                                <th>Hotel</th>
                                                <th>Teléfono</th>
                                                <th>Nacionalidad</th>
                                                <th>Hora Recojo</th>
                                                <th>Observaciones</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($proveedor['servicios'] as $servicio)
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
                                                    <td>
                                                        <div class="btn-group">
                                                            <a class="btn btn-info btn-icon me-2" href="{{route('operacion.trasladosoverview',['id'=>$servicio->id])}}" target="_blank">
                                                                <i class="fab fa-whatsapp"></i>
                                                            </a>
                                                            <button type="button" class="btn btn-danger mb-2 mb-md-0 " onclick="agregar('{{$servicio->cantidad}}','{{$servicio->operar_id}}','{{$proveedor['proveedor_id']}}','{{$servicio->id}}')">
                                                                <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-times-circle"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>
    
<div class="modal fade" id="crear-formulario"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="text-formulario">Agregar Incidencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">x</button>
            </div>
            <div class="card-body">
                <h4 id="text-formulario"></h4>
                <form action="{{route('incidencia.store')}}" method="POST" class="forms-sample" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="costo">Costo:</label>
                        <div class="input-group">
                            <input type="hidden" name="cantidad" id="cantidad">
                            <input type="hidden" name="operar_id" id="operar_id">
                            <input type="hidden" name="proveedor_id" id="proveedor_id">
                            <input type="hidden" name="operar_servicio_id" id="operar_servicio_id">
                            <input type="hidden" name="moneda_id" id="moneda_id" value="2">
                            <span class="input-group-text pe-cursor" id="textSpan" onclick="cambiarMoneda()">$
                            </span>
                            <input text="number" step="0.01" class="form-control" name="costo" id="costo" value="0">
                        </div>                            
                        @error('costo')
                            <span class="error-message" style="color:red">Campo Obligaotrio</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="descripcion">Comentario:</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary me-2" id="boton-formulario">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection
@push('plugin-scripts')
@endpush
@push('custom-scripts')
<script>
    function cambiarMoneda() {
        let moneda = $('#moneda_id').val();
        if(moneda == 2){
            $('#textSpan').text('S/');
            $('#moneda_id').val(1);
        }else{
            $('#textSpan').text('$');
            $('#moneda_id').val(2);
        }
    }

    function agregar(cantidad,operar_id,proveedor_id,operar_servicio_id) {
        $('#crear-formulario').modal('show');
        $('#cantidad').val(cantidad);
        $('#operar_id').val(operar_id);
        $('#proveedor_id').val(proveedor_id);
        $('#operar_servicio_id').val(operar_servicio_id);
    }
</script>
@endpush

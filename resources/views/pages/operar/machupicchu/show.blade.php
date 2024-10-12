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
                    <div class="col-md-12">
                        <h4 class="mb-4">DETALLES</h4>
                        <div class="col-md-12 mb-3">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th><label class="form-label"> FECHA</label></th>
                                        <th><label class="form-label"> SERVICIO</label></th>
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
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($operacion->operarServicios as $detalle)
                                        <tr>
                                            <td>
                                                {{$detalle->detallereserva?->fecha_viaje ? date("d-m-Y",strtotime($detalle->detallereserva?->fecha_viaje)) : ''}}
                                            </td>
                                            <td>
                                                {{$detalle->detallereserva?->servicio->titulo}}
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
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div><!-- Col -->
                        <div class="col-md-12">
                            <span class="h4"><b>Observaciones:</b> {{$operacion->observacion}}</span>
                        </div>
                    </div>
                </div>
            </div>
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

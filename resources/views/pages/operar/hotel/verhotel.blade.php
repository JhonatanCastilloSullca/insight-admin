@extends('layout.master')
@section('content')
<div class="main-container container-fluid">
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Ver operacion Hotel</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-label" for="servicioid">Fecha Registro:</label>
                            <p class="h6">{{date("d-m-Y",strtotime($operar->fecha))}}</p>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="servicioid">Precio Soles:</label>
                            <p class="h6">{{$operar->precioSoles}}</p>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="servicioid">Precio Dolares:</label>
                            <p class="h6">{{$operar->precioDolares}}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="servicioid">Usuario:</label>
                            <p class="h6">{{$operar->user->nombre}}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="servicioid">Reserva:</label>
                            <p class="h6">{{$operar->reserva->numero}}-{{$operar->reserva->primerafecha()?->fecha_viaje ? date("d-m-Y",strtotime($operar->reserva->primerafecha()?->fecha_viaje)) : ''}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            @foreach($operar->operarServicios as $i => $detalle)
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-3" >
                                <label class="form-label" for="servicioid">Servicio:</label>
                                <p class="h6">{{$detalle->pax}} HABITACION {{$detalle->servicio->titulo}} / {{$detalle->servicio->proveedor?->nombre}}</p>
                            </div>
                            <div class="mb-3 col-md-1" >
                                <label class="form-label" for="servicioid">Noches:</label>
                                <p class="h6">{{ $detalle->detalleReserva->equipaje }}</p>
                            </div>
                            <div class="mb-3 col-md-1" >
                                <label class="form-label" for="servicioid">Precio:</label>
                                <p class="h6">{{ $detalle->moneda_id == 2 ? '$ ' : 'S/ ' }} {{ $detalle->precio }}</p>
                            </div>
                            <div class="mb-3 col-md-2" >
                                <label class="form-label" for="servicioid">Check inn:</label>
                                <p class="h6">{{ date('d-m-Y H:i', strtotime($detalle->detalleReserva->fecha_viaje)) }}</p>
                            </div>
                            <div class="mb-3 col-md-2" >
                                <label class="form-label" for="servicioid">Check out:</label>
                                <p class="h6">{{ date('d-m-Y H:i', strtotime($detalle->detalleReserva->fecha_viajefin)) }}</p>
                            </div>
                            <div class="mb-3 col-md-2" >
                                <label class="form-label" for="servicioid">Fecha Pago:</label>
                                <p class="h6">{{ $detalle->fechaPago ? date('d-m-Y', strtotime($detalle->fechaPago)) :'' }}</p>
                            </div>
                            {{-- <div class="mb-3 col-md-2" >
                                <label class="form-label" for="servicioid">Estado:</label>
                                @if($detalle->detalleReserva->confirmado==0)
                                    <h4><span class="badge bg-danger me-1 my-2">Sin Notificar</span></h4>
                                @elseif($detalle->detalleReserva->confirmado==1)
                                    <h4><span style="background: orange" class="badge me-1 my-2">Confirmado</span></h4>
                                @elseif($detalle->detalleReserva->confirmado==2)
                                    <h4><span style="background: yellow" class="badge me-1 my-2 text-black">Por Pagar</span></h4>
                                @else
                                    <h4><span class="badge bg-success">Pagado</span></h4>
                                @endif
                            </div> --}}
                            <div class="mb-3 col-md-1" >
                                <div class="btn-group">
                                    @if($detalle->imagen)
                                        <a href="{{asset('storage/img/confiramacionHotel/'.$detalle->imagen)}}" target="_blank">
                                            <button type="button"  class="btn btn-warning btn-icon me-2"><i class="fe fe-eye"></i></button>
                                        </a>
                                    @endif
                                    <button type="button" class="btn btn-danger btn-icon  " onclick="agregar('{{$detalle->cantidad}}','{{$detalle->operar_id}}','{{$detalle->proveedor_id}}','{{$detalle->id}}')">
                                        <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-times-circle"></i>
                                    </button>
                                </div>
                            </div>
                            @if(count($detalle->pagosServicio)>0)
                                <h6>Pagos</h6>
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover mb-0 text-md-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Medio</th>
                                                            <th>Monto</th>
                                                            <th>Fecha</th>
                                                            <th>Numero Operacion</th>
                                                            <th>Comentarios</th>
                                                            <th>Voucher</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($detalle->pagosServicio as $j => $pago)
                                                            <tr>
                                                                <td>{{ $pago->medio->nombre }}</td>
                                                                <td>{{ $pago->moneda->abreviatura }} {{ $pago->monto}}</td>
                                                                <td>{{ date("d-m-Y",strtotime($pago->fecha)) }}</td>
                                                                <td>{{ $pago->num_operacion}}</td>
                                                                <td>{{ $pago->comentarios }}</td>
                                                                <td>
                                                                    @if($pago->imagen)
                                                                        <a href="{{asset('storage/img/pagosHoteles/'.$pago->imagen)}}" target="_blank">
                                                                            <button type="button"  class="btn btn-warning btn-icon"><i class="fe fe-eye"></i></button>
                                                                        </a>
                                                                    @endif
                                                                <td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <h6>Pasajeros</h6>
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover mb-0 text-md-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre Pasajero</th>
                                                        <th>Documento</th>
                                                        <th>Años</th>
                                                        <th>Telefono</th>
                                                        <th>Nacionalidad</th>
                                                        <th>Comentarios</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="cuerpo{{$i}}">
                                                    @foreach($detalle->operarPasajeros as $j => $pasajero)
                                                        <tr>
                                                            <td>{{ $pasajero->pasajero->nombreCompleto }}</td>
                                                            <td>{{ $pasajero->pasajero->documento->tipo_documento }} {{ $pasajero->pasajero->documento->num_documento}}</td>
                                                            <td>{{ \Carbon\Carbon::parse($pasajero->pasajero->nacimiento)->diffInYears(\Carbon\Carbon::now()) }}</td>
                                                            <td>{{ $pasajero->pasajero->celular}}</td>
                                                            <td>{{ $pasajero->pasajero->pais->nombre }}</td>
                                                            <td>{{ $pasajero->pasajero->comentario }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('plugins/sortablejs/Sortable.min.js') }}"></script>
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


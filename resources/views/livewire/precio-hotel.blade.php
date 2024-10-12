<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label" for="servicioid">Fecha Registro:</label>
                        <p class="h6">{{date("d-m-Y",strtotime($operar->fecha))}}</p>
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
        @foreach($operar->operarHotelsPrecio as $i => $detalle)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-2" >
                            <label class="form-label" for="servicioid">Servicio:</label>
                            <p class="h6">{{$detalle->pax}} HABITACION {{$detalle->servicio->titulo}} / {{$detalle->servicio->proveedor?->nombre}}</p>
                        </div>
                        <div class="mb-3 col-md-2" >
                            <label class="form-label" for="servicioid">Noches:</label>
                            <p class="h6">{{ $detalle->detalleReserva->equipaje }}</p>
                        </div>
                        <div class="mb-3 col-md-1" >
                            <label class="form-label" for="servicioid">Check inn:</label>
                            <p class="h6">{{ date('d-m-Y H:i', strtotime($detalle->detalleReserva->fecha_viaje)) }}</p>
                        </div>
                        <div class="mb-3 col-md-1" >
                            <label class="form-label" for="servicioid">Check out:</label>
                            <p class="h6">{{ date('d-m-Y H:i', strtotime($detalle->detalleReserva->fecha_viajefin)) }}</p>
                        </div>
                        <div class="mb-3 col-md-2" >
                            <label class="form-label" for="precio{{$i}}">Precio:</label>
                            <div class="input-group">
                                <span class="input-group-text pe-cursor" wire:click="cambiarTipoMoneda({{$i}})">
                                    {{$moneda[$i] == 2 ? '$' : 'S/'}}
                                </span>
                                <input type="number" step="0.01" class="form-control" name="precio{{$i}}" id="precio{{$i}}" wire:model.defer="precio.{{$i}}">
                            </div>
                            @error('precio.'.$i)
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-2" >
                            <label class="form-label" for="fecha{{$i}}">Fecha limite a pagar:</label>
                            <input type="date" class="form-control" name="fecha{{$i}}" id="fecha{{$i}}" wire:model.defer="fecha.{{$i}}">
                            @error('fecha.'.$i)
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-2" >
                            <label class="form-label" for="imagen{{$i}}">Imagen Confirmacion:</label>
                            <input type="file" class="form-control" name="imagen{{$i}}" id="imagen{{$i}}" wire:model.defer="imagen.{{$i}}">
                            @error('imagen.'.$i)
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
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
    <div class="col-md-3">
        <button type="button" class="btn btn-primary mt-4 m-2" wire:click="register" 
        wire:loading.attr="disabled">
            <span wire:loading wire:target="register">Guardando...</span>
            <span wire:loading.remove wire:target="register">Guardar</span>
        </button>
    </div>
</div>
@push('custom-scripts')
<script>
    
</script>
@endpush

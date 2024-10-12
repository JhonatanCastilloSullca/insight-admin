<div class="row">

    <div class="col-md-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
            {{ $message }}
            <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif
        @foreach($detalles as $i => $detalle)
            <div class="card" wire:key="detalle-{{ $i }}">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-3" >
                            <label class="form-label" for="servicioid">Servicio:</label>
                            <p class="h6">{{$detalle->pax}} HABITACION {{$detalle->servicio->titulo}} / {{$detalle->servicio->proveedor?->nombre}}</p>
                        </div>
                        <div class="mb-3 col-md-2" >
                            <label class="form-label" for="servicioid">Noches:</label>
                            <p class="h6">{{ $detalle->equipaje }}</p>
                        </div>
                        <div class="mb-3 col-md-2" >
                            <label class="form-label" for="servicioid">Check inn:</label>
                            <p class="h6">{{ date('d-m-Y H:i', strtotime($detalle->fecha_viaje)) }}</p>
                        </div>
                        <div class="mb-3 col-md-2" >
                            <label class="form-label" for="servicioid">Check out:</label>
                            <p class="h6">{{ date('d-m-Y H:i', strtotime($detalle->fecha_viajefin)) }}</p>
                        </div>
                        <div class="mb-3 col-md-3" >
                            <label class="form-label" for="comentario{{$i}}">Descripcion:</label>
                            <input type="text" class="form-control" name="comentario{{$i}}" id="comentario{{$i}}" wire:model.defer="comentario.{{$i}}">
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
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cuerpo{{$i}}">
                                                @foreach($pasajeros[$i] as $j => $pasajero)
                                                    <tr wire:key="pasajero-{{ $i }}-{{ $pasajero['id'] ?? $j }}">                                                        <!-- Accede a las propiedades de la colección -->
                                                        <td>{{ $pasajero['nombreCompleto'] ?? '' }}</td>
                                                        <td>{{ $pasajero['tipo_documento'] ?? '' }} {{ $pasajero['num_documento'] }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($pasajero['nacimiento'] ?? '')->diffInYears(\Carbon\Carbon::now()) }}</td>
                                                        <td>{{ $pasajero['celular'] ?? '' }}</td>
                                                        <td>{{ $pasajero['pais'] ?? '' }}</td>
                                                        <td>{{ $pasajero['comentario'] ?? '' }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-icon btn-danger me-1 d-none d-sm-flex" wire:click="remove({{ $i }}, {{ $j }})">
                                                                <i class="fe fe-trash"></i>
                                                            </button>
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
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-md-3">
        <button type="button" class="btn btn-primary mt-4 m-2" wire:click="registerNotificar" 
        wire:loading.attr="disabled">
            <span wire:loading wire:target="register">Guardando...</span>
            <span wire:loading.remove wire:target="register">Guardar y Notificar</span>
        </button>
    </div>
    <div class="col-md-3">
        <button type="button" class="btn btn-info mt-4 m-2" wire:click="register" 
        wire:loading.attr="disabled">
            <span wire:loading wire:target="register">Guardando...</span>
            <span wire:loading.remove wire:target="register">Guardar</span>
        </button>
    </div>
</div>
@push('custom-scripts')
<script>
Livewire.on('abrirLink', function (mensaje) {
    window.open(mensaje,"_blank");
});
</script>
@endpush

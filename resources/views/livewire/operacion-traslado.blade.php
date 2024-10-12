<div class="row">
    <div class="col-md-12">
        @if($editar == 0)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-3" >
                            <label class="form-label" for="fecha">Fecha:</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" wire:model.defer="fecha">
                            @error('fecha')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3" >
                            <label class="form-label" for="ciudadId">Ciudad:</label>
                            <div wire:ignore>
                                <select class="form-control" name="ciudadId" id="ciudadId" wire:model.defer="ciudadId">
                                    <option value="">TODOS</option>
                                    @foreach($ciudades as $ciudad)
                                        <option value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ciudadId')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3">
                            <button type="button" class="btn btn-primary mt-4 mb-2 mb-md-0 " wire:click="buscarOperaciones(1)">
                                <i class="fa fa-search"></i><b> &nbsp; Buscar</b>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div id="cuerpoServicio" wire:sortable="actualizarOrden">
            @foreach($servicios ?? [] as $i => $servicio)
                <div class="card" id="{{$i}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-3" >
                                <label class="form-label" for="servicioid">Servicio:</label>
                                <p class="h6">{{$servicio['servicio']}}</p>
                            </div>
                            <div class="mb-3 col-md-1" >
                                <label class="form-label" for="servicioid">Pax:</label>
                                <p class="h6">{{$servicio['pax']}}</p>
                            </div>
                            <div class="mb-3 col-md-3" >
                                <label class="form-label" for="servicioid">Nombre y Apellidos:</label>
                                <p class="h6">{{$servicio['nombreApellido']}}</p>
                            </div>
                            <div class="mb-3 col-md-2" >
                                <label class="form-label" for="servicioid">Hotel</label>
                                <a class="cursor-pointer" wire:click="agregarHotel({{$servicio['id']}})">
                                    {{isset($servicio['hotel']) && $servicio['hotel'] != ' ' ? $servicio['hotel'] : '+'}}
                                </a>
                            </div>
                            <div class="mb-3 col-md-2" >
                                <label class="form-label" for="servicioid">Comentarios</label>
                                <p class="h6">{{$servicio['comentarios']}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-3" >
                                <label class="form-label" for="proveedorId{{$i}}">Proveedor:</label>
                                <div wire:ignore>
                                    <select class="form-control" name="proveedorId" id="proveedorId{{$i}}" wire:model.defer="proveedorId.{{$i}}">
                                        <option value="">SELECCIONE</option>
                                        @foreach($proveedores as $proveedor)
                                            <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('proveedorId.'.$i)
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-3" >
                                <label class="form-label" for="precioDetalle{{$i}}">Precio:</label>
                                <div class="input-group">
                                    <span class="input-group-text pe-cursor" wire:click="cambiarTipoMoneda({{$i}})">
                                        {{$monedaId[$i] == 2 ? '$' : 'S/'}}
                                    </span>
                                    <input type="number" step="0.01" class="form-control" name="precioDetalle{{$i}}" id="precioDetalle{{$i}}" wire:model.defer="precioDetalle.{{$i}}">
                                </div>
                                @error('precioDetalle.'.$i)
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-3" >
                                <label class="form-label" for="recojo{{$i}}">Hora Recojo:</label>
                                <input type="time" class="form-control" name="recojo" id="recojo{{$i}}" wire:model.defer="recojo.{{$i}}">
                                @error('recojo.'.$i)
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="observaciones{{$i}}" class="form-label">Observaciones:</label>
                                <textarea class="form-control" name="observaciones{{$i}}" id="observaciones{{$i}}" rows="2" wire:model.defer="observaciones.{{$i}}"></textarea>
                                @error('observaciones.'.$i)
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-3">
        <button type="button" class="btn btn-primary mt-4 m-2" wire:click="register" 
        wire:loading.attr="disabled">
            <span wire:loading wire:target="register">Guardando...</span>
            <span wire:loading.remove wire:target="register">Guardar</span>
        </button>
    </div>

    <!-- Modal Hotel -->
    <div class="modal fade" id="modalHotel" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Agregar Hotel / Recojo</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="hotelId" class="form-label">Buscar Hotel:</label>
                            <div class="d-flex">
                                <div wire:ignore style="flex-grow: 1;"> <!-- Asegura que el select ocupe todo el ancho -->
                                    <select class="form-control" name="hotelId" id="hotelId" wire:model="hotelId">
                                        <option value="">SELECCIONE</option>
                                        @foreach($proveedoresHoteles as $proveedor)
                                            <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="input-group-text" style="cursor: pointer;" wire:click="cambiarhotelNuevo()">
                                    {{$hotelNuevo == 0 ? '+' : '-'}}
                                </span>
                            </div>
                            @error('hotelId')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @if($hotelNuevo == 1)
                        <div class="row">
                            <div class="col-md-12">
                                <label for="nuevoHotel" class="form-label">Nuevo Hotel:</label>
                                <input type="text" name="nuevoHotel" id="nuevoHotel" class="form-control" wire:model.defer="nuevoHotel" >
                                @error('nuevoHotel')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class=" col-md-4">
                            <label for="direccionHotel" class="form-label">Dirección:</label>
                            <input type="text" name="direccionHotel" id="direccionHotel" class="form-control" wire:model.defer="direccionHotel" >
                            @error('direccionHotel')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-4">
                            <label for="celularHotel" class="form-label">Celular:</label>
                            <input type="text" name="celularHotel" id="celularHotel" class="form-control" wire:model.defer="celularHotel" >
                            @error('celularHotel')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-5 justify-content-end col-md-2">
                            <div class="checkbox">
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="todosHotel" name="todosHotel" wire:model.defer="todosHotel">
                                    <label for="todosHotel" class="custom-control-label mt-1">Todos Cusco</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-5 justify-content-end col-md-2">
                            <div class="checkbox">
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="todosHotelLima" name="todosHotelLima" wire:model.defer="todosHotelLima">
                                    <label for="todosHotelLima" class="custom-control-label mt-1">Todos Lima</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button aria-label="Close" class="btn btn-danger me-2" data-bs-dismiss="modal" type="button">Cancelar</button>
                    <button type="button" wire:click="guardarHotel()" class="btn btn-primary me-2" tabindex="4" id="botonGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('custom-scripts')
@foreach($servicios ?? [] as $i => $servicio)
<script>
    $('#proveedorId{{$i}}').val("{{$proveedorId[$i] ?? null}}").select2({
        width: '100%'
    }).on('change', function (e) {
        @this.set('proveedorId.{{$i}}', this.value);
    });
</script>
@endforeach
<script>
document.addEventListener('livewire:load', function () {
    var simpleList = document.querySelector("#cuerpoServicio");
    new Sortable(simpleList, {
        animation: 150,
        ghostClass: 'bg-light',
        onEnd: function(evt) {
            var ordenElementos = Array.from(simpleList.children).map(function(elemento) {
                return elemento.id; // Supongamos que los elementos tienen una ID única
            });

            Livewire.emit('actualizarOrdenServicios', ordenElementos); // Llama al método de Livewire para actualizar el orden
        }
    });

    $('#ciudadId').select2({
        width: '100%'
    }).on('change', function (e) {
        @this.set('ciudadId', this.value);
    });

    // Inicialización inicial
    inicializarSelect2();

    // Escuchar eventos de Livewire para reinicializar Select2 después de la actualización
    Livewire.hook('message.processed', (message, component) => {
        inicializarSelect2();
    });

});

function inicializarSelect2() {
    $('#hotelId').select2({
        dropdownParent: $("#modalHotel"),
        width: '100%',            
    }).on('change', function (e) {
        @this.set('hotelId', this.value);
    });
}

Livewire.on('modalHotel', function(id) {
    $('#modalHotel').modal('show');

    $('#hotelId').select2({
        dropdownParent: $("#modalHotel"),
        width: '100%',            
    }).val(id).trigger('change.select2');
});

Livewire.on('cerrarModalHotel', function(id) {
    $('#modalHotel').modal('hide');
});

Livewire.on('select2', function (id) {
    $('#proveedorId'+id).select2({
        width: '100%'
    }).on('change', function (e) {
        @this.set('proveedorId.'+id, this.value);
    });
});
</script>
@endpush

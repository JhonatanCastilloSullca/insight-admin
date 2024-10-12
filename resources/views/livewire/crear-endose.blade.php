<div class="row">

    <div class="col-md-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
            {{ $message }}
            <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-3">
                        <label for="fecha" class="form-label">Fecha:</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" wire:model="fecha">
                        @error('fecha')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-3" >
                        <div wire:ignore>
                            <label class="form-label" for="servicioid">Servicio:</label>
                            <select class="form-select js-states" id="servicioid" name="servicioid" data-width="100%" wire:model="servicioid">
                            </select>
                        </div>
                        @error('servicioid')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-3" >
                        <div wire:ignore>
                            <label class="form-label" for="agenciaId">Agencia:</label>
                            <select class="form-select js-states" id="agenciaId" name="agenciaId" data-width="100%" wire:model="agenciaId">
                                <option value="">SELECCIONE</option>
                                @foreach($agencias as $agencia)
                                    <option value="{{$agencia->id}}">{{$agencia->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('agenciaId')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="form-label" for="precio">Precio Unitario:</label>
                        <div class="input-group">
                            <span class="input-group-text pe-cursor" wire:click="cambiarTipoMoneda">
                                {{$monedaPrecio == 2 ? '$' : 'S/'}}
                            </span>
                            <input text="number" step="0.01" class="form-control" name="precio" id="precio" wire:model="precio">
                        </div>                            
                        @error('precio')
                            <span class="error-message" style="color:red">Campo Obligaotrio</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="observacion" class="form-label">Observación:</label>
                        <textarea class="form-control" name="observacion" id="observacion" rows="2" wire:model.defer="observacion"></textarea>
                        @error('observacion')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover mb-0 tabla-reducida" >
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Servicio</th>
                                                <th>Pasajeros (Edad)</th>
                                                <th>Nacionalidad</th>
                                                <th>Telefono</th>
                                                <th>Hotel</th>
                                                <th>Tipo</th>
                                                <th>Incluyes</th>
                                                <th>Total Precio</th>
                                                <th>Ingresos</th>
                                                <th>Hora Recojo</th>
                                                <th>Observaciones</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cuerpo" wire:sortable="actualizarOrden">
                                        @foreach ($detalles as $i => $detalle)
                                            <tr id="{{$i}}">
                                                <td>
                                                    <a class="btn btn-warning btn-icon" href="{{route('reserva.voucheroficina', $detalle['reservaid'])}}" target="_blank">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                                <td>{{ $detalle['servicio'] }}</td>
                                                <td class="no-wrap">
                                                    <div>
                                                        @foreach($detalle['pasajeros'] as $pasajero)
                                                            {{ $pasajero['nombreCompleto'] }} {!! $pasajero['cumpleaños'] ? '<span class="mdi mdi-cake-variant"></span>' : '' !!} ({{ $pasajero['edad'] }})
                                                            @if(!$loop->last)
                                                                <br>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="no-wrap">
                                                    @foreach($detalle['pasajeros'] as $pasajero)
                                                        {{$pasajero['pais']}}
                                                        @if(!$loop->last)
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ $detalle['celular'] }}</td>
                                                <td>
                                                    <a class="cursor-pointer" wire:click="agregarHotel({{$detalle['id']}})">
                                                        {{isset($detalle['hotel']) && $detalle['hotel'] != ' ' ? $detalle['hotel'] : '+'}}
                                                    </a>
                                                </td>
                                                <td>{{ $detalle['tipo']==1 ? 'Privado' : 'Compartido' }}</td>
                                                <td>
                                                    @foreach($detalle['incluyes']  as $incluye)
                                                        @if($loop->last)
                                                        - {{$incluye['servicio']}}
                                                        @else
                                                        - {{$incluye['servicio']}} <br>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ $detalle['moneda'] }} {{ $detalle['precio'] }}</td>
                                                <td>
                                                    <input type="number" min="0" step="0.01" class="form-control" name="ingresos" wire:model.lazy="ingresos.{{$i}}">
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control" name="horarios" wire:model.defer="horarios.{{$i}}"  />
                                                    @error('horarios.'.$i)
                                                        <span class="error-message" style="color:red">Campo Obligaotrio</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <textarea name="observaciones{{$i}}" id="observaciones{{$i}}" wire:model.defer="observaciones.{{$i}}" rows="2"></textarea>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-icon btn-danger me-1 d-none d-sm-flex" wire:click.prevent="remove({{$i}})">
                                                        <i class="fe fe-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><b>Cantidad Pax.</b></td>
                                                <td>{{$paxTotal}}</td>
                                                <td><b>Ingresos</b></td>
                                                <td>{{$totalIngresos}}</td>
                                                <td><b>Total S/</b></td>
                                                <td>{{$totalSoles}}</td>
                                                <td><b>Total $</b></td>
                                                <td>{{$totalDolares}}</td>
                                                <td><b>Total Grupo Soles</b></td>
                                                <td>{{$precioTipoCambio}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        @if($this->fecha && $this->servicioid)
                            <button type="button" class="btn btn-primary m-2 mt-4" wire:click="register">Guardar</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
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
                                        @foreach($proveedores as $proveedor)
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
<script>
document.addEventListener('livewire:load', function () {
    // Inicialización inicial
    inicializarSelect2();

    // Escuchar el evento emitido por Livewire
    Livewire.on('agregarServicios', function(id, datos) {
        $('#servicioid').select2({
            data: datos,
            width: '100%',
        }).val(id).trigger('change'); // Establecer el valor seleccionado
    });

    // Escuchar eventos de Livewire para reinicializar Select2 después de la actualización
    Livewire.hook('message.processed', (message, component) => {
        inicializarSelect2();
    });
});

function inicializarSelect2() {
    // Inicializa Select2 para hotelId
    $('#hotelId').select2({
        dropdownParent: $("#modalHotel"),
        width: '100%',
    }).on('change', function (e) {
        @this.set('hotelId', this.value);
    });

    // Inicializa Select2 para servicioid
    $('#servicioid').select2().on('change', function (e) {
        @this.set('servicioid', this.value);
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

var simpleList = document.querySelector("#cuerpo");
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


$('#agenciaId').val('{{$agenciaId ?? null}}').select2();
$('#agenciaId').on('change',function(){
    @this.set('agenciaId',this.value);
});
</script>
@endpush
<div class="main-container container-fluid">
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Crear Operacion Otros</span>
        </div>
        {{-- <div class="justify-content-center mt-2">
            @if($detalles)
                <a target="_blank" wire:click="plantillaConsetur()">
                    <button type="button" class="btn btn-info mb-2 mb-md-0 ">
                        <i data-bs-toggle="tooltip" data-bs-title="Consetur" class="fa fa-plus-circle"></i><b> &nbsp; Plantilla Consetur</b>
                    </button>
                </a>
            @endif
        </div> --}}
    </div>
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
                        <div class="mb-3 col-md-3" >
                            <div wire:ignore>
                                <label class="form-label" for="servicioid">Servicio:</label>
                                <select class="form-select js-states" id="servicioid" name="servicioid" data-width="100%" wire:model="servicioid">
                                    <option value="">SELECCIONE</option>
                                    @foreach($servicios as $servicio)
                                        <option value="{{$servicio->id}}">{{$servicio->titulo}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('servicioid')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="fecha" class="form-label">Fecha:</label>
                            <input type="date" name="fecha" id="fecha" class="form-control" wire:model="fecha">
                            @error('fecha')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="observacion" class="form-label">Observación:</label>
                            <input type="text" name="observacion" id="observacion" class="form-control" wire:model.defer="observacion" >
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
                                                    <th>Servicio</th>
                                                    <th>Pasajeros (Edad)</th>
                                                    <th>Nacionalidad</th>
                                                    <th>Telefono</th>
                                                    <th>Hotel</th>
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
                            <button type="button" class="btn btn-primary m-2 mt-4" wire:click="register">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('custom-scripts')
<script>
document.addEventListener('livewire:load', function () {
    $('#ciudadId').select2({
        width: '100%'
    }).on('change', function (e) {
        @this.set('ciudadId', this.value);
    });

    inicializarSelect2();

    Livewire.hook('message.processed', (message, component) => {
        inicializarSelect2();
    });
});

function inicializarSelect2() {
    $('#servicioid').select2().on('change', function (e) {
        @this.set('servicioid', this.value);
    });
}
</script>
@endpush
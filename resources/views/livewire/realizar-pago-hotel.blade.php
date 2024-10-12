<div class="row">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif
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
        @foreach($detalles as $i => $detalle)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-3" >
                            <label class="form-label" for="servicioid">Proveedor:</label>
                            <p class="h6">{{$detalle['proveedor_nombre']}}</p>
                        </div>
                        <div class="mb-3 col-md-2" >
                            <label class="form-label" for="servicioid">Total Servicios:</label>
                            <p class="h6">{{$detalle['abreviatura']}} {{ $detalle['total_precio'] }}</p>
                        </div>
                        <div class="mb-3 col-md-2" >
                            <label class="form-label" for="servicioid">Total acuenta:</label>
                            <p class="h6">{{$detalle['abreviatura']}} {{ $detalle['total_acuenta'] }}</p>
                        </div>
                        <div class="mb-3 col-md-2" >
                            <label class="form-label" for="servicioid">Total a Pagar:</label>
                            <p class="h6">{{$detalle['abreviatura']}} {{ $detalle['total_pagar'] }}</p>
                        </div>
                        <div class="mb-3 col-md-3" >
                            <button type="button" class="btn btn-primary mt-3 me-2" wire:click="agregarPago({{ $detalle['proveedor_id'] }},{{ $detalle['moneda_id'] }},{{$detalle['total_pagar']}})">    
                                + Pagar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-md-3">
        <a href="{{route('calendario.hotel')}}">
            <button type="button" class="btn btn-danger m-2">Regresar</button>
        </a>
    </div>
    
    <!-- Large Modal -->
    <div class="modal fade" id="modalPago" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Agregar Pago</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class=" col-md-6">
                            <label for="medio" class="form-label">Medio de Pago:</label>
                            <div wire:ignore>
                                <select class="form-select js-states" id="medio" name="medio" data-width="100%" wire:model.defer="medio">
                                </select>
                            </div>
                            @error('medio')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-6">
                            <label for="total" class="form-label">Total</label>
                            <input type="number" name="total" id="total" class="form-control" wire:model.defer="total" >
                            @error('total')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-6" >
                            <label class="form-label" for="imagen">Documento Subir:</label>
                            <input class="form-control" type="file" id="formFile" name="imagen" wire:model.defer="imagen">
                            @error('imagen')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-6">
                            <label for="num_operacion" class="form-label">Numero Operacion</label>
                            <input type="text" name="num_operacion" id="num_operacion" class="form-control" wire:model.defer="num_operacion" >
                            @error('num_operacion')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-12">
                            <label for="comentarios" class="form-label">Comentarios:</label>
                            <textarea class="form-control" name="comentarios" id="comentarios" rows="2" wire:model.defer="comentarios"></textarea>
                            @error('comentarios')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button aria-label="Close" class="btn btn-danger me-2" data-bs-dismiss="modal" type="button">Cancelar</button>
                    <button type="button" wire:click="guardarPago()" class="btn btn-primary me-2" tabindex="4" id="botonGuardar" wire:loading.attr="disabled">
                        <span wire:loading wire:target="register">Guardando...</span>
                        <span wire:loading.remove wire:target="register">Guardar</span>
                    </button>
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

    // Escuchar eventos de Livewire para reinicializar Select2 después de la actualización
    Livewire.hook('message.processed', (message, component) => {
        inicializarSelect2();
    });
});

function inicializarSelect2() {
    // Inicializar todos los Select2 aquí
    $('#medio').select2({
        width: '100%',
        dropdownParent: $("#modalPago"),
    }).on('change', function (e) {
        @this.set('medio', this.value);
    });
}

Livewire.on('abrir-modal-pago', function (datos) {
    $('#modalPago').modal('show');
    document.getElementById('formFile').value = '';
    $('#medio').empty().select2({
        data: datos,
    });
});

Livewire.on('abrirLink', function (mensaje) {
    window.open(mensaje,"_blank");
});
</script>
@endpush

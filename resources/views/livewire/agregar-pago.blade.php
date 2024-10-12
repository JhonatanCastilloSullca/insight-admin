<div class="modal-body">
    <div class="row">
        <div class="mb-3 col-md-6">
            <label class="form-label" for="monedaId">Moneda</label>
            <div wire:ignore>
                <select class="form-select" id="monedaId" name="monedaId" data-width="100%" wire:model.defer="monedaId">
                    <option value="">SELECCCIONE</option>
                    @foreach($reserva->totalesConSaldo as $total)
                        <option value="{{$total->moneda->id}}" >{{$total->moneda->nombre}}</option>
                    @endforeach
                </select>
            </div>
            @error('monedaId')
                <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label" for="medioId">Medios</label>
            <div wire:ignore>
                <select class="form-select" id="medioId" name="medioId" data-width="100%" wire:model="medioId">
                </select>
            </div>
            @error('medioId')
                <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <label for="monto" class="form-label">Monto Neto:</label>
            <input type="number" name="monto" id="monto" class="form-control"  wire:model.defer="monto">
            @error('monto')
                <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <label for="monto_porcentaje" class="form-label">Monto Porcentaje:</label>
            <input type="number" name="monto_porcentaje" id="monto_porcentaje" class="form-control"  wire:model.defer="monto_porcentaje">
            @error('monto_porcentaje')
                <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 col-md-4">
            <label for="num_operacion" class="form-label">Nº operacion:</label>
            <input type="text" name="num_operacion" id="num_operacion" class="form-control"  wire:model.defer="num_operacion">
            @error('num_operacion')
                <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
        <div class=" col-md-12" >
            <div wire:ignore>
                <label class="form-label" for="comentario">Comentarios:</label>
                <textarea class="form-control" name="comentario" id="comentario" rows="2" wire:model.defer="comentario"></textarea>
            </div>
            @error('comentario')
                <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button aria-label="Close" class="btn btn-danger me-2" data-bs-dismiss="modal" type="button">Cancelar</button>
        <button type="button" class="btn btn-primary m-2"
                wire:click="agregarPago"
                wire:loading.attr="disabled"
                @disabled($isSaving )>
            <span wire:loading wire:target="agregarPago">Guardando...</span>
            <span wire:loading.remove wire:target="agregarPago">Guardar Pago</span>
        </button> 
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
    $('#medioId').select2({
        width: '100%'
    }).on('change', function (e) {
        @this.set('medioId', this.value);
    });

    $('#monedaId').select2({
        width: '100%'
    }).on('change', function (e) {
        @this.set('monedaId', this.value);
    });

}

Livewire.on('LlenarMedio', function (id,datos) {
    $('#medioId').empty().val(id).select2({
        data: datos,
    });
});
</script>
@endpush
<div class="row">

    <div class="col-md-12">
        @foreach($detalles as $i => $detalle)
            <div class="card" wire:key="detalle-{{ $i }}">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-3" >
                            <label class="form-label" for="servicio">Servicio:</label>
                            <div wire:ignore>
                                <select class="form-control" name="servicio" id="servicio{{$i}}" wire:model.defer="servicio.{{$i}}">
                                    <option value="">SELECCIONE</option>
                                    @foreach($hoteles as $hotel)
                                        <option value="{{$hotel->id}}">{{$hotel->proveedor?->nombre}} {{$hotel->proveedor?->ubicacion?->nombre}} {{$hotel->titulo}}</option>
                                    @endforeach
                                </select>
                            </div>
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
document.addEventListener('livewire:load', function () {
    function initializeSelect() {
        $('[id^="servicio"]').each(function() {
            const id = $(this).attr('id').replace('servicio', '');
            $(this).select2();

            // Sincronizar con el modelo de Livewire
            $(this).on('change', function (e) {
                @this.set('servicio.' + id, $(this).val());
            });
        });
    }

    // Initialize Select2 on page load
    initializeSelect();

    // Initialize Select2 after Livewire updates the DOM
    Livewire.hook('message.processed', (message, component) => {
        initializeSelect();
    });

    
});
</script>
@endpush

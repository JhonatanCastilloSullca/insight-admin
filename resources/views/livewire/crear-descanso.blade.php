<div class="row mb-5">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <span class="h4">Hora de Ingreso y Salida Descanso</span>
            <button type="button" class="btn btn-primary me-2" wire:click="agregar">
                +
            </button>
        </div>
    </div>
    @for($i=0;$i<$cont;$i++)
        <div class="mb-3 col-md-3">
            <label for="hora_inicio_descanso" class="form-label">Hora Ingreso:</label>
            <input type="time" name="hora_inicio_descanso[]"  id="hora_inicio_descanso{{$i}}" class="form-control" value="{{old('hora_inicio_descanso')}}" wire:model.defer="hora_inicio_descanso.{{$i}}" >
            @error('hora_inicio_descanso')
            <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 col-md-3">
            <label for="hora_fin_descanso" class="form-label">Hora Salida:</label>
            <input type="time" name="hora_fin_descanso[]"  id="hora_fin_descanso{{$i}}" class="form-control" value="{{old('hora_fin_descanso')}}" wire:model.defer="hora_fin_descanso.{{$i}}" >
            @error('hora_fin_descanso')
            <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 col-md-5">
            <label for="dias_descanso" class="form-label">Dias:</label>
            <div wire:ignore>
                <select class="js-example-basic-single form-select" id="dias_descanso{{$i}}" name="dias_descanso[{{$i}}][]" data-width="100%" multiple wire:model.defer="dias_descanso.{{$i}}" >
                    <option value="LUNES">LUNES</option>
                    <option value="MARTES">MARTES</option>
                    <option value="MIERCOLES">MIERCOLES</option>
                    <option value="JUEVES">JUEVES</option>
                    <option value="VIERNES">VIERNES</option>
                    <option value="SABADO">SABADO</option>
                    <option value="DOMINGO">DOMINGO</option>
                </select>
            </div>
            @error('dias_descanso')
                <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div> 
        <div class="col-md-1">
            <button type="button" class="btn btn-danger me-2 mt-4" wire:click="disminuir({{$i}})">
                -
            </button>
        </div>
    @endfor
</div>
@push('custom-scripts')
<script>
    document.addEventListener('livewire:load', function () {
        function initializeSelect() {

            $('[id^="dias_descanso"]').each(function() {
                const id = $(this).attr('id').replace('dias_descanso', '');
                $(this).select2();

                // Sincronizar con el modelo de Livewire
                $(this).on('change', function (e) {
                    @this.set('dias_descanso.' + id, $(this).val());
                });
            });
        }

        // Initialize Select2 on page load
        initializeSelect();

        // Initialize Select2 after Livewire updates the DOM
        Livewire.hook('message.processed', (message, component) => {
            initializeSelect();
        });

        Livewire.on('EncontrarServicio2', function (id) {
            $('#dias_descanso' + id).select2();
            $('#dias_descanso' + id).on('change', function (e) {
                @this.set('dias_descanso.' + id, $(this).val());
            });
        });

        Livewire.on('Actualizar2', function (items) {
            items.forEach(function(ids, index) {
                var selectElement = $('#dias_descanso' + index);
                if (selectElement.length) {
                    selectElement.val(ids).trigger('change');
                }
            });
        });
    });
</script>
@endpush

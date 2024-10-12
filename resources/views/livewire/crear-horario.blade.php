<div class="row mb-5">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <span class="h4">Hora de Ingreso y Salida Semanal</span>
            <button type="button" class="btn btn-primary me-2" wire:click="agregar">
                +
            </button>
        </div>
    </div>
    @for($i=0;$i<$cont;$i++)
        <div class="mb-3 col-md-3">
            <label for="hora_ingreso" class="form-label">Hora Ingreso:</label>
            <input type="time" name="hora_ingreso[]"  id="hora_ingreso{{$i}}" class="form-control" value="{{old('hora_ingreso')}}" wire:model.defer="hora_ingreso.{{$i}}">
            @error('hora_ingreso')
            <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 col-md-3">
            <label for="hora_salida" class="form-label">Hora Salida:</label>
            <input type="time" name="hora_salida[]"  id="hora_salida{{$i}}" class="form-control" value="{{old('hora_salida')}}" wire:model.defer="hora_salida.{{$i}}">
            @error('hora_salida')
            <span class="error-message" style="color:red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 col-md-5">
            <label for="dias_horarios" class="form-label">Dias:</label>
            <div wire:ignore>
                <select class="js-example-basic-single form-select" id="dias_horarios{{$i}}" name="dias_horarios[{{$i}}][]" data-width="100%" multiple wire:model.defer="dias_horarios.{{$i}}">
                    <option value="LUNES">LUNES</option>
                    <option value="MARTES">MARTES</option>
                    <option value="MIERCOLES">MIERCOLES</option>
                    <option value="JUEVES">JUEVES</option>
                    <option value="VIERNES">VIERNES</option>
                    <option value="SABADO">SABADO</option>
                    <option value="DOMINGO">DOMINGO</option>
                </select>
            </div>
            @error('dias_horarios')
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
        function initializeSelect2() {
            $('[id^="dias_horarios"]').each(function() {
                const id = $(this).attr('id').replace('dias_horarios', '');
                $(this).select2();

                // Sincronizar con el modelo de Livewire
                $(this).on('change', function (e) {
                    @this.set('dias_horarios.' + id, $(this).val());
                });
            });
        }

        // Initialize Select2 on page load
        initializeSelect2();

        // Initialize Select2 after Livewire updates the DOM
        Livewire.hook('message.processed', (message, component) => {
            initializeSelect2();
        });

        Livewire.on('EncontrarServicio', function (id) {
            $('#dias_horarios' + id).select2();
            $('#dias_horarios' + id).on('change', function (e) {
                @this.set('dias_horarios.' + id, $(this).val());
            });
        });

        Livewire.on('Actualizar', function (items) {
            items.forEach(function(ids, index) {
                var selectElement = $('#dias_horarios' + index);
                if (selectElement.length) {
                    selectElement.val(ids).trigger('change');
                }
            });
        });
    });
</script>
@endpush
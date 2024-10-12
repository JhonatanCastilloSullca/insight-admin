
<div class="row">
    <div class="{{$categoriaint != 4 ? 'col-md-6':'col-md-12'}}">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="titulo" class="form-label">{{($categoriaint == 1 ? 'Nombre de Servicio':($categoriaint == 2 ? 'Tipo de Habitacion':($categoriaint == 3 ? 'Vuelo' : 'Nombre')))}}</label>
                        <input type="text" name="titulo" id="titulo" class="form-control" wire:model.defer="titulo">
                        @error('titulo')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    @if ($categoriaint == 4)
                        <div class="mb-3 col-md-3" >
                            <div wire:ignore>
                                <label class="form-label" for="categoria_id">Categoria:</label>
                                <select class="form-select js-states" id="categoria_id" name="categoria_id" data-width="100%" wire:model.defer="categoria_id">
                                    <option value="">SELECCIONE</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 col-md-3" >
                            <div wire:ignore>
                                <label class="form-label" for="servicioIdAdicional">Servicio Operar:</label>
                                <select class="form-select js-states" id="servicioIdAdicional" name="servicioIdAdicional" data-width="100%" wire:model.defer="servicioIdAdicional">
                                    <option value="">SELECCIONE</option>
                                    @foreach($serviciosAdicionalesOtros as $servicio)
                                        <option value="{{$servicio->id}}">{{$servicio->titulo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 col-md-1">
                            <label for="subtitulo" class="form-label">Operar:</label>
                            <label class="custom-switch ps-0">
                            <input type="checkbox" name="custom-switch-checkbox4" class="custom-switch-input" wire:model="operar">
                                <span class="custom-switch-indicator custom-switch-indicator-lg custom-radius"></span>
                            </label>
                        </div>
                        <div class="mb-3 col-md-1">
                            <label for="subtitulo" class="form-label">Principal:</label>
                            <label class="custom-switch ps-0">
                            <input type="checkbox" name="custom-switch-checkbox4" class="custom-switch-input" wire:model="plantillaOperar">
                                <span class="custom-switch-indicator custom-switch-indicator-lg custom-radius"></span>
                            </label>
                        </div>
                        <div class="mb-3 col-md-4" >
                            <div wire:ignore>
                                <label class="form-label" for="hotelId">Proveedor:</label>
                                <select class="form-select js-states" id="hotelId" name="hotelId" data-width="100%" wire:model.defer="hotelId">
                                    <option value="">SELECCIONE</option>
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    @if ($categoriaint == 1)
                        <div class="mb-3 col-md-3" >
                            <div wire:ignore>
                                <label class="form-label" for="categoria_id">Categoria:</label>
                                <select class="form-select js-states" id="categoria_id" name="categoria_id" data-width="100%" wire:model.defer="categoria_id">
                                    <option value="">SELECCIONE</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 col-md-3" >
                            <div wire:ignore>
                                <label class="form-label" for="ciudadId">Ciudad:</label>
                                <select class="form-select js-states" id="ciudadId" name="ciudadId" data-width="100%" wire:model.defer="ciudadId">
                                    <option value="">SELECCIONE</option>
                                    @foreach($ubicaciones as $ciudad)
                                        <option value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 col-md-2">
                            <label for="subtitulo" class="form-label">Principal:</label>
                            <label class="custom-switch ps-0">
                            <input type="checkbox" name="custom-switch-checkbox4" class="custom-switch-input" wire:model="plantillaOperar">
                                <span class="custom-switch-indicator custom-switch-indicator-lg custom-radius"></span>
                            </label>
                        </div>
                        <div class="mb-3 col-md-4" >
                            <div wire:ignore>
                                <label class="form-label" for="servicioIdAdicional">Servicio Operar:</label>
                                <select class="form-select js-states" id="servicioIdAdicional" name="servicioIdAdicional" data-width="100%" wire:model.defer="servicioIdAdicional">
                                    <option value="">SELECCIONE</option>
                                    @foreach($serviciosAdicionales as $servicio)
                                        <option value="{{$servicio->id}}">{{$servicio->titulo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="duracion">Duracion: <span class="mb-0 tx-12 text-muted">(*Dias)</span></label>
                            <input type="number" step="1" name="duracion" id="duracion" class="form-control" wire:model.defer="duracion">

                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="horario">Horario: </label>
                            <input type="text" name="horario" id="horario" class="form-control" wire:model.defer="horario">

                        </div>
                        <div class="mb-3 col-md-4" wire:ignore>
                            <label class="form-label" for="colorPicker">Color: </label>
                            <input type="text" class="form-control" id="colorPicker" name="colorPicker">
                            <input type="hidden"  wire:model="colorpick">
                        </div>
                    @endif
                </div>
                @if ($categoriaint != 4)
                <div class="row">
                    <div class="mb-3 col-md-12" >
                        <div wire:ignore>
                            <label class="form-label" for="descripcion">Descripción:</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="10" wire:model.defer="descripcion"></textarea>
                        </div>

                    </div>
                </div>
                
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <div wire:ignore>
                            <label class="form-label" for="imagen">Imagen Principal:</label>
                            <input type="file" name="imagen"  id="imagen" class="form-control" wire:model='imagen'>
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        @if($imagen)
                            <a wire:click="verImagen('{{ $imagen->temporaryURL() }}')">
                                <img src="{{$imagen->temporaryURL()}}"  class="imagen">
                            </a>
                        @endif
                    </div>
                </div>
                @endif
                @if($categoriaint == 1)
                    <div class="row">
                        <div class="mb-3 col-md-12" >
                            <div wire:ignore>
                                <label class="form-label" for="plantillaOverview">Plantilla Overview:</label>
                                <textarea class="form-control" name="plantillaOverview" rows="5" wire:model.defer="plantillaOverview"></textarea>
                                <span>*NOTA: incluir {hora_recojo} para los horarios de recojo, {incluyes} para los incluyes y {noincluyes} para lo no incluyes.</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if ($categoriaint != 4)
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                @if($categoriaint == 1)
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h4">Itinerario</span>
                        <button type="button" class="btn btn-primary me-2" wire:click="agregarItinerario">
                            +
                        </button>
                    </div>
                @endif
                <div class="row">
                    @if($categoriaint == 2 || $categoriaint == 3)
                        <div class="mb-3 col-md-12" >
                            <div wire:ignore>
                                <label class="form-label" for="hotelId">{{$categoriaint == 2 ? 'Hotel:':'Vuelo:'}}</label>
                                <select class="form-select js-states" id="hotelId" name="hotelId" data-width="100%" wire:model.defer="hotelId">
                                    <option value="">SELECCIONE</option>
                                    @foreach($hoteles as $hotel)
                                        <option value="{{$hotel->id}}">{{$hotel->nombre}} {{$hotel->ubicacion?->nombre}} {{$categoriaint == 2 ? $hotel->categoria?->nombre:'' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                </div>
                @for($k=0; $k < $contDias; $k++)
                    @if($categoriaint == 1)
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="h5">Dia {{$k+1}}</span>
                            @if($k > 0)
                                <button type="button" class="btn btn-danger me-2" wire:click="disminuirDias({{$k}})">
                                    -
                                </button>
                            @endif
                        </div>
                    @endif
                    <div class="row">
                        <div class="mb-1 col-md-12">
                            <div wire:ignore>
                                <label class="form-label" for="incluye{{$k}}">Incluye:</label>
                                <select class="form-select" id="incluye{{$k}}" name="incluye" multiple data-width="100%"  wire:model.defer="incluye.{{$k}}">
                                    <option value="">SELECCIONE</option>
                                    @foreach($incluyes as $incluye)
                                        <option value="{{$incluye->id}}">{{$incluye->titulo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-1 col-md-12" >
                            <div wire:ignore>
                                <label class="form-label" for="no_incluye{{$k}}">No Incluye:</label>
                                <select class="form-select" id="no_incluye{{$k}}" name="no_incluye" multiple data-width="100%"  wire:model.defer="no_incluye.{{$k}}">
                                    <option value="">SELECCIONE</option>
                                    @foreach($incluyes as $incluye)
                                        <option value="{{$incluye->id}}">{{$incluye->titulo}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    {{-- <div class="row">
                        @if ($categoriaint == 1)
                        <div class="mb-3 col-md-12" >
                            <div wire:ignore>
                                <label class="form-label" for="condicion">Condiciones:</label>
                                <textarea class="form-control" name="condicion" id="condicion" rows="3"></textarea>
                            </div>

                        </div>
                        @endif
                    </div> --}}

                    
                    <div class="row">
                        <div class="mb-1 col-md-10">
                            <div wire:ignore>
                                <label class="form-label" for="template{{$k}}">Template Principal:</label>
                                <input type="file" name="template"  id="template{{$k}}" class="form-control" wire:model='template.{{$k}}'>
                            </div>
                        </div>
                        <div class="mb-3 col-md-2">
                            @if($template[$k])
                                <a wire:click="verImagen('{{ $template[$k]->temporaryURL() }}')">
                                    <img src="{{$template[$k]->temporaryURL()}}"  class="template">
                                </a>
                            @endif
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
    @endif
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="h4">Tarifa</span>
                    <button type="button" class="btn btn-primary me-2" wire:click="agregarPrecio">
                        +
                    </button>
                </div>
                <div class="row">
                    @for($i=0; $i < $contPrecio; $i++)
                        <div class="mb-3 col-md-{{$categoriaint == 1 ? '2':'3'}}">
                            <label class="form-label" for="nombrePrecio{{$i}}">Tarifa: </label>
                            <div wire:ignore>
                                <select class="js-example-basic-single form-select" id="nombrePrecio{{$i}}" name="nombrePrecio" data-width="100%"  wire:model.defer="nombrePrecio.{{$i}}" >
                                    @foreach($precios as $precio)
                                        <option value="{{$precio->id}}">{{$precio->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>                      
                        </div>
                        <div class="col-md-{{$categoriaint == 1 ? '4':'2'}}">
                            <div class="row">
                                <div class="mb-3 col-md-{{$categoriaint == 1 ? '4':'12'}}">
                                    <label class="form-label" for="monedaPrecio{{$i}}">Moneda: </label>
                                    <div wire:ignore>
                                        <select class="js-example-basic-single form-select" id="monedaPrecio{{$i}}" name="monedaPrecio" data-width="100%"  wire:model.defer="monedaPrecio.{{$i}}" >
                                            <option value="1">Soles</option>
                                            <option value="2">Dolares</option>
                                        </select>
                                    </div>                        
                                </div>
                                @if($categoriaint == 1 )
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="privadoTarifa{{$i}}">Privado: </label>
                                        <div wire:ignore>
                                            <select class="js-example-basic-single form-select" id="privadoTarifa{{$i}}" name="privadoTarifa" data-width="100%"  wire:model.defer="privadoTarifa.{{$i}}" >
                                                <option value="1">Privado</option>
                                                <option value="0">Compartido</option>
                                            </select>
                                        </div>                        
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="nacionalidadTarifa{{$i}}">Nacionalidad: </label>
                                        <div wire:ignore>
                                            <select class="js-example-basic-single form-select" id="nacionalidadTarifa{{$i}}" name="nacionalidadTarifa" data-width="100%"  wire:model.defer="nacionalidadTarifa.{{$i}}" >
                                                <option value="1">Nacional</option>
                                                <option value="0">Extranjero</option>
                                            </select>
                                        </div>                        
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if($categoriaint == 1 )
                            <div class="mb-3 col-md-1">
                                <label class="form-label" for="paxTarifa{{$i}}">Pax: </label>
                                <input type="number"  name="paxTarifa" id="paxTarifa{{$i}}" class="form-control" wire:model.defer="paxTarifa.{{$i}}">
                            </div>
                        @endif
                        <div class="mb-3 col-md-{{$categoriaint == 1 ? '2':'3'}}">
                            <label class="form-label" for="precioTarifa{{$i}}">Precio: </label>
                            <input type="number"  name="precioTarifa" id="precioTarifa{{$i}}" class="form-control" wire:model.defer="precioTarifa.{{$i}}">
                        </div>
                        <div class="mb-3 col-md-{{$categoriaint == 1 ? '2':'3'}}">
                            <label class="form-label" for="precioMinTarifa{{$i}}">Precio Minimo: </label>
                            <input type="number"  name="precioMinTarifa" id="precioMinTarifa{{$i}}" class="form-control" wire:model.defer="precioMinTarifa.{{$i}}">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger me-2 mt-4" wire:click="disminuir({{$i}})">
                                -
                            </button>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary m-2" wire:click="register">Guardar</button>
    @error('titulo')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    @error('subtitulo')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    @error('categoria_id')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    @error('ubicacion_id')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    @error('duracion')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    @error('horario')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    @error('descuento')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    @error('precio_neto_soles')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    @error('precio_min_soles')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    @error('precio_neto_dolar')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    @error('precio_min_dolar')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    @error('descripcion')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    @error('imagen')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    @error('incluye')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    @error('no_incluye')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    @error('condicion')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    <div class="modal fade" id="modalImagen" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <img src="{{$imagenModal}}"  style="max-height: 700px; width: auto;">
        </div>
    </div>
</div>
<!-- /Container -->
@push('custom-scripts')
<script>

$(document).ready(function () {
    $('#categoria_id').select2();

    $('#categoria_id').on('change',function(){
        @this.set('categoria_id',this.value);
    });

    $('#servicioIdAdicional').select2();

    $('#servicioIdAdicional').on('change',function(){
        @this.set('servicioIdAdicional',this.value);
    });

    $('#hotelId').select2();

    $('#hotelId').on('change',function(){
        @this.set('hotelId',this.value);
    });


    $('#ciudadId').select2();

    $('#ciudadId').on('change',function(){
        @this.set('ciudadId',this.value);
    });
});

$('#categoria_id').select2({
    placeholder: "Seleccione..."
});
$('#categoria_id').on('change',function(){
    @this.set('categoria_id',this.value);
});

$('#incluye0').select2({
    placeholder: "Seleccione..."
});

$('#incluye0').on('change', function(e) {
    let data = $(this).select2('data');
    let values = data.map(function(item) { return item.id; });
    @this.set('incluye.0', values);
});

$('#no_incluye0').select2({
    placeholder: "Seleccione..."
});

$('#no_incluye0').on('change', function(e) {
    let data = $(this).select2('data');
    let values = data.map(function(item) { return item.id; });
    @this.set('no_incluye.0', values);
});



$('#descripcion').summernote();
$('#descripcion').on('summernote.change', function(we, contents, $editable) {
    @this.set('descripcion', contents);
});

$('#condicion').summernote();
$('#condicion').on('summernote.change', function(we, contents, $editable) {
    @this.set('condicion', contents);
});

Livewire.on('abrirImagen', function () {
    $('#modalImagen').modal('show');
});

FilePond.registerPlugin(FilePondPluginFileValidateType);

// Get a reference to the file input element
const inputElement = document.querySelector('#imagen');
const inputElement2 = document.querySelector('#template0');


// Create a FilePond instance
const pond = FilePond.create(inputElement, {
    fileValidateTypeDetectType: (source, type) =>
        new Promise((resolve, reject) => {
            if (source.name.toLowerCase().indexOf('.heic') !== -1) {
                resolve('image/heic')
            } else {
                resolve(type)
            }
        }),
    }).setOptions({
    server:{
        process:(fieldName,file,metadata,load,error,progress,abort,transfer,options)=>{
            if (file.type == 'image/heic') {
                const formData = new FormData();
                formData.append(fieldName, file, file.name + '.jpg'); // Cambia la extensión a .jpg

                // Envía el archivo convertido al servidor utilizando Livewire
                @this.upload('imagen',formData,load,error,progress)
            } else {
                // Si no es .heic, simplemente envía el archivo al servidor sin conversión
                @this.upload('imagen',file,load,error,progress)
            }
        },

        revert:(filename,load)=>{
            @this.removeUpload('imagen',filename,load)
        },

    },
});
const pond2 = FilePond.create(inputElement2, {
    fileValidateTypeDetectType: (source, type) =>
        new Promise((resolve, reject) => {
            if (source.name.toLowerCase().indexOf('.heic') !== -1) {
                resolve('image/heic')
            } else {
                resolve(type)
            }
        }),
    }).setOptions({
    server:{
        process:(fieldName,file,metadata,load,error,progress,abort,transfer,options)=>{
            if (file.type == 'image/heic') {
                const formData = new FormData();
                formData.append(fieldName, file, file.name + '.jpg'); // Cambia la extensión a .jpg

                // Envía el archivo convertido al servidor utilizando Livewire
                @this.upload('template.0',formData,load,error,progress)
            } else {
                // Si no es .heic, simplemente envía el archivo al servidor sin conversión
                @this.upload('template.0',file,load,error,progress)
            }
        },

        revert:(filename,load)=>{
            @this.removeUpload('template.0',filename,load)
        },

    },
});

const labels_es_ES = {
    labelIdle: 'Arrastra y suelta tus archivos o <span class = "filepond--label-action"> Examinar <span>',
    labelInvalidField: "El campo contiene archivos inválidos",
    labelFileWaitingForSize: "Esperando tamaño",
    labelFileSizeNotAvailable: "Tamaño no disponible",
    labelFileLoading: "Cargando",
    labelFileLoadError: "Error durante la carga",
    labelFileProcessing: "Cargando",
    labelFileProcessingComplete: "Carga completa",
    labelFileProcessingAborted: "Carga cancelada",
    labelFileProcessingError: "Error durante la carga",
    labelFileProcessingRevertError: "Error durante la reversión",
    labelFileRemoveError: "Error durante la eliminación",
    labelTapToCancel: "toca para cancelar",
    labelTapToRetry: "tocar para volver a intentar",
    labelTapToUndo: "tocar para deshacer",
    labelButtonRemoveItem: "Eliminar",
    labelButtonAbortItemLoad: "Abortar",
    labelButtonRetryItemLoad: "Reintentar",
    labelButtonAbortItemProcessing: "Cancelar",
    labelButtonUndoItemProcessing: "Deshacer",
    labelButtonRetryItemProcessing: "Reintentar",
    labelButtonProcessItem: "Cargar",
    labelMaxFileSizeExceeded: "El archivo es demasiado grande",
    labelMaxFileSize: "El tamaño máximo del archivo es {filesize}",
    labelMaxTotalFileSizeExceeded: "Tamaño total máximo excedido",
    labelMaxTotalFileSize: "El tamaño total máximo del archivo es {filesize}",
    labelFileTypeNotAllowed: "Archivo de tipo no válido",
    fileValidateTypeLabelExpectedTypes: "Espera {allButLastType} o {lastType}",
    imageValidateSizeLabelFormatError: "Tipo de imagen no compatible",
    imageValidateSizeLabelImageSizeTooSmall: "La imagen es demasiado pequeña",
    imageValidateSizeLabelImageSizeTooBig: "La imagen es demasiado grande",
    imageValidateSizeLabelExpectedMinSize: "El tamaño mínimo es {minWidth} × {minHeight}",
    imageValidateSizeLabelExpectedMaxSize: "El tamaño máximo es {maxWidth} × {maxHeight}",
    imageValidateSizeLabelImageResolutionTooLow: "La resolución es demasiado baja",
    imageValidateSizeLabelImageResolutionTooHigh: "La resolución es demasiado alta",
    imageValidateSizeLabelExpectedMinResolution: "La resolución mínima es {minResolution}",
    imageValidateSizeLabelExpectedMaxResolution: "La resolución máxima es {maxResolution}",
};

FilePond.setOptions(labels_es_ES);

</script>
<style>
    .filepond--root {
    min-height: 75px;
    }
    .pcr-button{
        width:100% !important;
    }

</style>

<script>
    Livewire.on('AumentarPrecio', function (id) {
        $('#nombrePrecio' + id).select2();
        $('#nombrePrecio' + id).on('change', function (e) {
            @this.set('nombrePrecio.' + id, $(this).val());
        });
        $('#monedaPrecio' + id).select2();
        $('#monedaPrecio' + id).on('change', function (e) {
            @this.set('monedaPrecio.' + id, $(this).val());
        });
    });

    Livewire.on('ActualizarPrecio', function (items,precios) {
        items.forEach(function(ids, index) {
            var selectElement = $('#nombrePrecio' + index);
            if (selectElement.length) {
                selectElement.val(ids).trigger('change');
            }
        });
        precios.forEach(function(ids, index) {
            var selectElement = $('#monedaPrecio' + index);
            if (selectElement.length) {
                selectElement.val(ids).trigger('change');
            }
        });
    });

    Livewire.on('AumentarDias', function (id) {
        $('#incluye'+id).select2({
            placeholder: "Seleccione..."
        });

        $('#incluye'+id).on('change', function(e) {
            let data = $(this).select2('data');
            let values = data.map(function(item) { return item.id; });
            @this.set('incluye.'+id, values);
        });

        $('#no_incluye'+id).select2({
            placeholder: "Seleccione..."
        });

        $('#no_incluye'+id).on('change', function(e) {
            let data = $(this).select2('data');
            let values = data.map(function(item) { return item.id; });
            @this.set('no_incluye.'+id, values);
        });

        const inputElement2 = document.querySelector('#template'+id);
        const ponds = FilePond.create(inputElement2, {
            fileValidateTypeDetectType: (source, type) =>
                new Promise((resolve, reject) => {
                    if (source.name.toLowerCase().indexOf('.heic') !== -1) {
                        resolve('image/heic')
                    } else {
                        resolve(type)
                    }
                }),
            }).setOptions({
            server:{
                process:(fieldName,file,metadata,load,error,progress,abort,transfer,options)=>{
                    if (file.type == 'image/heic') {
                        const formData = new FormData();
                        formData.append(fieldName, file, file.name + '.jpg'); // Cambia la extensión a .jpg

                        // Envía el archivo convertido al servidor utilizando Livewire
                        @this.upload('template.'+id,formData,load,error,progress)
                    } else {
                        // Si no es .heic, simplemente envía el archivo al servidor sin conversión
                        @this.upload('template.'+id,file,load,error,progress)
                    }
                },

                revert:(filename,load)=>{
                    @this.removeUpload('template.'+id,filename,load)
                },

            },
        });
    });

    Livewire.on('ActualizarDias', function (items,precios) {
        items.forEach(function(ids, index) {
            var selectElement = $('#incluye' + index);
            if (selectElement.length) {
                selectElement.val(ids).trigger('change');
            }
        });
        precios.forEach(function(ids, index) {
            var selectElement = $('#no_incluye' + index);
            if (selectElement.length) {
                selectElement.val(ids).trigger('change');
            }
        });
    });
</script>
@if($categoriaint == 1)
<script>
document.addEventListener('livewire:load', function () {
    var colorPicker = Pickr.create({
        el: '#colorPicker',
        theme: 'classic',
        default: '#000000',
        components: {
            preview: true,
            opacity: true,
            hue: true,
            interaction: {
                input: true,
                clear: true,
                save: true,
            },
        },
    });
    colorPicker.on('save', (color) => {
        @this.set('colorpick', colorPicker.getColor().toHEXA().toString());
    });
});
</script>
@endif
@endpush

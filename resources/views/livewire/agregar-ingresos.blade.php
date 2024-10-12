<div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">AGREGAR TICKETS DE MACHUPICCHU</span>
        </div>
        <div class="justify-content-center mt-2">
            <a target="_blank" wire:click="plantillaMinisterio()">
                <button type="button" class="btn btn-success mb-2 mb-md-0 ">
                    <i data-bs-toggle="tooltip" data-bs-title="Ministerio" class="fa fa-plus-circle"></i><b> &nbsp; Plantilla Ministerio</b>
                </button>
            </a>
            <a target="_blank" wire:click="plantillaIncaRail()">
                <button type="button" class="btn btn-danger mb-2 mb-md-0 ">
                    <i data-bs-toggle="tooltip" data-bs-title="Inca Rail" class="fa fa-plus-circle"></i><b> &nbsp; Plantilla Inca Rail</b>
                </button>
            </a>
            <a target="_blank" wire:click="plantillaPeruRail()">
                <button type="button" class="btn btn-warning mb-2 mb-md-0 ">
                    <i data-bs-toggle="tooltip" data-bs-title="Peru Rail" class="fa fa-plus-circle"></i><b> &nbsp; Plantilla Peru Rail</b>
                </button>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach($detalleReserva as $detalle)
                            <div class="mb-3 col-md-3">
                                <b>{{date("d-m-Y",strtotime($detalle->fecha_viaje))}}</b> <br>
                                @foreach($detalle->incluyes->where('categoria_id',17)->where('id','!=',8) as $detail)
                                    {{$detail->titulo}}
                                    @if(!$loop->last)
                                        <br>
                                    @endif
                                @endforeach
                            </div>
                            <div class="mb-3 col-md-9">
                                <b>{{$detalle->titulo}}</b> <br>
                                {{$detalle->comentarios}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($this->machupicchu as $i => $detalle)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6>{{$detalle->titulo}}</h6>
                        <div class="row">
                            <div class="mb-3 col-md-2">
                                <label class="form-label" for="codigo{{$i}}">Codigo de Reserva:</label>
                                <input type="text" class="form-control" id="codigo{{$i}}" name="codigo{{$i}}" wire:model.defer="observacion.{{$i}}">
                                @error('codigo.'.$i)
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                                <label class="form-label" for="observacion{{$i}}">Comentarios</label>
                                <textarea name="observacion{{$i}}" id="observacion{{$i}}" wire:model.defer="observacion.{{$i}}" class="form-control" rows="2"></textarea>
                                @error('observacion.'.$i)
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-2">
                                <label class="form-label" for="precio{{$i}}">Costo:</label>
                                <div class="input-group">
                                    <span class="input-group-text pe-cursor" wire:click="cambiarTipoMoneda({{$i}})">
                                        {{$moneda[$i] == 2 ? '$' : 'S/'}}
                                    </span>
                                    <input type="number" step="0.01" class="form-control" id="precio{{$i}}" name="precio{{$i}}" wire:model.defer="precio.{{$i}}">
                                </div>
                                    @error('precio.'.$i)
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-2">
                                <label class="form-label" for="proveedorId{{$i}}">Proveedor:</label>
                                <div wire:ignore>
                                    <select class="form-control" name="proveedorId{{$i}}" id="proveedorId{{$i}}" wire:model.defer="proveedorId.{{$i}}">
                                        <option value="" >SELECCIONE</option>
                                        @foreach($proveedores as $proveedor)
                                            <option value="{{$proveedor->id}}" >{{$proveedor->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>  
                                @error('proveedorId.'.$i)
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" col-md-3" >
                                <label class="form-label" for="imagen{{$i}}">Documento Subir:</label>
                                <div class="d-flex">
                                    <div wire:ignore class="col-md-11">
                                        <input class="form-control" type="file" id="imagen{{$i}}" accept="image/*" name="imagen{{$i}}" wire:model.defer="imagen.{{$i}}">
                                    </div>
                                    @if($imagenver[$i])
                                        <a href="{{asset('storage/img/tickets/'.$imagenver[$i])}}" target="_blank">
                                            <button type="button"  class="btn btn-warning btn-icon"><i class="fe fe-eye"></i></button>
                                        </a>
                                    @endif
                                </div>
                                @error('imagen')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary m-2"
                                        wire:click="guardarIngreso({{$i}})"
                                        wire:loading.attr="disabled">
                                    <span wire:loading wire:target="guardarIngreso">Guardando...</span>
                                    <span wire:loading.remove wire:target="guardarIngreso">Guardar</span>
                                </button> 
                            </div>
                            <div class="col-md-10">
                                <span class="h7 text-left"><b>*NOTA:</b> Forma correcta de agregar las observaciones Ejemplo: PR. EXP. FR 83</span><br>
                                <span class="span">PR(EMPRESA PERU RAIL O INCA RAIL) / TIPO DE TREN / Nº DE FRECUENCIA</span>
                                <p class="span">EXP(EXPEDITION) / OBS(OBSERVATORI) / VST(VISTADOME) / VYG(VOYAGER) / 360(PANORAMICO) / FIRST(FIRST CLASS) / PREM(PREMIUN)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div>
        <a href="{{ route('reserva.voucheroficina', $reserva) }}">
            <button type="button" class="btn btn-danger mb-2 mb-md-0 ">
                <i class="far fa-arrow-alt-circle-left"></i><b> &nbsp; Atras</b>
            </button>
        </a>
    </div>
</div>
@push('custom-scripts')
    @foreach($detalles as $i => $detalle)
        <script>
            $('#proveedorId{{$i}}').val('{{$proveedorId[$i]}}').select2({
                width: '100%'
            }).on('change', function (e) {
                @this.set('proveedorId.{{$i}}', this.value);
            });
        </script>
    @endforeach
@endpush
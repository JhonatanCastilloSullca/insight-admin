<div>
    <div class="row inbox-wrapper">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="mb-3">CREAR LIQUIDACION DE EGRESO</h4>
                    <input type="hidden" name="tipo" value="2">
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label for="idTour" class="form-label">CATEGORIA:</label>
                            <div wire:ignore>
                                <select class="form-control" name="idCategoria" id="idCategoria" wire:model="idCategoria" required>
                                    <option value="" >SELECCIONE</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('idCategoria')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="idTour" class="form-label">PROVEEDOR:</label>
                            <div wire:ignore>
                                <select class="form-control" name="idProveedor" id="idProveedor" wire:model="idProveedor" required>
                                    <option value="" >SELECCIONE</option>
                                </select>
                            </div>
                            @error('idProveedor')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label" for="email">HASTA:</label>
                            <input type="date" class="form-control"  name="fecha" id="fecha" wire:model.lazy="fecha" required>
                            @error('fecha')
                                <span class="error-message" style="color:red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label" for="observacion">OBSERVACION:</label>
                            <textarea type="text" class="form-control" placeholder="Observacion" name="observacion" id="observacion" wire:model.defer="observacion"></textarea>
                            @error('observacion')
                                <span class="error-message" style="color:red" >{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12 mb-3">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><label class="form-label"> FECHA</label></th>
                                                <th><label class="form-label"> SERVICIO</label></th>
                                                <th><label class="form-label"> PAX</label></th>
                                                <th><label class="form-label"> NOMBRES</label></th>
                                                <th><label class="form-label"> PRECIO</label></th>
                                                <th><label class="form-label"> INGRESOS S/</label></th>
                                                <th><label class="form-label"> COMENTARIOS</label></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="cuerpo">
                                            @foreach ($detalles  ?? [] as $i => $detalle)
                                                <tr>
                                                    <td>{{date("d-m-Y", strtotime($detalle['fecha']))}}</td>
                                                    <td>{{$detalle['titulo']}}</td>
                                                    <td>{{$detalle['pax']}}
                                                    </td>
                                                    <td>
                                                        @foreach($detalle['pasajeros'] as $detail)
                                                            {{$detail['pasajero']}} (x{{$detail['paxs']}})
                                                            @if(!$loop->last)
                                                                <br>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-text pe-cursor" wire:click="cambiarTipoMoneda({{$i}})">
                                                                {{$monedaId[$i] == 2 ? '$' : 'S/'}}
                                                            </span>
                                                            <input type="number" class="form-control" name="precio{{$i}}" id="precio{{$i}}" wire:model.lazy="precio.{{$i}}">
                                                        </div>   
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="ingresos{{$i}}" id="ingresos{{$i}}" wire:model.lazy="ingresos.{{$i}}">
                                                    </td>
                                                    <td>
                                                        <textarea name="comentarios{{$i}}" id="comentarios{{$i}}" wire:model.defer="comentarios.{{$i}}" class="form-control" rows="2"></textarea>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td >TOTAL USD:</td>
                                                <td>{{number_format($totalliquidacionDolares,2)}}
                                                    <input type="hidden" name="monto" value="{{$totalliquidacionDolares}}">
                                                </td>
                                                <td colspan="2">TOTAL PEN:</td>
                                                <td>{{number_format($totalliquidacionSoles,2)}}
                                                    <input type="hidden" name="monto" value="{{$totalliquidacionSoles}}">
                                                </td>
                                                <td>{{number_format($totalliquidacionIngresos,2)}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div><!-- Col -->
                        </div>
                    </div>
                    <div class="row flex justify-content-end">
                        <div class="col-md-1  flex justify-content-end">
                            <button type="button" class="btn btn-primary me-2" wire:click="register" @disabled($totalliquidacionSoles == 0)>Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    
</div>
@push('custom-scripts')
<script>
$('#idCategoria').select2();

$('#idCategoria').on('change',function(){
    @this.set('idCategoria',this.value);
});


Livewire.on('aumentar', function (datos) {
    $('#idProveedor').empty();
    $('#idProveedor').select2({
        data: datos,
    });
    $('#idProveedor').on('change', function (e) {
        @this.set('idProveedor', this.value);
    });
});

</script>
@endpush

<div>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h4>Datos Pasajeros</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nombres" class="form-label">Nombre:</label>
                            <div wire:ignore>
                                <select class="form-control" name="nombres" id="nombres" wire:model="nombres">
                                    <option value="" >SELECCIONE</option>
                                    @foreach($pasajeros as $pasajero)
                                        <option value="{{$pasajero->nombres}}">{{$pasajero->nombres}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('nombres')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-6">
                            <label for="nacimiento" class="form-label">Nacimiento:</label>
                            <input type="date" name="nacimiento" id="nacimiento" class="form-control" wire:model.defer="nacimiento" >
                            @error('nacimiento')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="genero" class="form-label">Genero:</label>
                            <select class="form-select js-states" id="genero" name="genero" data-width="100%" wire:model.defer="genero">
                                <option value="MASCULINO">MASCULINO</option>
                                <option value="FEMENINO">FEMENINO</option>
                            </select>
                            @error('genero')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-6">
                            <label for="celular" class="form-label">Celular:</label>
                            <input type="text" name="celular" id="celular" class="form-control" wire:model.defer="celular" >
                            @error('celular')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-6">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" name="email" id="email" class="form-control" wire:model.defer="email" >
                            @error('email')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-6">
                            <label for="tarifa" class="form-label">Tarifa:</label>
                            <select class="form-select js-states" id="tarifa" name="tarifa" data-width="100%" wire:model.defer="tarifa">
                                <option value="ADULTO">ADULTO</option>
                                <option value="NIÑO">NIÑO</option>
                            </select>
                            @error('tarifa')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-6">
                            <label for="pais_id" class="form-label">Pais:</label>
                            <div wire:ignore>
                                <select class="form-control pais_id" name="pais_id" id="pais_id" wire:model.defer="pais_id">
                                    <option value="" >SELECCIONE</option>
                                    @foreach($paises as $pais)
                                        <option value="{{$pais->id}}">{{$pais->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('pais_id')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-6">
                            <label for="documento" class="form-label">Documento:</label>
                            <select class="form-select js-states" id="documento" name="documento" data-width="100%" wire:model.defer="documento">
                                <option value="DNI">DNI</option>
                                <option value="RUC">RUC</option>
                                <option value="CARNET E.">CARNET E.</option>
                            </select>
                            @error('documento')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-6">
                            <label for="num_doc" class="form-label">Nº:</label>
                            <input type="text" name="num_doc" id="num_doc" class="form-control" wire:model.defer="num_doc" >
                            @error('num_doc')
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
                        <div class=" col-md-12" >
                            <label class="form-label" for="imagen">Documento Subir:</label>
                            <div class="d-flex">
                                <div wire:ignore class="col-md-11">
                                    <input class="form-control" type="file" id="formFile" accept="image/*" name="imagen" wire:model.defer="imagen">
                                </div>
                                @if($imagenver!='')
                                    <a href="{{asset('storage/img/documentos/'.$imagenver)}}" target="_blank">
                                        <button type="button"  class="btn btn-warning btn-icon"><i class="fe fe-eye"></i></button>
                                    </a>
                                @endif
                            </div>
                            @error('imagen')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary m-2" wire:click="agregarPasajero">Agregar</button>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="paquetes" class="table table-hover">
                        <thead>
                            <tr >
                                <th>Nombres</th>
                                <th>Celular</th>
                                <th>Email</th>
                                <th>Pais</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pasajerosreserva as $i => $pasajero)
                            <tr>
                                <td>{{$pasajero['nombres']}}</td>
                                <td>{{$pasajero['celular']}}</td>
                                <td>{{$pasajero['email']}}</td>
                                <td>{{$pasajero['pais_nombre']}}</td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button"  class="btn btn-success btn-icon" wire:click="editarPasajero({{$i}})"><i class="fe fe-edit"></i></button>
                                        <button type="button"  class="btn btn-danger btn-icon" wire:click="reducirPasajero({{$i}})"><i class="fe fe-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h4>Servicios Voucher</h4>
                    <div class="row">
                        <div class=" col-md-12">
                            <label for="servicio_id" class="form-label">Servicio:</label>
                            <div wire:ignore>
                                <select class="form-control" name="servicio_id" id="servicio_id" wire:model="servicio_id">
                                    <option value="" >SELECCIONE</option>
                                    @foreach($servicios as $servicio)
                                        <option value="{{$servicio->id}}">{{$servicio->titulo}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('servicio_id')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-6">
                            <label for="pax" class="form-label">Pax:</label>
                            <input type="number" name="pax" id="pax" class="form-control" wire:model.defer="pax" >
                            @error('pax')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-6">
                            <label for="fecha_viaje" class="form-label">Fecha:</label>
                            <input type="date" name="fecha_viaje" id="fecha_viaje" class="form-control" wire:model.defer="fecha_viaje" >
                            @error('fecha_viaje')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-4">
                            <label for="moneda_id" class="form-label">Moneda:</label>
                            <select class="form-select js-states" id="moneda_id" name="moneda_id" data-width="100%" wire:model.defer="moneda_id">
                                <option value="">SELECCIONE</option>
                                @foreach($monedas as $moneda)
                                    <option value="{{$moneda->id}}">{{$moneda->nombre}}</option>
                                @endforeach
                            </select>
                            @error('moneda_id')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-6">
                            <label for="precio" class="form-label">Precio Total:</label>
                            <input type="number" name="precio" id="precio" class="form-control" wire:model.defer="precio" >
                            @error('precio')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-5 justify-content-end col-md-2">
                            <div class="checkbox">
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="tiposervicio" name="tiposervicio" wire:model.defer="tiposervicio">
                                    <label for="tiposervicio" class="custom-control-label mt-1">Compartido</label>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-12" >
                            <label class="form-label" for="incluye">Incluye:</label>
                            <div wire:ignore>
                                <select class="form-control" name="incluye" id="incluye" wire:model="incluye" multiple>
                                    @foreach($incluyes as $incluye)
                                        <option value="{{$incluye->id}}">{{$incluye->titulo}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('incluye')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-12" >
                            <label class="form-label" for="noincluye">No Incluye:</label>
                            <div wire:ignore>
                                <select class="form-control" name="noincluye" id="noincluye" wire:model="noincluye" multiple>
                                    @foreach($incluyes as $incluye)
                                        <option value="{{$incluye->id}}">{{$incluye->titulo}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('noincluye')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-12" >
                            <div wire:ignore>
                                <label class="form-label" for="comentarios">Comentarios:</label>
                                <textarea class="form-control" name="comentarios" id="comentarios" rows="2" wire:model.defer="comentariodetalle"></textarea>
                            </div>
                            @error('comentarios')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary m-2"  wire:click="agregarServicio">Agregar</button>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="paquetes" class="table table-hover ">
                        <thead>
                            <tr >
                                <th>Pax</th>
                                <th>Servicio</th>
                                <th>Fecha</th>
                                <th>Precio</th>
                                <th>Incluye</th>
                                <th>No Incluye</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($serviciosreserva as $i => $servicio)
                            <tr>
                                <td>{{$servicio['pax']}}</td>
                                <td>{{$servicio['servicio']}}</td>
                                <td>{{$servicio['fecha_viaje']}}</td>
                                <td>{{$servicio['moneda']}} {{number_format($servicio['precio'],2)}}</td>
                                <td>
                                    @foreach($servicio['incluye'] as $incluye)
                                        {{$incluye['servicio']}}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($servicio['noincluye'] as $noincluye)
                                        {{$noincluye['servicio']}}<br>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button"  class="btn btn-success btn-icon" wire:click="editarServicio({{$i}})"><i class="fe fe-edit"></i></button>
                                        <button type="button"  class="btn btn-danger btn-icon" wire:click="reducirServicio({{$i}})"><i class="fe fe-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if($totalsoles > 0 || $totaldolares > 0)
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Pagos Voucher</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class=" col-md-4">
                                <label for="monedapago" class="form-label">Moneda:</label>
                                <select class="form-select js-states" id="monedapago" name="monedapago" data-width="100%" wire:model="monedapago">
                                    <option value="">SELECCIONE</option>
                                    @if($totalsoles > 0 && $pagosoles < $totalsoles)
                                        <option value="1">Soles</option>
                                    @endif
                                    @if($totaldolares > 0 && $pagodolares < $totaldolares)
                                        <option value="2">Dolares</option>
                                    @endif
                                </select>
                                @error('monedapago')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" col-md-4">
                                <label for="montopago" class="form-label">Monto Total:</label>
                                <input type="number" name="montopago" id="montopago" class="form-control" wire:model.defer="montopago" >
                                @error('montopago')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" col-md-4">
                                <label for="num_operacion" class="form-label">Numero Operación:</label>
                                <input type="number" name="num_operacion" id="num_operacion" class="form-control" wire:model.defer="num_operacion" >
                                @error('num_operacion')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" col-md-12">
                                <label for="medio_pago" class="form-label">Medio Pago:</label>
                                <div wire:ignore>
                                    <select class="form-select js-states" id="medio_pago" name="medio_pago" data-width="100%" wire:model.defer="medio_pago">
                                        <option value="">SELECCIONE</option>
                                    </select>
                                </div>
                                @error('medio_pago')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" col-md-12" >
                                <div wire:ignore>
                                    <label class="form-label" for="comentariopago">Comentarios:</label>
                                    <textarea class="form-control" name="comentariopago" id="comentariopago" rows="2" wire:model.defer="comentariopago"></textarea>
                                </div>
                                @error('comentariopago')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary m-2"  wire:click="agregarPago">Agregar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="paquetes" class="table table-hover ">
                            <thead>
                                <tr >
                                    <th>Medio de pago</th>
                                    <th>Monto</th>
                                    <th>Operacion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pagosreserva as $i => $pago)
                                <tr>
                                    <td>{{$pago['medio']}}</td>
                                    <td>{{$pago['moneda']}} {{number_format($pago['monto'],2)}}</td>
                                    <td>{{$pago['num_operacion']}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button"  class="btn btn-success btn-icon" wire:click="editarPago({{$i}})"><i class="fe fe-edit"></i></button>
                                            <button type="button"  class="btn btn-danger btn-icon" wire:click="reducirPago({{$i}})"><i class="fe fe-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h4 class="mt-4">Sub - Total: 
                            @if($totalsoles > 0 )
                                S/ {{number_format($totalsoles,2)}}
                            @endif

                            @if($totaldolares > 0 )
                                $ {{number_format($totaldolares,2)}}
                            @endif
                        </h4>
                        @if($descuentosoles > 0  || $descuentodolares > 0 )
                        <h4>Descuento: 
                            @if($descuentosoles > 0 )
                                S/ {{number_format($descuentosoles,2)}}
                            @endif

                            @if($descuentodolares > 0 )
                                $ {{number_format($descuentodolares,2)}}
                            @endif
                        </h4>
                        @endif
                        @if($reserva!=null)
                            <div class="row">
                                <div class=" col-md-8" >
                                    <label class="form-label" for="codigodescuento">Cupon:</label>
                                    <input class="form-control" name="codigodescuento" id="codigodescuento" wire:model.defer="codigodescuento">
                                    @error('codigodescuento')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                    @if ($message = Session::get('success'))
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                    @endif
                                </div>
                                <div class=" col-md-4 mt-3" >
                                    <button type="button" class="btn btn-primary m-2"  wire:click="agregarDescuento">Aplicar</button>
                                </div>
                            </div>
                        @endif
                        <div class="mt-3">
                            @if($totalsoles > 0 )
                                <h4>
                                    Acuenta:  S/ {{number_format($pagosoles,2)}} &nbsp;&nbsp; Saldo:  S/ {{number_format($saldosoles,2)}} &nbsp;&nbsp; Total:  S/ {{number_format($totalsoles,2)}}
                                </h4>
                            @endif
                            @if($totaldolares > 0 )
                                <h4>
                                    Acuenta: $ {{number_format($pagodolares,2)}} &nbsp;&nbsp; Saldo:  S/ {{number_format($saldodolares,2)}} &nbsp;&nbsp; Total: $ {{number_format($totaldolares,2)}}
                                </h4>
                            @endif
                        </div>
                        <div class="row">
                            <div class=" col-md-8" >
                                <label class="form-label" for="cuotas">Cuotas:</label>
                                <input type="number" class="form-control" name="cuotas" id="cuotas" wire:model.defer="cuotas">
                                @error('cuotas')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" col-md-4 mt-3" >
                                <button type="button" class="btn btn-primary m-2"  wire:click="agregarCuotas">Agregar</button>
                            </div>
                            <div class="col-md-12 mt-3">
                                <table id="paquetes" class="table table-hover ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for($i=0; $i < $cuotas; $i++)
                                        <tr>
                                            <td>{{$i+1}}</td>
                                            <td>
                                                <input type="date" name="fechacuota" class="form-control" wire:model.defer="fechacuota.{{$i}}">
                                                @error('fechacuota.'.$i)
                                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <span wire:ignore class="input-group-text pe-cursor" wire:click="cambiarTipoMoneda({{$i}})">
                                                        {{$monedacuota[$i] == 2 ? '$' : 'S/'}}
                                                    </span>
                                                    <input type="number" name="montocuota" class="form-control" wire:model.defer="montocuota.{{$i}}">
                                                    @error('montocuota.'.$i)
                                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table>
                                @if ($message = Session::get('danger'))
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <a href="{{route('reserva.index')}}">
        <button type="button" class="btn btn-danger m-2">Cancelar</button>
    </a>
    @if($totalsoles > 0 || $totaldolares > 0)
        <button type="button" class="btn btn-primary m-2" wire:click="registrarReserva">Guardar Reserva</button>
    @endif
</div>
@push('custom-scripts')
<script>
$('#nombres').select2({
    tags: true,
});
$('#nombres').on('change',function(){
    @this.set('nombres',this.value);
});

$('#pais_id').select2();
$('#pais_id').on('change', function (e) {
    @this.set('pais_id', e.target.value);
});

Livewire.on('sinEncontrar', postId => {
    jQuery(document).ready(function () {
        $('#pais_id').select2();
        $('#pais_id').on('change', function (e) {
            @this.set('pais_id', this.value);
        });
    });
});

Livewire.on('Encontrar', function (id) {
    $('#pais_id').val(id).select2();
    $('#pais_id').on('change', function (e) {
        @this.set('pais_id', this.value);
    });
});

Livewire.on('EncontrarPasajero', function (id,datos) {
    $('#nombres').val(id).select2({
        data: datos,
    });
    $('#nombres').on('change', function (e) {
        @this.set('nombres', this.value);
    });
});

$('#servicio_id').select2();
$('#servicio_id').on('change',function(){
    @this.set('servicio_id',this.value);
});

$('#incluye').select2();
$('#incluye').on('change', function (e) {
    @this.set('incluye', e.target.value);
});

$('#noincluye').select2();
$('#noincluye').on('change', function (e) {
    @this.set('noincluye', e.target.value);
});

Livewire.on('sinEncontrarServicio', function () {
    $('#incluye').val(null).select2();

    // Manejar cambios y actualizar Livewire
    $('#incluye').on('change', function (e) {
        var selectedValues = $(this).val();
        @this.set('incluye', selectedValues);

    });

    $('#noincluye').val(null).select2();

    // Manejar cambios y actualizar Livewire
    $('#noincluye').on('change', function (e) {
        var selectedNoValues = $(this).val();
        @this.set('noincluye', selectedNoValues);

    });
});

Livewire.on('EncontrarServicio', function (ids,ids2) {
    $('#incluye').val(ids).select2();

    // Manejar cambios y actualizar Livewire
    $('#incluye').on('change', function (e) {
        var selectedValues = $(this).val();
        @this.set('incluye', selectedValues);

    });
    $('#noincluye').val(ids2).select2();

    // Manejar cambios y actualizar Livewire
    $('#noincluye').on('change', function (e) {
        var selectedNoValues = $(this).val();
        @this.set('noincluye', selectedNoValues);

    });
});

Livewire.on('ResetearServicio', function (id) {
    $('#servicio_id').val(id).select2();
    $('#servicio_id').on('change', function (e) {
        @this.set('servicio_id', this.value);
    });
});


Livewire.on('LlenarMedio', function (id,datos) {
    console.log(id);
    $('#medio_pago').val(id).select2({
        data: datos,
    });
    $('#medio_pago').on('change', function (e) {
        @this.set('medio_pago', this.value);
    });
});

</script>
@endpush

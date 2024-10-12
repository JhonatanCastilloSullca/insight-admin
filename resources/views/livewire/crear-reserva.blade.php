<div class="main-container container-fluid">
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">{{$reserva->id ? 'Editar Reserva':'Crear Reserva'}}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-header col-md-12 d-flex justify-content-between">
                <h4 class="">Datos Pasajeros</h4>
                <button type="button" class="btn btn-primary mb-2 mb-md-0 " wire:click="abrirPasajero">
                    <i class="fa fa-plus-circle"></i><b> &nbsp; Agregar Pasajero</b>
                </button>
            </div>
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="paquetes" class="table table-hover">
                        <thead>
                            <tr >
                                <th>Nombres</th>
                                <th>Principal</th>
                                <th>Celular</th>
                                <th>Email</th>
                                <th>Pais</th>
                                <th>Documento</th>
                                <th>Comentario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pasajerosreserva as $i => $pasajero)
                            <tr>
                                <td>{{$pasajero['nombres']}} {{$pasajero['apellidoPaterno']}} {{$pasajero['apellidoMaterno']}}</td>
                                <td>{{$pasajero['principal'] ? 'Si':'No'}}</td>
                                <td>{{$pasajero['celular']}}</td>
                                <td>{{$pasajero['email']}}</td>
                                <td>{{$pasajero['pais_nombre']}}</td>
                                <td>{{$pasajero['documento']}} {{$pasajero['num_doc']}}</td>
                                <td>{{$pasajero['comentario']}}</td>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header col-md-12 d-flex justify-content-between">
                        <span class="h4">Servicios</span>
                        <button type="button" class="btn btn-primary mb-2 mb-md-0 " wire:click="abrirServicio">
                            <i class="fa fa-plus-circle"></i><b> &nbsp; Agregar Servicio</b>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="paquetes" class="table table-hover ">
                        <thead>
                            <tr >
                                <th>Pax</th>
                                <th>Servicio</th>
                                <th>Tipo</th>
                                <th>Tarifa</th>
                                <th>Fecha</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                                <th>Incluye</th>
                                <th>No Incluye</th>
                                <th>Comentario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpoServicio" wire:sortable="actualizarOrden">
                            @foreach($serviciosreserva as $i => $servicio)
                            <tr id="{{$i}}">
                                <td>{{$servicio['pax']}}</td>
                                <td>{{$servicio['servicio']}}</td>
                                <td>{{$servicio['tipo']? 'Privado':'Compartido'}}</td>
                                <td>{{$servicio['precioNombre']}}</td>
                                <td>{{$servicio['fecha_viaje'] ? date('d-m-Y',strtotime($servicio['fecha_viaje'])) : ''}}</td>
                                <td>{{$servicio['moneda']}} {{number_format($servicio['precio'],2)}}</td>
                                <td>{{$servicio['moneda']}} {{number_format($servicio['precio']*$servicio['pax'],2)}}</td>
                                <td>
                                    @foreach($servicio['itinerarios'] as $itinerario)
                                        @foreach($itinerario['incluye'] as $incluye)
                                            {{$incluye['servicio']}}<br>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($servicio['itinerarios'] as $itinerario)
                                        @foreach($itinerario['noincluye'] as $noincluye)
                                            {{$noincluye['servicio']}}<br>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>{{$servicio['comentariodetalle']}}</td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button"  class="btn btn-success btn-icon" wire:click="editarServicio({{$i}})"><i class="fe fe-edit"></i></button>
                                        <button type="button"  class="btn btn-danger btn-icon" wire:click="reducirServicio({{$i}})"><i class="fe fe-trash"></i></button>
                                        <button type="button"  class="btn btn-info btn-icon" wire:click="duplicarServicio({{$i}})"><i class="fe fe-plus"></i></button>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header col-md-12 d-flex justify-content-between">
                        <span class="h4">Hoteles</span>
                        <button type="button" class="btn btn-primary mb-2 mb-md-0 " wire:click="abrirHotel">
                            <i class="fa fa-plus-circle"></i><b> &nbsp; Agregar Hotel</b>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="paquetes" class="table table-hover ">
                        <thead>
                            <tr >
                                <th>Cantidad</th>
                                <th>Noches</th>
                                <th>Habitacion</th>
                                <th>Fecha Ingreso</th>
                                <th>Fecha Salida</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                                <th>Incluye</th>
                                <th>No Incluye</th>
                                <th>Comentario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hotelesreserva as $i => $servicio)
                            <tr>
                                <td>{{$servicio['pax']}}</td>
                                <td>{{$servicio['noches']}}</td>
                                <td>{{$servicio['servicio']}}</td>
                                <td>{{$servicio['fecha_viaje'] ? date('d-m-Y H:i',strtotime($servicio['fecha_viaje'])) : ''}}</td>
                                <td>{{$servicio['fecha_viajefin'] ? date('d-m-Y H:i',strtotime($servicio['fecha_viajefin'])) : ''}}</td>
                                <td>{{$servicio['moneda']}} {{number_format($servicio['precio'],2)}}</td>
                                <td>{{$servicio['moneda']}} {{number_format($servicio['precio']*$servicio['pax']*$servicio['noches']+$servicio['adicional'],2)}}</td>
                                <td>
                                    @foreach($servicio['itinerarios'] as $itinerario)
                                        @foreach($itinerario['incluye'] as $incluye)
                                            {{$incluye['servicio']}}<br>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($servicio['itinerarios'] as $itinerario)
                                        @foreach($itinerario['noincluye'] as $noincluye)
                                            {{$noincluye['servicio']}}<br>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>{{$servicio['comentariodetalle']}}</td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button"  class="btn btn-success btn-icon" wire:click="editarHotel({{$i}})"><i class="fe fe-edit"></i></button>
                                        <button type="button"  class="btn btn-danger btn-icon" wire:click="reducirHotel({{$i}})"><i class="fe fe-trash"></i></button>
                                        <button type="button"  class="btn btn-info btn-icon" wire:click="duplicarHotel({{$i}})"><i class="fe fe-plus"></i></button>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header col-md-12 d-flex justify-content-between">
                        <span class="h4">Vuelos</span>
                        <button type="button" class="btn btn-primary mb-2 mb-md-0 " wire:click="abrirVuelo">
                            <i class="fa fa-plus-circle"></i><b> &nbsp; Agregar Vuelo</b>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="paquetes" class="table table-hover ">
                        <thead>
                            <tr >
                                <th>Pax</th>
                                <th>Vuelo</th>
                                <th>Fecha Ida</th>
                                <th>Fecha Regreso</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Equipaje</th>
                                <th>Subtotal</th>
                                <th>Incluye</th>
                                <th>No Incluye</th>
                                <th>Comentario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vuelosreserva as $i => $servicio)
                            <tr>
                                <td>{{$servicio['pax']}}</td>
                                <td>{{$servicio['tipo'] ? '(IDA Y VUELTA) ':'(IDA) '}} {{$servicio['servicio']}}</td>
                                <td>{{$servicio['fecha_viaje'] ? date('d-m-Y',strtotime($servicio['fecha_viaje'])) : ''}}</td>
                                <td>{{$servicio['fecha_viajefin'] ? date('d-m-Y',strtotime($servicio['fecha_viajefin'])) : ''}}</td>
                                <td>{{$servicio['tipo'] ? 'IDA ('.$servicio['desde'].'/'.$servicio['hasta'].') - VUELTA ('.$servicio['desderetorno'].'/'.$servicio['hastaretorno'].') ': 'IDA ('.$servicio['desde'].'/'.$servicio['hasta'].') '}} {{$servicio['equipajevuelo'] > 0 ? 'EQUIPAJES ('.$servicio['equipajevuelo'].') ':''}}</td>
                                <td>{{$servicio['moneda']}} {{number_format($servicio['precio'],2)}}</td>
                                <td>{{$servicio['moneda']}} {{number_format($servicio['equipajevuelo'],2)}}</td>
                                <td>{{$servicio['moneda']}} {{number_format($servicio['precio']*$servicio['pax'] + $servicio['equipajevuelo'] ,2)}}</td>
                                <td>
                                    @foreach($servicio['itinerarios'] as $itinerario)
                                        @foreach($itinerario['incluye'] as $incluye)
                                            {{$incluye['servicio']}}<br>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($servicio['itinerarios'] as $itinerario)
                                        @foreach($itinerario['noincluye'] as $noincluye)
                                            {{$noincluye['servicio']}}<br>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>{{$servicio['comentariodetalle']}}</td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button"  class="btn btn-success btn-icon" wire:click="editarVuelo({{$i}})"><i class="fe fe-edit"></i></button>
                                        <button type="button"  class="btn btn-danger btn-icon" wire:click="reducirVuelo({{$i}})"><i class="fe fe-trash"></i></button>
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
                                <input type="number" name="montopago" id="montopago" class="form-control" wire:model.lazy="montopago" >
                                @error('montopago')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" col-md-4">
                                <label for="num_operacion" class="form-label">Numero Operación:</label>
                                <input type="text" name="num_operacion" id="num_operacion" class="form-control" wire:model.defer="num_operacion" >
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
                        {{-- @if($reserva!=null)
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
                        @endif --}}
                        <div class="mt-3">
                            @if($totalsoles > 0 )
                                <h4>
                                    Acuenta:  S/ {{number_format($pagosoles,2)}} &nbsp;&nbsp; Saldo:  S/ {{number_format($saldosoles,2)}} &nbsp;&nbsp; Total:  S/ {{number_format($totalsoles,2)}}
                                </h4>
                            @endif
                            @if($totaldolares > 0 )
                                <h4>
                                    Acuenta: $ {{number_format($pagodolares,2)}} &nbsp;&nbsp; Saldo:  $ {{number_format($saldodolares,2)}} &nbsp;&nbsp; Total: $ {{number_format($totaldolares,2)}}
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
                                            <th>Comentarios</th>
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
                                            <td>
                                                <div wire:ignore>
                                                    <label class="form-label" for="comentariocuota">Comentarios:</label>
                                                    <textarea class="form-control" name="comentariocuota" id="comentariocuota" rows="2" wire:model.defer="comentariocuota.{{$i}}"></textarea>
                                                </div>
                                                @error('comentariocuota')
                                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                                @enderror
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
    <div class="row">
        <div class="col-md-4 mt-4">
            <a href="{{route('reserva.index')}}">
                <button type="button" class="btn btn-danger m-2">Cancelar</button>
            </a>
            <button type="button" class="btn btn-primary m-2"
                    wire:click="registrarReserva"
                    wire:loading.attr="disabled"
                    @disabled($isSaving || !($totalsoles > 0 && count($pasajerosreserva) > 0 || $totaldolares > 0 && count($pasajerosreserva) > 0))>
                <span wire:loading wire:target="registrarReserva">Guardando...</span>
                <span wire:loading.remove wire:target="registrarReserva">Guardar Reserva</span>
            </button>     
        </div>
        @if(\Auth::user()->roles[0]->id == 1)
            <div class="col-md-3">
                <label for="vendedorId" class="form-label">Counter:</label>
                <select class="form-select js-states" id="vendedorId" name="vendedorId" data-width="100%" wire:model.defer="vendedorId">
                    <option value="">SELECCIONE</option>
                    @foreach($vendedores as $vendedor)
                        <option value="{{$vendedor->id}}">{{$vendedor->nombre}}</option>
                    @endforeach
                </select>
                @error('vendedorId')
                    <span class="error-message" style="color:red">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="fechaReserva" class="form-label">Fecha Registro:</label>
                <input type="date" name="fechaReserva" id="fechaReserva" class="form-control" wire:model.defer="fechaReserva">
                @error('fechaReserva')
                    <span class="error-message" style="color:red">{{ $message }}</span>
                @enderror
            </div>
        @endif
    </div>

    <!-- Large Modal -->
    <div class="modal fade" id="modalPasajero" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Agregar Pasajero</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class=" col-md-4">
                            <label for="documento" class="form-label">Documento:</label>
                            <select class="form-select js-states" id="documento" name="documento" data-width="100%" wire:model.defer="documento">
                                <option value="DNI">DNI</option>
                                <option value="RUC">RUC</option>
                                <option value="CARNET E.">CARNET E.</option>
                                <option value="PASAPORTE">PASAPORTE</option>
                            </select>
                            @error('documento')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class=" col-md-5">
                            <label for="num_doc" class="form-label">Nº:</label>
                            <input type="text" name="num_doc" id="num_doc" class="form-control" wire:model.defer="num_doc" >
                            @error('num_doc')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                            @if ($message = Session::get('success'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button aria-label="close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-1">
                            <button type="button" class="btn btn-info me-2 mt-4" wire:click="searchDocumento()">
                                <i class="fe fe-search"></i>
                            </button>
                        </div>
                        <div class="form-group mt-5 justify-content-end col-md-2">
                            <div class="checkbox">
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="principalPasajero" name="principalPasajero" wire:model.defer="principalPasajero">
                                    <label for="principalPasajero" class="custom-control-label mt-1">Principal</label>
                                </div>
                            </div>
                        </div>

                        <div class=" col-md-4">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" name="nombres" id="nombres" class="form-control" wire:model.defer="nombres" >
                            @error('nombres')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-4">
                            <label for="apellidoPaterno" class="form-label">Apellido Paterno</label>
                            <input type="text" name="apellidoPaterno" id="apellidoPaterno" class="form-control" wire:model.defer="apellidoPaterno" >
                            @error('apellidoPaterno')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-4">
                            <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
                            <input type="text" name="apellidoMaterno" id="apellidoMaterno" class="form-control" wire:model.defer="apellidoMaterno" >
                            @error('apellidoMaterno')
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
                                        <option value="{{$pais->id}}" >{{$pais->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('pais_id')
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
                </div>
                <div class="modal-footer">
                    <button aria-label="Close" class="btn btn-danger me-2" data-bs-dismiss="modal" type="button">Cancelar</button>
                    <button type="button" wire:click="agregarPasajero()" class="btn btn-primary me-2" tabindex="4" id="botonGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Servicios -->
    <div class="modal fade" id="modalServicio" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Agregar Servicio</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class=" col-md-12">
                            <label for="servicio_id" class="form-label">Servicio:</label>
                            <div wire:ignore>
                                <select class="form-control" name="servicio_id" id="servicio_id" wire:model="servicio_id">
                                    <option value="">SELECCIONE</option>
                                    @foreach($servicios as $servicio)
                                        <option value="{{$servicio->id}}">{{$servicio->titulo}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('servicio_id')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-3">
                            <label for="pax" class="form-label">Pax:</label>
                            <input type="number" name="pax" id="pax" class="form-control" wire:model.defer="pax" >
                            @error('pax')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-3">
                            <label for="precioId" class="form-label">Tarifa:</label>
                            <select class="form-select js-states" id="precioId" name="precioId" data-width="100%" wire:model.defer="precioId">
                                <option value="">SELECCIONE</option>
                                @foreach($tarifas as $tarifa)
                                    <option value="{{$tarifa->id}}">{{$tarifa->nombre}}</option>
                                @endforeach
                            </select>
                            @error('precioId')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-3">
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
                        <div class="form-group mt-5 justify-content-end col-md-3">
                            <div class="checkbox">
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="tiposervicio" name="tiposervicio" wire:model.defer="tiposervicio">
                                    <label for="tiposervicio" class="custom-control-label mt-1">Privado</label>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <label for="fecha_viaje" class="form-label">Fecha:</label>
                            <input type="date" name="fecha_viaje" id="fecha_viaje" class="form-control" wire:model.defer="fecha_viaje" >
                            @error('fecha_viaje')
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
                        @foreach($itinerarios as $i => $itinetario)
                            @if(count($itinerarios) > 1 )
                            <span>
                                Día {{$i+1}}
                            </span>
                            @endif
                            <div class=" col-md-12" >
                                <label class="form-label" for="incluye{{$i}}">Incluye:</label>
                                <div wire:ignore>
                                    <select class="form-control" name="incluye" id="incluye{{$i}}" wire:model.defer="incluye.{{$i}}" multiple>
                                        @foreach($incluyeServicios as $incluye)
                                            <option value="{{$incluye->id}}">{{$incluye->titulo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('incluye')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" col-md-12" >
                                <label class="form-label" for="noincluye{{$i}}">No Incluye:</label>
                                <div wire:ignore>
                                    <select class="form-control" name="noincluye" id="noincluye{{$i}}" wire:model.defer="noincluye.{{$i}}" multiple>
                                        @foreach($incluyeServicios as $incluye)
                                            <option value="{{$incluye->id}}">{{$incluye->titulo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('noincluye')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12">
                        <div>
                            <label class="form-label" for="comentarios">Comentarios:</label>
                            <textarea class="form-control" name="comentarios" id="comentarios" rows="2" wire:model.defer="comentariodetalle"></textarea>
                        </div>
                        @error('comentariodetalle')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <button aria-label="Close" class="btn btn-danger me-2" data-bs-dismiss="modal" type="button">Cancelar</button>
                    <button type="button" wire:click="agregarServicio()" class="btn btn-primary me-2" tabindex="4" id="botonGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hotel -->
    <div class="modal fade" id="modalHotel" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Agregar Hotel</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class=" col-md-12">
                            <label for="hotel_id" class="form-label">Hotel:</label>
                            <div wire:ignore>
                                <select class="form-control" name="hotel_id" id="hotel_id" wire:model="hotel_id">
                                    <option value="">SELECCIONE</option>
                                    @foreach($hoteles as $hotel)
                                        <option value="{{$hotel->id}}">{{$hotel->proveedor?->nombre}} {{$hotel->proveedor?->ubicacion?->nombre}} {{$hotel->titulo}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('hotel_id')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-3">
                            <label for="paxhotel" class="form-label">Cant.:</label>
                            <input type="number" name="paxhotel" id="paxhotel" class="form-control" wire:model.defer="paxhotel" >
                            @error('paxhotel')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class=" col-md-2">
                            <label for="cantidadHabitaciones" class="form-label">Noches:</label>
                            <input type="number" name="cantidadHabitaciones" id="cantidadHabitaciones" class="form-control" wire:model.defer="cantidadHabitaciones" >
                            @error('cantidadHabitaciones')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class=" col-md-3">
                            <label for="moneda_idhotel" class="form-label">Moneda:</label>
                            <select class="form-select js-states" id="moneda_idhotel" name="moneda_idhotel" data-width="100%" wire:model.defer="moneda_idhotel">
                                <option value="">SELECCIONE</option>
                                @foreach($monedas as $moneda)
                                    <option value="{{$moneda->id}}">{{$moneda->nombre}}</option>
                                @endforeach
                            </select>
                            @error('moneda_idhotel')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-3">
                            <label for="preciohotel" class="form-label">Precio:</label>
                            <input type="number" name="preciohotel" id="preciohotel" class="form-control" wire:model.defer="preciohotel" >
                            @error('preciohotel')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-3">
                            <label for="adicionalHotel" class="form-label">Early Checking:</label>
                            <input type="number" name="adicionalHotel" id="adicionalHotel" class="form-control" wire:model.defer="adicionalHotel" >
                            @error('adicionalHotel')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-3">
                            <label for="fecha_viajehotel" class="form-label">Fecha Check inn:</label>
                            <input type="date" name="fecha_viajehotel" id="fecha_viajehotel" class="form-control" wire:model.defer="fecha_viajehotel" >
                            @error('fecha_viajehotel')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-3">
                            <label for="checkinn_hotel" class="form-label">Hora Check inn:</label>
                            <input type="time" name="checkinn_hotel" id="checkinn_hotel" class="form-control" wire:model.defer="checkinn_hotel" >
                            @error('checkinn_hotel')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-3">
                            <label for="fecha_viajehotelfin" class="form-label">Fecha Fin:</label>
                            <input type="date" name="fecha_viajehotelfin" id="fecha_viajehotelfin" class="form-control" wire:model.defer="fecha_viajehotelfin" >
                            @error('fecha_viajehotelfin')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-3">
                            <label for="checkout_hotel" class="form-label">Hora Check out:</label>
                            <input type="time" name="checkout_hotel" id="checkout_hotel" class="form-control" wire:model.defer="checkout_hotel" >
                            @error('checkout_hotel')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        @foreach($itinerarioshotel as $i => $itinetario)
                            @if(count($itinerarioshotel) > 1 )
                            <span>
                                Día {{$i+1}}
                            </span>
                            @endif
                            <div class=" col-md-12" >
                                <label class="form-label" for="incluyehotel{{$i}}">Incluye:</label>
                                <div wire:ignore>
                                    <select class="form-control" name="incluyehotel" id="incluyehotel{{$i}}" wire:model.defer="incluyehotel.{{$i}}" multiple>
                                        @foreach($incluyeHoteles as $incluye)
                                            <option value="{{$incluye->id}}">{{$incluye->titulo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('incluyehotel')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" col-md-12" >
                                <label class="form-label" for="noincluyehotel{{$i}}">No Incluye:</label>
                                <div wire:ignore>
                                    <select class="form-control" name="noincluyehotel" id="noincluyehotel{{$i}}" wire:model.defer="noincluyehotel.{{$i}}" multiple>
                                        @foreach($incluyeHoteles as $incluye)
                                            <option value="{{$incluye->id}}">{{$incluye->titulo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('noincluyehotel')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach
                        <div class=" col-md-12" >
                            <div >
                                <label class="form-label" for="comentariodetallehotel">Comentarios:</label>
                                <textarea class="form-control" name="comentariodetallehotel" id="comentariodetallehotel" rows="2" wire:model.defer="comentariodetallehotel"></textarea>
                            </div>
                            @error('comentariodetallehotel')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button aria-label="Close" class="btn btn-danger me-2" data-bs-dismiss="modal" type="button">Cancelar</button>
                    <button type="button" wire:click="agregarHotel()" class="btn btn-primary me-2" tabindex="4" id="botonGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Vuelo -->
    <div class="modal fade" id="modalVuelo" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Agregar Vuelo</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class=" col-md-12">
                            <label for="vuelo_id" class="form-label">Vuelo:</label>
                            <div wire:ignore>
                                <select class="form-control" name="vuelo_id" id="vuelo_id" wire:model="vuelo_id">
                                    <option value="">SELECCIONE</option>
                                    @foreach($vuelos as $vuelo)
                                        <option value="{{$vuelo->id}}">{{$vuelo->titulo}} / {{$vuelo->proveedor?->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('vuelo_id')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        @foreach($itinerariosvuelo as $i => $itinetario)
                            @if(count($itinerariosvuelo) > 1 )
                            <span>
                                Día {{$i+1}}
                            </span>
                            @endif
                            <div class=" col-md-12" >
                                <label class="form-label" for="incluyevuelo{{$i}}">Incluye:</label>
                                <div wire:ignore>
                                    <select class="form-control" name="incluyevuelo" id="incluyevuelo{{$i}}" wire:model.defer="incluyevuelo.{{$i}}" multiple>
                                        @foreach($incluyeVuelos as $incluye)
                                            <option value="{{$incluye->id}}">{{$incluye->titulo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('incluyevuelo')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class=" col-md-4">
                            <label for="paxvuelo" class="form-label">Pax:</label>
                            <input type="number" name="paxvuelo" id="paxvuelo" class="form-control" wire:model.defer="paxvuelo" >
                            @error('paxvuelo')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-4">
                            <label for="moneda_idvuelo" class="form-label">Moneda:</label>
                            <select class="form-select js-states" id="moneda_idvuelo" name="moneda_idvuelo" data-width="100%" wire:model.defer="moneda_idvuelo">
                                <option value="">SELECCIONE</option>
                                @foreach($monedas as $moneda)
                                    <option value="{{$moneda->id}}">{{$moneda->nombre}}</option>
                                @endforeach
                            </select>
                            @error('moneda_idvuelo')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-4">
                            <label for="preciovuelo" class="form-label">Precio Total:</label>
                            <input type="number" name="preciovuelo" id="preciovuelo" class="form-control" wire:model.defer="preciovuelo" >
                            @error('preciovuelo')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-5 justify-content-end col-md-6">
                            <div class="checkbox">
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="tipovuelo" name="tipovuelo" wire:model="tipovuelo">
                                    <label for="tipovuelo" class="custom-control-label mt-1">Ida / Vuelta</label>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-4">
                            <label for="preciovuelo" class="form-label">Equipaje:</label>
                            <input type="number" name="equipajevuelo" id="equipajevuelo" class="form-control" wire:model.defer="equipajevuelo" >
                            @error('equipajevuelo')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <h4>Ida</h4>
                        </div>
                        <div class="col-md-4">
                            <div wire:ignore>
                                <label class="form-label" for="desde">Desde:</label>
                                <select class="form-select" id="desde" name="desde" data-width="100%" wire:model.defer="desde">
                                    <option value="">SELECCIONE</option>
                                    @foreach ($aeropuertos as $aeropuerto)
                                        <option value="{{ $aeropuerto->abrev }}"> ({{ $aeropuerto->abrev }})
                                            {{ $aeropuerto->nombre }} {{ $aeropuerto->ciudad }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('desde')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div wire:ignore>
                                <label class="form-label" for="hasta">Hasta:</label>
                                <select class="form-select" id="hasta" name="hasta" data-width="100%" wire:model.defer="hasta">
                                    <option value="">SELECCIONE</option>
                                    @foreach ($aeropuertos as $aeropuerto)
                                        <option value="{{ $aeropuerto->abrev }}"> ({{ $aeropuerto->abrev }})
                                            {{ $aeropuerto->nombre }} {{ $aeropuerto->ciudad }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('hasta')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-4">
                            <label for="fecha_viajevuelo" class="form-label">Fecha Ida:</label>
                            <input type="datetime-local" name="fecha_viajevuelo" id="fecha_viajevuelo" class="form-control" wire:model.defer="fecha_viajevuelo" >
                            @error('fecha_viajevuelo')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @if($tipovuelo == 1)
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Vuelta</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div wire:ignore>
                                    <label class="form-label" for="desderetorno">Desde:</label>
                                    <select class="form-select" id="desderetorno" name="desderetorno" data-width="100%" wire:model.defer="desderetorno">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($aeropuertos as $aeropuerto)
                                            <option value="{{ $aeropuerto->abrev }}"> ({{ $aeropuerto->abrev }})
                                                {{ $aeropuerto->nombre }} {{ $aeropuerto->ciudad }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('desderetorno')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div wire:ignore>
                                    <label class="form-label" for="hastaretorno">Hasta:</label>
                                    <select class="form-select" id="hastaretorno" name="hastaretorno" data-width="100%" wire:model.defer="hastaretorno">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($aeropuertos as $aeropuerto)
                                            <option value="{{ $aeropuerto->abrev }}"> ({{ $aeropuerto->abrev }})
                                                {{ $aeropuerto->nombre }} {{ $aeropuerto->ciudad }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('hastaretorno')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" col-md-4">
                                <label for="fecha_viajevuelofin" class="form-label">Fecha Retorno:</label>
                                <input type="datetime-local" name="fecha_viajevuelofin" id="fecha_viajevuelofin" class="form-control" wire:model.defer="fecha_viajevuelofin" >
                                @error('fecha_viajevuelofin')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12" >
                            <div wire:ignore>
                                <label class="form-label" for="comentariodetallevuelo">Comentarios:</label>
                                <textarea class="form-control" name="comentariodetallevuelo" id="comentariodetallevuelo" rows="2" wire:model.defer="comentariodetallevuelo"></textarea>
                            </div>
                            @error('comentariodetallevuelo')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button aria-label="Close" class="btn btn-danger me-2" data-bs-dismiss="modal" type="button">Cancelar</button>
                    <button type="button" wire:click="agregarVuelo()" class="btn btn-primary me-2" tabindex="4" id="botonGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('custom-scripts')
<script>

document.addEventListener('livewire:load', function () {

    var simpleList = document.querySelector("#cuerpoServicio");
    new Sortable(simpleList, {
        animation: 150,
        ghostClass: 'bg-light',
        onEnd: function(evt) {
            var ordenElementos = Array.from(simpleList.children).map(function(elemento) {
                return elemento.id; // Supongamos que los elementos tienen una ID única
            });

            Livewire.emit('actualizarOrdenServicios', ordenElementos); // Llama al método de Livewire para actualizar el orden
        }
    });

    // Inicialización inicial
    inicializarSelect2();

    // Escuchar eventos de Livewire para reinicializar Select2 después de la actualización
    Livewire.hook('message.processed', (message, component) => {
        inicializarSelect2();
    });
});

function inicializarSelect2() {
    // Inicializar todos los Select2 aquí
    $('#vendedorId').select2({
        width: '100%'
    }).on('change', function (e) {
        @this.set('vendedorId', this.value);
    });

    $('#servicio_id').select2({
        dropdownParent: $("#modalServicio"),
        width: '100%'
    }).on('change', function (e) {
        @this.set('servicio_id', this.value);
    });

    $('#incluye0').select2({
        dropdownParent: $("#modalServicio"),
        width: '100%',
        multiple: true
    }).on('change', function (e) {
        @this.set('incluye.0', $(this).val());
    });

    $('#noincluye0').select2({
        dropdownParent: $("#modalServicio"),
        width: '100%',
        multiple: true
    }).on('change', function (e) {
        @this.set('noincluye.0', $(this).val());
    });

    $('#incluye1').select2({
        dropdownParent: $("#modalServicio"),
        width: '100%',
        multiple: true
    }).on('change', function (e) {
        @this.set('incluye.1', $(this).val());
    });

    $('#noincluye1').select2({
        dropdownParent: $("#modalServicio"),
        width: '100%',
        multiple: true
    }).on('change', function (e) {
        @this.set('noincluye.1', $(this).val());
    });

    $('#incluye2').select2({
        dropdownParent: $("#modalServicio"),
        width: '100%',
        multiple: true
    }).on('change', function (e) {
        @this.set('incluye.2', $(this).val());
    });

    $('#noincluye2').select2({
        dropdownParent: $("#modalServicio"),
        width: '100%',
        multiple: true
    }).on('change', function (e) {
        @this.set('noincluye.2', $(this).val());
    });

    $('#hotel_id').select2({
        dropdownParent: $("#modalHotel"),
        width: '100%',
    }).on('change', function (e) {
        @this.set('hotel_id', $(this).val());
    });

    $('#pais_id').select2({
        dropdownParent: $("#modalPasajero"),
        width: '100%',
    }).on('change', function (e) {
        @this.set('pais_id', $(this).val());
    });

    $('#incluyehotel0').select2({
        dropdownParent: $("#modalHotel"),
        width: '100%',
        multiple: true
    }).on('change', function (e) {
        @this.set('incluyehotel.0', $(this).val());
    });

    $('#noincluyehotel0').select2({
        dropdownParent: $("#modalHotel"),
        width: '100%',
        multiple: true
    }).on('change', function (e) {
        @this.set('noincluyehotel.0', $(this).val());
    });

    $('#vuelo_id').select2({
        dropdownParent: $("#modalVuelo"),
        width: '100%',
    }).on('change', function (e) {
        @this.set('vuelo_id', $(this).val());
    });

    $('#incluyevuelo0').select2({
        dropdownParent: $("#modalVuelo"),
        width: '100%',
        multiple: true
    }).on('change', function (e) {
        @this.set('incluyevuelo.0', $(this).val());
    });

    $('#noincluyevuelo0').select2({
        dropdownParent: $("#modalVuelo"),
        width: '100%',
        multiple: true
    }).on('change', function (e) {
        @this.set('noincluyevuelo.0', $(this).val());
    });

    $('#desde').select2({
        dropdownParent: $("#modalVuelo"),
        width: '100%',
    }).on('change', function (e) {
        @this.set('desde', $(this).val());
    });

    $('#hasta').select2({
        dropdownParent: $("#modalVuelo"),
        width: '100%',
    }).on('change', function (e) {
        @this.set('hasta', $(this).val());
    });

    $('#desderetorno').select2({
        dropdownParent: $("#modalVuelo"),
        width: '100%',
    }).on('change', function (e) {
        @this.set('desderetorno', $(this).val());
    });

    $('#hastaretorno').select2({
        dropdownParent: $("#modalVuelo"),
        width: '100%',
    }).on('change', function (e) {
        @this.set('hastaretorno', $(this).val());
    });

    $('#medio_pago').select2({
        width: '100%',
    }).on('change', function (e) {
        @this.set('medio_pago', $(this).val());
    });
}

Livewire.on('cerrarPasajero', function () {
    $('#modalPasajero').modal('hide');
});

Livewire.on('cerrarServicio', function () {
    $('#modalServicio').modal('hide');
});

Livewire.on('cerrarHotel', function () {
    $('#modalHotel').modal('hide');
});

Livewire.on('cerrarVuelo', function () {
    $('#modalVuelo').modal('hide');
});



Livewire.on('EncontrarPasajero', function (id_pais) {
    $('#modalPasajero').modal('show');
    $('#pais_id').select2().val(id_pais).trigger('change.select2');
});

Livewire.on('EncontrarServicio', function (id, ids, ids2, idSelect) {
    $('#modalServicio').modal('show');

    // Actualizar valores de Select2 para servicio_id
    $('#servicio_id').select2().val(id).trigger('change.select2');

    $('#incluye' + idSelect).select2().val(ids).trigger('change.select2');

    $('#noincluye' + idSelect).select2().val(ids2).trigger('change.select2');

});

Livewire.on('EncontrarHotel', function (id, ids, ids2) {
    $('#modalHotel').modal('show');
    // Actualizar valores de Select2
    $('#hotel_id').select2().val(id).trigger('change.select2');

    $('#incluyehotel0').select2().val(ids).trigger('change.select2');

    $('#noincluyehotel0').select2().val(ids2).trigger('change.select2');

});

Livewire.on('EncontrarVuelo', function (id, ids, ids2,desde,hasta,desderetorno,hastaretorno) {

    $('#modalVuelo').modal('show');
    // Actualizar valores de Select2
    $('#vuelo_id').select2().val(id).trigger('change.select2');

    $('#incluyevuelo0').select2().val(ids).trigger('change.select2');

    $('#noincluyevuelo0').select2().val(ids2).trigger('change.select2');

    $('#desde').select2().val(desde).trigger('change.select2');

    $('#hasta').select2().val(hasta).trigger('change.select2');

    $('#desderetorno').select2().val(desderetorno).trigger('change.select2');

    $('#hastaretorno').select2().val(hastaretorno).trigger('change.select2');

});

Livewire.on('LlenarMedio', function (id,datos) {
    $('#medio_pago').empty().val(id).select2({
        data: datos,
    });
});

</script>
@endpush

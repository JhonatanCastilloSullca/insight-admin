<div>
    <div class="row" wire:ignore.self>
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row pb-4">
                        <div class="col-md-2">
                            <label for="searchFechaInicio" class="form-label">Fecha Inicio</label>
                            <input type="date" class="form-control" wire:model.defer="fecha_inicio">
                        </div>
                        <div class="col-md-2">
                            <label for="searchFechaFin" class="form-label">Fecha Fin</label>
                            <input type="date" class="form-control" wire:model.defer="fecha_fin">
                        </div>
                        <div class="col-md-2">
                            <label for="searchServicio" class="form-label">Servicio</label>
                            <div class="form-group" wire:ignore>
                                <select name="servicioFilter" class="form-control form-select" id="servicioFilter" wire:model.defer="servicioFilter">
                                    <option value="">TODOS</option>
                                    @foreach ($servicios as $servicio)
                                        <option value="{{ $servicio->id }}"> {{ $servicio->titulo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="searchFechaFin" class="form-label">Nombre</label>
                            <input type="text" class="form-control" wire:model.defer="searchText">
                        </div>
                        <div class="col-md-2">
                            <label for="searchServicio" class="form-label">Pagado</label>
                            <div class="form-group" wire:ignore>
                                <select name="pagado" class="form-control form-select" id="pagado" wire:model.defer="pagado">
                                    <option value="">TODOS</option>
                                    <option value="1">PAGADO</option>
                                    <option value="2">COBRAR</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button wire:click="buscarDetalles" class="btn btn-warning mt-4">
                                <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fas fa-search"></i><b>&nbsp; Buscar</b>
                            </button>
                            <button wire:click="excelBiblia" class="btn btn-success mt-4">
                                <i data-bs-toggle="tooltip" data-bs-title="Descargar Excel" class="fa fa-file"></i><b>&nbsp; Excel</b>
                            </button>
                            {{-- <button wire:click="limpiarDetalles" class="btn btn-secondary mt-4">
                                <i data-bs-toggle="tooltip" data-bs-title="Crear" class="far fa-trash-alt"></i><b>&nbsp; Limpiar</b>
                            </button> --}}
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @endif
                    <div class="table-responsive table-vh-60">
                        <table id="servicios" class="table table-hover">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" wire:model="selectAll" id="marcarTodos"></th>
                                    <th class="no-wrap">Fail</th>
                                    <th class="no-wrap">Fecha</th>
                                    <th>Acuenta</th>
                                    <th>Saldo</th>
                                    <th>Total</th>
                                    <th>Pagado</th>
                                    <th>Contabilidad</th>
                                    <th class="no-wrap">Celular</th>
                                    <th class="no-wrap">Nombre Pasajero</th>
                                    <th>Edad</th>
                                    <th>Pais</th>
                                    <th>Pax</th>
                                    <th>Hotel / Recojo</th>
                                    <th class="no-wrap">Servicio</th>
                                    <th>Counter</th>
                                    <th>Operadores</th>
                                    <th>Comentarios</th>
                                    <th>Overview</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detallesReserva as $i => $detallereserva)
                                <tr class="fila-reserva" data-id="{{ $detallereserva->id }}" style="background:{{$detallereserva->servicio->color}}33;">
                                    <td>
                                        @if($detallereserva->operado == 0)
                                            <input type="checkbox" wire:model="selected" value="{{ $detallereserva->id }}">
                                        @else
                                        <h6 class="text-succes"><i class="fa fa-check-circle"></i></h6>
                                        @endif
                                    </td>
                                    <td class="no-wrap">
                                        <a class="btn btn-warning btn-icon" href="{{route('reserva.voucheroficina', $detallereserva->reserva)}}" target="_blank">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                    <td class="no-wrap">
                                        {{date("d-m-Y",strtotime($detallereserva->fecha_viaje))}}
                                    </td>
                                    <td class="no-wrap">
                                        @foreach($detallereserva->reserva->totales as $total)
                                            {{$total->moneda->abreviatura}} {{$total->acuenta}} <br>
                                        @endforeach
                                    </td>
                                    <td class="no-wrap">
                                        @foreach($detallereserva->reserva->totales as $total)
                                            @if($total->saldo > 0)
                                                <a class="cursor-pointer" wire:click="agregarPago({{$detallereserva->id}},{{$total->moneda_id}})">
                                                    {{$total->moneda->abreviatura}} {{$total->saldo}} <br>
                                                </a>
                                            @else
                                                {{$total->moneda->abreviatura}} {{$total->saldo}} <br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="no-wrap">
                                        @foreach($detallereserva->reserva->totales as $total)
                                            {{$total->moneda->abreviatura}} {{$total->total}} <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <h6><span class="badge bg-{{$detallereserva->reserva->pagado == 0 ? 'danger':'success'}} me-1 my-2">{{$detallereserva->reserva->pagado == 0 ? 'COBRAR':'PAGADO'}}</span></h6>
                                    </td>
                                    <td>
                                        @if(\Auth::user()->roles[0]->name == 'Administrador')
                                            <a class="cursor-pointer" wire:click="contabilidad({{$detallereserva->id}},{{$detallereserva->reserva->contabilidad}})">
                                                <h6 class="text-{!!$detallereserva->reserva->contabilidad == 1 ? 'success':'danger' !!}">{!!$detallereserva->reserva->contabilidad == 1 ? '<i class="fa fa-check-circle"></i>':'<i class="fa fa-times-circle"></i>' !!}</h6>
                                            </a>
                                        @else
                                            <h6 class="text-{!!$detallereserva->reserva->contabilidad == 1 ? 'success':'danger' !!}">{!!$detallereserva->reserva->contabilidad == 1 ? '<i class="fa fa-check-circle"></i>':'<i class="fa fa-times-circle"></i>' !!}</h6>
                                        @endif
                                    </td>
                                    <td class="no-wrap">
                                        {{$detallereserva->reserva->pasajeroprincipal()?->celular}}
                                    </td>
                                    <td class="no-wrap">
                                        {{$detallereserva->reserva->pasajeroprincipal()?->nombreCompleto}} {!! $detallereserva->reserva->pasajeroscumpleaños($detallereserva->fecha_viaje) ? '<span class="mdi mdi-cake-variant"></span>' : '' !!}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($detallereserva->reserva->pasajeroprincipal()?->nacimiento)->diffInYears(\Carbon\Carbon::now()) }} 
                                    </td>
                                    <td class="no-wrap">
                                        {{$detallereserva->reserva->pasajeroprincipal()?->pais->nombre}}
                                    </td>
                                    <td>
                                        {{$detallereserva->pax}}
                                    </td>
                                    <td>
                                        <a class="cursor-pointer" wire:click="agregarHotel({{$detallereserva->id}})">
                                            {{isset($detallereserva->hotel->nombre) ? $detallereserva->hotel->nombre : '+'}}
                                        </a>
                                        {!!$detallereserva->hotelJisa == 1 ? '<i class="fa fa-star"></i>':'' !!}
                                    </td>
                                    <td class="no-wrap">
                                        {{$detallereserva->servicio?->titulo}}
                                    </td>
                                    <td>
                                        {{$detallereserva->reserva?->user->usuario}}
                                    </td>
                                    <td>
                                        @if($detallereserva->detallesoperar)
                                            @foreach($detallereserva->detallesoperar?->operar?->operarServicios as $operar)
                                                {{$operar?->proveedor?->nombre}}, 
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <a class="cursor-pointer" wire:click="agregarComentario({{$detallereserva->id}})">
                                            {{$detallereserva->comentarios != '' ? $detallereserva->comentarios : '+'}}
                                        </a>
                                    </td>
                                    <td>
                                        <h6 class="text-{!!$detallereserva->overview == 1 ? 'success':'danger' !!}">{!!$detallereserva->overview == 1 ? '<i class="fa fa-check-circle"></i>':'<i class="fa fa-times-circle"></i>' !!}</h6>
                                    </td>
                                    <td>
                                        @if($detallereserva->detallesoperar)
                                            @if($detallereserva->servicio->categoria_id == 5)
                                                <a class="btn btn-info btn-icon" href="{{route('biblia.overview',['id'=>$detallereserva->id])}}" target="_blank" wire:click="overview()">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                            @endif
                                        @endif
                                        @if($detallereserva->operarServicio)
                                            @if($detallereserva->servicio->categoria_id == 6)
                                                <a class="btn btn-info btn-icon" href="{{route('operacion.trasladosoverview',['id'=>$detallereserva->operarServicio->id])}}" target="_blank" wire:click="overview()">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                            @endif
                                        @endif
                                    </td>
                                <tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2 col-md-6">
                        <button type="button" data-bs-toggle="tooltip" wire:click="EndosarBiblia" class="btn btn-info mt-4">Endosar</button>
                        <button type="button" data-bs-toggle="tooltip" wire:click="OperarBiblia" class="btn btn-primary mt-4">Operar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Extra-large  modal -->
    <div class="modal fade" id="modalExtraTours" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Tour: {{$servicioOperar?->titulo}}</h6>
                    <div class="wd-80"></div>
                    <h6 class="modal-title">Fecha: {{$fechaOperar}}</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if ($incluyes)
                        @foreach($incluyes as $incluye)
                        <div class="mb-1 col-md-3">
                            <label for="idProveedor" class="form-label">{{$incluye->titulo}}</label>
                            <div wire:ignore>
                                <select class="form-control select2" wire:model="idProveedor.{{$incluye->id}}" id="idProveedor{{$incluye->id}}">
                                    <option value="">Seleccion</option>
                                    @foreach ($incluye->categoria->proveedores as $proveedores)
                                    <option value="{{$proveedores->id}}">{{$proveedores->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-1 col-md-3">
                            <label class="form-label" for="precio">Precio:</label>
                            <input type="number" step="0.01" class="form-control" min="1" wire:model="precioServicio.{{$incluye->id}}">
                            @error('precioServicio.'.$incluye->id)
                            <span class="error-message" style="color:red">Campo Obligatorio</span>
                            @enderror
                        </div>
                        @endforeach
                        @endif
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover mb-0 text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Pax.</th>
                                                    <th>Nombre Pax. Principal</th>
                                                    <th>Telefono</th>
                                                    <th>Nacionalidad</th>
                                                    <th>Ingresos</th>
                                                    <th>Observaciones</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($detallesReservaOperar)
                                                @foreach ($detallesReservaOperar as $i => $detalle)
                                                @if ($detalle->reserva && $detalle->reserva->pasajeros->isNotEmpty())
                                                <tr>
                                                    <td>{{ $detalle->pax }}</td>
                                                    <td>{{ $detalle->reserva->pasajeros[0]->nombres ?? '' }}</td>
                                                    <td>{{ $detalle->reserva->pasajeros[0]->celular ?? '' }}</td>
                                                    <td>{{ $detalle->reserva->pasajeros[0]->pais->iso ?? '' }}</td>
                                                    <td>
                                                        <input type="number" min="0" step="0.01" class="form-control" name="ingresos" id="ingresos.{{$i}}" wire:model.lazy="ingresos.{{$i}}">
                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control" name="horarios" id="horarios.{{$i}}" wire:model.lazy="horarios.{{$i}}" />
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="observaciones" id="observaciones.{{$i}}" wire:model.lazy="observaciones.{{$i}}">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-icon btn-danger me-1 d-none d-sm-flex" wire:click.prevent="remove({{$i}})">
                                                            <i class="fe fe-trash"></i>{{ $i }}
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><b>Cantidad Pax.</b></td>
                                                    <td>{{$pax}}</td>
                                                    <td><b>Ingresos</b></td>
                                                    <td>{{$sumaingresos}}</td>
                                                    <td><b>Observaciones</b></td>
                                                    <td>{{$concatobservaciones}}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" wire:click="OperarDetalles" class="btn ripple btn-secondary">Operar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Large Modal -->
    <div class="modal fade" id="modalExtraHotel" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Hotel: {{$servicioOperar?->titulo}}</h6>
                    <div class="wd-80"></div>
                    <h6 class="modal-title">Fecha: {{$fechaOperar}}</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if ($servicioOperar)
                        <div class="mb-1 col-md-12">
                            <label for="idProveedor" class="form-label">Proveedor de Hotel</label>
                            <div wire:ignore>
                                <select class="form-control select2" wire:model="idProveedor.{{$servicioOperar->id}}" id="idProveedor{{$servicioOperar->id}}">
                                    <option value="">Seleccion</option>
                                    @foreach ($servicioOperar->categoria->proveedores as $proveedores)
                                    <option value="{{$proveedores->id}}">{{$proveedores->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="precio">Cantidad Pax: </label>
                            <input type="number" step="1" class="form-control" min="1" wire:model="pax">
                            @error('precioServicio.'.$servicioOperar->id)
                            <span class="error-message" style="color:red">Campo Obligatorio</span>
                            @enderror
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="precio">Precio: </label>
                            <input type="number" step="0.01" class="form-control" min="1" wire:model="sumaingresos">
                            @error('precioServicio.'.$servicioOperar->id)
                            <span class="error-message" style="color:red">Campo Obligatorio</span>
                            @enderror
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="precio">Fecha: </label>
                            <input type="date" class="form-control" wire:model="fechaOperar">
                            @error('precioServicio.'.$servicioOperar->id)
                            <span class="error-message" style="color:red">Campo Obligatorio</span>
                            @enderror
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" wire:click="OperarDetallesHotel" class="btn ripple btn-secondary">Operar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Large Modal -->
    <div class="modal fade" id="modalExtraVuelo" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Vuelo: {{$servicioOperar?->titulo}}</h6>
                    <div class="wd-80"></div>
                    <h6 class="modal-title">Fecha: {{$fechaOperar}}</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if ($servicioOperar)
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="VueloOperar">Vuelo: </label>
                            <input type="text" class="form-control" wire:model="VueloOperar">
                            @error('VueloOperar')
                            <span class="error-message" style="color:red">Campo Obligatorio</span>
                            @enderror
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="pax">Cantidad Pax: </label>
                            <input type="number" step="1" class="form-control" min="1" wire:model="pax">
                            @error('pax')
                            <span class="error-message" style="color:red">Campo Obligatorio</span>
                            @enderror
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="sumaingresos">Precio: </label>
                            <input type="number" step="0.01" class="form-control" min="1" wire:model="sumaingresos">
                            @error('sumaingresos')
                            <span class="error-message" style="color:red">Campo Obligatorio</span>
                            @enderror
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="HorarioOperar">Horario: </label>
                            <input type="time" class="form-control" wire:model="HorarioOperar">
                            @error('HorarioOperar')
                            <span class="error-message" style="color:red">Campo Obligatorio</span>
                            @enderror
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" wire:click="OperarDetallesVuelo" class="btn ripple btn-secondary">Operar</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Endose Tour-->
    <div class="modal fade" id="modalEndoseTour" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <div class="grid">
                        <h6 class="modal-title">Tour: {{$servicioOperar?->titulo}}</h6>
                        <h6 class="modal-title">Fecha: {{$fechaOperar}}</h6>
                    </div>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-1 col-md-12">
                            <div wire:ignore>
                                <label for="idProveedor" class="form-label">Proveedor Endose:</label>
                                <select class="form-control select2" wire:model="idProveedor" id="idProveedor">
                                    <option value="">Seleccion</option>
                                    @foreach ($ProveedorEndose as $proveedores)
                                    <option value="{{$proveedores->id}}">{{$proveedores->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="precioEndose">Precio: </label>
                            <input type="number" step="1" class="form-control" min="1" wire:model="precioEndose">
                            @error('precioEndose')
                            <span class="error-message" style="color:red">Campo Obligatorio</span>
                            @enderror
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="recojoEndose">Recojo: </label>
                            <input type="time" class="form-control" name="recojoEndose" id="recojoEndose" wire:model.lazy="recojoEndose" />
                            @error('recojoEndose')
                            <span class="error-message" style="color:red">Campo Obligatorio</span>
                            @enderror
                        </div>
                        <div class="mb-1 col-md-12">
                            <label class="form-label" for="observacionEndose">Observación: </label>
                            <input type="text" step="1" class="form-control" min="1" wire:model="observacionEndose">
                            @error('observacionEndose')
                            <span class="error-message" style="color:red">Campo Obligatorio</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" wire:click="EndoseOperar" type="button">Endosar</button>
                    <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hotel -->
    <div class="modal fade" id="modalHotel" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Agregar Hotel / Recojo</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="hotelId" class="form-label">Buscar Hotel:</label>
                            <div class="d-flex">
                                <div wire:ignore style="flex-grow: 1;"> <!-- Asegura que el select ocupe todo el ancho -->
                                    <select class="form-control" name="hotelId" id="hotelId" wire:model="hotelId">
                                        <option value="">SELECCIONE</option>
                                        @foreach($proveedores as $proveedor)
                                            <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="input-group-text" style="cursor: pointer;" wire:click="cambiarhotelNuevo()">
                                    {{$hotelNuevo == 0 ? '+' : '-'}}
                                </span>
                            </div>
                            @error('hotelId')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @if($hotelNuevo == 1)
                        <div class="row">
                            <div class="col-md-12">
                                <label for="nuevoHotel" class="form-label">Nuevo Hotel:</label>
                                <input type="text" name="nuevoHotel" id="nuevoHotel" class="form-control" wire:model.defer="nuevoHotel" >
                                @error('nuevoHotel')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class=" col-md-4">
                            <label for="direccionHotel" class="form-label">Dirección:</label>
                            <input type="text" name="direccionHotel" id="direccionHotel" class="form-control" wire:model.defer="direccionHotel" >
                            @error('direccionHotel')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-4">
                            <label for="celularHotel" class="form-label">Celular:</label>
                            <input type="text" name="celularHotel" id="celularHotel" class="form-control" wire:model.defer="celularHotel" >
                            @error('celularHotel')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-5 justify-content-end col-md-2">
                            <div class="checkbox">
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="todosHotel" name="todosHotel" wire:model.defer="todosHotel">
                                    <label for="todosHotel" class="custom-control-label mt-1">Todos Cusco</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-5 justify-content-end col-md-2">
                            <div class="checkbox">
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="todosHotelLima" name="todosHotelLima" wire:model.defer="todosHotelLima">
                                    <label for="todosHotelLima" class="custom-control-label mt-1">Todos Lima</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button aria-label="Close" class="btn btn-danger me-2" data-bs-dismiss="modal" type="button">Cancelar</button>
                    <button type="button" wire:click="guardarHotel()" class="btn btn-primary me-2" tabindex="4" id="botonGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hotel -->
    <div class="modal fade" id="modalComentario" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Agregar Comentarios</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class=" col-md-12">
                            <label for="comentarioDetalle" class="form-label">Comentario:</label>
                            <textarea name="comentarioDetalle" id="comentarioDetalle" rows="2" wire:model.defer="comentarioDetalle" class="form-control"></textarea>
                            @error('comentarioDetalle')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button aria-label="Close" class="btn btn-danger me-2" data-bs-dismiss="modal" type="button">Cancelar</button>
                    <button type="button" wire:click="guardarComentario()" class="btn btn-primary me-2" tabindex="4" id="botonGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hotel -->
    <div class="modal fade" id="modalContabilidad" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Verificar Pagos</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <table class="table table-bordered table-striped mg-b-0 text-md-nowrap">
                            <thead>
                                <tr class="text-center">
                                    <th>N°</th>
                                    <th>Medio de pago</th>
                                    <th>Fecha de pago</th>
                                    <th>Monto</th>
                                    <th>Nº Operacion</th>
                                    <th>Comentario</th>
                                    <th>Usuario</th>
                                    <th>Contabilizado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pagosContabilidad as $i => $pago)
                                    <tr>
                                        <td class="thnro">{{ ++$i }}</td>
                                        <td>{{ $pago->medio->nombre }} {{ $pago->medio->banco }}
                                            {{ $pago->medio->moneda->nombre }}</td>
                                        <td>{{ $pago->fecha }}</td>
                                        <td>{{ $pago->moneda->abreviatura }} {{ $pago->monto }}</td>
                                        <td>{{ $pago->num_operacion }}</td>
                                        <td>{{ $pago->comentarios }}</td>
                                        <td>{{ $pago->user->nombre }}</td>
                                        <td>{{ $pago->contabilidad ? 'Si' : 'No' }}</td>
                                        <td>
                                            @if(!$pago->contabilidad)
                                                <a wire:click="contabilizarpago({{$pago}})}">
                                                    <button type="button"  class="btn btn-warning btn-icon"><i class="fa fa-check-circle"></i>
                                                    </button>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button aria-label="Close" class="btn btn-danger me-2" data-bs-dismiss="modal" type="button">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- /Modal Pago -->
    <div class="modal fade" id="agregarPago" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    @if($existSaldo == 1)
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="medioIdPago">Medios</label>
                                <div wire:ignore>
                                    <select class="form-select" id="medioIdPago" name="medioIdPago" data-width="100%" wire:model="medioIdPago">
                                    </select>
                                </div>
                                @error('medioIdPago')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="montoPago" class="form-label">Monto Neto:</label>
                                <input type="number" name="montoPago" id="montoPago" class="form-control"  wire:model.defer="montoPago">
                                @error('montoPago')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="montoPorcentajePago" class="form-label">Monto Porcentaje:</label>
                                <input type="number" name="montoPorcentajePago" id="montoPorcentajePago" class="form-control"  wire:model.defer="montoPorcentajePago">
                                @error('montoPorcentajePago')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="num_operacionPago" class="form-label">Nº operacion:</label>
                                <input type="text" name="num_operacionPago" id="num_operacionPago" class="form-control"  wire:model.defer="num_operacionPago">
                                @error('num_operacionPago')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" col-md-6" >
                                <div wire:ignore>
                                    <label class="form-label" for="comentarioPago">Comentarios:</label>
                                    <textarea class="form-control" name="comentarioPago" id="comentarioPago" rows="2" wire:model.defer="comentarioPago"></textarea>
                                </div>
                                @error('comentarioPago')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <h6 class="text-red">No se encontraron pagos!!</h6>
                        </div>
                    @endif
                    <div class="modal-footer">
                        <button aria-label="Close" class="btn btn-danger me-2" data-bs-dismiss="modal" type="button">Cancelar</button>
                        <button type="button" class="btn btn-primary m-2"
                                wire:click="guardarPago"
                                wire:loading.attr="disabled">
                            <span wire:loading wire:target="guardarPago">Guardando...</span>
                            <span wire:loading.remove wire:target="guardarPago">Guardar Pago</span>
                        </button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('custom-scripts')

<script>
document.addEventListener('livewire:load', function () 
{
    // Inicialización inicial
    inicializarSelect2();

    // Escuchar eventos de Livewire para reinicializar Select2 después de la actualización
    Livewire.hook('message.processed', (message, component) => {
        inicializarSelect2();
    });
});

function inicializarSelect2() {
    $('#hotelId').select2({
        dropdownParent: $("#modalHotel"),
        width: '100%',            
    }).on('change', function (e) {
        @this.set('hotelId', this.value);
    });
    
    $('#medioIdPago').select2({
        dropdownParent: $("#agregarPago"),
        width: '100%',
    }).on('change', function (e) {
        @this.set('medioIdPago', this.value);
    });
}

    Livewire.on('modalHotel', function(id) {
        $('#modalHotel').modal('show');

        $('#hotelId').select2({
            dropdownParent: $("#modalHotel"),
            width: '100%',            
        }).val(id).trigger('change.select2');
    });

    Livewire.on('cerrarModalHotel', function(id) {
        $('#modalHotel').modal('hide');
    });

    Livewire.on('modalComentario', function(id) {
        $('#modalComentario').modal('show');
    });

    Livewire.on('cerrarModalCometario', function(id) {
        $('#modalComentario').modal('hide');
    });

    Livewire.on('modalContabilidad', function(id) {
        $('#modalContabilidad').modal('show');
    });

    Livewire.on('cerrarModalContabilidad', function(id) {
        $('#modalContabilidad').modal('hide');
    });

    Livewire.on('modalPago', function(id,datos) {
        $('#agregarPago').modal('show');

        $('#medioIdPago').select2({
            data: datos,
        }).val(id).trigger('change.select2');
    });

    Livewire.on('cerrarModalPago', function(id) {
        $('#agregarPago').modal('hide');
    });

    Livewire.on('openModalEndoseTour', function(id, datos) {
        $('#modalEndoseTour').modal('show');
        $('#idProveedor').val(id).select2({
            width: '100%'
        });
        $('#idProveedor').on('change', function(e) {
            @this.set('idProveedor', this.value);
        });
    });
    Livewire.on('openModalTours', function(id, datos) {
        $('#modalExtraTours').modal('show');
    });
    Livewire.on('llenarSelect', function(id, datos) {
        console.log(id);
        $('#idProveedor').val(id).select2({
            data: datos,
        });
        $('#idProveedor').on('change', function(e) {
            @this.set('idProveedor', this.value);
        });
    });

    Livewire.on('openModalHotel', function() {
        $('#modalExtraHotel').modal('show');
        $('.select2').select2({
            placeholder: 'Seleccione',
            width: '100%'
        });
    });

    Livewire.on('modalExtraVuelo', function() {
        $('#modalExtraVuelo').modal('show');
        $('.select2').select2({
            placeholder: 'Seleccione',
            width: '100%'
        });
    });
</script>

<script>
    $('#servicioFilter').select2({
        width: '100%'
    });
    $('#servicioFilter').on('change', function() {
        @this.set('servicioFilter', this.value);
    });
</script>
@endpush
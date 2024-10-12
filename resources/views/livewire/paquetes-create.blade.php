<div>
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Crear Paquete</span>
        </div>
        @if ($total_soles > 0 || $total_dolares > 0)
            <a class="btn ripple btn-primary">
                Total:
                @if ($total_soles > 0)
                    <span class="text-white"><strong class="fs-6"
                            style="font-size:2rem !important;">S/{{ number_format($total_soles, 2) }}</strong>
                @endif

                @if ($total_dolares > 0)
                    <span class="text-white"><strong class="fs-6"
                            style="font-size:2rem !important;">${{ number_format($total_dolares, 2) }}</strong>
                @endif
            </a>
        @endif
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="text-wrap">
                <div class="example">
                    <div class="d-md-flex">
                        <div class="">
                            <div class="panel panel-primary tabs-style-4">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu ">
                                        <ul class="nav panel-tabs me-3" wire:ignore>
                                            <li class=""><a href="#tab21" class="active" data-bs-toggle="tab">
                                                    Datos Generales</a></li>
                                            <li><a href="#tab22" data-bs-toggle="tab"> Servicios</a></li>
                                            <li><a href="#tab23" data-bs-toggle="tab"> Hoteles</a></li>
                                            <li><a href="#tab24" data-bs-toggle="tab"> Vuelos</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tabs-style-4" style="width:100%;">
                            <div class="panel-body tabs-menu-body bg-white">
                                <div class="tab-content" style="contain: inline-size">
                                    <div class="tab-pane active" id="tab21" wire:ignore.self>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="titulo" class="form-label">Titulo:</label>
                                                <input type="text" name="titulo" id="titulo" class="form-control"
                                                    wire:model.defer="titulo">
                                                @error('titulo')
                                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                                @enderror
                                                <label for="mensaje_bienvenida" class="form-label">Mensaje de
                                                    bienvenida:</label>
                                                <input type="text" name="mensaje_bienvenida" id="mensaje_bienvenida"
                                                    class="form-control" wire:model.defer="mensaje_bienvenida">
                                                @error('mensaje_bienvenida')
                                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                                @enderror
                                                <label for="video" class="form-label">Video:</label>
                                                <input type="text" name="video" id="video" class="form-control"
                                                    wire:model.defer="video">
                                                @error('video')
                                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <div class="" wire:ignore>
                                                    <label class="form-label" for="imagenprincipal">Imagen
                                                        Principal:</label>
                                                    <input type="file" name="imagenprincipal" id="imagenprincipal"
                                                        class="form-control" wire:model='imagenprincipal'>
                                                    @error('imagenprincipal')
                                                        <span class="error-message"
                                                            style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    @if (!$imagenprincipal)
                                                        @if ($originalImagenPrincipal)
                                                            <img src="{{ asset('storage/' . $originalImagenPrincipal) }}"
                                                                class="imagen-principal">
                                                        @endif
                                                    @else
                                                        <img src="{{ $imagenprincipal->temporaryUrl() }}"
                                                            class="imagen-principal">
                                                    @endif
                                                </div>

                                                <div class="" wire:ignore>
                                                    <label class="form-label" for="imagensecundario">Imagen
                                                        Secundario:</label>
                                                    <input type="file" name="imagensecundario" id="imagensecundario"
                                                        class="form-control" wire:model='imagensecundario'>
                                                    @error('imagensecundario')
                                                        <span class="error-message"
                                                            style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    @if (!$imagensecundario)
                                                        @if ($originalImagenSecundario)
                                                            <img src="{{ asset('storage/' . $originalImagenSecundario) }}"
                                                                class="imagen-secundario">
                                                        @endif
                                                    @else
                                                        <img src="{{ $imagensecundario->temporaryUrl() }}"
                                                            class="imagen-secundario">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <div wire:ignore>
                                                    <label class="form-label" for="descripcion">Descripción:</label>
                                                    <textarea class="form-control" name="descripcion" id="descripcion" rows="10" wire:model.defer="descripcion"></textarea>
                                                </div>
                                                @error('descripcion')
                                                    <span class="error-message"
                                                        style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab22" wire:ignore.self>
                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <div class="product-details table-responsive text-nowrap">
                                                    <a class="btn btn-outline-primary mx-2 button-icon"
                                                        wire:click="abrirServicio()">Agregar detalle</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-xl-12 col-md-12 table-responsive">
                                                <div class="card custom-card cart-details">
                                                    <div class="card-body table-responsive">
                                                        <h5 class="mb-3 font-weight-bold tx-14">DETALLE DE PAQUETE</h5>
                                                        <table
                                                            class="table table-responsive table-bordered table-hover mb-0 text-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Servicio</th>
                                                                    <th>Incluye</th>
                                                                    <th>No incluye</th>
                                                                    <th>Precio S/</th>
                                                                    <th>Precio $</th>
                                                                    <th>Editar</th>
                                                                    <th>Eliminar</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($serviciospaquete as $j => $detalle)
                                                                    <tr>
                                                                        <td>
                                                                            {{ $j + 1 }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $detalle['servicio'] }}
                                                                        </td>
                                                                        <td>
                                                                            @foreach ($detalle['itinerarios'] as $itinerario)
                                                                                @foreach ($itinerario['incluye'] as $incluye)
                                                                                    {{ $incluye['servicio'] }}<br>
                                                                                @endforeach
                                                                            @endforeach
                                                                        </td>
                                                                        <td>
                                                                            @foreach ($detalle['itinerarios'] as $itinerario)
                                                                                @foreach ($itinerario['noincluye'] as $noincluye)
                                                                                    {{ $noincluye['servicio'] }}<br>
                                                                                @endforeach
                                                                            @endforeach
                                                                        </td>
                                                                        <td>
                                                                            {{ $detalle['precioSoles'] }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $detalle['precioDolares'] }}
                                                                        </td>
                                                                        <td class=""
                                                                            style="text-align: -webkit-center;">
                                                                            <button type="button"
                                                                                class="btn btn-primary btn-icon"
                                                                                wire:click="editarServicio({{ $j }})"
                                                                                tabindex="90"><i
                                                                                    class="fa fa-edit"></i></button>
                                                                        </td>
                                                                        <td class=""
                                                                            style="text-align: -webkit-center;">
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-icon"
                                                                                wire:click="reducirServicio({{ $j }})"
                                                                                tabindex="90">×</button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab23" wire:ignore.self>
                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <div class="product-details table-responsive text-nowrap">
                                                    <a class="btn btn-outline-primary mx-2 button-icon"
                                                        wire:click="abrirHotel()"">Agregar detalle de Hotel</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-xl-12 col-md-12">
                                                <div class="card custom-card cart-details">
                                                    <div class="card-body table-responsive">
                                                        <h5 class="mb-3 font-weight-bold tx-14">DETALLE DE HOTEL</h5>
                                                        <table
                                                            class="table table-responsive table-bordered table-hover mb-0 text-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Noches</th>
                                                                    <th>Servicio</th>
                                                                    <th>Incluye</th>
                                                                    <th>No incluye</th>
                                                                    <th>Precio S/</th>
                                                                    <th>Precio $</th>
                                                                    <th>Editar</th>
                                                                    <th>Eliminar</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($hotelespaquete as $j => $detalle)
                                                                    <tr>
                                                                        <td>
                                                                            {{ $j + 1 }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $detalle['noches'] }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $detalle['servicio'] }}
                                                                        </td>
                                                                        <td>
                                                                            @foreach ($detalle['itinerarios'] as $itinerario)
                                                                                @foreach ($itinerario['incluye'] as $incluye)
                                                                                    {{ $incluye['servicio'] }}<br>
                                                                                @endforeach
                                                                            @endforeach
                                                                        </td>
                                                                        <td>
                                                                            @foreach ($detalle['itinerarios'] as $itinerario)
                                                                                @foreach ($itinerario['noincluye'] as $noincluye)
                                                                                    {{ $noincluye['servicio'] }}<br>
                                                                                @endforeach
                                                                            @endforeach
                                                                        </td>
                                                                        <td>
                                                                            {{ $detalle['precioSoles'] }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $detalle['precioDolares'] }}
                                                                        </td>
                                                                        <td class=""
                                                                            style="text-align: -webkit-center;">
                                                                            <button type="button"
                                                                                class="btn btn-primary btn-icon"
                                                                                wire:click="editarHotel({{ $j }})"
                                                                                tabindex="90"><i
                                                                                    class="fa fa-edit"></i></button>
                                                                        </td>
                                                                        <td class=""
                                                                            style="text-align: -webkit-center;">
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-icon"
                                                                                wire:click="reducirHotel({{ $j }})"
                                                                                tabindex="90">×</button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab24" wire:ignore.self>
                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <div class="product-details table-responsive text-nowrap">
                                                    <a class="btn btn-outline-primary mx-2 button-icon"
                                                        wire:click="abrirVuelo()">Agregar detalle de Vuelo</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-xl-12 col-md-12">
                                                <div class="card custom-card cart-details">
                                                    <div class="card-body table-responsive">
                                                        <h5 class="mb-3 font-weight-bold tx-14">DETALLE DE VUELO</h5>
                                                        <table
                                                            class="table table-responsive table-bordered table-hover mb-0 text-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Servicio</th>
                                                                    <th>Incluye</th>
                                                                    <th>Tramo</th>
                                                                    <th>Precio S/</th>
                                                                    <th>Precio $</th>
                                                                    <th>Editar</th>
                                                                    <th>Eliminar</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($vuelospaquete as $j => $detalle)
                                                                    <tr>
                                                                        <td>
                                                                            {{ $j + 1 }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $detalle['servicio'] }}
                                                                            {{ $detalle['idavuelta'] ? '(IDA Y VUELTA)' : '(SOLO IDA)' }}
                                                                        </td>
                                                                        <td>
                                                                            @foreach ($detalle['itinerarios'] as $itinerario)
                                                                                @foreach ($itinerario['incluye'] as $incluye)
                                                                                    {{ $incluye['servicio'] }}<br>
                                                                                @endforeach
                                                                            @endforeach
                                                                        </td>
                                                                        <td>
                                                                            @if (isset($detalle['desde']))
                                                                                @if ($detalle['idavuelta'])
                                                                                    ({{ $detalle['desde'] }} /
                                                                                    {{ $detalle['hasta'] }}) -
                                                                                    ({{ $detalle['desdevuelta'] }} /
                                                                                    {{ $detalle['hastavuelta'] }})
                                                                                @else
                                                                                    ({{ $detalle['desde'] }} /
                                                                                    {{ $detalle['hasta'] }})
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            {{ $detalle['precioSoles'] }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $detalle['precioDolares'] }}
                                                                        </td>
                                                                        <td class=""
                                                                            style="text-align: -webkit-center;">
                                                                            <button type="button"
                                                                                class="btn btn-primary btn-icon"
                                                                                wire:click="editarVuelo({{ $j }})"
                                                                                tabindex="90"><i
                                                                                    class="fa fa-edit"></i></button>
                                                                        </td>
                                                                        <td class=""
                                                                            style="text-align: -webkit-center;">
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-icon"
                                                                                wire:click="reducirVuelo({{ $j }})"
                                                                                tabindex="90">×</button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalServicios" wire:ignore.self>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Agregar Servicio</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <div wire:ignore>
                                    <label class="form-label" for="servicioId">Servicio:</label>
                                    <select class="form-select" id="servicioId" name="servicioId" data-width="100%"
                                        wire:model="servicioId">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($servicios as $servicio)
                                            <option value="{{ $servicio->id }}">{{ $servicio->titulo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('servicioId')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            @foreach ($itinerarios as $i => $itinetario)
                                @if (count($itinerarios) > 1)
                                    <span>
                                        Día {{ $i + 1 }}
                                    </span>
                                @endif
                                <div class=" col-md-12">
                                    <label class="form-label" for="incluye{{ $i }}">Incluye:</label>
                                    <div wire:ignore>
                                        <select class="form-control" name="incluye" id="incluye{{ $i }}"
                                            wire:model.defer="incluye.{{ $i }}" multiple>
                                            @foreach ($incluyeServicios as $incluye)
                                                <option value="{{ $incluye->id }}">{{ $incluye->titulo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('incluye')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class=" col-md-12">
                                    <label class="form-label" for="noincluye{{ $i }}">No Incluye:</label>
                                    <div wire:ignore>
                                        <select class="form-control" name="noincluye"
                                            id="noincluye{{ $i }}"
                                            wire:model.defer="noincluye.{{ $i }}" multiple>
                                            @foreach ($incluyeServicios as $incluye)
                                                <option value="{{ $incluye->id }}">{{ $incluye->titulo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('noincluye')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endforeach
                            <div class="col-md-6">
                                <label class="form-label" for="precioSoles">Precio Soles:</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="precioSoles"
                                        wire:model.defer="precioSoles">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="precioDolares">Precio Dolares:</label>
                                <div class="input-group">
                                    <input type="number"  class="form-control" id="precioDolares"
                                        wire:model.defer="precioDolares">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button aria-label="Close" class="btn btn-danger me-2" data-bs-dismiss="modal"
                            type="button">Cancelar</button>
                        <button class="btn ripple btn-success" type="button"
                            wire:click="agregarServicio()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalHoteles" wire:ignore.self>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Agregar Hotel</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label class="form-label" for="noches">Noches:</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="noches"
                                        wire:model.defer="noches">
                                </div>
                                @error('noches')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-9">
                                <div wire:ignore>
                                    <label class="form-label" for="hotelId">Hoteles:</label>
                                    <select class="form-select" id="hotelId" name="hotelId" data-width="100%"
                                        wire:model="hotelId">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($hoteles as $servicio)
                                            <option value="{{ $servicio->id }}">{{ $servicio->proveedor?->nombre }}
                                                {{ $servicio->titulo }} /
                                                {{ $servicio->proveedor?->categoria?->nombre }} -
                                                {{ $servicio->proveedor?->ubicacion?->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('hotelId')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @foreach ($itinerarios as $i => $itinetario)
                            @if (count($itinerarios) > 1)
                                <span>
                                    Día {{ $i + 1 }}
                                </span>
                            @endif
                            <div class=" col-md-12">
                                <label class="form-label" for="incluyeHotel{{ $i }}">Incluye:</label>
                                <div wire:ignore>
                                    <select class="form-control" name="incluyeHotel"
                                        id="incluyeHotel{{ $i }}"
                                        wire:model.defer="incluyeHotel.{{ $i }}" multiple>
                                        @foreach ($incluyeHoteles as $incluye)
                                            <option value="{{ $incluye->id }}">{{ $incluye->titulo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('incluyeHotel')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" col-md-12">
                                <label class="form-label" for="noincluyeHotel{{ $i }}">No Incluye:</label>
                                <div wire:ignore>
                                    <select class="form-control" name="noincluyeHotel"
                                        id="noincluyeHotel{{ $i }}"
                                        wire:model.defer="noincluyeHotel.{{ $i }}" multiple>
                                        @foreach ($incluyeHoteles as $incluye)
                                            <option value="{{ $incluye->id }}">{{ $incluye->titulo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('noincluyeHotel')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="precioSolesHotel">Precio Soles:</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="precioSolesHotel"
                                        wire:model.defer="precioSolesHotel">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="precioDolaresHotel">Precio Dolares:</label>
                                <div class="input-group">
                                    <input type="number"  class="form-control" id="precioDolaresHotel"
                                        wire:model.defer="precioDolaresHotel">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button aria-label="Close" class="btn btn-danger me-2" data-bs-dismiss="modal"
                            type="button">Cancelar</button>
                        <button class="btn ripple btn-success" type="button"
                            wire:click="agregarHotel()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalVuelos" wire:ignore.self>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Agregar Vuelo</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <div wire:ignore>
                                    <label class="form-label" for="vueloId">Vuelos:</label>
                                    <select class="form-select" id="vueloId" name="vueloId" data-width="100%"
                                        wire:model="vueloId">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($vuelos as $servicio)
                                            <option value="{{ $servicio->id }}">{{ $servicio->titulo }} / {{$servicio->proveedor?->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('vueloId')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            @foreach ($itinerarios as $i => $itinetario)
                                @if (count($itinerarios) > 1)
                                    <span>
                                        Día {{ $i + 1 }}
                                    </span>
                                @endif
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="incluyeVuelo{{ $i }}">Incluye:</label>
                                    <div wire:ignore>
                                        <select class="form-control" name="incluyeVuelo"
                                            id="incluyeVuelo{{ $i }}"
                                            wire:model.defer="incluyeVuelo.{{ $i }}" multiple>
                                            @foreach ($incluyeVuelos as $incluye)
                                                <option value="{{ $incluye->id }}">{{ $incluye->titulo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('incluyeVuelo')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-md-4 d-flex align-items-center gap-2">
                                <div class="w-100">
                                    <div class="form-group d-flex">
                                        <label class="custom-switch ps-0">
                                            <input type="checkbox" name="custom-switch-checkbox4"
                                                class="custom-switch-input" wire:model="idavuelta">
                                            <span
                                                class="custom-switch-indicator custom-switch-indicator-lg custom-radius"></span>
                                        </label>
                                        <h6 class="modal-title ms-4">Ida / Ida y Vuelta</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="tx-18 p-0 m-0"><strong>Ida</strong></p>
                        <div class="row justify-content-end">
                            <div class="mb-3 col-md-6">
                                <div wire:ignore>
                                    <label class="form-label" for="desde">Desde:</label>
                                    <select class="form-select" id="desde" name="desde" data-width="100%"
                                        wire:model.defer="desde">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($aeropuertos as $aeropuerto)
                                            <option value="{{ $aeropuerto->abrev }}"> ({{ $aeropuerto->abrev }})
                                                {{ $aeropuerto->nombre }} {{ $aeropuerto->ciudad }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div wire:ignore>
                                    <label class="form-label" for="hasta">Hasta:</label>
                                    <select class="form-select" id="hasta" name="hasta" data-width="100%"
                                        wire:model.defer="hasta">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($aeropuertos as $aeropuerto)
                                            <option value="{{ $aeropuerto->abrev }}"> ({{ $aeropuerto->abrev }})
                                                {{ $aeropuerto->nombre }} {{ $aeropuerto->ciudad }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if ($idavuelta)
                            <p class="tx-18 p-0 m-0"><strong>Vuelta</strong></p>
                            <div class="row justify-content-end">
                                <div class="mb-3 col-md-6">
                                    <div wire:ignore>
                                        <label class="form-label" for="desdevuelta">Desde:</label>
                                        <select class="form-select" id="desdevuelta" name="desdevuelta"
                                            data-width="100%" wire:model.defer="desdevuelta">
                                            <option value="">SELECCIONE</option>
                                            @foreach ($aeropuertos as $aeropuerto)
                                                <option value="{{ $aeropuerto->abrev }}"> ({{ $aeropuerto->abrev }})
                                                    {{ $aeropuerto->nombre }} {{ $aeropuerto->ciudad }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <div wire:ignore>
                                        <label class="form-label" for="hastavuelta">Hasta:</label>
                                        <select class="form-select" id="hastavuelta" name="hastavuelta"
                                            data-width="100%" wire:model.defer="hastavuelta">
                                            <option value="">SELECCIONE</option>
                                            @foreach ($aeropuertos as $aeropuerto)
                                                <option value="{{ $aeropuerto->abrev }}"> ({{ $aeropuerto->abrev }})
                                                    {{ $aeropuerto->nombre }} {{ $aeropuerto->ciudad }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="precioSolesVuelo">Precio Soles:</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="precioSolesVuelo"
                                        wire:model.defer="precioSolesVuelo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="precioDolaresVuelo">Precio Dolares:</label>
                                <div class="input-group">
                                    <input type="number"  class="form-control" id="precioDolaresVuelo"
                                        wire:model.defer="precioDolaresVuelo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button aria-label="Close" class="btn btn-danger me-2" data-bs-dismiss="modal"
                            type="button">Cancelar</button>
                        <button class="btn ripple btn-success" type="button"
                            wire:click="agregarVuelo()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @error('titulo')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    <br>
    @error('serviciospaquete')
        <span class="error-message" style="color:red">{{ $message }}</span>
    @enderror
    <a href="{{ route('paquete.index') }}">
        <button type="button" class="btn btn-danger m-2">Cancelar</button>
    </a>
    <button type="button" class="btn btn-primary m-2" wire:click="registrarPaquete()">Guardar Paquete</button>
</div>
<!-- /Container -->
@push('custom-scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            // Inicialización inicial
            inicializarSelect2();

            // Escuchar eventos de Livewire para reinicializar Select2 después de la actualización
            Livewire.hook('message.processed', (message, component) => {
                inicializarSelect2();
            });
        });

        function inicializarSelect2() {
            // Inicializar todos los Select2 aquí
            $('#servicioId').select2({
                dropdownParent: $("#modalServicios"),
                width: '100%'
            }).on('change', function(e) {
                @this.set('servicioId', this.value);
            });

            $('#incluye0').select2({
                dropdownParent: $("#modalServicios"),
                width: '100%',
                multiple: true
            }).on('change', function(e) {
                @this.set('incluye.0', $(this).val());
            });

            $('#noincluye0').select2({
                dropdownParent: $("#modalServicios"),
                width: '100%',
                multiple: true
            }).on('change', function(e) {
                @this.set('noincluye.0', $(this).val());
            });

            $('#incluye1').select2({
                dropdownParent: $("#modalServicios"),
                width: '100%',
                multiple: true
            }).on('change', function(e) {
                @this.set('incluye.1', $(this).val());
            });

            $('#noincluye1').select2({
                dropdownParent: $("#modalServicios"),
                width: '100%',
                multiple: true
            }).on('change', function(e) {
                @this.set('noincluye.1', $(this).val());
            });

            $('#incluye2').select2({
                dropdownParent: $("#modalServicios"),
                width: '100%',
                multiple: true
            }).on('change', function(e) {
                @this.set('incluye.2', $(this).val());
            });

            $('#noincluye2').select2({
                dropdownParent: $("#modalServicios"),
                width: '100%',
                multiple: true
            }).on('change', function(e) {
                @this.set('noincluye.2', $(this).val());
            });

            $('#hotelId').select2({
                dropdownParent: $("#modalHoteles"),
                width: '100%',
            }).on('change', function(e) {
                @this.set('hotelId', $(this).val());
            });

            $('#incluyeHotel0').select2({
                dropdownParent: $("#modalHoteles"),
                width: '100%',
                multiple: true
            }).on('change', function(e) {
                @this.set('incluyeHotel.0', $(this).val());
            });

            $('#noincluyeHotel0').select2({
                dropdownParent: $("#modalHoteles"),
                width: '100%',
                multiple: true
            }).on('change', function(e) {
                @this.set('noincluyeHotel.0', $(this).val());
            });

            $('#vueloId').select2({
                dropdownParent: $("#modalVuelos"),
                width: '100%',
            }).on('change', function(e) {
                @this.set('vueloId', $(this).val());
            });

            $('#incluyeVuelo0').select2({
                dropdownParent: $("#modalVuelos"),
                width: '100%',
                multiple: true
            }).on('change', function(e) {
                @this.set('incluyeVuelo.0', $(this).val());
            });

            $('#noincluyeVuelo0').select2({
                dropdownParent: $("#modalVuelos"),
                width: '100%',
                multiple: true
            }).on('change', function(e) {
                @this.set('noincluyeVuelo.0', $(this).val());
            });

            $('#desde').select2({
                dropdownParent: $("#modalVuelos"),
                width: '100%',
            }).on('change', function(e) {
                @this.set('desde', $(this).val());
            });

            $('#hasta').select2({
                dropdownParent: $("#modalVuelos"),
                width: '100%',
            }).on('change', function(e) {
                @this.set('hasta', $(this).val());
            });

            $('#desdevuelta').select2({
                dropdownParent: $("#modalVuelos"),
                width: '100%',
            }).on('change', function(e) {
                @this.set('desdevuelta', $(this).val());
            });

            $('#hastavuelta').select2({
                dropdownParent: $("#modalVuelos"),
                width: '100%',
            }).on('change', function(e) {
                @this.set('hastavuelta', $(this).val());
            });
        }

        $('#descripcion').summernote();
        $('#descripcion').on('summernote.change', function(we, contents, $editable) {
            @this.set('descripcion', contents);
        });

        FilePond.registerPlugin(FilePondPluginFileValidateType);

        // Get a reference to the file input element
        const inputElement = document.querySelector('#imagenprincipal');
        const inputElement1 = document.querySelector('#imagensecundario');


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
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    if (file.type == 'image/heic') {
                        const formData = new FormData();
                        formData.append(fieldName, file, file.name + '.jpg');
                        @this.upload('imagenprincipal', formData, load, error, progress)
                    } else {
                        @this.upload('imagenprincipal', file, load, error, progress)
                    }
                },
                revert: (filename, load) => {
                    @this.removeUpload('imagenprincipal', filename, load)
                },
            },
        });
        const pond1 = FilePond.create(inputElement1, {
            fileValidateTypeDetectType: (source, type) =>
                new Promise((resolve, reject) => {
                    if (source.name.toLowerCase().indexOf('.heic') !== -1) {
                        resolve('image/heic')
                    } else {
                        resolve(type)
                    }
                }),
        }).setOptions({
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    if (file.type == 'image/heic') {
                        const formData = new FormData();
                        formData.append(fieldName, file, file.name + '.jpg');
                        @this.upload('imagensecundario', formData, load, error, progress)
                    } else {
                        @this.upload('imagensecundario', file, load, error, progress)
                    }
                },
                revert: (filename, load) => {
                    @this.removeUpload('imagensecundario', filename, load)
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

        Livewire.on('EncontrarServicio', function(id, ids, ids2, idSelect) {
            $('#modalServicios').modal('show');

            // Actualizar valores de Select2 para servicio_id
            $('#servicioId').select2().val(id).trigger('change.select2');

            $('#incluye' + idSelect).select2().val(ids).trigger('change.select2');

            $('#noincluye' + idSelect).select2().val(ids2).trigger('change.select2');

        });

        Livewire.on('cerrarServicio', function() {
            $('#modalServicios').modal('hide');
        });

        Livewire.on('EncontrarHotel', function(id, ids, ids2) {
            $('#modalHoteles').modal('show');
            // Actualizar valores de Select2
            $('#hotelId').select2().val(id).trigger('change.select2');

            $('#incluyeHotel0').select2().val(ids).trigger('change.select2');

            $('#noincluyeHotel0').select2().val(ids2).trigger('change.select2');

        });

        Livewire.on('cerrarHotel', function() {
            $('#modalHoteles').modal('hide');
        });


        Livewire.on('EncontrarVuelo', function(id, ids, ids2, desde, hasta, desderetorno, hastaretorno) {

            $('#modalVuelos').modal('show');
            // Actualizar valores de Select2
            $('#vueloId').select2().val(id).trigger('change.select2');

            $('#incluyeVuelo0').select2().val(ids).trigger('change.select2');

            $('#noincluyeVuelo0').select2().val(ids2).trigger('change.select2');

            $('#desde').select2().val(desde).trigger('change.select2');

            $('#hasta').select2().val(hasta).trigger('change.select2');

            $('#desdevuelta').select2().val(desderetorno).trigger('change.select2');

            $('#hastavuelta').select2().val(hastaretorno).trigger('change.select2');

        });

        Livewire.on('cerrarVuelo', function() {
            $('#modalVuelos').modal('hide');
        });
    </script>
@endpush

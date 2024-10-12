<div>
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Crear Paquete</span>
        </div>
        <a class="btn ripple btn-primary" data-bs-target="#Extra" data-bs-toggle="modal" href="" wire:click="register">
            @if($total_soles > 0)
            <span class="text-white"><strong class="fs-6" style="font-size:2rem !important;">S/{{ number_format($total_soles, 2) }}</strong></span>
            Regular
            @endif

            @if($total_dolares > 0)
            <span class="text-white"><strong class="fs-6" style="font-size:2rem !important;">${{ number_format($total_dolares, 2) }}</strong></span>
            Regular
            @endif
        </a>

    </div>
    <div class="modal fade" id="Extra" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Vista Previa</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="carousel slide" data-bs-ride="carousel" id="carouselExample2">
                            <div class="carousel-inner">
                                <div class="carousel-item border-none active">
                                    <img alt="img" class="d-block w-100 object-fit-cover" style="height: 70vh; object-fit: cover;" src="http://localhost:81/storage/paquetes/paquete2023.jpg">
                                </div>
                                @foreach($reservaData as $reserva)
                                    @if(isset($reserva['servicioData']['servicio']))
                                        <div class="carousel-item border-none">
                                            <img alt="img" class="d-block w-100 object-fit-cover" style="height: 70vh; object-fit: cover;" src="{{ $reserva['servicioData']['servicio']['img_principal'] }}">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExample2" role="button" data-bs-slide="prev">
                                <i class="fa fa-angle-left fs-30" aria-hidden="true"></i>
                            </a>
                            <a class="carousel-control-next" href="#carouselExample2" role="button" data-bs-slide="next">
                                <i class="fa fa-angle-right fs-30" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center " style="margin-top:-60px;">
                        <div class="card w-75">
                            <div class="card-body d-flex justify-content-evenly align-items-center" style="height:120px;">
                                <div class="mg-sm-r-20 mg-b-10">
                                    <div class="main-profile-contact-list">
                                        <div class="media">
                                            <div class="media-icon bg-primary-transparent text-success">
                                                <i class="fas fa-dollar-sign"></i>
                                            </div>
                                            <div class="media-body"> <span>Precio</span>
                                                <div>{{ $total_soles > 0 ? 'Precio Soles: ' . $total_soles : '' }}</div>
                                                <div>{{ $total_dolares > 0 ? 'Precio Dolares: ' . $total_dolares : '' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container px-5">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6 p-4">
                                <div class="text-justify">
                                    <div class="text-dark tx-26 font-weight-semibold">Descripcion de este Paquete</div>
                                    {!! $descripcion !!}
                                </div>
                                <div class="row about-motto pt-0">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="text-justify">
                                            <div class="text-dark tx-26 font-weight-semibold">Incluye / No Incluye:</div>
                                            <p class="tx-14 mb-4">
                                            <h5>Servicios</h5>

                                            @foreach($reservaData as $reserva)
                                            @if(isset($reserva['servicioData']['servicio']))
                                            <div class="border d-flex p-2 br-5 mb-2">
                                                <div class="recent-contacts me-3">
                                                    <div class="avatar rounded-circle">
                                                        <img alt="avatar" class="rounded-circle w-100" style="height:inherit;" src="{{ $reserva['servicioData']['servicio']['img_principal'] }}">
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="mt-1 mb-1">{{ $reserva['servicioData']['servicio']['titulo'] }}</h6>
                                                    @if(isset($reserva['incluyeservice']))
                                                    <p class="mb-0 text-muted">
                                                        @foreach($reserva['incluyeservice'] as $incluye)
                                                        <span class="badge bg-primary me-1">{{ $incluye['titulo'] }}</span>
                                                        @endforeach
                                                    </p>
                                                    @endif
                                                    @if(isset($reserva['noincluyeservice']))
                                                    <p class="mb-0 text-muted">
                                                        @foreach($reserva['noincluyeservice'] as $noincluye)
                                                        <span class="badge bg-danger me-1">{{ $noincluye['titulo'] }}</span>
                                                        @endforeach
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                            <h5>Hoteles</h5>

                                            @foreach($reservaDataHotel as $reserva)
                                            @if(isset($reserva['servicioDataHotel']['servicio']))
                                            <div class="border d-flex p-2 br-5 mb-2">
                                                <div class="recent-contacts me-3">
                                                    <div class="avatar rounded-circle">
                                                        <img alt="avatar" class="rounded-circle w-100" style="height:inherit;" src="{{ $reserva['servicioDataHotel']['servicio']['img_principal'] }}">
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="mt-1 mb-1">{{ $reserva['servicioDataHotel']['servicio']['titulo'] }}</h6>
                                                    @if(isset($reserva['incluyeserviceHotel']))
                                                    <p class="mb-0 text-muted">
                                                        @foreach($reserva['incluyeserviceHotel'] as $incluye)
                                                        <span class="badge bg-primary me-1">{{ $incluye['titulo'] }}</span>
                                                        @endforeach
                                                    </p>
                                                    @endif
                                                    @if(isset($reserva['noincluyeserviceHotel']))
                                                    <p class="mb-0 text-muted">
                                                        @foreach($reserva['noincluyeserviceHotel'] as $noincluye)
                                                        <span class="badge bg-danger me-1">{{ $noincluye['titulo'] }}</span>
                                                        @endforeach
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                            <h5>Vuelos</h5>

                                            @foreach($reservaDataVuelo as $reserva)
                                            @if(isset($reserva['servicioDataVuelo']['servicio']))
                                            <div class="border d-flex p-2 br-5 mb-2">
                                                <div class="recent-contacts me-3">
                                                    <div class="avatar rounded-circle">
                                                        <img alt="avatar" class="rounded-circle w-100" style="height:inherit;" src="{{ $reserva['servicioDataVuelo']['servicio']['img_principal'] }}">
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="mt-1 mb-1">{{ $reserva['servicioDataVuelo']['servicio']['titulo'] }}</h6>
                                                    @if(isset($reserva['incluyeserviceVuelo']))
                                                    <p class="mb-0 text-muted">
                                                        @foreach($reserva['incluyeserviceVuelo'] as $incluye)
                                                        <span class="badge bg-primary me-1">{{ $incluye['titulo'] }}</span>
                                                        @endforeach
                                                    </p>
                                                    @endif
                                                    @if(isset($reserva['noincluyeserviceVuelo']))
                                                    <p class="mb-0 text-muted">
                                                        @foreach($reserva['noincluyeserviceVuelo'] as $noincluye)
                                                        <span class="badge bg-danger me-1">{{ $noincluye['titulo'] }}</span>
                                                        @endforeach
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 p-4">
                                    @if($imagenprincipal)
                                    <p><img src="{{ $imagenprincipal->temporaryUrl() }}" class="br-5" alt="image"></p>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 p-4">
                                    @if($imagensecundario)
                                    <p><img src="{{ $imagensecundario->temporaryUrl() }}" class="br-5" alt="image"></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-lg-12 col-md-12 p-4">
                                <ul class="notification">
                                </ul>
                            </div>
                        </div>
                        <div class="row align-items-center mb-5">
                            <div class="col-lg-6 col-md-6">
                                <div class="card custom-card">
                                    <div class="card-body d-md-flex">
                                        @if($user)
                                        <div class="">
                                            <span class="profile-image pos-relative">
                                                <img class="br-5 object-fit-cover" alt="" src="{{ $user->imagen }}" style="object-fit:cover;">
                                            </span>
                                        </div>
                                        <div class="my-md-auto mt-4 prof-details">
                                            <h4 class="font-weight-semibold ms-md-4 ms-0 mb-1 pb-0">{{ $user->nombre }}</h4>
                                            <p class="tx-13 text-muted ms-md-4 ms-0 mb-2 pb-2 ">
                                                <span class="me-3"><i class="far fa-address-card me-2"></i>Counter</span>
                                                <span><i class="far fa-flag me-2"></i>Cusco - Perú</span>
                                            </p>
                                            <p class="text-muted ms-md-4 ms-0 mb-2 d-flex"><span><i class="fa fa-phone me-2"></i></span><span class="font-weight-semibold me-2">Celular:</span><span>{{ $user->celular }}</span>
                                            </p>
                                            <p class="text-muted ms-md-4 ms-0 mb-2 d-flex"><span><i class="fa fa-envelope me-2"></i></span><span class="font-weight-semibold me-2">Email:</span><span>{{ $user->email }}</span>
                                            </p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="card custom-card">
                                    <div class="card-body d-md-grid">
                                        <div class="my-md-auto mt-4 prof-details">
                                            <img src="{{ asset('img/brand/logo.png')}}" class="" alt="logo">
                                        </div>
                                        <div class="btn-icon-list btn-list mt-2 d-flex     align-items-center justify-content-center">
                                            <button type="button" class="btn btn-icon rounded-circle btn-primary me-1"><i class="fab fa-facebook-square"></i></button>
                                            <button type="button" class="btn btn-icon rounded-circle btn-primary me-1"><i class="fab fa-youtube"></i></button>
                                            <button type="button" class="btn btn-icon rounded-circle btn-primary me-1"><i class="fab fa-tripadvisor"></i></i></button>
                                            <button type="button" class="btn btn-icon rounded-circle btn-primary me-1"><i class="fab fa-instagram"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="errores">
                        @error('titulo')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                        <br>
                        @error('reservaData')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <button class="btn ripple btn-primary" type="button" wire:click="savePaquete">Guardar</button>
                    <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Cancelar</button>
                </div>
            </div>
        </div>
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
                                            <li class=""><a href="#tab21" class="active" data-bs-toggle="tab"> Datos Generales</a></li>
                                            <li><a href="#tab22" data-bs-toggle="tab"> Servicios</a></li>
                                            <li><a href="#tab23" data-bs-toggle="tab"> Hoteles</a></li>
                                            <li><a href="#tab24" data-bs-toggle="tab"> Vuelos</a></li>
                                            <li><a href="#tab25" data-bs-toggle="tab"> Pasajeros</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tabs-style-4" style="width:100%;">
                            <div class="panel-body tabs-menu-body bg-white">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab21" wire:ignore.self>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="titulo" class="form-label">Titulo:</label>
                                                <input type="text" name="titulo" id="titulo" class="form-control" wire:model.defer="titulo">
                                                @error('titulo')
                                                <span class="error-message" style="color:red">{{ $message }}</span>
                                                @enderror
                                                <label for="mensaje_bienvenida" class="form-label">Mensaje de bienvenida:</label>
                                                <input type="text" name="mensaje_bienvenida" id="mensaje_bienvenida" class="form-control" wire:model.defer="mensaje_bienvenida">
                                                @error('mensaje_bienvenida')
                                                <span class="error-message" style="color:red">{{ $message }}</span>
                                                @enderror
                                                <label for="video" class="form-label">Video:</label>
                                                <input type="text" name="video" id="video" class="form-control" wire:model.defer="video">
                                                @error('video')
                                                <span class="error-message" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <div class="" wire:ignore>
                                                    <label class="form-label" for="imagenprincipal">Imagen Principal:</label>
                                                    <input type="file" name="imagenprincipal" id="imagenprincipal" class="form-control" wire:model='imagenprincipal'>
                                                    @error('imagenprincipal')
                                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    @if($imagenprincipal)
                                                    <img src="{{$imagenprincipal->temporaryURL()}}" class="imagen-principal">
                                                    @endif
                                                </div>

                                                <div class="" wire:ignore>
                                                    <label class="form-label" for="imagensecundario">Imagen Secundario:</label>
                                                    <input type="file" name="imagensecundario" id="imagensecundario" class="form-control" wire:model='imagensecundario'>
                                                    @error('imagensecundario')
                                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    @if($imagensecundario)
                                                    <img src="{{$imagensecundario->temporaryURL()}}" class="imagen-secundario">
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- <div class="mb-3 col-md-3">
                                                <label class="form-label" for="regularsoles">Precio Regular Soles:</label>
                                                <input type="number" name="regularsoles" id="regularsoles" class="form-control" wire:model.defer="regularsoles" min="0.00" step="0.10">
                                                @error('regularsoles')
                                                <span class="error-message" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label" for="regulardolares">Precio Regular Dolares:</label>
                                                <input type="number" name="regulardolares" id="regulardolares" class="form-control" wire:model.defer="regulardolares" min="0.00" step="0.10">
                                                @error('regulardolares')
                                                <span class="error-message" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div> --}}
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <div wire:ignore>
                                                    <label class="form-label" for="descripcion">Descripción:</label>
                                                    <textarea class="form-control" name="descripcion" id="descripcion" rows="10" wire:model.defer="descripcion"></textarea>
                                                </div>
                                                @error('descripcion')
                                                <span class="error-message" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab22" wire:ignore.self>
                                        <div class="row">
                                            <div class="mb-3 col-md-12">
                                                <div class="product-details table-responsive text-nowrap">
                                                    <a class="btn btn-outline-primary mx-2 button-icon" data-bs-target="#modalServicios" data-bs-toggle="modal" href="">Agregar detalle</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-xl-12 col-md-12 table-responsive">
                                                <div class="card custom-card cart-details">
                                                    <div class="card-body ">
                                                        <h5 class="mb-3 font-weight-bold tx-14">DETALLE DE PAQUETE</h5>
                                                        <table class="table table-responsive table-bordered table-hover mb-0 text-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Servicio</th>
                                                                    <th>Incluye</th>
                                                                    <th>No incluye</th>
                                                                    {{-- <th>Tarifa</th> --}}
                                                                    {{-- <th>Precio Soles</th> --}}
                                                                    {{-- <th>Precio Dolares</th> --}}
                                                                    {{-- <th>Sub. Total</th> --}}
                                                                    <th>Editar</th>
                                                                    <th>Eliminar</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($reservaData as $j => $detalle)
                                                                @php
                                                                $k = $j
                                                                @endphp
                                                                <tr>
                                                                    <td>
                                                                        {{ ++$k }}
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($detalle['servicioData']['servicio']))
                                                                        {{ $detalle['servicioData']['servicio']['titulo'] ?? 'N/A' }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($detalle['incluyeservice']) && is_array($detalle['incluyeservice']))
                                                                        @foreach ($detalle['incluyeservice'] as $servicio)
                                                                        <span>-</span>{{ $servicio['titulo'] ?? 'N/A' }}<br>
                                                                        @endforeach
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($detalle['noincluyeservice']) && is_array($detalle['noincluyeservice']))
                                                                        @foreach ($detalle['noincluyeservice'] as $servicio)
                                                                        <span>-</span>{{ $servicio['titulo'] ?? 'N/A' }}<br>
                                                                        @endforeach
                                                                        @endif
                                                                    </td>
                                                                    {{-- <td>
                                                                        @if (isset($detalle['adulto']))
                                                                        {{ $detalle['adulto'] == 0 ? 'ESTANDAR' : 'NIÑO' }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($detalle['precioserviciosoles']))
                                                                        {{ $detalle['precioserviciosoles'] }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($detalle['precioserviciodolares']))
                                                                        {{ $detalle['precioserviciodolares'] }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($detalle['precioserviciosoles']))
                                                                        S/ {{ $detalle['precioserviciosoles'] }}
                                                                        @endif
                                                                        @if (isset($detalle['precioserviciodolares']))
                                                                        $ {{ $detalle['precioserviciodolares']  }}
                                                                        @endif
                                                                    </td> --}}
                                                                    <td class="" style="text-align: -webkit-center;">
                                                                        <button type="button" class="btn btn-primary btn-icon" wire:click="EditarreservaData({{ $j }})" tabindex="90"><i class="fa fa-edit"></i></button>
                                                                    </td>
                                                                    <td class="" style="text-align: -webkit-center;">
                                                                        <button type="button" class="btn btn-danger btn-icon" wire:click="EliminarreservaData({{ $j }})" tabindex="90">×</button>
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
                                                    <a class="btn btn-outline-primary mx-2 button-icon" data-bs-target="#modalHoteles" data-bs-toggle="modal" href="">Agregar detalle de Hotel</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-xl-12 col-md-12">
                                                <div class="card custom-card cart-details">
                                                    <div class="card-body table-responsive">
                                                        <h5 class="mb-3 font-weight-bold tx-14">DETALLE DE HOTEL</h5>
                                                        <table class="table table-responsive table-bordered table-hover mb-0 text-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Servicio</th>
                                                                    <th>Incluye</th>
                                                                    <th>No incluye</th>
                                                                    {{-- <th>Precio Soles</th>
                                                                    <th>Precio Dolares</th> --}}
                                                                    <th>Editar</th>
                                                                    <th>Eliminar</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($reservaDataHotel as $j => $detalle)
                                                                @php
                                                                $k = $j
                                                                @endphp
                                                                <tr>
                                                                    <td>
                                                                        {{ ++$k }}
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($detalle['servicioDataHotel']['servicio']))
                                                                        {{ $detalle['servicioDataHotel']['servicio']['titulo'] ?? 'N/A' }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($detalle['incluyeserviceHotel']) && is_array($detalle['incluyeserviceHotel']))
                                                                        @foreach ($detalle['incluyeserviceHotel'] as $servicio)
                                                                        <span>-</span>{{ $servicio['titulo'] ?? 'N/A' }}<br>
                                                                        @endforeach
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($detalle['noincluyeserviceHotel']) && is_array($detalle['noincluyeserviceHotel']))
                                                                        @foreach ($detalle['noincluyeserviceHotel'] as $servicio)
                                                                        <span>-</span>{{ $servicio['titulo'] ?? 'N/A' }}<br>
                                                                        @endforeach
                                                                        @endif
                                                                    </td>
                                                                    {{-- <td>
                                                                        @if (isset($detalle['precioserviciosolesHotel']))
                                                                        {{ $detalle['precioserviciosolesHotel'] }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($detalle['precioserviciodolaresHotel']))
                                                                        {{ $detalle['precioserviciodolaresHotel'] }}
                                                                        @endif
                                                                    </td> --}}
                                                                    <td class="" style="text-align: -webkit-center;">
                                                                        <button type="button" class="btn btn-primary btn-icon" wire:click="EditarreservaDataHotel({{ $j }})" tabindex="90"><i class="fa fa-edit"></i></button>
                                                                    </td>
                                                                    <td class="" style="text-align: -webkit-center;">
                                                                        <button type="button" class="btn btn-danger btn-icon" wire:click="EliminarreservaDataHotel({{ $j }})" tabindex="90">×</button>
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
                                                    <a class="btn btn-outline-primary mx-2 button-icon" data-bs-target="#modalVuelos" data-bs-toggle="modal" href="">Agregar detalle de Vuelo</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-xl-12 col-md-12">
                                                <div class="card custom-card cart-details">
                                                    <div class="card-body table-responsive">
                                                        <h5 class="mb-3 font-weight-bold tx-14">DETALLE DE VUELO</h5>
                                                        <table class="table table-responsive table-bordered table-hover mb-0 text-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Servicio</th>
                                                                    <th>Incluye</th>
                                                                    <th>No incluye</th>
                                                                    {{-- <th>Precio Soles</th>
                                                                    <th>Precio Dolares</th> --}}
                                                                    <th>Tramo</th>
                                                                    <th>Editar</th>
                                                                    <th>Eliminar</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($reservaDataVuelo as $j => $detalle)
                                                                @php
                                                                $k = $j
                                                                @endphp
                                                                <tr>
                                                                    <td>
                                                                        {{ ++$k }}
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($detalle['servicioDataVuelo']['servicio']))
                                                                        {{ $detalle['idavuelta'] ? '(IDA Y VUELTA)' : '(SOLO IDA)' }}
                                                                        {{ $detalle['servicioDataVuelo']['servicio']['titulo'] ?? 'N/A' }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($detalle['incluyeserviceVuelo']) && is_array($detalle['incluyeserviceVuelo']))
                                                                        @foreach ($detalle['incluyeserviceVuelo'] as $servicio)
                                                                        <span>-</span>{{ $servicio['titulo'] ?? 'N/A' }}<br>
                                                                        @endforeach
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($detalle['noincluyeserviceVuelo']) && is_array($detalle['noincluyeserviceVuelo']))
                                                                        @foreach ($detalle['noincluyeserviceVuelo'] as $servicio)
                                                                        <span>-</span>{{ $servicio['titulo'] ?? 'N/A' }}<br>
                                                                        @endforeach
                                                                        @endif
                                                                    </td>
                                                                    {{-- <td>
                                                                        @if (isset($detalle['precioserviciosolesVuelo']))
                                                                        {{ $detalle['precioserviciosolesVuelo'] }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($detalle['precioserviciodolaresVuelo']))
                                                                        {{ $detalle['precioserviciodolaresVuelo'] }}
                                                                        @endif
                                                                    </td> --}}
                                                                    <td>

                                                                        @if (isset($detalle['desde']))
                                                                        @if($detalle['idavuelta'])
                                                                        ({{ $detalle['desde'] }} / {{ $detalle['hasta'] }}) - ({{ $detalle['desdevuelta'] }} / {{ $detalle['hastavuelta'] }})
                                                                        @else
                                                                        ({{ $detalle['desde'] }} / {{ $detalle['hasta'] }})
                                                                        @endif
                                                                        @endif

                                                                    </td>
                                                                    <td class="" style="text-align: -webkit-center;">
                                                                        <button type="button" class="btn btn-primary btn-icon" wire:click="EditarreservaDataVuelo({{ $j }})" tabindex="90"><i class="fa fa-edit"></i></button>
                                                                    </td>
                                                                    <td class="" style="text-align: -webkit-center;">
                                                                        <button type="button" class="btn btn-danger btn-icon" wire:click="EliminarreservaDataVuelo({{ $j }})" tabindex="90">×</button>
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
                                    <div class="tab-pane" id="tab25" wire:ignore.self>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="nombres" class="form-label">Nombre:</label>
                                                <div wire:ignore>
                                                    <select class="form-control" name="nombres" id="nombres" wire:model="nombres">
                                                        <option value="">SELECCIONE</option>
                                                        @foreach($pasajeros as $pasajero)
                                                        <option value="{{$pasajero->nombres}}">{{$pasajero->nombres}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('nombres')
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
                                                <label for="pais_id" class="form-label">Pais:</label>
                                                <div wire:ignore>
                                                    <select class="form-control pais_id" name="pais_id" id="pais_id" wire:model.defer="pais_id">
                                                        <option value="">SELECCIONE</option>
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
                                                <label for="celular" class="form-label">Celular:</label>
                                                <input type="text" name="celular" id="celular" class="form-control" wire:model.defer="celular">
                                                @error('celular')
                                                <span class="error-message" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class=" col-md-6">
                                                <label for="email" class="form-label">Email:</label>
                                                <input type="text" name="email" id="email" class="form-control" wire:model.defer="email">
                                                @error('email')
                                                <span class="error-message" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class=" col-md-8">

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
                        <h6 class="modal-title">Agregar Servicio</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <div wire:ignore>
                                    <label class="form-label" for="servicio">Servicio:</label>
                                    <select class="form-select" id="servicio" name="servicio" data-width="100%" wire:model="servicio">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($servicios as $servicio)
                                        <option value="{{ $servicio->id }}">{{ $servicio->titulo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('servicio')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-xxl-end">
                            <div class="mb-3 col-md-10">
                                <div wire:ignore>
                                    <label class="form-label" for="incluye">Incluye:</label>
                                    <select class="form-select" id="incluye" name="incluye" data-width="100%" wire:model.defer="incluye">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($servicioincluyes as $servicio)
                                        <option value="{{ $servicio->id }}">{{ $servicio->titulo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('incluyes')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-1">
                                <button type="button" class="btn btn-primary button-icon" wire:click="IncluyeDetalle"><i class="fe fe-check"></i></button>
                            </div>
                            <div class="mb-3 col-md-1">
                                <button type="button" class="btn btn-danger button-icon" wire:click="NoincluyeDetalle"><i class="fe fe-x"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card custom-card cart-details">
                                    <div class="card-body">
                                        <h5 class="mb-1 font-weight-bold tx-14">Incluye</h5>
                                        <table class="table table-bordered table-hover mb-0 text-nowrap">
                                            <tbody>
                                                @foreach ($incluyeservice as $i => $service)
                                                <tr class="tr-modal-detalle">
                                                    <td>
                                                        <input type="text" class="text-modal-detalle" id="incluyeservice[{{ $i }}]" value="{{ $service['titulo'] }}" wire:model="incluyeservice.{{ $i }}.titulo" readonly>
                                                    </td>
                                                    <td class="" style="text-align: -webkit-center;">
                                                        <button type="button" class="btn btn-danger btn-icon delete-button-modal" wire:click="Eliminardetalle({{ $i }})" tabindex="90"><i class="fas fa-times icono-size-peq"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <h5 class="mt-3 font-weight-bold tx-14">No Incluye</h5>
                                        <table class="table table-bordered table-hover mb-0 text-nowrap">
                                            <tbody>
                                                @foreach ($noincluyeservice as $i => $service)
                                                <tr class="tr-modal-detalle">
                                                    <td>
                                                        <input type="text" class="text-modal-detalle" value="{{ $service['titulo'] }}" wire:model.defer="noincluyeservice.{{ $i }}.titulo">
                                                    </td>
                                                    <td class="" style="text-align: -webkit-center;">
                                                        <button type="button" class="btn btn-danger btn-icon delete-button-modal" wire:click="EliminarNoIncluyeDetalle({{ $i }})" tabindex="90"><i class="fas fa-times icono-size-peq"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Moneda</th>
                                        <th>Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($totales as $total)
                                        <tr>
                                            <td>{{$total['nombre']}}</td>
                                            <td>{{$total['moneda_id'] == 1 ? 'Soles':'Dolares'}}</td>
                                            <td>{{number_format($total['precio'],2,'.','')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="row justify-content-between">
                            <div class="mb-3 col-md-4 d-flex align-items-center gap-2">
                                <div class="w-100">
                                    <div class="form-group d-flex justify-content-center mt-3">
                                        <label class="custom-switch ps-0">
                                            <input type="checkbox" name="custom-switch-checkbox4" class="custom-switch-input" wire:model="privado">
                                            <span class="custom-switch-indicator custom-switch-indicator-lg custom-radius"></span>
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="modal-title">Compartido</h6>
                                        <h6 class="modal-title">Privado</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4 d-flex align-items-center gap-2">
                                <div class="w-100">
                                    <h6 class="modal-title">Dia de Tour: </h6>
                                    <input type="number" name="diaservicio" id="diaservicio" class="form-control" wire:model.defer="diaservicio">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="mb-3 col-md-4 d-flex align-items-center gap-2">
                                <div class="w-100">
                                    <div class="form-group d-flex justify-content-center">
                                        <label class="custom-switch ps-0">
                                            <input type="checkbox" name="custom-switch-checkbox4" class="custom-switch-input" wire:model="adulto">
                                            <span class="custom-switch-indicator custom-switch-indicator-lg custom-radius"></span>
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="modal-title">Adulto</h6>
                                        <h6 class="modal-title">Niño</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4 d-flex align-items-center gap-2">
                                <div class="w-100">
                                    <h6 class="modal-title">Precio Soles:</h6>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="precioserviciosoles" wire:model.lazy="precioserviciosoles">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4 d-flex align-items-center gap-2">
                                <div class="w-100">
                                    <h6 class="modal-title">Precio Dolares:</h6>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="precioserviciodolares" wire:model.lazy="precioserviciodolares">
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button" wire:click="registerDetalle">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalHoteles" wire:ignore.self>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Agregar Hotel</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <div wire:ignore>
                                    <label class="form-label" for="servicioHotel">Hoteles:</label>
                                    <select class="form-select" id="servicioHotel" name="servicioHotel" data-width="100%" wire:model="servicioHotel">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($serviciosHotel as $servicio)
                                        <option value="{{ $servicio->id }}">{{ $servicio->titulo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('servicio')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-xxl-end">
                            <div class="mb-3 col-md-10">
                                <div wire:ignore>
                                    <label class="form-label" for="incluyeHotel">Incluye:</label>
                                    <select class="form-select" id="incluyeHotel" name="incluyeHotel" data-width="100%" wire:model.defer="incluyeHotel">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($servicioincluyesHotel as $servicio)
                                        <option value="{{ $servicio->id }}">{{ $servicio->titulo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('incluyeHotel')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-1">
                                <button type="button" class="btn btn-primary button-icon" wire:click="IncluyeDetalleHotel"><i class="fe fe-check"></i></button>
                            </div>
                            <div class="mb-3 col-md-1">
                                <button type="button" class="btn btn-danger button-icon" wire:click="NoincluyeDetalleHotel"><i class="fe fe-x"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card custom-card cart-details">
                                    <div class="card-body">
                                        <h5 class="mb-1 font-weight-bold tx-14">Incluye Hotel</h5>
                                        <table class="table table-bordered table-hover mb-0 text-nowrap">
                                            <tbody>
                                                @foreach ($incluyeserviceHotel as $i => $service)
                                                <tr class="tr-modal-detalle">
                                                    <td>
                                                        <input type="text" class="text-modal-detalle" id="incluyeserviceHotel[{{ $i }}]" value="{{ $service['titulo'] }}" wire:model="incluyeserviceHotel.{{ $i }}.titulo" readonly>
                                                    </td>
                                                    <td class="" style="text-align: -webkit-center;">
                                                        <button type="button" class="btn btn-danger btn-icon delete-button-modal" wire:click="EliminardetalleHotel({{ $i }})" tabindex="90"><i class="fas fa-times icono-size-peq"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <h5 class="mt-3 font-weight-bold tx-14">No Incluye Hotel</h5>
                                        <table class="table table-bordered table-hover mb-0 text-nowrap">
                                            <tbody>
                                                @foreach ($noincluyeserviceHotel as $i => $service)
                                                <tr class="tr-modal-detalle">
                                                    <td>
                                                        <input type="text" class="text-modal-detalle" id="noincluyeserviceHotel[{{ $i }}]" value="{{ $service['titulo'] }}" wire:model="noincluyeserviceHotel.{{ $i }}.titulo">
                                                    </td>
                                                    <td class="" style="text-align: -webkit-center;">
                                                        <button type="button" class="btn btn-danger btn-icon delete-button-modal" wire:click="EliminarNoIncluyeDetalleHotel({{ $i }})" tabindex="90"><i class="fas fa-times icono-size-peq"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="mb-3 col-md-6 d-flex align-items-center gap-2">
                                <div class="w-100">
                                    <h6 class="modal-title">Precio Soles:</h6>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="precioserviciosolesHotel" wire:model.lazy="precioserviciosolesHotel">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 d-flex align-items-center gap-2">
                                <div class="w-100">
                                    <h6 class="modal-title">Precio Dolares:</h6>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="precioserviciodolaresHotel" wire:model.lazy="precioserviciodolaresHotel">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button" wire:click="registerDetalleHotel">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalVuelos" wire:ignore.self>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Agregar Vuelo</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <div wire:ignore>
                                    <label class="form-label" for="servicioVuelo">Vuelos:</label>
                                    <select class="form-select" id="servicioVuelo" name="servicioVuelo" data-width="100%" wire:model="servicioVuelo">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($serviciosVuelo as $servicio)
                                        <option value="{{ $servicio->id }}">{{ $servicio->titulo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('servicio')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-xxl-end">
                            <div class="mb-3 col-md-10">
                                <div wire:ignore>
                                    <label class="form-label" for="incluyeVuelo">Incluye:</label>
                                    <select class="form-select" id="incluyeVuelo" name="incluyeVuelo" data-width="100%" wire:model.defer="incluyeVuelo">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($servicioincluyesVuelo as $servicio)
                                        <option value="{{ $servicio->id }}">{{ $servicio->titulo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('incluyeVuelo')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-1">
                                <button type="button" class="btn btn-primary button-icon" wire:click="IncluyeDetalleVuelo"><i class="fe fe-check"></i></button>
                            </div>
                            <div class="mb-3 col-md-1">
                                <button type="button" class="btn btn-danger button-icon" wire:click="NoincluyeDetalleVuelo"><i class="fe fe-x"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card custom-card cart-details">
                                    <div class="card-body">
                                        <h5 class="mb-1 font-weight-bold tx-14">Incluye Vuelo</h5>
                                        <table class="table table-bordered table-hover mb-0 text-nowrap">
                                            <tbody>
                                                @foreach ($incluyeserviceVuelo as $i => $service)
                                                <tr class="tr-modal-detalle">
                                                    <td>
                                                        <input type="text" class="text-modal-detalle" id="incluyeserviceVuelo[{{ $i }}]" value="{{ $service['titulo'] }}" wire:model="incluyeserviceVuelo.{{ $i }}.titulo" readonly>
                                                    </td>
                                                    <td class="" style="text-align: -webkit-center;">
                                                        <button type="button" class="btn btn-danger btn-icon delete-button-modal" wire:click="EliminardetalleVuelo({{ $i }})" tabindex="90"><i class="fas fa-times icono-size-peq"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <h5 class="mt-3 font-weight-bold tx-14">No Incluye Vuelo</h5>
                                        <table class="table table-bordered table-hover mb-0 text-nowrap">
                                            <tbody>
                                                @foreach ($noincluyeserviceVuelo as $i => $service)
                                                <tr class="tr-modal-detalle">
                                                    <td>
                                                        <input type="text" class="text-modal-detalle" id="noincluyeserviceVuelo[{{ $i }}]" value="{{ $service['titulo'] }}" wire:model="noincluyeserviceVuelo.{{ $i }}.titulo">
                                                    </td>
                                                    <td class="" style="text-align: -webkit-center;">
                                                        <button type="button" class="btn btn-danger btn-icon delete-button-modal" wire:click="EliminarNoIncluyeDetalleVuelo({{ $i }})" tabindex="90"><i class="fas fa-times icono-size-peq"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-md-4 d-flex align-items-center gap-2">
                                <div class="w-100">
                                    <div class="form-group d-flex">
                                        <label class="custom-switch ps-0">
                                            <input type="checkbox" name="custom-switch-checkbox4" class="custom-switch-input" wire:model="idavuelta">
                                            <span class="custom-switch-indicator custom-switch-indicator-lg custom-radius"></span>
                                        </label>
                                        <h6 class="modal-title ms-4">Ida / Ida y Vuelta</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-start">
                            <div class="mb-3 col-md-6 d-flex align-items-center gap-2">
                                <div class="w-100">
                                    <h6 class="modal-title">Precio Soles:</h6>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="precioserviciosolesVuelo" wire:model.lazy="precioserviciosolesVuelo">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 d-flex align-items-center gap-2">
                                <div class="w-100">
                                    <h6 class="modal-title">Precio Dolares:</h6>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="precioserviciodolaresVuelo" wire:model.lazy="precioserviciodolaresVuelo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="tx-18 p-0 m-0"><strong>Ida</strong></p>
                        <div class="row justify-content-end">
                            <div class="mb-3 col-md-6">
                                <div wire:ignore>
                                    <label class="form-label" for="desde">Desde:</label>
                                    <select class="form-select" id="desde" name="desde" data-width="100%" wire:model="desde">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($aeropuertos as $aeropuerto)
                                        <option value="{{ $aeropuerto->abrev}}"> ({{ $aeropuerto->abrev}}) {{ $aeropuerto->nombre}} {{ $aeropuerto->ciudad}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div wire:ignore>
                                    <label class="form-label" for="hasta">Hasta:</label>
                                    <select class="form-select" id="hasta" name="hasta" data-width="100%" wire:model="hasta">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($aeropuertos as $aeropuerto)
                                        <option value="{{ $aeropuerto->abrev}}"> ({{ $aeropuerto->abrev}}) {{ $aeropuerto->nombre}} {{ $aeropuerto->ciudad}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if($idavuelta)
                        <p class="tx-18 p-0 m-0"><strong>Vuelta</strong></p>
                        <div class="row justify-content-end">
                            <div class="mb-3 col-md-6">
                                <div wire:ignore>
                                    <label class="form-label" for="desdevuelta">Desde:</label>
                                    <select class="form-select" id="desdevuelta" name="desdevuelta" data-width="100%" wire:model="desdevuelta">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($aeropuertos as $aeropuerto)
                                        <option value="{{ $aeropuerto->abrev}}"> ({{ $aeropuerto->abrev}}) {{ $aeropuerto->nombre}} {{ $aeropuerto->ciudad}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div wire:ignore>
                                    <label class="form-label" for="hastavuelta">Hasta:</label>
                                    <select class="form-select" id="hastavuelta" name="hastavuelta" data-width="100%" wire:model="hastavuelta">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($aeropuertos as $aeropuerto)
                                        <option value="{{ $aeropuerto->abrev}}"> ({{ $aeropuerto->abrev}}) {{ $aeropuerto->nombre}} {{ $aeropuerto->ciudad}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button" wire:click="registerDetalleVuelo">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Container -->
@push('custom-scripts')
<script>
    document.addEventListener('livewire:load', function() {
        $('#servicio, #incluye').select2({
            dropdownParent: $("#modalServicios"),
        });
        $('#servicio').on('change', function(e) {
            @this.set('servicio', e.target.value);
        });
        $('#incluye').on('change', function(e) {
            @this.set('incluye', e.target.value);
        });
    });
    document.addEventListener('livewire:update', function() {
        $('#servicio, #incluye').select2({
            dropdownParent: $("#modalServicios"),
        });
    });
    $('#descripcion').summernote();
    $('#descripcion').on('summernote.change', function(we, contents, $editable) {
        @this.set('descripcion', contents);
    });
</script>
<script>
    document.addEventListener('livewire:load', function() {
        $('#servicioHotel, #incluyeHotel').select2({
            dropdownParent: $("#modalHoteles"),
        });
        $('#servicioHotel').on('change', function(e) {
            @this.set('servicioHotel', e.target.value);
        });
        $('#incluyeHotel').on('change', function(e) {
            @this.set('incluyeHotel', e.target.value);
        });
    });
    document.addEventListener('livewire:update', function() {
        $('#servicioHotel, #incluyeHotel').select2({
            dropdownParent: $("#modalHoteles"),
        });
    });
</script>
<script>
    document.addEventListener('livewire:load', function() {
        $('#servicioVuelo, #incluyeVuelo, #desde, #hasta, #desdevuelta, #hastavuelta').select2({
            dropdownParent: $("#modalVuelos"),
            width: '100%',
        });
        $('#servicioVuelo').on('change', function(e) {
            @this.set('servicioVuelo', e.target.value);
        });
        $('#incluyeVuelo').on('change', function(e) {
            @this.set('incluyeVuelo', e.target.value);
        });
        $('#desde').on('change', function(e) {
            @this.set('desde', e.target.value);
        });

        $('#hasta').on('change', function(e) {
            @this.set('hasta', e.target.value);
        });
        $('#desdevuelta').on('change', function(e) {
            @this.set('desdevuelta', e.target.value);
        });

        $('#hastavuelta').on('change', function(e) {
            @this.set('hastavuelta', e.target.value);
        });
    });

    document.addEventListener('livewire:update', function() {
        $('#servicioVuelo, #incluyeVuelo, #desde, #hasta, #desdevuelta, #hastavuelta').select2({
            dropdownParent: $("#modalVuelos"),
        });

        $('#desdevuelta').on('change', function(e) {
            @this.set('desdevuelta', e.target.value);
        });

        $('#hastavuelta').on('change', function(e) {
            @this.set('hastavuelta', e.target.value);
        });
    });
</script>
<script>
    document.addEventListener('livewire:load', function() {
        $('#genero').select2({
            width: '100%',
        });
        $('#genero').on('change', function(e) {
            @this.set('genero', e.target.value);
        });
    });
</script>

<script>
    const inputElement2 = document.querySelector('#imagenes');
    const pond2 = FilePond.create(inputElement2, {
        acceptedFileTypes: ['image/*'],
        fileValidateTypeDetectType: (source, type) =>
            new Promise((resolve, reject) => {
                resolve(type);
            }),
    }).setOptions({
        server: {
            process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                @this.upload('imagenes', file, load, error, progress)
            },
            revert: (filename, load) => {
                @this.removeUpload('imagenes', filename, load)
            },
        },
    });
</script>


<script>
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
</script>


<script>
    $('#nombres').select2({
        tags: true,
        width: '100%'
    });
    $('#nombres').on('change', function() {
        @this.set('nombres', this.value);
    });

    $('#pais_id').select2({
        width: '100%'
    });
    $('#pais_id').on('change', function(e) {
        @this.set('pais_id', e.target.value);
    });

    Livewire.on('sinEncontrar', postId => {
        jQuery(document).ready(function() {
            $('#pais_id').select2();
            $('#pais_id').on('change', function(e) {
                @this.set('pais_id', this.value);
            });
        });
    });

    Livewire.on('Encontrar', function(id) {
        $('#pais_id').val(id).select2();
        $('#pais_id').on('change', function(e) {
            @this.set('pais_id', this.value);
        });
    });

    Livewire.on('EncontrarPasajero', function(id, datos) {
        $('#nombres').val(id).select2({
            data: datos,
        });
        $('#nombres').on('change', function(e) {
            @this.set('nombres', this.value);
        });
    });
</script>
<script>
    Livewire.on('openModal', function() {
        $('#modalServicios').modal('show');
    });

    Livewire.on('closeModal', function() {
        $('#modalServicios').modal('hide');
    });
</script>
<script>
    Livewire.on('openModalHotel', function() {
        $('#modalHoteles').modal('show');
    });

    Livewire.on('closeModal', function() {
        $('#modalHoteles').modal('hide');
    });
</script>
<script>
    Livewire.on('openModalVuelo', function() {
        $('#modalVuelos').modal('show');
    });

    Livewire.on('closeModal', function() {
        $('#modalVuelos').modal('hide');
    });
</script>

@endpush
@extends('layout.masterweb')


@push('plugin-styles')
@endpush
@section('content')
<div>


    <div>
        <div class="carousel slide" data-bs-ride="carousel" id="carouselExample2">
            <div class="carousel-inner">
                <div class="carousel-item border-none active">
                    <img alt="img" class="d-block w-100 carousel-image" src="{{asset('storage/'.$paquete->img_principal)}}">
                </div>
                @foreach ($paquete->images as $image)
                    <div class="carousel-item border-none">
                        <img alt="img" class="d-block w-100 carousel-image" src="{{asset('storage/paquetes/'.$image->nombre)}}">
                    </div>
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
    <div class="d-flex justify-content-center relative " style="margin-top:-60px;">
        <div class="card w-75">
            <div class="card-body d-flex justify-content-evenly align-items-center" style="height:120px;">
            @if ($paquete->video)
                <a href="{{$paquete->video}}" data-fancybox="" class="video-show-feature playbutton ">
                    <button type="button" class="btn btn-primary btn-sm mb-1">
                        <i class="far fa-play-circle" style="font-size: 50px;"></i>
                    </button>
                </a>
            @endif
                <div class="mg-sm-r-20 mg-b-10">
                    <div class="main-profile-contact-list">
                        <div class="media">
                            <div
                                class="media-icon bg-primary-transparent text-primary">
                                <i class="icon ion-ios-calendar"></i>
                            </div>
                            <div class="media-body"> <span>Fecha Disponibilidad</span>
                                <div> {{ $paquete->fecha_disponibilidad }} </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mg-sm-r-20 mg-b-10">
                    <div class="main-profile-contact-list">
                        <div class="media">
                            <div
                                class="media-icon bg-primary-transparent text-success">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="media-body"> <span>Precio</span>
                                <div>{{ $paquete->precio_soles > 0 ? 'Precio Soles: ' . $paquete->precio_soles : '' }}</div>
                                <div>{{ $paquete->precio_dolares > 0 ? 'Precio Dolares: ' . $paquete->precio_dolares : '' }}</div>
                                <div>{{ $paquete->precio_soles_niño > 0 ? 'Precio Soles Niño: ' . $paquete->precio_soles_niño : '' }}</div>
                                <div>{{ $paquete->precio_dolares_niño > 0 ? 'Precio Dolares Niño: ' . $paquete->precio_dolares_niño : '' }}</div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="mg-sm-r-20 mg-b-10">
                    <div class="main-profile-contact-list">
                        <div class="media">
                            <div
                                class="media-icon bg-primary-transparent text-success">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="media-body"> <span>Cantidad</span>
                                <div> {{ $paquete->cantidad_pax }} Estandar</div>
                                <div> {{ $paquete->cantpaxniños }} Niño</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container px-5">
    <h3 class="text-gray font-weight-semibold mb-2 mt-0 text-center">{{$paquete->mensaje_bienvenida}}</h3>
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 p-4">
                <div class="text-justify">
                    <div class="text-dark tx-26 font-weight-semibold">Descripcion de este Paquete</div>
                    {!! $paquete->descripcion !!}
                </div>
                <div class="row about-motto pt-0">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="text-justify">
                            <div class="text-dark tx-26 font-weight-semibold">Incluye / No Incluye:</div>
                            <p class="tx-14 mb-4">
                                @if(count($paquete->detallestours) > 0)
                                <h5>Servicios</h5>
                                    @foreach ($paquete->detallestours as $detalle )
                                        <?php
                                            $img = $detalle->servicio->img_principal ? $detalle->servicio->img_principal : "storage/servicios/default.png";
                                        ?>
                                        <div class="border d-flex p-2 br-5 mb-2" data-bs-toggle="modal" data-bs-target="#detalleModal{{$detalle->id}}">
                                            <div class="recent-contacts me-3">
                                                <div class="avatar rounded-circle">
                                                    <img alt="avatar" class="rounded-circle" style="height:36px; width:36px;" src="{{asset($img)}}">
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mt-1 mb-1">{{ $detalle->servicio->titulo}}</h6>
                                                @if(isset($detalle->servicio))
                                                    <p class="d-flex align-content-start flex-wrap gap-1 m-1">
                                                        @foreach($detalle->detallesIncluidos as $incluye)
                                                            <span class="badge bg-primary me-1">{{ $incluye->servicioIncluido->titulo }}</span>
                                                        @endforeach
                                                    </p>
                                                @endif
                                                @if(isset($detalle->servicio))
                                                    <p class="d-flex align-content-start flex-wrap gap-1 m-1">
                                                        @foreach($detalle->detallesNoIncluidos as $noincluye)
                                                            <span class="badge bg-danger me-1">{{ $noincluye->servicioNoIncluido->titulo }}</span>
                                                        @endforeach
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal fade " id="detalleModal{{$detalle->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="modal-title">{{$detalle->servicio->titulo}}</h6>
                                                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="ps-4 pt-4 pe-3 pb-4">
                                                                        <div class="">
                                                                            <h4 class="card-title mb-3">{{$detalle->servicio->subtitulo}}</h4>
                                                                            <div id="modal-description">{{$detalle->servicio->descripcion}}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <img class="w-100 object-fit-cover border rounded" style="height:350px; object-fit:cover;" id="modal-image" src="{{asset($img)}}">
                                                                </div>
                                                            </div>
                                                            <div class="row mt-5">
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h3 class="card-title  mg-b-10">Incluye</h3>
                                                                            @foreach($detalle->detallesIncluidos as $incluye)
                                                                                <div id="modal-incluye">{{ $incluye->servicioIncluido->titulo }}</div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h3 class="card-title  mg-b-10">No Incluye</h3>
                                                                            @foreach($detalle->detallesNoIncluidos as $noincluye)
                                                                                <div id="modal-noincluye">- {{ $noincluye->servicioNoIncluido->titulo }}</div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if(count($paquete->detalleshoteles) > 0)
                                <h5>Hoteles</h5>
                                    @foreach ($paquete->detalleshoteles as $detalle )
                                        <?php
                                            $img = $detalle->servicio->img_principal ? $detalle->servicio->img_principal : "storage/servicios/default.png";
                                        ?>
                                        <div class="border d-flex p-2 br-5 mb-2" data-bs-toggle="modal" data-bs-target="#detalleModal{{$detalle->id}}">
                                            <div class="recent-contacts me-3">
                                                <div class="avatar rounded-circle">
                                                    <img alt="avatar" class="rounded-circle" style="height:36px; width:36px;" src="{{asset($img)}}">
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mt-1 mb-1">{{ $detalle->servicio->titulo}}</h6>
                                                @if(isset($detalle->servicio))
                                                    <p class="d-flex align-content-start flex-wrap gap-1 m-1">
                                                        @foreach($detalle->detallesIncluidos as $incluye)
                                                            <span class="badge bg-primary me-1">{{ $incluye->servicioIncluido->titulo }}</span>
                                                        @endforeach
                                                    </p>
                                                @endif
                                                @if(isset($detalle->servicio))
                                                    <p class="d-flex align-content-start flex-wrap gap-1 m-1">
                                                        @foreach($detalle->detallesNoIncluidos as $noincluye)
                                                            <span class="badge bg-danger me-1">{{ $noincluye->servicioNoIncluido->titulo }}</span>
                                                        @endforeach
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal fade " id="detalleModal{{$detalle->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="modal-title">{{$detalle->servicio->titulo}}</h6>
                                                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <div class="row">
                                                                <?php
                                                                    $img = $detalle->servicio->img_principal ? $detalle->servicio->img_principal : "storage/servicios/default.png";
                                                                ?>
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <img class="w-100 object-fit-cover border rounded" style="height:350px; object-fit:cover;" id="modal-image" src="{{asset($img)}}">
                                                                </div>
                                                            </div>
                                                            <div class="row mt-5">
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h3 class="card-title  mg-b-10">Incluye</h3>
                                                                            @foreach($detalle->detallesIncluidos as $incluye)
                                                                                <div id="modal-incluye">{{ $incluye->servicioIncluido->titulo }}</div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h3 class="card-title  mg-b-10">No Incluye</h3>
                                                                            @foreach($detalle->detallesNoIncluidos as $noincluye)
                                                                                <div id="modal-noincluye">- {{ $noincluye->servicioNoIncluido->titulo }}</div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if(count($paquete->detallesvuelos) > 0)
                                <h5>Vuelos</h5>
                                    @foreach ($paquete->detallesvuelos as $detalle )
                                        <?php
                                            $img = $detalle->servicio->img_principal ? $detalle->servicio->img_principal : "storage/servicios/default.png";
                                        ?>
                                        <div class="border d-flex p-2 br-5 mb-2" data-bs-toggle="modal" data-bs-target="#detalleModal{{$detalle->id}}">
                                            <div class="recent-contacts me-3">
                                                <div class="avatar rounded-circle">
                                                    <img alt="avatar" class="rounded-circle" style="height:36px; width:36px;" src="{{asset($img)}}">
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mt-1 mb-1">{{ $detalle->servicio->titulo}}</h6>
                                                @if(isset($detalle->servicio))
                                                    <p class="d-flex align-content-start flex-wrap gap-1 m-1">
                                                        @foreach($detalle->detallesIncluidos as $incluye)
                                                            <span class="badge bg-primary me-1">{{ $incluye->servicioIncluido->titulo }}</span>
                                                        @endforeach
                                                    </p>
                                                @endif
                                                @if(isset($detalle->servicio))
                                                    <p class="d-flex align-content-start flex-wrap gap-1 m-1">
                                                        @foreach($detalle->detallesNoIncluidos as $noincluye)
                                                            <span class="badge bg-danger me-1">{{ $noincluye->servicioNoIncluido->titulo }}</span>
                                                        @endforeach
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal fade " id="detalleModal{{$detalle->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="modal-title">{{$detalle->servicio->titulo}}</h6>
                                                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <img class="w-100 object-fit-cover border rounded" style="height:350px; object-fit:cover;" id="modal-image" src="{{asset($img)}}">
                                                                </div>
                                                            </div>
                                                            <div class="row mt-5">
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h3 class="card-title  mg-b-10">Incluye</h3>
                                                                            @foreach($detalle->detallesIncluidos as $incluye)
                                                                                <div id="modal-incluye">{{ $incluye->servicioIncluido->titulo }}</div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h3 class="card-title  mg-b-10">No Incluye</h3>
                                                                            @foreach($detalle->detallesNoIncluidos as $noincluye)
                                                                                <div id="modal-noincluye">- {{ $noincluye->servicioNoIncluido->titulo }}</div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 p-4">
                <p><img src="{{asset('storage/'.$paquete->img_principal)}}" class="br-5"  alt="image"></p>
            </div>
        </div>
        <div class="row align-items-center mb-5">
            <div class="col-lg-12 col-md-12">
                <div class="custom-card">
                    <div class="card-body">
                        <div aria-multiselectable="true" class="accordion accordion-dark" id="accordion2"
                            role="tablist">
                            <div class="card mb-0">
                                <div class="card-header" id="headingOne2" role="tab">
                                    <a aria-controls="collapseOne2" aria-expanded="true"
                                        data-bs-toggle="collapse" href="#collapseOne2" class=" tx-20"><i
                                            class="fe fe-plus-circle me-2"></i>
                                            Politica de Cancelacion
                                        </a>
                                </div>
                                <div aria-labelledby="headingOne2" class="collapse"
                                    data-bs-parent="#accordion2" id="collapseOne2" role="tabpanel">
                                    <div class="card-body">
                                        {!! $datospdf->rec_cancel1 !!}
                                        <br>
                                        {!! $datospdf->rec_cancel2 !!}
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-0 mt-2">
                                <div class="card-header" id="headingTwo4" role="tab">
                                    <a aria-controls="collapseTwo4" aria-expanded="true"
                                        data-bs-toggle="collapse" href="#collapseTwo4" class=" tx-20"><i
                                            class="fe fe-plus-circle me-2"></i>Politicas de Reserva</a>
                                </div>
                                <div aria-labelledby="headingTwo4" class="collapse" data-bs-parent="#accordion2"
                                    id="collapseTwo4" role="tabpanel">
                                    <div class="card-body">
                                        {!! $datospdf->poli_ven1 !!}
                                        <br>
                                        {!! $datospdf->poli_ven2 !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 col-md-6">
                <div class="card custom-card">
                    <div class="card-body d-md-flex">
                        <div class="">
                            <span class="profile-image pos-relative">
                                <img class="br-5 object-fit-cover" alt="" src="{{asset($paquete->user->imagen)}}" style="object-fit:cover;">
                                <span class="bg-success text-white wd-1 ht-1 rounded-pill profile-online"></span>
                            </span>
                        </div>
                        <div class="my-md-auto mt-4 prof-details">
                            <h4 class="font-weight-semibold ms-md-4 ms-0 mb-1 pb-0">{{ $paquete->user->nombre }}</h4>
                            <p class="tx-13 text-muted ms-md-4 ms-0 mb-2 pb-2 ">
                                <span class="me-3"><i class="far fa-address-card me-2"></i>Counter</span>
                                <span><i class="far fa-flag me-2"></i>Cusco - Perú</span>
                            </p>
                            <p class="text-muted ms-md-4 ms-0 mb-2"><span><i
                                        class="fa fa-phone me-2"></i></span><span
                                    class="font-weight-semibold me-2">Celular:</span><span>{{$paquete->user->celular}}</span>
                            </p>
                            <p class="text-muted ms-md-4 ms-0 mb-2"><span><i
                                        class="fa fa-envelope me-2"></i></span><span
                                    class="font-weight-semibold me-2">Email:</span><span>{{$paquete->user->email}}</span>
                            </p>
                        </div>
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
<!-- /Container -->

<!-- Extra-large  modal -->


@endsection


@push('custom-scripts')


@endpush

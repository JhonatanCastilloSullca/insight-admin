@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between align-items-center">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">Voucher de Oficina N° {{ $reserva->numero }}-{{ date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje)) }}</span>
            </div>
            <div class="justify-content-center ">
                <a href="{{route('ingreso.machupicchu',["reservaId" =>$reserva->id])}}">
                    <button type="button" class="btn btn-dark mb-2 mb-md-0 ">
                        <i class="fa fa-plus-circle"></i><b> &nbsp; Ingresos</b>
                    </button>
                </a>
                <a href="{{ route('reserva.pdfvoucher', $reserva) }}">
                    <button type="button" class="btn btn-warning mb-2 mb-md-0 ">
                        <i class="fa fa-file"></i><b> &nbsp; Voucher Cliente</b>
                    </button>
                </a>
                <a href="{{ route('reserva.edit', $reserva) }}">
                    <button type="button" class="btn btn-info mb-2 mb-md-0 ">
                        <i class="fa fa-edit"></i><b> &nbsp; Editar</b>
                    </button>
                </a>
                @if(count($reserva->totalesConSaldo) > 0)
                    <button type="button" class="btn btn-primary mb-2 mb-md-0 " data-bs-toggle="modal"
                        data-bs-target="#agregarPago">
                        <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Pago</b>
                    </button>
                @endif
            </div>
        </div>
        <!-- /breadcrumb -->
        <!-- row -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span
                    aria-hidden="true">&times;</span></button>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="list-group-item border-0">
                                <div class="media mt-0">
                                    <img class="avatar-lg rounded-circle me-3 my-auto shadow"
                                        src="{{ asset($reserva->user->imagen) }}" alt="Image description">
                                    <div class="media-body">
                                        <div class="d-flex align-items-center justify-content-between w-100">
                                            <div class="d-flex align-items-center">
                                                <div class="mt-0 me-4"> <!-- Añadir un margen a la derecha si es necesario -->
                                                    <h5 class="mb-1 tx-24 font-weight-sembold text-dark">
                                                        {{ $reserva->user->nombre }}
                                                    </h5>
                                                    <p class="mb-0 tx-18 text-muted">Cel: {{ $reserva->user->celular }}</p>
                                                    <p class="mb-0 tx-18 text-muted">Fecha Registro: {{ date("d-m-Y",strtotime($reserva->fecha)) }}</p>
                                                </div>
                                            </div>
                                            <div class="mt-0 text-end"> <!-- Alinear a la derecha -->
                                                @if(count($reserva->reprogramaciones)>0 )
                                                    <h5 class="mb-1 tx-24 font-weight-sembold text-dark">
                                                        RESERVA REPROGRAMADO DE:
                                                    </h5>
                                                    <p class="mb-0 tx-18 text-muted"><a href="{{ route('reserva.voucheroficina', $reserva->reprogramaciones[0]->reservaanterior) }}">{{ $reserva->reprogramaciones[0]->reservaanterior->numero }}-{{ $reserva->reprogramaciones[0]->reservaanterior->primerafecha()?->fecha_viaje ? date("d-m-Y",strtotime($reserva->reprogramaciones[0]->reservaanterior->primerafecha()?->fecha_viaje)) : ''}}</a></p>
                                                @endif
                                                @if(count($reserva->reprogramacionesinversas)>0)
                                                    <h5 class="mb-1 tx-24 font-weight-sembold text-dark">
                                                    RESERVA REPROGRAMADO A:
                                                    </h5>
                                                    <p class="mb-0 tx-18 text-muted"><a href="{{ route('reserva.voucheroficina', $reserva->reprogramacionesinversas[0]->reserva) }}">{{ $reserva->reprogramacionesinversas[0]->reserva->numero }}-{{ $reserva->reprogramacionesinversas[0]->reserva->primerafecha()?->fecha_viaje ? date("d-m-Y",strtotime($reserva->reprogramacionesinversas[0]->reserva->primerafecha()?->fecha_viaje)) : ''}}</a></p>
                                                @endif
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
        <div class="row">
            @foreach ($reserva->totales as $total)
                <div class="col-12 col-sm-6 col-md-4 col-lg-4 ">
                    <div class="card sales-card circle-image1 border-bottom border-primary ">
                        <div class="row">
                            <div class="col-12">
                                <div class="ps-4 pt-4 pe-3 pb-4">
                                    <div class="">
                                        <h6 class="mb-2 tx-12 ">Precio total del paquete:</h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <h4 class="tx-20 font-weight-semibold mb-2">{{ $total->moneda->abreviatura }}
                                                {{ $total->total }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-4 ">
                    <div class="card sales-card circle-image1 border-bottom border-primary ">
                        <div class="row">
                            <div class="col-12">
                                <div class="ps-4 pt-4 pe-3 pb-4">
                                    <div class="">
                                        <h6 class="mb-2 tx-12 ">Monto total pagado:</h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <h4 class="tx-20 font-weight-semibold mb-2">{{ $total->moneda->abreviatura }}
                                                {{ $total->acuenta }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-4 ">
                    <div class="card sales-card circle-image1 border-bottom border-primary ">
                        <div class="row">
                            <div class="col-12">
                                <div class="ps-4 pt-4 pe-3 pb-4">
                                    <div class="">
                                        <h6 class="mb-2 tx-12 ">Saldo pendiente:</h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <h4 class="tx-20 font-weight-semibold mb-2">{{ $total->moneda->abreviatura }}
                                                {{ $total->saldo }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div id="accordion01" class="w-100 overflow-hidden Accordion-Style02 ">
                <div class="mb-2">
                    <div class="accor " id="headingOne1">
                        <div class="m-0">
                            <a href="#collapseOne1" class="tx-20 fw-normal" data-bs-toggle="collapse" aria-expanded="true"
                                aria-controls="collapseOne">
                                <i class="tx-18 fe fe-users me-2"></i>
                                Pasajeros
                            </a>

                        </div>
                    </div>
                    <div id="collapseOne1" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion01">
                        <div class="border p-3 accstyle border-top-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mg-b-0 text-md-nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th>N°</th>
                                            <th>Nombres</th>
                                            <th>Nacionalidad</th>
                                            <th>Documentos</th>
                                            <th>Edad</th>
                                            <th>Genero</th>
                                            <th>Teléfono</th>
                                            <th>Correo</th>
                                            <th>Comentarios</th>
                                            <th>Imagen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reserva->pasajeros as $i => $pasajero)
                                            <tr>
                                                <td class="">{{ ++$i }}</td>
                                                <td>{{ $pasajero->nombreCompleto }}</td>
                                                <td>{{ $pasajero->pais->nombre }}</td>
                                                <td>{{ $pasajero->documento?->tipo_documento }}
                                                    {{ $pasajero->documento?->num_documento }}</td>
                                                <td>{{ \Carbon\Carbon::parse($pasajero->nacimiento)->diffInYears(\Carbon\Carbon::now()) }} / {{date("d-m-Y",strtotime($pasajero->nacimiento))}}
                                                </td> 
                                                <td>{{ $pasajero->genero == 'MASCULINO' ? 'M' : 'F' }}</td>
                                                <td>{{ $pasajero->celular }}</td>
                                                <td>{{ $pasajero->email }}</td>
                                                <td>{{ $pasajero->comentario }}</td>
                                                <td>
                                                    @if($pasajero->imagen)
                                                        <a href="{{asset('storage/img/documentos/'.$pasajero->imagen)}}" target="_blank">
                                                            <button type="button"  class="btn btn-warning btn-icon"><i class="fe fe-eye"></i></button>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="accor" id="headingTwo2">
                        <div class="m-0">
                            <a href="#collapseTwo2" class="tx-20 fw-normal collapsed" data-bs-toggle="collapse"
                                aria-expanded="false" aria-controls="collapseTwo">
                                <i class="tx-18 fe fe-layers me-2"></i>
                                Servicios registrados
                            </a>
                        </div>
                    </div>
                    <div id="collapseTwo2" class="collapse b-b0" aria-labelledby="headingTwo" data-bs-parent="#accordion01">
                        <div class="border p-3 accstyle border-top-0">
                            <div class="row">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mg-b-0 text-md-nowrap">
                                        <thead>
                                            <tr class="text-center">
                                                <th>N°</th>
                                                <th>Pax</th>
                                                <th>Servicio</th>
                                                <th>Fecha Inicio</th>
                                                <th>Incluye</th>
                                                <th>No incluye</th>
                                                <th>Comentarios</th>
                                                <th>P. Unitario</th>
                                                <th>P. Venta</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reserva->detallestours as $i => $detalle)
                                                <tr>
                                                    <td class="thnro">{{ ++$i }}</td>
                                                    <td>{{ $detalle->pax }}</td>
                                                    <td>{{ $detalle->servicio->titulo }}</td>
                                                    <td>
                                                        {{ date('d-m-Y', strtotime($detalle->fecha_viaje)) }}
                                                    </td>
                                                    <td>
                                                        @foreach ($detalle->itinerarios as $itinerario)
                                                            @foreach ($itinerario->incluyes as $incluye)
                                                                - {{ $incluye->titulo }}<br>
                                                            @endforeach
                                                        @endforeach
                                                    </td>
                                                    <td class="tdcenter">
                                                        @foreach ($detalle->itinerarios as $itinerario)
                                                            @foreach ($itinerario->noincluyes as $noincluye)
                                                                - {{ $noincluye->titulo }}<br>
                                                            @endforeach
                                                        @endforeach
                                                    </td>
                                                    <td>{!! $detalle->comentarios !!}</td>
                                                    <td>{{ $detalle->moneda_id == 1 ? 'S/ ' : '$ '}} {{ number_format($detalle->precio,2) }}</td>
                                                    <td>{{ $detalle->moneda_id == 1 ? 'S/ ' : '$ '}} {{ number_format($detalle->precio*$detalle->pax,2) }}</td>
                                                    <td>
                                                        @if($detalle->estado==1)
                                                            <span class="badge bg-primary me-1 my-2">Registrado</span>
                                                        @elseif($detalle->estado==2)
                                                            <span class="badge bg-danger me-1 my-2">Cancelado</span>
                                                        @elseif($detalle->estado==3)
                                                            <span class="badge bg-info me-1 my-2">Repogramado</span>
                                                        @else
                                                            <span class="badge bg-dark me-1 my-2">Finalizado</span>
                                                        @endif
                                                    </td>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            @if (count($reserva->detalleshoteles))
                                <div class="row">
                                    <h4 class="title-table">HOTELES REGISTRADOS</h4>
                                    <table class="table table-bordered table-striped mg-b-0 text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="thnro">N°</th>
                                                <th class="tdcenter">Cant.</th>
                                                <th class="tdcenter">Noches</th>
                                                <th class="tdcenter">Servicio</th>
                                                <th class="tdcenter">Check Inn</th>
                                                <th class="tdcenter">Check Out</th>
                                                <th>Comentarios</th>
                                                <th>P. Unitario</th>
                                                <th>P. Venta</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reserva->detalleshoteles as $i => $detalle)
                                                <tr>
                                                    <td class="thnro">{{ ++$i }}</td>
                                                    <td>{{ $detalle->pax }}</td>
                                                    <td>{{ $detalle->equipaje }}</td>
                                                    <td>{{ $detalle->servicio->proveedor?->nombre }}
                                                        {{ $detalle->servicio->proveedor?->ubicacion?->nombre }}
                                                        {{ $detalle->servicio->titulo }}</td>
                                                    <td>{{ date('d-m-Y H:i', strtotime($detalle->fecha_viaje)) }} </td>
                                                    <td class="tdcenter">
                                                        {{ date('d-m-Y H:i', strtotime($detalle->fecha_viajefin)) }}
                                                    </td>
                                                    <td>{!! $detalle->comentarios !!}</td>
                                                    <td>{{ $detalle->moneda_id == 1 ? 'S/ ' : '$ '}} {{ number_format($detalle->precio,2)}}</td>
                                                    <td>{{ $detalle->moneda_id == 1 ? 'S/ ' : '$ '}} {{ number_format($detalle->precio * $detalle->pax * $detalle->equipaje + $detalle->adicional,2)}}</td>
                                                    <td>
                                                        @if($detalle->estado==1)
                                                            <span class="badge bg-primary me-1 my-2">Registrado</span>
                                                        @elseif($detalle->estado==2)
                                                            <span class="badge bg-danger me-1 my-2">Cancelado</span>
                                                        @elseif($detalle->estado==3)
                                                            <span class="badge bg-info me-1 my-2">Repogramado</span>
                                                        @else
                                                            <span class="badge bg-dark me-1 my-2">Finalizado</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            @if (count($reserva->detallesvuelos))
                                <div class="row">
                                    <h4 class="title-table">VUELOS REGISTRADOS</h4>
                                    <table class="table table-bordered table-striped mg-b-0 text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="thnro">N°</th>
                                                <th class="tdcenter">Pax</th>
                                                <th class="tdcenter">Servicio</th>
                                                <th class="tdcenter">Fecha Ida</th>
                                                <th class="tdcenter">Fecha Retorno</th>
                                                <th class="tdcenter">Incluye</th>
                                                <th class="tdcenter">No Incluye</th>
                                                <th class="tdcenter">Comentarios</th>
                                                <th class="tdcenter">P. Unitario</th>
                                                <th class="tdcenter">P. Venta</th>
                                                <th class="tdcenter">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reserva->detallesvuelos as $i => $detalle)
                                                <tr>
                                                    <td class="thnro">{{ ++$i }}</td>
                                                    <td>{{ $detalle->pax }}</td>
                                                    <td>{{ $detalle->servicio->titulo }}</td>
                                                    <td>{{ date('d-m-Y H:i', strtotime($detalle->fecha_viaje)) }}</td>
                                                    <td>{{ $detalle->fecha_viajefin ? date('d-m-Y H:i', strtotime($detalle->fecha_viajefin)) : '' }}</td>
                                                    <td>
                                                        @foreach ($detalle->itinerarios as $itinerario)
                                                            @foreach ($itinerario->incluyes as $incluye)
                                                                - {{ $incluye->titulo }}<br>
                                                            @endforeach
                                                        @endforeach
                                                    </td>
                                                    <td class="tdcenter">
                                                        @foreach ($detalle->itinerarios as $itinerario)
                                                            @foreach ($itinerario->noincluyes as $noincluye)
                                                                - {{ $noincluye->titulo }}<br>
                                                            @endforeach
                                                        @endforeach
                                                    </td>
                                                    <td>{!! $detalle->comentarios !!}</td>
                                                    <td>{{ $detalle->moneda_id == 1 ? 'S/ ' : '$ ' }} {{ number_format($detalle->precio, 2) }}
                                                    <td>{{ $detalle->moneda_id == 1 ? 'S/ ' : '$ ' }} {{ number_format($detalle->precio * $detalle->pax, 2) }}</td>
                                                    <td>
                                                        @if($detalle->estado==1)
                                                            <span class="badge bg-primary me-1 my-2">Registrado</span>
                                                        @elseif($detalle->estado==2)
                                                            <span class="badge bg-danger me-1 my-2">Cancelado</span>
                                                        @elseif($detalle->estado==3)
                                                            <span class="badge bg-info me-1 my-2">Repogramado</span>
                                                        @else
                                                            <span class="badge bg-dark me-1 my-2">Finalizado</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="accor " id="headingThree3">
                        <div class="m-0">
                            <a href="#collapseThree1" class="tx-20 fw-normal collapsed" data-bs-toggle="collapse"
                                aria-expanded="false" aria-controls="collapseThree">
                                <i class="tx-18 fe fe-dollar-sign me-2"></i>
                                Pagos registrados
                            </a>
                        </div>
                    </div>
                    <div id="collapseThree1" class="collapse b-b0" aria-labelledby="headingThree"
                        data-bs-parent="#accordion">
                        <div class="border table-responsive p-3 accstyle border-top-0">
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
                                        @foreach ($reserva->pagos as $i => $pago)
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
                                                    @if(\Auth::user()->roles[0]->name == 'Administrador')
                                                        @if(!$pago->contabilidad)
                                                            <a href="{{route('contabilizar.pago',$pago)}}">
                                                                <button type="button"  class="btn btn-warning btn-icon"><i class="fa fa-check-circle"></i>
                                                                </button>
                                                            </a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @if(count($reserva->cuotas)>0)
                    <div class="mb-2">
                        <div class="accor " id="headingThree4">
                            <div class="m-0">
                                <a href="#collapseThree4" class="tx-20 fw-normal collapsed" data-bs-toggle="collapse"
                                    aria-expanded="false" aria-controls="collapseThree">
                                    <i class="tx-18 fe fe-sliders me-2"></i>
                                    Cronograma de Pagos por realizar
                                </a>
                            </div>
                        </div>
                        <div id="collapseThree4" class="collapse b-b0" aria-labelledby="headingThree"
                            data-bs-parent="#accordion">
                            <div class="border table-responsive p-3 accstyle border-top-0">
                                <div class="row">
                                    <table class="table table-bordered table-striped mg-b-0 text-md-nowrap">
                                        <thead>
                                            <tr class="text-center">
                                                <th>N°</th>
                                                <th>Fecha</th>
                                                <th>Monto</th>
                                                <th>Comentario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reserva->cuotas as $i => $cuota)
                                                <tr>
                                                    <td class="thnro">{{ $cuota->nroCuota }}</td>
                                                    <td>{{ $cuota->fecha }}</td>
                                                    <td>{{ $cuota->moneda->abreviatura }} {{ $cuota->monto }}</td>
                                                    <td>{{ $cuota->comentarios }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(\Auth::user()->roles[0]->id == 1 && count($reserva->historias)>0)
                    <div class="mb-2">
                        <div class="accor " id="headingThree4">
                            <div class="m-0">
                                <a href="#collapseThree5" class="tx-20 fw-normal collapsed" data-bs-toggle="collapse"
                                    aria-expanded="false" aria-controls="collapseThree">
                                    <i class="tx-18 fe fe-list me-2"></i>
                                    Historial de Cambios
                                </a>
                            </div>
                        </div>
                        <div id="collapseThree5" class="collapse b-b0" aria-labelledby="headingThree"
                            data-bs-parent="#accordion">
                            <div class="border table-responsive p-3 accstyle border-top-0">
                                <div class="row">
                                    <table class="table table-bordered table-striped mg-b-0 text-md-nowrap">
                                        <thead>
                                            <tr class="text-center">
                                                <th>N°</th>
                                                <th>Fecha</th>
                                                <th>Usuario</th>
                                                <th>Cambios</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reserva->historias as $i => $historia)
                                                <tr>
                                                    <td class="thnro">{{ ++$i }}</td>
                                                    <td>{{ date("d-m-Y H:i",strtotime($historia->fecha)) }}</td>
                                                    <td>{{ $historia->user->nombre }} </td>
                                                    <td>{{ $historia->cambios }} </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /Container -->
    <div class="modal fade" id="agregarPago" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                @livewire('agregar-pago', ['reserva' => $reserva])
            </div>
        </div>
    </div>
@endsection
@push('plugin-scripts')
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
@endpush
@push('custom-scripts')
@endpush

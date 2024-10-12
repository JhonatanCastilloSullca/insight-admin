@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">Reporte de Reservas</span>
            </div>
        </div>
        <!-- /breadcrumb -->
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <form action="{{ route('reportes.reservas') }}" method="GET">
                                <div class="row pb-4">
                                    <div class="col-md-3">
                                        <label for="searchFechaInicio" class="form-label">Fecha Inicio</label>
                                        <input type="date" class="form-control" id="searchFechaInicio"
                                            name="searchFechaInicio" value="{{ $fechaInicio2 }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="searchFechaFin" class="form-label">Fecha Fin</label>
                                        <input type="date" class="form-control" id="searchFechaFin" name="searchFechaFin"
                                            value="{{ $fechaFin2 }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="searchCounter" class="form-label">Counter</label>
                                        <div class="form-group">
                                            <select name="searchCounter" class="form-control form-select" id="searchCounter"
                                                data-bs-placeholder="Select Counter">
                                                <option value="">TODOS</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ $counter == $user->id ? 'selected' : '' }}>
                                                        {{ $user->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>         
                                    <div class="col-md-3">

                                    </div>
                                    <div class="col-md-3">
                                        <label for="searchPasajero" class="form-label">Pasajero (texto)</label>
                                        <input type="text" name="searchPasajero" id="searchPasajero" class="form-control" value="{{$pasajero}}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="searchEstado" class="form-label">Estado</label>
                                        <select name="searchEstado" class="form-control form-select" id="searchEstado"
                                            data-bs-placeholder="Select Estado">
                                            <option value="">TODOS</option>
                                            <option value="1" @selected($estado==1)>Registrado</option>
                                            <option value="2" @selected($estado==2)>Cancelado</option>
                                            <option value="3" @selected($estado==3)>Reprogramado</option>
                                            <option value="4" @selected($estado==4)>Con Devolucion</option>
                                            <option value="5" @selected($estado==5)>Finalizado</option>
                                        </select>
                                    </div>                         
                                    <div class="col-md-2">
                                        <button id="tuBotonEnviar" class="btn btn-primary mt-4">
                                            <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fas fa-search"></i><b>
                                                &nbsp; Buscar</b>
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ route('reportes.reservasexcel', ['searchFechaInicio' => $fechaInicio2, 'searchFechaFin' => $fechaFin2, 'searchCounter' => $counter, 'searchPasajero' => $pasajero, 'searchEstado' => $estado]) }}" target="_blank" class="btn btn-success mt-4">
                                            <i data-bs-toggle="tooltip" data-bs-title="Excel" class="fas fa-file"></i><b>
                                                &nbsp; Excel</b>
                                        </a>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ route('reportes.reservaspdf', ['searchFechaInicio' => $fechaInicio2, 'searchFechaFin' => $fechaFin2, 'searchCounter' => $counter, 'searchPasajero' => $pasajero, 'searchEstado' => $estado]) }}" target="_blank" class="btn btn-danger mt-4">
                                            <i data-bs-toggle="tooltip" data-bs-title="PDF" class="fas fa-file-pdf"></i><b>
                                                &nbsp; PDF</b>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table id="servicios" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Reserva</th>
                                        <th>Pasajero</th>
                                        <th>Fecha Contrato</th>
                                        <th>Fecha Viaje</th>
                                        <th>Counter</th>
                                        <th>Acuenta S/</th>
                                        <th>Saldo S/</th>
                                        <th>Total S/</th>
                                        <th>Acuenta $</th>
                                        <th>Saldo $</th>
                                        <th>Total $</th>
                                        <td>Total Tours</td>
                                        <td>Total Detalles</td>
                                        <td>Alojamiento</td>
                                        <td>Machupicchu</td>
                                        <td>Pagos</td>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $acuentaSoles = 0 @endphp
                                    @php $saldoSoles = 0 @endphp
                                    @php $totalSoles = 0 @endphp
                                    @php $acuentaDolares = 0 @endphp
                                    @php $saldoDolares = 0 @endphp
                                    @php $totalDolares = 0 @endphp
                                    @php $totalTours = 0 @endphp
                                    @php $totalDetalles = 0 @endphp
                                    @foreach ($reservas as $reserva)
                                        @php $totalTours +=  count($reserva->detallestoursTitulo()) @endphp
                                        @php $totalDetalles += count($reserva->detalles) @endphp
                                        <tr>
                                            <td>
                                                <div class="mobil-break">
                                                    {{ ++$i }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mobil-break">
                                                    {{ $reserva->numero }}-{{date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje))}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mobil-break">
                                                    {{ $reserva->pasajeroprincipal()?->nombreCompleto }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mobil-break">
                                                    {{ date('d-m-Y H:i', strtotime($reserva->fecha)) }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mobil-break">
                                                    {{ date('d-m-Y', strtotime($reserva->primerafecha()->fecha_viaje)) }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mobil-break">
                                                    {{ $reserva->user->nombre }}
                                                </div>
                                            </td>
                                            @if(count($reserva->totales->where('moneda_id',1)) > 0)
                                                @foreach($reserva->totales->where('moneda_id',1) as $total)
                                                    @php $acuentaSoles += $total->acuenta @endphp
                                                    @php $saldoSoles += $total->saldo @endphp
                                                    @php $totalSoles += $total->total @endphp
                                                    <td>
                                                        {{ $total->acuenta }}
                                                    </td>
                                                    <td>
                                                        {{ $total->saldo }}
                                                    </td>
                                                    <td>
                                                        {{ $total->total }}
                                                    </td>
                                                @endforeach
                                            @else
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            @endif
                                            @if(count($reserva->totales->where('moneda_id',2)) > 0)
                                                @foreach($reserva->totales->where('moneda_id',2) as $total)
                                                    @php $acuentaDolares += $total->acuenta @endphp
                                                    @php $saldoDolares += $total->saldo @endphp
                                                    @php $totalDolares += $total->total @endphp
                                                    <td>
                                                        {{ $total->acuenta }}
                                                    </td>
                                                    <td>
                                                        {{ $total->saldo }}
                                                    </td>
                                                    <td>
                                                        {{ $total->total }}
                                                    </td>
                                                @endforeach
                                            @else
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            @endif
                                            <td>
                                                {{count($reserva->detallestoursTitulo())}}
                                            </td>
                                            <td>
                                                {{count($reserva->detalles)}}
                                            </td>
                                            <td>
                                                {{count($reserva->detalleshoteles) > 0 ? 'Si':'No'}}
                                            </td>
                                            <td>
                                                {{$reserva->tieneServicioMachuPicchu() ? 'Si':'No'}}
                                            </td>
                                            <td>
                                                @foreach($reserva->pagos as $pago)
                                                    {{date("d-m-Y",strtotime($pago->fecha))}} / {{$pago->moneda->abreviatura}} {{$pago->monto}} {{$pago->contabilidad == 1 ? 'Si':'No'}}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fe fe-settings"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('reserva.pdfvoucher', $reserva) }}"
                                                            target="_blank">Voucher Cliente</a></li>
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('reserva.pdfitinerario', $reserva) }}"
                                                            target="_blank">Itinerario</a></li>
                                                    @if (count($reserva->pasajeros) > 0)
                                                        @if($reserva->pasajeroprincipal() != [])
                                                            @if ($reserva->pasajeroprincipal()->email != null)
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('reserva.notificar', $reserva) }}">Notificar</a>
                                                                </li>
                                                            @endif
                                                        @endif
                                                    @endif
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('reserva.pdfvoucheroficina', $reserva) }}"
                                                            target="_blank">Vista Oficina</a></li>
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('reserva.voucheroficina', $reserva) }}"
                                                            >Vista reserva</a></li>
                                                    {{-- <li>
                                                        <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#EliminarReserva" data-id="{{$reserva->id}}">
                                                            Eliminar
                                                        </button>
                                                    </li> --}}
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="6" class="text-right">Totales</th>
                                        <th>{{$acuentaSoles}}</th>
                                        <th>{{$saldoSoles}}</th>
                                        <th>{{$totalSoles}}</th>
                                        <th>{{$acuentaDolares}}</th>
                                        <th>{{$saldoDolares}}</th>
                                        <th>{{$totalDolares}}</th>
                                        <td>{{$totalTours}}</td>
                                        <td>{{$totalDetalles}}</td>
                                        <td colspan="4"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="6"></th>
                                        <th>Acuenta S/</th>
                                        <th>Saldo S/</th>
                                        <th>Total S/</th>
                                        <th>Acuenta $</th>
                                        <th>Saldo $</th>
                                        <th>Total $</th>
                                        <td>Total Tour</td>
                                        <td>Total Detalles</td>
                                        <td colspan="3"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('plugin-scripts')
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
@endpush
@push('custom-scripts')
    <script>
        $('#searchCounter').select2();
        $('#searchEstado').select2();

    </script>
@endpush

@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">Utilidad</span>
            </div>
        </div>
        <!-- /breadcrumb -->
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <form action="{{ route('contabilidad.utilidad') }}" method="GET">
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
                                    <div class="col-md-2">
                                        <button id="tuBotonEnviar" class="btn btn-primary mt-4">
                                            <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fas fa-search"></i><b>
                                                &nbsp; Buscar</b>
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ route('reportes.filesexcel', ['searchFechaInicio' => $fechaInicio2, 'searchFechaFin' => $fechaFin2]) }}" target="_blank" class="btn btn-success mt-4">
                                            <i data-bs-toggle="tooltip" data-bs-title="Excel" class="fas fa-file"></i><b>
                                                &nbsp; Excel</b>
                                        </a>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ route('reportes.filespdf', ['searchFechaInicio' => $fechaInicio2, 'searchFechaFin' => $fechaFin2]) }}" target="_blank" class="btn btn-danger mt-4">
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
                        <div id="accordion01" class="w-100 overflow-hidden Accordion-Style02 ">
                            @foreach($reservas as $i => $reserva)
                                <div class="mb-2">
                                    <div class="accor " id="headingOne{{$i}}">
                                        <div class="m-0">
                                            <a href="#collapseOne{{$i}}" class="tx-20 fw-normal" data-bs-toggle="collapse" aria-expanded="true"
                                                aria-controls="collapseOne{{$i}}">
                                                <i class="tx-18 fe fe-users me-2"></i>
                                                Reserva: {{ $reserva->numero }}-{{ $reserva->primerafecha()?->fecha_viaje ? date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje)) : ''}} / {{ $reserva->pasajeroprincipal()?->nombreCompleto }} / Total: {{$reserva->totales[0]->moneda_id==2 ? 'USD':'PEN'}} {{$reserva->totales[0]->total}}
                                            </a>
                
                                        </div>
                                    </div>
                                    <div id="collapseOne{{$i}}" class="collapse" aria-labelledby="headingOne{{$i}}" data-bs-parent="#accordion01">
                                        <div class="border p-3 accstyle border-top-0">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped mg-b-0 text-md-nowrap">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th>Pax</th>
                                                            <th>Servicio</th>
                                                            <th>Fecha</th>
                                                            <th>Incluye</th>
                                                            <th>Proveedor</th>
                                                            <th colspan="2"></th>
                                                            <th>Precio Total</th>
                                                            <th>Costo Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($reserva->detalles as $detalle)
                                                            <tr>
                                                                <td>{{$detalle->pax}}</td>
                                                                <td>{{$detalle->servicio->titulo}}</td>
                                                                <td>{{$detalle->fecha_viaje ? date("d-m-Y",strtotime($detalle->fecha_viaje)):''}}</td>
                                                                <td>
                                                                    @foreach($detalle->incluyes as $incluye)
                                                                        {{$incluye->titulo}} <br>
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    @if($detalle->detallesoperar)
                                                                        @if($detalle->detallesoperar->operar->endose == 1)
                                                                            @foreach($detalle->detallesoperar->operar->operarServicios as $sers)
                                                                                {{$sers->proveedor->nombre}}
                                                                            @endforeach
                                                                        @endif
                                                                        @if($detalle->detallesoperar->operar->endose == 0)
                                                                            @foreach($detalle->detallesoperar->operar->operarServicios as $sers)
                                                                                @php $aux = 0 @endphp
                                                                                @foreach($detalle->incluyes as $incluye)
                                                                                    @if($incluye->id == $sers->servicio_id)
                                                                                        {{$sers->proveedor->nombre}} <br>
                                                                                        @php $aux = 1 @endphp
                                                                                    @endif
                                                                                @endforeach
                                                                                @if($aux == 1)
                                                                                    <br>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    @endif
                                                                    @if($detalle->servicio->categoria_id == 6)
                                                                        @if($detalle->operarServicio)
                                                                            {{$detalle->operarServicio->proveedor->nombre }}
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td colspan="2"></td>
                                                                <td>{{$detalle->moneda_id == 2 ? 'USD' : 'PEN'}} {{number_format($detalle->precio * $detalle->pax,2)}}</td>
                                                                <td>
                                                                    @if($detalle->detallesoperar)
                                                                        @if($detalle->detallesoperar->operar->endose == 1)
                                                                            @foreach($detalle->detallesoperar->operar->operarServicios as $sers)
                                                                                {{$sers->moneda_id == 2 ? 'USD':'PEN'}} {{number_format(($sers->precio / $sers->cantidad) * $detalle->pax,2)}}
                                                                            @endforeach
                                                                        @endif
                                                                        @if($detalle->detallesoperar->operar->endose == 0)
                                                                            @foreach($detalle->detallesoperar->operar->operarServicios as $sers)
                                                                                @php $aux = 0 @endphp
                                                                                @foreach($detalle->incluyes as $incluye)
                                                                                    @if($incluye->id == $sers->servicio_id)
                                                                                    {{$sers->moneda_id == 2 ? 'USD':'PEN'}} {{number_format(($sers->precio / $sers->cantidad) * $detalle->pax,2)}} <br>
                                                                                        @php $aux = 1 @endphp
                                                                                    @endif
                                                                                @endforeach
                                                                                @if($aux == 1)
                                                                                    <br>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    @endif
                                                                    @if($detalle->servicio->categoria_id == 6)
                                                                        @if($detalle->operarServicio)
                                                                            {{$detalle->operarServicio->moneda_id == 2 ? 'USD':'PEN'}} {{$detalle->operarServicio->precio }}
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
                            @endforeach
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

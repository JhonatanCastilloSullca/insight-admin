@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">Reporte de Files</span>
            </div>
        </div>
        <!-- /breadcrumb -->
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <form action="{{ route('reportes.files') }}" method="GET">
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
                        <div class="table-responsive">
                            <table id="servicios" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>File</th>
                                        <th>Fecha Venta</th>
                                        <th>Pasajero</th>
                                        <th>Pax</th>
                                        <th>Servicio</th>
                                        <th>Fecha Viaje</th>
                                        <th>Incluye</th>
                                        <th>Moneda</th>
                                        <th>Precio Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                        @foreach($file->detallestraslados as $detalle)
                                        <tr>
                                            <td>
                                                {{ $file->numero }}-{{ $file->primerafecha()?->fecha_viaje ? date("d-m-Y",strtotime($file->primerafecha()?->fecha_viaje)) : ''}}
                                            </td>
                                            <td>
                                                {{ $file->fecha ? date("d-m-Y",strtotime($file->fecha)) : null }}
                                            </td>
                                            <td>
                                                {{ $file->pasajeroprincipal()?->nombreCompleto }}
                                            </td>
                                            <td>
                                                {{ $detalle->pax }}
                                            </td>
                                            <td>
                                                {{ $detalle->servicio->titulo }}
                                            </td>
                                            <td>
                                                {{ $detalle->fecha_viaje ? date("d-m-Y",strtotime($detalle->fecha_viaje)) : null }}
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                                {{ $detalle->moneda_id == 1 ? 'PEN' : 'USD' }}
                                            </td>
                                            <td>
                                                {{ $detalle->precio * $detalle->pax }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    @foreach($file->detallestoursreporte as $detalle)
                                        @foreach($detalle->incluyes as $incluye)
                                            <tr>
                                                <td>
                                                    {{ $file->numero }}-{{ $file->primerafecha()?->fecha_viaje ? date("d-m-Y",strtotime($file->primerafecha()?->fecha_viaje)) : ''}}
                                                </td>
                                                <td>
                                                    {{ $file->fecha ? date("d-m-Y",strtotime($file->fecha)) : null }}
                                                </td>
                                                <td>
                                                    {{ $file->pasajeroprincipal()?->nombreCompleto }}
                                                </td>
                                                <td>
                                                    {{ $detalle->pax }}
                                                </td>
                                                <td>
                                                    {{ $detalle->servicio->titulo }}
                                                </td>
                                                <td>
                                                    {{ $detalle->fecha_viaje ? date("d-m-Y",strtotime($detalle->fecha_viaje)) : null }}
                                                </td>
                                                <td>
                                                    {{ $incluye->titulo }}
                                                </td>
                                                @if($loop->first)
                                                    <td>
                                                        {{ $detalle->moneda_id == 1 ? 'PEN' : 'USD' }}
                                                    </td>
                                                    <td>
                                                        {{ $detalle->precio * $detalle->pax }}
                                                    </td>
                                                @else
                                                    <td></td>
                                                    <td></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endforeach
                                        @foreach($file->detalleshoteles as $detalle)
                                            <tr>
                                                <td>
                                                    {{ $file->numero }}-{{ $file->primerafecha()?->fecha_viaje ? date("d-m-Y",strtotime($file->primerafecha()?->fecha_viaje)) : ''}}
                                                </td>
                                                <td>
                                                    {{ $file->fecha ? date("d-m-Y",strtotime($file->fecha)) : null }}
                                                </td>
                                                <td>
                                                    {{ $file->pasajeroprincipal()?->nombreCompleto }}
                                                </td>
                                                <td>
                                                    {{ $detalle->pax }}
                                                </td>
                                                <td>
                                                    {{ $detalle->servicio->titulo }}
                                                </td>
                                                <td>
                                                    {{ $detalle->fecha_viaje ? date("d-m-Y",strtotime($detalle->fecha_viaje)) : null }}
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                    {{ $detalle->moneda_id == 1 ? 'PEN' : 'USD' }}
                                                </td>
                                                <td>
                                                    {{ $detalle->precio * $detalle->pax * $detalle->equipaje + $detalle->adicional}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        @foreach($file->detallesvuelos as $detalle)
                                            <tr>
                                                <td>
                                                    {{ $file->numero }}-{{ $file->primerafecha()?->fecha_viaje ? date("d-m-Y",strtotime($file->primerafecha()?->fecha_viaje)) : ''}}
                                                </td>
                                                <td>
                                                    {{ $file->fecha ? date("d-m-Y",strtotime($file->fecha)) : null }}
                                                </td>
                                                <td>
                                                    {{ $file->pasajeroprincipal()?->nombreCompleto }}
                                                </td>
                                                <td>
                                                    {{ $detalle->pax }}
                                                </td>
                                                <td>
                                                    {{ $detalle->servicio->titulo }}
                                                </td>
                                                <td>
                                                    {{ $detalle->fecha_viaje ? date("d-m-Y",strtotime($detalle->fecha_viaje)) : null }}
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                    {{ $detalle->moneda_id == 1 ? 'PEN' : 'USD' }}
                                                </td>
                                                <td>
                                                    {{ $detalle->precio * $detalle->pax + $detalle->adicional }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
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

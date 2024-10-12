@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">Reporte de Servicios</span>
            </div>
        </div>
        <!-- /breadcrumb -->
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <form action="{{ route('reportes.tours') }}" method="GET">
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
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-3">
                                        <label for="searchTour" class="form-label">Servicio</label>
                                        <div class="form-group">
                                            <select name="searchTour" class="form-control form-select" id="searchCounter"
                                                data-bs-placeholder="Select Tour">
                                                <option value="">TODOS</option>
                                                @foreach ($servicios as $servicio)
                                                    <option value="{{ $servicio->id }}"
                                                        {{ $tour == $servicio->id ? 'selected' : '' }}>
                                                        {{ $servicio->titulo }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>                             
                                    <div class="col-md-2">
                                        <button id="tuBotonEnviar" class="btn btn-primary mt-4">
                                            <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fas fa-search"></i><b>
                                                &nbsp; Buscar</b>
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ route('reportes.toursexcel', ['searchFechaInicio' => $fechaInicio2, 'searchFechaFin' => $fechaFin2, 'searchTour' => $tour]) }}" target="_blank" class="btn btn-success mt-4">
                                            <i data-bs-toggle="tooltip" data-bs-title="Excel" class="fas fa-file"></i><b>
                                                &nbsp; Excel</b>
                                        </a>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ route('reportes.tourspdf', ['searchFechaInicio' => $fechaInicio2, 'searchFechaFin' => $fechaFin2, 'searchTour' => $tour]) }}" target="_blank" class="btn btn-danger mt-4">
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
                                        <th>Fecha Contrato</th>
                                        <th>Servicio</th>
                                        <th>Pax</th>
                                        <th>Fecha Viaje</th>
                                        <th>Precio Unit.</th>
                                        <th>Counter</th>
                                        <th>Estado Reserva</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservas as $reserva)
                                        <tr>

                                            <td>
                                                <div class="mobil-break">
                                                    {{ ++$i }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mobil-break">
                                                    {{ $reserva->reserva->numero }}-{{\Carbon\Carbon::parse($reserva->reserva->primerafecha()->fecha_viaje)->locale('es')->translatedFormat('F-Y')}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mobil-break">
                                                    {{ date('d-m-Y H:i', strtotime($reserva->reserva->fecha)) }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mobil-break">
                                                    {{ $reserva->servicio->titulo }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mobil-break">
                                                    {{ $reserva->pax }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mobil-break">
                                                    {{ date('d-m-Y', strtotime($reserva->fecha_viaje)) }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mobil-break">
                                                    {{ $reserva->moneda->abreviatura }} {{ $reserva->precio }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mobil-break">
                                                    {{ $reserva->reserva->user->nombre }}
                                                </div>
                                            </td>
                                            <td>
                                                @if($reserva->reserva->estado==1)
                                                    <span class="badge bg-primary me-1 my-2">Registrado</span>
                                                @elseif($reserva->reserva->estado==2)
                                                    <span class="badge bg-danger me-1 my-2">Cancelado</span>
                                                @elseif($reserva->reserva->estado==3)
                                                    <span class="badge bg-info me-1 my-2">Repogramado</span>
                                                @elseif($reserva->reserva->estado==4)
                                                    <span class="badge bg-warning me-1 my-2">Con Devolución</span>
                                                @else
                                                    <span class="badge bg-dark me-1 my-2">Finalizado</span>
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

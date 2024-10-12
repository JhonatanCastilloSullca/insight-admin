@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">Contabilidad</span>
            </div>
        </div>
        <!-- /breadcrumb -->
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="filtroVentas">
                            <form action="{{ route('contabilidad.lista') }}" method="GET">
                                <div class="row pb-4">
                                    <div class="col-md-3">
                                        <label for="searchReserva" class="form-label">Reserva Nº</label>
                                        <input type="number" class="form-control" id="searchReserva" name="searchReserva"
                                            value="{{ $reserva_id }}">
                                    </div>
                                    <div class="col-md-2">
                                        <button id="tuBotonEnviar" class="btn btn-primary mt-4">
                                            <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fas fa-search"></i><b>
                                                &nbsp; Buscar</b>
                                        </button>
                                    </div>
                                    @if($reservaDetallada)
                                        <div class="col-md-2">
                                            <a href="{{ route('excel.pasajeros', ['id' => $reservaDetallada->id]) }}" target="_blank" class="btn btn-success mt-4 ">
                                                <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fas fa-file-pdf"></i><b>
                                                    &nbsp; Excel</b>
                                            </a>
                                        </div>
                                    @endif
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
                        @if($reservaDetallada)
                        <div class="table-responsive">
                            <h2>Reserva {{$reservaDetallada->id}}</h2>
                            <h4>Detalles</h4>
                            <table id="movimientos" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Servicio</th>
                                        <th>Counter</th>
                                        <th>Total</th>
                                        <th>Total Gasto</th>
                                        <th>Gastos</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservaDetallada->detalles as $detalle)
                                    <tr class="fila-venta">
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $detalle->fecha_viaje }}</td>
                                            <td>{{ $detalle->servicio->titulo}}</td>
                                            <td>{{ $detalle->user?->nombre }}</td>
                                            <td>{{ $detalle->moneda?->abreviatura }} {{ $detalle->precio }}</td>
                                            <td>S/ {{($detalle->detallesoperar?->operar->operarServicios->sum('precio')/$detalle->pax)}}</td>
                                            <td>
                                                @foreach($detalle->detallesoperar?->operar->operarServicios ?? [] as $servicios)
                                                    {{$servicios->servicio->titulo}} : {{$servicios->proveedor->nombre}} <br>
                                                @endforeach
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4>Pagos</h4>
                            <table id="movimientos" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Medio</th>
                                        <th>Monto</th>
                                        <th>Monto %</th>
                                        <th>Operacion</th>
                                        <th>Counter</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservaDetallada->pagos as $pago)
                                    <tr class="fila-venta">
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $pago->fecha }}</td>
                                            <td>{{ $pago->medio->nombre}}</td>
                                            <td>{{ $pago->moneda?->abreviatura }} {{ $pago->monto }}</td>
                                            <td>{{ $pago->moneda?->abreviatura }} {{ $pago->monto_porcentaje }}</td>
                                            <td>{{ $pago->num_operacion}}</td>
                                            <td>{{ $pago->user->nombre}}</td>
                                            <td>
                                                
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
        </div>
    </div>

@endsection

@push('plugin-scripts')
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>


@endpush
@push('custom-scripts')
    <script>
        function showSpinnerAndDownload(movimientoId, url) {
            $('#spinner-' + movimientoId).removeClass('d-none');
            setTimeout(function() {
                window.location.href = url;
            }, 100);
        }
    </script>
@endpush

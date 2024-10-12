@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">Facturar Pagos</span>
            </div>
        </div>
        <!-- /breadcrumb -->
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="filtroVentas">
                            <form action="{{ route('facturacion.pagos') }}" method="GET">
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
                            <table id="movimientos" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Reserva Nº</th>
                                        <th>Cliente</th>
                                        <th>Medio</th>
                                        <th>Total S/</th>
                                        <th>Total $</th>
                                        <th>Reponsable</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pagos as $pago)
                                    <tr class="fila-venta" data-id="{{ $pago->id }}">
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $pago->fecha }}</td>
                                            <td>{{ $pago->reserva_id}}</td>
                                            <td>{{ $pago->reserva->pasajeros[0]->nombres}}</td>
                                            <td>{{ $pago->medio?->nombre }} </td>
                                            <td>{{ $pago->medio_id == 1 ? $pago->monto : '' }}</td>
                                            <td>{{ $pago->medio_id == 2 ? $pago->monto : '' }}</td>
                                            <td>{{ $pago->user?->nombre }} {{ $pago->user->apellido }}</td>
                                            <td>{{ $pago->estado ? 'Registrado' : 'Anulado' }}</td>
                                            <td>
                                                <a href="{{ route('facturacion.create', ['id' => $pago->id]) }}">
                                                    <button type="button"  data-bs-toggle="tooltip" data-bs-title="Generar Comprobante" class="btn btn-success btn-icon">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" style="text-align: right;">Totales</th>
                                        <th>{{number_format($pagos->where('medio_id',1)->sum('monto'),2)}}</th>
                                        <th>{{number_format($pagos->where('medio_id',2)->sum('monto'),2)}}</th>
                                        <th colspan="3"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Container -->
    {{-- <div class="modal fade" id="EliminarMovimiento" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Anular Orden de Trabajo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('venta.destroyorden', 'test') }}" method="POST" autocomplete="off">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <p>¿Estás seguro de cambiar el estado?</p>
                        <div class="modal-footer">
                            <input type="hidden" name="id_trabajo_2" class="id_trabajo_2">
                            <button type="button" data-bs-toggle="tooltip" data-bs-title="Cancelar"
                                class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" data-bs-toggle="tooltip" data-bs-title="Aceptar"
                                class="btn btn-primary">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

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

    <script>
        var EliminarMovimiento = document.getElementById('EliminarMovimiento');
        EliminarMovimiento.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var idModal = EliminarMovimiento.querySelector('.id_trabajo_2')
            idModal.value = id;
        })
    </script>

@endpush

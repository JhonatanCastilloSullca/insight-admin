@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
<!-- container -->
<div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Operaciones Traslados</span>
        </div>
        <div class="justify-content-center mt-2">
            <a href="{{ route('operacion.crearoperaciontraslado')}}">
                <button type="button" class="btn btn-primary mb-2 mb-md-0 " >
                <i  data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Crear Operacion Traslado</b>
                </button>
            </a>
        </div>
    </div>
    <!-- /breadcrumb -->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('operacion.trasladossemaforo') }}" method="GET">
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
                        </div>
                    </form>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="operaciones" class="table table-hover">
                            <thead>
                                <tr >
                                    <th>#</th>
                                    <th>Fail</th>
                                    <th>Fecha</th>
                                    <th>Pax</th>
                                    <th>Servicio</th>
                                    <th>Precio</th>
                                    <th>Usuario</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($operaciones as $i => $operacion)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $operacion->reserva->numero }}-{{ $operacion->reserva->primerafecha()?->fecha_viaje ? date("d-m-Y",strtotime($operacion->reserva->primerafecha()?->fecha_viaje)) : ''}}</td>
                                    <td>{{ date("d-m-Y",strtotime($operacion->fecha_viaje)) }}</td>
                                    <td>{{ $operacion->pax }}</td>
                                    <td>{{ $operacion->servicio->titulo }}</td>
                                    <td>{{ $operacion->moneda_id == 1 ? 'S/ '.$operacion->precio*$operacion->pax : '$ '.$operacion->precio*$operacion->pax }}</td>
                                    <td>{{ $operacion->reserva->user->nombre }}</td>
                                    <td>
                                        @if($operacion->operarServicio?->pagado == 1)
                                            <h5><span class="badge bg-success me-1 my-2">PAGADO</span></h5>
                                        @else
                                            @if($operacion->operado == 1)
                                                <h5><span class="badge bg-warning me-1 my-2">ATENDIDO</span></h5>
                                            @else
                                                <h5><span class="badge bg-danger me-1 my-2">SIN ATENCION</span></h5>
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
    </div>
</div>
@endsection
@push('plugin-scripts')
    <script src="{{ asset('plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
@endpush
@push('custom-scripts')
<script>
    $('#searchProveedor').select2();
$(function() {
    'use strict';
    $(function() {
        $('#operaciones').DataTable({
            searching: false,  // Desactivar la opción de búsqueda
            paging: false,     // Desactivar la paginación
            "language": {
                "lengthMenu": "Mostrar  _MENU_  registros por paginas",
                "zeroRecords": "Nada encontrado - disculpa",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles.",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate":{
                "next": "Siguiente",
                "previous": "Anterior",
                }
            },
            "columnDefs": [
                {
                targets: [7],
                orderable: false
                }
            ]
        });
    });
});
</script>
@endpush

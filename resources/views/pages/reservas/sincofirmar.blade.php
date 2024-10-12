@extends('layout.master')
@push('plugin-styles')
<style>
    .dataTables_wrapper .dataTables_scrollBody {
        max-height: 400px; /* o el alto que prefieras */
        overflow-y: auto;
    }
    .dropdown-menu {
        position: fixed;
        z-index: 1060;
    }
</style>
@endpush
@section('content')
<!-- container -->
<div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Reserva sin confirmar</span>
        </div>
        <div class="justify-content-center mt-2">
            <a href="{{ route('reserva.createcotizacion')}}">
                <button type="button" class="btn btn-primary mb-2 mb-md-0 " data-bs-toggle="modal" data-bs-target="#varyingModal">
                <i  data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Crear Cotizacion</b>
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
                    <div>
                        <form action="{{ route('reserva.sinconfirmar') }}" method="GET">
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
                                @if(!(\Auth::user()->roles[0]->id == 2))
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
                                @endif                                
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
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="servicios" class="table table-hover">
                            <thead>
                                <tr >
                                <th>#</th>
                                <th>Pasajero</th>
                                <th>Nombre</th>
                                <th>Fecha Cotizacion</th>
                                <th>Fecha Viaje</th>
                                <th>Counter</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservas as $reserva)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $reserva->pasajeroprincipal()?->nombreCompleto }}</td>
                                    <td>{{ $reserva->observacion }}</td>
                                    <td>{{ date('d-m-Y H:i', strtotime($reserva->fecha)) }}</td>
                                    <td>{{ $reserva->primerafecha()?->fecha_viaje ? date('d-m-Y H:i', strtotime($reserva->primerafecha()->fecha_viaje)) : '' }}</td>
                                    <td>{{$reserva->user->nombre}}</td>
                                    </td>
                                    <td>{{$reserva->estado ? 'Confirmado':'Por Confirmar'}}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fe fe-settings"></i>
                                        </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{route('reserva.editcotizacion',$reserva)}}">Editar</a></li>
                                                <li><a class="dropdown-item" href="{{route('reserva.pdfitinerariopaquete',$reserva)}}" target="_blank">PDF Itinerario</a></li>
                                                {{-- @if(count($reserva->pasajeros)>0)
                                                    @if($reserva->pasajeros[0]->email)
                                                        <li><a class="dropdown-item" href="{{route('reserva.notificar',$reserva)}}">Notificar</a></li>
                                                    @endif
                                                @endif --}}
                                                <li><a class="dropdown-item" href="{{ route('reserva.proforma', $reserva) }}" target="_blank">Voucher Proforma</a></li>
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#EliminarReserva" data-id="{{$reserva->id}}">
                                                    Eliminar
                                                </button>
                                            </ul>
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
<!-- /Container -->
<div class="modal fade" id="EliminarReserva" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar Estado de Reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('reserva.destroy', 'test') }}" method="POST" autocomplete="off">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <p>¿Estás seguro de cambiar el estado?</p>
                    <div class="modal-footer">
                        <input type="hidden" name="id_reserva_2" id="id_reserva_2">
                        <button type="button" data-bs-toggle="tooltip" data-bs-title="Cancelar"
                            class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" data-bs-toggle="tooltip" data-bs-title="Aceptar"
                            class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
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
$('#searchCounter').select2();

var eliminarServicio = document.getElementById('EliminarReserva');
    eliminarServicio.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget
    var id = button.getAttribute('data-id')
    var idModal = eliminarServicio.querySelector('#id_reserva_2');
    idModal.value = id;
})
$(function() {
    'use strict';
    $('#servicios').DataTable({
        searching: false,  // Desactivar la opción de búsqueda
        paging: false,     // Desactivar la paginación
        scrollY: '500px',  // Alto fijo con scroll interno
        scrollCollapse: true, // Permite colapsar el scroll si el contenido es menor
        "language": {
            "lengthMenu": "Mostrar  _MENU_  registros por páginas",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Mostrando la página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles.",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior",
            }
        },
        "columnDefs": [{
            targets: [7],
            orderable: false
        }]
    });
    
    // Establece un alto mínimo
    $('.dataTables_scrollBody').css('min-height', '500px');
});
</script>
@endpush

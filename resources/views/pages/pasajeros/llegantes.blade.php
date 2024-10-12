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
                <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Pasajeros que llegan</span>
            </div>
        </div>
        <!-- /breadcrumb -->
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pasajeros.llegantes') }}" method="GET">
                            <div class="row pb-4">
                                <div class="col-md-3">
                                    <label for="searchFechaFin" class="form-label">Fecha LLegada</label>
                                    <input type="date" class="form-control" id="searchFechaFin" name="searchFechaFin"
                                        value="{{ $fechaLlegada }}">
                                </div>                         
                                <div class="col-md-2">
                                    <button id="tuBotonEnviar" class="btn btn-primary mt-4">
                                        <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fas fa-search"></i><b>
                                            &nbsp; Buscar</b>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table id="servicios" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>Reserva</th>
                                        <th>Pasajero</th>
                                        <th>Fecha Contrato</th>
                                        <th>Fecha Viaje</th>
                                        <th>Counter</th>
                                        <th>Acuenta</th>
                                        <th>Saldo</th>
                                        <th>Total</th>
                                        <th>Acciones</th>
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
                                                <a class="btn btn-warning btn-icon" href="{{route('reserva.voucheroficina', $reserva)}}" target="_blank">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="mobil-break">
                                                    {{ $reserva->numero }}-{{ $reserva->primerafecha()?->fecha_viaje ? date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje)) : ''}}
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
                                                    {{ $reserva->primerafecha()?->fecha_viaje ? date("d-m-Y",strtotime($reserva->primerafecha()?->fecha_viaje)) : ''}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mobil-break">
                                                    {{ $reserva->user->nombre }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mobil-break">

                                                    @foreach ($reserva->totales as $total)
                                                        {{ $total->moneda->abreviatura }} {{ $total->acuenta }}
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mobil-break">

                                                    @foreach ($reserva->totales as $total)
                                                        {{ $total->moneda->abreviatura }} {{ $total->saldo }}
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mobil-break">

                                                    @foreach ($reserva->totales as $total)
                                                        {{ $total->moneda->abreviatura }} {{ $total->total }}
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <a class="btn btn-info btn-icon" href="{{route('pasajeros.bienvenida',['id'=>$reserva->id])}}" target="_blank">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
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
                    targets: [9],
                    orderable: false
                }]
            });
            
            // Establece un alto mínimo
            $('.dataTables_scrollBody').css('min-height', '500px');
        });


    </script>
@endpush

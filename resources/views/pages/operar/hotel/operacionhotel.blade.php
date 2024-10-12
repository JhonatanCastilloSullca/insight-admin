@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
<!-- container -->
<div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Operaciones Hotel</span>
        </div>
        <div class="justify-content-center mt-2">
            <a href="{{ route('operacion.createhotel')}}">
                <button type="button" class="btn btn-info mb-2 mb-md-0 " data-bs-toggle="modal" data-bs-target="#varyingModal">
                <i  data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Ver Detalles fecha de viaje</b>
                </button>
            </a>
            <a href="{{ route('operacion.createhotelreserva')}}">
                <button type="button" class="btn btn-warning mb-2 mb-md-0 " data-bs-toggle="modal" data-bs-target="#varyingModal">
                <i  data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Ver Detalles fecha Registro</b>
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
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif
                    <form action="{{ route('operacion.hotel') }}" method="GET">
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
                                <label for="searchCounter" class="form-label">Proveedor</label>
                                <div class="form-group">
                                    <select name="searchProveedor" class="form-control form-select" id="searchProveedor"
                                        data-bs-placeholder="Select Proveedor">
                                        <option value="">TODOS</option>
                                        @foreach ($proveedores as $proveedors)
                                            <option value="{{ $proveedors->id }}"
                                                {{ $proveedor == $proveedors->id ? 'selected' : '' }}>
                                                {{ $proveedors->nombre }}</option>
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
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="operaciones" class="table table-hover">
                            <thead>
                                <tr >
                                    <th>#</th>
                                    <th>Fecha Registro</th>
                                    <th>Reserva</th>
                                    <th>Hoteles</th>
                                    <th>Total Soles</th>
                                    <th>Total Dolares</th>
                                    <th>Fecha Limite</th>
                                    <th>Usuario</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($operaciones as $i => $operacion)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $operacion->fecha }}</td>
                                    <td>{{ $operacion->reserva?->numero }} -{{ $operacion->reserva->primerafecha()?->fecha_viaje ? date("d-m-Y",strtotime($operacion->reserva->primerafecha()?->fecha_viaje)) : ''}}</td>
                                    <td>
                                        @foreach($operacion->operarProveedorNombre() as $proveedor)
                                            {{$proveedor}},
                                        @endforeach
                                    </td>
                                    <td>{{ $operacion->precioSoles }}</td>
                                    <td>{{ $operacion->precioDolares }}</td>
                                    <td>
                                        @php
                                            $fechas = collect();
                                            foreach($operacion->operarServicios as $operaSer) {
                                                if ($operaSer->fechaPago) {
                                                    $fechas->push($operaSer->fechaPago);
                                                }
                                            }
                                            $fechaProxima = $fechas->min();
                                        @endphp

                                        {{$fechaProxima ? date("d-m-Y", strtotime($fechaProxima)) : ''}}
                                    </td>
                                    <td>{{ $operacion->user->nombre }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @if (count($operacion->operarEditarHotel) > 0)
                                                <a class="btn btn-dark btn-icon me-1" href="{{ route('operacion.editaroperacionhotel', ['reserva' => $operacion->reserva]) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endif

                                            <a class="btn btn-info btn-icon me-1" href="{{ route('operacion.verhotel', ['reserva' => $operacion->reserva]) }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @if (count($operacion->reserva->detalleshotelesSinConfimar) > 0)
                                                <a class="btn btn-danger btn-icon me-1" href="{{ route('operacion.crearoperacionhotel', ['reserva' => $operacion->reserva]) }}">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            @endif
                                            @if(count($operacion->operarHotelsPrecio) > 0)
                                                <a style="background:orange;" class="btn btn-icon me-1" href="{{ route('operacion.agregarpagohotel', ['reserva' => $operacion->reserva]) }}">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            @endif
                                            @if(count($operacion->saldoOperarHotel) > 0)
                                                <a style="background:yellow;text-color: black" class="btn btn-icon me-1" href="{{ route('operacion.realizarpagohotel', ['reserva' => $operacion->reserva]) }}">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            @endif
                                        </div>
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
@endpush
@push('custom-scripts')
<script>
$(function() {
    'use strict';
    $(function() {
        $('#operaciones').DataTable({
        "aLengthMenu": [
            [10, 30, 50, -1],
            [10, 30, 50, "All"]
        ],
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

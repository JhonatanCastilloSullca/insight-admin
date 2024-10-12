@extends('layout.master')
@push('plugin-styles')
<style>
    .tooltip-inner{
        max-width:100%;
        width:100%;
    }
</style>
@endpush
@section('content')
<!-- container -->
<div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Machupicchu</span>
        </div>
        <div class="justify-content-center mt-2">

            <a href="{{ route('operacion.createmachupicchu')}}">
                <button type="button" class="btn btn-primary mb-2 mb-md-0 " data-bs-toggle="modal" data-bs-target="#varyingModal">
                <i  data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Crear Operacion</b>
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
                    <form action="{{ route('operacion.machupicchu') }}" method="GET">
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
                    <div class="table-responsive">
                        <table id="operaciones" class="table table-hover">
                            <thead>
                                <tr >
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Servicio</th>
                                    <th>Guia</th>
                                    <th>Paxs</th>
                                    <th>Total Precio</th>
                                    <th>Ingresos</th>
                                    <th>Usuario</th>
                                    <th>Observacion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($operaciones as $operacion)
                                    <tr >
                                        <td>{{++$i}}</td>
                                        <td>{{date("d-m-Y",strtotime($operacion->fecha))}}</td>
                                        <td>{{$operacion->servicio->titulo}}</td>
                                        <td>
                                            @foreach($operacion->operarServicios as $operar)
                                                {{$operar?->proveedor?->nombre}}, 
                                            @endforeach
                                        </td>
                                        <td>{{$operacion->cantidad_pax}}</td>
                                        <td>{{$operacion->precioSoles > 0 ? 'S/ '.$operacion->precioSoles : '$ '.$operacion->precioDolares}}</td>
                                        <td>{{$operacion->ingresos}}</td>
                                        <td>{{$operacion->user->nombre}}</td>
                                        <td>{{$operacion->observacion}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('operacion.whatsappoperacionmachupicchu', ['operacion_id' => $operacion->id]) }}" target="_blank">
                                                    <button type="button" class="btn btn-success btn-icon me-2">
                                                        <i class="fab fa-whatsapp"></i>
                                                    </button>
                                                </a>

                                                <a href="{{ route('operacion.editarmachupicchu', ['operar' => $operacion->id]) }}">
                                                    <button type="button" class="btn btn-dark btn-icon me-2">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </a>

                                                <a href="{{ route('operacion.showmachupicchu',$operacion) }}" class="btn btn-info btn-icon me-2">
                                                    <i class="fa fa-eye"></i>
                                                </a>
    
                                                <a href="{{ route('operacion.machupicchupdf',$operacion) }}" target="_blank" class="btn btn-warning btn-icon me-2">
                                                    <i class="fa fa-file"></i>
                                                </a>
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
            targets: [9],
            orderable: false
            }
        ]
        });
    });
});
</script>
@endpush

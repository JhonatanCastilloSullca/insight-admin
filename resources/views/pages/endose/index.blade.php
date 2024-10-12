@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
<!-- container -->
<div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Endoses</span>
        </div>
        <div class="justify-content-center mt-2">

            <a href="{{ route('endose.create')}}">
                <button type="button" class="btn btn-primary mb-2 mb-md-0 " data-bs-toggle="modal" data-bs-target="#varyingModal">
                    <i  data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Crear Endose</b>
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
                    <div class="table-responsive">
                        <table id="operaciones" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Servicio</th>
                                    <th>Proveedor</th>
                                    <th>Paxs</th>
                                    <th>Total Precio</th>
                                    <th>Ingresos</th>
                                    <th>Usuario</th>
                                    <th>Observacion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($endoses as $i => $endose)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{date("d-m-Y",strtotime($endose->fecha))}}</td>
                                        <td>{{$endose->servicio->titulo}}</td>
                                        <td>{{$endose->operarServicios[0]?->proveedor?->nombre}}</td>
                                        <td>{{$endose->cantidad_pax}}</td>
                                        <td>{{$endose->precioSoles > 0 ? 'S/ '.$endose->precioSoles : '$ '.$endose->precioDolares}}</td>
                                        <td>{{$endose->ingresos}}</td>
                                        <td>{{$endose->user->nombre}}</td>
                                        <td>{{$endose->observacion}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('endose.whatsapp', ['endose' => $endose->id]) }}" target="_blank">
                                                    <button type="button" class="btn btn-success btn-icon me-2">
                                                        <i class="fab fa-whatsapp"></i>
                                                    </button>
                                                </a>

                                                <a href="{{ route('endose.editar',$endose) }}">
                                                    <button type="button" class="btn btn-dark btn-icon me-2">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </a>

                                                <a href="{{ route('endose.ver',$endose) }}" class="btn btn-info btn-icon me-2">
                                                    <i class="fa fa-eye"></i>
                                                </a>
    
                                                <a href="{{ route('endose.pdf',$endose) }}" target="_blank" class="btn btn-warning btn-icon me-2">
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

@push('plugin-styles')
<style>
    .tooltip-inner{
        max-width:100%;
        width:100%;
    }
</style>

@endpush
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

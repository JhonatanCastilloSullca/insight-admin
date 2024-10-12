@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Hoteles 2</span>
            </div>
            <div class="justify-content-center mt-2">
                @can('servicio.create')
                    <a href="{{ route('servicio.create', 2) }}">
                        <button type="button" class="btn btn-primary mb-2 mb-md-0 " data-bs-toggle="modal"
                            data-bs-target="#varyingModal">
                            <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Crear
                                Hotel</b>
                        </button>
                    </a>
                @endcan
            </div>
        </div>
        <!-- /breadcrumb -->
        <!-- row -->
        <div class="row">
            @foreach ($proveedoresHotel as $proveedor)
                <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="card custom-card"> <img src="{{ asset('' . $proveedor->imagen) }}"
                            class="image-custom-card card-img-top" alt="proveedor-image">
                        <div class="card-body">
                            <h6 class="card-title fw-semibold">{{ $proveedor->nombre }}</h6>

                            <div aria-multiselectable="true" class="accordion" id="accordion-{{ $proveedor->id }}"
                                role="tablist">
                                @foreach ($proveedor->servicios as $servicioProveedor)
                                    <div class="card mb-0">
                                        <div class="card-header" id="heading-{{ $servicioProveedor->id }}" role="tab">
                                            <a aria-controls="collapse-{{ $servicioProveedor->id }}" aria-expanded="true"
                                                data-bs-toggle="collapse" href="#collapse-{{ $servicioProveedor->id }}">
                                                {{ $servicioProveedor->titulo }}
                                            </a>
                                        </div>
                                        <div aria-labelledby="heading-{{ $servicioProveedor->id }}" class="collapse"
                                            data-bs-parent="#accordion-{{ $proveedor->id }}"
                                            id="collapse-{{ $servicioProveedor->id }}" role="tabpanel">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-center">

                                                    <a href="{{ route('servicio.edit', $servicioProveedor->id) }}"
                                                        class="btn btn-warning mx-2 button-icon tx-12"><i
                                                            class="fe fe-edit-3 me-2 tx-12"></i>Editar</a>


                                                    <a class="btn btn-primary mx-2 button-icon tx-12 text-white"
                                                        data-bs-toggle="modal" data-bs-target="#EliminarServicio"
                                                        data-id="{{ $servicioProveedor->id }}"><i
                                                            class="fe fe-trash-2 me-2 tx-12"></i>Eliminar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach


        </div>
    </div>
    <!-- /Container -->
    <div class="modal fade" id="EliminarServicio" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cambiar Estado de Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('servicio.destroy', 'test') }}" method="POST" autocomplete="off">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <p>¿Estás seguro de cambiar el estado?</p>
                        <div class="modal-footer">
                            <input type="hidden" name="id_servicio_2" id="id_servicio_2">
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
@endpush
@push('custom-scripts')
    <script>
        var eliminarServicio = document.getElementById('EliminarServicio');
        eliminarServicio.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var idModal = eliminarServicio.querySelector('#id_servicio_2');
            idModal.value = id;
        })
        $(function() {
            'use strict';
            $(function() {
                $('#servicios').DataTable({
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
            });
        });
    </script>
@endpush

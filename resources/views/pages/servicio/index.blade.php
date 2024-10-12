@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
<!-- container -->
<div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Servicios Tours</span>
        </div>
        <div class="justify-content-center mt-2">
            @can('servicio.create')
            <a href="{{ route('servicio.create',1)}}">
                <button type="button" class="btn btn-primary mb-2 mb-md-0 " data-bs-toggle="modal" data-bs-target="#varyingModal">
                    <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Crear Servicio</b>
                </button>
            </a>
            @endcan
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
                        <table id="servicios" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Titulo</th>
                                    <th>Precios</th>
                                    <th>Incluye</th>
                                    <th>No Incluye</th>
                                    <th>Categorias</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($servicios as $servicio)
                                <tr>
                                    <td>
                                        <div class="mobil-break">{{++$i}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mobil-break">{{$servicio->titulo}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mobil-break">
                                            @foreach($servicio->precios as $precio)
                                                - {{$precio->nombre}} {{$precio->pivot->moneda_id == 1 ? 'S/':'$'}} {{$precio->pivot->precio}} <br>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mobil-break">
                                            @foreach($servicio->itinerarios as $itinerario)
                                                @foreach($itinerario->incluyes as $incluye)
                                                    {{ $incluye->titulo }}, <br>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mobil-break">
                                            @foreach($servicio->itinerarios as $itinerario)
                                                @foreach($itinerario->noincluyes as $noincluye)
                                                    {{ $noincluye->titulo }}, <br>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mobil-break">{{ $servicio->categoria?->nombre }}
                                        </div>
                                    </td>
                                    <td>
                                        <img style="width:125px;" src="{{asset(''.$servicio->img_principal)}}" alt="Imagen Servicio">
                                    </td>
                                    <td>
                                        <div class="mobil-break">{{$servicio->estado ? 'Activo':'Inactivo'}}
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fe fe-settings"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            {{-- @can('servicio.show')
                                        <li><a class="dropdown-item" href="{{ route('servicio.show',$servicio->id) }}">Ver información</a></li>
                                            @endcan --}}
                                            @can('servicio.edit')
                                            <li><a class="dropdown-item" href="{{ route('servicio.edit',$servicio->id) }}">Editar</a></li>
                                            @endcan
                                            @can('servicio.destroy')
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#EliminarServicio" data-id="{{$servicio->id}}">Eliminar</a></li>
                                            @endcan
                                            <li><a class="dropdown-item" href="{{ route('servicio.duplicar',$servicio->id) }}">Duplicar</a></li>
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
<div class="modal fade" id="EliminarServicio" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar Estado de Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('servicio.destroy','test')}}" method="POST" autocomplete="off">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <p>¿Estás seguro de cambiar el estado?</p>
                    <div class="modal-footer">
                        <input type="hidden" name="id_servicio_2" id="id_servicio_2">
                        <button type="button" data-bs-toggle="tooltip" data-bs-title="Cancelar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" data-bs-toggle="tooltip" data-bs-title="Aceptar" class="btn btn-primary">Aceptar</button>
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
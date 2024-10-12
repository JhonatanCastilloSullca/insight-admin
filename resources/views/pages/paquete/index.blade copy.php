@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
<!-- container -->
<div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Paquetes</span>
        </div>
        <div class="justify-content-center mt-2">
            @can('paquete.create')
            <a href="{{ route('paquete.create')}}">
                <button type="button" class="btn btn-primary mb-2 mb-md-0 " data-bs-toggle="modal" data-bs-target="#varyingModal">
                    <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Crear Paquete</b>
                </button>
            </a>
            @endcan
        </div>
    </div>    
    <!-- <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    @endif
                    <div class="table-responsive mb-5">
                        <table id="paquetes" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Titulo</th>
                                    <th>Tours</th>
                                    <th>Precio</th>
                                    <th>Usuario</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paquetes as $paquete)
                                <tr>
                                    <td>
                                        <div class="mobil-break">
                                            {{++$i}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mobil-break">
                                            {{$paquete->titulo}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mobil-break">
                                            @foreach($paquete->detalles as $detalle)
                                            <span>{{ $detalle->servicio->titulo }}</span><br>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mobil-break">
                                            S/ {{$paquete->precio_soles}}
                                            <br>
                                            $ {{$paquete->precio_dolares}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mobil-break">
                                            {{$paquete->user->nombre}}
                                        </div>
                                    </td>
                                    <td><img style="width:125px;" src="{{asset('storage/'.$paquete->img_principal)}}" alt="Imagen Paquete"></td>
                                    <td>
                                        <div class="mobil-break">{{$paquete->estado ? 'Activo':'Inactivo'}}</div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fe fe-settings"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            {{-- @can('paquete.show')
                                            <li><a class="dropdown-item" href="{{ route('paquete.show',$paquete->id) }}">Ver Paquete</a></li>
                                            @endcan --}}
                                            @can('paquete.edit')
                                            <li><a class="dropdown-item" href="{{ route('paquete.edit',$paquete->id) }}">Editar</a></li>
                                            @endcan
                                            @can('paquete.destroy')
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#EliminarPaquete" data-id="{{$paquete->id}}">Eliminar</a></li>
                                            @endcan
                                            {{-- @can('paquete.duplicate')
                                            <li><a class="dropdown-item" href="{{ route('paquete.duplicate', $paquete->id) }}">Duplicar</a></li>
                                            @endcan --}}
                                            @can('paquete.pdf')
                                            <li><a class="dropdown-item" href="{{ route('paquete.pdfvista', $paquete->id) }}" target="_blank">PDF</a></li>
                                            @endcan
                                            {{-- <li><a class="dropdown-item" href="{{ route('paquete.viewcliente', $paquete->id) }}" target="_blank">Vista Cliente</a></li> --}}
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#agregarFecha" data-id="{{$paquete->id}}">Generar Venta</a></li>
                                            {{-- @if(count($paquete->pasajeros) > 0)
                                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#agregarFecha" data-id="{{$paquete->id}}">Generar Link</a></li>
                                            @endif --}}
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
    </div> -->
    <div class="row">
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="card custom-card"> <img src="https://spruko.com/demo/nowa/dist/assets/images/media/media-22.jpg" class="card-img-top"
                    alt="...">
                <div class="card-body">
                    <h6 class="card-title fw-semibold">Card title</h6>
                    <p class="card-text text-muted">when an unknown printer took a galley of type and scrambled
                        it to make a type specimen book. It has survived not only five centuries, but also the
                        leap into electronic typesetting, remaining essentially unchanged.</p><a
                        href="javascript:void(0);" class="btn btn-primary">Read More</a>
                </div>
                <div class="card-footer"> <span class="card-text">Last updated 3 mins ago</span> </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="card custom-card"> <img src="https://spruko.com/demo/nowa/dist/assets/images/media/media-22.jpg" class="card-img-top"
                    alt="...">
                <div class="card-body">
                    <h6 class="card-title fw-semibold">Card title</h6>
                    <p class="card-text text-muted">when an unknown printer took a galley of type and scrambled
                        it to make a type specimen book. It has survived not only five centuries, but also the
                        leap into electronic typesetting, remaining essentially unchanged.</p><a
                        href="javascript:void(0);" class="btn btn-primary">Read More</a>
                </div>
                <div class="card-footer"> <span class="card-text">Last updated 3 mins ago</span> </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="card custom-card"> <img src="https://spruko.com/demo/nowa/dist/assets/images/media/media-22.jpg" class="card-img-top"
                    alt="...">
                <div class="card-body">
                    <h6 class="card-title fw-semibold">Card title</h6>
                    <p class="card-text text-muted">when an unknown printer took a galley of type and scrambled
                        it to make a type specimen book. It has survived not only five centuries, but also the
                        leap into electronic typesetting, remaining essentially unchanged.</p><a
                        href="javascript:void(0);" class="btn btn-primary">Read More</a>
                </div>
                <div class="card-footer"> <span class="card-text">Last updated 3 mins ago</span> </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="card custom-card"> <img src="https://spruko.com/demo/nowa/dist/assets/images/media/media-22.jpg" class="card-img-top"
                    alt="...">
                <div class="card-body">
                    <h6 class="card-title fw-semibold">Card title</h6>
                    <p class="card-text text-muted">when an unknown printer took a galley of type and scrambled
                        it to make a type specimen book. It has survived not only five centuries, but also the
                        leap into electronic typesetting, remaining essentially unchanged.</p><a
                        href="javascript:void(0);" class="btn btn-primary">Read More</a>
                </div>
                <div class="card-footer"> <span class="card-text">Last updated 3 mins ago</span> </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="card custom-card"> <img src="https://spruko.com/demo/nowa/dist/assets/images/media/media-22.jpg" class="card-img-top"
                    alt="...">
                <div class="card-body">
                    <h6 class="card-title fw-semibold">Card title</h6>
                    <p class="card-text text-muted">when an unknown printer took a galley of type and scrambled
                        it to make a type specimen book. It has survived not only five centuries, but also the
                        leap into electronic typesetting, remaining essentially unchanged.</p><a
                        href="javascript:void(0);" class="btn btn-primary">Read More</a>
                </div>
                <div class="card-footer"> <span class="card-text">Last updated 3 mins ago</span> </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="card custom-card"> <img src="https://spruko.com/demo/nowa/dist/assets/images/media/media-22.jpg" class="card-img-top"
                    alt="...">
                <div class="card-body">
                    <h6 class="card-title fw-semibold">Card title</h6>
                    <p class="card-text text-muted">when an unknown printer took a galley of type and scrambled
                        it to make a type specimen book. It has survived not only five centuries, but also the
                        leap into electronic typesetting, remaining essentially unchanged.</p><a
                        href="javascript:void(0);" class="btn btn-primary">Read More</a>
                </div>
                <div class="card-footer"> <span class="card-text">Last updated 3 mins ago</span> </div>
            </div>
        </div>
    </div>
</div>
<!-- /Container -->
<div class="modal fade" id="EliminarPaquete" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar Estado de Paquete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('paquete.destroy','test')}}" method="POST" autocomplete="off">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <p>¿Estás seguro de cambiar el estado?</p>
                    <div class="modal-footer">
                        <input type="hidden" name="id_paquete_2" id="id_paquete_2">
                        <button type="button" data-bs-toggle="tooltip" data-bs-title="Cancelar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" data-bs-toggle="tooltip" data-bs-title="Aceptar" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- /Container -->
<div class="modal fade" id="agregarFecha" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Fecha Paquete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('paquete.vender')}}" method="POST" autocomplete="off">
                    {{csrf_field()}}
                    <div class="mb-3">
                        <label for="pax_nacional" class="form-label">Pax Nacional:</label>
                        <input type="number" min="0" class="form-control" id="pax_nacional" name="pax_nacional" value="{{old('pax_nacional',0)}}" required>
                        @error('pax_nacional')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pax_extranjero" class="form-label">Pax Extranjero:</label>
                        <input type="number" min="0" class="form-control" id="pax_extranjero" name="pax_extranjero" value="{{old('pax_extranjero',0)}}" required>
                        @error('pax_extranjero')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_paquete_crear" id="id_paquete_crear">
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
    var eliminarPaquete = document.getElementById('EliminarPaquete');
    eliminarPaquete.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-id')
        var idModal = eliminarPaquete.querySelector('#id_paquete_2');
        idModal.value = id;
    })

    var agregarFecha = document.getElementById('agregarFecha');
    agregarFecha.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-id')
        var idModal = agregarFecha.querySelector('#id_paquete_crear');
        idModal.value = id;
    })


    $(function() {
        'use strict';
        $(function() {
            $('#paquetes').DataTable({
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
@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
<!-- container -->
<div class="main-container container-fluid">

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Medio de pago</span>
        </div>
        <div class="justify-content-center mt-2">
            @can('medio.create')
            <button type="button" class="btn btn-primary mb-2 mb-md-0 " onclick="agregar()">
                <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Crear Medio de pago</b>
            </button>
            @endcan
        </div>
    </div>
    <!-- /breadcrumb -->
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
    </div>
    @endif
    <!-- row -->
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="categorias" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        {{-- <th>Banco</th> --}}
                                        <th>Nº Cuenta</th>
                                        <th>CCI</th>
                                        <th>Comision %</th>
                                        <th>Moneda</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($medios as $medio)

                                    <tr>
                                        <td>
                                            <div class="mobil-break">{{++$i}}</div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">{{$medio->nombre}}</div>
                                        </td>
                                        {{-- <td>
                                            <div class="mobil-break">{{$medio->banco}}</div>
                                        </td> --}}
                                        <td>
                                            <div class="mobil-break">{{$medio->numero}}</div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">{{$medio->cci}}</div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">{{$medio->porcentaje}}</div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">{{$medio->moneda->nombre}}</div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">{{$medio->estado ? 'Activo':'Inactivo'}}</div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fe fe-settings"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @can('medio.edit')
                                                <li><a class="dropdown-item" onclick="editar('{{$medio->id}}','{{$medio->nombre}}','{{$medio->banco}}','{{$medio->numero}}','{{$medio->cci}}','{{$medio->moneda_id}}','{{$medio->descripcion}}','{{$medio->porcentaje}}')">Editar</a></li>
                                                @endcan
                                                @can('medio.destroy')
                                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#EliminarUsuario" data-id="{{$medio->id}}">Eliminar</a></li>
                                                @endcan
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
</div>
<!-- /Container -->
<div class="modal fade" id="EliminarUsuario" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar Estado de Medio de pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('medio.destroy','test')}}" method="POST" autocomplete="off">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <p>¿Estás seguro de cambiar el estado?</p>
                    <div class="modal-footer">
                        <input type="hidden" name="id_medio_2" class="id_medio_2">
                        <button type="button" data-bs-toggle="tooltip" data-bs-title="Cancelar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" data-bs-toggle="tooltip" data-bs-title="Aceptar" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="crear-formulario"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="text-formulario"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="card-body">
                <h4 id="text-formulario"></h2>
                <form action="{{route('medio.store')}}" method="POST" class="forms-sample" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="mb-3 col-md-12">
                        <input type="hidden" name="id" id="id" value="{{old('id')}}">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre')}}">
                        @error('nombre')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="mb-3 col-md-12">
                        <label for="banco" class="form-label">Banco:</label>
                        <input type="text" name="banco" id="banco" class="form-control" value="{{old('banco')}}">
                        @error('banco')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <div class="mb-3 col-md-12">
                        <label for="numero" class="form-label">Nº Cuenta:</label>
                        <input type="text" name="numero" id="numero" class="form-control" value="{{old('numero')}}">
                        @error('numero')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="cci" class="form-label">CCI:</label>
                        <input type="text" name="cci" id="cci" class="form-control" value="{{old('cci')}}">
                        @error('cci')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="porcentaje" class="form-label">Comision %:</label>
                        <input type="text" name="porcentaje" id="porcentaje" class="form-control" value="{{old('porcentaje')}}">
                        @error('porcentaje')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="moneda_id">Moneda</label>
                        <select class="form-select" id="moneda_id" name="moneda_id" data-width="100%">
                            <option value="">SELECCCIONE</option>
                            @foreach($monedas as $moneda)
                            <option value="{{$moneda->id}}">{{$moneda->nombre}}</option>
                            @endforeach
                        </select>
                        @error('moneda_id')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="descripcion" class="form-label">Descripcion:</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{old('descripcion')}}">
                        @error('descripcion')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary me-2" id="boton-formulario"></button>
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
@if(count($errors)>0)
<script>
    $(document).ready(function() {
        $('#crear-formulario').modal('show');
        if ('{{old("id")}}') {
            $(function() {
                $('#text-formulario').text('Editar Medio de pago');
                $('#boton-formulario').text('Editar');
            });
        } else {
            $(function() {
                $('#text-formulario').text('Crear Medio de pago');
                $('#boton-formulario').text('Guardar');
            });
        }
    });
</script>
@endif

<script>
    function agregar() {
        $('#crear-formulario').modal('show');
        $('#text-formulario').text('Crear Medio de pago');
        $('#id').val(null);
        $('#nombre').val(null);
        // $('#banco').val(null);
        $('#numero').val(null);
        $('#cci').val(null);
        $('#porcentaje').val(null);
        $('#moneda_id').val(null).select2(
            {
                dropdownParent: $("#crear-formulario"),
                width: '100%'
            }
        );
        $('#descripcion').val(null);
        $('#boton-formulario').text('Guardar');
    }


    function editar(id, nombre, banco, numero, cci, moneda_id, descripcion, porcentaje) {
        $('#crear-formulario').modal('show');
        $('#text-formulario').text('Editar Medio de pago');
        $('#id').val(id);
        $('#nombre').val(nombre);
        // $('#banco').val(banco);
        $('#numero').val(numero);
        $('#cci').val(cci);
        $('#porcentaje').val(porcentaje);
        $('#moneda_id').val(moneda_id).select2(
            {
                dropdownParent: $("#crear-formulario"),
                width: '100%'
            }
        );
        $('#descripcion').val(descripcion);
        $('#boton-formulario').text('Editar');
    }

    $(document).on('select2:open', function() {
        $('.select2-results__options').css('max-height', '400px');
    });

    $(document).on('mouseenter', '.select2-results__option', function(e) {
        e.stopPropagation();
    });

    var eliminarUsuario = document.getElementById('EliminarUsuario');

    eliminarUsuario.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-id')
        var idModal = eliminarUsuario.querySelector('.id_medio_2')
        idModal.value = id;
    })

    $(function() {
        'use strict';
        $(function() {
            $('#categorias').DataTable({
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
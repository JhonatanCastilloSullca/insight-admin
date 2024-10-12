@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <!-- container -->
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Proveedores</span>
            </div>
            <div class="justify-content-center mt-2">
                @can('proveedor.create')
                    <button type="button" class="btn btn-primary mb-2 mb-md-0 " onclick="agregar()">
                        <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Crear
                            Proveedor</b>
                    </button>
                @endcan
            </div>
        </div>
        <!-- /breadcrumb -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span
                        aria-hidden="true">&times;</span></button>
            </div>
        @endif
        <!-- row -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="proveedores" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Celular</th>
                                            <th>Email</th>
                                            <th>Direccion</th>
                                            <th>Ciudad</th>
                                            <th>Cumpleaños</th>
                                            <th>Ruc</th>
                                            <th>Razon social</th>
                                            <th>Categoria</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($proveedores as $proveedor)
                                            <tr>
                                                <td>
                                                    <div class="mobil-break">
                                                        {{ ++$i }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">
                                                        {{ $proveedor->nombre }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">
                                                        {{ $proveedor->celular }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">
                                                        {{ $proveedor->email }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">
                                                        {{ $proveedor->direccion }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">
                                                        {{ $proveedor->ubicacion?->nombre }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">
                                                        {{ $proveedor->cumpleanos ? date("d-M",strtotime($proveedor->cumpleanos)) : null }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">
                                                        {{ $proveedor->ruc }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">
                                                        {{ $proveedor->razon_social }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">
                                                        {{ $proveedor->categoria->nombre }}
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($proveedor->estado == 1)
                                                        Activo
                                                    @else
                                                        Inactivo
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fe fe-settings"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @can('proveedor.edit')
                                                            <li><a class="dropdown-item"
                                                                    onclick="editar('{{ $proveedor->id }}','{{ $proveedor->nombre }}','{{ $proveedor->celular }}','{{ $proveedor->email }}','{{ $proveedor->direccion }}','{{ $proveedor->ruc }}','{{ $proveedor->razon_social }}','{{ $proveedor->categoria_id }}','{{$proveedor->ubicacion_id}}','{{$proveedor->cumpleanos}}')">Editar</a>
                                                            </li>
                                                        @endcan
                                                        @can('proveedor.destroy')
                                                            <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#EliminarUsuario"
                                                                    data-id="{{ $proveedor->id }}">Eliminar</a></li>
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

    <div class="modal fade" id="crear-formulario" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="text-formulario"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="card-body">
                    <h4 id="text-formulario">
                        </h2>
                        <form action="{{ route('proveedor.store') }}" method="POST" class="forms-sample"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="mb-3 col-md-12">
                                <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control"
                                    value="{{ old('nombre') }}">
                                @error('nombre')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                                <label for="celular" class="form-label">Celular:</label>
                                <input type="text" name="celular" id="celular" class="form-control"
                                    value="{{ old('celular') }}">
                                @error('celular')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                                <label for="email" class="form-label">Email:</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                                <label for="direccion" class="form-label">Direccion:</label>
                                <input type="text" name="direccion" id="direccion" class="form-control"
                                    value="{{ old('direccion') }}">
                                @error('direccion')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror

                                <label for="cumpleanos" class="form-label">Cumpleaños:</label>
                                <input type="date" name="cumpleanos" id="cumpleanos" class="form-control"
                                    value="{{ old('cumpleanos') }}">
                                @error('cumpleanos')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror

                                <label class="form-label" for="ubicacion_id">Ciudad</label>
                                <select class="form-select" id="ubicacion_id" name="ubicacion_id" data-width="100%" required>
                                    <option value="">SELECCCIONE</option>
                                    @foreach ($ubicaciones as $ubicacion)
                                        <option value="{{ $ubicacion->id }}" @selected(old('ubicacion_id')==$ubicacion->id)>{{ $ubicacion->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('ubicacion_id')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror

                                <label for="ruc" class="form-label">RUC:</label>
                                <input type="text" name="ruc" id="ruc" class="form-control"
                                    value="{{ old('ruc') }}">
                                @error('ruc')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror

                                <label for="razon_social" class="form-label">Razon Social:</label>
                                <input type="text" name="razon_social" id="razon_social" class="form-control"
                                    value="{{ old('razon_social') }}">
                                @error('razon_social')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror

                                <label class="form-label" for="categoria_id">Categoria</label>
                                <select class="form-select" id="categoria_id" name="categoria_id" data-width="100%">
                                    <option value="">SELECCCIONE</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" @selected(old('categoria_id')==$categoria->id)>{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('categoria_id')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary me-2" id="boton-formulario"></button>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <!-- /Container -->
    <div class="modal fade" id="EliminarUsuario" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cambiar Estado de Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('proveedor.destroy', 'test') }}" method="POST" autocomplete="off">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <p>¿Estás seguro de cambiar el estado?</p>
                        <div class="modal-footer">
                            <input type="hidden" name="id_proveedor_2" class="id_proveedor_2">
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
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
@endpush

@push('custom-scripts')
    @if (count($errors) > 0)
        <script>
            $('#crear-formulario').modal('show');
            if ('{{ old('id') }}') {
                $(function() {
                    $('#text-formulario').text('Editar Proveedor');
                    $('#boton-formulario').text('Editar');
                });
            } else {
                $(function() {
                    $('#text-formulario').text('Crear Proveedor');
                    $('#boton-formulario').text('Guardar');
                });
            }
        </script>
    @endif

    <script>
        function agregar() {
            $('#crear-formulario').modal('show');
            $('#text-formulario').text('Crear Proveedor');
            $('#id').val(null);
            $('#nombre').val(null);
            $('#celular').val(null);
            $('#email').val(null);
            $('#direccion').val(null);
            $('#ruc').val(null);
            $('#cumpleanos').val(null);
            $('#razon_social').val(null);
            $('#ubicacion_id').val(null).select2({
                dropdownParent: $("#crear-formulario"),
                width: '100%'
            });
            $('#categoria_id').val(null).select2({
                dropdownParent: $("#crear-formulario"),
                width: '100%'
            });
            $('#boton-formulario').text('Guardar');
        }

        function editar(id, nombre, celular, email, direccion, ruc, razon_social, categoria_id,ubicacion_id,cumpleanos) {
            $('#crear-formulario').modal('show');
            $('#text-formulario').text('Editar Proveedor');
            $('#id').val(id);
            $('#nombre').val(nombre);
            $('#celular').val(celular);
            $('#email').val(email);
            $('#direccion').val(direccion);
            $('#cumpleanos').val(cumpleanos);
            $('#ruc').val(ruc);
            $('#razon_social').val(razon_social);
            $('#categoria_id').val(categoria_id).select2({
                dropdownParent: $("#crear-formulario"),
                width: '100%'
            });
            $('#ubicacion_id').val(ubicacion_id).select2({
                dropdownParent: $("#crear-formulario"),
                width: '100%'
            });
            $('#boton-formulario').text('Editar');
        }

        var eliminarUsuario = document.getElementById('EliminarUsuario');

        eliminarUsuario.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var idModal = eliminarUsuario.querySelector('.id_proveedor_2')
            idModal.value = id;
        })

        $(function() {
            'use strict';
            $(function() {
                $('#proveedores').DataTable({
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
                        targets: [8],
                        orderable: false
                    }]
                });
            });
        });
    </script>
@endpush

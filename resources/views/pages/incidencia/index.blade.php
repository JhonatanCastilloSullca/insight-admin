@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <!-- container -->
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Hoteles</span>
            </div>
            <div class="justify-content-center mt-2">
                @can('hotel.create')
                    <button type="button" class="btn btn-primary mb-2 mb-md-0 " onclick="agregar()">
                        <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Crear Hotel</b>
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
                                <table id="categorias" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Ciudad</th>
                                            <th>Categoria</th>
                                            <th>Direccion</th>
                                            <th>Contacto</th>
                                            <th>Email</th>
                                            <th>Check inn</th>
                                            <th>Check out</th>
                                            <th>Notificar</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hoteles as $hotel)
                                            <tr>
                                                <td>
                                                    <div class="mobil-break">{{ ++$i }}</div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">{{ $hotel->nombre }}</div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">{{ $hotel?->ubicacion?->nombre }}</div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">{{ $hotel->categoria->nombre }}</div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">{{ $hotel->direccion }}</div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">{{ $hotel->celular }}</div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">{{ $hotel->email }}</div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">{{ $hotel->checkinn }}</div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">{{ $hotel->checkout }}</div>
                                                </td>
                                                <td>
                                                    <div class="mobil-break">{{ $hotel->correo == 1 ? 'Correo':'Whatsapp' }}</div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fe fe-settings"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @can('hotel.edit')
                                                            <li><a class="dropdown-item"
                                                                    onclick="editar('{{ $hotel->id }}','{{ $hotel->nombre }}','{{ $hotel->ubicacion_id }}','{{ $hotel->categoria_id }}','{{ $hotel->direccion }}','{{ $hotel->celular }}','{{ $hotel->email }}','{{ $hotel->checkinn }}','{{ $hotel->checkout }}','{{ $hotel->correo }}')">Editar</a>
                                                            </li>
                                                        @endcan
                                                        @can('hotel.destroy')
                                                            <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#EliminarUsuario"
                                                                    data-id="{{ $hotel->id }}">Eliminar</a></li>
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
                        <form action="{{ route('hotel.store') }}" method="POST" class="forms-sample"
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
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="categoria_id">Categoria</label>
                                <select class="form-select" id="categoria_id" name="categoria_id" data-width="100%">
                                    <option value="">SELECCCIONE</option>
                                    @foreach ($categorias as $category)
                                        <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('categoria_id')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="ubicacion_id">Ciudad</label>
                                <select class="form-select" id="ubicacion_id" name="ubicacion_id" data-width="100%">
                                    <option value="">SELECCCIONE</option>
                                    @foreach ($ciudades as $ciudad)
                                        <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('ubicacion_id')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="direccion" class="form-label">Direccion:</label>
                                <input type="text" name="direccion" id="direccion" class="form-control"
                                    value="{{ old('direccion') }}">
                                @error('direccion')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="celular" class="form-label">Celular:</label>
                                <input type="text" name="celular" id="celular" class="form-control"
                                    value="{{ old('celular') }}">
                                @error('celular')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">


                                <label for="imagen" class="form-label">Imagen:</label>
                                <input type="file" name="imagen" id="imagen" class="form-control">
                                @error('imagen')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="checkinn" class="form-label">Check inn:</label>
                                <input type="time" name="checkinn" id="checkinn" class="form-control"
                                    value="{{ old('checkinn') }}">
                                @error('checkinn')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="checkout" class="form-label">Check out:</label>
                                <input type="time" name="checkout" id="checkout" class="form-control"
                                    value="{{ old('checkout') }}">
                                @error('checkout')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="correo">Notificar</label>
                                <select class="form-select" id="correo" name="correo" data-width="100%">
                                    <option value="1">CORREO</option>
                                    <option value="2">WHATSAPP</option>
                                </select>
                                @error('correo')
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
                    <h5 class="modal-title">Cambiar Estado de Categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('hotel.destroy', 'test') }}" method="POST" autocomplete="off">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <p>¿Estás seguro de cambiar el estado?</p>
                        <div class="modal-footer">
                            <input type="hidden" name="id_hotel_2" class="id_hotel_2">
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
                    $('#text-formulario').text('Editar Hotel');
                    $('#boton-formulario').text('Editar');
                });
            } else {
                $(function() {
                    $('#text-formulario').text('Crear Hotel');
                    $('#boton-formulario').text('Guardar');
                });
            }
        </script>
    @endif

    <script>
        function agregar() {
            $('#crear-formulario').modal('show');
            $('#text-formulario').text('Crear Hotel');
            $('#id').val(null);
            $('#nombre').val(null);
            $('#ubicacion_id').val(null).select2({
                dropdownParent: $("#crear-formulario"),
                width: '100%'
            });
            $('#categoria_id').val(null).select2({
                dropdownParent: $("#crear-formulario"),
                width: '100%'
            });
            $('#direccion').val(null);
            $('#celular').val(null);
            $('#email').val(null);
            $('#checkinn').val(null);
            $('#checkout').val(null);
            $('#correo').val(null);
            $('#boton-formulario').text('Guardar');
        }


        function editar(id, nombre, ubicacion_id, categoria_id, direccion, celular, email, checkinn, checkout,correo) {
            $('#crear-formulario').modal('show');
            $('#text-formulario').text('Editar Hotel');
            $('#id').val(id);
            $('#nombre').val(nombre);
            $('#ubicacion_id').val(ubicacion_id).select2({
                dropdownParent: $("#crear-formulario"),
                width: '100%'
            });
            $('#categoria_id').val(categoria_id).select2({
                dropdownParent: $("#crear-formulario"),
                width: '100%'
            });
            $('#direccion').val(direccion);
            $('#celular').val(celular);
            $('#email').val(email);
            $('#checkinn').val(checkinn);
            $('#checkout').val(checkout);
            $('#correo').val(correo);
            $('#boton-formulario').text('Editar');
        }

        var eliminarUsuario = document.getElementById('EliminarUsuario');

        eliminarUsuario.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var idModal = eliminarUsuario.querySelector('.id_hotel_2')
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

@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
<!-- container -->
<div class="main-container container-fluid">

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Cupones</span>
        </div>
        <div class="justify-content-center mt-2">
            @can('cupon.create')
            <button type="button" class="btn btn-primary mb-2 mb-md-0 " onclick="agregar()">
                <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Crear Cupon</b>
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
            <div class="col-lg-{{(Gate::check('cupon.create') || Gate::check('cupon.edit')) ? '8':'12'}} col-md-{{(Gate::check('cupon.create') || Gate::check('cupon.edit')) ? '8':'12'}}">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="categorias" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cupon</th>
                                        <th>Descuento</th>
                                        <th>Cantidad</th>
                                        <th>Maximo</th>
                                        <th>Periodo Fechas</th>
                                        <th>Descuento S/</th>
                                        <th>Descuento $</th>
                                        <th>Tipo</th>
                                        <th>Fin </th>
                                        <th>Creado</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cupones as $cupon)
                                    <tr>
                                        <td>
                                            <div class="mobil-break">
                                                {{++$i}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">
                                                {{$cupon->cupon}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">
                                                {{$cupon->descuento}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">
                                                {{$cupon->cantidad}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">
                                                {{$cupon->maximo}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">
                                                {{$cupon->fechaInicio}} / {{$cupon->fechaFin}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">
                                                {{number_format($cupon->montoSoles,2)}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">
                                                {{number_format($cupon->montoDolares,2)}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">
                                                {{$cupon->tipo ? 'Monto':'Porcentaje'}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">
                                                {{$cupon->finalizado ? 'Fecha':'Cantidad'}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">
                                                {{$cupon->user->nombre}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">
                                                {{$cupon->estado ? 'Activo':'Finalizado'}}
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fe fe-settings"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @can('cupon.edit')
                                                <li><a class="dropdown-item" onclick="editar('{{$cupon->id}}','{{$cupon->descuento}}','{{$cupon->cupon}}','{{$cupon->maximo}}','{{$cupon->fechaInicio}}','{{$cupon->fechaFin}}','{{$cupon->tipo}}','{{$cupon->finalizado}}')">Editar</a></li>
                                                @endcan
                                                @can('cupon.destroy')
                                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#EliminarUsuario" data-id="{{$cupon->id}}">Eliminar</a></li>
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
            @if( Gate::check('cupon.create') || Gate::check('cupon.edit'))
            <div class="col-lg-4 col-md-4" id="crear-formulario">
                <div class="card">
                    <div class="card-body">
                        <h4 id="text-formulario">
                            </h2>
                            <form action="{{route('cupon.store')}}" method="POST" class="forms-sample" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="mb-3 col-md-12">
                                    <input type="hidden" name="id" id="id" value="{{old('id')}}">
                                    <label for="cupon" class="form-label">Cupon:</label>
                                    <input type="text" name="cupon" id="cupon" class="form-control" value="{{old('cupon')}}">
                                    @error('cupon')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="descuento" class="form-label">Descuento:</label>
                                    <input type="number" name="descuento" id="descuento" class="form-control" value="{{old('descuento')}}">
                                    @error('descuento')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="maximo" class="form-label">Maximo:</label>
                                    <input type="number" name="maximo" id="maximo" class="form-control" value="{{old('maximo')}}">
                                    @error('maximo')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="fechaInicio" class="form-label">Fecha Inicio:</label>
                                    <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" value="{{old('fechaInicio')}}">
                                    @error('fechaInicio')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="fechaFin" class="form-label">Fecha Fin:</label>
                                    <input type="date" name="fechaFin" id="fechaFin" class="form-control" value="{{old('fechaFin')}}">
                                    @error('fechaFin')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="tipo" class="form-label">Tipo Descuento:</label>
                                        <select class="form-select" id="tipo" name="tipo" data-width="100%">
                                            <option value="1">Monto</option>
                                            <option value="0">Porcentaje</option>
                                        </select>
                                        @error('tipo')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="finalizado" class="form-label">Como Finalizar</label>
                                        <select class="form-select" id="finalizado" name="finalizado" data-width="100%">
                                            <option value="1">Periodo de Fechas</option>
                                            <option value="0">Cantidad de Usos</option>
                                        </select>
                                        @error('finalizado')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary me-2" id="boton-formulario"></button>
                    </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- /Container -->
<div class="modal fade" id="EliminarUsuario" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar Estado de Cupon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('medio.destroy','test')}}" method="POST" autocomplete="off">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <p>¿Estás seguro de cambiar el estado?</p>
                    <div class="modal-footer">
                        <input type="hidden" name="id_medio_2" class="id_cupon_2">
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
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
@endpush

@push('custom-scripts')
@if(count($errors)>0)
<script>
    $(document).ready(function() {
        $('#crear-formulario').show();
        if ('{{old("id")}}') {
            $(function() {
                $('#text-formulario').text('Editar Cupon');
                $('#boton-formulario').text('Editar');
            });
        } else {
            $(function() {
                $('#text-formulario').text('Crear Cupon');
                $('#boton-formulario').text('Guardar');
            });
        }
    });
</script>
@else
<script>
    $('#crear-formulario').hide();
</script>
@endif

<script>
    function agregar() {
        $('#crear-formulario').show();
        $('#text-formulario').text('Crear Cupon');
        $('#id').val(null);
        $('#cupon').val(null);
        $('#descuento').val(null);
        $('#maximo').val(null);
        $('#fechaInicio').val(null);
        $('#fechaFin').val(null);
        $('#tipo').val(1);
        $('#finalizado').val(1);
        $('#boton-formulario').text('Guardar');
    }


    function editar(id, cupon, descuento, maximo, fechaInicio, fechaFin, tipo, finalizado) {
        $('#crear-formulario').show();
        $('#text-formulario').text('Editar Cupon');
        $('#id').val(id);
        $('#cupon').val(cupon);
        $('#descuento').val(descuento);
        $('#maximo').val(maximo);
        $('#fechaInicio').val(fechaInicio);
        $('#fechaFin').val(fechaFin);
        $('#tipo').val(tipo);
        $('#finalizado').val(finalizado);
        $('#boton-formulario').text('Editar');
    }

    var eliminarUsuario = document.getElementById('EliminarUsuario');

    eliminarUsuario.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-id')
        var idModal = eliminarUsuario.querySelector('.id_cupon_2')
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
                    targets: [6],
                    orderable: false
                }]
            });
        });
    });
</script>
@endpush
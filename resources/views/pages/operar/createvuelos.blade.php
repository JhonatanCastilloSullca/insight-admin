@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
<!-- container -->
<div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de operaciones Vuelos</span>
        </div>
        <div class="justify-content-center mt-2">

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
                                <tr >
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Servicio</th>
                                    <th>Usuario</th>
                                    <th>Cantidad</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($operaciones as $i => $operacion)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $operacion->fecha_viaje }}</td>
                                    <td>{{ $operacion->servicio->titulo }}</td>
                                    <td>{{ $operacion->reserva->user->vuelo }}</td>
                                    <td>{{ $operacion->pax }}</td>
                                    <td>{{ $operacion->precio }}</td>
                                    <td>
                                        @if($operacion->estado==1)
                                        Activo
                                        @else
                                        Inactivo
                                        @endif
                                    </td>

                                    <td>
                                        <div class="btn-icon-list btn-list">

                                            <a class="btn btn-icon  btn-success me-1 text-white" data-bs-toggle="modal" data-bs-target="#AgregarVuelo" data-id="{{$operacion->id}}" data-vuelo="{{$operacion->comentarios}}" data-cantidad_pax="{{$operacion->cantidad_pax}}" data-precio="{{$operacion->precio}}" data-horario="{{$operacion->horario}}"><i class="fa fa-plane"></i></a>
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
<!-- /Container -->
<div class="modal fade" id="AgregarVuelo"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" >Agregar N° de Vuelo de pago</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('operacion.vuelonumero')}}" method="POST" autocomplete="off">
            {{csrf_field()}}
                <div class="mb-3">
                    <label for="vuelo" class="form-label">Vuelo:</label>
                    <input type="text" class="form-control vuelo" id="vuelo" name="vuelo" value="{{old('vuelo')}}">
                    @error('vuelo')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                    @enderror
                    <label for="vuelo" class="form-label">Cantidad Pax.:</label>
                    <input type="text" class="form-control cantidad_pax" id="cantidad_pax" name="cantidad_pax" value="{{old('cantidad_pax')}}">
                    @error('cantidad_pax')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                    @enderror
                    <label for="vuelo" class="form-label">Costo:</label>
                    <input type="text" class="form-control precio" id="precio" name="precio" value="{{old('precio')}}">
                    @error('precio')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                    @enderror
                    <label for="vuelo" class="form-label">Horario:</label>
                    <input type="text" class="form-control horario" id="horario" name="horario" value="{{old('horario')}}">
                    @error('horario')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_operacion_2" class="id_operacion_2">
                    <button type="button"  data-bs-toggle="tooltip" data-bs-title="Cancelar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit"  data-bs-toggle="tooltip" data-bs-title="Aceptar" class="btn btn-primary">Aceptar</button>
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
    var agregarVuelo = document.getElementById('AgregarVuelo');
    agregarVuelo.addEventListener('show.bs.modal', function (event) {
        var button                  =   event.relatedTarget
        var id                      =   button.getAttribute('data-id')
        var vuelo                   =   button.getAttribute('data-vuelo')
        var vueloModal              =   agregarVuelo.querySelector('.vuelo')
        var cantidad_paxoModal      =   agregarVuelo.querySelector('.cantidad_pax')
        var preciooModal            =   agregarVuelo.querySelector('.precio')
        var horariooModal           =   agregarVuelo.querySelector('.horario')
        var idModal                 =   agregarVuelo.querySelector('.id_operacion_2')
        idModal.value               =   id;
        vueloModal.value            =   vuelo;
        cantidad_paxModal.value     =   cantidad_pax;
        precioModal.value           =   precio;
        horarioModal.value          =   horario;
    })

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

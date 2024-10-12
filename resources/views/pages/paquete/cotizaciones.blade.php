@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
<!-- container -->
<div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Cotizaciones</span>
        </div>
        <div class="justify-content-center mt-2">
            @can('reserva.create')
            <a href="{{ route('reserva.create')}}">
                <button type="button" class="btn btn-primary mb-2 mb-md-0 ">
                    <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Crear Cotizacion</b>
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
                                    <th>Paquete</th>
                                    <th>Counter</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservas as $reserva)
                                <tr>

                                    <td>
                                        <div class="mobil-break">
                                            {{++$i}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mobil-break">
                                            {{$reserva->pasajeroprincipal()?->nombreCompleto}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mobil-break">
                                            {{$reserva->fecha}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mobil-break">
                                            {{$reserva->user->nombre}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mobil-break">

                                            @foreach($reserva->totales as $total)
                                            {{$total->moneda->abreviatura}} {{$total->acuenta}}
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mobil-break">

                                            @foreach($reserva->totales as $total)
                                            {{$total->moneda->abreviatura}} {{$total->saldo}}
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mobil-break">

                                            @foreach($reserva->totales as $total)
                                            {{$total->moneda->abreviatura}} {{$total->total}}
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mobil-break">
                                            {{$reserva->estado ? 'Confirmado':'Por Confirmar'}}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fe fe-settings"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @can('reserva.edit')
                                            <li><a class="dropdown-item" href="{{route('reserva.edit',$reserva)}}">Editar</a></li>
                                            @endcan
                                            <li><a class="dropdown-item" href="{{route('reserva.pdfvoucher',$reserva)}}" target="_blank">Voucher</a></li>
                                            <li><a class="dropdown-item" href="{{route('reserva.pdfitinerario',$reserva)}}" target="_blank">Itinerario</a></li>
                                            @if(count($reserva->pasajeros)>0)
                                                @if($reserva->pasajeros[0]->email)
                                                    <li><a class="dropdown-item" href="{{route('reserva.notificar',$reserva)}}">Notificar</a></li>
                                                @endif
                                            @endif
                                            <li><a class="dropdown-item" href="{{route('reserva.pdfvoucheroficina',$reserva)}}" target="_blank">Vista Oficina</a></li>
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
                <h5 class="modal-title">Cambiar Estado de Reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('reserva.destroy','test')}}" method="POST" autocomplete="off">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <p>¿Estás seguro de cambiar el estado?</p>
                    <div class="modal-footer">
                        <input type="hidden" name="id_reserva_2" id="id_reserva_2">
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
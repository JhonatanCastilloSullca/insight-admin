@extends('layout.master')
@push('plugin-styles')
<link href="{{ asset('plugins/filepond/filepond.css') }}" rel="stylesheet" />

@endpush
@section('content')
<!-- container -->
<div class="main-container container-fluid">

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Notificaciones</span>
        </div>
        <div class="justify-content-center mt-2">
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="Notificaciones" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mensaje</th>
                                        <th>Reserva</th>
                                        <th>Tipo</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($notificaciones as $notificacion)
                                    <tr>
                                        <td>
                                            <div class="mobil-break">{{++$i}}</div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">{{$notificacion->notificacion}}</div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">N° {{$notificacion->reserva_id}}</div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">{{ $notificacion->tipo == 0 ? "Tour" : ($notificacion->tipo == 1 ? "Hotel" : "Vuelo") }}</div>
                                        </td>
                                        <td>
                                            <div class="mobil-break">
                                                @if ($notificacion->estado == 0)
                                                No leído
                                                @elseif ($notificacion->estado == 1)
                                                Leído
                                                @else
                                                Anulado
                                                @endif
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
</div>


@endsection

@push('plugin-scripts')
<script src="{{ asset('plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('plugins/filepond/filepond.js') }}"></script>
<script src="{{ asset('plugins/filepond/filepond-validation.js') }}"></script>
@endpush

@push('custom-scripts')
@if(count($errors)>0)
<script>
    $(document).ready(function() {
        $('#crear-formulario').show();
        if ('{{old("id")}}') {
            $(function() {
                $('#text-formulario').text('Editar Notificacion');
                $('#boton-formulario').text('Editar');
            });
        } else {
            $(function() {
                $('#text-formulario').text('Crear Notificacion');
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
        $('#text-formulario').text('Crear Notificacion');
        $('#id').val(null);
        $('#nombre').val(null);
        $('#tabla').val(null);
        $('#boton-formulario').text('Guardar');
    }


    function editar(id, nombre, tabla) {
        $('#crear-formulario').show();
        $('#text-formulario').text('Editar Notificacion');
        $('#id').val(id);
        $('#nombre').val(nombre);
        $('#tabla').val(tabla);
        $('#boton-formulario').text('Editar');
    }

    var eliminarUsuario = document.getElementById('EliminarUsuario');

    eliminarUsuario.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-id')
        var idModal = eliminarUsuario.querySelector('.id_notificacion_2')
        idModal.value = id;
    })

    $(function() {
        'use strict';
        $(function() {
            $('#Notificaciones').DataTable({
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
                    targets: [3],
                    orderable: false
                }]
            });
        });
    });
</script>
@endpush
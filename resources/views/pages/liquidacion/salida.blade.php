@extends('layout.master')
@section('content')
<div class="main-container container-fluid">

  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
      <div class="left-content">
          <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Liquidaciones de Egreso</span>
      </div>
      <div class="justify-content-center mt-2">
          @can('liquidacion.salidacreate')
          <a href="{{ route('liquidacion.salidacreate')}}">
            <button type="button" class="btn btn-primary mb-2 mb-md-0 ">
                <i  data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Crear Liquidacion de Egreso</b>
            </button>
          </a>
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
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="liquidacions" class="table">
            <thead>
              <tr>
                <th>Nº</th>
                <th>FECHA</th>
                <th>PROVEEDOR</th>
                <th>USUARIO</th>
                <th>TOTAL</th>
                <th>OBSERVACION</th>
                <th>ESTADO</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($liquidaciones as $liquidacion)
              <tr>
                <td>{{++$i}}</td>
                <td> {{date("d-m-Y", strtotime($liquidacion->fecha))}}</td>
                <td>{{$liquidacion->proveedor->nombre}}</td>
                <td>{{$liquidacion->user->nombre}}</td>
                <td>{{$liquidacion->total}}</td>
                <td>{{$liquidacion->observacion}}</td>
                <td>
                  @if($liquidacion->estado==1)
                    Registrado
                  @elseif($liquidacion->estado==2)
                    Pagado
                  @else
                    Anulado
                  @endif
                </td>
                <td>
                  <div class="btn-group">
                    @can('liquidacion.ver')
                      <a href="{{ route('liquidacion.ver',$liquidacion) }}">
                        <button type="button"  data-bs-toggle="tooltip" data-bs-title="Ver" class="btn btn-warning btn-icon me-2">
                            <i class="fa fa-eye"></i>
                        </button>
                      </a>
                    @endcan
                    @can('liquidacion.destroy')
                      <button type="button" class="btn btn-danger btn-icon me-2" data-bs-toggle="modal" data-bs-target="#EliminarUsuario" data-id="{{$liquidacion->id}}">
                        <i  data-bs-toggle="tooltip" data-bs-title="Eliminar" class="fa fa-trash"></i>
                      </button>
                    @endcan
                    <a href="{{ route('liquidacion.pdf',$liquidacion) }}" target="_blank">
                      <button type="button"  data-bs-toggle="tooltip" data-bs-title="Pdf" class="btn btn-success btn-icon me-2">
                          <i class="fa fa-file"></i>
                      </button>
                    </a>
                    <a href="{{ route('liquidacion.pagar',$liquidacion) }}">
                      <button type="button"  data-bs-toggle="tooltip" data-bs-title="Pagar" class="btn btn-dark btn-icon">
                          <i class="fas fa-dollar-sign"></i>
                      </button>
                    </a>
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


<div class="modal fade" id="EliminarUsuario"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Cambiar Estado de Operación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('liquidacion.destroy','test')}}" method="POST" autocomplete="off">
          {{method_field('delete')}}
          {{csrf_field()}}
            <p>¿Estás seguro de cambiar el estado?</p>
            <div class="modal-footer">
              <input type="hidden" name="liquidacion_id" class="liquidacion_id">
              <button type="button"  data-bs-toggle="tooltip" data-bs-title="Cerrar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
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
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
@endpush

@push('custom-scripts')

<script>

var eliminarUsuario = document.getElementById('EliminarUsuario');

eliminarUsuario.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget

  var id = button.getAttribute('data-id')

  var idModal = eliminarUsuario.querySelector('.liquidacion_id')

  idModal.value = id;
})

$(function() {
  'use strict';

  $(function() {
    $('#liquidacions').DataTable({
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

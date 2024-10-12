@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Facturación</span>
            </div>
            <div class="justify-content-center mt-2">
                {{-- <button id="BotonFiltro" class="btn btn-primary">
                    <i class="fas fa-filter"></i><b> &nbsp; Filtros</b>
                </button> --}}
                <!-- <button id="tuBotonEnviar" class="btn btn-primary">
                    <i  data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-minus"></i><b> &nbsp; Crear Venta</b>
                </button> -->
            </div>
        </div>
        <!-- /breadcrumb -->
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="filtroVentas">
                            <form action="{{ route('facturacion.listado') }}" method="GET">
                                <div class="row pb-4">
                                    <div class="col-md-4">
                                        <label for="searchFechaInicio" class="form-label">Fecha Inicio</label>
                                        <input type="date" class="form-control" id="searchFechaInicio"
                                            name="searchFechaInicio" value="{{ $fechaInicio2 }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="searchFechaFin" class="form-label">Fecha Fin</label>
                                        <input type="date" class="form-control" id="searchFechaFin" name="searchFechaFin"
                                            value="{{ $fechaFin2 }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="searchCliente" class="form-label">Cliente</label>
                                        <div class="form-group">
                                            <select name="searchCliente" class="form-control form-select cliente"
                                                data-bs-placeholder="Select Cliente">
                                                <option value="">SELECCIONE</option>
                                                @foreach ($clientes as $cliente)
                                                    <option value="{{ $cliente->id }}"
                                                        {{ $searchCliente2 == $cliente->id ? 'selected' : '' }}>
                                                        {{ $cliente->razon_social }} {{ $cliente->nombre_comercial }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="searchDocumento" class="form-label">Tipo de Documento</label>
                                        <div class="form-group">
                                            <select name="searchDocumento" class="form-control form-select documento"
                                                data-bs-placeholder="Select Document">
                                                <option value="">SELECCIONE</option>
                                                @foreach ($documentos as $documento)
                                                    <option value="{{ $documento->id }}"
                                                        {{ $searchDocumento2 == $documento->id ? 'selected' : '' }}>
                                                        {{ $documento->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="searchNroDocumento" class="form-label">Nro de Documento</label>
                                        <input type="text" class="form-control" id="searchNroDocumento"
                                            name="searchNroDocumento" placeholder="" value="{{ $nume_documento2 }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="searchReserva" class="form-label">Reserva #</label>
                                        <input type="text" class="form-control" id="searchReserva"
                                            name="searchReserva" placeholder="" value="{{ $searchDocumento2 }}">
                                    </div>
                                    <div class="col-md-4">
                                        <button id="tuBotonEnviar" class="btn btn-primary mt-4">
                                            <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fas fa-search"></i><b>
                                                &nbsp; Buscar</b>
                                        </button>
                                        <a href="{{ route('facturacion.reporte', ['searchFechaInicio' => $fechaInicio2, 'searchFechaFin' => $fechaFin2, 'searchCliente2' => $searchCliente2, 'searchDocumento2' => $searchDocumento2, 'nume_documento2' => $nume_documento2, 'searchDocumento2' => $searchDocumento2]) }}" target="_blank" class="btn btn-success mt-4 ">
                                            <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fas fa-file-pdf"></i><b>
                                                &nbsp; Excel</b>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table id="ventas" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Reserva</th>
                                        <th>Cliente</th>
                                        <th>Documento</th>
                                        <th>Total</th>
                                        <th>Mensaje</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ventas as $venta)
                                    <tr class="fila-venta" data-id="{{ $venta->id }}">
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $venta->fecha }}</td>
                                            <td>{{ $venta->reserva_id }}</td>
                                            <td>{{ $venta->cliente?->nombre }}</td>
                                            <td>{{ $venta->document?->nombre }} {{ $venta->nume_doc }}</td>
                                            <td>{{ $venta->total }}</td>
                                            <td>{{ $venta->sunat == 1 ? $venta->documentosunat?->descripcionCdr : $venta->documentosunat?->messageError }}</td>
                                            <td>{{ $venta->sunat == 1 ? 'Aceptado' : ($venta->sunat == 2 ? 'Anulado' : 'Rechazado') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    @if($venta->sunat == 1 && $venta->document?->nombre != 'NOTA DE CRÉDITO')
                                                        <button type="button" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#EliminarUsuario" data-id="{{$venta->id}}" data-bs-toggle="tooltip" data-bs-title="Anular">
                                                            <i class="fa fa-times"></i>
                                                        </button> 
                                                    @endif
                                                    <a href="{{route('facturacion.ticketpdf',$venta->id)}}" target="_blank">
                                                        <button type="button" class="btn btn-icon btn-success" >
                                                            <i class="fa fa-file"></i>
                                                        </button> 
                                                    </a>
                                                    <a href="{{route('facturacion.xml',$venta->id)}}" target="_blank">
                                                        <button type="button" class="btn btn-icon btn-warning" >
                                                            xml
                                                        </button> 
                                                    </a>
                                                    @if($venta->sunat == 0)
                                                    <a href="{{route('facturacion.enviarfactura',$venta->id)}}">
                                                        <button type="button" class="btn btn-icon btn-success" data-bs-toggle="tooltip" data-bs-title="Enviar">
                                                            <i class="fa fa-paper-plane"></i>
                                                        </button> 
                                                    </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" style="text-align: right;">Totales</th>
                                        <th>{{number_format($ventas->where('sunat',1)->sum('total'),2)}}</th>
                                        <th colspan="3"></td>
                                    </tr>
                                </tfoot>
                            </table>
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
                    <h5 class="modal-title">Anular Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('facturacion.destroyfactura', 'test') }}" method="POST" autocomplete="off">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha:</label>
                            <input type="date" class="form-control" name="fecha" min="{{ date('Y-m-d', strtotime('-2 days')) }}" max="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="type_anular" class="form-label">Motivo:</label>
                            <select class="form-control type_anular" id="type_anular" name="type_anular" value="{{old('type_anular')}}" required>
                                <option value="">SELECCIONE</option>
                                <option value="01">Anulación de la operación</option>
                                <option value="02">Anulación por error en el RUC</option>
                                <option value="03">Corrección por error en la descripción.</option>
                                <option value="04">Descuento global</option>
                                <option value="05">Descuento por ítem</option>
                                <option value="06">Devolución total</option>
                                <option value="07">Devolución por ítem</option>
                                <option value="08">Bonificación</option>
                                <option value="09">Disminución en el valor</option>
                                <option value="10">Otros conceptos</option>
                                <option value="11">Ajustes de operaciones de exportación</option>
                                <option value="12">Ajustes afectos al IVAP</option>
                                <option value="13">Corrección del monto neto pendiente de pago y/o la(s) fechas(s) de vencimiento del pago 
                                    único o de las cuotas y/o los montos correspondientes a cada cuota, de ser el caso.</option>
                            </select>
                            @error('type_anular')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripcion:</label>
                            <input type="text" step="0.01" min='0' class="form-control descripcion" id="descripcion" name="descripcion" value="{{old('descripcion')}}" required>
                            @error('descripcion')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <p>¿Estás seguro de anular el comprobante?</p>
                        <div class="modal-footer">

                            <input type="hidden" name="id_venta_2" class="id_venta_2">
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
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
@endpush
@push('custom-scripts')
    <script>
        
        $(document).ready(function() {
            $('#ventas').DataTable({
                searching: false,  // Desactivar la opción de búsqueda
                paging: false ,
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
                },      // Desactivar la paginación
            });
        });
        $(document).ready(function() {
            $('.cliente').select2({
                placeholder: 'Seleccione',
                searchInputPlaceholder: 'Search'
            });
            $('.cliente-no-search').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Seleccione'
            });
            $('.cliente').on('click', () => {
                let selectField = document.querySelectorAll('.select2-search__field')
                selectField.forEach((element, index) => {
                    element?.focus();
                })
            });
        });
        $(document).ready(function() {
            $('.documento').select2({
                placeholder: 'Seleccione',
                searchInputPlaceholder: 'Search'
            });
            $('.documento-no-search').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Seleccione'
            });
            $('.documento').on('click', () => {
                let selectField = document.querySelectorAll('.select2-search__field')
                selectField.forEach((element, index) => {
                    element?.focus();
                })
            });
        });
        var EliminarMovimiento = document.getElementById('EliminarUsuario');
        EliminarMovimiento.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var idModal = EliminarMovimiento.querySelector('.id_venta_2')
            idModal.value = id;
        })
    </script>

    <script>
        function showSpinnerAndDownload(movimientoId, url) {
            $('#spinner-' + movimientoId).removeClass('d-none');
            setTimeout(function() {
                window.location.href = url;
            }, 100);
        }
    </script>

@if(session('openPopup'))
<script>
    window.open("{{ session('openPopup') }}", "_blank");
</script>
@endif
@endpush

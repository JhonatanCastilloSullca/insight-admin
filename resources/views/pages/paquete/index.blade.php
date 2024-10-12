@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">Listado de Paquetes</span>
            </div>
            <div class="justify-content-center mt-2">
                @can('paquete.create')
                    <a href="{{ route('paquete.create') }}">
                        <button type="button" class="btn btn-primary mb-2 mb-md-0 " data-bs-toggle="modal"
                            data-bs-target="#varyingModal">
                            <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fa fa-plus-circle"></i><b> &nbsp; Crear
                                Paquete</b>
                        </button>
                    </a>
                @endcan
            </div>
        </div>
        <div class="row">
            @foreach ($paquetes as $paquete)
                <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="card custom-card">
                        <img src="{{ asset('storage/' . $paquete->img_principal) }}" class="image-custom-card card-img-top"
                            alt="Imagen-paquete">
                        <div class="card-body">
                            <h6 class="card-title fw-semibold">{{ $paquete->titulo }}</h6>
                            <div class="card-text text-muted paquete-description">
                                <div class="accor " id="headingThree3">
                                    <div class="m-0">
                                        <a href="#collapseThree{{$paquete->id}}" class="tx-14 fw-normal collapsed" data-bs-toggle="collapse"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            Detalles
                                        </a>
                                    </div>
                                </div>
                                <div id="collapseThree{{$paquete->id}}" class="collapse b-b0" aria-labelledby="headingThree"
                                    data-bs-parent="#accordion">
                                    <div class="border table-responsive p-3 accstyle border-top-0">
                                        <div class="row">
                                            @foreach($paquete->detalles as $detalle)
                                                - {{$detalle->servicio->titulo}} <br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-title fw-semibold mt-1"> Precio Soles: {{$paquete->precio_soles}} / Precio Dolares: {{$paquete->precio_dolares}}
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-primary mx-2 button-icon tx-12" data-bs-toggle="modal" data-bs-target="#agregarFecha"  data-id="{{$paquete->id}}">
                                <i class="fe fe-dollar-sign tx-12"></i></button>
                            @can('paquete.edit')
                                <a href="{{ route('paquete.edit',$paquete->id) }}">
                                    <button type="button" class="btn btn-info mx-2 button-icon tx-12"><i
                                        class="fe fe-edit-3 tx-12"></i></button>
                                </a>
                            @endcan
                            <button type="button" class="btn btn-secondary mx-2 button-icon tx-12" data-bs-toggle="modal" data-bs-target="#agregarPrecio" data-id="{{$paquete->id}}">
                                <i class="fe fe-download tx-12"></i>
                            </button>
                            <a href="{{ route('paquete.pdfvista', $paquete->id) }}" target="_blank"
                                class="btn btn-warning mx-2 button-icon tx-12"><i class="fe fe-eye  tx-12"></i>
                            </a>
                            <button type="button" class="btn btn-danger mx-2 button-icon tx-12" data-bs-toggle="modal" data-bs-target="#EliminarPaquete" data-id="{{$paquete->id}}">
                                <i class="fe fe-trash tx-12"></i>
                            </button>
                            <a href="{{ route('paquete.duplicar', $paquete->id) }}"
                                class="btn btn-dark mx-2 button-icon tx-12"><i class="fe fe-plus-circle  tx-12"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
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
                    <form action="{{ route('paquete.destroy', 'test') }}" method="POST" autocomplete="off">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <p>¿Estás seguro de cambiar el estado?</p>
                        <div class="modal-footer">
                            <input type="hidden" name="id_paquete_2" id="id_paquete_2">
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

    <!-- /Container -->
    <div class="modal fade" id="agregarFecha" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Fecha Paquete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('paquete.vender') }}" method="POST" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="pax_nacional_adulto">Pax Nacional Adulto:</label>
                                    <input type="number" min="0" class="form-control" id="pax_nacional_adulto"
                                        name="pax_nacional_adulto" value="{{ old('pax_nacional_adulto', 0) }}" required>
                                    @error('pax_nacional_adulto')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="pax_extranjero_adulto" class="form-label">Pax Extranjero Adulto:</label>
                                    <input type="number" min="0" class="form-control" id="pax_extranjero_adulto"
                                        name="pax_extranjero_adulto" value="{{ old('pax_extranjero_adulto', 0) }}"
                                        required>
                                    @error('pax_extranjero_adulto')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="tituloPaquete" class="form-label">Titulo:</label>
                                    <input type="text" class="form-control" id="tituloPaquete"
                                        name="tituloPaquete" value="{{ old('tituloPaquete') }}"
                                        required>
                                    @error('tituloPaquete')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="tituloPaquete" class="form-label">Fecha Inicio:</label>
                                    <input type="date" class="form-control" id="fechaPaquete"
                                        name="fechaPaquete" value="{{ old('fechaPaquete') }}"
                                        >
                                    @error('fechaPaquete')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pax_nacional_nino">Pax Nacional Niño:</label>
                                    <input type="number" min="0" class="form-control" id="pax_nacional_nino"
                                        name="pax_nacional_nino" value="{{ old('pax_nacional_nino', 0) }}" required>
                                    @error('pax_nacional_nino')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="pax_extranjero_nino" class="form-label">Pax Extranjero Niño:</label>
                                    <input type="number" min="0" class="form-control" id="pax_extranjero_nino"
                                        name="pax_extranjero_nino" value="{{ old('pax_extranjero_nino', 0) }}" required>
                                    @error('pax_extranjero_nino')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group justify-content-end col-md-12">
                                <div class="checkbox">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                            id="tiposervicio" name="tiposervicio">
                                        <label for="tiposervicio" class="custom-control-label mt-1">Privado</label>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id_paquete_crear" id="id_paquete_crear">
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

    <div class="modal fade" id="agregarPrecio" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Seleccionar Precio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form id="precioForm" action="{{ route('paquete.pdfvistaprecio') }}" method="GET" autocomplete="off" target="_blank">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="moneda_id">Moneda:</label>
                                    <select class="form-select js-states" id="moneda_id" name="moneda_id" data-width="100%" required>
                                        <option value="">SELECCIONE</option>
                                        @foreach($monedas as $moneda)
                                            <option value="{{$moneda->id}}">{{$moneda->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @error('moneda_id')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id_enviar" id="id_enviar">
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

document.getElementById('precioForm').addEventListener('submit', function() {
    // Cerrar el modal cuando el formulario se envíe
    var modal = bootstrap.Modal.getInstance(document.getElementById('agregarPrecio'));
    modal.hide();
});

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

        var agregarPrecio = document.getElementById('agregarPrecio');
        agregarPrecio.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var idModal = agregarPrecio.querySelector('#id_enviar');
            idModal.value = id;
        })
    </script>
@endpush

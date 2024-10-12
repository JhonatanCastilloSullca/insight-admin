@extends('layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">Editar Guia</span>
            </div>
        </div>
        <!-- /breadcrumb -->

        <div class="row inbox-wrapper">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form action="{{ route('guia.update', $guia) }}" method="post" class="forms-sample"
                                enctype="multipart/form-data">
                                {{ method_field('patch') }}
                                {{ csrf_field() }}
                                <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                                    <div class="mb-3">
                                        <img src="{{ asset($guia->imagen) }}" alt="{{ $guia->nombre }}"
                                            class="wd-250 ht-250 rounded-circle" style="height: 250px;object-fit: cover;">
                                        <input class="form-control" type="file" id="formFile" accept="image/*"
                                            name="imagen">
                                        @error('imagen')
                                            <span class="error-message" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <p class="tx-16 fw-bolder">{{ $guia->nombre }} {{ $guia->apellido }}</p>
                                        <p class="tx-12 text-muted">
                                        </p>
                                    </div>
                                    @error('imagen')
                                        <span class="error-message" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="tipo_documento">Tipo de Documento</label>
                                <select class="js-example-basic-single form-select" id="tipo_documento" name="tipo_documento" data-width="100%">
                                    <option value="">Seleccione</option>
                                    @php
                                    $opciones = ['DNI', 'PASAPORTE', 'LICENCIA DE CONDUCIR', 'TARJETA DE RESIDENTE', 'NIT', 'RUC', 'TARJETA DE SEGURO SOCIAL', 'CERTIFICADO DE NACIMIENTO', 'TARJETA DE ESTUDIANTE', 'TARJETA DE CREDENCIAL PROFESIONAL', 'TARJETA MILITAR'];
                                    @endphp
                                    @foreach($opciones as $opcion)
                                        <option value="{{ $opcion }}" {{ (old('tipo_documento') == $opcion || $guia->documento->tipo_documento == $opcion) ? 'selected' : '' }}>{{ $opcion }}</option>
                                    @endforeach
                                </select>
                                @error('tipo_documento')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="num_documento" class="form-label">Numero de Documento</label>
                                <input type="text" name="num_documento" id="num_documento" class="form-control"
                                    value="{{ old('num_documento', $guia->documento->num_documento) }}">
                                @error('num_documento')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control"
                                    value="{{ old('nombre', $guia->nombre) }}">
                                @error('nombre')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="celular" class="form-label">Celular</label>
                                <input type="text" name="celular" id="celular" class="form-control"
                                    value="{{ old('celular', $guia->celular) }}">
                                @error('celular')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="fecha_nacimiento" class="form-label">Fecha de inicio</label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                                    value="{{ old('fecha_nacimiento', $guia->fecha_nacimiento) }}">
                                @error('fecha_nacimiento')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="direccion" class="form-label">Direccion</label>
                                <input type="text" name="direccion" id="direccion" class="form-control"
                                    value="{{ old('direccion', $guia->direccion) }}">
                                @error('direccion')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="email" class="form-label">E-mail:</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    value="{{ old('email', $guia->email) }}">
                            </div>

                            @can('guia.edit')
                                <button type="submit" id="submit-button" class="btn btn-primary me-2 w-100">Actualizar</button>
                            @endcan
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Container -->
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')


<script>
    $(document).ready(function() {
        $('#tipo_documento').select2({
            width: '100%'
        });
    });
</script>

@endpush

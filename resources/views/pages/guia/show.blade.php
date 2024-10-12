@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
<div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Ver Guia</span>
        </div>
    </div>
    <!-- /breadcrumb -->
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                            <div class="mb-3">
                                <img class="wd-250 ht-250 rounded-circle" src="{{asset($guia->imagen)}}" alt="" style="height: 250px;">
                            </div>
                            <div class="text-center">
                                <p class="tx-16 fw-bolder">{{$guia->nombre}}</p>
                            </div>
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
                            <label for="tipoDocumento" class="form-label">Tipo de Documento</label>
                            <input type="text" class="form-control" value="{{$guia->documento->tipo_documento}}" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="nroDocumento" class="form-label">Numero de Documento</label>
                            <input type="text" class="form-control" value="{{$guia->documento->num_documento}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="nombres" class="form-label">Nombre</label>
                            <input type="text" class="form-control" value="{{$guia->nombre}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="celular" class="form-label">Celular</label>
                            <input type="text" class="form-control" value="{{$guia->celular}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                                value="{{ old('fecha_nacimiento', $guia->fecha_nacimiento) }}" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="direccion" class="form-label">Direccion</label>
                            <input type="text" class="form-control" value="{{$guia->direccion}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="password" class="form-label">E-mail:</label>
                            <input type="text" class="form-control" value="{{$guia->email}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="usuario" class="form-label">Usuario Registrador</label>
                            <input type="text" class="form-control" value="{{$guia->user->nombre}}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Container -->
@endsection

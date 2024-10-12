@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
<div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Ver Usuario</span>
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
                                <img class="wd-250 ht-250 rounded-circle" src="{{asset($user->imagen)}}" alt="" style="height: 250px;">
                            </div>
                            <div class="text-center">
                                <p class="tx-16 fw-bolder">{{$user->nombre}} {{$user->apellido}}</p>
                                <p class="tx-12 text-muted">
                                    @foreach($user->roles as $role)
                                    {{$role->name}}
                                    @endforeach
                                </p>
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
                            <input type="text" class="form-control" value="{{$user->documento->tipo_documento}}" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="nroDocumento" class="form-label">Numero de Documento</label>
                            <input type="text" class="form-control" value="{{$user->documento->num_documento}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="nombres" class="form-label">Nombre</label>
                            <input type="text" class="form-control" value="{{$user->nombre}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="celular" class="form-label">Celular</label>
                            <input type="text" class="form-control" value="{{$user->celular}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                                value="{{ old('fecha_nacimiento', $user->fecha_nacimiento) }}" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" value="{{$user->usuario}}" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" value="{{$user->password}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            @foreach($user->roles as $role)
                            @endforeach
                            <label for="fc" class="form-label">Rol</label>
                            <input type="text" class="form-control" value="{{$role->name}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="password" class="form-label">E-mail:</label>
                            <input type="text" class="form-control" value="{{$user->email}}" disabled>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                            value="{{ old('fecha_inicio', $user->fecha_inicio) }}" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Sueldo:</label>
                            <input type="text" class="form-control" value="{{$user->sueldo}}" disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Dia Descanso:</label>
                            <input type="text" class="form-control" value="{{$user->dia_descanso}}" disabled>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Hora de Entrada y Salida:</label>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Hora Ingreso</th>
                                        <th>Hora Salida</th>
                                        <th>Dias</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->horarios->where('descanso',0) as $horario)
                                        <tr>
                                            <td>{{$horario->hora_ingreso}}</td>
                                            <td>{{$horario->hora_salida}}</td>
                                            <td>{{$descripcion = str_replace(['[', ']'], '', $horario->descripcion);}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Hora de Descanso:</label>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Hora Ingreso</th>
                                        <th>Hora Salida</th>
                                        <th>Dias</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->horarios->where('descanso',1) as $horario)
                                        <tr>
                                            <td>{{$horario->hora_ingreso}}</td>
                                            <td>{{$horario->hora_salida}}</td>
                                            <td>{{$descripcion = str_replace(['[', ']'], '', $horario->descripcion);}}</td>
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
<!-- /Container -->
@endsection

@extends('layout.master')
@section('content')
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">Editar Usuario</span>
            </div>
        </div>
        <!-- /breadcrumb -->

        <div class="row inbox-wrapper">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form action="{{ route('user.update', $user) }}" method="post" class="forms-sample"
                                enctype="multipart/form-data">
                                {{ method_field('patch') }}
                                {{ csrf_field() }}
                                <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                                    <div class="mb-3">
                                        <img src="{{ asset($user->imagen) }}" alt="{{ $user->nombre }}"
                                            class="wd-250 ht-250 rounded-circle" style="height: 250px;object-fit: cover;">
                                        <input class="form-control" type="file" id="formFile" accept="image/*"
                                            name="imagen">
                                        @error('imagen')
                                            <span class="error-message" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <p class="tx-16 fw-bolder">{{ $user->nombre }} {{ $user->apellido }}</p>
                                        <p class="tx-12 text-muted">
                                            @foreach ($user->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
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
                                        <option value="{{ $opcion }}" {{ (old('tipo_documento') == $opcion || $user->documento->tipo_documento == $opcion) ? 'selected' : '' }}>{{ $opcion }}</option>
                                    @endforeach
                                </select>
                                @error('tipo_documento')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="num_documento" class="form-label">Numero de Documento</label>
                                <input type="text" name="num_documento" id="num_documento" class="form-control"
                                    value="{{ old('num_documento', $user->documento->num_documento) }}">
                                @error('num_documento')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control"
                                    value="{{ old('nombre', $user->nombre) }}">
                                @error('nombre')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="celular" class="form-label">Celular</label>
                                <input type="text" name="celular" id="celular" class="form-control"
                                    value="{{ old('celular', $user->celular) }}">
                                @error('celular')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                                    value="{{ old('fecha_nacimiento', $user->fecha_nacimiento) }}">
                                @error('fecha_nacimiento')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" name="usuario" id="usuario" class="form-control"
                                    value="{{ old('usuario', $user->usuario) }}">
                                @error('usuario')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                @error('password')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Rol</label>
                                <select class="js-example-basic-single form-select" id="idrol" name="idrol"
                                    data-width="100%">
                                    <option value="">SELECCIONE</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" @selected(old('idrol', $user->roles->contains($role)) == $role->id)>
                                            {{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('idrol')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="email" class="form-label">E-mail:</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    value="{{ old('email', $user->email) }}">
                            </div><div class="mb-3 col-md-4">
                                <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                                    value="{{ old('fecha_inicio', $user->fecha_inicio) }}">
                                @error('fecha_inicio')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="sueldo" class="form-label">Sueldo:</label>
                                <input type="number" name="sueldo"  id="sueldo" class="form-control" value="{{old('sueldo',$user->sueldo)}}" >
                                @error('sueldo')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="dia_descanso" class="form-label">Dia Descanso:</label>
                                <select class="js-example-basic-single form-select" id="dia_descanso" name="dia_descanso" data-width="100%">
                                    <option value="" @selected(old('dia_descanso',$user->dia_descanso)=="")>SELECCIONE</option>
                                    <option value="LUNES" @selected(old('dia_descanso',$user->dia_descanso)=="LUNES")>LUNES</option>
                                    <option value="MARTES" @selected(old('dia_descanso',$user->dia_descanso)=="MARTES")>MARTES</option>
                                    <option value="MIERCOLES" @selected(old('dia_descanso',$user->dia_descanso)=="MIERCOLES")>MIERCOLES</option>
                                    <option value="JUEVES" @selected(old('dia_descanso',$user->dia_descanso)=="JUEVES")>JUEVES</option>
                                    <option value="VIERNES" @selected(old('dia_descanso',$user->dia_descanso)=="VIERNES")>VIERNES</option>
                                    <option value="SABADO" @selected(old('dia_descanso',$user->dia_descanso)=="SABADO")>SABADO</option>
                                    <option value="DOMINGO" @selected(old('dia_descanso',$user->dia_descanso)=="DOMINGO")>DOMINGO</option>
                                </select>
                                @error('dia_descanso')
                                    <span class="error-message" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        @livewire('crear-horario',["horarios"=>$user->horarios->where('descanso',0)->values()])
                        @livewire('crear-descanso',["horarios"=>$user->horarios->where('descanso',1)->values()])
                        @can('user.edit')
                        <button type="submit" id="submit-button" class="btn btn-primary me-2">Actualizar</button>
                    @endcan
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    
    <!-- /Container -->
@endsection

@push('plugin-scripts')
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
@endpush

@push('custom-scripts')


<script>
    $(document).ready(function() {
        $('#tipo_documento').select2({
            width: '100%'
        });
        $(document).ready(function() {
            $('#dia_descanso').select2();
        });
    });
</script>

@endpush

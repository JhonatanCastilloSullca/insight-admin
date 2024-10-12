@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
<!-- container -->
<div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Crear Usuario</span>
        </div>
    </div>
    <!-- /breadcrumb -->

    <form action="{{route('user.store')}}" method="POST" class="forms-sample" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="row ">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img src="{{asset('storage/usuario/default.png')}}" alt="" class="wd-250 ht-250 rounded-circle">
                        </div>
                        <div class="text-center">
                            <input class="form-control" type="file" id="formFile" accept="image/*" name="imagen" onchange="checkFileUpload(this)">
                            <div class="progress mg-t-20" style="display: none;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated wd-25p" id="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <div class="mb-3 col-md-6" >
                            <label class="form-label" for="tipo_documento">Tipo de Documento</label>
                            <select class="js-example-basic-single form-select" id="tipo_documento" name="tipo_documento" data-width="100%">
                                <option value="DNI" @selected(old('tipo_documento')=="DNI")>DNI</option>
                                <option value="PASAPORTE" @selected(old('tipo_documento')=="PASAPORTE")>PASAPORTE</option>
                                <option value="LICENCIA DE CONDUCIR" @selected(old('tipo_documento')=="LICENCIA DE CONDUCIR")>LICENCIA DE CONDUCIR</option>
                                <option value="TARJETA DE RESIDENTE" @selected(old('tipo_documento')=="TARJETA DE RESIDENTE")>TARJETA DE RESIDENTE</option>
                                <option value="NIT" @selected(old('tipo_documento')=="NIT")>NIT</option>
                                <option value="RUC" @selected(old('tipo_documento')=="RUC")>RUC</option>
                                <option value="TARJETA DE SEGURO SOCIAL" @selected(old('tipo_documento')=="TARJETA DE SEGURO SOCIAL")>TARJETA DE SEGURO SOCIAL</option>
                                <option value="CERTIFICADO DE NACIMIENTO" @selected(old('tipo_documento')=="CERTIFICADO DE NACIMIENTO")>CERTIFICADO DE NACIMIENTO</option>
                                <option value="TARJETA DE ESTUDIANTE" @selected(old('tipo_documento')=="TARJETA DE ESTUDIANTE")>TARJETA DE ESTUDIANTE</option>
                                <option value="TARJETA DE CREDENCIAL PROFESIONAL" @selected(old('tipo_documento')=="TARJETA DE CREDENCIAL PROFESIONAL")>TARJETA DE CREDENCIAL PROFESIONAL</option>
                                <option value="TARJETA MILITAR" @selected(old('tipo_documento')=="TARJETA MILITAR")>TARJETA MILITAR</option>
                            </select>
                            @error('tipo_documento')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="num_documento" class="form-label">Numero de Documento:</label>
                            <input type="text" name="num_documento"  id="num_documento" class="form-control" value="{{old('num_documento')}}" >
                            @error('num_documento')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" name="nombre"  id="nombre" class="form-control" value="{{old('nombre')}}" >
                            @error('nombre')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="apellido" class="form-label">Apellidos:</label>
                            <input type="text" name="apellido"  id="apellido" class="form-control" value="{{old('apellido')}}" >
                            @error('apellido')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="celular" class="form-label">Celular</label>
                            <input type="text" name="celular" id="celular" class="form-control" value="{{old('celular')}}" >
                            @error('celular')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" name="usuario"  id="usuario" class="form-control" value="{{old('usuario')}}" >
                            @error('usuario')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control"  >
                            @error('password')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                            <input type="date" name="fecha_nacimiento" class="form-control" for="fecha_nacimiento" value="{{old('fecha_nacimiento')}}">
                            @error('fecha_nacimiento')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4" >
                            <label class="form-label">Rol</label>
                            <select class="js-example-basic-single form-select" id="idrol" name="idrol" data-width="100%">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" @selected(old('idrol')==$role->id)>{{$role->name}}</option>
                            @endforeach
                            </select>
                            @error('idrol')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="email" class="form-label">E-mail:</label>
                            <input type="text" name="email" class="form-control" for="email" value="{{old('email')}}">
                            @error('email')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
                            <input type="date" name="fecha_inicio" class="form-control" for="fecha_inicio" value="{{old('fecha_inicio')}}">
                            @error('fecha_inicio')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="sueldo" class="form-label">Sueldo:</label>
                            <input type="number" name="sueldo"  id="sueldo" class="form-control" value="{{old('sueldo')}}" >
                            @error('sueldo')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="dia_descanso" class="form-label">Dia Descanso:</label>
                            <select class="js-example-basic-single form-select" id="dia_descanso" name="dia_descanso" data-width="100%">
                                <option value="" @selected(old('dia_descanso')=="")>SELECCIONE</option>
                                <option value="LUNES" @selected(old('dia_descanso')=="LUNES")>LUNES</option>
                                <option value="MARTES" @selected(old('dia_descanso')=="MARTES")>MARTES</option>
                                <option value="MIERCOLES" @selected(old('dia_descanso')=="MIERCOLES")>MIERCOLES</option>
                                <option value="JUEVES" @selected(old('dia_descanso')=="JUEVES")>JUEVES</option>
                                <option value="VIERNES" @selected(old('dia_descanso')=="VIERNES")>VIERNES</option>
                                <option value="SABADO" @selected(old('dia_descanso')=="SABADO")>SABADO</option>
                                <option value="DOMINGO" @selected(old('dia_descanso')=="DOMINGO")>DOMINGO</option>
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
                    @livewire('crear-horario')
                    @livewire('crear-descanso')
                    @can('user.create')
                    <button type="submit" id="submit-button" class="btn btn-primary me-2">Crear Usuario</button>
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
        $('.js-example-basic-single').select2();
    });
    $(document).ready(function() {
        $('#dia_descanso').select2();
    });
</script>

<script>
function checkFileUpload(input) {
    const progressBar = document.querySelector('.progress-bar');
    const progressContainer = document.querySelector('.progress');
    const submitButton = document.getElementById('submit-button');

    if (input.files && input.files[0]) {
        progressContainer.style.display = 'block';
        const totalTime = 5000;
        const interval = 100;
        let currentTime = 0;
        const progressInterval = setInterval(function () {
            currentTime += interval;
            const percent = (currentTime / totalTime) * 100;
            progressBar.style.width = percent + '%';
            progressBar.setAttribute('aria-valuenow', percent);
            progressBar.innerText = percent.toFixed(2) + '%';
            if (currentTime >= totalTime) {
                clearInterval(progressInterval);
                progressContainer.style.display = 'none';
                submitButton.disabled = false;
            }
        }, interval);
        submitButton.disabled = true;
    }
}
</script>
@endpush

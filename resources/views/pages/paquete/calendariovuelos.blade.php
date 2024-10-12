@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
<!-- container -->
<div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Calendario Vuelos</span>
        </div>
        <form action="{{ route('calendario.vuelos') }}" method="GET">
            <div class="justify-content-center mt-2">
                <div class="row">
                    <div>
                        <label for="searchFechaInicio" class="form-label">Fecha Inicio</label>
                    </div>
                    <div>
                        <input type="date" class="form-control" id="searchFechaInicio"
                            name="searchFechaInicio" value="{{ $fechaActual->format('Y-m-d') }}">
                    </div>
                    <div>
                        <button id="tuBotonEnviar" class="btn btn-primary ">
                            <i data-bs-toggle="tooltip" data-bs-title="Crear" class="fas fa-search"></i><b>
                                &nbsp; Buscar</b>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @if ($message = Session::get('error'))
        <div class="alert alert-error alert-dismissible fade show" role="alert">
        {{ $message }}
        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif
    <!-- /breadcrumb -->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <table role="presentation" class="fc-col-header width-table">
                        <colgroup></colgroup>
                        <thead role="presentation">
                            <tr role="row">
                                <th class="fc-col-header-cell fc-day fc-day-sun">
                                    <div class="fc-scrollgrid-sync-inner text-center">Lunes</div>
                                </th>
                                <th class="fc-col-header-cell fc-day fc-day-mon">
                                    <div class="fc-scrollgrid-sync-inner text-center">Martes</div>
                                </th>
                                <th class="fc-col-header-cell fc-day fc-day-tue">
                                    <div class="fc-scrollgrid-sync-inner text-center">Miercoles</div>
                                </th>
                                <th class="fc-col-header-cell fc-day fc-day-wed">
                                    <div class="fc-scrollgrid-sync-inner text-center">Jueves</div>
                                </th>
                                <th class="fc-col-header-cell fc-day fc-day-thu">
                                    <div class="fc-scrollgrid-sync-inner text-center">Viernes</div>
                                </th>
                                <th class="fc-col-header-cell fc-day fc-day-fri">
                                    <div class="fc-scrollgrid-sync-inner text-center">Sabado</div>
                                </th>
                                <th class="fc-col-header-cell fc-day fc-day-sat">
                                    <div class="fc-scrollgrid-sync-inner text-center">Domingo</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody role="presentation">
                            <tr role="row">
                                @for($i=0;$i<$numeroDiaInicio;$i++) <td class="fc-col-body-cell fc-day">
                                    </td>
                                    @endfor
                                    @foreach($fechas as $index => $data)
                                    <td class="fc-col-body-cell fc-day {{ $data['fecha'] == $fechaActual ? 'current-day' : '' }} ">
                                        <div class="h-table-content d-flex flex-column text-end justify-content-between">
                                            <div class="day mobil-break">
                                                {{ $data['fecha']->format('d/m/Y') }}
                                            </div>
                                            <div class="content">
                                                @foreach($data['detalle'] as $detail)
                                                <a class=" fw-normal" data-bs-toggle="modal" data-bs-target="#{{$detail['confirmado'] == 0 ? 'AgregarHotel' : ($detail['confirmado'] == 1 ? 'ConfirmarHotel' : '') }}" data-id="{{$detail['id']}}"> 
                                                    <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event bg-primary" style="background-color: {{$detail['confirmado'] == 0 ? 'red':($detail['confirmado'] == 1 ? 'yellow':'green' )}}!important;cursor: pointer;">
                                                        <div class="fc-event-main border py-1">
                                                            <div class="mobil-break {{$detail['confirmado'] == 1 ? 'text-black':'text-white'}}">
                                                                <div style="text-wrap:wrap;width: 100%;">
                                                                    Pax: {{$detail['totalPax']}}
                                                                </div>
                                                                <div style="text-wrap:wrap;width: 100%;">
                                                                    Servicio: {{ $detail['titulo'] }} {{ $detail['tipo'] == 0 ? '(Compartido)' : '(Privado)' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    @if($data['fecha']->isoFormat('dddd') == 'domingo')
                            </tr>
                            <tr role="row">
                                @endif
                                @if($index == count($fechas) - 1 && $fechaInicio->isoFormat('dddd') != 'domingo')
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="AgregarHotel"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar N° de Vuelo de pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('operacion.vuelonumero')}}" method="POST" autocomplete="off">
                {{csrf_field()}}
                    <div class="mb-3">
                        <label class="form-label" for="hotel_id">Aerolinea</label>
                        <select class="form-select" id="hotel_id" name="hotel_id" data-width="100%" required>
                            <option value="" >SELECCCIONE</option>
                            @foreach($aerolineas as $avion)
                                <option value="{{$avion->id}}" >{{$avion->text}}</option>
                            @endforeach
                        </select>
                        @error('hotel_id')
                        <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                        {{-- <label for="hotel" class="form-label">Cantidad Pax.:</label>
                        <input type="text" class="form-control cantidad_pax" id="cantidad_pax" name="cantidad_pax" value="{{old('cantidad_pax')}}">
                        @error('cantidad_pax')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror --}}
                        <label for="hotel" class="form-label">Costo:</label>
                        <input type="text" class="form-control precio" id="precio" name="precio" value="{{old('precio')}}" required>
                        @error('precio')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                        <label for="code_reserva" class="form-label">Codigo Reserva:</label>
                        <input type="text" class="form-control" id="code_reserva" name="code_reserva" value="{{old('code_reserva')}}" required>
                        @error('code_reserva')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                        {{-- <label for="hotel" class="form-label">Fecha Ingreso:</label>
                        <input type="text" class="form-control horario" id="horario" name="horario" value="{{old('horario')}}">
                        @error('horario')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror --}}
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" class="id">
                        <button type="button"  data-bs-toggle="tooltip" data-bs-title="Cancelar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit"  data-bs-toggle="tooltip" data-bs-title="Aceptar" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ConfirmarHotel"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Check-in</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('operacion.vueloconfirmar')}}" method="POST" autocomplete="off">
                {{csrf_field()}}
                    <p>¿Check-in realizado?</p>
                    <div class="modal-footer">
                        <input type="hidden" name="id_confirmar" class="id_confirmar">
                        <button type="button"  data-bs-toggle="tooltip" data-bs-title="Cancelar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit"  data-bs-toggle="tooltip" data-bs-title="Aceptar" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-scripts')
<script>
    var agregarHotel = document.getElementById('AgregarHotel');
    agregarHotel.addEventListener('show.bs.modal', function (event) {
        var button                  =   event.relatedTarget
        var id                      =   button.getAttribute('data-id')
        // var hotel                   =   button.getAttribute('data-hotel')
        // var hotelModal              =   agregarHotel.querySelector('.hotel')
        // var cantidad_paxoModal      =   agregarHotel.querySelector('.cantidad_pax')
        // var preciooModal            =   agregarHotel.querySelector('.precio')
        // var horariooModal           =   agregarHotel.querySelector('.horario')
        var idModal                 =   agregarHotel.querySelector('.id')
        idModal.value               =   id;
        // hotelModal.value            =   hotel;
        // cantidad_paxModal.value     =   cantidad_pax;
        // precioModal.value           =   precio;
        // horarioModal.value          =   horario;
    })

    var nuevoHotel = document.getElementById('ConfirmarHotel');
    nuevoHotel.addEventListener('show.bs.modal', function (event) {
        var button                  =   event.relatedTarget
        var id                      =   button.getAttribute('data-id')
        var idModal                 =   nuevoHotel.querySelector('.id_confirmar')
        idModal.value               =   id;
    })
</script>
@endpush
@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
<!-- container -->
<div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Calendario Hotel</span>
        </div>
        <form action="{{ route('calendario.hotel') }}" method="GET">
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
    @if(session('whatsapp_link'))
        <a href="{{ session('whatsapp_link') }}" target="_blank" id="whatsappLink"></a>
        <script>
            // Usar setTimeout para hacer clic en el enlace después de un pequeño retraso
            setTimeout(function() {
                document.getElementById('whatsappLink').click();
            }, 1000); // Retraso de 1 segundo (1000 milisegundos)
        </script>
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
                    <table role="presentation" class="fc-col-header " style="width: 100%;">
                        <colgroup></colgroup>
                        <thead role="presentation">
                            <tr role="row">
                                <th  class="fc-col-header-cell fc-day fc-day-sun">
                                    <div class="fc-scrollgrid-sync-inner text-center">Lunes</div>
                                </th>
                                <th  class="fc-col-header-cell fc-day fc-day-mon">
                                    <div class="fc-scrollgrid-sync-inner text-center">Martes</div>
                                </th>
                                <th  class="fc-col-header-cell fc-day fc-day-tue">
                                    <div class="fc-scrollgrid-sync-inner text-center">Miercoles</div>
                                </th>
                                <th  class="fc-col-header-cell fc-day fc-day-wed">
                                    <div class="fc-scrollgrid-sync-inner text-center">Jueves</div>
                                </th>
                                <th  class="fc-col-header-cell fc-day fc-day-thu">
                                    <div class="fc-scrollgrid-sync-inner text-center">Viernes</div>
                                </th>
                                <th  class="fc-col-header-cell fc-day fc-day-fri">
                                    <div class="fc-scrollgrid-sync-inner text-center">Sabado</div>
                                </th>
                                <th  class="fc-col-header-cell fc-day fc-day-sat">
                                    <div class="fc-scrollgrid-sync-inner text-center">Domingo</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody role="presentation">
                            <tbody role="presentation">
                                <tr role="row">
                                    @for($i=0;$i<$numeroDiaInicio;$i++)
                                        <td class="fc-col-body-cell fc-day">
                                        </td>
                                    @endfor
                                    @foreach($fechas as $index => $data)
                                        <td class="fc-col-body-cell fc-day {{ $data['fecha'] == $fechaActual ? 'current-day' : '' }} ">
                                            <div class="h-table-content d-flex flex-column text-end justify-content-between">
                                                <div class="day">
                                                    {{ $data['fecha']->format('d/m/Y') }}
                                                </div>
                                                <div class="content">
                                                    @foreach($data['detalle'] as $detail)
                                                        @if ($detail->confirmado == 0)
                                                            <a class="fw-normal" href="{{ route('operacion.crearoperacionhotel', ['reserva' => $detail->reserva]) }}">
                                                        @elseif($detail->confirmado == 1)
                                                            <a class="fw-normal" href="{{ route('operacion.agregarpagohotel', ['reserva' => $detail->reserva]) }}">
                                                        @elseif($detail->confirmado == 2)
                                                            <a class="fw-normal" href="{{ route('operacion.realizarpagohotel', ['reserva' => $detail->reserva]) }}">
                                                        @endif
                                                        <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event bg-primary" style="background-color: {{$detail->confirmado == 0 ? 'red':($detail->confirmado == 1 ? 'orange':($detail->confirmado == 2 ? 'yellow':'green' ) )}}!important;cursor: pointer;">
                                                            <div class="fc-event-main border py-1">
                                                                <div class="mobil-break {{$detail->confirmado == 2 ? 'text-black':'text-white'}}">
                                                                    <div style="text-wrap:wrap;width: 100%;">
                                                                        Habitaciones: {{ $detail->pax }}
                                                                    </div>
                                                                    <div style="text-wrap:wrap;width: 100%;">
                                                                        Noches: {{ $detail->equipaje }}
                                                                    </div>
                                                                    <div style="text-wrap:wrap;width: 100%;">
                                                                        Servicio: {{ $detail->servicio->titulo }} - {{ $detail->servicio->proveedor->nombre}}
                                                                    </div>
                                                                    <div style="text-wrap:wrap;width: 100%;">
                                                                        {{ $detail->reserva->pasajeroprincipal()?->nombreCompleto }} (X{{count($detail->reserva->pasajeros)}})
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
@endsection

@push('custom-scripts')
<script>
    
</script>
@endpush
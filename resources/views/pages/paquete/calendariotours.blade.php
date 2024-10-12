@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
<!-- container -->
<div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Calendario Tours</span>
        </div>
        <form action="{{ route('calendario.tours') }}" method="GET">
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
    <!-- /breadcrumb -->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body table-responsive">
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
                                                    @php
                                                        // Obtener el color en hexadecimal y remover el #
                                                        $hexColor = ltrim($detail['color'], '#');

                                                        // Convertir el color a RGB
                                                        list($r, $g, $b) = sscanf($hexColor, "%02x%02x%02x");

                                                        // Calcular la luminancia relativa
                                                        $luminance = (0.2126 * pow($r / 255, 2.2)) +
                                                                    (0.7152 * pow($g / 255, 2.2)) +
                                                                    (0.0722 * pow($b / 255, 2.2));

                                                        // Calcular el contraste (fórmula simple)
                                                        $contrast = ($luminance + 0.05) / (0.05);

                                                        // Determinar el color del texto basado en el contraste
                                                        $textColor = $contrast > 10 ? 'black' : 'white';
                                                    @endphp
                                                    <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event bg-primary" style="background-color: {{$detail['color']}}!important">
                                                        <div class="fc-event-main border py-1">
                                                            <a class="fw-normal" style="color: {{$textColor}};" href="{{ $detail['operado']==1 ? ($detail['categoria_id']==5 ? route('operacion.operarshowtour', $detail['operar_id']) : route('operacion.veroperaciontraslado',$detail['operar_id']) ) : ($detail['categoria_id']==5 ? route('operacion.createtours', ['servicio' => $detail['servicio_id'], 'fecha' => $data['fecha']->format('Y-m-d')]) : '#') }}">
                                                                <div class="mobil-break">
                                                                    <div>Pax: {{$detail['totalPax']}} </div>
                                                                    <div style="text-wrap:wrap;width: 100%;">
                                                                        {!! $detail['operado']==1 ? '<i class="fa fa-check-circle"></i>':'' !!}  Servicio: {{ $detail['titulo'] }} {{ $detail['tipo'] == 0 ? '(Compartido)' : '(Privado)' }}
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
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
                            {{-- @php
                                $fechaInicio = $fechaActual->copy()->subDays(7)->startOfWeek();
                            @endphp
                            @for ($i = 0; $i < 4; $i++)
                                <tr role="row">
                                    @for ($j = 0; $j < 7; $j++)
                                        @php
                                            $currentDay = $fechaInicio->copy()->addDays($i * 7 + $j);
                                            $isCurrentDay = $currentDay->isSameDay($fechaActual);
                                            $formattedCurrentDay = $currentDay->format('Y-m-d'); // Convertir a formato 'Y-m-d'
                                        @endphp
                                        <td class="fc-col-body-cell fc-day {{ $isCurrentDay ? 'current-day' : '' }} ">
                            <div class="h-table-content d-flex flex-column text-end justify-content-between">
                                <div class="day">
                                    {{ $currentDay->format('d/m/Y') }}
                                </div>
                                <div class="content">
                                    @php
                                    $serviciosDelDia = $detallesReservatours->where('fecha_viaje', $formattedCurrentDay);
                                    $serviciosTipo = $serviciosDelDia->groupBy(function ($servicio) {
                                    return $servicio->servicio_id . '-' . $servicio->tipo;
                                    });
                                    @endphp
                                    @foreach ($serviciosTipo as $clave => $servicios)
                                    @php
                                    list($servicioId, $tipo) = explode('-', $clave);
                                    $totalPax = $servicios->sum('pax');
                                    $tituloServicio = $servicios->first()->servicio->titulo;
                                    $color = $servicios->first()->servicio->color;
                                    @endphp
                                    <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event bg-primary" style="background-color: {{$color}}!important">
                                        <div class="fc-event-main border py-1">
                                            <a class="text-white fw-normal " href="{{ route('operacion.createtours', ['servicio' => $servicioId, 'fecha' => $formattedCurrentDay]) }}">
                                                Pax: {{ $totalPax }} Servicio: {{ $tituloServicio }} {{ $tipo == 0 ? '(Compartido)' : '(Privado)' }}
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            </td>
                            @endfor
                            </tr>
                            @endfor --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
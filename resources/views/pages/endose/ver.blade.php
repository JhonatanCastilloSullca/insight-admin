@extends('layout.master')
@push('plugin-styles')
@endpush
@section('content')
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
        </div>
        <!-- /breadcrumb -->
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-primary mb-3">Tour Endosado: {{ $operar->servicio->titulo }} / {{ date('d/m/Y', strtotime($operar->fecha)) }}</h2>
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <div class="card-header bg-transparent pb-0">
                                    <div>
                                        <h3 class="card-title mb-2">Cantidad Pax.:</h3>
                                    </div>
                                </div>
                                <div class="text-muted tx-12 text-center mb-2">{{ $operar->cantidad_pax }}</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <div class="card-header bg-transparent pb-0">
                                    <div>
                                        <h3 class="card-title mb-2">Ingresos:</h3>
                                    </div>
                                </div>
                                <div class="text-muted tx-12 text-center mb-2">S/ {{ $operar->ingresos }}</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <div class="card-header bg-transparent pb-0">
                                    <div>
                                        <h3 class="card-title mb-2">Usuario:</h3>
                                    </div>
                                </div>
                                <div class="text-muted tx-12 text-center mb-2">{{ $operar->user->nombre }}</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <div class="card-header bg-transparent pb-0">
                                    <div>
                                        <h3 class="card-title mb-2">Agencia:</h3>
                                    </div>
                                </div>
                                <div class="text-muted tx-12 text-center mb-2">
                                    {{$agencia->proveedor->nombre }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <h4 class="mb-4">DETALLES</h4>
                            <div class="col-md-12 mb-3">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th><label class="form-label"> SERVICIO</label></th>
                                            <th><label class="form-label"> PAXS</label></th>
                                            <th><label class="form-label"> PAX PRINCIPAL</label></th>
                                            <th><label class="form-label"> NACIONALIDAD</label></th>
                                            <th><label class="form-label"> TELELFONO</label></th>
                                            <th><label class="form-label"> HOTEL</label></th>
                                            <th><label class="form-label"> INGRESOS</label></th>
                                            <th><label class="form-label"> HORA DE RECOJO</label></th>
                                            <th><label class="form-label"> OBSERVACIONES</label></th>
                                            {{-- <th><label class="form-label"> ESTADO</label></th> --}}
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($operar->detalles as $detalle)
                                            <tr>
                                                <td>
                                                    {{$detalle->detallereserva?->servicio->titulo}}
                                                </td>
                                                <td>
                                                    {{$detalle->detallereserva?->pax}}
                                                </td>
                                                <td>
                                                    {{$detalle->detallereserva?->reserva?->pasajeroprincipal()->nombreCompleto}}
                                                </td>
                                                <td>
                                                    {{$detalle->detallereserva?->reserva?->pasajeroprincipal()->pais->nombre}}
                                                </td>
                                                <td>
                                                    {{$detalle->detallereserva?->reserva?->pasajeroprincipal()->celular}}
                                                </td>
                                                <td>
                                                    {{$detalle->detallereserva?->hotel?->nombre}}
                                                </td>
                                                <td>
                                                    {{$detalle->ingresos}}
                                                </td>
                                                <td>
                                                    {{ $detalle->recojo ? date("h:i a",strtotime($detalle->recojo)) : null }}
                                                </td>
                                                <td>
                                                    {{$detalle->observacion}}
                                                </td>
                                                <td>
                                                    <a class="btn btn-info btn-icon" href="{{route('biblia.overview',['id'=>$detalle->detallereserva->id])}}" target="_blank" wire:click="overview()">
                                                        <i class="fab fa-whatsapp"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                            </div><!-- Col -->
                            <div class="col-md-12">
                                <span class="h4"><b>Observaciones:</b> {{$operar->observacion}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

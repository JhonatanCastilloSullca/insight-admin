@extends('layout.master')
@section('content')
<div class="main-container container-fluid">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-body">
          <h2 class="text-primary mb-3">Liquidacion: {{$liquidacion->proveedor->nombre}} / {{date("d-m-Y H:m",strtotime($liquidacion->fecha))}}</h2>
          <div class="row">
            <div class="mb-3 col-md-3" >
              <div class="card-header bg-transparent pb-0">
                  <label class="card-title mb-2">Tipo: {{ $liquidacion->tipo==1 ? 'Ingreso' : 'Egreso' }}</label>
              </div>
            </div>
            <div class="mb-3 col-md-3" >
              <div class="card-header bg-transparent pb-0">
                  <label class="card-title mb-2">Total: {{$liquidacion->total}}</label>
              </div>
            </div>
            <div class="col-md-3" >
              <div class="card-header bg-transparent pb-0">
                  <label class="card-title mb-2">Usuario: {{ $liquidacion->user->nombre }}</label>
              </div>
            </div>
            
            <div class="col-md-12">
              <h4 class="mb-4">DETALLES DE LIQUIDACION</h4>
              <div class="col-md-12 mb-3">
                  <div class="table-responsive">
                      <table class="table">
                          <thead>
                            <tr>
                              <th><label class="form-label"> FECHA</label></th>
                              <th><label class="form-label"> SERVICIO</label></th>
                              <th><label class="form-label"> PAX</label></th>
                              <th><label class="form-label"> NOMBRES</th>
                              <th><label class="form-label"> PRECIO</label></th>
                              <th><label class="form-label"> INGRESOS S/</label></th>
                              <th><label class="form-label"> COMENTARIOS</label></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($liquidacion->detallesliquidacion as $detalle)
                              <tr>
                                <td>{{date("d-m-Y",strtotime($detalle->ejecutable->operar?->fecha))}}</td>
                                <td>{{$detalle->servicio->titulo}}</td>
                                <td>{{$detalle->cantidad}}</td>
                                <td>
                                  @if($detalle->operar == 1)
                                    @foreach($detalle->ejecutable->operar->detalles as $detail)
                                      {{$detail->detalleReserva?->reserva?->pasajeroprincipal()?->nombreCompleto}} (x{{$detail->detalleReserva?->reserva?->sumarPaxPrimerFecha()}})
                                      @if(!$loop->last)
                                        <br>
                                      @endif
                                    @endforeach
                                  @else
                                    {{$detalle->ejecutable->detalleReserva?->reserva?->pasajeroprincipal()?->nombreCompleto}} (x{{$detalle->ejecutable->detalleReserva?->reserva?->sumarPaxPrimerFecha()}})
                                  @endif
                                </td>
                                <td>{{$detalle->moneda_id == 2 ? 'USD' : 'PEN'}} {{$detalle->precio}}</td>
                                <td>PEN {{$detalle->ingreso}}</td>
                                <td>{{$detalle->comentarios}}</td>
                              </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                          </tfoot>
                      </table>
                  </div>
              </div><!-- Col -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection

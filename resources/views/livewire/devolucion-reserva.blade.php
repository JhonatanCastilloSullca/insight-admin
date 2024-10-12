<div class="main-container container-fluid">
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1">Cancelar Reserva</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-header col-md-12 d-flex justify-content-between">
                <h4 class="">Datos Pasajeros</h4>
            </div>
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="paquetes" class="table table-hover">
                        <thead>
                            <tr >
                                <th>Nombres</th>
                                <th>Principal</th>
                                <th>Celular</th>
                                <th>Email</th>
                                <th>Pais</th>
                                <th>Documento</th>
                                <th>Comentario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pasajerosreserva as $i => $pasajero)
                            <tr>
                                <td>{{$pasajero->nombreCompleto}}</td>
                                <td>{{$pasajero->principal ? 'Si':'No'}}</td>
                                <td>{{$pasajero->celular}}</td>
                                <td>{{$pasajero->email}}</td>
                                <td>{{$pasajero->pais?->nombre}}</td>
                                <td>{{$pasajero->documento?->tipo_documento}} {{$pasajero->documento->num_documento}}</td>
                                <td>{{$pasajero->comentario}}</td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button"  class="btn btn-danger btn-icon" wire:click="reducirPasajero({{$i}})"><i class="fe fe-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header col-md-12 d-flex justify-content-between">
                        <span class="h4">Servicios</span>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="paquetes" class="table table-hover ">
                        <thead>
                            <tr >
                                <th>Pax</th>
                                <th>Servicio</th>
                                <th>Tipo</th>
                                <th>Tarifa</th>
                                <th>Fecha</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                                <th>Incluye</th>
                                <th>No Incluye</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach($serviciosreserva as $i => $servicio)
                            <tr >
                                <td>{{$servicio->pax}}</td>
                                <td>{{$servicio->servicio->titulo}}</td>
                                <td>{{$servicio->tipo? 'Privado':'Compartido'}}</td>
                                <td>{{$servicio->precioTarifa?->nombre}}</td>
                                <td>{{$servicio->fecha_viaje ? date('d-m-Y',strtotime($servicio->fecha_viaje)) : ''}}</td>
                                <td>{{$servicio->moneda->abreviatura}} {{number_format($servicio->precio,2)}}</td>
                                <td>{{$servicio->moneda->abreviatura}} {{number_format($servicio->precio*$servicio->pax,2)}}</td>
                                <td>
                                    @foreach($servicio->itinerarios as $itinerario)
                                        @foreach($itinerario->incluyes as $incluye)
                                            {{$incluye->titulo}}<br>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($servicio->itinerarios as $itinerario)
                                        @foreach($itinerario->noincluyes as $noincluye)
                                            {{$noincluye->titulo}}<br>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button"  class="btn btn-danger btn-icon" wire:click="reducirServicio({{$i}})"><i class="fe fe-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header col-md-12 d-flex justify-content-between">
                        <span class="h4">Hoteles</span>
                        <button type="button" class="btn btn-primary mb-2 mb-md-0 " wire:click="abrirHotel">
                            <i class="fa fa-plus-circle"></i><b> &nbsp; Agregar Hotel</b>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="paquetes" class="table table-hover ">
                        <thead>
                            <tr >
                                <th>Cantidad</th>
                                <th>Noches</th>
                                <th>Habitacion</th>
                                <th>Fecha Ingreso</th>
                                <th>Fecha Salida</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                                <th>Incluye</th>
                                <th>No Incluye</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hotelesreserva as $i => $servicio)
                            <tr>
                                <td>{{$servicio['pax']}}</td>
                                <td>{{$servicio['noches']}}</td>
                                <td>{{$servicio['servicio']}}</td>
                                <td>{{$servicio['fecha_viaje'] ? date('d-m-Y H:i',strtotime($servicio['fecha_viaje'])) : ''}}</td>
                                <td>{{$servicio['fecha_viajefin'] ? date('d-m-Y H:i',strtotime($servicio['fecha_viajefin'])) : ''}}</td>
                                <td>{{$servicio['moneda']}} {{number_format($servicio['precio'],2)}}</td>
                                <td>{{$servicio['moneda']}} {{number_format($servicio['precio']*$servicio['pax']*$servicio['noches']+$servicio['adicional'],2)}}</td>
                                <td>
                                    @foreach($servicio['itinerarios'] as $itinerario)
                                        @foreach($itinerario['incluye'] as $incluye)
                                            {{$incluye['servicio']}}<br>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($servicio['itinerarios'] as $itinerario)
                                        @foreach($itinerario['noincluye'] as $noincluye)
                                            {{$noincluye['servicio']}}<br>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button"  class="btn btn-success btn-icon" wire:click="editarHotel({{$i}})"><i class="fe fe-edit"></i></button>
                                        <button type="button"  class="btn btn-danger btn-icon" wire:click="reducirHotel({{$i}})"><i class="fe fe-trash"></i></button>
                                        <button type="button"  class="btn btn-info btn-icon" wire:click="duplicarHotel({{$i}})"><i class="fe fe-plus"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
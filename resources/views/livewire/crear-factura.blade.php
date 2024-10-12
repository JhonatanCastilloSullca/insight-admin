<div class="row">

    <div class="col-md-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
            {{ $message }}
            <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="documento_id">Comprobante</label>
                        <div wire:ignore>
                            <select class="form-control selectpicker" id="documento_id" wire:model="documento_id" data-width="100%" data-live-search="true">
                                <option value="">SELECCIONE</option>
                                @foreach($documentos as $documento)
                                    <option value="{{$documento->id}}">{{$documento->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('documento_id')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-3" >
                        <div wire:ignore>
                            <label class="form-label" for="tipo_documento">Tipo Documento:</label>
                            <select class="form-select js-states" id="tipo_documento" name="tipo_documento" data-width="100%" wire:model.defer="tipo_documento">
                                <option value="DNI">DNI</option>
                                <option value="RUC">RUC</option>
                                <option value="CARNET E.">CARNET E.</option>
                                <option value="PASAPORTE">PASAPORTE</option>
                            </select>
                        </div>
                        @error('tipo_documento')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-5" >
                        <label class="form-label" for="num_documento">Numero Documento:</label>
                        <div class="d-flex gap-3">
                            <input type="text" id="num_documento" class="form-control" wire:model.defer="num_documento" autocomplete="off">
                            @error('num_documento')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                            <button type="button" class="btn btn-primary button-icon" wire:click="searchDocumento" ><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="nombre" class="form-label">Nombre o Razon Social</label>
                        <div class="d-flex gap-3">
                            <input type="text" id="nombre" class="form-control" wire:model="nombre" autocomplete="off">
                            @error('nombre')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button aria-label="close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                        @endif
                        @if ($mensaje != "")
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $mensaje }}
                            <button aria-label="close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        @endif
                    </div>
                    <div class="mb-3 col-md-8">
                        <label for="direccion" class="form-label">Direccion</label>
                        <div class="d-flex gap-3">
                            <input type="text" id="direccion" class="form-control" wire:model.defer="direccion" autocomplete="off">
                        </div>
                        @error('direccion')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="email" class="form-label">Correo</label>
                        <div class="d-flex gap-3">
                            <input type="text" id="email" class="form-control" wire:model.defer="email" autocomplete="off">
                        </div>
                        @error('email')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <div class="d-flex gap-3">
                            <input type="text" id="cantidad" class="form-control" wire:model.defer="cantidad" autocomplete="off">
                        </div>
                        @error('cantidad')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="mb-3 col-md-5">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <div class="d-flex gap-3">
                            <textarea type="text" id="descripcion" class="form-control" wire:model.defer="descripcion" autocomplete="off"></textarea>
                        </div>
                        @error('descripcion')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="mb-3 col-md-2">
                        <div wire:ignore>
                            <label class="form-label" for="moneda_id">Moneda:</label>
                            <select class="form-select js-states" id="moneda_id" name="moneda_id" data-width="100%" wire:model.defer="moneda_id">
                                <option value="1">PEN Soles </option>
                                <option value="2">USD Dolares</option>
                            </select>
                        </div>
                        @error('moneda_id')
                            <span class="error-message" style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="precio" class="form-label">total</label>
                        <div class="d-flex gap-3">
                            <input type="text" id="precio" class="form-control" wire:model.defer="precio" autocomplete="off">
                        </div>
                        @error('precio')
                                <span class="error-message" style="color:red">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
            </div><div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="ps-4 pe-4 pb-2 pt-4">
                    <div class="row ">
                        <div class="mb-3 col-md-12" style="text-align-last: right">
                            <label class="form-label">Total</label>
                            <h3 >{{number_format($total,2)}}</h3>
                            @if($total > 0)
                                <div class="d-flex justify-content-end mt-3">
                                    <button class="btn btn-danger me-2" type="button" wire:click="registrarVenta(0)" wire:loading.attr="disabled" id="guardarCobrar">Guardar </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

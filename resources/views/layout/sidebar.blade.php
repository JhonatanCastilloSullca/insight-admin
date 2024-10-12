<!-- main-sidebar -->
<div class="sticky">
	<aside class="app-sidebar">
		<div class="main-sidebar-header active">
			<a class="header-logo active" href="{{ url('/') }}">
				<img src="{{ asset('img/brand/logo.png')}}" class="main-logo  desktop-logo" alt="logo">
				<img src="{{ asset('img/brand/logo-white.png')}}" class="main-logo  desktop-dark" alt="logo">
				<img src="{{ asset('img/brand/favicon.png')}}" class="main-logo  mobile-logo" alt="logo">
				<img src="{{ asset('img/brand/favicon-white.png')}}" class="main-logo  mobile-dark" alt="logo">
			</a>
		</div>
		<div class="main-sidemenu">
			<div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg></div>
			<ul class="side-menu">




				<li class="side-item side-item-category">Main</li>
				<li class="slide">
					<a class="side-menu__item {{request()->routeIs(['dashboard','welcome']) ? 'active': ''}}" href="{{ url('/') }}">
						<svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/></svg> <span class="side-menu__label">Dashboard</span>
					</a>
				</li>
                @if ( Gate::check('user.index') ||  Gate::check('categoria.index') ||  Gate::check('ubicacion.index') ||  Gate::check('medio.index') ||  Gate::check('cupon.index') ||  Gate::check('pdf.index') ||  Gate::check('proveedor.index'))
                    <li class="slide {{ Str::startsWith(request()->path(), 'configuracion') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ Str::startsWith(request()->path(), 'configuracion') ? 'active' : '' }}" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-cog tx-16 me-2"></i> <span class="side-menu__label">Configuracion</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            @can('user.index')
                                <li><a class="slide-item {{request()->routeIs(['user.*']) ? 'active': ''}}" href="{{ route('user.index') }}" >Usuarios</a></li>
                            @endcan
                            {{-- @can('categoria.index')
                                <li><a class="slide-item {{request()->routeIs(['categoria.*']) ? 'active': ''}}"  href="{{ route('categoria.index') }}">Categorias</a></li>
                            @endcan --}}
                            {{-- @can('role.index')
                                <li><a class="slide-item {{request()->routeIs(['roles.*']) ? 'active': ''}}" href="{{ route('roles.index') }}"  >Roles</a></li>
                            @endcan --}}
                            {{-- @can('ubicacion.index')
                                <li><a class="slide-item {{request()->routeIs(['ubicacion.*']) ? 'active': ''}}"  href="{{ route('ubicacion.index') }}">Ubicaciones</a></li>
                            @endcan --}}
                            {{-- @can('medio.index')
                                <li><a class="slide-item {{request()->routeIs(['medio.*']) ? 'active': ''}}"  href="{{ route('medio.index') }}">Medios de Pago</a></li>
                            @endcan --}}
                            {{-- @can('cupon.index')
                                <li><a class="slide-item {{request()->routeIs(['cupon.*']) ? 'active': ''}}"  href="{{ route('cupon.index') }}">Cupones</a></li>
                            @endcan --}}
                            {{-- @can('pdf.index')
                                <li><a class="slide-item {{request()->routeIs(['pdfdatos.*']) ? 'active': ''}}"  href="{{ route('pdfdatos.edit',1) }}" >PDF Editar</a></li>
                            @endcan --}}
                            {{-- @can('proveedor.index')
                                <li><a class="slide-item {{request()->routeIs(['proveedor.*']) ? 'active': ''}}"  href="{{ route('proveedor.index') }}">Proveedor</a></li>
                            @endcan --}}
                            {{-- @can('precio.index')
                                <li><a class="slide-item {{request()->routeIs(['precio.*']) ? 'active': ''}}"  href="{{ route('precio.index') }}">Tarifa</a></li>
                            @endcan --}}
                            {{-- @can('hotel.index')
                                <li><a class="slide-item {{request()->routeIs(['hotel.*']) ? 'active': ''}}"  href="{{ route('hotel.index') }}">Hoteles</a></li>
                            @endcan --}}
                            {{-- @can('pdfdatos.index')
                                <li><a class="slide-item {{request()->routeIs(['pdfdatos.*']) ? 'active': ''}}"  href="{{ route('pdfdatos.index') }}">Terminos</a></li>
                            @endcan --}}
                        </ul>
                    </li>
                @endif
                @if ( Gate::check('servicio.index') ||  Gate::check('servicio.hotel') ||  Gate::check('servicio.vuelo') ||  Gate::check('servicio.otros'))
                    <li class="slide {{ Str::startsWith(request()->path(), 'servicios') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ Str::startsWith(request()->path(), 'servicios') ? 'active' : '' }}" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="far fa-handshake tx-16 me-2"></i> <span class="side-menu__label">Servicios</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            @can('servicio.index')
                                <li><a class="slide-item {{request()->routeIs(['servicio.index']) ? 'active': ''}}" href="{{ route('servicio.index') }}" >Servicios</a></li>
                            @endcan
                            {{-- @can('servicio.hotel')
                                <li><a class="slide-item {{request()->routeIs(['servicio.hotel']) ? 'active': ''}}" href="{{ route('servicio.hotel') }}" >Hotel</a></li>
                            @endcan
                            @can('servicio.vuelo')
                                <li><a class="slide-item {{request()->routeIs(['servicio.vuelo']) ? 'active': ''}}" href="{{ route('servicio.vuelo') }}" >Vuelos</a></li>
                            @endcan --}}
                            @can('servicio.otros')
                                <li><a class="slide-item {{request()->routeIs(['servicio.otros']) ? 'active': ''}}" href="{{ route('servicio.otros') }}" >Otros</a></li>
                            @endcan
                        </ul>
                    </li>
                @endif
                @if ( Gate::check('paquete.index') ||  Gate::check('paquete.create'))
                    <li class="slide {{ Str::startsWith(request()->path(), 'paquete') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ Str::startsWith(request()->path(), 'paquete') ? 'active' : '' }}" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-cubes tx-16 me-2"></i> <span class="side-menu__label">Paquetes</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            @can('paquete.index')
                                <li><a class="slide-item {{request()->routeIs(['paquete.index']) ? 'active': ''}}" href="{{ route('paquete.index') }}" >Lista de paquetes</a></li>
                            @endcan
                            @can('paquete.create')
                                <li><a class="slide-item {{request()->routeIs(['paquete.create']) ? 'active': ''}}" href="{{ route('paquete.create') }}" >Create Paquete</a></li>
                            @endcan
                        </ul>
                    </li>
                @endif
                {{-- @if ( Gate::check('reserva.index') ||  Gate::check('reserva.create'))
                    <li class="slide {{ Str::startsWith(request()->path(), 'reserva') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ Str::startsWith(request()->path(), 'reserva') ? 'active' : '' }}" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-list-alt tx-16 me-2"></i> <span class="side-menu__label">Reservas</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            @can('reserva.index')
                                <li><a class="slide-item {{request()->routeIs(['reserva.index']) ? 'active': ''}}" href="{{ route('reserva.index') }}" >Lista de reservas</a></li>
                            @endcan
                            <li><a class="slide-item {{request()->routeIs(['reserva.sinfecha']) ? 'active': ''}}" href="{{ route('reserva.sinfecha') }}" >Reservas sin fecha</a></li>
                            <li><a class="slide-item {{request()->routeIs(['reserva.sinconfirmar']) ? 'active': ''}}" href="{{ route('reserva.sinconfirmar') }}" >Reservas sin confirmar</a></li>
                            
                            @can('reserva.create')
                                <li><a class="slide-item {{request()->routeIs(['reserva.create']) ? 'active': ''}}" href="{{ route('reserva.create') }}" >Create Reserva</a></li>
                            @endcan
                        </ul>
                    </li>
                @endif --}}

                {{-- @if ( Gate::check('calendario.hotel') ||  Gate::check('calendario.tours') ||  Gate::check('calendario.vuelos'))
                    <li class="slide {{ Str::startsWith(request()->path(), 'calendario') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ Str::startsWith(request()->path(), 'calendario') ? 'active' : '' }}" data-bs-toggle="slide" href="javascript:void(0);"><i class="far fa-calendar-times tx-16 me-2"></i><span class="side-menu__label">Calendario</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            @can('calendario.tours')
                                <li><a class="slide-item {{request()->routeIs(['calendario.tours']) ? 'active': ''}}"  href="{{ route('calendario.tours') }}">Calendario Tour</a></li>
                            @endcan
                            @can('calendario.hotel')
                                <li><a class="slide-item {{request()->routeIs(['calendario.hotel']) ? 'active': ''}}"  href="{{ route('calendario.hotel') }}">Calendario Hotel</a></li>
                            @endcan
                            @can('calendario.vuelos')
                                <li><a class="slide-item {{request()->routeIs(['calendario.vuelos']) ? 'active': ''}}"  href="{{ route('calendario.vuelos') }}">Calendario Vuelo</a></li>
                            @endcan
                        </ul>
                    </li>
                @endif
                <li class="slide {{ Str::startsWith(request()->path(), 'operacion') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item {{ Str::startsWith(request()->path(), 'operacion') ? 'active' : '' }}" data-bs-toggle="slide" href="javascript:void(0);"><i class="fa fa-mouse-pointer tx-16 me-2"></i><span class="side-menu__label">Operacion</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                            <li><a class="slide-item {{request()->routeIs(['operacion.tours']) ? 'active': ''}}"  href="{{ route('operacion.tours') }}">Operacion Tour</a></li>
                            <li><a class="slide-item {{request()->routeIs(['operacion.hotel']) ? 'active': ''}}"  href="{{ route('operacion.hotel') }}">Operacion Hotel</a></li>
                            <li><a class="slide-item {{request()->routeIs(['operacion.vuelos']) ? 'active': ''}}"  href="{{ route('operacion.vuelos') }}">Operacion Vuelo</a></li>
                            <li><a class="slide-item {{request()->routeIs(['operacion.traslados']) ? 'active': ''}}"  href="{{ route('operacion.traslados') }}">Operacion Traslados</a></li>
                            <li><a class="slide-item {{request()->routeIs(['operacion.machupicchu']) ? 'active': ''}}"  href="{{ route('operacion.machupicchu') }}">Machupicchu</a></li>
                    </ul>
                </li> --}}
{{-- 
                <li class="slide">
					<a class="side-menu__item {{request()->routeIs(['notificacion.index']) ? 'active': ''}}"  href="{{ route('notificacion.index') }}" >
                        <i class="fa fa-bell tx-16 me-2"></i><span class="side-menu__label">Notificaciones</span>
					</a>
				</li>

                <li class="slide">
					<a class="side-menu__item {{request()->routeIs(['pasajeros.llegantes']) ? 'active': ''}}"  href="{{ route('pasajeros.llegantes') }}" >
                        <i class="fa fa-bell tx-16 me-2"></i><span class="side-menu__label">Pasajeros</span>
					</a>
				</li>

                <li class="slide">
					<a class="side-menu__item {{request()->routeIs(['endose.index']) ? 'active': ''}}"  href="{{ route('endose.index') }}" >
                        <i class="fa fa-book tx-16 me-2"></i><span class="side-menu__label">Endose</span>
					</a>
				</li>
                <li class="slide">
					<a class="side-menu__item {{request()->routeIs(['biblia.biblia']) ? 'active': ''}}"  href="{{ route('biblia.biblia') }}" >
                        <i class="fa fa-book tx-16 me-2"></i><span class="side-menu__label">Biblia</span>
					</a>
				</li> --}}
                {{-- @if ( Gate::check('liquidacion.ingreso') ||  Gate::check('liquidacion.salida'))
                    <li class="slide {{ Str::startsWith(request()->path(), 'liquidacion') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ Str::startsWith(request()->path(), 'liquidacion') ? 'active' : '' }}" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="fa fa-arrows-alt-h tx-16 me-2"></i> <span class="side-menu__label">Liquidaciones</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            @can('liquidacion.ingreso')
                                <li><a class="slide-item {{request()->routeIs(['liquidacion.ingreso']) ? 'active': ''}}" href="{{ route('liquidacion.ingreso') }}" >Liquidacion Ingreso</a></li>
                            @endcan
                            @can('liquidacion.salida')
                                <li><a class="slide-item {{request()->routeIs(['liquidacion.salida']) ? 'active': ''}}" href="{{ route('liquidacion.salida') }}" >Liquidacion Egreso</a></li>
                            @endcan
                        </ul>
                    </li>
                @endif --}}
                {{-- <li class="slide {{ Str::startsWith(request()->path(), 'facturacion') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item {{ Str::startsWith(request()->path(), 'facturacion') ? 'active' : '' }}" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M20,3H4C2.9,3,2,3.9,2,5v14c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V5 C22,3.9,21.1,3,20,3z M10,17H5v-2h5V17z M10,13H5v-2h5V13z M10,9H5V7h5V9z M14.82,15L12,12.16l1.41-1.41l1.41,1.42L17.99,9 l1.42,1.42L14.82,15z" fill-rule="evenodd"/>
                    </svg><span class="side-menu__label">Facturación</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                            <li><a class="slide-item {{request()->routeIs(['facturacion.pagos']) ? 'active': ''}}" href="{{ route('facturacion.pagos') }}" >Pagos por Facturar</a></li>
                            <li><a class="slide-item {{request()->routeIs(['facturacion.listado']) ? 'active': ''}}" href="{{ route('facturacion.listado') }}" >Facturacion</a></li>
                            <li><a class="slide-item {{request()->routeIs(['facturacion.create']) ? 'active': ''}}" href="{{ route('facturacion.create') }}" >Crear</a></li>
                    </ul>
                </li> --}}
                {{-- <li class="slide {{ Str::startsWith(request()->path(), 'contabilidad') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item {{ Str::startsWith(request()->path(), 'contabilidad') ? 'active' : '' }}" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M20,3H4C2.9,3,2,3.9,2,5v14c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V5 C22,3.9,21.1,3,20,3z M10,17H5v-2h5V17z M10,13H5v-2h5V13z M10,9H5V7h5V9z M14.82,15L12,12.16l1.41-1.41l1.41,1.42L17.99,9 l1.42,1.42L14.82,15z" fill-rule="evenodd"/>
                    </svg><span class="side-menu__label">Contabilidad</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                            <li><a class="slide-item {{request()->routeIs(['contabilidad.lista']) ? 'active': ''}}" href="{{ route('contabilidad.lista') }}" >Ver</a></li>
                    </ul>
                    <ul class="slide-menu">
                            <li><a class="slide-item {{request()->routeIs(['contabilidad.utilidad']) ? 'active': ''}}" href="{{ route('contabilidad.utilidad') }}" >Utilidad</a></li>
                    </ul>
                </li> --}}

                {{-- <li class="slide {{ Str::startsWith(request()->path(), 'reportes') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item {{ Str::startsWith(request()->path(), 'reportes') ? 'active' : '' }}" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                        <g><rect fill="none" height="24" width="24"/></g><g><g><rect height="11" width="4" x="4" y="9"/><rect height="7" width="4" x="16" y="13"/><rect height="16" width="4" x="10" y="4"/></g></g>                    </svg><span class="side-menu__label">Reportes</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                            <li><a class="slide-item {{request()->routeIs(['reportes.reservas']) ? 'active': ''}}" href="{{ route('reportes.reservas') }}" >Reservas</a></li>
                            <li><a class="slide-item {{request()->routeIs(['reportes.tours']) ? 'active': ''}}" href="{{ route('reportes.tours') }}" >Tours</a></li>
                            <li><a class="slide-item {{request()->routeIs(['reportes.files']) ? 'active': ''}}" href="{{ route('reportes.files') }}" >Files</a></li>
                    </ul>
                </li> --}}
                {{-- <li class="slide">
					<a class="side-menu__item {{request()->routeIs(['plantilla.consetur']) ? 'active': ''}}"  href="{{ route('plantilla.consetur') }}" >
                        <i class="fa fa-file tx-16 me-2"></i><span class="side-menu__label">Plantilla Consetur</span>
					</a>
				</li> --}}
			</ul>
			<div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/></svg></div>
		</div>
	</aside>
</div>
<!-- main-sidebar -->

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm');
    Route::post('/', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
});

Route::group(['middleware' => ['auth']], function () {

    Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/perfil/{user}', 'App\Http\Controllers\UserController@perfil')->name('perfil');
    Route::patch('perfilguardar/{user}', 'App\Http\Controllers\UserController@perfilguardar')->name('perfilguardar');
    Route::resource('configuracion/user', App\Http\Controllers\UserController::class)->names('user');
    Route::resource('configuracion/categoria', App\Http\Controllers\CategoriaController::class)->names('categoria')->parameters(['categoria' => 'categoria']);
    Route::resource('configuracion/ubicacion', App\Http\Controllers\UbicacionController::class)->names('ubicacion')->parameters(['ubicacion' => 'ubicacion']);
    Route::resource('configuracion/medio', App\Http\Controllers\MedioController::class)->names('medio');
    Route::resource('configuracion/cupon', App\Http\Controllers\CuponController::class)->names('cupon');
    Route::resource('configuracion/proveedor', App\Http\Controllers\ProveedorController::class)->names('proveedor')->parameters(['proveedor' => 'proveedor']);
    Route::resource('configuracion/pdfdatos', App\Http\Controllers\PdfDatosController::class)->names('pdfdatos');
    Route::resource('configuracion/roles', App\Http\Controllers\RoleController::class)->except('show')->names('roles');
    Route::resource('configuracion/precios', App\Http\Controllers\PrecioController::class)->except('show')->names('precio');
    Route::resource('configuracion/hoteles', App\Http\Controllers\HotelController::class)->except('show')->names('hotel');
    Route::resource('incidencias', App\Http\Controllers\IncidenciaController::class)->except('show')->names('incidencia');

    Route::get('contabilizar-pago/{pago}', 'App\Http\Controllers\ReservaController@contabilizarpago')->name('contabilizar.pago');
    Route::get('pasajeros-que-llegan', 'App\Http\Controllers\PasajeroController@pasajerosllegantes')->name('pasajeros.llegantes');
    Route::get('wpp-bienvenida', 'App\Http\Controllers\PasajeroController@bienvenida')->name('pasajeros.bienvenida');

    Route::get('servicios/hotel', 'App\Http\Controllers\ServicioController@hoteles')->name('servicio.hotel');
    Route::get('servicios/vuelo', 'App\Http\Controllers\ServicioController@vuelos')->name('servicio.vuelo');
    Route::get('servicios/otros', 'App\Http\Controllers\ServicioController@otros')->name('servicio.otros');
    Route::resource('servicios/servicio', App\Http\Controllers\ServicioController::class)->names('servicio')->parameters(['servicio' => 'servicio']);
    Route::get('servicios/servicio/create/{categoria_id?}', 'App\Http\Controllers\ServicioController@create')->name('servicio.create');
    Route::get('servicios/servicio/duplicar/{id}', 'App\Http\Controllers\ServicioController@duplicar')->name('servicio.duplicar');

    Route::get('facturacion/pagos', 'App\Http\Controllers\FacturacionController@pagos')->name('facturacion.pagos');
    Route::get('facturacion/listado', 'App\Http\Controllers\FacturacionController@listado')->name('facturacion.listado');
    Route::get('facturacion/pagos', 'App\Http\Controllers\FacturacionController@pagos')->name('facturacion.pagos');
    Route::get('facturacion/listado', 'App\Http\Controllers\FacturacionController@listado')->name('facturacion.listado');
    Route::get('facturacion/create/{id?}', 'App\Http\Controllers\FacturacionController@create')->name('facturacion.create');
    Route::get('/descargar-xml/{id}', 'App\Http\Controllers\FacturacionController@descargarXml')->name('facturacion.xml');
    Route::delete('/destroyfactura', 'App\Http\Controllers\FacturacionController@destroyfactura')->name('facturacion.destroyfactura');
    Route::get('/facturacion/enviar/{venta}', 'App\Http\Controllers\FacturacionController@enviarfactura')->name('facturacion.enviarfactura');
    Route::get('facturacion/reporte', 'App\Http\Controllers\FacturacionController@reporte')->name('facturacion.reporte');
    Route::get('facturacion/ticketpdf/{ventaId}', 'App\Http\Controllers\FacturacionController@ticketpdf')->name('facturacion.ticketpdf');

    Route::get('descargar-plantilla-machupicchu','App\Http\Controllers\PlantillaController@ministerio')->name('plantilla.ministerio');
    
    Route::get('plantilla-consetur','App\Http\Controllers\PlantillaController@consetur')->name('plantilla.consetur');
    Route::get('descargar-plantilla-consetur','App\Http\Controllers\PlantillaController@descargarconsetur')->name('plantilla.descargarconsetur');

    Route::get('contabilidad/lista', 'App\Http\Controllers\ContabilidadController@lista')->name('contabilidad.lista');
    Route::get('contabilidad/utilidad', 'App\Http\Controllers\ContabilidadController@utilidad')->name('contabilidad.utilidad');

    Route::get('pasajeros-excel', 'App\Http\Controllers\ContabilidadController@pasajerosexports')->name('excel.pasajeros');
    Route::get('ingreso-machupicchu', 'App\Http\Controllers\ReservaController@ingresomachupicchu')->name('ingreso.machupicchu');
    Route::post('guardar-ingreso-machupicchu', 'App\Http\Controllers\ReservaController@guardaringresomachupicchu')->name('guardar.ingresomachupicchu');

    Route::resource('etiqueta', App\Http\Controllers\EtiquetaController::class)->names('etiqueta')->parameters(['etiqueta' => 'etiqueta']);
    Route::resource('guia', App\Http\Controllers\GuiaController::class)->names('guia')->parameters(['guia' => 'guia']);
    Route::resource('notificacion', App\Http\Controllers\NotificacionController::class)->names('notificacion')->parameters(['notificacion' => 'notificacion']);

    Route::get('endose','App\Http\Controllers\EndoseController@index')->name('endose.index');
    Route::get('endose/create','App\Http\Controllers\EndoseController@create')->name('endose.create');
    Route::get('endose/editar/{endose}','App\Http\Controllers\EndoseController@editar')->name('endose.editar');
    Route::get('endose/ver/{endose}','App\Http\Controllers\EndoseController@ver')->name('endose.ver');
    Route::get('endose/pdf/{endose}','App\Http\Controllers\EndoseController@pdf')->name('endose.pdf');
    Route::get('endose/whatsapp','App\Http\Controllers\EndoseController@whatsapp')->name('endose.whatsapp');

    Route::get('operacion/otros', 'App\Http\Controllers\OperarOtrosController@index')->name('operacion.otros');
    Route::get('operacion/create-otros', 'App\Http\Controllers\OperarOtrosController@create')->name('operacion.create-otros');

    Route::get('operacion/traslados', 'App\Http\Controllers\OperarController@operaciontraslado')->name('operacion.traslados');
    Route::get('operacion/traslados-semaforo', 'App\Http\Controllers\OperarController@operaciontrasladosemaforo')->name('operacion.trasladossemaforo');
    Route::get('operacion/crear-operacion-traslado', 'App\Http\Controllers\OperarController@crearoperaciontraslado')->name('operacion.crearoperaciontraslado');
    Route::get('operacion/editar-operacion-traslado/{operacion}', 'App\Http\Controllers\OperarController@editaroperaciontraslado')->name('operacion.editaroperaciontraslado');
    Route::get('operacion/ver-operacion-traslado/{operacion}', 'App\Http\Controllers\OperarController@veroperaciontraslado')->name('operacion.veroperaciontraslado');
    Route::get('operacion/descargar-operacion-traslado/{operacion}', 'App\Http\Controllers\OperarController@descargaroperaciontraslado')->name('operacion.descargaroperaciontraslado');
    Route::get('operacion/whatsapp-operacion-traslado', 'App\Http\Controllers\OperarController@whatsappoperaciontraslado')->name('operacion.whatsappoperaciontraslado');
    Route::get('operacion/notificar-pdf-operacion-traslado', 'App\Http\Controllers\OperarController@notificarpdfoperaciontraslado')->name('operacion.notificarpdfoperaciontraslado');
    Route::get('operacion/incidencia-operacion-traslado/{operacion}', 'App\Http\Controllers\OperarController@incidenciaoperaciontraslado')->name('operacion.incidenciaoperaciontraslado');
    Route::get('operacion/traslados-overview', 'App\Http\Controllers\OperarController@trasladosoverview')->name('operacion.trasladosoverview');

    Route::get('operacion/hotel', 'App\Http\Controllers\OperarController@operacionhotel')->name('operacion.hotel');
    Route::get('operacion/crear-operacion-hotel', 'App\Http\Controllers\OperarController@crearoperacionhotel')->name('operacion.crearoperacionhotel');
    Route::get('operacion/editar-operacion-hotel', 'App\Http\Controllers\OperarController@editaroperacionhotel')->name('operacion.editaroperacionhotel');
    Route::get('operacion/agregar-pago-hotel', 'App\Http\Controllers\OperarController@agregarpagohotel')->name('operacion.agregarpagohotel');
    Route::get('operacion/realizar-pago-hotel', 'App\Http\Controllers\OperarController@realizarpagohotel')->name('operacion.realizarpagohotel');
    Route::get('operacion/ver-hotel', 'App\Http\Controllers\OperarController@verhotel')->name('operacion.verhotel');
    Route::get('operacion/createhotel', 'App\Http\Controllers\OperarController@createhotel')->name('operacion.createhotel');
    Route::get('operacion/createhotelreserva', 'App\Http\Controllers\OperarController@createhotelreserva')->name('operacion.createhotelreserva');

    Route::get('operacion/tours', 'App\Http\Controllers\OperarController@operaciontours')->name('operacion.tours');
    Route::get('operacion/createtours/{servicio?}/{fecha?}', 'App\Http\Controllers\OperarController@createtours')->name('operacion.createtours');
    Route::get('operacion/editartours/{operar}', 'App\Http\Controllers\OperarController@editaroperaciontours')->name('operacion.editaroperaciontours');
    Route::get('operacion/showtour/{operar}', 'App\Http\Controllers\OperarController@operarshowtour')->name('operacion.operarshowtour');
    Route::get('operacion/pdf/{operar}', 'App\Http\Controllers\OperarController@pdf')->name('operacion.pdf');
    Route::get('operacion/pdfrestaurant/{operar}', 'App\Http\Controllers\OperarController@pdfrestaurant')->name('operacion.pdfrestaurant');
    Route::get('operacion/whatsapp-operacion-tour', 'App\Http\Controllers\OperarController@whatsappoperaciontour')->name('operacion.whatsappoperaciontour');

    Route::get('operacion/machupicchu', 'App\Http\Controllers\MachupicchuController@operacionmachupicchu')->name('operacion.machupicchu');
    Route::get('operacion/createmachupicchu/{servicio?}/{fecha?}', 'App\Http\Controllers\MachupicchuController@createmachupicchu')->name('operacion.createmachupicchu');
    Route::get('operacion/editarmachupicchu/{operar}', 'App\Http\Controllers\MachupicchuController@editarmachupicchu')->name('operacion.editarmachupicchu');
    Route::get('operacion/showmachupicchu/{operar}', 'App\Http\Controllers\MachupicchuController@showmachupicchu')->name('operacion.showmachupicchu');
    Route::get('operacion/machupicchupdf/{operar}', 'App\Http\Controllers\MachupicchuController@machupicchupdf')->name('operacion.machupicchupdf');
    Route::get('operacion/whatsapp-operacion-machupicchu', 'App\Http\Controllers\MachupicchuController@whatsappoperacionmachupicchu')->name('operacion.whatsappoperacionmachupicchu');

    Route::get('operacion/vuelos', 'App\Http\Controllers\OperarController@operacionvuelos')->name('operacion.vuelos');
    Route::post('operacion/vuelonumero', 'App\Http\Controllers\OperarController@vuelonumero')->name('operacion.vuelonumero');
    Route::post('operacion/hotelnumero', 'App\Http\Controllers\OperarController@hotelnumero')->name('operacion.hotelnumero');
    Route::post('operacion/hotelconfirmar', 'App\Http\Controllers\OperarController@hotelconfirmar')->name('operacion.hotelconfirmar');
    Route::post('operacion/vueloconfirmar', 'App\Http\Controllers\OperarController@vueloconfirmar')->name('operacion.vueloconfirmar');
    Route::get('operacion/createtoursendose', 'App\Http\Controllers\OperarController@createtoursendose')->name('operacion.createtoursendose');
    Route::get('operacion/createvuelos', 'App\Http\Controllers\OperarController@createvuelos')->name('operacion.createvuelos');
    Route::get('operacion/notificarhotel/{operacion}', 'App\Http\Controllers\OperarController@notificarhotel')->name('operacion.notificarhotel');
    Route::get('operacion/notificarvuelo/{reserva}', 'App\Http\Controllers\OperarController@notificarvuelo')->name('operacion.notificarvuelo');
    Route::get('operacion/showtour/{operar}', 'App\Http\Controllers\OperarController@operarshowtour')->name('operacion.operarshowtour');
    Route::get('operacion/pdf/{operar}', 'App\Http\Controllers\OperarController@pdf')->name('operacion.pdf');

    Route::resource('paquete', App\Http\Controllers\PaqueteController::class)->except(['show'])->names('paquete')->parameters(['paquete' => 'paquete']);
    Route::get('paquete/cotizaciones', 'App\Http\Controllers\PaqueteController@cotizaciones')->name('paquete.cotizaciones');
    Route::get('paquete/duplicar/{id}', 'App\Http\Controllers\PaqueteController@duplicar')->name('paquete.duplicar');
    Route::get('paquete/pdf/{id}', 'App\Http\Controllers\PaqueteController@pdf')->name('paquete.pdf');
    Route::get('paquete/pdfvista/{id}', 'App\Http\Controllers\PaqueteController@pdfvista')->name('paquete.pdfvista');
    Route::get('paquete/pdfvistaprecio', 'App\Http\Controllers\PaqueteController@pdfvistaprecio')->name('paquete.pdfvistaprecio');
    Route::get('paquete/viewcliente/{paquete}', 'App\Http\Controllers\PaqueteController@viewcliente')->name('paquete.viewcliente');
    Route::post('paquetevender', 'App\Http\Controllers\PaqueteController@vender')->name('paquete.vender');
    Route::get('paquetelink', 'App\Http\Controllers\PaqueteController@link')->name('paquete.link');

    Route::get('calendario/hotel', 'App\Http\Controllers\PaqueteController@calendariohotel')->name('calendario.hotel');
    Route::get('calendario/tours', 'App\Http\Controllers\PaqueteController@calendariotours')->name('calendario.tours');
    Route::get('calendario/vuelos', 'App\Http\Controllers\PaqueteController@calendariovuelos')->name('calendario.vuelos');
    
    Route::get('reserva/pdfvoucher/{reserva}', 'App\Http\Controllers\ReservaController@pdfvoucher')->name('reserva.pdfvoucher');
    Route::get('reserva/devolucion/{reserva}/{tipo}', 'App\Http\Controllers\ReservaController@devolucion')->name('reserva.devolucion');
    Route::get('reserva/proforma/{reserva}', 'App\Http\Controllers\ReservaController@proforma')->name('reserva.proforma');
    Route::get('reserva/pdfvoucheroficina/{reserva}', 'App\Http\Controllers\ReservaController@pdfvoucheroficina')->name('reserva.pdfvoucheroficina');
    Route::get('reserva/voucheroficina/{reserva}', 'App\Http\Controllers\ReservaController@voucheroficina')->name('reserva.voucheroficina');
    Route::post('reserva/agregarPago', 'App\Http\Controllers\ReservaController@agregarPago')->name('reserva.agregarpago');
    Route::get('reserva/createcotizacion', 'App\Http\Controllers\ReservaController@createcotizacion')->name('reserva.createcotizacion');
    Route::get('reserva/editcotizacion/{reserva}', 'App\Http\Controllers\ReservaController@editcotizacion')->name('reserva.editcotizacion');
    
    Route::post('reserva/bibliaoperar/', 'App\Http\Controllers\ReservaController@bibliaoperar')->name('reserva.bibliaoperar');
    Route::get('reserva/pdfitinerario/{id}', 'App\Http\Controllers\ReservaController@pdfitinerario')->name('reserva.pdfitinerario');
    Route::get('reserva/pdfitinerariopaquete/{id}', 'App\Http\Controllers\ReservaController@pdfitinerariopaquete')->name('reserva.pdfitinerariopaquete');


    Route::get('biblia/overview', 'App\Http\Controllers\ReservaController@overview')->name('biblia.overview');
    Route::get('biblia/biblia/', 'App\Http\Controllers\ReservaController@biblia')->name('biblia.biblia');
    Route::get('reserva/sinconfirmar/', 'App\Http\Controllers\ReservaController@sinconfirmar')->name('reserva.sinconfirmar');
    Route::get('reserva/sinfecha/', 'App\Http\Controllers\ReservaController@sinfecha')->name('reserva.sinfecha');
    Route::get('reserva/createsinfecha', 'App\Http\Controllers\ReservaController@createsinfecha')->name('reserva.createsinfecha');
    Route::get('reserva/editsinfecha/{reserva}', 'App\Http\Controllers\ReservaController@editsinfecha')->name('reserva.editsinfecha');
    Route::get('reserva/notificar/{reserva}', 'App\Http\Controllers\PaqueteController@notificar')->name('reserva.notificar');
    Route::get('reserva/notificarsincofirmar/{reserva}', 'App\Http\Controllers\PaqueteController@notificarsincofirmar')->name('reserva.notificarsincofirmar');
    Route::resource('reserva', App\Http\Controllers\ReservaController::class)->except('show')->names('reserva');


    Route::resource('liquidacion', App\Http\Controllers\LiquidacionController::class)->except('show', 'index')->names('liquidacion');
    Route::get('liquidacion/ingreso', [App\Http\Controllers\LiquidacionController::class, 'ingreso'])->name('liquidacion.ingreso');
    Route::get('liquidacion/salida', [App\Http\Controllers\LiquidacionController::class, 'salida'])->name('liquidacion.salida');
    Route::get('liquidacion/ingresocreate', [App\Http\Controllers\LiquidacionController::class, 'ingresocreate'])->name('liquidacion.ingresocreate');
    Route::get('liquidacion/salidacreate', [App\Http\Controllers\LiquidacionController::class, 'salidacreate'])->name('liquidacion.salidacreate');
    Route::get('liquidacion/ver/{liquidacion}', [App\Http\Controllers\LiquidacionController::class, 'ver'])->name('liquidacion.ver');
    Route::get('liquidacion/pdf/{liquidacion}', [App\Http\Controllers\LiquidacionController::class, 'pdf'])->name('liquidacion.pdf');
    Route::get('liquidacion/pagar/{liquidacion}', [App\Http\Controllers\LiquidacionController::class, 'pagar'])->name('liquidacion.pagar');

    Route::get('reportes/reservas', [App\Http\Controllers\ReportesController::class,'reservas'])->name('reportes.reservas');
    Route::get('reportes/reservas-pdf', [App\Http\Controllers\ReportesController::class,'reservaspdf'])->name('reportes.reservaspdf');
    Route::get('reportes/reservas-excel', [App\Http\Controllers\ReportesController::class,'reservasexcel'])->name('reportes.reservasexcel');
    Route::get('reportes/tours', [App\Http\Controllers\ReportesController::class,'tours'])->name('reportes.tours');
    Route::get('reportes/tours-pdf', [App\Http\Controllers\ReportesController::class,'tourspdf'])->name('reportes.tourspdf');
    Route::get('reportes/tours-excel', [App\Http\Controllers\ReportesController::class,'toursexcel'])->name('reportes.toursexcel');
    Route::get('reportes/files', [App\Http\Controllers\ReportesController::class,'files'])->name('reportes.files');
    Route::get('reportes/files-pdf', [App\Http\Controllers\ReportesController::class,'filespdf'])->name('reportes.filespdf');
    Route::get('reportes/files-excel', [App\Http\Controllers\ReportesController::class,'filesexcel'])->name('reportes.filesexcel');



    Route::get('facturacionticket/pdf/', [App\Http\Controllers\PaqueteController::class, 'facturacion'])->name('facturacionticket.pdf');


    Route::post('agradecimiento', 'App\Http\Controllers\PaqueteController@agradecimiento')->name('agradecimiento');

    Route::group(['prefix' => 'error'], function () {
        Route::get('404', function () {
            return view('pages.error.404');
        });
        Route::get('500', function () {
            return view('pages.error.500');
        });
    });
});

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Administrador']);

        // $role = Role::where('name', 'Administrador')->first();
        Permission::create(['name'=>'dashboard','description'=>'Visualizar Dashboard','modulo'=>'Configuracion'])->assignRole($role);
        Permission::create(['name'=>'user.index','description'=>'Ver Listado de Usuarios','modulo'=>'Usuario'])->assignRole($role);
        Permission::create(['name'=>'user.edit','description'=>'Editar Usuario','modulo'=>'Usuario'])->assignRole($role);
        Permission::create(['name'=>'user.create','description'=>'Crear Usuario','modulo'=>'Usuario'])->assignRole($role);
        Permission::create(['name'=>'user.destroy','description'=>'Eliminar Usuario','modulo'=>'Usuario'])->assignRole($role);
        Permission::create(['name'=>'user.show','description'=>'Ver información Usuario','modulo'=>'Usuario'])->assignRole($role);

        Permission::create(['name'=>'guia.index','description'=>'Ver Listado de Guias','modulo'=>'Guia'])->assignRole($role);
        Permission::create(['name'=>'guia.edit','description'=>'Editar Guia','modulo'=>'Guia'])->assignRole($role);
        Permission::create(['name'=>'guia.create','description'=>'Crear Guia','modulo'=>'Guia'])->assignRole($role);
        Permission::create(['name'=>'guia.destroy','description'=>'Eliminar Guia','modulo'=>'Guia'])->assignRole($role);
        Permission::create(['name'=>'guia.show','description'=>'Ver información Guia','modulo'=>'Guia'])->assignRole($role);

        Permission::create(['name'=>'etiqueta.index','description'=>'Ver Listado de Etiquetas','modulo'=>'Etiqueta'])->assignRole($role);
        Permission::create(['name'=>'etiqueta.edit','description'=>'Editar Etiqueta','modulo'=>'Etiqueta'])->assignRole($role);
        Permission::create(['name'=>'etiqueta.create','description'=>'Crear Etiqueta','modulo'=>'Etiqueta'])->assignRole($role);
        Permission::create(['name'=>'etiqueta.destroy','description'=>'Eliminar Etiqueta','modulo'=>'Etiqueta'])->assignRole($role);

        Permission::create(['name'=>'categoria.index','description'=>'Ver Listado de Categorias','modulo'=>'Categoria'])->assignRole($role);
        Permission::create(['name'=>'categoria.edit','description'=>'Editar Categoria','modulo'=>'Categoria'])->assignRole($role);
        Permission::create(['name'=>'categoria.create','description'=>'Crear Categoria','modulo'=>'Categoria'])->assignRole($role);
        Permission::create(['name'=>'categoria.destroy','description'=>'Eliminar Categoria','modulo'=>'Categoria'])->assignRole($role);

        Permission::create(['name'=>'precio.index','description'=>'Ver Listado de Precios','modulo'=>'Precio'])->assignRole($role);
        Permission::create(['name'=>'precio.edit','description'=>'Editar Precio','modulo'=>'Precio'])->assignRole($role);
        Permission::create(['name'=>'precio.destroy','description'=>'Eliminar Precio','modulo'=>'Precio'])->assignRole($role);
        Permission::create(['name'=>'precio.create','description'=>'Crear Precio','modulo'=>'Precio'])->assignRole($role);

        Permission::create(['name'=>'hotel.index','description'=>'Ver Listado de Hoteles','modulo'=>'Hotel'])->assignRole($role);
        Permission::create(['name'=>'hotel.edit','description'=>'Editar Hotel','modulo'=>'Hotel'])->assignRole($role);
        Permission::create(['name'=>'hotel.destroy','description'=>'Eliminar Hotel','modulo'=>'Hotel'])->assignRole($role);
        Permission::create(['name'=>'hotel.create','description'=>'Crear Hotel','modulo'=>'Hotel'])->assignRole($role);

        Permission::create(['name'=>'ubicacion.index','description'=>'Ver Listado de Ubicaciones','modulo'=>'Ubicacion'])->assignRole($role);
        Permission::create(['name'=>'ubicacion.edit','description'=>'Editar Ubicacion','modulo'=>'Ubicacion'])->assignRole($role);
        Permission::create(['name'=>'ubicacion.create','description'=>'Crear Ubicacion','modulo'=>'Ubicacion'])->assignRole($role);
        Permission::create(['name'=>'ubicacion.destroy','description'=>'Eliminar Ubicacion','modulo'=>'Ubicacion'])->assignRole($role);
        Permission::create(['name'=>'ubicacion.show','description'=>'Ver información Ubicacion','modulo'=>'Ubicacion'])->assignRole($role);

        Permission::create(['name'=>'servicio.index','description'=>'Ver Listado de Servicios','modulo'=>'Servicio'])->assignRole($role);
        Permission::create(['name'=>'servicio.hotel','description'=>'Ver Listado de Servicios Hotel','modulo'=>'Servicio'])->assignRole($role);
        Permission::create(['name'=>'servicio.vuelo','description'=>'Ver Listado de Servicios Vuelos','modulo'=>'Servicio'])->assignRole($role);
        Permission::create(['name'=>'servicio.otros','description'=>'Ver Listado de Servicios Otros','modulo'=>'Servicio'])->assignRole($role);
        Permission::create(['name'=>'servicio.edit','description'=>'Editar Servicio','modulo'=>'Servicio'])->assignRole($role);
        Permission::create(['name'=>'servicio.create','description'=>'Crear Servicio','modulo'=>'Servicio'])->assignRole($role);
        Permission::create(['name'=>'servicio.destroy','description'=>'Eliminar Servicio','modulo'=>'Servicio'])->assignRole($role);
        Permission::create(['name'=>'servicio.show','description'=>'Ver información Servicio','modulo'=>'Servicio'])->assignRole($role);

        Permission::create(['name'=>'paquete.index','description'=>'Ver Listado de Paquetes','modulo'=>'Paquete'])->assignRole($role);
        Permission::create(['name'=>'paquete.edit','description'=>'Editar Paquete','modulo'=>'Paquete'])->assignRole($role);
        Permission::create(['name'=>'paquete.create','description'=>'Crear Paquete','modulo'=>'Paquete'])->assignRole($role);
        Permission::create(['name'=>'paquete.destroy','description'=>'Eliminar Paquete','modulo'=>'Paquete'])->assignRole($role);
        Permission::create(['name'=>'paquete.show','description'=>'Ver información Paquete','modulo'=>'Paquete'])->assignRole($role);
        Permission::create(['name'=>'paquete.duplicate','description'=>'Duplicar Paquete','modulo'=>'Paquete'])->assignRole($role);
        Permission::create(['name'=>'paquete.pdf','description'=>'PDF Paquete','modulo'=>'Paquete'])->assignRole($role);

        Permission::create(['name'=>'calendario.hotel','description'=>'Calendario Hotel','modulo'=>'Paquete'])->assignRole($role);
        Permission::create(['name'=>'calendario.tours','description'=>'Calendario Tours','modulo'=>'Paquete'])->assignRole($role);
        Permission::create(['name'=>'calendario.vuelos','description'=>'Calendario Vuelos','modulo'=>'Paquete'])->assignRole($role);

        Permission::create(['name'=>'reserva.index','description'=>'Ver Listado de Reservas','modulo'=>'Reserva'])->assignRole($role);
        Permission::create(['name'=>'reserva.edit','description'=>'Editar Reserva','modulo'=>'Reserva'])->assignRole($role);
        Permission::create(['name'=>'reserva.create','description'=>'Crear Reserva','modulo'=>'Reserva'])->assignRole($role);
        Permission::create(['name'=>'reserva.destroy','description'=>'Eliminar Reserva','modulo'=>'Reserva'])->assignRole($role);
        Permission::create(['name'=>'reserva.show','description'=>'Ver información Reserva','modulo'=>'Reserva'])->assignRole($role);

        Permission::create(['name'=>'medio.index','description'=>'Ver Listado de Medios','modulo'=>'Medio'])->assignRole($role);
        Permission::create(['name'=>'medio.edit','description'=>'Editar Medio','modulo'=>'Medio'])->assignRole($role);
        Permission::create(['name'=>'medio.create','description'=>'Crear Medio','modulo'=>'Medio'])->assignRole($role);
        Permission::create(['name'=>'medio.destroy','description'=>'Eliminar Medio','modulo'=>'Medio'])->assignRole($role);

        Permission::create(['name'=>'cupon.index','description'=>'Ver Listado de Cupones','modulo'=>'Cupon'])->assignRole($role);
        Permission::create(['name'=>'cupon.edit','description'=>'Editar Cupon','modulo'=>'Cupon'])->assignRole($role);
        Permission::create(['name'=>'cupon.create','description'=>'Crear Cupon','modulo'=>'Cupon'])->assignRole($role);
        Permission::create(['name'=>'cupon.destroy','description'=>'Eliminar Cupon','modulo'=>'Cupon'])->assignRole($role);

        Permission::create(['name'=>'proveedor.index','description'=>'Ver Listado de Proveedores','modulo'=>'Proveedor'])->assignRole($role);
        Permission::create(['name'=>'proveedor.edit','description'=>'Editar Proveedor','modulo'=>'Proveedor'])->assignRole($role);
        Permission::create(['name'=>'proveedor.create','description'=>'Crear Proveedor','modulo'=>'Proveedor'])->assignRole($role);
        Permission::create(['name'=>'proveedor.destroy','description'=>'Eliminar Proveedor','modulo'=>'Proveedor'])->assignRole($role);

        Permission::create(['name'=>'operacion.index','description'=>'Ver Listado de Operaciones','modulo'=>'Operacion'])->assignRole($role);
        Permission::create(['name'=>'operacion.edit','description'=>'Editar Operacion','modulo'=>'Operacion'])->assignRole($role);
        Permission::create(['name'=>'operacion.create','description'=>'Crear Operacion','modulo'=>'Operacion'])->assignRole($role);
        Permission::create(['name'=>'operacion.destroy','description'=>'Eliminar Operacion','modulo'=>'Operacion'])->assignRole($role);
        Permission::create(['name'=>'operacion.show','description'=>'Ver información Operacion','modulo'=>'Operacion'])->assignRole($role);

        Permission::create(['name'=>'notificacion.index','description'=>'Ver Listado de Notificaciones','modulo'=>'Notificación'])->assignRole($role);
        Permission::create(['name'=>'notificacion.edit','description'=>'Editar Notificación','modulo'=>'Notificación'])->assignRole($role);
        Permission::create(['name'=>'notificacion.create','description'=>'Crear Notificación','modulo'=>'Notificación'])->assignRole($role);
        Permission::create(['name'=>'notificacion.destroy','description'=>'Eliminar Notificación','modulo'=>'Notificación'])->assignRole($role);

        Permission::create(['name'=>'pdfdatos.index','description'=>'Ver Listado de PDF Datos','modulo'=>'PDF Datos'])->assignRole($role);
        Permission::create(['name'=>'pdfdatos.edit','description'=>'Editar PDF Datos','modulo'=>'PDF Datos'])->assignRole($role);
        Permission::create(['name'=>'pdfdatos.create','description'=>'Crear PDF Datos','modulo'=>'PDF Datos'])->assignRole($role);
        Permission::create(['name'=>'pdfdatos.destroy','description'=>'Eliminar PDF Datos','modulo'=>'PDF Datos'])->assignRole($role);

        Permission::create(['name'=>'role.index','description'=>'Ver la lista de Roles','modulo'=>'Roles'])->assignRole($role);
        Permission::create(['name'=>'role.edit','description'=>'Editar Rol','modulo'=>'Roles'])->assignRole($role);
        Permission::create(['name'=>'role.destroy','description'=>'Cambiar de estado Rol','modulo'=>'Roles'])->assignRole($role);
        Permission::create(['name'=>'role.create','description'=>'Crear Rol','modulo'=>'Roles'])->assignRole($role);

        Permission::create(['name'=>'liquidacion.ingreso','description'=>'Listado de Liquidacion de ingreso','modulo'=>'Liquidacion'])->assignRole($role);
        Permission::create(['name'=>'liquidacion.salida','description'=>'Listado de Liquidacion de egreso','modulo'=>'Liquidacion'])->assignRole($role);
        Permission::create(['name'=>'liquidacion.ingresocreate','description'=>'Crear Liquidacion de ingreso','modulo'=>'Liquidacion'])->assignRole($role);
        Permission::create(['name'=>'liquidacion.salidacreate','description'=>'Crear Liquidacion de egreso','modulo'=>'Liquidacion'])->assignRole($role);
        Permission::create(['name'=>'liquidacion.ver','description'=>'Ver Liquidacion','modulo'=>'Liquidacion'])->assignRole($role);
        Permission::create(['name'=>'liquidacion.edit','description'=>'Editar Liquidacion','modulo'=>'Liquidacion'])->assignRole($role);
        Permission::create(['name'=>'liquidacion.destroy','description'=>'Liquidacion Anular','modulo'=>'Liquidacion'])->assignRole($role);

        Permission::create(['name'=>'reportes.reservas','description'=>'Reporte de Reservas','modulo'=>'Reportes'])->assignRole($role);
        Permission::create(['name'=>'reportes.tours','description'=>'Reporte de Tours','modulo'=>'Reportes'])->assignRole($role);
    }
}

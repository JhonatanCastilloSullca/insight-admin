<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Proveedor::create([
            'nombre'        => 'Proveedor Movil 1',
            'celular'       => '939383158',
            'direccion'     => 'Plaza de Armas S/N',
            'categoria_id'   => 7,
            'estado'        => '1',
        ]);
        Proveedor::create([
            'nombre'        => 'Proveedor Movil 2',
            'celular'       => '939383158',
            'direccion'     => 'Plaza de Armas S/N',
            'categoria_id'   => 7,
            'estado'        => '1',
        ]);
        Proveedor::create([
            'nombre'        => 'Proveedor Guias',
            'celular'       => '939383158',
            'direccion'     => 'Plaza de Armas S/N',
            'categoria_id'   => 9,
            'estado'        => '1',
        ]);

        Proveedor::create([
            'nombre'        => 'Proveedor Ingresos',
            'celular'       => '939383158',
            'direccion'     => 'Plaza de Armas S/N',
            'categoria_id'   => 4,
            'estado'        => '1',
        ]);
        Proveedor::create([
            'nombre'        => 'Proveedor Hotel 1',
            'celular'       => '939383158',
            'direccion'     => 'Plaza de Armas S/N',
            'categoria_id'   => 2,
            'email'         =>  'dmirandatarco@gmail.com',
            'estado'        => '1',
        ]);

        Proveedor::create([
            'nombre'        => 'Proveedor Hotel 2',
            'celular'       => '939383158',
            'direccion'     => 'Plaza de Armas S/N',
            'categoria_id'   => 2,
            'email'         =>  'jcastillosullca@gmail.com',
            'estado'        => '1',
        ]);
        Proveedor::create([
            'nombre'        => 'Proveedor Turista',
            'celular'       => '939383158',
            'direccion'     => 'Plaza de Armas S/N',
            'categoria_id'   => 11,
            'email'         =>  'jcastillosullca@gmail.com',
            'estado'        => '1',
        ]);







    }
}

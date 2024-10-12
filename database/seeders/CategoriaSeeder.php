<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;


class CategoriaSeeder extends Seeder
{


    public function run()
    {
        Categoria::create([
            'nombre'    =>  'SERVICIOS',
            'detalle'          => '0',
        ]);
        Categoria::create([
            'nombre'    =>  'HOTEL',
            'detalle'          => '1',
        ]);
        Categoria::create([
            'nombre'    =>  'VUELO',
        ]);
        Categoria::create([
            'nombre'    =>  'OTROS',
            'detalle'          => '0',
        ]);
        Categoria::create([
            'nombre'        =>  'TOURS',
            'categoria_id'    =>  '1',
        ]);
        Categoria::create([
            'nombre'        =>  'RECOJOS',
            'categoria_id'    =>  '1',
        ]);
        Categoria::create([
            'nombre'        =>  'UNA ESTRELLA',
            'categoria_id'    =>  '2',
            'detalle'          => '0',
        ]);

        Categoria::create([
            'nombre'        =>  'DOS ESTRELLAS',
            'categoria_id'    =>  '2',
            'detalle'          => '0',
        ]);

        Categoria::create([
            'nombre'        =>  'TRES ESTRELLAS',
            'categoria_id'    =>  '2',
            'detalle'          => '0',
        ]);

        Categoria::create([
            'nombre'        =>  'CUATRO ESTRELLAS',
            'categoria_id'    =>  '2',
            'detalle'          => '0',
        ]);

        Categoria::create([
            'nombre'        =>  'CINCO ESTRELLAS',
            'categoria_id'    =>  '2',
            'detalle'          => '0',
        ]);

        Categoria::create([
            'nombre'        =>  'BOUTIQUE',
            'categoria_id'    =>  '2',
            'detalle'          => '0',
        ]);
        Categoria::create([
            'nombre'        =>  'TRANSPORTE',
            'categoria_id'    =>  '4',
        ]);
        Categoria::create([
            'nombre'        =>  'ALIMENTACION',
            'categoria_id'    =>  '4',
        ]);
        Categoria::create([
            'nombre'        =>  'GUIA',
            'categoria_id'    =>  '4',
        ]);
        Categoria::create([
            'nombre'        =>  'OTROS',
            'categoria_id'    =>  '4',
            'detalle'          => '1',
        ]);
        Categoria::create([
            'nombre'        =>  'TICKETS',
            'categoria_id'    =>  '4',
        ]);
        Categoria::create([
            'nombre'        =>  'AGENCIAS',
            'categoria_id'    =>  '5',
        ]);
    }
}

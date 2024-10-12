<?php

namespace Database\Seeders;

use App\Models\Documento;
use App\Models\Pasajero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasajeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Documento::create([
            'tipo_documento'    =>  'DNI',
            'num_documento'     =>  '48507552',
        ]);
        Pasajero::create([

            'nombres'           =>  'Pasajero Jhonatan',
            'genero'            =>  'MASCULINO',
            'nacimiento'        =>  '1983-01-17',
            'celular'           =>  '939383158',
            'email'             =>  'pasajerojhonatan@gmail.com',
            'tarifa'            =>  'ADULTO',
            'pais_id'           =>  1,
            'documento_id'      =>  2,
            'imagen'            =>  'DNI-48507552.jpg',
            'comentario'        =>  'Pasajero con alergia al mani',
        ]);
    }
}

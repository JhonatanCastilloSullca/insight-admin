<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ubicacion;


class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ubicacion::create([
            'nombre'    =>  'CUSCO',
            'imagen'    =>  '/storage/ubicaciones/default.png',
        ]);
        Ubicacion::create([
            'nombre'    =>  'LIMA',
            'imagen'    =>  '/storage/ubicaciones/default.png',
        ]);
        Ubicacion::create([
            'nombre'    =>  'PUNO',
            'imagen'    =>  '/storage/ubicaciones/default.png',
        ]);
        Ubicacion::create([
            'nombre'    =>  'ICA',
            'imagen'    =>  '/storage/ubicaciones/default.png',
        ]);
        Ubicacion::create([
            'nombre'    =>  'AGUAS CALIENTES',
            'imagen'    =>  '/storage/ubicaciones/default.png',
        ]);
        Ubicacion::create([
            'nombre'    =>  'NAZCA',
            'imagen'    =>  '/storage/ubicaciones/default.png',
        ]);
    }
}

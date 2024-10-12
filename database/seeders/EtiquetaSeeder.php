<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Etiqueta;


class EtiquetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Etiqueta::create([
            'nombre'    =>  'tradicional',
        ]);
        Etiqueta::create([
            'nombre'    =>  'caminata',
        ]);
        Etiqueta::create([
            'nombre'    =>  'aventura',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Medio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medio::create([
            'nombre'    =>  'EFECTIVO',
            'descripcion'    =>  'EFECTIVO',
            'moneda_id'    =>  '1',
        ]);

        Medio::create([
            'nombre'    =>  'EFECTIVO',
            'descripcion'    =>  'EFECTIVO',
            'moneda_id'    =>  '2',
        ]);

        Medio::create([
            'nombre'    =>  'IZIPAY',
            'descripcion'    =>  'IZIPAY',
            'moneda_id'    =>  '2',
        ]);

        Medio::create([
            'nombre'    =>  'IZIPAY',
            'descripcion'    =>  'IZIPAY',
            'moneda_id'    =>  '1',
        ]);
    }
}

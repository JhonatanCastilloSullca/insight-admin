<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Operar;

class OperarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Operar::create([
            'fecha'             =>  '2024-01-29',
            'cantidad_pax'      =>  '3',
            'observacion'       =>  'Silla de ruedas',
            'precio'            =>  '80',
            'servicio_id'       =>  '62',
            'user_id'           =>  '1',
            'estado'            =>  '1',
        ]);
    }
}

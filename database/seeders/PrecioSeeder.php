<?php

namespace Database\Seeders;

use App\Models\Precio;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrecioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Precio::create([
            'nombre' => 'ADULTO',
            'default' => 0,
            'estado' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Precio::create([
            'nombre' => 'NIÑO',
            'default' => 0,
            'estado' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

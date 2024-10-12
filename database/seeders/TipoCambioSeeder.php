<?php

namespace Database\Seeders;

use App\Models\TipoCambio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoCambioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TipoCambio::create([
            'precioCompra' => 3.50,
            'precioVenta' => 3.70,  
            'fecha' => now(),       
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'razon_social' => "A.V.T. JISA ADVENTURE E.I.R.L.",
            'ruc' => "20600769317",
            'direccion' => "CAL. GARCUKASI NRO. 265 INT. 12",
            'sol_user' => "48507551",
            'sol_pass' => "Goptics2024",
            'client_id' => null,
            'client_secret' => null,
            'distrito' => "CUSCO", 
            'provincia' => "CUSCO", 
            'departamento' => "CUSCO", 
            'ubigeo' => "080101", 
            'production' => 0,
        ]);
    }
}

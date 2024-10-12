<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aeropuertos;


class AeropuertoSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $aeropuertos = [

            ["Cusco / Cusco","CUZ","Aeropuerto Internacional Alejandro Velasco Astete"],
            ["Iquitos / Loreto","IQT","Aeropuerto Internacional Coronel FAP Francisco Secada Vignetta"],
            ["Lima / Callao	Callao","LIM","Aeropuerto Internacional Jorge Chávez"],
            ["Arequipa / Arequipa","AQP","Aeropuerto Internacional Rodríguez Ballón"],
            ["Piura / Piura","PIU","Aeropuerto Internacional Cap. FAP Guillermo Concha Iberico"],
            ["Ayacucho / Ayacucho","AYP","Aeropuerto Coronel FAP Alfredo Mendívil Duarte"],
            ["Cajamarca / Cajamarca","CJA","Aeropuerto Mayor General FAP Armando Revoredo Iglesias"],
            ["Juliaca / Puno","JUL","Aeropuerto Internacional Inca Manco Cápac"],
            ["Puerto Maldonado / Madre de Dios","PEM","Aeropuerto Internacional Padre Aldamiz"],
            ["Tacna / Tacna","TCQ","Aeropuerto Internacional Crnl. FAP Carlos Ciriani Santa Rosa"],
            ["Tarapoto / San Martín","TPP","Aeropuerto Cad. FAP Guillermo del Castillo Paredes"],
            ["Trujillo / La Libertad","TRU","Aeropuerto Internacional Cap. FAP Carlos Martínez de Pinillos"],
            ["Tumbes / Tumbes","TBP","AeropuertoCap. FAP Pedro Canga Rodríguez"],

        ];

        foreach ($aeropuertos as $elemento) {
            Aeropuertos::create([

                'ciudad'            => $elemento[0],
                'abrev'         => $elemento[1],
                'nombre'       => $elemento[2],
            ]);
        }
    }
}

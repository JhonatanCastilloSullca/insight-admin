<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Paquete;
use App\Models\Servicio;
use App\Models\DetallePaquete;
use App\Models\DetallePaqueteIncluye;
use App\Models\DetallePaqueteNoIncluye;


class PaqueteSeeder extends Seeder
{

    public function run()
    {
        $servicio1 = Servicio::where('id', '60')->first();
        $servicio2 = Servicio::where('id', '61')->first();
        $servicio3 = Servicio::where('id', '62')->first();
        $servicio4 = Servicio::where('id', '63')->first();
        $servicio5 = Servicio::where('id', '64')->first();

        $servicio11 = Servicio::where('id', '69')->first();
        $servicio12 = Servicio::where('id', '68')->first();
        $servicio13 = Servicio::where('id', '67')->first();
        $servicio14 = Servicio::where('id', '66')->first();
        $servicio15 = Servicio::where('id', '65')->first();

            $paquete = Paquete::create([


            'titulo'                =>  'Paquete 2023',
            'mensaje_bienvenida'    =>  'Este es un Mensaje de Bienvenida',
            'fecha_disponibilidad'  =>  '2023-10-20',
            'fecha_inicio'          =>  '2023-10-20',
            'fecha_viaje'           =>  '2023-10-20',
            'fecha_registro'        =>  '2023-10-20',
            'descripcion'           =>  'La región de Cusco ofrece una oportunidad única de explorar monumentos antiguos construidos por la civilización Inca. En este tour visitarás la ciudad de Cusco, el Valle Sagrado de los Incas, la ciudadela de Machu Picchu y la Montaña Arcoíris Vinicunca.',
            'img_principal'         =>  '/paquetes/paquete2023.jpg',
            'publico'               =>  1,
            'precio_soles'          =>  '250.00',
            'precio_dolares'        =>  '250.00',
            'precio_soles_niño'          =>  '250.00',
            'precio_dolares_niño'        =>  '250.00',
            'estado'                =>  1,
            'moneda_id'             =>  1,
            'user_id'               =>  1,
        ]);



        $detallePaquete1 = DetallePaquete::create([
            'paquete_id'            => $paquete->id,
            'servicio_id'           => $servicio1->id,
            'fecha_viaje'           => '2023-10-20',
            'dia_servicio'          => 1,
            'fecha_viajefin'        => '2023-10-22',
            'tipo'                  => 1,
            'preciosoles'           => '150.00',
            'preciodolares'         => '50.00',
        ]);

        $detallePaquete2 = DetallePaquete::create([
            'paquete_id'            => $paquete->id,
            'servicio_id'           => $servicio2->id,
            'fecha_viaje'           => '2023-10-20',
            'fecha_viajefin'        => '2023-10-22',
            'tipo'                  => 1,
            'dia_servicio'          => 2,
            'preciosoles'           => '150.00',
            'preciodolares'         => '50.00',
        ]);

        // Crear detalles de paquete incluidos
        DetallePaqueteIncluye::create([
            'detalle_paquete_id' => $detallePaquete1->id,
            'servicio_incluido_id' => $servicio3->id,
        ]);

        DetallePaqueteIncluye::create([
            'detalle_paquete_id' => $detallePaquete1->id,
            'servicio_incluido_id' => $servicio4->id,
        ]);

        DetallePaqueteIncluye::create([
            'detalle_paquete_id' => $detallePaquete2->id,
            'servicio_incluido_id' => $servicio3->id,
        ]);

        DetallePaqueteIncluye::create([
            'detalle_paquete_id' => $detallePaquete2->id,
            'servicio_incluido_id' => $servicio4->id,
        ]);

        DetallePaqueteIncluye::create([
            'detalle_paquete_id' => $detallePaquete2->id,
            'servicio_incluido_id' => $servicio5->id,
        ]);


        // Crear detalles de paquete incluidos
        DetallePaqueteNoIncluye::create([
            'detalle_paquete_id' => $detallePaquete1->id,
            'servicio_no_incluido_id' => $servicio11->id,
        ]);

        DetallePaqueteNoIncluye::create([
            'detalle_paquete_id' => $detallePaquete1->id,
            'servicio_no_incluido_id' => $servicio12->id,
        ]);

        DetallePaqueteNoIncluye::create([
            'detalle_paquete_id' => $detallePaquete2->id,
            'servicio_no_incluido_id' => $servicio13->id,
        ]);

        DetallePaqueteNoIncluye::create([
            'detalle_paquete_id' => $detallePaquete2->id,
            'servicio_no_incluido_id' => $servicio14->id,
        ]);

        DetallePaqueteNoIncluye::create([
            'detalle_paquete_id' => $detallePaquete2->id,
            'servicio_no_incluido_id' => $servicio15->id,
        ]);
    }
}



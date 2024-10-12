<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notificacion;


class NotificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Notificacion::create([
            'notificacion'  =>  "Realizar Check In de la Reserva N° 1",
            'user_id'       =>  1,
            'estado'        =>  '0',
            'tipo'          =>  '2',
        ]);
        //
        Notificacion::create([
            'notificacion'  =>  "Realizar Check In de la Reserva N° 2",
            'user_id'       =>  1,
            'estado'        =>  '0',
            'tipo'          =>  '2',
        ]);
    }
}



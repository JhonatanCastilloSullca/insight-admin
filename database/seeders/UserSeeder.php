<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Documento;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Documento::create([
            'tipo_documento'    =>  'DNI',
            'num_documento'     =>  '48507551',
        ]);
        User::create([
            'nombre'            =>  'David Miranda Tarco',
            'celular'           =>  '982733597',
            'email'             =>  'dmirandatarco@gmail.com',
            'fecha_nacimiento'  =>  '2023-02-11',
            'fecha_inicio'      =>  '2023-10-16',
            'usuario'           =>  'david',
            'password'          =>  'ideascusco',
            'imagen'            =>  '/storage/usuario/default.png',
            'documento_id'      =>  1,
            'estado'            =>  1,
        ])->assignRole('Administrador');
    }
}

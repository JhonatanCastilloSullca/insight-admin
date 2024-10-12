<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Documento;
use App\Models\Guia;
class GuiaSeeder extends Seeder
{
    public function run()
    {
        Documento::create([
            'tipo_documento'    =>  'DNI',
            'num_documento'     =>  '74890811',
        ]);
        Guia::create([
            'nombre'            =>  'David Miranda Tarco',
            'celular'           =>  '982733597',
            'email'             =>  'dmirandatarco@gmail.com',
            'direccion'         =>  'Av Lechugal 213',
            'imagen'            =>  '/storage/usuario/default.png',
            'documento_id'      =>  2,
            'categoria_id'      =>  1,
            'estado'            =>  1,


        ]);
    }
}

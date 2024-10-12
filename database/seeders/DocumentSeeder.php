<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Document::create([
            'nombre'       =>    'BOLETA DE VENTA ELECTRÓNICA',
            'incremento'   =>    '1',
            'cantidad'    =>    '0',
            'abreviatura'=>    'BV',
            'codSunat'=>    '03',
            'serie'        =>    'B001',
        ]);
        Document::create([
            'nombre'       =>    'FACTURA ELECTRÓNICA',
            'incremento'   =>    '1',
            'cantidad'    =>    '0',
            'abreviatura'=>    'F',
            'codSunat'=>    '01',
            'serie'        =>    'F001',
        ]);
        Document::create([
            'nombre'       =>    'NOTA DE CRÉDITO',
            'incremento'   =>    '1',
            'cantidad'    =>    '0',
            'abreviatura'=>    'BV',
            'codSunat'=>    '07',
            'serie'        =>    'BC01',
        ]);
        Document::create([
            'nombre'       =>    'NOTA DE CRÉDITO',
            'incremento'   =>    '1',
            'cantidad'    =>    '0',
            'abreviatura'=>    'F',
            'codSunat'=>    '07',
            'serie'        =>    'FC01',
        ]);

    }
}

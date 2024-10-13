<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DocumentSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(TipoCambioSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(UbicacionSeeder::class);
        $this->call(MonedaSeed::class);
        $this->call(PrecioSeeder::class);
        
        
        // // $this->call(EtiquetaSeeder::class);
        // $this->call(PaisSeeder::class);
        // $this->call(GuiaSeeder::class);
        // // $this->call(PasajeroSeeder::class);
        // $this->call(MedioSeeder::class);
        // // $this->call(ServicioSeeder::class);
        // // $this->call(PaqueteSeeder::class);
        // // $this->call(PdfDatosSeeder::class);
        // $this->call(AeropuertoSeeder::class);
        // // $this->call(ProveedorSeeder::class);
        // $this->call(PaisesUpdateSeeder::class);
        // $this->call(PaisIncaRailSeeder::class);

        // $this->call(OperarSeeder::class);
        // $this->call(NotificacionSeeder::class);
    }
}

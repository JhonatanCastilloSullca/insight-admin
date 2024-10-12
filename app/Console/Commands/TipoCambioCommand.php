<?php

namespace App\Console\Commands;

use App\Models\TipoCambio;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TipoCambioCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tipocambio:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Guardar Tipo de Cambio';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fechaActual = Carbon::now();
    
        if ($fechaActual->hour < 8) {
            return; 
        }

        $fechaActual = Carbon::now()->format('Y-m-d'); 
        $tipoexiste = TipoCambio::where('fecha',$fechaActual)->first();

        if ($tipoexiste) 
        {
            return;
        }

        $token = config('services.apisunat.token');
        $urldni = config('services.apisunat.urlcambio');
        $response = Http::timeout(10)->withHeaders([
            'Referer' => 'https://api.apis.net.pe',
            'Authorization' => 'Bearer ' . $token
        ])->get($urldni . $fechaActual);
        if ($response->successful()) {
            $fecha = $response->json();

            // Crear un nuevo registro
            $tipo = new TipoCambio();
            $tipo->precioCompra = $fecha['precioCompra'];
            $tipo->precioVenta = $fecha['precioVenta'];
            $tipo->fecha = $fecha['fecha'];
            $tipo->save();
        } else {
            \Log::error('Error en la API: ' . $response->status() . ' - ' . $response->body());
        }
        $fecha = ($response->json());
    }
}

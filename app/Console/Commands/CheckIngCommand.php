<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Notificacion;
use App\Models\Reserva;
use App\Models\Pasajero;

class CheckIngCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notificacion:reserva';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar notificaciones para las reservas';

    /**
     * Execute the console command.
     *
     * @return int
     */
    protected function schedule(Schedule $schedule)
    {
        // Otros comandos programados...

        $schedule->command('notificacion:reserva')->everyMinute();
    }
    public function handle()
    {
        $fechaInicio = Carbon::today();
        $fechaFin = $fechaInicio->copy()->addDays(3);

        $reservas = Reserva::whereBetween('fecha', [$fechaInicio, $fechaFin])->get();

        foreach ($reservas as $reserva) {
            $fechaReserva = Carbon::createFromFormat('Y-m-d H:i:s', $reserva->fecha);
            $fechaHoy = Carbon::today();

            // Calculamos los días faltantes hacia el futuro
            $diasFaltantes = $fechaHoy->diffInDays($fechaReserva, true);

            if ($diasFaltantes >= 0 && $diasFaltantes <= 3) {
                Notificacion::create([
                    'notificacion' => 'Faltan ' . $diasFaltantes . ' días para realizar Check In de la Reserva N° '.$reserva->id,
                    'estado' => '0',
                    'tipo' => '4',
                ]);
            }
        }
    }
}

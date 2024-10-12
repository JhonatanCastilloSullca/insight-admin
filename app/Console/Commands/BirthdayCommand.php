<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Carbon\Carbon;  // Importar Carbon aquí

use App\Models\Notificacion;
use App\Models\Reserva;
use App\Models\Pasajero;

class BirthdayCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notificacion:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creamos una notificacion de Cumpleaños';

    /**
     * Execute the console command.
     *
     * @return int
     */

    protected function schedule(Schedule $schedule)
    {
        // Otros comandos programados...

        $schedule->command('notificacion:create')->everyMinute();
    }

    public function diasParaCumpleanos($fechaNacimiento)
    {
        $fechaNacimiento = Carbon::createFromFormat('Y-m-d', $fechaNacimiento)->startOfDay();
        $fechaHoy = Carbon::now()->startOfDay();
        if ($fechaNacimiento->month < $fechaHoy->month || ($fechaNacimiento->month == $fechaHoy->month && $fechaNacimiento->day < $fechaHoy->day)) {
            $fechaCumpleanosEsteAno = $fechaNacimiento->copy()->year($fechaHoy->year + 1);
        } else {
            $fechaCumpleanosEsteAno = $fechaNacimiento->copy()->year($fechaHoy->year);
        }
        $diasRestantes = $fechaHoy->diffInDays($fechaCumpleanosEsteAno, false);
        return $diasRestantes;
    }
    public function handle()
    {
        $startDay = now()->day;
        $endDay = now()->addDays(3)->day;
        $month = now()->month;

        $pasajeros = Pasajero::where(function ($query) use ($startDay, $endDay, $month) {
                                    $query->whereRaw('DAY(nacimiento) BETWEEN ? AND ?', [$startDay, $endDay])
                                        ->whereRaw('MONTH(nacimiento) = ?', [$month]);
                                })
                                ->get();

        foreach ($pasajeros as $pasajero) {
            $tieneReserva = $pasajero->reservas()
                                    ->where(function ($query) use ($startDay, $endDay, $month) {
                                        $query->whereRaw('DAY(fecha) BETWEEN ? AND ?', [$startDay, $endDay])
                                                ->whereRaw('MONTH(fecha) = ?', [$month]);
                                    })
                                    ->exists();

            if (!$tieneReserva) {
                $diasFaltantes = $this->diasParaCumpleanos($pasajero->nacimiento);
                $notificacion = new Notificacion;
                $notificacion->notificacion = 'Faltan ' . $diasFaltantes . ' días para el cumpleaños de ' . $pasajero->nombres . '!!';
                $notificacion->estado = 0;
                $notificacion->tipo = 3;
                $notificacion->save();
            }
        }

        $this->info('Notificaciones de cumpleaños enviadas con éxito.');
    }
}

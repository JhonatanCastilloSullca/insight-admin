<?php

namespace App\Http\Livewire;

use App\Models\Reserva;
use Carbon\Carbon;
use Livewire\Component;

class Buscador extends Component
{
    public $search;

    public function mount()
    {
        $this->search = session('search') ?? '';
    }
    public function render()
    {
        return view('livewire.buscador');
    }

    public function buscar()
    {
        $reservas = Reserva::query();

        if (strpos($this->search, '-') !== false) {
            // Intentar dividir la búsqueda en día, mes y año
            $fechaParts = explode('-', $this->search);

            if (count($fechaParts) === 4) {
                list($numero, $dia, $mes, $anio) = $fechaParts;
            
                // Crear la fecha completa en formato Y-m-d
                $fechaCompleta = Carbon::createFromFormat('Y-m-d', "$anio-$mes-$dia")->format('Y-m-d');
            
                // Búsqueda por número y fecha
                $reservas->where('numero', $numero)
                    ->where('confirmado', 1)
                    ->whereHas('detallestours', function ($query) use ($fechaCompleta) {
                        $query->whereDate('fecha_viaje', $fechaCompleta);
                    })
                    ->where(function ($query) use ($fechaCompleta) {
                        $query->whereRaw("
                            (SELECT MIN(fecha_viaje) 
                            FROM detalle_reservas 
                            WHERE detalle_reservas.reserva_id = reservas.id) = ?", 
                            [$fechaCompleta]
                        );
                    });
            }
        }

        // Búsqueda por nombre completo
        $nombreCompleto = strtoupper($this->search);

        $reservas->orWhereHas('pasajeros', function ($query) use ($nombreCompleto) {
            $query->whereRaw("UPPER(REPLACE(CONCAT(nombres, ' ', apellidoPaterno, ' ', apellidoMaterno), '  ', ' ')) LIKE ?", ["%$nombreCompleto%"]);
        });

        // Búsqueda por email
        if (!empty($this->search)) {
            $reservas->orWhereHas('pasajeros', function ($query) {
                $query->where('email', $this->search);
            });
        }

        $reservas = $reservas->get();

        if (count($reservas) == 1) {
            $reserva = $reservas->first();
            return redirect()->to('/reserva/voucheroficina/' . $reserva->id)->with('search', $this->search);
        }else{
            return redirect()->to('/reserva?search='.$this->search)->with('search', $this->search);
        }
    }
}

<?php

namespace App\Services;

use App\Models\Historia;
use Carbon\Carbon;

class HistoriaService
{
    protected $changes = [];

    public function addChanges($field,$nuevo,$antiguo)
    {
        $this->changes[] = [
            'campo' => $field,
            'antiguo' => $nuevo ?? null,
            'nuevo' => $antiguo,
        ];
    }

    public function saveChanges($reservaId, $userId = null)
    {
        // Si hay cambios acumulados, guardarlos en la tabla historia
        if (count($this->changes) > 0) {
            Historia::create([
                'reserva_id' => $reservaId,
                'user_id' => $userId ?? \Auth::id(),
                'cambios' => json_encode($this->changes), // Guardar solo los cambios
                'fecha' => Carbon::now('America/Lima')->toDateTimeString(),
            ]);
        }
        $this->changes = [];
    }
}
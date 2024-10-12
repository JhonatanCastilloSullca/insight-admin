<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class IncidenciaController extends Controller
{
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $mytime= Carbon::now('America/Lima');
            $incidencia = new Incidencia();
            $incidencia->descripcion = $request->descripcion;
            $incidencia->cantidad = $request->cantidad;
            $incidencia->operar_id = $request->operar_id;
            $incidencia->moneda_id = $request->moneda_id;
            $incidencia->costo = $request->costo;
            $incidencia->proveedor_id = $request->proveedor_id;
            $incidencia->operar_servicio_id = $request->operar_servicio_id;
            $incidencia->save();

            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }

        return redirect()->back();
    }
}
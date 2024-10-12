<?php

namespace App\Http\Controllers;

use App\Models\Operar;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class OperarOtrosController extends Controller
{
    public function index(Request $request)
    {
        $fechaInicio2 = $request->searchFechaInicio;
        $fechaFin2 = $request->searchFechaFin;
        $proveedor = $request->searchProveedor;

        if(!$request->searchFechaInicio && !$request->searchFechaFin){
            $fechaInicio2 = now()->format('Y-m-d');
            $fechaFin2 = now()->format('Y-m-d');
        }
        $operaciones = Operar::orderBy('fecha', 'desc')->where('otros',1)->whereBetween('fecha', [$request->searchFechaInicio, $fechaFin2]);
        if ($request->filled('searchProveedor')) {
            $operaciones = $operaciones->whereHas('operarServicios', function ($query) use ($proveedor) {
                $query->where('proveedor_id', $proveedor);
            });
        }
        $operaciones = $operaciones->get();
        $proveedores = Proveedor::whereRelation('categoria','categoria_id',)->orderBy('nombre','asc')->get();
        $i = 0;
        return view('pages.operar.otros.index', compact('operaciones', 'i','fechaInicio2','fechaFin2','proveedor','proveedores'));
    }

    public function create()
    {
        return view('pages.operar.otros.create');
    }
}

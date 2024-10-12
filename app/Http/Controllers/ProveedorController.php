<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Http\Requests\ProveedorRequest;
use App\Models\Categoria;
use App\Models\Ubicacion;

class ProveedorController extends Controller
{

    public function index()
    {
        $proveedores = Proveedor::whereRelation('categoria','categoria_id', '!=', '2')->where('detalle_hotel',0)->get();
        $categorias = Categoria::where('detalle', 1)->where('id', '!=', '2')->get();
        $ubicaciones = Ubicacion::all();
        $i = 0;
        return view('pages.proveedor.index', compact('proveedores', 'categorias', 'i','ubicaciones'));
    }

    public function store(ProveedorRequest $request)
    {
        if ($request->id == null) {
            Proveedor::create($request->all());
            return redirect()->route('proveedor.index')->with('success', 'Proveedor Creado Correctamente.');
        } else {
            $proveedor = Proveedor::findOrFail($request->id);
            $proveedor->update($request->all());
            return redirect()->back()->with('success', 'Proveedor Modificado Correctamente.');
        }
    }

    public function update(Request $request) {}

    public function destroy(Request $request)
    {
        $proveedor = Proveedor::findOrFail($request->id_proveedor_2);
        if ($proveedor->estado == "1") {
            $proveedor->estado = '0';
            $proveedor->save();
            return redirect()->back()->with('success', 'Estado de Proveedor Cambiado Correctamente.');
        } else {
            $proveedor->estado = '1';
            $proveedor->save();
            return redirect()->back()->with('success', 'Estado de Proveedor Cambiado Correctamente.');
        }
    }
}

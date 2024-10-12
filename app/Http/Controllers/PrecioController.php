<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrecioRequest;
use App\Models\Categoria;
use App\Models\Precio;
use Illuminate\Http\Request;

class PrecioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:precio.index')->only('index');
        $this->middleware('can:precio.create')->only('store');
        $this->middleware('can:precio.edit')->only('store');
        $this->middleware('can:precio.destroy')->only('destroy');
    }

    public function index()
    {
        $precios=Precio::all();
        $i=0;
        $categorias = Categoria::where('categoria_id',null)->get();
        return view('pages.precio.index',compact('precios','i','categorias'));
    }

    public function store(PrecioRequest $request)
    {
        if($request->id == null){
            $precio=Precio::create($request->all());
        }else{
            $precio=Precio::find($request->id);
            $precio->update($request->all());
        }
        return redirect()->route('precio.index')
            ->with('success', 'Guardado Correctamente.');
    }

    public function destroy(Request $request)
    {
        $precio= Precio::findOrFail($request->id_precio_2);
        $precio->estado= $precio->estado == 1 ? '0':'1';
        $precio->save();
        return redirect()->back()->with('success','Cambiado de estado Correctamente!');
    }
}

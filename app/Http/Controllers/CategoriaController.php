<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\CategoriaRequest;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:categoria.index')->only('index');
        $this->middleware('can:categoria.create')->only('store');
        $this->middleware('can:categoria.destroy')->only('destroy');
    }

    public function index()
    {
        $categorias=Categoria::all();
        $i=0;
        $categoriaspadres = Categoria::where('categoria_id',null)->get();
        return view('pages.categoria.index',compact('categorias','i','categoriaspadres'));
    }

    public function store(CategoriaRequest $request)
    {
        if($request->id == null){
            $categoria=Categoria::create($request->all());
        }else{
            $categoria=Categoria::find($request->id);
            $categoria->update($request->all());
        }
        return redirect()->route('categoria.index')
            ->with('success', 'Guardado Correctamente.');
    }

    public function destroy(Request $request)
    {
        $categoria= Categoria::findOrFail($request->id_categoria_2);
        $categoria->estado= $categoria->estado == 1 ? '0':'1';
        $categoria->save();
        return redirect()->back()->with('success','Categoria Eliminado Correctamente!');
    }
}

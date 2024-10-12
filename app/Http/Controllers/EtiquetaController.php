<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use App\Http\Requests\EtiquetaRequest;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:etiqueta.index')->only('index');
        $this->middleware('can:etiqueta.create')->only('store');
        $this->middleware('can:etiqueta.destroy')->only('destroy');
    }

    public function index()
    {
        $etiquetas=Etiqueta::all();
        $i=0;
        return view('pages.etiqueta.index',compact('etiquetas','i'));
    }

    public function store(EtiquetaRequest $request)
    {
        if($request->id == null){
            $etiqueta=Etiqueta::create($request->all());
        }else{
            $etiqueta=Etiqueta::find($request->id);
            $etiqueta->update($request->all());
        }
        return redirect()->route('etiqueta.index')
            ->with('success', 'Guardado Correctamente.');
    }

    public function destroy(Request $request)
    {
        $etiqueta= Etiqueta::findOrFail($request->id_etiqueta_2);
        $etiqueta->estado= $etiqueta->estado == 1 ? '0':'1';
        $etiqueta->save();
        return redirect()->back()->with('success','Etiqueta Eliminado Correctamente!');
    }
}

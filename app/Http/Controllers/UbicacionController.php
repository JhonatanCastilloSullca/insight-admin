<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use App\Http\Requests\UbicacionRequest;
use App\Models\Image as Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use DB;

class UbicacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ubicacion.index')->only('index');
        $this->middleware('can:ubicacion.create')->only('store');
        $this->middleware('can:ubicacion.destroy')->only('destroy');
    }

    public function index()
    {
        $ubicaciones=Ubicacion::all();
        $i=0;
        return view('pages.ubicacion.index',compact('ubicaciones','i'));
    }

    public function store(UbicacionRequest $request)
    {

        if($request->imagen){
            list($nombre,$extension ) = explode(".", $request->imagen);
            $imagen='ubicacion-'.Str::slug($request->nombre,'-').'.'.$extension;
            Storage::move('livewire-tmp/'.$request->imagen, 'ubicaciones/'.$imagen);
            $ruta='ubicaciones/'.$imagen;
            Image::make('storage/'.$ruta)->fit(1600, 1100, function ($constraint) {
                $constraint->upsize();
            })->save('storage/'.$ruta,null,'jpg');
            $request['imagen']='storage/'.$ruta;
        }
        if($request->id == null){
            $ubicacion=Ubicacion::create($request->all());
        }else{
            $ubicacion=Ubicacion::find($request->id);
            $ubicacion->update($request->all());
        }

        return redirect()->route('ubicacion.index')
            ->with('success', 'Guardado Correctamente.');
    }

    public function destroy(Request $request)
    {
        $ubicacion= Ubicacion::findOrFail($request->id_ubicacion_2);
        $ubicacion->estado= $ubicacion->estado == 1 ? '0':'1';
        $ubicacion->save();
        return redirect()->back()->with('success','Ubicacion Eliminado Correctamente!');
    }
}

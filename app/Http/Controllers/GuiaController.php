<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Guia;
use Illuminate\Http\Request;
use App\Http\Requests\GuiaRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;


class GuiaController extends Controller
{


    public function index()
    {
        $guias=Guia::all();
        $i=0;
        return view('pages.guia.index',compact('guias','i'));
    }

    public function create()
    {
        return view('pages.guia.create');
    }

    public function store(GuiaRequest $request)
    {
        $mytime= Carbon::now('America/Lima');
        if($request->hasFile('imagen'))
        {
            $nombreimg=Str::slug($request->nombre,'-Guia').'.'.$request->file('imagen')->getClientOriginalExtension();
            $ruta=$request->imagen->storeAs('/guias',$nombreimg);
        }else{
            $nombreimg="default.png";
        }
        $documento = Documento::create([
            'tipo_documento'=> $request->tipo_documento,
            'num_documento' => $request->num_documento,
        ]);
        $guia = Guia::create([
            'nombre'            =>  $request->nombre,
            'celular'           =>  $request->celular,
            'email'             =>  $request->email,
            'fecha_nacimiento'  =>  $request->fecha_nacimiento,
            'direccion'         =>  $request->direccion,
            'imagen'            =>  $request->imagen,
            'documento_id'      =>  $documento->id,
            'user_id'           =>  \Auth::user()->id,
            'estado'            =>  '1',
        ]);
        $guia->imagen = 'storage/guias/'.$nombreimg;
        $guia->save();
        return redirect()->route('guia.index')
            ->with('success', 'Guia Agregado Correctamente.');
    }
    public function show(Guia $guia)
    {
        return view('pages.guia.show',compact('guia'));
    }

    public function edit(Guia $guia)
    {
        return view('pages.guia.edit',compact('guia'));
    }

    public function update(GuiaRequest $request, Guia $guia)
    {
        if($request->hasFile('imagen'))
        {
            $nombreimg=Str::slug($request->nombre,'-Guia').'.'.$request->file('imagen')->getClientOriginalExtension();
            $ruta=$request->imagen->storeAs('/guias',$nombreimg);
        }
        $guia->documento->update([
            'tipo_documento'=> $request->tipo_documento,
            'num_documento' => $request->num_documento,
        ]);
        $guia->update([
            'nombre'            =>  $request->nombre,
            'celular'           =>  $request->celular,
            'email'             =>  $request->email,
            'fecha_nacimiento'  =>  $request->fecha_nacimiento,
            'direccion'         =>  $request->direccion,
            'imagen'            =>  $request->imagen,
            'documento_id'      =>  $documento->id,
            'user_id'           =>  \Auth::user(),
        ]);
        if($request->hasFile('imagen'))
        {
            $guia->imagen = 'storage/guias/'.$nombreimg;
            $guia->save();
        }
        return redirect()->route('guia.index')->with('success','Guia Modificado Correctamente!');
    }

    public function destroy(Request $request)
{
    $guia= Guia::findOrFail($request->id_guia_2);
    $guia->estado = $guia->estado == 1 ? '0':'1';
    $guia->save();
    return redirect()->back()->with('success','Estado de guía actualizado correctamente!');
}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PdfDatos;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PdfDatosController extends Controller
{
    //
    public function index(Request $request)
    {
        $pdfdato=PdfDatos::first();
        return view('pages.pdfdatos.edit',compact('pdfdato'));
    }

    public function edit(PdfDatos $pdfdato)
    {
        $i=0;
        return view('pages.pdfdatos.edit',compact('pdfdato','i'));
    }



    public function store(Request $request)
    {
        if($request->id_pdf){
            $pdfdato = PdfDatos::findOrFail($request->id_pdf);
        }else{
            $pdfdato = new PdfDatos();
        }
        
        $pdfdato->rec_cancel1   = $request->rec_cancel1;
        // $pdfdato->rec_cancel2   = $request->rec_cancel2;
        // $pdfdato->poli_ven1     = $request->poli_ven1;
        // $pdfdato->poli_ven2     = $request->poli_ven2;
        $pdfdato->save();
        return redirect()->route('pdfdatos.index')->with('success', 'Datos PDF actualizados correctamente');
    }


}

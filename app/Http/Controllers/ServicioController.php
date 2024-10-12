<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{

    public function index()
    {
        $servicios = Servicio::whereIn('categoria_id', [5, 6])->orderBy('titulo','asc')->get();
        $i = 0;
        return view('pages.servicio.index', compact('servicios', 'i'));
    }

    public function hoteles()
    {
        $servicios = Servicio::where('categoria_id', 2)->where('incluye', 0)->orderBy('titulo','asc')->get();
        $i = 0;

        $proveedorModel = new Proveedor();
        $proveedoresHotel = $proveedorModel->ProveedoresDeHoteles();
        return view('pages.servicio.hotel', compact('servicios', 'i', 'proveedoresHotel'));
    }



    public function vuelos()
    {
        $servicios = Servicio::where('categoria_id', 3)->where('incluye', 0)->orderBy('titulo','asc')->get();
        $i = 0;
        return view('pages.servicio.vuelo', compact('servicios', 'i'));
    }


    public function otros()
    {
        $servicios = Servicio::where('incluye', 1)->orderBy('titulo','asc')->get();
        $i = 0;
        return view('pages.servicio.otros', compact('servicios', 'i'));
    }


    public function create($categoria_id = null)
    {
        return view('pages.servicio.create', compact('categoria_id'));
    }

    public function edit(Servicio $servicio)
    {
        return view('pages.servicio.edit', compact('servicio'));
    }

    public function duplicar($id)
    {
        $servicio = Servicio::find($id);
        return view('pages.servicio.duplicar', compact('servicio'));
    }

    public function destroy(Request $request)
    {
        if($request->id_servicio_2){
            $servicio= Servicio::findOrFail($request->id_servicio_2);
            foreach($servicio->itinerarios as $itinerario){
                $itinerario->incluyes()->detach();
                $itinerario->noincluyes()->detach();
                $itinerario->delete();
            }
            $servicio->delete();
            return redirect()->back()->with('success', 'Servicio eliminado Correctamente.');
        } else {
            $servicio = Servicio::findOrFail($request->id_cambiar_2);
            if ($servicio->estado == "1") {
                $servicio->estado = '0';
                $servicio->save();
                return redirect()->back()->with('success', 'Estado de Servicio Cambiado Correctamente.');
            } else {
                $servicio->estado = '1';
                $servicio->save();
                return redirect()->back()->with('success', 'Estado de Servicio Cambiado Correctamente.');
            }
        }
    }
}

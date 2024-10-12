<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Models\Categoria;
use App\Models\Hotel;
use App\Models\Proveedor;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class HotelController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:hotel.index')->only('index');
        $this->middleware('can:hotel.create')->only('store');
        $this->middleware('can:hotel.edit')->only('store');
        $this->middleware('can:hotel.destroy')->only('destroy');
    }

    public function index()
    {
        $hoteles = Proveedor::whereRelation('categoria', 'categoria_id', 2)->where('detalle_hotel',0)->get();
        $i = 0;
        $categorias = Categoria::where('categoria_id', 2)->get();
        $ciudades = Ubicacion::get();
        return view('pages.hotel.index', compact('hoteles', 'i', 'categorias', 'ciudades'));
    }

    public function store(HotelRequest $request)
    {
        if ($request->id == null) {
            $hotel = new Proveedor();
        } else {
            $hotel = Proveedor::find($request->id);
        }

        $hotel->nombre = $request->nombre;
        $hotel->celular = $request->celular;
        $hotel->direccion = $request->direccion;
        $hotel->email = $request->email;
        $hotel->categoria_id = $request->categoria_id;
        $hotel->ubicacion_id = $request->ubicacion_id;
        $hotel->checkinn = $request->checkinn;
        $hotel->checkout = $request->checkout;
        $hotel->correo = $request->correo;

        if ($request->hasFile('imagen')) {
            $nombreimg = Str::slug($request->nombre, '-') . '.' . $request->file('imagen')->getClientOriginalExtension();

            $ruta = $request->imagen->storeAs('/proveedores', $nombreimg, 'public');

            $hotel->imagen = 'storage/proveedores/' . $nombreimg;
        } else {
            if ($request->id == null) {
                $hotel->imagen = 'storage/proveedores/default.png';
            }
        }

        $hotel->save();

        return redirect()->route('hotel.index')
            ->with('success', 'Guardado Correctamente.');
    }


    public function destroy(Request $request)
    {
        $hotel = Proveedor::findOrFail($request->id_hotel_2);
        $hotel->estado = $hotel->estado == 1 ? '0' : '1';
        $hotel->save();
        return redirect()->back()->with('success', 'Cambiado de estado Correctamente!');
    }
}

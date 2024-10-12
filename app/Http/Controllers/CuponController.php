<?php

namespace App\Http\Controllers;

use App\Http\Requests\CuponRequest;
use App\Models\Cupon;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:cupon.index')->only('index');
        $this->middleware('can:cupon.create')->only('store');
        $this->middleware('can:cupon.create')->only('store');
        $this->middleware('can:cupon.destroy')->only('destroy');
    }

    public function index()
    {
        $cupones=Cupon::all();
        $i=0;
        return view('pages.cupon.index',compact('cupones','i'));
    }

    public function store(CuponRequest $request)
    {
        $request['user_id'] = \Auth::user()->id;
        if($request->id == null){
            $cupon=Cupon::create($request->all());
        }else{
            $cupon=Cupon::find($request->id);
            $cupon->update($request->all());
        }
        return redirect()->route('cupon.index')
            ->with('success', 'Guardado Correctamente.');
    }

    public function destroy(Request $request)
    {
        $cupon= Cupon::findOrFail($request->id_cupon_2);
        $cupon->estado= $cupon->estado == 1 ? '0':'1';
        $cupon->save();
        return redirect()->back()->with('success','Cambiado de estado Correctamente!');
    }
}

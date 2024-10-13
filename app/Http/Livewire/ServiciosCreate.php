<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Hotel;
use App\Models\Itinerario;
use App\Models\Precio;
use App\Models\Proveedor;
use Livewire\Component;
use App\Models\Servicio;
use App\Models\Ubicacion;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;
use Intervention\Image\Facades\Image;

class ServiciosCreate extends Component
{
    use WithFileUploads;
    public $titulo;
    public $servicioIdAdicional;
    public $serviciosAdicionales;
    public $serviciosAdicionalesOtros;
    public $categoria_id;
    public $categoriaint;
    public $ubicacion_id=[];
    public $duracion;
    public $horario;
    public $descuento;
    public $operar;
    public $descripcion;
    public $imagen;
    public $condicion;
    public $categorias;
    public $ubicaciones;
    public $colorpick;
    public $plantillaOverview;
    public $ciudadId;

    public $nombrePrecio;
    public $precioTarifa;
    public $precioMinTarifa;
    public $monedaPrecio;
    public $contPrecio=0;
    public $precios;
    public $paxTarifa;
    public $privadoTarifa;
    public $nacionalidadTarifa;

    public $hotelId;
    public $hoteles; 

    public $template=[];
    public $incluyes;
    public $noincluyes;
    public $contDias=1;
    public $incluye;
    public $no_incluye;
    public $proveedores;
    public $plantillaOperar=0;

    public $imagenModal;

    public function verImagen($nombre){
        $this->imagenModal = $nombre;
        $this->emit('abrirImagen');
    }

    public function mount($categoriaint)
    {
        $this->proveedores = Proveedor::where('detalle_hotel',0)->get();
        $this->template[0] = null;
        if($categoriaint == 3){
            $this->hoteles = Proveedor::whereRelation('categoria','id',$categoriaint)->where('detalle_hotel',0)->get();
        }else{
            $this->hoteles = Proveedor::whereRelation('categoria','categoria_id',$categoriaint)->where('detalle_hotel',0)->get();
        }
        
        $this->precios = Precio::where('estado',1)->get();
        $this->categoriaint = $categoriaint;
        if($categoriaint == 4)
        {
            $this->categorias = Categoria::where('detalle',1)->get();
        }else{
            $this->categorias = Categoria::where('categoria_id',$categoriaint)->get();
        }
        
        $this->ubicaciones = Ubicacion::all();
        if($categoriaint == 2){
            $this->incluyes = Servicio::where('categoria_id',2)->where('incluye',1)->get();
        }elseif($categoriaint == 3){
            $this->incluyes = Servicio::where('categoria_id',3)->where('incluye',1)->get();
        }else{
            $this->incluyes = Servicio::whereNotIn('categoria_id',[1,2,3,4,5,7,8])->get();
        }
        $this->serviciosAdicionales = Servicio::where('categoria_id',5)->orderBy('titulo','asc')->get(); 
        $this->serviciosAdicionalesOtros = Servicio::where('incluye', 1)->orderBy('titulo','asc')->get();
    }
    public function render()
    {
        return view('livewire.servicios-create');
    }
    public function register()
    {
        try{
            DB::beginTransaction();
            $this->validate([
                'titulo'                => 'required|max:150',
                'categoria_id'          => 'nullable',
                'ubicacion_id'          => 'nullable',
                'duracion'              => 'nullable',
                'descripcion'           => 'nullable',
                'imagen'                => 'nullable',
                'template'              => 'nullable',
                'condicion'             => 'nullable',
                'horario'               => 'nullable',
                'descuento'             => 'nullable',
            ]);

            $proveedorNombre = Proveedor::find($this->hotelId);
            if($this->imagen)
            {
                if($this->categoriaint == 2){
                    $nombreimg=Str::slug($this->titulo,'-').Str::slug($proveedorNombre->nombre,'-').'.'.$this->imagen->getClientOriginalExtension();
                }else{
                    $nombreimg=Str::slug($this->titulo,'-').'.'.$this->imagen->getClientOriginalExtension();
                }
                $ruta=$this->imagen->storeAs('/servicios',$nombreimg);
                Image::make('storage/'.$ruta)->save('storage/'.$ruta);
            }
            else{
                $nombreimg='default.png';
            }
            
            if($this->categoriaint == 2 || $this->categoriaint == 3){
                $this->categoria_id = $this->categoriaint;
            }
            $servicio = Servicio::create([

                'titulo'            =>  $this->titulo,
                'descripcion'       =>  $this->descripcion,
                'img_principal'     =>  'storage/servicios/'.$nombreimg,
                'duracion'          =>  $this->duracion ?? 1,
                'horario'           =>  $this->horario,
                'descuento'         =>  $this->descuento,
                'categoria_id'      =>  5,
                'color'             =>  $this->colorpick,
                'user_id'           =>  \Auth::user()->id,
                'condicion'         =>  $this->condicion,
                'operar'            => $this->operar ? 1 : 0,
                'proveedor_id'      =>  $this->hotelId,
                'ubicacion_id'      =>  $this->ciudadId,
                'incluye'           =>  $this->categoriaint == 4 ? 1 : 0,
                'servicio_id'         =>  $this->servicioIdAdicional,
                'plantillaOverview' => htmlspecialchars($this->plantillaOverview),
                'plantillaOperar' => $this->plantillaOperar,
            ]);
            for($i=0;$i<$this->contPrecio;$i++){
                $servicio->precios()->attach($this->nombrePrecio[$i],["moneda_id" => $this->monedaPrecio[$i],"precio_minimo" => $this->precioMinTarifa[$i],"precio" => $this->precioTarifa[$i],"privado" => $this->privadoTarifa[$i] ?? 1,"nacional" => $this->nacionalidadTarifa[$i] ?? 1,"pax" => $this->paxTarifa[$i] ?? 1]); 
            }
            for($i=0;$i<$this->contDias;$i++){
                if($this->template[$i])
                {
                    if($this->categoriaint == 2){
                        $nombreimgtemplate=Str::slug($this->titulo,'-').Str::slug($proveedorNombre->nombre,'-').$i.'.'.$this->template[$i]->getClientOriginalExtension();
                    }else{
                        $nombreimgtemplate=Str::slug($this->titulo,'-').$i.'.'.$this->template[$i]->getClientOriginalExtension();;
                    }
                    $ruta=$this->template[$i]->storeAs('/template',$nombreimgtemplate);
                    Image::make('storage/'.$ruta)->save('storage/'.$ruta);
                }
                else{
                    $nombreimgtemplate='default.png';
                }
                $itinerario = new Itinerario();
                $itinerario->servicio_id = $servicio->id;
                $itinerario->dia = $i+1;
                $itinerario->template = 'storage/template/'.$nombreimgtemplate;
                $itinerario->save();

                if($this->incluye){
                    foreach ($this->incluye as $inc) {
                        $itinerario->incluyes()->attach($inc);
                    }
                }
                if($this->no_incluye){
                    foreach ($this->no_incluye as $inc) {
                        $itinerario->noincluyes()->attach($inc);
                    }
                }
            }
            if(count($this->ubicacion_id) > 0)
            {
                for($i=0; $i < count($this->ubicacion_id); $i++){
                    $ubica=Ubicacion::firstOrCreate(['nombre'=> $this->ubicacion_id[$i]]);
                    $ubicacions[]=$ubica->id;
                }
                $servicio->ubicaciones()->sync($ubicacions);
            }
            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollBaack();
        }
        if($this->categoriaint == 1){
            return redirect()->route('servicio.index')
            ->with('success', 'Guardado Correctamente.');
        }elseif($this->categoriaint == 2){
            return redirect()->route('servicio.hotel')
            ->with('success', 'Guardado Correctamente.');
        }elseif($this->categoriaint == 3){
            return redirect()->route('servicio.vuelo')
            ->with('success', 'Guardado Correctamente.');
        }else{
            return redirect()->route('servicio.otros')
            ->with('success', 'Guardado Correctamente.');
        }
    }

    public function agregarPrecio()
    {
        $this->emit('AumentarPrecio',$this->contPrecio);
        $this->nombrePrecio[$this->contPrecio]=$this->precios->first()->id;
        $this->monedaPrecio[$this->contPrecio]=1;
        $this->precioTarifa[$this->contPrecio]=0;
        $this->precioMinTarifa[$this->contPrecio]=0;
        $this->paxTarifa[$this->contPrecio] = 1;
        $this->privadoTarifa[$this->contPrecio] = 1;
        $this->nacionalidadTarifa[$this->contPrecio] = 1;
        $this->contPrecio++;
    }

    public function disminuir($i)
    {
        unset($this->nombrePrecio[$i]);
        unset($this->monedaPrecio[$i]);
        unset($this->precioTarifa[$i]);
        unset($this->precioMinTarifa[$i]);
        unset($this->paxTarifa[$i]);
        unset($this->privadoTarifa[$i]);
        unset($this->nacionalidadTarifa[$i]);
        $this->contPrecio--;
        if($this->contPrecio > 0){
            $this->nombrePrecio = array_values($this->nombrePrecio);
            $this->precioTarifa = array_values($this->precioTarifa);
            $this->precioMinTarifa = array_values($this->precioMinTarifa);
            $this->monedaPrecio = array_values($this->monedaPrecio);
            $this->paxTarifa = array_values($this->paxTarifa);
            $this->privadoTarifa = array_values($this->privadoTarifa);
            $this->nacionalidadTarifa = array_values($this->nacionalidadTarifa);
        }
        $this->emit('ActualizarPrecio',$this->nombrePrecio,$this->monedaPrecio);
    }

    public function agregarItinerario()
    {
        $this->emit('AumentarDias',$this->contDias);
        $this->template[$this->contDias]=null;
        $this->incluye[$this->contDias] = [];
        $this->no_incluye[$this->contDias] = [];
        $this->contDias++;
    }

    public function disminuirDias($i)
    {
        unset($this->incluye[$i]);
        unset($this->no_incluye[$i]);
        unset($this->template[$i]);
        $this->incluye = array_values($this->incluye);
        $this->no_incluye = array_values($this->no_incluye);
        $this->template = array_values($this->template);
        $this->contDias--;
        $this->emit('ActualizarDias',$this->incluye,$this->no_incluye);
    }
}

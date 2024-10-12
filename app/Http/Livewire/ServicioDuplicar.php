<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
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

class ServicioDuplicar extends Component
{
    use WithFileUploads;
    public $servicio_ant;
    public $titulo;
    public $servicioIdAdicional;
    public $serviciosAdicionales;
    public $serviciosAdicionalesOtros;
    public $categoria_id;
    public $ubicacion_id=[];
    public $duracion;
    public $horario;
    public $descuento;
    public $descripcion;
    public $imagen;
    public $condicion;
    public $categorias;
    public $ubicaciones;
    public $colorpick;
    public $img_principal;
    public $user_id;
    public $color;
    public $categoriaint;
    public $operar;
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
    public $img_principaltemplate=[];
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

    public function render()
    {
        return view('livewire.servicio-duplicar');
    }

    public function mount($servicio = null)
    {
        $this->proveedores = Proveedor::where('detalle_hotel',0)->get();
        $this->serviciosAdicionales = Servicio::where('categoria_id',5)->orderBy('titulo','asc')->get();
        $this->serviciosAdicionalesOtros = Servicio::where('incluye', 1)->orderBy('titulo','asc')->get();
        $this->categoriaint = $servicio->categoria->categoria_id;
        if($servicio->categoria->categoria_id == null){
            $this->categoriaint = $servicio->categoria_id;
        }
        if($this->categoriaint== 3){
            $this->hoteles = Proveedor::whereRelation('categoria','id',$this->categoriaint)->get();
        }else{
            $this->hoteles = Proveedor::whereRelation('categoria','categoria_id',$this->categoriaint)->get();
        }
        
        $this->precios = Precio::where('estado',1)->get();
        if($this->categoriaint == 4)
        {
            $this->categorias = Categoria::where('detalle',1)->get();
        }else{
            $this->categorias = Categoria::where('categoria_id',$this->categoriaint)->get();
        }

        $this->servicio_ant         = $servicio;
        $this->titulo               = $this->servicio_ant->titulo;
        $this->descripcion          = $this->servicio_ant->descripcion;
        $this->img_principal        = $this->servicio_ant->img_principal;
        $this->duracion             = $this->servicio_ant->duracion;
        $this->descuento            = $this->servicio_ant->descuento;
        $this->categoria_id         = $this->servicio_ant->categoria_id;
        $this->user_id              = $this->servicio_ant->user_id;
        $this->condicion            = $this->servicio_ant->condicion;
        $this->color                = $this->servicio_ant->color;
        $this->operar                = $this->servicio_ant->operar == 0 ? 0 : 1;
        $this->hotelId             = $this->servicio_ant->proveedor_id;
        $this->ciudadId         = $this->servicio_ant->ubicacion_id;
        $this->servicioIdAdicional         = $this->servicio_ant->servicio_id;
        $this->ubicaciones          = Ubicacion::all();
        $this->contPrecio= count($this->servicio_ant->precios);
        $this->plantillaOperar = $this->servicio_ant->plantillaOperar;
        foreach($this->servicio_ant->precios as $i => $precio){
            $this->nombrePrecio[$i] = $precio->pivot->precio_id;
            $this->monedaPrecio[$i] = $precio->pivot->moneda_id;
            $this->precioTarifa[$i] = $precio->pivot->precio;
            $this->precioMinTarifa[$i] = $precio->pivot->precio_minimo;
        }

        $this->contDias= count($this->servicio_ant->itinerarios);
        foreach($this->servicio_ant->itinerarios as $i => $itinerario){
            $this->template[$i] = null;
            $this->img_principaltemplate[$i] = $itinerario->template;
            $this->incluye[$i] =  collect($itinerario['incluyes'])->pluck('id')->toArray();
            $this->no_incluye[$i]  = collect($itinerario['noincluyes'])->pluck('id')->toArray();
        }

        if($this->categoriaint== 2){
            $this->incluyes = Servicio::where('categoria_id',2)->where('incluye',1)->get();
        }elseif($this->categoriaint == 3){
            $this->incluyes = Servicio::where('categoria_id',3)->where('incluye',1)->get();
        }else{
            $this->incluyes = Servicio::whereNotIn('categoria_id',[1,2,3,4,5,7,8])->get();
        }
    }

    public function register()
    {
        if(!$this->colorpick)
        {
            $this->colorpick = $this->color;
        }
        try{
            DB::beginTransaction();
            $this->validate([
                'titulo'                => 'required|max:150',
                'categoria_id'          => 'nullable',
                'ubicacion_id'          => 'nullable',
                'duracion'              => 'required',
                'descripcion'           => 'nullable',
                'imagen'                => 'nullable',
                'template'              => 'nullable',
                'condicion'             => 'nullable',
                'horario'               => 'nullable',
                'descuento'             => 'nullable',
            ]);
            $proveedorNombre = Proveedor::find($this->hotelId);
            if (!$this->imagen) {
                list($nombre,$extension ) = explode(".", $this->img_principal);
                $nombreImagen = Str::slug($this->titulo,'-').'.'.$extension ;
                $cleanPath = str_replace("storage/servicios/", "", $this->img_principal);
                Storage::copy('\servicios/'.$cleanPath, '\servicios/'.$nombreImagen);
            }
            else {
                if($this->categoriaint == 2){
                    $nombreImagen=Str::slug($this->titulo,'-').Str::slug($proveedorNombre->nombre,'-').'.'.$this->imagen->getClientOriginalExtension();
                }else{
                    $nombreImagen=Str::slug($this->titulo,'-').'.'.$this->imagen->getClientOriginalExtension();
                }
                $ruta = $this->imagen->storeAs('/servicios',$nombreImagen);
                Image::make('storage/'.$ruta)->save('storage/'.$ruta);
            }

            $servicio = $this->servicio_ant;

            $servicio = Servicio::create([
                'titulo'            =>  $this->titulo,
                'descripcion'       =>  $this->descripcion,
                'img_principal'     =>  'storage/servicios/'.$nombreImagen,
                'duracion'          =>  $this->duracion,
                'horario'           =>  $this->horario,
                'descuento'         =>  $this->descuento ? $this->descuento : 0,
                'categoria_id'      =>  $this->categoria_id,
                'color'             =>  $this->colorpick,
                'user_id'           =>  \Auth::user()->id,
                'condicion'         =>  $this->condicion,
                'incluye'           =>  $this->categoriaint == 4 ? 1 : 0,
                'operar'            => $this->operar ? 1 : 0,
                'proveedor_id'         =>  $this->hotelId,
                'servicio_id'         =>  $this->servicioIdAdicional,
                'plantillaOperar' => $this->plantillaOperar,
            ]);
            for($i=0;$i<$this->contPrecio;$i++){
                $servicio->precios()->attach($this->nombrePrecio[$i],["moneda_id" => $this->monedaPrecio[$i],"precio_minimo" => $this->precioMinTarifa[$i],"precio" => $this->precioTarifa[$i],"privado" => $this->paxTarifa[$i] ?? 1,"nacional" => $this->privadoTarifa[$i] ?? 1,"pax" => $this->nacionalidadTarifa[$i] ?? 1]);
            }

            for($i=0;$i<$this->contDias;$i++){
                if(!$this->template[$i])
                {
                    list($nombre,$extension ) = explode(".", $this->img_principaltemplate[$i]);
                    $nombreImagentemplate = Str::slug($this->titulo,'-').$i.'.'.$extension ;
                    $cleanPath = str_replace("storage/template/", "", $this->img_principaltemplate[$i]);
                    Storage::copy('\template/'.$cleanPath, '\template/'.$nombreImagentemplate);
                }
                else{
                    if($this->categoriaint == 2){
                        $nombreImagentemplate =Str::slug($this->titulo,'-').Str::slug($proveedorNombre->nombre,'-').$i.'.'.$this->template[$i]->getClientOriginalExtension();
                    }else{
                        $nombreImagentemplate =Str::slug($this->titulo,'-').$i.'.'.$this->template[$i]->getClientOriginalExtension();
                    }
                    $ruta = $this->template[$i]->storeAs('/template',$nombreImagentemplate);
                    Image::make('storage/'.$ruta)->save('storage/'.$ruta);
                }
                $itinerario = new Itinerario();
                $itinerario->servicio_id = $servicio->id;
                $itinerario->dia = $i+1;
                $itinerario->template = 'storage/template/'.$nombreImagentemplate;
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

            $servicio->ubicaciones()->detach();
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
        $this->nombrePrecio = array_values($this->nombrePrecio);
        $this->precioTarifa = array_values($this->precioTarifa);
        $this->precioMinTarifa = array_values($this->precioMinTarifa);
        $this->monedaPrecio = array_values($this->monedaPrecio);
        $this->paxTarifa = array_values($this->paxTarifa);
        $this->privadoTarifa = array_values($this->privadoTarifa);
        $this->nacionalidadTarifa = array_values($this->nacionalidadTarifa);
        $this->contPrecio--;
        $this->emit('ActualizarPrecio',$this->nombrePrecio,$this->monedaPrecio);
    }

    public function agregarItinerario()
    {
        $this->emit('AumentarDias',$this->contDias);
        $this->template[$this->contDias]=null;
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

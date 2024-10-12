<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Documento;
use App\Models\Horario;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:user.index')->only('index');
        $this->middleware('can:user.edit')->only('edit','update');
        $this->middleware('can:user.create')->only('create','store');
        $this->middleware('can:user.destroy')->only('destroy');
        $this->middleware('can:user.show')->only('show');
    }

    public function index()
    {
        $users=User::all();
        $i=0;
        return view('pages.user.index',compact('users','i'));
    }

    public function create()
    {
        $roles=Role::all();
        return view('pages.user.create',compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $mytime= Carbon::now('America/Lima');
        if($request->hasFile('imagen'))
        {
            $nombreimg=Str::slug($request->usuario,'-').'.'.$request->file('imagen')->getClientOriginalExtension();
            $ruta=$request->imagen->storeAs('/usuario',$nombreimg);
        }else{
            $nombreimg="default.png";
        }
        $documento = Documento::create([
            'tipo_documento'=> $request->tipo_documento,
            'num_documento' => $request->num_documento,
        ]);
        $user = User::create([
            'nombre'            =>  ($request->nombre .' '. $request->apellido),
            'celular'           =>  $request->celular,
            'email'             =>  $request->email,
            'fecha_nacimiento'  =>  $request->fecha_nacimiento,
            'fecha_inicio'      =>  $mytime->toDateTimeString(),
            'sueldo'           =>  $request->sueldo,
            'dia_descanso'          =>  $request->dia_descanso,
            'usuario'           =>  $request->usuario,
            'password'          =>  $request->password,
            'imagen'            =>  $request->imagen,
            'documento_id'      =>  $documento->id,
        ]);
        $user->imagen = 'storage/usuario/'.$nombreimg;
        $user->save();
        $user->roles()->sync($request->idrol);
        $cont1=$request->hora_ingreso ? count($request->hora_ingreso) : 0;
        for($i=0; $i<$cont1;$i++){
            for($k=0; $k<count($request->dias_horarios[$i]);$k++){
                $horario = new Horario();
                $horario->hora_ingreso = $request->hora_ingreso[$i];
                $horario->hora_salida = $request->hora_salida[$i];
                $horario->descripcion = $request->dias_horarios[$i][$k];
                $horario->user_id = $user->id;
                $horario->descanso = 0;
                $horario->save();
            }
        }
        $cont2=$request->hora_inicio_descanso ? count($request->hora_inicio_descanso):0;
        for($i=0; $i<$cont2;$i++){
            for($k=0; $k<count($request->dias_descanso[$i]);$k++){
                $horario = new Horario();
                $horario->hora_ingreso = $request->hora_inicio_descanso[$i];
                $horario->hora_salida = $request->hora_fin_descanso[$i];
                $horario->descripcion = $request->dias_descanso[$i][$k];
                $horario->user_id = $user->id;
                $horario->descanso = 1;
                $horario->save();
            }
        }
        return redirect()->route('user.index')
            ->with('success', 'Usuario Agregado Correctamente.');
    }
    public function update(UserRequest $request,User $user)
    {
        if($request->hasFile('imagen'))
        {
            $nombreimg=Str::slug($request->usuario,'-').'.'.$request->file('imagen')->getClientOriginalExtension();
            $ruta=$request->imagen->storeAs('/usuario',$nombreimg);
            $user->imagen =  $nombreimg;
        }
        if($request->password){
            $user->password =  $request->password;
        }

        $user->documento->update([
            'tipo_documento'=> $request->tipo_documento,
            'num_documento' => $request->num_documento,
        ]);

        $user->nombre            =  ($request->nombre);
        $user->celular           =  $request->celular;
        $user->email             =  $request->email;
        $user->fecha_nacimiento  =  $request->fecha_nacimiento;
        $user->fecha_inicio      =  $request->fecha_inicio;
        $user->sueldo           =  $request->sueldo;
        $user->dia_descanso          =  $request->dia_descanso;
        $user->usuario           =  $request->usuario;
        $user->documento_id      =  $user->documento->id;
        $user->save();

        $user->roles()->sync($request->idrol);
        $user->horarios()->delete();
        $cont1=$request->hora_ingreso ? count($request->hora_ingreso) : 0;
        for($i=0; $i<$cont1;$i++){
            for($k=0; $k<count($request->dias_horarios[$i]);$k++){
                $horario = new Horario();
                $horario->hora_ingreso = $request->hora_ingreso[$i];
                $horario->hora_salida = $request->hora_salida[$i];
                $horario->descripcion = $request->dias_horarios[$i][$k];
                $horario->user_id = $user->id;
                $horario->descanso = 0;
                $horario->save();
            }
        }
        $cont2=$request->hora_inicio_descanso ? count($request->hora_inicio_descanso):0;
        for($i=0; $i<$cont2;$i++){
            for($k=0; $k<count($request->dias_descanso[$i]);$k++){
                $horario = new Horario();
                $horario->hora_ingreso = $request->hora_inicio_descanso[$i];
                $horario->hora_salida = $request->hora_fin_descanso[$i];
                $horario->descripcion = $request->dias_descanso[$i][$k];
                $horario->user_id = $user->id;
                $horario->descanso = 1;
                $horario->save();
            }
        }
        return redirect()->route('user.index')->with('success','Usuario Modificado Correctamente!');
    }

    public function destroy(Request $request)
    {
        $user= User::findOrFail($request->id_usuario_2);
        $user->estado= $user->estado == 1 ? '0':'1';
        $user->save();
        return redirect()->back()->with('success','Usuario Eliminado Correctamente!');
    }

    public function show(User $user)
    {
        return view('pages.user.show',compact('user'));
    }

    public function edit(User $user)
    {
        $roles=Role::all();
        return view('pages.user.edit',compact('user','roles'));
    }

    public function perfil(User $user)
    {
        $roles=Role::all();
        return view('pages.user.perfil',compact('user','roles'));
    }

    public function perfilguardar(UserRequest $request,User $user)
    {
        if($request->hasFile('imagen'))
        {
            $nombreimg=Str::slug($request->usuario,'-').'.'.$request->file('imagen')->getClientOriginalExtension();
            $ruta=$request->imagen->storeAs('/usuario',$nombreimg);
        }
        $user->update($request->all());
        if($request->hasFile('imagen'))
        {
            $user->imagen = 'storage/usuario/'.$nombreimg;
            $user->save();
        }
        $user->roles()->sync($request->idrol);
        return redirect()->back()->with('success','Guardado Correctamente!');
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $fillable = [
        'nombre',
        'celular',
        'email',
        'fecha_nacimiento',
        'fecha_inicio',
        'sueldo',
        'dia_descanso',
        'usuario',
        'password',
        'imagen',
        'documento_id',
        'estado'
    ];
    protected $hidden = [
        'password',
    ];
    protected function nombre(): Attribute
    {
        return new Attribute(
            set: function($value){
                return mb_strtoupper($value);
            }
        );
    }
    protected function password(): Attribute
    {
        return new Attribute(
            set: function($value){
                return bcrypt($value);
            }
        );
    }
    public function documento()
    {
        return $this->belongsTo('App\Models\Documento');
    }

    public function horarios()
    {
        return $this->hasMany('App\Models\Horario')
                    ->selectRaw('hora_ingreso, hora_salida, user_id, descanso, JSON_ARRAYAGG(descripcion) as descripcion')
                    ->groupBy('hora_ingreso', 'hora_salida', 'user_id', 'descanso');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Guia extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'celular',
        'email',
        'direccion',
        'imagen',
        'documento_id',
        'categoria_id',
        'estado',
    ];
    protected function nombre(): Attribute
    {
        return new Attribute(
            set: function($value){
                return mb_strtoupper($value);
            }
        );
    }
    public function documento()
    {
        return $this->belongsTo('App\Models\Documento');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }
}











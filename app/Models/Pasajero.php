<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasajero extends Model
{
    use HasFactory;

    protected $fillable = [

        'nombres',
        'genero',
        'nacimiento',
        'celular',
        'email',
        'tarifa',
        'pais_id',
        'documento_id',
        'imagen',
        'comentario',
        'principal',
        'apellidoPaterno',
        'apellidoMaterno',
    ];

    protected function nombres(): Attribute
    {
        return new Attribute(
            set: function ($value) {
                return mb_strtoupper($value);
            }
        );
    }

    protected function apellidoPaterno(): Attribute
    {
        return new Attribute(
            set: function ($value) {
                return mb_strtoupper($value);
            }
        );
    }

    protected function apellidoMaterno(): Attribute
    {
        return new Attribute(
            set: function ($value) {
                return mb_strtoupper($value);
            }
        );
    }
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombres} {$this->apellidoPaterno} {$this->apellidoMaterno}";
    }

    public function getNombrePaternoAttribute()
    {
        return "{$this->nombres} {$this->apellidoPaterno}";
    }

    public function pasajeroscumpleaño($fecha)
    {
        $fecha_hoy = date("m-d",strtotime($fecha));
        $fecha_nacimiento = date("m-d",strtotime($this->nacimiento));
        return $fecha_hoy == $fecha_nacimiento;
    }

    public function getEdadAttribute()
    {
        return Carbon::parse($this->nacimiento)->age;
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function reservas()
    {
        return $this->belongsToMany(Reserva::class);
    }

    public function obtenerValorPais()
    {
        if ($this->pais_id == 171) {
            return 2;
        } elseif (in_array($this->pais_id, [29, 53, 66])) {
            return 3;
        } else {
            return 1;
        }
    }

}

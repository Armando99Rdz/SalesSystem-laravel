<?php

namespace salesSys;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';
    protected $primaryKey = 'idpersona';
    public $timestamps = false; // si desea crear campos para creacion y actualizacion de un registro

    protected $fillable = [ // valores rellenables de la tabla, NO id's
        'tipo_persona',
        'nombre',
        'tipo_documento',
        'num_documento',
        'direccion',
        'telefono',
        'email'
    ];

    protected $guarded = [

    ];
}

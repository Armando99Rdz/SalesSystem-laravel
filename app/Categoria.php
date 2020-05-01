<?php

namespace salesSys;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'idcategoria';
    public $timestamps = false; // si desea crear campos para creacion y actualizacion de un registro

    protected $fillable = [ // valores rellenables de la tabla
        'nombre',
        'descripcion',
        'condicion'
    ];

    protected $guarded = [

    ];

}

<?php

namespace salesSys;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model {
    protected $table = 'ingreso';
    protected $primaryKey = 'idingreso';
    public $timestamps = false; // si desea crear campos para creacion y actualizacion de un registro

    protected $fillable = [ // valores rellenables de la tabla
        'idproveedor',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'estado'
    ];

    protected $guarded = [

    ];
}

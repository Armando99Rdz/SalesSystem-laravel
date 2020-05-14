<?php

namespace salesSys;

use Illuminate\Database\Eloquent\Model;


class Venta extends Model{
    protected $table = 'venta';
    protected $primaryKey = 'idventa';
    public $timestamps = false; // si desea crear campos para creacion y actualizacion de un registro

    protected $fillable = [ // valores rellenables de la tabla
        'idcliente',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'total_venta',
        'estado'
    ];

    protected $guarded = [

    ];
}

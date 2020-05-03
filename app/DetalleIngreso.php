<?php

namespace salesSys;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model {
    protected $table = 'detalle_ingreso';
    protected $primaryKey = 'iddetalle_ingreso';
    public $timestamps = false; // si desea crear campos para creacion y actualizacion de un registro

    protected $fillable = [ // valores rellenables de la tabla
        'idingreso',
        'idarticulo',
        'cantidad',
        'precio_compra',
        'precio_venta'
    ];

    protected $guarded = [

    ];
}

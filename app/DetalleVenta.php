<?php

namespace salesSys;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model {
    protected $table = 'detalle_venta';
    protected $primaryKey = 'iddetalle_venta';
    public $timestamps = false; // si desea crear campos para creacion y actualizacion de un registro

    protected $fillable = [ // valores rellenables de la tabla
        'idventa',
        'idarticulo',
        'cantidad',
        'precio_venta',
        'descuento'
    ];

    protected $guarded = [

    ];
}

<?php

namespace salesSys\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use salesSys\Http\Requests\IngresoFormRequest;
use salesSys\Ingreso;
use salesSys\DetalleIngreso;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon; # para formatear fechas
//use http\Client\Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller {
    public function __construct(){

    }

    public function index(Request $request){
        if (!empty($request)){
            $query = trim($request -> get('searchText')); # para filtrar/buscador registros
            $ingresos = DB::table('ingreso as i')
                -> join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
                -> join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
                -> select('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante',
                    'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('sum(di.cantidad * precio_compra) as total')) # calculando total del ingreso
                -> where('i.num_comprobante', 'LIKE', '%'.$query.'%')
                -> orderBy('i.idingreso', 'desc') # ingresos mas actuales al inicip
                -> groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante',
                    'i.num_comprobante', 'i.impuesto', 'i.estado')
                -> paginate(10); # de 10 en 10

                return view('compras.ingreso.index', [
                   'ingresos' => $ingresos,
                    'searchText' => $query
                ]);
        }
    }

    public function create(){
        $personas = DB::table('persona')
            -> where('tipo_persona', '=', 'Proveedor')
            -> get();
        $articulos = DB::table('articulo as art')
            -> select(DB::raw('CONCAT(art.codigo, " ", art.nombre) AS articulo'), 'art.idarticulo')
            -> where('art.estado', '=', 'Activo')
            -> get();

        return view('compras.ingreso.create', [
            "personas" => $personas,
            "articulos" => $articulos
        ]);
    }

    public function store(IngresoFormRequest $request){
        try {
            /**
             * Para guardar en BD el ingreso y sus productos/detalles, se deben agregar ambos,
             * NO se permitirá un ingreso sin detalles/productos ni tampoco productos/detalles sin un ingreso.
             * Para controlar esto se usa una transaccion de SQL.
             */
            DB::beginTransaction(); # inicia transaccion
            $ingreso = new Ingreso();
            $ingreso -> idproveedor = $request -> get('idproveedor');
            $ingreso -> tipo_comprobante = $request -> get('tipo_comprobante');
            $ingreso -> serie_comprobante = $request -> get('serie_comprobante');
            $ingreso -> num_comprobante = $request -> get('num_comprobante');
            $fecha_hora = Carbon::now('America/Monterrey'); # obten la fecha y hora de mi zona horaria
            $ingreso -> fecha_hora = $fecha_hora -> toDateTimeString();
            $ingreso -> impuesto = '16'; # en este caso; IVA en mexico.
            $ingreso -> estado = 'A'; # activo

            $ingreso -> save(); # guarda en DB el ingreso

            # arrays de detalles:
            $idarticulo = $request -> get('idarticulo');
            $cantidad = $request -> get('cantidad');
            $precio_compra = $request -> get('precio_compra');
            $precio_venta = $request -> get('precio_venta');

            # recorrer todos los detalles y guardarlos uno a uno.
            $cont = 0;
            while ($cont < count($idarticulo)){
                $detalle = new DetalleIngreso();
                $detalle -> idingreso = $ingreso -> idingreso;
                $detalle -> idarticulo = $idarticulo[$cont];
                $detalle -> cantidad = $cantidad[$cont];
                $detalle -> precio_compra = $precio_compra[$cont];
                $detalle -> precio_venta = $precio_venta[$cont];

                $detalle -> save();
                $cont++;
            }

            DB::commit(); # ejecuta la transaccion

        }catch (\Exception $e){
            echo 'ERROR SQL transaction for Ingreso: ' . $e;
            DB::rollBack(); # en caso del error, anula la transaccion con rollback().
        }

        return Redirect::to('compras/ingreso');
    }

    # mostrar detalles de un ingreso
    public function show($id){
        $ingreso = DB::table('ingreso as i')
            -> join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
            -> join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
            -> select('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante',
                'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('sum(di.cantidad * precio_compra) as total'))
            -> where('i.idingreso', '=', $id)
            -> groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante',
                    'i.num_comprobante', 'i.impuesto', 'i.estado')
            -> first(); # obten el primer ingreso de la consulta

        $detalles = DB::table('detalle_ingreso as d')
            -> join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            -> select('a.nombre as articulo', 'd.cantidad', 'd.precio_compra', 'd.precio_venta')
            -> where('d.idingreso', '=', $id)
            -> get();

        return view('compras.ingreso.show', [
            "ingreso" => $ingreso,
            "detalles" => $detalles
        ]);
    }

    # cancelar ingreso
    public function destroy($id){
        $ingreso = Ingreso::findOrFail($id);
        $ingreso -> estado = 'C'; # pasa a ser cancelado(C)
        $ingreso -> update();
        return Redirect::to('compras/ingreso');
    }

}

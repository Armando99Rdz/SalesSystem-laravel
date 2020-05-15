<?php

namespace salesSys\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use salesSys\Http\Requests\VentaFormRequest;
use salesSys\Venta;
use salesSys\DetalleVenta;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon; # para formatear fechas
//use http\Client\Response;
use Illuminate\Support\Collection;

class VentaController extends Controller
{

    private $estadoInsercion = null;

    public function __construct(){
        /**
         * Agregando middleware de autenticacion de usuarios. Permitirá restringir el acceso a
         * usuarios si previamente no fueron autenticados redireccionando al login.
         */
        $this -> middleware('auth');
    }

    public function index(Request $request){
        if (!empty($request)){

            $query = trim($request -> get('searchText')); # para filtrar/buscador registros
            $ventas = DB::table('venta as v')
                -> join('detalle_venta as dv', 'v.idventa', '=', 'dv.idventa')
                -> leftJoin('persona as p', 'v.idcliente', '=', 'p.idpersona')
                -> select('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante',
                    'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta') # calculando total del ingreso
                -> where('v.num_comprobante', 'LIKE', '%'.$query.'%')
                -> orWhere('p.nombre', 'LIKE', '%'.$query.'%')
                -> orderBy('v.idventa', 'desc') # ingresos mas actuales al inicip
                -> groupBy('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante',
                    'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')
                -> paginate(10); # de 10 en 10

            $tmpRes = $this -> estadoInsercion;
            $this -> estadoInsercion = null;
            return view('ventas.venta.index', [
                'ventas' => $ventas,
                'searchText' => $query,
                'result' => $tmpRes
            ]);
        }
    }

    public function create(){

        $personas = DB::table('persona')
            // En caso de permitir que proveedores tambien sean clientes, se quita la clausula where
            -> where('tipo_persona', '=', 'Cliente')
            -> get();
        $articulos = DB::table('articulo as art')
            -> select(DB::raw('CONCAT(art.codigo, " ", art.nombre) AS articulo'), 'art.idarticulo', 'art.stock',
                DB::raw('(SELECT precio_venta FROM detalle_ingreso as di WHERE di.idarticulo = art.idarticulo
                ORDER BY di.iddetalle_ingreso DESC LIMIT 1) as precio_venta')) // obteniendo el ultimo precio_venta del articulo
            -> where('art.stock', '>', '0') // solo articulos con stock
            -> where('art.estado', '=' , 'Activo')
            -> orderBy(DB::raw('-precio_venta'), 'desc') # ordena los precio_venta nulos al final
            -> get();

        return view('ventas.venta.create', [
            "personas" => $personas,
            "articulos" => $articulos
        ]);
    }

    public function store(VentaFormRequest $request){
        try {
            /**
             * Para guardar en BD la venta y sus articulos, se deben agregar ambos a la vez,
             * NO se permitirá una venta sin articulos.
             * Para controlar esto se usa una transaccion de SQL.
             */
            DB::beginTransaction(); # inicia transaccion
            $venta = new Venta();
            # capturar los datos que vienen del formulario HTML:
            if(!empty($request -> get('idcliente'))) # si se especifcó el cliente
                $venta -> idcliente = $request -> get('idcliente');
            $venta -> tipo_comprobante = $request -> get('tipo_comprobante');
            if(!empty($request -> get('serie_comprobante')))
                $venta -> serie_comprobante = $request -> get('serie_comprobante');
            $venta -> num_comprobante = $request -> get('num_comprobante');
            $venta -> total_venta = $request -> get('total_venta');
            $mytime = Carbon::now('America/Monterrey'); # obten la fecha y hora de mi zona horaria
            $venta -> fecha_hora = $mytime -> toDateTimeString();
            $venta -> impuesto = '16'; # en este caso; IVA en mexico.
            $venta -> estado = 'A'; # activo

            $venta -> save(); # guarda en DB la venta

            # Desde el formulario HTML se debe enviar un detalle por cada articulo (un array de detalles).
            # obteniendo arrays de detalles que viene del formulario HTML:
            $idarticulo = $request -> get('idarticulo');
            $cantidad = $request -> get('cantidad');
            $descuento = $request -> get('descuento');
            $precio_venta = $request -> get('precio_venta');

            # recorrer todos los detalles y guardarlos uno a uno.
            $cont = 0;
            while ($cont < count($idarticulo)){
                $detalle = new DetalleVenta();
                $detalle -> idventa = $venta -> idventa;
                $detalle -> idarticulo = $idarticulo[$cont];
                $detalle -> cantidad = $cantidad[$cont];
                $detalle -> descuento = $descuento[$cont];
                $detalle -> precio_venta = $precio_venta[$cont];

                $detalle -> save();
                $cont++;
            }

            DB::commit(); # ejecuta y evalua la transaccion

        }catch (\Exception $e){
            echo 'ERROR SQL transaction for Venta: ' . $e;
            DB::rollBack(); # en caso del error, anula la transaccion con rollback().
            $this -> estadoInsercion = "error";
            return Redirect::to('ventas/venta/create');
        }
        $this -> estadoInsercion = "success";
        return Redirect::to('ventas/venta/create');
    }

    # mostrar detalles de un ingreso
    public function show($id){
        $venta = DB::table('venta as v')
            -> join('detalle_venta as dv', 'v.idventa', '=', 'dv.idventa')
            -> leftJoin('persona as p', 'v.idcliente', '=', 'p.idpersona')
            -> select('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.serie_comprobante',
                'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')
            -> where('v.idventa', '=', $id)
            #-> groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante',
            #   'i.num_comprobante', 'i.impuesto', 'i.estado')
            -> first(); # obten el primer ingreso de la consulta

        $detalles = DB::table('detalle_venta as d')
            -> join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            -> select('a.nombre as articulo', 'd.cantidad', 'd.descuento', 'd.precio_venta')
            -> where('d.idventa', '=', $id)
            -> get();

        $totalArts = 0;
        foreach ($detalles as $d)
            $totalArts += $d -> cantidad;

        return view('ventas.venta.show', [
            "venta" => $venta,
            "detalles" => $detalles,
            "totalarticulos" => $totalArts
        ]);
    }

    # cancelar ingreso
    public function destroy($id){
        $venta = Venta::findOrFail($id);
        $venta -> estado = 'C'; # pasa a ser cancelado(C)
        $venta -> update();
        return Redirect::to('ventas/venta');
    }

}

<?php

namespace salesSys\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use salesSys\Charts\UltimosUsuariosChart;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $ultimosUsuariosChart = new UltimosUsuariosChart();
        #$ultimosUsuariosChart = User::where(D::raw('DATE_FORMAT(created_at, '%Y')'))at

        # obtener total $ de ventas en los ultimos 7 dias
        $totalUltimasVentas = DB::table('venta')
            -> select(DB::raw('SUM(total_venta) as total'))
            -> where('fecha_hora', '>=', DB::raw('DATE(NOW()) - INTERVAL 7 DAY'))
            -> where('estado', '=', 'A')
            -> first();
        # obtener total $ de gastos en los ultimos 7 dias
        $totalUltimosGastos =  DB::table('ingreso as i')
            -> select(DB::raw('SUM(precio_compra) as total'))
            -> join('detalle_ingreso as di', 'di.idingreso', '=', 'i.idingreso')
            -> where('fecha_hora', '>=', DB::raw('DATE(NOW()) - INTERVAL 7 DAY'))
            -> where('i.estado', '=', 'A')
            -> first();
        # obtener el articulo menos vendido
        $articuloMenosVendido = DB::table('articulo as a')
            -> join('detalle_venta as dv', 'dv.idarticulo', '=', 'a.idarticulo')
            -> select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.imagen',
                DB::raw('SUM(dv.cantidad) as total'))
            -> groupBy('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.imagen')
            -> orderBy('total', 'ASC')
            -> first();
        # obtener el articulo mas vendido
        $articuloMasVendido = DB::table('articulo as a')
            -> join('detalle_venta as dv', 'dv.idarticulo', '=', 'a.idarticulo')
            -> select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.imagen',
                DB::raw('SUM(dv.cantidad) as total'))
            -> groupBy('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.imagen')
            -> orderBy('total', 'DESC')
            -> first();
        $listaArticulos = DB::table('articulo as a')
            -> join('detalle_venta as dv', 'dv.idarticulo', '=', 'a.idarticulo')
            -> select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.imagen',
                DB::raw('SUM(dv.cantidad) as total'))
            -> groupBy('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.imagen')
            -> orderBy('total', 'DESC')
            -> get();
        $listaArticulos2 = DB::table('articulo as a')
            -> join('detalle_venta as dv', 'dv.idarticulo', '=', 'a.idarticulo')
            -> select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.imagen',
                DB::raw('SUM(dv.cantidad) as total'))
            -> groupBy('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.imagen')
            -> orderBy('total', 'ASC')
            -> get();

        return view('home', [
            "ultimasVentas" => $totalUltimasVentas,
            "ultimosGastos" => $totalUltimosGastos,
            "menosVendido" => $articuloMenosVendido,
            "masVendido" => $articuloMasVendido,
            "articulos" => $listaArticulos,
            "articulos2" => $listaArticulos2
        ]);
    }
}

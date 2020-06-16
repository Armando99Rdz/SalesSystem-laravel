<?php

namespace salesSys\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use salesSys\Charts\UltimosUsuariosChart;

/**
 * Controlador del dashboard/tablero principal
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $ultimosUsuariosChart = new UltimosUsuariosChart();
        #$ultimosUsuariosChart = User::where(D::raw('DATE_FORMAT(created_at, '%Y')'))at

        # REPORTES ULTIMOS 15 DÍAS :
        # obtener total $ de ventas en los ultimos 15 dias
        $totalUltimasVentas = DB::table('venta')
            -> select(DB::raw('SUM(total_venta) as total'))
            -> where('fecha_hora', '>=', DB::raw('DATE(NOW()) - INTERVAL 15 DAY'))
            -> where('estado', '=', 'A')
            -> first();
        # obtener total $ de compras en los ultimos 15 dias
        $totalUltimosGastos =  DB::table('ingreso as i')
            -> select(DB::raw('SUM(precio_compra) as total'))
            -> join('detalle_ingreso as di', 'di.idingreso', '=', 'i.idingreso')
            -> where('fecha_hora', '>=', DB::raw('DATE(NOW()) - INTERVAL 15 DAY'))
            -> where('i.estado', '=', 'A')
            -> first();

        # REPORTES ULTIMO MES :
        # obtener el articulo menos vendido
        $articuloMenosVendido = DB::table('articulo as a')
            -> join('detalle_venta as dv', 'dv.idarticulo', '=', 'a.idarticulo')
            -> join('venta as v', 'v.idventa', '=', 'dv.idventa')
            -> select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.imagen',
                DB::raw('SUM(dv.cantidad) as total'))
            -> groupBy('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.imagen')
            -> orderBy('total', 'ASC')
            -> where('v.fecha_hora', '>=', DB::raw('DATE(NOW()) - INTERVAL 1 MONTH'))
            -> first();
        # obtener el articulo mas vendido
        $articuloMasVendido = DB::table('articulo as a')
            -> join('detalle_venta as dv', 'dv.idarticulo', '=', 'a.idarticulo')
            -> join('venta as v', 'v.idventa', '=', 'dv.idventa')
            -> select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.imagen',
                DB::raw('SUM(dv.cantidad) as total'))
            -> groupBy('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.imagen')
            -> orderBy('total', 'DESC')
            -> where('v.fecha_hora', '>=', DB::raw('DATE(NOW()) - INTERVAL 1 MONTH'))
            -> first();
        $ultimos5articulosMasVendidosMes = DB::table('articulo as a')
            -> join('detalle_venta as dv', 'dv.idarticulo', '=', 'a.idarticulo')
            -> join('venta as v', 'v.idventa', '=', 'dv.idventa')
            -> select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.imagen',
                DB::raw('SUM(dv.cantidad) as total'))
            -> groupBy('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.imagen')
            -> orderBy('total', 'DESC')
            -> where('v.fecha_hora', '>=', DB::raw('DATE(NOW()) - INTERVAL 1 MONTH'))
            -> take(5)
            -> get();
        $ultimos4articulosMenosVendidosMes = DB::table('articulo as a')
            -> join('detalle_venta as dv', 'dv.idarticulo', '=', 'a.idarticulo')
            -> join('venta as v', 'v.idventa', '=', 'dv.idventa')
            -> select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.imagen',
                DB::raw('SUM(dv.cantidad) as total'))
            -> groupBy('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'a.imagen')
            -> orderBy('total', 'ASC')
            -> where('v.fecha_hora', '>=', DB::raw('DATE(NOW()) - INTERVAL 1 MONTH'))
            -> take(4)
            -> get();
        $numVentasUltimosDias = DB::table('venta')
            -> select(DB::raw('COUNT(*) as total'))
            -> where('fecha_hora', '>=', DB::raw('DATE(NOW()) - INTERVAL 15 DAY'))
            -> where('estado', '=', 'A')
            -> first();
        $numIngresosUltimosDias = DB::table('ingreso')
            -> select(DB::raw('COUNT(*) as total'))
            -> where('fecha_hora', '>=', DB::raw('DATE(NOW()) - INTERVAL 15 DAY'))
            -> where('estado', '=', 'A')
            -> first();

        # REPORTES ULTIMO AÑO
        # ganancias totales
        $totalVentasYear = DB::table('venta')
            -> select(DB::raw('SUM(total_venta) as total'))
            -> where(DB::raw('YEAR(fecha_hora)'), '=', DB::raw('YEAR(CURDATE())'))
            -> where('estado', '=', 'A')
            -> first();
        # gastos totales / $ en compras a proveedor
        # obtener total $ de compras en los ultimos 15 dias
        $totalGastosYear =  DB::table('ingreso as i')
            -> select(DB::raw('SUM(precio_compra) as total'))
            -> join('detalle_ingreso as di', 'di.idingreso', '=', 'i.idingreso')
            -> where(DB::raw('YEAR(fecha_hora)'), '=', DB::raw('YEAR(CURDATE())'))
            -> where('i.estado', '=', 'A')
            -> first();
        $numVentasYear = DB::table('venta')
            -> select(DB::raw('COUNT(*) as total'))
            -> where(DB::raw('YEAR(fecha_hora)'), '=', DB::raw('YEAR(CURDATE())'))
            -> where('estado', '=', 'A')
            -> first();
        $numIngresosYear = DB::table('ingreso')
            -> select(DB::raw('COUNT(*) as total'))
            -> where(DB::raw('YEAR(fecha_hora)'), '=', DB::raw('YEAR(CURDATE())'))
            -> where('estado', '=', 'A')
            -> first();

        return view('home', [
            "ultimasVentas" => $totalUltimasVentas,
            "ultimosGastos" => $totalUltimosGastos,
            "menosVendido" => $articuloMenosVendido,
            "masVendido" => $articuloMasVendido,
            "articulosMasVendidosMes" => $ultimos5articulosMasVendidosMes,
            "articulsoMenosVendidosMes" => $ultimos4articulosMenosVendidosMes,
            "numVentasUltimosDias" => $numVentasUltimosDias,
            "numIngresosUltimosDias" => $numIngresosUltimosDias,
            "ventasYear" => $totalVentasYear,
            "gastosYear" => $totalGastosYear,
            "numVentasYear" => $numVentasYear,
            "numIngresosYear" => $numIngresosYear
        ]);
    }
}

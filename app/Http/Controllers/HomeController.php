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

        return view('home', [
            "ultimasVentas" => $totalUltimasVentas,
            "ultimosGastos" => $totalUltimosGastos
        ]);
    }
}

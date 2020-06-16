@extends('layouts.admin')

@section('contenido')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Incio
                </div>
                <h2 class="page-title">
                    Dashboard
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ml-auto d-print-none">
                <a href="#" class="btn btn-primary ml-3 d-none d-sm-inline-block" data-toggle="modal" data-target="#nuevoReporteModal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                    Nuevo reporte
                </a>
            </div>
        </div>
    </div>
    <!-- cards superiores -->
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Ganancias</div>
                        <div class="ml-auto lh-1">
                            <div class="text-muted">
                                Últimos 15 días
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline">
                        <div class="h1 mb-0 mr-2">
                            @if(!empty($ultimasVentas -> total) && !empty($ultimosGastos))
                                @if($ultimasVentas->total - $ultimosGastos->total <= 0)
                                    ${{00.00}}
                                @else
                                    ${{sprintf('%01.2f',($ultimasVentas -> total - $ultimosGastos -> total))}}
                                @endif
                            @else
                                $00.00
                            @endif
                        </div>
                        <div class="mr-auto">
                      <span class="text-green d-inline-flex align-items-center lh-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ml-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="3 17 9 11 13 15 21 7" /><polyline points="14 7 21 7 21 14" /></svg>
                      </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Gastos</div>
                        <div class="ml-auto lh-1">
                            <div class="text-muted">
                                Últimos 15 días
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline">
                        <div class="h1 mb-0 mr-2">
                            @if(!empty($ultimosGastos -> total))
                                ${{sprintf('%01.2f',$ultimosGastos -> total)}}
                            @else
                                $00.00
                            @endif
                        </div>
                        <div class="mr-auto">
                      <span class="text-red d-inline-flex align-items-center lh-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ml-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="3 7 9 13 13 9 21 17" /><polyline points="21 10 21 17 14 17" /></svg>
                      </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">No. de ventas</div>
                        <div class="ml-auto lh-1">
                            <div class="text-muted">
                                Últimos 15 días
                            </div>
                        </div>
                    </div>
                    @if (!empty($numVentasUltimosDias))
                        <div class="h1 mb-0 mr-2">{{$numVentasUltimosDias->total}}</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">No. de compras</div>
                        <div class="ml-auto lh-1">
                            <div class="text-muted">
                                Últimos 15 días
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline">
                        @if(!empty($numIngresosUltimosDias))
                            <div class="h1 mb-0 mr-2">{{$numIngresosUltimosDias->total}}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-deck row-cards">
        <div class="col-lg-6">
            <div class="row row-cards row-deck">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body p-5 p-y5 text-center">
                            <div class="subheader">
                                <div class="text-center">
                                    En el último mes
                                </div>
                            </div>
                            <div class="py-4 text-center">
                                @if(!empty($menosVendido))
                                <span class="avatar avatar-xl mb-4"
                                      style="background-image: url({{asset('imagenes/articulos/'.$menosVendido->imagen)}})">
                                </span>
                                <h3 class="mb-0">{{$menosVendido->nombre}}</h3>
                                <p class="text-muted mb-0">{{$menosVendido->codigo}}</p>
                                <p class="text-muted mb-2">{{$menosVendido->stock}} en stock</p>
                                <p class="mb-1">
                                    <span class="badge bg-red-lt">Menos vendido</span>
                                </p>
                                <p class="mb-4">{{$menosVendido->total}} venta(s)</p>
                                <div>
                                    <div class="avatar-list avatar-list-stacked">
                                        <?php $cont = 1; ?>
                                        @foreach($articulsoMenosVendidosMes as $a)
                                            <span class="avatar"
                                                  style="background-image: url({{asset('imagenes/articulos/'.$a->imagen)}})">
                                        </span>
                                            @if($cont >= 4)
                                                @break
                                            @endif
                                            <?php $cont++; ?>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body p-4 py-5 text-center">
                            <div class="subheader">
                                <div class="text-center">
                                    En el último mes
                                </div>
                            </div>
                            <div class="py-4 text-center">
                                @if(!empty($masVendido))
                                <span class="avatar avatar-xl mb-4"
                                    style="background-image: url({{asset('imagenes/articulos/'.$masVendido->imagen)}})">
                                </span>
                                <h3 class="mb-0">{{$masVendido->nombre}}</h3>
                                <p class="text-muted mb-0">{{$masVendido->codigo}}</p>
                                <p class="text-muted mb-2">{{$masVendido->stock}} en stock</p>
                                <p class="mb-1">
                                    <span class="badge bg-lime-lt">Más vendido</span>
                                </p>
                                <p class="mb-4">{{$masVendido->total}} venta(s)</p>
                                <div>
                                    <div class="avatar-list avatar-list-stacked">
                                        <?php $cont = 1; ?>
                                        @foreach($articulosMasVendidosMes as $a)
                                            <span class="avatar"
                                                  style="background-image: url({{asset('imagenes/articulos/'.$a->imagen)}})">
                                        </span>
                                            @if($cont >= 5)
                                                @break
                                            @endif
                                            <?php $cont++; ?>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div id="chart-development-activity" class="mt-4"></div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Commit</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="w-1">
                                <span class="avatar">CO</span>
                            </td>
                            <td class="td-truncate">
                                <div class="text-truncate">
                                    Fix dart Sass compatibility (#29755)
                                </div>
                            </td>
                            <td class="text-nowrap text-muted">28 Nov 2019</td>
                        </tr>
                        <tr>
                            <td class="w-1">
                                <span class="avatar">JL</span>
                            </td>
                            <td class="td-truncate">
                                <div class="text-truncate">
                                    Change deprecated html tags to text decoration classes (#29604)
                                </div>
                            </td>
                            <td class="text-nowrap text-muted">27 Nov 2019</td>
                        </tr>
                        <tr>
                            <td class="w-1">
                                <span class="avatar">KS</span>
                            </td>
                            <td class="td-truncate">
                                <div class="text-truncate">
                                    justify-content:between ⇒ justify-content:space-between (#29734)
                                </div>
                            </td>
                            <td class="text-nowrap text-muted">26 Nov 2019</td>
                        </tr>
                        <tr>
                            <td class="w-1">
                                <span class="avatar">OP</span>
                            </td>
                            <td class="td-truncate">
                                <div class="text-truncate">
                                    Update change-version.js (#29736)
                                </div>
                            </td>
                            <td class="text-nowrap text-muted">26 Nov 2019</td>
                        </tr>
                        <tr>
                            <td class="w-1">
                                <span class="avatar">SC</span>
                            </td>
                            <td class="td-truncate">
                                <div class="text-truncate">
                                    Regenerate package-lock.json (#29730)
                                </div>
                            </td>
                            <td class="text-nowrap text-muted">25 Nov 2019</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- mini cards -->
        <div class="row row-deck row-cards">
            <div class="col-sm-6 col-lg-3 col-md-6">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="white" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path><path d="M12 3v3m0 12v3"></path></svg>
                    </span>
                        <div>
                            <h4 class="m-0"><a href="javascript:void(0)">
                                    @if(!empty($ventasYear -> total) && !empty($gastosYear))
                                        @if($ventasYear->total - $gastosYear->total <= 0)
                                            ${{00.00}}
                                        @else
                                            ${{sprintf('%01.2f',($ventasYear -> total - $gastosYear -> total))}}
                                        @endif
                                    @else
                                        $00.00
                                    @endif <small>en ganancias</small></a></h4>
                            <small class="text-muted">En el año actual</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 col-md-6">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-yellow mr-3">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="white" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="9" cy="19" r="2"></circle><circle cx="17" cy="19" r="2"></circle><path d="M3 3h2l2 12a3 3 0 0 0 3 2h7a3 3 0 0 0 3 -2l1 -7h-15.2"></path></svg>
                        </span>
                        <div>
                            <h4 class="m-0"><a href="javascript:void(0)">${{$gastosYear->total}} <small>en gastos</small></a></h4>
                            <small class="text-muted">En el año actual</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-bitbucket mr-3">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="white" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="7" r="4"></circle><path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2"></path></svg>
                        </span>
                        <div>
                            <h4 class="m-0"><a href="javascript:void(0)">{{$numVentasYear->total}} <small>ventas</small></a></h4>
                            <small class="text-muted">En el año actual</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-green mr-3">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="white" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="7" cy="17" r="2"></circle><circle cx="17" cy="17" r="2"></circle><path d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path></svg>
                        </span>
                        <div>
                            <h4 class="m-0"><a href="javascript:void(0)">{{$numIngresosYear->total}} <small>compras</small></a></h4>
                            <small class="text-muted">En el año actual</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin mini cards-->
    </div>
    <div class="row row-deck row-cards">
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Mejores proveedores</h4>
                </div>
                <table class="table card-table table-vcenter">
                    <thead>
                    <tr>
                        <th>Proveedor</th>
                        <th colspan="2">Compras</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Coca-Cola</td>
                        <td>3,550</td>
                        <td class="w-50">
                            <div class="progress progress-xs">
                                <div class="progress-bar bg-primary" style="width: 71.0%"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Tecate</td>
                        <td>1,798</td>
                        <td class="w-50">
                            <div class="progress progress-xs">
                                <div class="progress-bar bg-primary" style="width: 35.96%"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>TechPlus</td>
                        <td>1,245</td>
                        <td class="w-50">
                            <div class="progress progress-xs">
                                <div class="progress-bar bg-primary" style="width: 24.9%"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>GuitarraCampirana</td>
                        <td>854</td>
                        <td class="w-50">
                            <div class="progress progress-xs">
                                <div class="progress-bar bg-primary" style="width: 17.08%"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Distribuidora</td>
                        <td>650</td>
                        <td class="w-50">
                            <div class="progress progress-xs">
                                <div class="progress-bar bg-primary" style="width: 13.0%"></div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal crear nuevo reporte -->
    @include('create-report-modal')

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                window.ApexCharts && (new ApexCharts(document.getElementById('chart-development-activity'), {
                    chart: {
                        type: "area",
                        fontFamily: 'inherit',
                        height: 160,
                        sparkline: {
                            enabled: true
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        opacity: .16,
                        type: 'solid'
                    },
                    title: {
                        text: "Development Activity",
                        margin: 0,
                        floating: true,
                        offsetX: 10,
                        style: {
                            fontSize: '18px',
                        },
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                        curve: "smooth",
                    },
                    series: [{
                        name: "Purchases",
                        data: [3, 5, 4, 6, 7, 5, 6, 8, 24, 7, 12, 5, 6, 3, 8, 4, 14, 30, 17, 19, 15, 14, 25, 32, 40, 55, 60, 48, 52, 70]
                    }],
                    grid: {
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0
                        },
                        tooltip: {
                            enabled: false
                        },
                        axisBorder: {
                            show: false,
                        },
                        type: 'datetime',
                    },
                    yaxis: {
                        labels: {
                            padding: 4
                        },
                    },
                    labels: [
                        '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                    ],
                    colors: ["#206bc4"],
                    legend: {
                        show: false,
                    },
                    point: {
                        show: false
                    },
                })).render();
            });
        </script>
    @endpush

@endsection

<!--<meta http-equiv="refresh" content="0; ventas/venta/create">-->
{{--

Página inicial/bienvenida por defecto de laravel

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="title-card">Hola {{ Auth::user()->name  }}!</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

 --}}

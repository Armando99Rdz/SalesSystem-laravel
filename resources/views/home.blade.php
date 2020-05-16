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
                <a href="#" class="btn btn-primary ml-3 d-none d-sm-inline-block" data-toggle="modal" data-target="#modal-report">
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
                        <div class="subheader">Gastos</div>
                        <div class="ml-auto lh-1">
                            <div class="text-muted">
                                Últimos 7 días
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
                        <div class="subheader">Ganancias</div>
                        <div class="ml-auto lh-1">
                            <div class="text-muted">
                                Últimos 7 días
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline">
                        <div class="h1 mb-0 mr-2">
                            @if(!empty($ultimasVentas -> total))
                                ${{sprintf('%01.2f',$ultimasVentas -> total)}}
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
                        <div class="subheader">New clients</div>
                        <div class="ml-auto lh-1">
                            <div class="dropdown">
                                <a class="dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Last 7 days
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item active" href="#">Last 7 days</a>
                                    <a class="dropdown-item" href="#">Last 30 days</a>
                                    <a class="dropdown-item" href="#">Last 3 months</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline">
                        <div class="h1 mb-3 mr-2">6,782</div>
                        <div class="mr-auto">
                      <span class="text-yellow d-inline-flex align-items-center lh-1">
                        0% <svg xmlns="http://www.w3.org/2000/svg" class="icon ml-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="5" y1="12" x2="19" y2="12" /></svg>
                      </span>
                        </div>
                    </div>
                    <div id="chart-new-clients" class="chart-sm"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Active users</div>
                        <div class="ml-auto lh-1">
                            <div class="dropdown">
                                <a class="dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Last 7 days
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item active" href="#">Last 7 days</a>
                                    <a class="dropdown-item" href="#">Last 30 days</a>
                                    <a class="dropdown-item" href="#">Last 3 months</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline">
                        <div class="h1 mb-3 mr-2">2,986</div>
                        <div class="mr-auto">
                      <span class="text-green d-inline-flex align-items-center lh-1">
                        4% <svg xmlns="http://www.w3.org/2000/svg" class="icon ml-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="3 17 9 11 13 15 21 7" /><polyline points="14 7 21 7 21 14" /></svg>
                      </span>
                        </div>
                    </div>
                    <div id="chart-active-users" class="chart-sm"></div>
                </div>
            </div>
        </div>
    </div>

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


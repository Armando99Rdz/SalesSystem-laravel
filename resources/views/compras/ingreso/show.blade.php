
@extends('layouts.admin')

@section('contenido')
    <!-- Page title -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Compras
                </div>
                <h2 class="page-title">
                    Ingreso No.{{$ingreso -> idingreso}}
                    @if($ingreso -> estado == "C")
                        <span class="badge bg-red-lt">Cancelado</span>
                    @elseif($ingreso -> estado == "A")
                        <span class="badge bg-lime-lt">Activo</span>
                    @endif
                </h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Información general</h3>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md mr-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="7" cy="17" r="2"></circle><circle cx="17" cy="17" r="2"></circle><path d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path></svg>
                        Proveedor: <strong>{{$ingreso -> nombre}}</strong>
                    </div>
                    <div class="mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><rect x="4" y="5" width="16" height="16" rx="2"></rect><line x1="16" y1="3" x2="16" y2="7"></line><line x1="8" y1="3" x2="8" y2="7"></line><line x1="4" y1="11" x2="20" y2="11"></line><line x1="11" y1="15" x2="12" y2="15"></line><line x1="12" y1="15" x2="12" y2="18"></line></svg>
                        Fecha: <strong>{{$ingreso -> fecha_hora}}</strong>
                    </div>
                    <div class="mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path><path d="M12 3v3m0 12v3"></path></svg>
                        Total: <strong>{{sprintf('%01.2f',$ingreso -> total)}}</strong>
                    </div>
                    <div class="mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md mr-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11"></path><line x1="9" y1="7" x2="13" y2="7"></line><line x1="9" y1="11" x2="13" y2="11"></line></svg>
                        Tipo comprobante: <strong>{{$ingreso -> tipo_comprobante}}</strong>
                    </div>
                    <div class="mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md mr-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="5" cy="12" r="1"></circle><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle></svg>
                        Serie y no. comprobante: <strong>{{$ingreso -> serie_comprobante}}</strong>
                        @if(!empty($ingreso -> num_comprobante))
                            - <strong>{{$ingreso -> num_comprobante}}</strong>
                        @endif
                    </div>
                    <div class="mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md mr-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="9" cy="19" r="2"></circle><circle cx="17" cy="19" r="2"></circle><path d="M3 3h2l2 12a3 3 0 0 0 3 2h7a3 3 0 0 0 3 -2l1 -7h-15.2"></path></svg>
                        Total de artículos: <strong>{{$totalarticulos}}</strong>
                    </div>
                    <div class="mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md mr-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><polyline points="3 17 9 11 13 15 21 7"></polyline><polyline points="14 7 21 7 21 14"></polyline></svg>
                        Ganancias previstas: $<strong>{{sprintf('%01.2f',$ganancias)}}</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de artículos</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table" id="detallesTable">
                            <thead>
                                <tr>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>P.Compra</th>
                                    <th>P.Venta</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyDetalles">
                                @foreach ($detalles as $detalle)
                                    <tr>
                                        <td>
                                            {{$detalle -> articulo}}
                                        </td>
                                        <td>
                                            {{$detalle -> cantidad}}
                                        </td>
                                        <td>
                                            {{$detalle -> precio_compra}}
                                        </td>
                                        <td>
                                            {{$detalle -> precio_venta}}
                                        </td>
                                        <td>
                                            ${{sprintf('%01.2f' ,$detalle->precio_compra * $detalle->cantidad)}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-weigth-bold">
                    <div class="text-right mr-5">
                        <h3>Total: ${{sprintf('%01.2f',$ingreso -> total)}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

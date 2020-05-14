@extends('layouts.admin')

@section('contenido')

    <!-- Page title -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Ventas
                </div>
                <h2 class="page-title">
                    Venta
                    <a href="venta/create" class="btn btn-outline-primary" style="padding:4px;font-size:14px;">
                        Nueva
                    </a>
                </h2>
            </div>
        </div>
    </div>
    <!--  en caso de no cumplir con las reglas de CategoriaFormRequest  -->
    @if( count($errors) > 0 ) <!-- existen errores -->
    <div class="col-8 m-auto">
        <div class="alert alert-danger alert-dismissible" role="alert">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>
    </div>
    @endif

    <div class="card">
        <!-- append card header con buscador/filtrado -->
    @include('ventas.venta.card-header-table')

    <!-- tabla de ventas -->
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Comprobante</th>
                    <th>Impuesto</th>
                    <th>Total</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach($ventas as $v)

                    <tr>
                        <td class="text-bold" >
                            <strong>{{$v -> fecha_hora}}</strong>
                        </td>
                        <td class="text-bold">
                            {{$v -> tipo_comprobante . ': ' . $v -> serie_comprobante . '-' . $v -> num_comprobante}}
                        </td>
                        <td class="text-bold">
                            {{$v -> impuesto}}
                        </td>
                        <td class="text-bold">
                            ${{number_format($v -> total_venta, 2, '.', '')}}
                        </td>
                        <td class="text-bold">
                            {{$v -> nombre}}
                        </td>
                        <td class="text-bold">
                            @if(strtoupper($v -> estado) == "C")
                                <span class="badge bg-red-lt">Cancelada</span>
                            @else
                                <span class="badge bg-lime-lt">Activa</span>
                            @endif
                        </td>
                        <td class="text-bold">
                            <a href="{{ URL::action( 'VentaController@show', $v -> idventa ) }}" class="m-2">Detalles</a>
                            <a href="#" class="link-danger m-2" data-toggle="modal"
                               data-target="#confirm-delete-{{$v -> idventa}}">Eliminar
                            </a>
                        </td>
                    </tr>

                    <!-- modal de confirmacion para eliminar -->
                    @include('ventas.venta.modals.delete')

                @endforeach

                </tbody>
            </table>
        </div>
        <!-- append card footer con paginacion para la tabla -->
        @include('ventas.venta.card-footer-table')
    </div>

@endsection

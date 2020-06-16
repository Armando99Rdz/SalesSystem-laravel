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
                    Ingresos
                    <a href="ingreso/create" class="btn btn-outline-primary" style="padding:4px;font-size:14px;">
                        Nuevo
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
    @include('compras.ingreso.card-header-table')

    <!-- tabla de categorias -->
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Comprobante</th>
                    <th>Impuesto</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach($ingresos as $i)

                    <tr>
                        <td class="text-bold" >
                            <strong>{{$i -> fecha_hora}}</strong>
                        </td>
                        <td class="text-bold">
                            {{$i -> nombre}}
                        </td>
                        <td class="text-bold">
                            {{$i -> tipo_comprobante . ': ' . $i -> serie_comprobante . '-' . $i -> num_comprobante}}
                        </td>
                        <td class="text-bold">
                            {{$i -> impuesto}}
                        </td>
                        <td class="text-bold">
                            ${{number_format($i -> total, 2, '.', '')}}
                        </td>
                        <td class="text-bold">
                            @if(strtoupper($i -> estado) == "C")
                                <span class="badge bg-red-lt">Cancelado</span>
                            @else
                                <span class="badge bg-lime-lt">Activo</span>
                            @endif
                        </td>
                        <td class="text-bold">
                            <a href="{{ URL::action( 'IngresoController@show', $i -> idingreso ) }}" class="m-2">Detalles</a>
                            <a href="#" class="link-danger m-2" data-toggle="modal"
                               data-target="#confirm-delete-{{$i->idingreso}}">Eliminar
                            </a>
                        </td>
                    </tr>

                    <!-- modal de confirmacion para eliminar -->
                    @include('compras.ingreso.modals.delete')

                @endforeach

                </tbody>
            </table>
        </div>
        <!-- append card footer con paginacion para la tabla -->
        @include('compras.ingreso.card-footer-table')
    </div>

@endsection

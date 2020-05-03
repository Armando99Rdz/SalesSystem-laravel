@extends('layouts.admin')

@section('contenido')

    <!-- Page title -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Almacén
                </div>
                <h2 class="page-title">
                    Artículos
                    <a href="articulo/create" class="btn btn-outline-primary" style="padding:4px;font-size:14px;">
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
    @include('almacen.articulo.card-header-table')

    <!-- tabla de categorias -->
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach($articulos as $art)

                    <tr>
                        <td class="text-bold">
                            {{$art->idarticulo}}
                        </td>
                        <td>
                            @if( empty($art->imagen) )
                                <span class="avatar">{{ strtoupper($art->nombre[0]) }}</span>
                            @else
                                <img class="avatar-medium" src="{{asset('imagenes/articulos/'.$art->imagen)}}" alt="{{$art->nombre}}">
                            @endif
                        </td>
                        <td class="text-bold" >
                            <strong>{{$art -> nombre}}</strong>
                        </td>
                        <td class="text-bold">
                            {{$art -> codigo}}
                        </td>
                        <td class="text-bold">
                            {{$art -> categoria}}
                        </td>
                        <td class="text-bold">
                            @if($art->stock <= 5)
                                <span class="badge bg-red">{{$art -> stock}}</span>
                            @else
                                {{$art -> stock}}
                            @endif
                        </td>
                        <td class="text-bold">
                            @if(strtoupper($art->estado) == "INACTIVO")
                                <span class="badge bg-red-lt">{{$art -> estado}}</span>
                            @else
                                <span class="badge bg-lime-lt">{{$art -> estado}}</span>
                            @endif
                        </td>
                        <td class="text-bold">
                            <a href="{{ URL::action( 'ArticuloController@edit', $art -> idarticulo ) }}" class="m-2">Editar</a>
                            <a href="#" class="link-danger m-2" data-toggle="modal" data-target="#confirm-delete-{{$art->idarticulo}}">Eliminar</a>
                        </td>
                    </tr>

                    <!-- modal de confirmacion para eliminar -->
                    @include('almacen.articulo.modals.delete')

                @endforeach

                </tbody>
            </table>
        </div>
        <!-- append card footer con paginacion para la tabla -->
        @include('almacen.articulo.card-footer-table')
    </div>

@endsection

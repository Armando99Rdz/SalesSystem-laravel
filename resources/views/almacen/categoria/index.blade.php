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
                    Categorías
                    <a href="categoria/create" class="btn btn-outline-primary" style="padding:4px;font-size:14px;">
                        Nueva
                    </a>
                </h2>
            </div>
        </div>
    </div>
    <div class="card">
        <!-- append card header con buscador/filtrado -->
        @include('almacen.categoria.card-header-table')

        <!-- tabla de categorias -->
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach($categorias as $cat)

                <tr>
                    <td>
                        {{$cat -> idcategoria}}
                    </td>
                    <td class="text-bold" >
                        {{$cat -> nombre}}
                    </td>
                    <td class="text-bold">
                        {{$cat -> descripcion}}
                    </td>
                    <td class="text-bold">
                        <a href="#" class="m-2">Editar</a>
                        <a href="#" class="link-danger m-2">Eliminar</a>
                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>
        </div>

        <!-- append card footer con paginacion para la tabla -->
        @include('almacen.categoria.card-footer-table')

    </div>

@endsection

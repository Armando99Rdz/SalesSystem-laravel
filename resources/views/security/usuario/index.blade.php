@extends('layouts.admin')

@section('contenido')

    <!-- Page title -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Seguridad
                </div>
                <h2 class="page-title">
                    Usuarios
                    <a href="usuario/create" class="btn btn-outline-primary" style="padding:4px;font-size:14px;">
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
        @include('security.usuario.card-header-table')

        <!-- tabla de categorias -->
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach($usuarios as $usr)

                <tr>
                    <td>
                        {{$usr -> id}}
                    </td>
                    <td class="text-bold" >
                        {{$usr -> name}}
                    </td>
                    <td class="text-bold">
                        {{$usr -> email}}
                    </td>
                    <td class="text-bold">
                        <a href="{{ URL::action( 'UsuarioController@edit', $usr -> id ) }}" class="m-2">Editar</a>
                        <a href="#" class="link-danger m-2" data-toggle="modal" data-target="#confirm-delete-{{$usr->id}}">Eliminar</a>
                    </td>
                </tr>

                <!-- modal de confirmacion para eliminar -->
                @include('security.usuario.modals.delete')

                @endforeach

                </tbody>
            </table>
        </div>
        <!-- append card footer con paginacion para la tabla -->
        @include('security.usuario.card-footer-table')
    </div>

@endsection

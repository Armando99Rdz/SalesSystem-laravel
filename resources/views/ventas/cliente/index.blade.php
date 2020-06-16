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
                    Clientes
                    <a href="cliente/create" class="btn btn-outline-primary" style="padding:4px;font-size:14px;">
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
    @include('ventas.cliente.card-header-table')

    <!-- tabla de categorias -->
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo Identifación</th>
                    <th>No. Identificación</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach($personas as $p)

                    <tr>
                        <td class="text-bold">
                            {{$p->idpersona}}
                        </td>
                        <td class="text-bold" >
                            <strong>{{$p->nombre}}</strong>
                        </td>
                        <td class="text-bold">
                            {{$p->tipo_documento}}
                        </td>
                        <td class="text-bold">
                            {{$p->num_documento}}
                        </td>
                        <td class="text-bold">
                            {{$p->telefono}}
                        </td>
                        <td class="text-bold">
                            {{$p->email}}
                        </td>
                        <td class="text-bold">
                            <a href="{{ URL::action( 'ClienteController@edit', $p -> idpersona ) }}" class="m-2">Editar</a>
                            <a href="#" class="link-danger m-2" data-toggle="modal" data-target="#confirm-delete-{{$p->idpersona}}">Eliminar</a>
                        </td>
                    </tr>

                    <!-- modal de confirmacion para eliminar -->
                    @include('ventas.cliente.modals.delete')

                @endforeach

                </tbody>
            </table>
        </div>
        <!-- append card footer con paginacion para la tabla -->
        @include('ventas.cliente.card-footer-table')
    </div>

@endsection

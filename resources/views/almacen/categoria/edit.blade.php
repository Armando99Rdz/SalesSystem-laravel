

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
                    Editando categoría {{$categoria -> nombre}}
                </h2>
            </div>
        </div>
    </div>

    <!--  en caso de no cumplir con las reglas de CategoriaFormRequest  -->
    @if( count($errors) > 0 ) <!-- existen errores -->
    <div class="alert alert-danger alert-dismissible" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
    @endif


    {!! Form::model($categoria, ['method' => 'PATCH', 'route'=>['categoria.update', $categoria->idcategoria]])!!}
    {{Form::token()}}

    <div class="card">
        <div class="card-body">

            <div class="mb-3">
                <label class="form-label required">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre de la categoría"
                    value="{{$categoria -> nombre}}">
            </div>
            <div class="mb-3">
                <div>
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control" rows="3" name="descripcion" placeholder="Describa la nueva categoría">{{$categoria->descripcion}}</textarea>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="/almacen/categoria" type="reset" class="btn btn-link link-secondary">
                Cancelar
            </a>
            <button type="submit" class="btn btn-primary ml-auto">
                Guardar
            </button>
        </div>
    </div>


    {!!Form::close()!!}


@endsection

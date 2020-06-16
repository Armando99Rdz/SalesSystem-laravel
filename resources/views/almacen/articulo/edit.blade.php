

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
                    Editando artículo {{$articulo -> nombre}}
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


    {!! Form::model($articulo, ['method' => 'PATCH', 'route'=>['articulo.update', $articulo->idarticulo], 'files' => 'true'])!!}
    {{Form::token()}}

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editar artículo</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label required">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{$articulo->nombre}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="idcategoria" class="form-label required">Categoría</label>
                        <select name="idcategoria" class="form-select">
                            @foreach($categorias as $cat)
                                @if($cat -> idcategoria == $articulo -> idcategoria)
                                    <option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
                                @else
                                    <option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label required">Código</label>
                        <input type="text" class="form-control" name="codigo" value="{{$articulo->codigo}}">
                    </div>
                </div>
                {{--<div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label required">Stock</label>
                        <input type="number" class="form-control" min="1" name="stock" value="{{$articulo->stock}}">
                        <small class="form-hint">Cantidad de producto en almacén</small>
                    </div>
                </div>--}}
                <div class="col-lg-6">
                    <div class="mb-3">
                        <div class="form-label">Subir imagen</div>
                        <div class="form-file">
                            <input type="file" class="form-file-input" name="imagen">
                            <label class="form-file-label" for="customFile">
                                <span class="form-file-text">Seleccione el archivo...</span>
                                <span class="form-file-button">Buscar</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" rows="4" name="descripcion">{{$articulo->descripcion}}</textarea>
                        <small class="form-hint">Algunas características del producto</small>
                    </div>
                </div>
                <div class="col-lg-6">
                    @if(!empty($articulo->imagen))
                        <div class="text-center">
                            <span class="avatar avatar-xl"
                                  style="background-image: url('{{asset('imagenes/articulos/'.$articulo->imagen)}}')">
                            </span>
                            <small class="form-hint m-auto">Imagen actual del artículo</small>
                        </div>
                    @else
                        <small class="form-hint m-auto">Este artículo no tiene una imagen</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="ml-auto text-right">
                <a href="/almacen/articulo" type="reset" class="btn btn-link link-secondary">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </div>
        </div>
    </div>


    {!!Form::close()!!}


@endsection


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
                    Nuevo cliente
                </h2>
            </div>
        </div>
    </div>

    <!--  en caso de no cumplir con las reglas de ClienteFormRequest  -->
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


    {!! Form::open( array(
                    'url' => 'ventas/cliente',
                    'method' => 'POST',
                    'autocomplete' => 'off'
                ))
    !!}
    {{Form::token()}}

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detalles del nuevo cliente</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label required">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{old('nombre')}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label required">Tipo de identificación</label>
                        <select name="tipo_documento" class="form-select">
                            <option value="INE/DNI">INE/DNI</option>
                            <option value="RFC">RFC</option>
                            <option value="INAPAM">INAPAM</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label required">Número de identificación</label>
                        <input type="text" class="form-control" name="num_documento" value="{{old('num_documento')}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control" value="{{old('direccion')}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Telefono</label>
                        <input type="text" name="telefono" class="form-control" placeholder="(000) 000000">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="ejemplo@ejemplo.com">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="ml-auto text-right">
                <button type="reset" class="btn btn-link link-secondary">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </div>
        </div>
    </div>
    {!!Form::close()!!}


@endsection

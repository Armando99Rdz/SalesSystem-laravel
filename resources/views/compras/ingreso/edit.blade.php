

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
                    Editando ingreso {{$persona -> nombre}}
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


    {!! Form::model($persona, ['method' => 'PATCH', 'route'=>['proveedor.update', $persona->idpersona]])!!}
    {{Form::token()}}

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editar proveedor</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label required">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{$persona->nombre}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label required">Tipo de identificación</label>
                        <select name="tipo_documento" class="form-select">
                            @if($persona->tipo_documento == 'INE/DNI')
                                <option value="INE/DNI" selected>INE/DNI</option>
                                <option value="RFC">RFC</option>
                                <option value="INAPAM">INAPAM</option>
                                <option value="Pasaporte">Pasaporte</option>
                            @elseif($persona->tipo_documento == 'RFC')
                                <option value="INE/DNI">INE/DNI</option>
                                <option value="RFC" selected>RFC</option>
                                <option value="INAPAM">INAPAM</option>
                                <option value="Pasaporte">Pasaporte</option>
                            @elseif($persona->tipo_documento == 'INAPAM')
                                <option value="INE/DNI">INE/DNI</option>
                                <option value="RFC">RFC</option>
                                <option value="INAPAM" selected>INAPAM</option>
                                <option value="Pasaporte">Pasaporte</option>
                            @else
                                <option value="INE/DNI">INE/DNI</option>
                                <option value="RFC">RFC</option>
                                <option value="INAPAM">INAPAM</option>
                                <option value="Pasaporte" selected>Pasaporte</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label required">Número de identificación</label>
                        <input type="text" class="form-control" name="num_documento" value="{{$persona->num_documento}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control" value="{{$persona->direccion}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Telefono</label>
                        <input type="text" name="telefono" class="form-control" placeholder="(000) 000000" value="{{$persona->telefono}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" value="{{$persona->email}}" placeholder="ejemplo@ejemplo.com">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="ml-auto text-right">
                <a href="/compras/proveedor" type="reset" class="btn btn-link link-secondary">
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

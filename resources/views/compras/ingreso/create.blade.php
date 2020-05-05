
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
                    Nuevo ingreso
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
                    'url' => 'compras/ingreso',
                    'method' => 'POST',
                    'autocomplete' => 'off'
                ))
    !!}
    {{Form::token()}}

    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detalles del nuevo ingreso</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label required">Proveedor</label>
                                <select name="idproveedor" id="idproveedor" class="form-select">
                                    @foreach($personas as $persona)
                                        <option value="{{$persona -> idpersona}}">{{$persona -> nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label required">Tipo de comprobante</label>
                                <select name="tipo_comprobante" class="form-select">
                                    <option value="Ticket">Ticket</option>
                                    <option value="Factura">Factura</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label required">Número del comprobante</label>
                                <input type="text" class="form-control" name="num_comprobante" value="{{old('num_comprobante')}}" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label">Serie del comprobante</label>
                                <input type="text" class="form-control" name="serie_comprobante" value="{{old('serie_comprobante')}}">
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="hr-text mb-2">Agregar artículo</div>
                        <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <div class="mb-2">
                                    <label class="form-label required">Artículo</label>
                                    <div class="row row-sm">
                                        <div class="col-lg-8 col-md-8 col-xl-8">
                                            <select id="pidarticulo" class="" name="pidarticulo">
                                                @foreach($articulos as $articulo)
                                                    <option value="{{$articulo -> idarticulo}}">{{$articulo -> articulo}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-auto ml-auto">
                                            <button id="bt_add" class="btn btn-outline-primary" aria-label="Button">
                                                Agregar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="mb-2">
                                    <label class="form-label required">Cantidad</label>
                                    <input type="number" class="form-control" name="pcantidad" id="pcantidad" min="1">
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="mb-2">
                                    <label class="form-label">Precio de compra</label>
                                    <input type="number" class="form-control" id="pprecio_compra" name="pprecio_compra">
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="mb-2">
                                    <label class="form-label">Precio de venta</label>
                                    <input type="number" class="form-control" name="pprecio_venta" id="pprecio_venta">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="ocultable" id="guardar">
                        <div class="ml-auto text-right">
                            <a href="/compras/ingreso" type="reset" class="btn btn-link link-secondary">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Finalizar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <div class="mr-auto">
                        <h3 class="card-title">Lista de artículos</h3>
                    </div>
                    <div class="ml-auto">
                        <h3 class="card-title">Total: $<span id="total">00.00</span></h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter table-bordered card-table">
                            <thead>
                                <tr>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Precios</th>
                                    <th>Subtotal</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Example</td>
                                    <td>Example</td>
                                    <td>Example</td>
                                    <td>Example</td>
                                    <td>Example</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
    {{-- Input para trabajar con transaccpiones --}}
    <input type="text" name="_token" value="{{ csrf_token() }}" hidden>

    {!!Form::close()!!}

    @push('scripts')
        <script>
            // para select con busqueda
            tail.select('#pidarticulo', {
                search: true
            });
            /////////////////////////////////

            /**
             * Validaciones
             */
            document.getElementById('bt_add').addEventListener('click', function () {
                addArticle();
            });

            var cont = 0;
            var total = 0.0;
            var subtotal = [];
            var divfinalizar = document.getElementById('guardar');
            var input_pidarticulo = document.getElementById('pidarticulo');
            var input_pcantidad = document.getElementById('pcantidad');
            var input_pprecio_compra = document.getElementById('pprecio_compra');
            var input_pprecio_venta = document.getElementById('pprecio_venta');
            divfinalizar.hidden = true;

            function addArticle() {
                let idarticulo = input_pidarticulo.value;

            }

            // limpiar inputs nuevo detalle/articulo
            function clearInputsArticulo() {
                document.getElementById('pcantidad').value = 1;
                document.getElementById('pprecio_compra').value = "";
                document.getElementById('pprecio_venta').value = "";
            }

            // mostrar botones para finalizar
            function validation() {
                divfinalizar.hidden = total <= 0;
            }

        </script>
    @endpush

@endsection

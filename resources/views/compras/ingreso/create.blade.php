
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
                        <div id="alerts-div">

                        </div>
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
                                            <button id="btn_add_detalle" class="btn btn-outline-primary" type="button">
                                                Agregar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <div class="mb-2">
                                    <label class="form-label required">Cantidad</label>
                                    <input type="number" class="form-control" name="pcantidad" id="pcantidad" min="1" value="1">
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
                            <button type="submit" class="btn btn-primary" id="btn_finalizar">
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
                        <table class="table table-vcenter table-bordered card-table" id="detallesTable">
                            <thead>
                                <tr>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>P.Compra</th>
                                    <th>P.Venta</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyDetalles">
                                <!-- registros -->
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
            tail.select('#pidarticulo', {
                search: true,
                classNames: 'd-block m-auto w-auto'
            });
            /////////////////////////////////////////////////////////

            document.getElementById('btn_add_detalle').addEventListener('click', function(){
                agregarDetalle();
            });

            let idarticulo_select = document.getElementById('pidarticulo');
            let cantidad_input = document.getElementById('pcantidad');
            let precio_compra_input = document.getElementById('pprecio_compra');
            let precio_venta_input = document.getElementById('pprecio_venta');
            let finalizar_btn = document.getElementById('btn_finalizar');
            let alert_div = document.getElementById('alerts-div');
            let totalText = document.getElementById('total');
            let tbody = document.getElementById('tbodyDetalles');
            let total = 0.0;
            let cont = 0;
            let subtotal = [];

            finalizar_btn.disabled = true;

            function agregarDetalle(){

                // conversiones
                let idarticulo = idarticulo_select.value;
                let articuloText = idarticulo_select.options[idarticulo_select.selectedIndex].text;
                let cantidad = validarInt(cantidad_input.value);
                let precio_compra = validarFloat(precio_compra_input.value);
                let precio_venta = validarFloat(precio_venta_input.value);

                if(!validar() || !cantidad || !precio_compra || !precio_venta){
                    console.log("Datos NO válidos");
                    let alert = '<div class="alert alert-danger alert-dismissible my-2" role="alert">' +
                            '<p class="text-center">Imposible agregar detalle, revise los datos del artículo</p>' +
                            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>'
                    alert_div.innerHTML = alert;        
                    return;
                }

                subtotal[cont] = (cantidad * precio_compra);
                total += subtotal[cont];

                let fila = '<tr id="fila'+cont+'"><td><a href="#" class="badge badge-danger" onclick="eliminar('+cont+')">&times;</a><input hidden name="idarticulo[]" value="'+idarticulo+'">'+articuloText+'</td><td><input class="form-control" type="number" name="cantidad[]" value="'+cantidad+'" min="1" style="width:80px"></td><td><input class="form-control" type="number" name="precio_compra[]" value="'+precio_compra+'" style="width:80px"></td><td><input class="form-control" type="number" name="precio_venta[]" value="'+precio_venta+'" style="width:80px"></td><td class="text-center">$'+subtotal[cont]+'</td></tr>';

                cont++;
                clearInputsArticulo();
                totalText.innerText = total;
                tbody.innerHTML += fila; 
                mostrarBtnFinalizar();
            }

            function validar(){
                if(idarticulo_select.value == "" || cantidad_input.value == "" || precio_venta_input.value == ""
                || precio_compra_input.value == "" || cantidad_input.value <= 0 || precio_compra_input < 0 || precio_venta_input < 0)
                    return false;
                return true;
            }

            function eliminar(index){
                console.log(index);
                total = total - subtotal[index];
                index = 'fila' + index;
                document.getElementById(index).hidden = true;
                totalText.innerText = total;
                mostrarBtnFinalizar();
            }

            // limpiar inputs nuevo detalle/articulo
            function clearInputsArticulo() {
                cantidad_input.value = 1;
                precio_compra_input.value = 0;
                precio_venta_input.value = 0;    
            }

            // mostrar botones de finalizar
            function mostrarBtnFinalizar() { finalizar_btn.disabled = total <= 0; }

            function validarFloat(number){
                let res;
                try{ res = parseFloat(number); }
                catch(e){
                    console.log("Error al convetir dato " + number);
                    return false;
                }
                return res;
            }

            function validarInt(number){
                let res;
                try{ res = parseInt(number); }
                catch(e){
                    console.log("Error al convertir dato" + number);
                    return false;
                }
                return res;
            }

        </script>
    @endpush

@endsection

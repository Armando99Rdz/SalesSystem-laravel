
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
                    Nueva venta
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

    <!--  en caso de fallo al agregar nueva venta (transaccion metodo store() VentaController)  -->
    @if(!empty($result) && $result == "error") <!-- existen errores -->
        <div class="alert alert-danger alert-dismissible" role="alert">
            No fué posible guardar la venta, verifique los datos.
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>
    @elseif(!empty($result) && $result == "success")
        <div class="alert alert-success alert-dismissible" role="alert">
            La venta se guardó correctamente.
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>
    @endif

    <div class="row">
        <div class="col-md-5 m-auto">
            {{-- Si hay un mensaje de éxito --}}
            @if(session('message'))
                <div class="alert alert-success alert-dismissible text-center" role="alert">
                    {{ session('message') }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
            @endif

        </div>
    </div>

    {!! Form::open( array(
                    'url' => 'ventas/venta',
                    'method' => 'POST',
                    'autocomplete' => 'off'
                ))
    !!}
    {{Form::token()}}

    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detalles de la nueva venta</h3>
                </div>
                <div class="card-body">
                    <div class="row">
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
                        <div class="col-lg-6 col-xs-12">
                            <div class="mb-3">
                                <label class="form-label">Cliente</label>
                                <select name="idcliente" id="idcliente" class="form-select">
                                    @foreach($personas as $persona)
                                        <option value="{{$persona -> idpersona}}">{{$persona -> nombre}}</option>
                                    @endforeach
                                </select>
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
                                                    @if(!empty($articulo->precio_venta))
                                                        <option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->precio_venta}}">
                                                            {{$articulo -> articulo}}
                                                        </option>
                                                    @endif
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
                            <div class="col-lg-6 col-xs-12">
                                <div class="mb-2">
                                    <label class="form-label required">Cantidad</label>
                                    <input type="number" class="form-control" name="pcantidad" id="pcantidad" min="1" value="1">
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <div class="mb-2">
                                    <label class="form-label required">Descuento</label>
                                    <input type="number" class="form-control" id="pdescuento" name="pdescuento" min="0" value="0">
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <div class="mb-2">
                                    <label class="form-label">Stock</label>
                                    <input type="number" class="form-control" name="pstock" id="pstock" min="1" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <div class="mb-2">
                                    <label class="form-label">Precio de venta</label>
                                    <input type="number" class="form-control" name="pprecio_venta" id="pprecio_venta" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- input para enviar el total de la venta --}}
                    <input type="number" hidden id="total_venta" name="total_venta">
                </div>
                <div class="card-footer">
                    <div class="ocultable" id="guardar">
                        <div class="ml-auto text-right">
                            <a href="/ventas/venta" type="reset" class="btn btn-link link-secondary">
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
                                    <th>P.Venta</th>
                                    <th>Descuento</th>
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
            document.addEventListener('DOMContentLoaded', function () {
                tail.select('#pidarticulo', {
                    search: true,
                    classNames: 'd-block m-auto w-auto'
                });
                tail.select('#idcliente', {
                    placeholder: "Seleccionar...",
                    search: true,
                    deselect: true,
                    classNames: 'd-block m-auto w-auto'
                });
                let clienteSelect = tail.select('#idcliente');
                let idcliente_input = document.getElementById('idcliente');
                clienteSelect.on('change', function () {
                    let id = this.options.selected[0];
                    try { // intenta asignar un valor al select
                        console.log(id.value);
                    }catch (e) { // si marca un error undefned
                        console.log('Cliente NO seleccionado');
                        idcliente_input.value = "-1"; // asigna un valor que no existe, por tanto, value = vacio
                        console.log(idcliente_input.value); // imprime vacio, ya que no existe option con valor -1
                        return;
                    }
                    // si no hubo problema se queda con el id seleccionado
                    console.log(id.value);
                });
                /////////////////////////////////////////////////////////

                let cantidad_input = document.getElementById('pcantidad');
                let descuento_input = document.getElementById('pdescuento');
                let precio_venta_input = document.getElementById('pprecio_venta');
                let stock_input = document.getElementById('pstock');
                let idarticulo_select = document.getElementById('pidarticulo');
                let finalizar_btn = document.getElementById('btn_finalizar');
                let alert_div = document.getElementById('alerts-div');
                let totalText = document.getElementById('total');
                let total_venta_input = document.getElementById('total_venta');
                let tbody = document.getElementById('tbodyDetalles');
                let total = 0.0;
                let cont = 0;
                let subtotal = [];
                finalizar_btn.disabled = true;

                document.getElementById('btn_add_detalle').addEventListener('click', function(){
                    agregarDetalle();
                });

                mostrarValoresArticulo();
                idarticulo_select.addEventListener('change', function () {
                    mostrarValoresArticulo();
                });

                function agregarDetalle(){

                    let datosArticulo = idarticulo_select.value.split('_');

                    let idarticulo = datosArticulo[0];
                    let articuloText = idarticulo_select.options[idarticulo_select.selectedIndex].text;
                    let cantidad = validarInt(cantidad_input.value);
                    let descuento = validarFloat(descuento_input.value);
                    let precio_venta = validarFloat(precio_venta_input.value);
                    let stock = stock_input.value;

                    if(!validar() || !cantidad || !precio_venta){
                        console.log("Datos NO válidos");
                        let alert = '<div class="alert alert-danger alert-dismissible my-2" role="alert">' +
                            '<p class="text-center">Imposible agregar detalle, revise los datos del artículo</p>' +
                            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>'
                        alert_div.innerHTML = alert;
                        return;
                    }

                    if(validarInt(stock) >= cantidad){
                        subtotal[cont] = (cantidad * precio_venta - descuento);
                        total += subtotal[cont];

                        /*let fila = '<tr id="fila'+cont+'"><td><a href="#" class="badge bg-red mr-2" onclick="eliminar('+cont+')">&times;</a>' +
                            '<input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articuloText+'</td>' +
                            '<td><input class="form-control" type="number" name="cantidad[]" value="'+cantidad+'" min="1" style="width:80px"></td>' +
                            '<td><input class="form-control" type="number" min="0" name="precio_venta[]" value="'+precio_venta+'" style="width:80px"></td>' +
                            '<td><input class="form-control" type="number" min="0" name="descuento[]" value="'+descuento+'" style="width:80px"></td>' +
                            '<td class="text-center">$'+subtotal[cont]+'</td></tr>';
                        */
                        let row = tbody.insertRow(); // tr
                        row.id = 'fila' + cont; // tr id

                        let articuloCell = row.insertCell(0); // primer td - celda articulo
                        let btn_eliminar_fila = document.createElement('a');
                        btn_eliminar_fila.href = "#";
                        btn_eliminar_fila.classList.add('badge');
                        btn_eliminar_fila.classList.add('bg-red');
                        btn_eliminar_fila.classList.add('mr-3');
                        prepararElimnarFila(cont, btn_eliminar_fila);
                        btn_eliminar_fila.innerHTML = "&times;";
                        articuloCell.appendChild(btn_eliminar_fila);
                        let idarticulo_input_hidden = document.createElement('input');
                        idarticulo_input_hidden.type = "hidden";
                        idarticulo_input_hidden.name = "idarticulo[]";
                        idarticulo_input_hidden.value = idarticulo;
                        articuloCell.appendChild(idarticulo_input_hidden);
                        articuloCell.append(articuloText);

                        let cantidadCell = row.insertCell(1); // segundo td - celda cantiadad
                        let cantidad_input = document.createElement('input');
                        cantidad_input.classList.add('form-control');
                        cantidad_input.type = "number";
                        cantidad_input.name = "cantidad[]";
                        cantidad_input.value = cantidad;
                        cantidad_input.min = "1";
                        cantidad_input.max = stock;
                        cantidad_input.style.width = '80px';
                        cantidadCell.appendChild(cantidad_input);

                        let precioVentaCell = row.insertCell(2); // tercer td - celda precio venta
                        let precioVenta_input = document.createElement('input');
                        precioVenta_input.classList.add('form-control');
                        precioVenta_input.type = "number";
                        precioVenta_input.name = "precio_venta[]";
                        precioVenta_input.value = precio_venta;
                        precioVenta_input.min = "0";
                        precioVenta_input.style.width = '80px';
                        precioVentaCell.appendChild(precioVenta_input);

                        let descuentoCell = row.insertCell(3); // cuarto td - celda decuento
                        let descuento_input = document.createElement('input');
                        descuento_input.classList.add('form-control');
                        descuento_input.type = "number";
                        descuento_input.name = "descuento[]";
                        descuento_input.value = descuento;
                        descuento_input.min = "0";
                        descuento_input.style.width = '80px';
                        descuentoCell.appendChild(descuento_input);

                        let subtotalCell = row.insertCell(4);
                        subtotalCell.classList.add('text-center');
                        subtotalCell.innerText = "$" + subtotal[cont];

                        cont++;
                        clearInputsArticulo();
                        totalText.innerText = total;
                        total_venta_input.value = total;
                        //tbody.innerHTML += fila;
                        mostrarBtnFinalizar();
                    }else{
                        console.log("ERROR: No se puede vender una cantidad mayor al stock.");
                        let alert = '<div class="alert alert-danger alert-dismissible my-2" role="alert">' +
                            '<p class="text-center">No puede vender una cantidad de artículo mayor que el stock actual</p>' +
                            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>'
                        alert_div.innerHTML = alert;
                    }
                }

                function prepararElimnarFila(index, buttonDelete) {
                    const id = index;
                    const btnDel = buttonDelete;
                    btnDel.addEventListener('click', function () {
                        eliminar(id);
                    });
                }

                function validar(){
                    return !(idarticulo_select.value === "" || cantidad_input.value === "" || precio_venta_input.value === ""
                        || cantidad_input.value <= 0 || precio_venta_input < 0);
                }

                // limpiar inputs nuevo detalle/articulo
                function clearInputsArticulo() {
                    cantidad_input.value = 1;
                    descuento_input.value = 0;
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

                function mostrarValoresArticulo() {
                    datosArt = document.getElementById('pidarticulo').value.split('_');
                    stock_input.value = datosArt[1];
                    precio_venta_input.value = datosArt[2];
                }

                function eliminar(index){
                    console.log(index);
                    total = total - subtotal[index];
                    index = 'fila' + index;
                    document.getElementById(index).hidden = true;
                    totalText.innerText = total;
                    total_venta_input.value = total;
                    mostrarBtnFinalizar();
                }
            });
        </script>
    @endpush

@endsection

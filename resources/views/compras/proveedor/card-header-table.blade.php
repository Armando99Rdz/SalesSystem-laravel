<!--- header del card para una tabla, incluye form para filtrar (buscador) -->

<div class="card-header">
    <h3 class="card-title">Lista de proveedores</h3>

    <div class="ml-auto text-muted">
        <div class="ml-2 d-inline-block">

            {{-- formulario para enviar string de busqueda (busqueda filtrada) --}}
            {!! Form::open( array(
                'url' => 'compras/proveedor',
                'method' => 'GET',
                'autocomplete' => 'off',
                'role' => 'search'
                ))
            !!}

            <div class="row row-sm">
                <div class="col">
                    <input type="text" name="searchText" class="form-control" placeholder="Buscar…" value="{{$searchText}}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-white btn-icon">
                        <svg xmlns="" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"/><circle cx="10" cy="10" r="7" />
                            <line x1="21" y1="21" x2="15" y2="15" />
                        </svg>
                    </button>
                </div>
            </div>

            {{Form::close()}}

        </div>

    </div>

</div>


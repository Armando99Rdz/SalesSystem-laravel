<header class="navbar navbar-expand-md navbar-light">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="{{url('/home')}}" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pr-0 pr-md-3">
                <h2>SalesSys</h2>
            </a>
            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown">
                        <span class="avatar" style="background-image: url({{asset('dist/img/default/user.png')}})"></span>
                        <div class="d-none d-xl-block pl-2">
                            <div>{{Auth::user()->name}}</div>
                            <div class="mt-1 small text-muted">Cajero</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="7" r="4"></circle><path d="M5.5 21v-2a4 4 0 0 1 4 -4h5a4 4 0 0 1 4 4v2"></path></svg>
                            Ver usuarios
                        </a>
                        <a class="dropdown-item" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><rect x="5" y="3" width="14" height="6" rx="2"></rect><path d="M19 6h1a2 2 0 0 1 2 2a5 5 0 0 1 -5 5l-5 0v2"></path><rect x="10" y="15" width="4" height="6" rx="1"></rect></svg>
                            Personalizar
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item link-danger text-bold" href="{{ route('logout') }}">
                            Cerrar sesión
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md ml-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path><path d="M7 12h14l-3 -3m0 6l3 -3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar navbar-light">
                <div class="container-xl">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#" >
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                                </span>
                                <span class="nav-link-title">Inicio</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false" >
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" /><line x1="12" y1="12" x2="20" y2="7.5" /><line x1="12" y1="12" x2="12" y2="21" /><line x1="12" y1="12" x2="4" y2="7.5" /><line x1="16" y1="5.25" x2="8" y2="9.75" /></svg>
                                </span>
                                <span class="nav-link-title">
                                  Almacén
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li >
                                    <a class="dropdown-item" href="{{url('almacen/articulo')}}" >
                                        Artículos
                                    </a>
                                </li>
                                <li >
                                    <a class="dropdown-item" href="{{url('almacen/categoria')}}" >
                                        Categorías
                                    </a>
                                </li>
                            </ul>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false" >
                                <svg xmlns="" width="16" height="16" viewBox="0 0 27 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                <span class="nav-link-title">
                        Compras
                      </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li >
                                    <a class="dropdown-item" href="{{url('compras/ingreso')}}" >
                                        Ingresos
                                    </a>
                                </li>
                                <li >
                                    <a class="dropdown-item" href="{{url('compras/proveedor')}}" >
                                        Proveedores
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-toggle="dropdown" role="button" aria-expanded="false" >
                                <svg xmlns="" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                <span class="nav-link-title">
                        Ventas
                      </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li >
                                    <a class="dropdown-item" href="{{url('ventas/venta/create')}}" >
                                        Nueva
                                    </a>
                                </li>
                                <li >
                                    <a class="dropdown-item" href="{{url('ventas/venta')}}" >
                                        Listar
                                    </a>
                                </li>
                                <li >
                                    <a class="dropdown-item" href="{{url('ventas/cliente')}}" >
                                        Clientes
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('security/usuario')}}" >
                                <svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span class="nav-link-title">
                        Usuarios
                      </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" >
                                <svg xmlns="" width="16" height="16" viewBox="0 0 27 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                <span class="nav-link-title">
                        Ayuda
                      </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" >
                                <svg xmlns="" width="15" height="15" viewBox="0 0 27 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                                <span class="nav-link-title">
                        Acerca de
                      </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
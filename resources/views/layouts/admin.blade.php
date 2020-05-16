
    <!-- header html -->
    @include('partials.header')

    <!-- topbar navegacion -->
    @include('partials.navigation')
    
    <!-- contenido de pagina -->
    <div class="content">
        
        <div class="container-xl">
            <!-- start content -->
            @yield('contenido')
            <!-- end content -->
        </div>

@include('partials.footer')

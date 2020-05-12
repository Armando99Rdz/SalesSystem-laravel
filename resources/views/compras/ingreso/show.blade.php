
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
                    Ingreso No.{{$ingreso -> idingreso}}
                </h2>
            </div>
        </div>
    </div>

@endsection

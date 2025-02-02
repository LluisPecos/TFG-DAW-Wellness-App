@extends('layout-buscarProducto')

@section('head')

<title>Buscar</title>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/greyMainWhiteFooter.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productos/searchNoResults.css') }}">

@endsection

@section('content')
<div class="container-fluid">
    <div class="container py-5">
        <div class="allProducts row">
            @isset($productos)
            
                @include('include/buscar/searchProductCard')
            
            @else
            
                @include('include/buscar/searchNoResults')
            
            @endif
            
        </div>
        
        <div id="showMoreProducts" class="@isset($productos) d-flex @else d-none @endisset justify-content-center mt-4">
            <button id="mostrarMasProductos" class="btn btn-info btn_general" type="button">Ver más productos</button>
            <div id="loadingProducts" class="h1 text-info d-none">
                <i class='fas fa-circle-notch fa-spin'></i>
            </div>
            <div id="errorLoadingProducts" class="error text-center d-none">No existen más productos correspondientes con la búsqueda</div>
        </div>
    </div>
</div>

@endsection

@section('js')
<!-- SCRIPTS BUSCAR -->
<script type="text/javascript" src="{{ URL::asset('js/buscar/buscar.js') }}"></script>
@endsection
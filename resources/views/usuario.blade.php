@extends('layout')

@section('head')

<title>Usuario</title>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/usuario/usuario.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productos/productSold.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/greyMainWhiteFooter.css') }}">

@endsection

@section('content')

<div class="container-fluid p-0">
    <div class="container py-5">
        
        @if(!empty($datosUsuario))
            @foreach($datosUsuario as $dato)
        
                <div class="datosPerfil bg-white border mb-3 p-3">
                    <div class="row">  
                        <div class="col-12 d-flex flex-wrap align-items-center">
                            <div class="mr-3" id="img_perfil" style="background-image: url({{ URL::asset($dato->img_perfil) }})"></div>
                            
                            <div>{{ $dato->nombre }} {{ $dato->apellidos }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link text-info active" data-toggle="tab" href="#venta">{{ $countProductosEnVenta }} @if($countProductosEnVenta == 1) PRODUCTO @else PRODUCTOS @endif</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-info" data-toggle="tab" href="#vendidos">{{ $countProductosVendidos }} @if($countProductosVendidos == 1) VENDIDO @else VENDIDOS @endif</a>
            </li>
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane active" id="venta">
                @if($countProductosEnVenta >= 1)
                
                    <div class="row">
                        @foreach($productos as $producto)
                            @if($producto['vendido'] == false)
                                @include('include/usuario/userProductCard')
                            @endif
                        @endforeach
                    </div>
                
                @else
                
                    <div class="mb-3 text-black-50">El usuario no tiene ningún producto a la venta</div>
                    <img class="w-100" src="{{ URL::asset('imgs/perfil/items-empty-state.svg') }}">
                
                @endif
            </div>

            <div class="tab-pane" id="vendidos">
                @if($countProductosVendidos >= 1)
                
                    <div class="row">
                        @foreach($productos as $producto)
                            @if($producto['vendido'] == true)
                                @include('include/usuario/userProductCard')
                            @endif
                        @endforeach
                    </div>
                
                @else
                
                    <div class="mb-3 text-black-50">El usuario no ha vendido ningún producto</div>
                    <img class="w-100" src="{{ URL::asset('imgs/perfil/items-empty-state.svg') }}">
                
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
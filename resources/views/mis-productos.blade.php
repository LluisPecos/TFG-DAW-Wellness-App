@extends('layout-perfil')

@section('head')

<title>Productos</title>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productos/productSection.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productos/productSold.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productos/mis-productos.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productos/btnsActions.css') }}">

@endsection

@section('content')
<div id="product__container" class="container py-5 mx-auto">
    <div class="products__sections">
        <h4 class="text-dark">Tus productos</h4>
        <p class="text-black-50">Aquí podrás subir productos y gestionar los que ya tienes</p>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link active text-info" data-toggle="tab" href="#venta">{{ $countProductosEnVenta }} EN VENTA</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-info" data-toggle="tab" href="#vendidos">{{ $countProductosVendidos }} @if($countProductosVendidos == 1) VENDIDO @else VENDIDOS @endif</a>
            </li>
        </ul>
        
        <!-- Forms delete products -->
        <form id="formDelete" method="post" action="{{ url('borrar-productos') }}">
            {{ csrf_field() }}
            <input type="hidden" name="productos" value="">

            @include('include/modals/modal-borrar-producto')
        </form>
        
        <!-- Forms sell products -->
        <form id="formSell" method="post" action="{{ url('vender-producto') }}">
            {{ csrf_field() }}
            <input type="hidden" name="id_producto" value="">

            @include('include/modals/modal-vender-producto')
        </form>
        
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="venta">
                <div id="activeProducts">
                    @if($countProductosEnVenta >= 1)
                        <div class="row">
                            
                            @foreach($productos as $producto)

                                @if($producto['vendido'] == false)
                                    @include('include/mis-productos/productSection')
                                @endif

                            @endforeach

                            <div class="text-right col-12">
                                <button id="btnDeleteActive" type="button" class="btn btn-danger btn_general" disabled>Borrar</button>
                            </div>
                        </div>

                    @else
                        <div class="mb-3 text-black-50">No tiene ningún producto a la venta</div>
                        <img class="w-100" src="{{ URL::asset('imgs/perfil/items-empty-state.svg') }}">
                    @endif
                </div>
            </div>

            <div class="tab-pane" id="vendidos">
                <div id="soldProducts">
                    @if($countProductosVendidos >= 1)
                    
                    @include('include/modals/modal-borrar-producto')

                    <div class="row">

                        @foreach($productos as $producto)

                            @if($producto['vendido'] == true)

                                @include('include/mis-productos/productSection')
                            @endif

                        @endforeach

                        <div class="text-right col-12">
                            <button id="btnDeleteSold" type="button" class="btn btn-danger btn_general" disabled>Borrar</button>
                        </div>
                    </div>

                    @else
                        <div class="mb-3 text-black-50">No ha marcado ningún producto como vendido</div>
                        <img class="w-100" src="{{ URL::asset('imgs/perfil/items-empty-state.svg') }}">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<!-- Scripts subir/editar producto -->
<script type="text/javascript" src="{{ URL::asset('js/productos/mis-productos.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/productos/btnsActions.js') }}"></script>
@endsection

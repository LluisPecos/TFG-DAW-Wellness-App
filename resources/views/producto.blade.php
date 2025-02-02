@extends('layout-buscarProducto')

@section('head')

<!-- HEAD PRODUCTO -->
<title>Producto</title>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/greyMainWhiteFooter.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productos/producto.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productos/btnsActions.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productos/productSection.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productos/productSold.css') }}">

@endsection

@section('content')

<div class="container-fluid p-0">
    <div class="container py-5">
        @if(!empty($producto))
            @foreach($producto as $detalles)
                <div class="row w-100 m-0">
                    <div class="product__container col-12 col-md-8 bg-white border rounded m-auto">
                        <input type="hidden" value="{{ $detalles['id_producto'] }}">
                        <div class="product__header row flex-wrap mb-3 align-items-center">
                            <div class="col-6 d-flex">
                                <a class="d-flex flex-wrap text-decoration-none align-items-center" href="{{ url('usuario/' . $detalles['id_usuario']) }}">
                                    <div id="img_perfil" class="mr-3" style="background-image: url({{ URL::asset($detalles['img_perfil']) }})"></div>

                                    <div>
                                        <span class="d-block text-dark">{{ $detalles['userName'] }} {{ $detalles['apellidos'] }}</span>
                                        <span class="d-block text-black-50">{{ $userProductsCount }} @if($userProductsCount == 1) Producto @else Productos @endif</span>
                                    </div>
                                </a>
                            </div>
                            

                            <div class="col-6 h-100 d-flex flex-wrap justify-content-end align-items-center actions__container">
                                
                                @if(session()->has('id') && !empty(session()->get('id')))
                                    @isset($userProductLiked)
                                        @if($userProductLiked == true)

                                        <button class="btnFavorite btn border liked" type="button" data-toggle="tooltip" data-placement="top" title="Borrar favorito">
                                            <i class="far fa-heart liked"></i>
                                        </button>

                                        @else

                                        <button class="btnFavorite btn border no-liked" type="button" data-toggle="tooltip" data-placement="top" title="Favorito">
                                            <i class="far fa-heart no-liked"></i>
                                        </button>

                                        @endif
                                    @endisset
                                @else
                                
                                <div data-toggle="modal" data-target="#modal_inicio_registro">
                                    <button class="btnFavorite btn border no-liked" type="button" data-toggle="tooltip" data-placement="top" title="Favorito">
                                        <i class="far fa-heart no-liked"></i>
                                    </button>
                                </div>
                                
                                
                                @endif
                                
                                @if(session()->has('id') && !empty(session()->get('id')))
                                    @if($detalles['id_usuario'] == session()->get('id'))

                                    <form action="{{ url('/borrar-productos') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="productos" value="{{ $detalles['id_producto'] }}">

                                        @include('include/modals/modal-borrar-producto')
                                    </form>

                                    <span class="ml-2" data-toggle="tooltip" data-placement="top" title="Borrar">
                                        <button class="btnDelete btn border" type="button" data-toggle="modal" data-target="#deleteModal">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </span>

                                        @if($detalles['vendido'] == false)

                                            <a class="ml-2" href="{{ url('/editar-producto/' . $detalles['id_producto']) }}">
                                                <button class="btnEdit btn border" type="button" data-toggle="tooltip" data-placement="top" title="Editar">
                                                    <i class="far fa-pencil-alt"></i>
                                                </button>
                                            </a>

                                            <form action="{{ url('/vender-producto') }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id_producto" value="{{ $detalles['id_producto'] }}">

                                                @include('include/modals/modal-vender-producto')
                                            </form>

                                            <span class="ml-2" data-toggle="tooltip" data-placement="top" title="Vender">
                                                <button class="btnSell btn border" type="button" data-toggle="modal" data-target="#sellModal">
                                                    <i class="far fa-handshake"></i>
                                                </button>
                                            </span>

                                        @endif

                                    @endif
                                @endif
                            </div>
                        </div>
                        
                        <div class="product__body row">
                            <div class="productImgsContainer col-12 mb-3">
                                <div id="carouselImgs" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
                                    @if($detalles['vendido'] == true)
                                    <div class="containerLargeIconSold">
                                        <i class="far fa-handshake"><span class="ml-2">Vendido</span></i>
                                    </div>
                                    @endif
                                    <!-- Indicators -->
                                    <ul class="carousel-indicators">
                                        
                                        @php $contador = 0; @endphp
                                        
                                        @foreach($detalles['imgs'] as $img)
                                        
                                        @if(!empty($img))
                                        
                                        <li data-target="#carouselImgs" data-slide-to="{{ $contador }}" class="@if($loop->first) active @endif"></li>
                                        
                                        @php $contador++; @endphp
                                        
                                        @endif
                                        
                                        @endforeach
                                    </ul>

                                    <!-- The slideshow -->
                                    <div class="carousel-inner">
                                        @foreach($detalles['imgs'] as $key=>$img)
                                        
                                        @if(!empty($img))
                                        
                                        <div class="carousel-item @if($loop->first) active @endif">
                                            <div class="imgProducto" style="background-image: url({{ URL::asset($img) }})"></div>
                                        </div>
                                        
                                        @endif
                                        
                                        @endforeach
                                    </div>

                                    <!-- Left and right controls -->
                                    <a class="carousel-control-prev" href="#carouselImgs" data-slide="prev">
                                        <div>
                                            <i class="far fa-arrow-left fa-lg"></i>
                                        </div>
                                        
                                    </a>
                                    <a class="carousel-control-next" href="#carouselImgs" data-slide="next">
                                        <div>
                                            <i class="far fa-arrow-right fa-lg"></i>
                                        </div>
                                    </a>
                                </div>
                                
                                <!-- Carousel Bigger Imgs -->
                                <div id="carouselBiggerImgs" class="carousel slide carousel-fade overflow-auto d-none" data-ride="carousel" data-interval="false">
                                    <div class="text-right">
                                        <i id="closeBiggerImgs" class="far fa-times fa-2x mt-2 mr-5"></i>
                                    </div>

                                    <!-- The slideshow -->
                                    <div class="carousel-inner">
                                        @foreach($detalles['imgs'] as $img)

                                        @if(!empty($img))

                                        <div class="carousel-item @if($loop->first) active @endif">
                                            <div class="" style="background-image: url({{ URL::asset($img) }})"></div>
                                        </div>

                                        @endif

                                        @endforeach
                                        
                                        <!-- Left and right controls -->
                                        <a class="carousel-control-prev" href="#carouselBiggerImgs" data-slide="prev">
                                            <div>
                                                <i class="far fa-arrow-left fa-lg"></i>
                                            </div>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselBiggerImgs" data-slide="next">
                                            <div>
                                                <i class="far fa-arrow-right fa-lg"></i>
                                            </div>
                                        </a>
                                    </div>
                                    
                                    <div class="container-fluid">
                                        <!-- Carousel Footer -->
                                        <div class="carousel-indicators carousel-footer mt-4">
                                            @php $contador = 0; @endphp
                                            
                                            @foreach($detalles['imgs'] as $img)

                                            @if(!empty($img))

                                            <div data-target="#carouselBiggerImgs" data-slide-to="{{ $contador }}" class="@if($loop->first) active @endif @if(!$loop->last) mr-2 @endif" style="background-image: url({{ URL::asset($img) }});"></div>
                                            
                                            @php $contador++; @endphp

                                            @endif

                                            @endforeach
                                        </div>
                                        
                                        <!-- User -->
                                        <div class="row carousel-user mt-4 row justify-content-center align-items-center">
                                            
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                            
                                            <div class="col-12 col-sm-6 mb-4 mb-sm-0 row align-items-center justify-content-center">
                                                <a class="text-decoration-none row align-items-center flex-nowrap" href="{{ url('usuario/' . $detalles['id_usuario']) }}">
                                                    <div id="img_perfil" class="mr-3" style="background-image: url({{ URL::asset($detalles['img_perfil']) }})"></div>
                                                    
                                                    <span class="text-dark">{{ $detalles['userName'] }} {{ $detalles['apellidos'] }}</span>
                                                </a>
                                            </div>
                                            
                                            
                                            <div class="col-12 col-sm-6 mb-4 mb-sm-0 text-center">
                                                <div>{{ $detalles['productName'] }}</div>
                                                <div class="font-weight-bold">{{ $detalles['precio'] }} €</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="h1 font-weight-bold">{{ $detalles['precio'] }} €</div>
                                <div class="h2 font-weight-normal">{{ $detalles['productName'] }}</div>
                                <hr class="my-4">
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-2 mb-sm-0">
                                        <span class="text-black-50">Categoría</span> {{ $detalles['categoria'] }}
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <span class="text-black-50">Estado</span> {{ $detalles['estado'] }}
                                    </div>
                                </div>
                                <hr class="my-4">
                            </div>

                            <div class="col-12">
                                @if(!empty($detalles['descripcion']))
                                <div>{{ $detalles['descripcion'] }}</div>
                                @else
                                <div class="text-black-50">No se ha proporcionado ninguna descripción</div>
                                @endif
                                <hr class="my-4">
                            </div>

                            <div class="col-12">
                                <div class="row justify-content-between">
                                    <div class="col-12 col-sm-6 mb-2 mb-sm-0">
                                        <span class="text-black-50">{{ $detalles['updated_at'] }}</span>
                                    </div>
                                    
                                    <div class="col-12 col-sm-6 d-flex">
                                        <div>
                                            <i class="far fa-eye mr-1 text-black-50"></i>
                                            <span class="text-black-50 mr-3">{{ $detalles['visitas'] }}</span>
                                        </div>
                                        <div>
                                            <i class="far fa-heart no-liked mr-1 text-black-50"></i>
                                            <span class="text-black-50 mr-2">{{ $favoritesCount }}</span>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                            </div>
                            
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-2 mb-sm-0">
                                        <i class="far fa-envelope mr-1 text-black-50"></i>
                                        <span>{{ $detalles['email'] }}</span>
                                    </div>
                                    
                                    <div class="col-12 col-sm-6">
                                        <i class="far fa-phone mr-1 text-black-50"></i>
                                        @if(!empty($detalles['telefono']))
                                            <span>{{ $detalles['telefono'] }}</span>
                                        @else
                                            <span class="text-black-50">Teléfono no configurado</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
        
        @endif
    </div>
</div>

@endsection

@section('js')
<!-- SCRIPTS PRODUCTO -->
@if(session()->has('id') && !empty(session()->get('id')))
<script type="text/javascript" src="{{ URL::asset('js/productos/addQuitFavorite.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/productos/btnsActions.js') }}"></script>
@endif
<script type="text/javascript" src="{{ URL::asset('js/productos/incrementarVisitas.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/productos/productBiggerImgs.js') }}"></script>
@endsection







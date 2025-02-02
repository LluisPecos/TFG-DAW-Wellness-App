@extends('layout')

@section('head')

<!-- HEAD INICIO -->
<title>Inicio</title>
<link href="{{ URL::asset('css/inicio/inicio.css') }}" rel="stylesheet" type="text/css">

@endsection

@section('content')

<div id="inicio__container">
    <div class="container-fluid p-0 bg-white">
        <div class="container py-5">

            <div class="text-center mb-5">
                <p class="text-black-50 mb-2">Wellness, la plataforma de compraventa de productos de segunda mano</p>
                <h2 class="text-dark m-0">¿Qué estás buscando hoy?</h2>
            </div>

            <div id="demo" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                </ul>

                <!-- The slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div
                            style="background-image: url({{ URL::asset('imgs/inicio/carousel-1.jpg') }}); background-size: cover; background-repeat: no-repeat; height: 400px;">
                        </div>
                        <div class="carousel-caption">
                            <h3 style="text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.6)">Conviertete en Premium</h3>
                            <p style="text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.6)">Obten todas las ventajas</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div
                            style="background-image: url({{ URL::asset('imgs/inicio/carousel-2.jpg') }}); background-size: cover; background-repeat: no-repeat; height: 400px;">
                        </div>
                        <div class="carousel-caption">
                            <h3 style="text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.6)">Reparto gratuito</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div
                            style="background-image: url({{ URL::asset('imgs/inicio/carousel-3.jpg') }}); background-size: cover; background-repeat: no-repeat; height: 400px;">
                        </div>
                        <div class="carousel-caption">
                            <h3 style="text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.6)">Miles de productos disponibles</h3>
                        </div>
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>

            </div>
        </div>
    </div>

    <div class="container-fluid p-0 bg_light_grey">
        <div class="container py-5">

            <div class="text-center">
                <h2 class="text-dark m-0">Productos destacados</h2>
                <p class="text-black-50 m-0">Descubre los productos más deseados hasta el momento</p>
            </div>

            <div class="firstProducts row mt-5">
                
                <div id="home-card" class="col-12 col-sm-6" style="padding: 0px 10px 0px 10px;">
                    <a class="text-decoration-none" href="{{ url('buscar?categoria=6') }}">
                        <div class="card px-1 pt-1 pb-3">
                            <div class="card-img-top d-flex justify-content-center align-items-center rounded"
                                alt="Card image">
                                <img src="{{ URL::asset('imgs/inicio/movil.svg') }}">
                            </div>

                            <div class="card-body p-0 px-2 mt-2">
                                <h4 class="card-title text-dark m-0">Móviles y Telefonía</h4>
                                <p class="card-text text-black-50 mt-1">18.382 anuncios</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div id="home-card" class="col-12 col-sm-6" style="padding: 0px 10px 0px 10px;">
                    <a class="text-decoration-none" href="{{ url('buscar?categoria=4') }}">
                        <div class="card px-1 pt-1 pb-3">
                            <div class="card-img-top d-flex justify-content-center align-items-center rounded"
                                alt="Card image">
                                <img src="{{ URL::asset('imgs/inicio/moda.svg') }}">
                            </div>

                            <div class="card-body p-0 px-2 mt-2">
                                <h4 class="card-title text-dark m-0">Moda y Accesorios</h4>
                                <p class="card-text text-black-50 mt-1">15.641 anuncios</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div id="home-card" class="col-12 col-sm-6" style="padding: 0px 10px 0px 10px;">
                    <a class="text-decoration-none" href="{{ url('buscar?categoria=12') }}">
                        <div class="card px-1 pt-1 pb-3">
                            <div class="card-img-top d-flex justify-content-center align-items-center rounded"
                                alt="Card image">
                                <img src="{{ URL::asset('imgs/inicio/electrodomestico.svg') }}">
                            </div>

                            <div class="card-body p-0 px-2 mt-2">
                                <h4 class="card-title text-dark m-0">Electrodomésticos</h4>
                                <p class="card-text text-black-50 mt-1">12.781 anuncios</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div id="home-card" class="col-12 col-sm-6" style="padding: 0px 10px 0px 10px;">
                    <a class="text-decoration-none" href="{{ url('buscar?categoria=1') }}">
                        <div class="card px-1 pt-1 pb-3">
                            <div class="card-img-top d-flex justify-content-center align-items-center rounded"
                                alt="Card image">
                                <img src="{{ URL::asset('imgs/inicio/coche.svg') }}">
                            </div>

                            <div class="card-body p-0 px-2 mt-2">
                                <h4 class="card-title text-dark m-0">Coches</h4>
                                <p class="card-text text-black-50 mt-1">8.402 anuncios</p>
                            </div>
                        </div>
                    </a>
                </div>
                
            </div>
        </div>
    </div>

    <div class="container-fluid p-0 bg_light_grey">
        <div class="container pb-5">
            
            <div class="secondProducts row">

                <div id="home-card" class="col-12 col-sm-6" style="padding: 0px 10px 0px 10px;">
                    <a class="text-decoration-none" href="{{ url('buscar?categoria=14') }}">
                        <div class="card px-1 pt-1 pb-3">
                            <div class="card-img-top d-flex justify-content-center align-items-center rounded"
                                alt="Card image">
                                <img src="{{ URL::asset('imgs/inicio/bebe.svg') }}">
                            </div>

                            <div class="card-body p-0 px-2 mt-2">
                                <h4 class="card-title text-dark m-0">Niños y Bebes</h4>
                                <p class="card-text text-black-50 mt-1">9.234 anuncios</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div id="home-card" class="col-12 col-sm-6" style="padding: 0px 10px 0px 10px;">
                    <a class="text-decoration-none" href="{{ url('buscar?categoria=10') }}">
                        <div class="card px-1 pt-1 pb-3">
                            <div class="card-img-top d-flex justify-content-center align-items-center rounded"
                                alt="Card image">
                                <img src="{{ URL::asset('imgs/inicio/consola.svg') }}">
                            </div>

                            <div class="card-body p-0 px-2 mt-2">
                                <h4 class="card-title text-dark m-0">Consolas y Videojuegos</h4>
                                <p class="card-text text-black-50 mt-1">5.567 anuncios</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div id="home-card" class="col-12 col-sm-6" style="padding: 0px 10px 0px 10px;">
                    <a class="text-decoration-none" href="{{ url('buscar?categoria=8') }}">
                        <div class="card px-1 pt-1 pb-3">
                            <div class="card-img-top d-flex justify-content-center align-items-center rounded"
                                alt="Card image">
                                <img src="{{ URL::asset('imgs/inicio/deporte.svg') }}">
                            </div>

                            <div class="card-body p-0 px-2 mt-2">
                                <h4 class="card-title text-dark m-0">Deporte y Ocio</h4>
                                <p class="card-text text-black-50 mt-1">8.419 anuncios</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div id="home-card" class="col-12 col-sm-6" style="padding: 0px 10px 0px 10px;">
                    <a class="text-decoration-none" href="{{ url('buscar?categoria=2') }}">
                        <div class="card px-1 pt-1 pb-3">
                            <div class="card-img-top d-flex justify-content-center align-items-center rounded"
                                alt="Card image">
                                <img src="{{ URL::asset('imgs/inicio/moto.svg') }}">
                            </div>

                            <div class="card-body p-0 px-2 mt-2">
                                <h4 class="card-title text-dark m-0">Motos</h4>
                                <p class="card-text text-black-50 mt-1">13.871 anuncios</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<!-- Scripts inicio -->
<script type="text/javascript" src="{{ URL::asset('js/inicio/inicio.js') }}"></script>
@endsection
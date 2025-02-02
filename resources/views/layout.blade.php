<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- LAYOUT -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="_token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ URL::asset('imgs/general/favicon.png') }}" type="image/gif" sizes="16x16">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/layout.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productos/productCard.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/inputIconWrapper.css') }}">
        
        <!-- PRO FONT AWESOME 5.10.0 PRO -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <!-- LAST FREE FONT AWESOME VERSION JS
        <script src="https://kit.fontawesome.com/8f973bf2c3.js" crossorigin="anonymous"></script> -->
        
        <!-- BOOTSTRAP CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        
        @yield('head')
        @yield('head_layout')
    </head>
    
    <body>
        <header>
            <form id="formBuscar" action="{{ url('/buscar') }}" method="get">
                <nav class="navbar navbar-expand-lg navbar-light fixed-top">
                    
                    <a class="navbar-brand" href="{{ url('') }}">
                        <img src="{{ URL::asset('imgs/general/logo.png') }}">
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="form-inline my-2 my-lg-0 flex-lg-grow-1">
                            <p class="input__iconWrapper">
                                <input id="ipt_buscador" name="busqueda" class="form-control rounded-pill mr-sm-2 w-100" type="text" placeholder="Buscar" value="@if(!empty($request->busqueda)){{ $request->busqueda }}@endif" aria-label="Buscar" maxlength="255">
                                <i class="far fa-search"></i>
                            </p>
                        </div>
                        
                        <div id="nav_btns" class="d-flex flex-column flex-lg-row">

                            <!-- Mensajes -->
                            @if(session()->has('id'))
                                <a class="my-2 my-lg-0 mx-lg-1 flex-shrink-0" href="{{ url('mensajes') }}">
                                    <button type="button" class="btn btn-info btn_general w-100">Mensajes</button>
                                </a>
                            @else
                                <button type="button" class="btn btn-info btn_general my-2 my-lg-0 mx-lg-1 flex-shrink-0" data-toggle="modal" data-target="#modal_inicio_registro">Mensajes</button>
                            @endif

                            <!-- Registro / Perfil -->
                            @if(session()->has('id'))
                                <a class="text-decoration-none my-2 my-lg-0 mx-lg-1 flex-shrink-0" href="{{ url('perfil') }}">

                                    <?php
                                    $datos = DB::select("select img_perfil from usuarios where id_usuario = " . session()->get('id') . ";");
                                    ?>

                                    @if($datos)
                                        @foreach($datos as $dato)
                                            <button id="btn_reg" type="button" class="btn btn-info btn_general w-100 d-flex align-items-center justify-content-center">
                                                <div id="img_perfil" class="mr-2" style="background-image: url({{ URL::asset($dato->img_perfil) }})"></div>
                                                <span>Perfil</span>
                                            </button>
                                        @endforeach
                                    @endif
                                </a>
                            @else
                                <button id="btn_reg" type="button" class="btn btn-info btn_general my-2 my-lg-0 mx-lg-1 flex-shrink-0" data-toggle="modal" data-target="#modal_inicio_registro">Regístrate o inicia sesión</button>
                            @endif

                            <!-- Subir producto -->
                            @if(session()->has('id'))
                                <a class="my-2 my-lg-0 ml-lg-1 flex-shrink-0" href="{{ url('subir-producto') }}">
                                    <button type="button" class="btn btn-info btn_general w-100">Subir producto</button>
                                </a>
                            @else
                                <button type="button" class="btn btn-info btn_general my-2 my-lg-0 mx-lg-1 flex-shrink-0" data-toggle="modal" data-target="#modal_inicio_registro">Subir producto</button>
                            @endif

                        </div>
                    </div>
                </nav>
                
                @yield('layout-buscarProducto')
                
            </form>
            
            @yield('layout-perfil')
            
            <!-- Modal registro / inicio -->
            @if(!session()->has('id') && empty(session()->get('id')))
                @include('include/modals/modal-inicio')
                @include('include/modals/modal-registro')
                @include('include/modals/modal-inicio-registro')
            @endif
            
        </header>
        
        <main>
            @if(session()->has('mensajeExito'))
                @if($mensaje = session()->get('mensajeExito'))
            
                <div class="container pt-5">
                    <div class="alert alert-success" role="alert">
                        <strong>Bien hecho!</strong> {{ $mensaje }}
                    </div>
                </div>
            
                @endif
            @endif
            
            @if(session()->has('mensajeError'))
                @if($mensaje = session()->get('mensajeError'))

            
                    <div class="container pt-5">
                        <div class="alert alert-danger" role="alert">
                            <strong>ERROR:</strong> {{ $mensaje }}
                        </div>
                    </div>
            
                @endif
            @endif
            
            @if($errors->any())
            
            <div class="container pt-5">
                <div class="alert alert-danger" role="alert">
                    <strong>VALIDATION ERROR:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            @endif
            
            @yield('content')
        </main>
        
        <footer>
            <div class="container-fluid bg_light_grey py-5">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-2 mb-5">
                            <div class="row">
                                <div class="col-12 mb-4">Redes sociales</div>
                                <div id="cont_redes" class="col-12">
                                    <a class="mr-1" href="https://twitter.com/?lang=es" target="_blank">
                                        <i class="fab fa-twitter-square"></i>
                                    </a>
                                    <a class="mr-1" href="https://www.instagram.com/" target="_blank">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="https://es-es.facebook.com/" target="_blank">
                                        <i class="fab fa-facebook-square"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-4 col-lg-2 mb-5">
                            <p class="mb-4">Wellness</p>
                            <div id="footer_list" class="text-black-50">
                                <p><a href="">¿Quiénes somos?</a></p>
                                <p><a href="">Prensa</a></p>
                                <p><a href="">Empleo</a></p>
                                <p><a href="">Equipo</a></p>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 col-lg-2 mb-5">
                            <p class="mb-4">Soporte</p>
                            <div id="footer_list" class="text-black-50">
                                <p><a href="">Preguntas frecuentes</a></p>
                                <p><a href="">Reglas de publicación</a></p>
                                <p><a href="">Consejos de seguridad</a></p>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-4 col-lg-2 mb-5">
                            <p class="mb-4">Legal</p>
                            <div id="footer_list" class="text-black-50">
                                <p><a href="">Condiciones de uso</a></p>
                                <p><a href="">Política de privacidad</a></p>
                                <p><a href="">Cookies</a></p>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-4 col-lg-2 mb-5">
                            <p class="mb-4">Wellness PRO</p>
                            <div id="footer_list" class="text-black-50">
                                <p><a href="">Impulsa tu negocio</a></p>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-4 col-lg-2 mb-5">
                            <p class="mb-4">Contacto</p>
                            <div id="footer_list" class="text-black-50">
                                <p><a href="tel://1123456789">(+1)123-456-789</a></p>
                                <p><a href="tel://1123456789">(+1)123-456-789</a></p>
                                <p><a href="mailto:wellness@gmail.com">wellness@gmail.com</a></p>
                            </div>
                        </div>
                        
                        <div class="col-12 text-black-50 text-center">
                            <p>Copyright ©2021 Wellness - Todos los derechos reservados</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
    
    <!-- JQUERY JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
    <!-- SCRIPTS LAYOUT -->
    <script type="text/javascript" src="{{ URL::asset('js/ajaxSetup.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/validarRegistro.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/validarLogin.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/layout.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/teclaBuscar.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/Utl.js') }}"></script>
    
    @yield('js')

</html>
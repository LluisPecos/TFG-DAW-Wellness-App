@extends('layout-perfil')

@section('head')

<title>Perfil</title>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/perfil/perfil.css') }}">

@endsection

@section('content')

<div id="profile__container" class="container py-5 mx-auto">
    <div class="row">
        <div class="col-12 col-sm-7">
            <h4 class="text-dark">Tu perfil</h4>
            <p class="text-black-50">Aquí podrás ver y editar los datos de tu perfil</p>
        </div>
        <div class="col-12 col-sm-5 text-left text-sm-right mb-4 mb-sm-0">
            <a class="text-decoration-none text-white" href="{{ url('cerrar-sesion') }}"><button type="button" class="btn btn-danger btn_general">Cerrar sesión</button></a>
        </div>
    </div>

    <div class="profile__section px-4 py-3 mb-3">
        <div class="row">
            <div class="col-12 m-auto">
                <p class="font-weight-bold">Imágen de perfil</p>
            </div>
        </div>

        <form id="form__profile" method="post" action="{{ url('guardar-perfil-img') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-12 col-md-3 mx-auto text-md-right">
                    <p>Foto principal</p>
                </div>

                <div class="col-12 col-md-6 text-left mx-auto">
                    <div class="d-flex flex-wrap align-items-center">
                        
                        @if($perfil)
                            @foreach($perfil as $datos)
                                <div id="img_perfil" class="mr-4 align-self-start" style="background-image: url('{{ URL::asset($datos->img_perfil) }}')"></div>
                            @endforeach
                        @endif

                        <div id="upload__photo" class="my-2">
                            <input id="imgPerfil" name="img_perfil" type="file">
                            <button id="btnSelectFile" type="button" class="btn btn-info btn_general">Cambiar</button>
                            <p class="text-black-50 mb-0 mt-2">Formato .jpg o .png y máximo 1MB</p>
                            <span class="text-black-50 imgName"></span>
                            <span class="error error_img"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-right mt-5">
                <button id="btnSubmitImg" type="button" class="btn btn-info btn_general" disabled>Guardar</button>
            </div>
        </form>
    </div>

    <div class="profile__section px-4 py-3">
        <div class="row">
            <div class="col-12 m-auto">
                <p class="font-weight-bold">Información pública</p>
            </div>
        </div>

        <form id="form__profileData" method="post" action="{{ url('guardar-perfil-datos') }}">
            {{ csrf_field() }}

        @if($perfil)
            @foreach($perfil as $datos)  

            <div class="row mb-3">
                <div class="col-12 col-md-3 mx-auto text-md-right">
                    <p>Nombre</p>
                </div>

                <div class="col-12 col-md-6 text-left mx-auto">
                    <div>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre" value="{{ $datos->nombre }}" maxlength="255"; required>
                        <span class="error"></span>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12 col-md-3 mx-auto text-md-right">
                    <p>Apellidos</p>
                </div>

                <div class="col-12 col-md-6 text-left mx-auto">
                    <div>
                        <input id="apellidos" class="form-control" type="text" name="apellidos" placeholder="Apellidos" value="{{ $datos->apellidos }}" maxlength="255"; required>
                        <span class="error"></span>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12 col-md-3 mx-auto text-md-right">
                    <p>Fecha nacimiento</p>
                </div>

                <div class="col-12 col-md-6 text-left mx-auto">
                    <div>
                        <p class="input__iconWrapper">
                            <input id="fechaNacimiento" class="form-control" type="date" name="fechaNacimiento" value="{{ $datos->fecha_nacimiento }}">
                            <i class="far fa-birthday-cake"></i>
                        </p>
                        <span class="error"></span>
                    </div>  
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12 col-md-3 mx-auto text-md-right">
                    <p>Género</p>
                </div>

                <div class="col-12 col-md-6 text-left mx-auto">
                    <div>
                        <p class="input__iconWrapper">
                            <select id="genero" class="form-control" name="genero">
                                <option value="">Género</option>
                                <option value="M" @if($datos->genero == "M") selected @endif>Masculino</option>
                                <option value="F" @if($datos->genero == "F") selected @endif>Femenino</option>
                            </select>
                            <i class="far fa-venus-mars"></i>
                        </p>
                        
                        <span class="error"></span>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12 col-md-3 mx-auto text-md-right">
                    <p>Email</p>
                </div>

                <div class="col-12 col-md-6 text-left mx-auto">
                    <div>
                        <p class="input__iconWrapper">
                            <input id="email" class="form-control" type="email" name="email" placeholder="Email" value="{{ $datos->email }}" required>
                            <i class="far fa-envelope"></i>
                        </p>
                        <span class="error"></span>
                    </div>  
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12 col-md-3 mx-auto text-md-right">
                    <p>Teléfono</p>
                </div>

                <div class="col-12 col-md-6 text-left mx-auto">
                    <div>
                        <p class="input__iconWrapper">
                            <input id="telefono" class="form-control" type="number" name="telefono" placeholder="123456789" value="{{ $datos->telefono }}">
                            <i class="far fa-phone"></i>
                        </p>
                        
                        <span class="error"></span>
                    </div>

                    @if(session()->has('mensajeExitoPerfilDatos'))
                        @if($mensaje = session()->get('mensajeExitoPerfilDatos'))
                    
                        <div>
                            <div class="alert alert-success mt-4 mb-0" role="alert">
                                <strong>Bien hecho!</strong> {{ $mensaje }}
                            </div>
                        </div>

                        @endif
                    @endif
                    
                    @if(session()->has('mensajeErrorPerfilDatos'))
                        @if($mensaje = session()->get('mensajeErrorPerfilDatos'))
                    
                        <div>
                            <div class="alert alert-danger mt-4 mb-0" role="alert">
                                <strong>ERROR:</strong> {{ $mensaje }}
                            </div>
                        </div>

                        @endif
                    @endif

                </div>
            </div>

            @endforeach
        @endif

            <div class="text-right mt-5">
                <input id="btnSubmitDatos" type="button" class="btn btn-info btn_general" value="Guardar">
            </div>
        </form>
    </div>
</div>
    
@endsection

@section('js')
<!-- SCRIPTS PERFIL -->
<script type="text/javascript" src="{{ URL::asset('js/perfil/perfil.js') }}"></script>
@endsection

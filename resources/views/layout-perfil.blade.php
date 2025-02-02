@extends('layout')

@section('head_layout')

<!-- HEAD LAYOUT PERFIL -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/layout-perfil.css') }}">

@endsection

@if(session()->has('id'))

    @section('layout-perfil')

    <div id="left__nav">
        <ul class="py-4 pl-0">
            @php
            $datos = DB::select("select img_perfil from usuarios where id_usuario = " . session()->get('id'));
            @endphp
            
            @if($datos)
                @foreach($datos as $dato)
                    <a class="{{ Request::is('perfil') ? 'active' : ''}}" href="{{ url('perfil') }}">
                        <li>
                            <div>
                                <div id="img_perfil" style="background-image: url({{ URL::asset($dato->img_perfil) }})"></div>
                            </div>
                            <p>PERFIL</p>
                        </li>
                    </a>
                @endforeach
            @endif
            
            <a class="{{ Request::is('mis-productos') ? 'active' : ''}}" href="{{ url('mis-productos') }}">
                <li>
                    <div class="text-center">
                        <i class="far fa-list-ul"></i>
                    </div>
                    <p>PRODUCTOS</p>
                </li>
            </a>
            
            <a class="{{ Request::is('favoritos') ? 'active' : ''}}" href="{{ url('favoritos') }}">
                <li>
                    <div class="text-center">
                        <i class="far fa-heart"></i>
                    </div>
                    <p>FAVORITOS</p>
                </li>
            </a>
            
            @if(session()->has('rol') && !empty(session()->get('rol')) && session()->get('rol') == "adm")
                <a class="{{ Request::is('administrador') ? 'active' : ''}}" href="{{ url('administrador') }}">
                    <li>
                        <div class="text-center">
                            <i class="far fa-shield-alt"></i>
                        </div>
                        <p>ADMIN</p>
                    </li>
                </a>
            @endif
            
            <a class="{{ Request::is('mensajes') ? 'active' : ''}}" href="{{ url('mensajes') }}">
                <li>
                    <div class="text-center">
                        <i class="far fa-comment-dots"></i>
                    </div>
                    <p>MENSAJES</p>
                </li>
            </a>
        </ul>
    </div>

    @endsection

@else

    @section('layout-perfil')

    <div id="left__nav">
        <ul class="py-4 pl-0">
            <a>
                <li data-toggle="modal" data-target="#modal_registro">
                    <div>
                        <div id="img_perfil" style="background-image: url({{ URL::asset('imgs/perfil/default.svg') }})"></div>
                    </div>
                    <p>Regístrate o inicia sesión</p>
                </li>
            </a>
        </ul>
    </div>

    @endsection

@endif
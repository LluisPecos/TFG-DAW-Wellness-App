@extends('layout-perfil')

@section('head')

<title>No has iniciado sesión</title>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/perfil/perfil.css') }}">

@endsection

@section('content')

<div id="profile__container" class="container py-5 mx-auto">
    <p class="text-muted">No has iniciado sesión</p>
    <button id="btn_reg" type="button" class="btn btn-info btn_general" data-toggle="modal" data-target="#modal_inicio_registro">Regístrate o inicia sesión</button>
</div>

@endsection

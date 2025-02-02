@extends('layout-perfil')

@section('head')

<!-- HEAD ADMINISTRADOR -->
<title>Administrador</title>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/administrador/administrador.css') }}">

@endsection

@section('content')

<div class="container py-5 mx-auto">
    
    <h4 class="text-dark">Panel de Administrador</h4>
    <p class="text-black-50">Aquí podrás consultar información de los usuarios en la base de datos</p>
    
    <div class="row align-items-center">
        <div class="col-6">
            <div class="text-black-50 mb-1 ml-1 txt_blue">Id o email</div>
            <p class="input__iconWrapper mb-4">
                <input class="form-control" type="text" name="userSearch" placeholder="Buscar usuario">
                <i class="far fa-search"></i>
            </p>
            
            <div class="error"></div>
        </div>
        
        <div id="loadingData" class="h1 text-info d-none col-6">
            <i class="fas fa-circle-notch fa-spin"></i>
        </div>
        
        <div id="tablesContainer" class="col-12"></div>
    </div>
</div>
    
@endsection

@section('js')
<!-- SCRIPTS ADMINISTRADOR -->
<script type="text/javascript" src="{{ URL::asset('js/administrador/administrador.js') }}"></script>
<!-- JS DATATABLES JQUERY -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
@endsection

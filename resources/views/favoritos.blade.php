@extends('layout-perfil')

@section('head')

<title>Favoritos</title>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productos/productSection.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productos/productSold.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productos/btnsActions.css') }}">

@endsection

@section('content')
<div id="product__container" class="container py-5 mx-auto">
    <div class="products__sections">
        <h4 class="text-dark">Tus favoritos</h4>
        <p class="text-black-50">Aquí podrá visualizar todos sus productos favoritos</p>
        
        @if(!empty($favoritos))
        <div class="row">
            
            @foreach($favoritos as $favorito)
            
            @include('include/favoritos/productSection')
            
            @endforeach
        </div>
        @else
            <div class="mb-3 text-black-50">No tiene ningún producto favorito</div>
            <img class="w-100" src="{{ URL::asset('imgs/perfil/items-empty-state.svg') }}">
        @endif
    </div>
</div>

@endsection

@section('js')
<!-- Scripts favoritos -->
@endsection

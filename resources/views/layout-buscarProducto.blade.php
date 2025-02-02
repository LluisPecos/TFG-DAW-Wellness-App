@extends('layout')

@section('head_layout')

<!-- HEAD LAYOUT BUSCAR -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/layout-buscarProducto.css') }}">

@endsection

@section('layout-buscarProducto')

<div id="filtros">
    <hr class="m-0">
    <div class="p-2 d-flex">
        
        <div class="filterContainer">
            <p class="input__iconWrapper">
                <select class="form-control rounded-pill" name="categoria">
                    <option value="">Todas las categorías</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}" @if($categoria->id_categoria == $request->categoria) selected @endif>{{ $categoria->categoria }}</option>
                        @endforeach
                </select>
                <i class="far fa-splotch"></i>
            </p>
        </div>
        
        <div class="filterContainer">
            <p class="input__iconWrapper">
                <select class="form-control rounded-pill" name="estado">
                    <option value="">Todos los estados</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id_estado }}" @if($estado->id_estado == $request->estado) selected @endif>{{ $estado->estado }}</option>
                        @endforeach
                </select>
                <i class="far fa-certificate"></i>
            </p>
        </div>
        
        <div class="filterContainer">
            <p class="input__iconWrapper">
                <input class="form-control rounded-pill" type="number" placeholder="Precio mínimo" name="minPrecio" value="{{ $request->minPrecio }}">
                <i class="far fa-search-dollar"></i>
            </p>
        </div>
        
        <div class="filterContainer">
            <p class="input__iconWrapper">
                <input class="form-control rounded-pill" type="number" placeholder="Precio máximo" name="maxPrecio" value="{{ $request->maxPrecio }}">
                <i class="far fa-search-dollar"></i>
            </p>
        </div>
        
        <div class="filterContainer mr-0">
            <p class="input__iconWrapper">
                <select class="form-control rounded-pill" name="modificadoHace">
                    <option value="">Ultima modificación</option>
                    <option value="1" @if(1 == $request->modificadoHace) selected @endif>1 Día</option>
                    <option value="7" @if(7 == $request->modificadoHace) selected @endif>7 Días</option>
                    <option value="30" @if(30 == $request->modificadoHace) selected @endif>30 Días</option>
                </select>
                <i class="far fa-calendar-alt"></i>
            </p>
        </div>
        
    </div>
    
</div>

@endsection
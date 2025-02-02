@extends('layout-perfil')

@section('head')

<title>{{ Request::is('subir-producto') ? "Subir producto" : "Editar producto" }}</title>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/perfil/perfil.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/productos/subirEditarProducto.css') }}">

@endsection

@if(session()->has('id'))
    @section('content')

    <div id="profile__container" class="container py-5 mx-auto row">
        <form id="form__upsertProduct" action="{{ (empty($producto)) ? url('insertar-producto') : url('actualizar-producto') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="profile__section px-4 py-4 col-12 col-md-8 mx-auto mb-4">
            
            @if(!empty($producto))
                @foreach($producto as $dato)
                    @php
                    $campos = $dato;
                    @endphp
                @endforeach
            @endif
                
                <p class="font-weight-bold">INFORMACIÓN DE TU PRODUCTO</p>
                
                @if(!empty($producto))<input type="hidden" name="id_producto" value="{{ $dato->id_producto }}">@endif
                <div class="row">
                    
                    <div class="form-group col-12">
                        <p class="text-black-50 mb-2">¿Qué estás vendiendo?</p>
                        <p class="input__iconWrapper">
                            <input id="nombre" type="text" name="nombre" class="form-control" value="@if(!empty($producto)){{$campos->nombre}}@endif" placeholder="En pocas palabras..." maxlength="255" required>
                            <i class="far fa-comment-dots rounded-circle"></i>
                        </p>
                        
                        <span class="error"></span>
                    </div>

                    <div class="form-group col-12">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <p class="text-black-50 mb-2">Categoría</p>
                                <p class="input__iconWrapper">
                                    <select id="categoria" name="categoria" class="form-control w-100" required>
                                    <option value="">Categoría</option>
                                        @if($categorias)
                                            @foreach($categorias as $categoria)
                                                <option value="{{ $categoria->id_categoria }}" @if(!empty($producto))@if($categoria->id_categoria == $dato->id_categoria){{ 'selected' }}@endif @endif>{{ $categoria->categoria }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <i class="far fa-splotch"></i>
                                </p>
                                
                                <span class="error"></span>
                            </div>

                            <div class="col-12 col-md-6">
                                <p class="text-black-50 mb-2">Precio</p>
                                <p class="input__iconWrapper">
                                    <input id="precio" name="precio" value="@if(!empty($producto)){{$dato->precio}}@endif" class="form-control" type="number" placeholder="Precio" min="0" max="999999999.99" required>
                                    <i class="far fa-euro-sign"></i>
                                </p>
                                
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-12">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <p class="text-black-50 mb-2">Estado del producto</p>
                                <p class="input__iconWrapper">
                                    <select id="estado" name="estado" class="form-control w-100" required>
                                        <option value="">Escoge un estado</option>
                                        @if($estados)
                                            @foreach($estados as $estado)
                                                <option value="{{ $estado->id_estado }}" @if(!empty($producto))@if($estado->id_estado == $dato->id_estado){{ 'selected' }}@endif @endif>{{ $estado->estado }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <i class="far fa-certificate"></i>
                                </p>
                                
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <p class="text-black-50 mb-2">Descripción</p>
                        <textarea id="descripcion" name="descripcion" class="form-control" style="height: 189px;" placeholder="Añade información relevante como estado, modelo, color..." maxlength="640">@if(!empty($producto)){{ $dato->descripcion }}@endif</textarea>
                        <span class="error"></span>
                    </div>
                </div>
            </div>
        
            <!-- IMGS -->
            <div class="profile__section px-4 py-4 col-12 col-md-8 mx-auto">
                <p class="font-weight-bold">FOTOS</p>
                <p class="error error_img"></p>
                
                <div class="row">
                    
                    @isset($imgs)
                        @foreach($imgs as $key=>$img)
                    
                            @if($loop->first)
                                <div class="btnImg col-12 col-sm-6 col-lg-4 col-xl-3 mb-3">
                                    <div class="@if(!empty($img)){{'imgContainerDelete'}}@else{{'imgContainer'}}@endif">
                                        <div id="imgPreview" style="background-image: url(@if(!empty($img)){{ URL::asset($img) }}@endif)">
                                            @if(!empty($img)) <div class="deleteImg"><i class="far fa-times"></i></div> @endif
                                        </div>
                                        <input type="file" name="img{{$loop->index}}" data-name="Imágen {{$loop->iteration}}" required>
                                        <i class="far fa-image @if(!empty($img)) d-none @endif"></i>
                                        <span class="text-black-50 font-weight-bold @if(!empty($img)) d-none @endif" style="position: absolute; bottom: 5px; font-size: 12px;">FOTO PRINCIPAL</span>
                                    </div>
                                </div>
                    
                            @else
                    
                                <div class="btnImg col-12 col-sm-6 col-lg-4 col-xl-3 mb-3">
                                    <div class="@if(!empty($img)){{'imgContainerDelete'}}@else{{'imgContainer'}}@endif">
                                        <div id="imgPreview" style="background-image: url(@if(!empty($img)){{ URL::asset($img) }}@endif)">
                                            @if(!empty($img)) <div class="deleteImg"><i class="far fa-times"></i></div> @endif
                                        </div>
                                        <input type="file" name="optional[]" data-name="Imágen {{$loop->iteration}}">
                                        <input type="hidden" name="deleteImg{{$loop->index}}" value="0">
                                        <i class="far fa-image @if(!empty($img)) d-none @endif"></i>
                                    </div>
                                </div>

                            @endif
                    
                        @endforeach
                    @else
                    
                        @for($i = 0; $i < 8; $i++)
                                            
                            @if($i == 0)
                    
                                <div class="btnImg col-12 col-sm-6 col-lg-4 col-xl-3 mb-3">
                                    <div class="imgContainer">
                                        <div id="imgPreview"></div>
                                        <input type="file" name="img{{$i}}" data-name="Imágen {{$i + 1}}" required>
                                        <i class="far fa-image"></i>
                                        <span class="text-black-50 font-weight-bold" style="position: absolute; bottom: 5px; font-size: 12px;">FOTO PRINCIPAL</span>
                                    </div>
                                </div>
                    
                            @else
                    
                                <div class="btnImg col-12 col-sm-6 col-lg-4 col-xl-3 mb-3">
                                    <div class="imgContainer">
                                        <div id="imgPreview"></div>
                                        <input type="file" name="optional[]" data-name="Imágen {{$i + 1}}">
                                        <i class="far fa-image"></i>
                                    </div>
                                </div>
                    
                            @endif
                            
                        @endfor
                    @endisset
                </div>
            </div>
        </form>

        <div class="col-12 col-md-8 p-0 mt-4 mx-auto">
            <input id="btnUpsertProduct" type="button" class="btn btn-info btn_general w-100" value="@if(empty($producto)){{ 'Insertar producto' }}@else{{ 'Modificar producto' }}@endif">
        </div>
    </div>

    

    @endsection

    @section('js')
    <!-- Scripts subir/editar producto -->
    <script type="text/javascript" src="{{ URL::asset('js/productos/subirEditarProducto.js') }}"></script>
    @endsection

@else

    @section('content')

    <div id="profile__container" class="container py-5 mx-auto">
        <p class="error">No has iniciado sesión</p>
        <button id="btn_reg" type="button" class="btn btn-info btn_general" data-toggle="modal" data-target="#modal_registro">Regístrate o inicia sesión</button>
    </div>

    @endsection

@endif

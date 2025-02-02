<div class="product form-group col-12">
    <div class="row align-items-center">
        <div class="col-12 col-sm-1">
            <input type="checkbox" class="form-control m-auto" value="{{ $producto['id_producto'] }}">
        </div>

        <div class="col-12 col-sm-11">
            <div class="product__section p-2">
                <div class="row align-items-center justify-content-center justify-content-md-start justify-content-md-start">
                    <a class="col-12 col-md-9 text-dark text-decoration-none" href="/producto/{{ $producto['id_producto'] }}">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-3" >
                                <div class="imgContainer m-auto m-md-0">
                                    <div style="background-image: url({{ $producto['img0'] }})">

                                    @if($producto['vendido'] == true)
                                        <div class="containerIconSold">
                                            <i class="far fa-handshake"></i>
                                        </div>
                                    @endif

                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-3 mb-3 mb-md-0 text-center text-md-left">

                                <p class="font-weight-bold m-0">{{ $producto['precio'] }} €</p>
                                <p class="text-black-50 m-0">{{ $producto['nombre'] }}</p>

                            </div>

                            <div class="col-12 col-md-3 mb-3 mb-md-0 text-center text-md-left">
                                <div class="text-black-50">Publicado</div>
                                <div class="font-weight-bold">{{ $producto['created_at'] }}</div>
                            </div>

                            @if($producto['vendido'] == true)

                                <div class="col-12 col-md-3 mb-3 mb-md-0 text-center text-md-left">
                                    <div class="text-black-50">Vendido</div>
                                    <div class="font-weight-bold">{{ $producto['fecha_vendido'] }}</div>
                                </div>

                            @else

                                <div class="col-12 col-md-3 mb-3 mb-md-0 text-center text-md-left">
                                    <div class="text-black-50">Modificado</div>
                                    <div class="font-weight-bold">{{ $producto['updated_at'] }}</div>
                                </div>

                            @endif
                        </div>
                    </a>
                    @if($producto['vendido'] == false)
                        <div class="col-12 col-md-3 actionsContainer">
                            <div class="mr-md-3 d-md-flex justify-content-end text-center">
                                <a class="text-decoration-none mr-0 mr-md-2" href="{{ url('editar-producto/' . $producto['id_producto']) }}">
                                    <button class="btnEdit btn border" type="button" data-toggle="tooltip" data-placement="top" title="Editar">
                                        <i class="far fa-pencil-alt"></i>
                                    </button>
                                </a>

                                <button class="btnSell btn border" type="button" data-toggle="tooltip" data-placement="top" title="Vender">
                                    <input type="hidden" name="id_producto" value="{{ $producto['id_producto'] }}">
                                    <i class="far fa-handshake"></i>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
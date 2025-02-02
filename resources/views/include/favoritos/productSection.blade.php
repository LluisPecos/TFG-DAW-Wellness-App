<div class="product form-group col-12">
    <div class="row align-items-center">
        <div class="col-12">
            <div class="product__section p-2">
                <div class="row align-items-center justify-content-center justify-content-md-start">
                    
                    <a class="col-12 col-md-9 text-dark text-decoration-none" href="/producto/{{ $favorito['id_producto'] }}">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-3" >
                                <div class="imgContainer m-auto m-md-0">
                                    <div style="background-image: url({{ $favorito['img0'] }})">

                                        @if($favorito['vendido'] == true)
                                            <div class="containerIconSold">
                                                <i class="far fa-handshake"></i>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 mb-3 mb-md-0 text-center text-md-left">
                                <p class="font-weight-bold m-0">{{ $favorito['precio'] }} €</p>
                                <p class="text-black-50 m-0">{{ $favorito['nombre'] }}</p>
                            </div>

                            @if($favorito['vendido'] == true)

                                <div class="col-12 col-md-3 mb-3 mb-md-0 text-center text-md-left">
                                    <div class="text-black-50">Vendido</div>
                                    <div class="font-weight-bold">{{ $favorito['fecha_vendido'] }}</div>
                                </div>

                            @else

                                <div class="col-12 col-md-3 mb-3 mb-md-0 text-center text-md-left">
                                    <div class="text-black-50">Modificado</div>
                                    <div class="font-weight-bold">{{ $favorito['updated_at'] }}</div>
                                </div>

                            @endif

                            <div class="col-12 col-md-3 mb-3 mb-md-0 text-center text-md-left">
                                <div class="text-black-50">Favorito añadido</div>
                                <div class="font-weight-bold">{{ $favorito['fecha_adicion'] }}</div>
                            </div>
                        </div>
                    </a>
                    
                    <div class="col-12 col-md-3 actionsContainer">
                        <div class="d-md-flex justify-content-end mr-0 mr-md-3 text-center text-md-left">
                            <form action="/deleteFavoriteProduct" method="POST">
                                {{ csrf_field() }}
                                <input name="id_producto" type="hidden" value="{{ $favorito['id_producto'] }}">
                                <button class="btnFavorite btn border liked" type="submit" data-toggle="tooltip" data-placement="top" title="Borrar favorito">
                                    <i class="far fa-heart liked"></i>
                                </button>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
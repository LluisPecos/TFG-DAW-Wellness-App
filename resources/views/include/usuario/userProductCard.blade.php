<div class="producto col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
    <a class="text-decoration-none" href="{{ url('producto/' . $producto['id_producto']) }}">
        <div class="card bg-white overflow-auto">
            
            <div class="imgContainer mx-1 mt-1">
                <div class="imgProduct" style="background-image: url({{ URL::asset($producto['img0']) }});" alt="Card image cap">
                    @if($producto['vendido'] == true)
                    
                    <div class="backgroundLargeIconSold">
                        <div class="containerLargeIconSold">
                            <i class="far fa-handshake"><span class="ml-2">Vendido</span></i>
                        </div>
                    </div>
                    
                    @endif
                </div>
            </div>
            
            <div>
                <div class="card-body">
                    <h5 class="card-title text-dark">{{ $producto['precio'] }} €</h5>
                    <h6 class="card-subtitle mb-2 text-dark font-weight-normal">{{ $producto['nombre'] }}</h6>
                    <p class="card-text text-black-50">
                    @if(empty($producto['descripcion']))
                        No se ha proporcionado ninguna descripción
                    @else
                        {{ $producto['descripcion'] }}
                    @endif
                    </p>
                </div>
            </div>
        </div>
    </a>
</div>
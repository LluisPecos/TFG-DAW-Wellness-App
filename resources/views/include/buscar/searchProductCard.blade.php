@if($productos)
    @foreach($productos as $producto)
        <div class="producto col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <form method="GET" action="{{ url('producto/' . $producto['id_producto']) }}" target="_blank">

                <input type="hidden" name="busqueda">
                <input type="hidden" name="categoria">
                <input type="hidden" name="estado">
                <input type="hidden" name="minPrecio">
                <input type="hidden" name="maxPrecio">
                <input type="hidden" name="modificadoHace">

                <div class="card bg-white overflow-auto">
                    <div class="imgProduct mx-1 mt-1" style="background-image: url({{ URL::asset($producto['img0']) }});" alt="Card image cap"></div>
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
            </form>
        </div>
    @endforeach
@endif
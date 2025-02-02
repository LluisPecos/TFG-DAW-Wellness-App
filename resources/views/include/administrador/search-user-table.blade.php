<table id="userDataTable" class="text-center display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Fecha Nacimiento</th>
            <th>Género</th>
            <th>Teléfono</th>
            <th>Rol</th>
            <th>Creado</th>
            <th>Actualizado</th>
        </tr>
    </thead>

    <tbody>
    @foreach($usuario as $datos)
        <tr>
            <td>{{ $datos['id_usuario'] }}</td>
            <td>{{ $datos['nombre'] }}</td>
            <td>{{ $datos['apellidos'] }}</td>
            <td>{{ $datos['email'] }}</td>
            <td>@if(!empty($datos['fecha_nacimiento'])) {{ $datos['fecha_nacimiento'] }} @else <i>NULL</i> @endif</td>
            <td>@if(!empty($datos['genero'])) {{ $datos['genero'] }} @else <i>NULL</i> @endif</td>
            <td>@if(!empty($datos['telefono'])) {{ $datos['telefono'] }} @else <i>NULL</i> @endif</td>
            <td>@if($datos['rol'] == "adm") Admin @else Usuario @endif</td>
            <td>{{ $datos['created_at'] }}</td>
            <td>@if(!empty($datos['updated_at'])) {{ $datos['updated_at'] }} @else <i>NULL</i> @endif</td>
        </tr>
    @endforeach
    </tbody>

</table>

@if(!empty($productos))
    <hr class="my-5">
    <table id="userProductsTable" class="text-center display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Precio</th>
                <th>Visitas</th>
                <th>Vendido</th>
                <th>Fecha Vendido</th>
                <th>Creado</th>
                <th>Actualizado</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        @foreach($productos as $producto)
            <tr>
                <td>{{ $producto['id_producto'] }}</td>
                <td>{{ $producto['precio'] }} €</td>
                <td>{{ $producto['visitas'] }}</td>
                <td>@if($producto['vendido'] == true) Sí @else No @endif</td>
                <td>@if(!empty($producto['fecha_vendido'])) {{ $producto['fecha_vendido'] }} @else <i>NULL</i> @endif</td>
                <td>{{ $producto['created_at'] }}</td>
                <td>{{ $producto['updated_at'] }}</td>
                <td class="d-flex justify-content-center align-items-center">
                    <div class="mr-1" data-toggle="tooltip" data-placement="top" title="Ver información">
                        <i class="fal fa-info-square fa-2x text-dark" data-toggle="modal" data-target="#product_info_{{ $loop->index }}"></i>
                    </div>
                    
                    <div data-toggle="tooltip" data-placement="top" title="Ir al producto">
                        <a target="_blank" href="{{ url('/producto') }}/{{ $producto['id_producto'] }}">
                            <i class="fal fa-external-link-square-alt fa-2x text-dark"></i>
                        </a>
                    </div>
                    
                </td>
                
                <div class="modal product_info" id="product_info_{{ $loop->index }}">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="d-flex justify-content-end">
                                <i class="far fa-times icon_close m-0" data-dismiss="modal" aria-label="Close"></i>
                            </div>

                            <!-- Modal Header -->
                            <div class="modal-header pt-0">
                                <h5 class="modal-title w-100 text-center">Información del producto</h5>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="text-center">
                                    <div class="row font-weight-bold">
                                        <div class="col-3">Nombre</div>
                                        <div class="col-3">Descripción</div>
                                        <div class="col-3">Categoría</div>
                                        <div class="col-3">Estado</div>
                                    </div>
                                    
                                    <hr class="mt-2">
                                    
                                    <div class="row">
                                        <div class="col-3">{{ $producto['nombre'] }}</div>
                                        <div class="col-3">{{ $producto['descripcion'] }}</div>
                                        <div class="col-3">{{ $producto['categoria'] }}</div>
                                        <div class="col-3">{{ $producto['estado'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </tr>
        @endforeach
        </tbody>

    </table>
@else
    <div class="error mt-4">El usuario no ha publicado ningún producto</div>
@endif
<div class="modal" id="modal_registro">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="modal_content_registro">
                <!-- Modal Header -->
                <div class="modal-header text-center align-items-center">
                    <i class="far fa-arrow-left icon_volver"></i>
                    <h5 class="modal-title w-100">Regístrate en Wellness</h5>
                    <i class="far fa-times icon_close" data-dismiss="modal" aria-label="Close"></i>
                </div>
                    
                <!-- Modal body -->
                <div class="modal-body">
                    <p class="error error_general mb-3 text-center"></p>
                    <form name="form_registro" action="{{ url('validar-registro') }}" method="post">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="form-group col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" placeholder="Nombre" name="nombre" autocomplete="off" required>
                                        <span class="error error_nombre"></span>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" placeholder="Apellidos" name="apellidos" autocomplete="off" required>
                                        <span class="error error_apellidos"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <p class="input__iconWrapper">
                                    <input type="email" class="form-control" placeholder="Email" name="email" autocomplete="off" required>
                                    <i class="far fa-envelope"></i>
                                </p>
                                <span class="error error_email"></span>
                            </div>
                            <div class="form-group col-12">
                                <p class="input__iconWrapper">
                                    <input type="password" class="form-control" placeholder="Contraseña" name="contraseña" required>
                                    <i class="far fa-key"></i>
                                </p>
                                <span class="error error_contraseña"></span>
                            </div>
                            <div class="form-group col-12">
                                <p class="input__iconWrapper">
                                    <input type="password" class="form-control" placeholder="Confirmar contraseña" name="contraseñaRepetida" required>
                                    <i class="far fa-key"></i>
                                </p>
                                <span class="error error_contraseñaRepetida"></span>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button id="btnSubmitRegister" class="btn btn-info btn_general" type="button">Regístrate</button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <p id="modal_footer" class="text-center m-0 p-3">
                    <span class="text-dark">Registrándote aceptas nuestras</span>
                    <br>
                    <a id="txt_condiciones" class="text-dark" href="">Condiciones de uso</a> <span class="text-dark">y</span> <a id="txt_privacidad" class="text-dark" href="">Política de privacidad</a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal_inicio">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="modal_content_registro">
                <!-- Modal Header -->
                <div class="modal-header text-center align-items-center">
                    <i class="far fa-arrow-left icon_volver"></i>
                    <div class="w-100">
                        <h5 class="modal-title w-100">¡Bienvenido de nuevo!</h5>
                    </div>
                    <i class="far fa-times icon_close" data-dismiss="modal" aria-label="Close"></i>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    <p class="error error_general mb-3 text-center"></p>
                    <form name="form_login" action="{{ url('validar-login') }}" method="post">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="form-group col-12">
                                <p class="input__iconWrapper">
                                    <input type="text" class="form-control" placeholder="Email" autocomplete="off" name="email">
                                    <i class="far fa-envelope"></i>
                                </p>
                                
                                <span class="error error_email"></span>
                            </div><div class="form-group col-12">
                            <p class="input__iconWrapper">
                                <input type="password" class="form-control" placeholder="Contraseña" name="contraseña" autocomplete="off">
                                <i class="far fa-key"></i>
                            </p>
                            <span class="error error_contraseña"></span>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button id="btnSubmitLogin" class="btn btn-info btn_general" type="button">Inicia sesión</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <p id="modal_footer" class="text-center m-0 p-3">
                <span class="text-dark">Registrándote aceptas nuestras</span>
                <br>
                <a id="txt_condiciones" class="text-dark" href="">Condiciones de uso</a> <span class="text-dark">y</span> <a id="txt_privacidad" class="text-dark" href="">Política de privacidad</a>
            </p>
        </div>
    </div>
</div>
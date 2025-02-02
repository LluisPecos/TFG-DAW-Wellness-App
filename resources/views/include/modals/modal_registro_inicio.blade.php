<!-- Modal registro / inicio 
<div class="modal" id="modal_registro">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="modal_content_registro">
                Modal Header
                <div class="modal-header text-center">
                    <img id="img_volver" src="{{URL::asset('imgs/general/flecha-izquierda.svg')}}" style="opacity: 0; cursor: default">

                    <div class="w-100">
                        <h5 class="modal-title">Bienvenido a Wellness</h5>
                        <p class="text-black-50 m-0">Regístrate o inicia sesión</p>
                    </div>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                Modal body
                <div class="modal-body">
                    <p class="text-center m-0">
                        <a id="a_inicio" class="mr-4 text-decoration-none txt_blue">Inicia sesión</a><span class="txt_blue">|</span><a id="a_registro" class="ml-4 text-decoration-none txt_blue">Regístrate</a>
                    </p>
                </div>
            </div>

            <p id="modal_registro_footer" class="text-center m-0 p-3">
                <span class="text-dark">Registrándote aceptas nuestras</span>
                <br>
                <a id="txt_condiciones" class="text-dark" href="">Condiciones de uso</a> <span class="text-dark">y</span> <a id="txt_privacidad" class="text-dark" href="">Política de privacidad</a>
            </p>
        </div>
    </div>
</div>
-->

<script type="text/javascript">
    let modal_content_registro = document.getElementById("modal_content_registro");

    inicio();
    function inicio() {
        let a_inicio = document.getElementById("a_inicio");
        
        // Event listener inicio
        a_inicio.addEventListener("click", function() {
            
            modal_content_registro.innerHTML = '<div class="modal-header text-center"><img id="img_volver" src="{{URL::asset('imgs/general/flecha-izquierda.svg')}}" style="width: 50px"><div class="w-100"><h5 class="modal-title w-100">¡Bienvenido de nuevo!</h5></div><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body"><p class="error error_general mb-3 text-center"></p><form name="form_login" action="{{ url('validar-login') }}" method="post"><div class="row">{{ csrf_field() }}<div class="form-group col-12"><input id="email" type="text" class="form-control" placeholder="Email" autocomplete="off" name="email"><span class="error error_email"></span></div><div class="form-group col-12"><input id="contraseña" type="password" class="form-control" placeholder="Contraseña" name="contraseña" autocomplete="off"><span class="error error_contraseña"></span></div><div class="col-12 d-flex justify-content-end"><button id="btn_submit" class="btn btn-info btn_general" type="button">Inicia sesión</button></div></div></form></div>';
            
            let img_volver = document.getElementById("img_volver");
            img_volver.addEventListener("click", volver);
            
            let btn_submit = document.getElementById("btn_submit");
            btn_submit.onclick = validar_login;
            
            // Validar email
            let email = document.getElementById("email");
            
            email.oninput = validar_login_email;
            email.onfocusout = validar_login_email;
            
            // Validar contraseña
            let contraseña = document.getElementById("contraseña");
            
            contraseña.oninput = validar_login_contraseña;
            contraseña.onfocusout = validar_login_contraseña;
            
            /* Submit on press "Enter" key */
            let modal_body = document.getElementsByClassName("modal-body")[0];
            let modal_body_ipts = modal_body.getElementsByTagName("input");
            
            for(let i = 0; i < modal_body_ipts.length; i++) {
                modal_body_ipts[i].addEventListener("keyup", function(evt) {
                    if(evt.key == "Enter") {
                        console.log("a");
                        validar_login();
                    }
                });
            }
        });
    }
    
    registro();
    function registro() {
        let a_registro = document.getElementById("a_registro");
        
        // Event listener registro
        a_registro.addEventListener("click", function() {
            
            modal_content_registro.innerHTML = '<div class="modal-header text-center"><img id="img_volver" src="{{URL::asset('imgs/general/flecha-izquierda.svg')}}" style="width: 50px;><div class="w-100"><h5 class="modal-title w-100">Regístrate en Wellness</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body"><p class="error error_general mb-3 text-center"></p><form name="form_registro" action="{{ url('validar-registro') }}" method="post"><div class="row">{{ csrf_field() }}<div class="form-group col-12"><div class="row"><div class="col-6"><input id="nombre" type="text" class="form-control" placeholder="Nombre" name="nombre" autocomplete="off" required><span class="error error_nombre"></span></div><div class="col-6"><input id="apellidos" type="text" class="form-control" placeholder="Apellidos" name="apellidos" autocomplete="off" required><span class="error error_apellidos"></span></div></div></div><div class="form-group col-12"><input id="email" type="email" class="form-control" placeholder="Email" name="email" autocomplete="off" required><span class="error error_email"></span></div><div class="form-group col-12"><input id="contraseña" type="password" class="form-control" placeholder="Contraseña" name="contraseña" required><span class="error error_contraseña"></span></div><div class="form-group col-12"><input id="contraseña_repetida" type="password" class="form-control" placeholder="Confirmar contraseña" name="contraseña_repetida" required><span class="error error_contraseña_repetida"></span></div><div class="col-12 d-flex justify-content-end"><button id="btn_submit" class="btn btn-info btn_general" type="button">Regístrate</button></div></div></form></div>';
            
            let img_volver = document.getElementById("img_volver");
            img_volver.addEventListener("click", volver);
            
            let btn_submit = document.getElementById("btn_submit");
            btn_submit.onclick = validar_registro;
            
            // Validar email
            let email = document.getElementById("email");
            email.oninput = validar_registro_email;
            email.onfocusout = validar_registro_email;
            
            // Validar nombre
            let nombre = document.getElementById("nombre");
            nombre.oninput = validar_registro_nombre;
            nombre.onfocusout = validar_registro_nombre;
            
            // Validar apellidos
            let apellidos = document.getElementById("apellidos");
            apellidos.oninput = validar_registro_apellidos;
            apellidos.onfocusout = validar_registro_apellidos;
            
            // Validar contraseña
            let contraseña = document.getElementById("contraseña");
            contraseña.oninput = function() {
                validar_registro_contraseña();
                validar_registro_contraseña_repetida(); // validar coincidencia
            };
            contraseña.onfocusout = function() {
                validar_registro_contraseña();
                validar_registro_contraseña_repetida(); // validar coincidencia
            };
            
            // Validar contraseña repetida
            let contraseña_repetida = document.getElementById("contraseña_repetida");
            contraseña_repetida.oninput = function() {
                validar_registro_contraseña();
                validar_registro_contraseña_repetida(); // validar coincidencia
            };
            contraseña_repetida.onfocusout = function() {
                validar_registro_contraseña();
                validar_registro_contraseña_repetida(); // validar coincidencia
            };
            
            /* Submit on press "Enter" key */
            let modal_body = document.getElementsByClassName("modal-body")[0];
            let modal_body_ipts = modal_body.getElementsByTagName("input");
            
            for(let i = 0; i < modal_body_ipts.length; i++) {
                modal_body_ipts[i].addEventListener("keyup", function(evt) {
                    if(evt.key == "Enter") {
                        console.log("a");
                        validar_registro();
                    }
                });
            }
        });
    }
    
    function volver() {
        
        modal_content_registro.innerHTML = '<div class="modal-header text-center"><img id="img_volver" src="{{URL::asset('imgs/general/flecha-izquierda.svg')}}" style="width: 50px; opacity: 0; cursor: default"><div class="w-100"><h5 class="modal-title">Bienvenido a Wellness</h5><p class="text-black-50 m-0">Regístrate o inicia sesión</p></div><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body"><p class="text-center m-0" style="font-size: 20px;"><a id="a_inicio" class="mr-4 text-decoration-none txt_blue" style="cursor: pointer">Inicia sesión</a><span class="txt_blue">|</span><a id="a_registro" class="ml-4 text-decoration-none txt_blue" style="cursor: pointer">Regístrate</a></p></div>';

        inicio();
        registro();
    }
</script>

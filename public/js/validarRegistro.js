$(document).ready(function() {
    
    // Submit register
    $("#btnSubmitRegister").each(function() {
        $(this).on("click", function() {
            let $form = $(this).closest('form');
            validarRegistro($form);
        });
    });
    
    // Validate register in input / focusout
    $("form[name=form_registro]").each(function() {
        let $form = $(this);
        
        $(this).find("input").each(function() {
            $(this).on("input", function() {
                validarCamposRegistro($form);
            });
        });
    });
    
    let $formRegistro;

    function validarRegistro($form) {
        $formRegistro = $form;
        
        let validNombre = validarRegistroNombre();
        let validApellidos = validarRegistroApellidos();
        let validEmail = validarRegistroEmail();
        let validContraseña = validarRegistroContraseña();
        let validContraseñaRepetida = validarRegistroContraseñaRepetida();

        if (validNombre == false || validApellidos == false || validEmail == false || validContraseña == false || validContraseñaRepetida == false) {
            // No hacer nada
        } else {

            let $email = $formRegistro.find("input[name=email]").val();

            $.ajax({

                url: "/validar-registro-ajax",
                type: "POST",
                data: {'email': $email},
                success: function (respuesta) {
                    let $error_general = $formRegistro.closest("div.modal").find(".error_general");

                    if (respuesta == "registroExito") {
                        $error_general.html("");
                        $formRegistro.trigger("submit");

                    } else {
                        $formRegistro.find("input[name=email]").css("border-color", "rgba(255, 0, 0, 0.6)");
                        $error_general.html(respuesta);
                    }
                }
            });
        }
    }

    function validarCamposRegistro($form) {
        $formRegistro = $form;
        let $error_general = $formRegistro.closest("div.modal").find(".error_general");
        $error_general.html("");
        validarRegistroNombre();
        validarRegistroApellidos();
        validarRegistroEmail();
        validarRegistroContraseña();
        validarRegistroContraseñaRepetida();
    }

    function validarRegistroNombre() {
        let $nombre = $formRegistro.find("input[name=nombre]");
        let $errorNombre = $formRegistro.find(".error_nombre");

        try {
            let $nombreVal = $nombre.val();

            if ($nombreVal) {

                let patron = /^.+$/;

                if(patron.test($nombreVal)) {
                    $nombre.css("border-color", "");
                    $errorNombre.html("");
                    return true;

                } else {
                    throw "Escribe un nombre válido";
                }

            } else {
                throw "Este campo es obligatorio";
            }

        } catch(error) {
            $nombre.css("border-color", "rgba(255, 0, 0, 0.6)");
            $errorNombre.html(error);
            return false;
        }
    }

    function validarRegistroApellidos() {
        let $apellidos = $formRegistro.find("input[name=apellidos]");
        let $errorApellidos = $formRegistro.find(".error_apellidos");

        try {
            let $apellidosVal = $apellidos.val();

            if ($apellidosVal) {

                let patron = /^.+$/;

                if(patron.test($apellidosVal)) {
                    $apellidos.css("border-color", "");
                    $errorApellidos.html("");
                    return true;
                } else {
                    throw "Escribe unos apellidos válidos";
                }

            } else {
                throw "Este campo es obligatorio";
            }

        } catch(error) {
            $apellidos.css("border-color", "rgba(255, 0, 0, 0.6)");
            $errorApellidos.html(error);
            return false;
        }
    }

    function validarRegistroEmail() {
        let $email = $formRegistro.find("input[name=email]");
        let $errorEmail = $formRegistro.find(".error_email");

        try {
            let $emailVal = $email.val();

            if ($emailVal) {

                let patron = /^.+@.+\..+$/;

                if(patron.test($emailVal)) {
                    $email.css("border-color", "");
                    $errorEmail.html("");
                    return true;

                } else {
                    throw "Introduce un email válido";
                }

            } else {
                throw "Este campo es obligatorio";
            }

        } catch(error) {
            $email.css("border-color", "rgba(255, 0, 0, 0.6)");
            $errorEmail.html(error);
            return false;
        }


    }

    // Validar contraseña
    function validarRegistroContraseña() {
        let $contraseña = $formRegistro.find("input[name=contraseña]");
        let $errorContraseña = $formRegistro.find(".error_contraseña");

        try {
            let $contraseñaVal = $contraseña.val();

            if ($contraseñaVal) {

                let patron = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d\w\W]{8,25}$/;

                if(patron.test($contraseñaVal)) {
                    $contraseña.css("border-color", "");
                    $errorContraseña.html("");
                    return true;

                } else {
                    throw "Mínimo 8 caracteres, 1 minúscula, 1 mayúscula y 1 número";
                }

            } else {
                throw "Este campo es obligatorio";
            }

        } catch(error) {
            $contraseña.css("border-color", "rgba(255, 0, 0, 0.6)");
            $errorContraseña.html(error);
            return false;
        }
    }

    // Validar contraseña repetida
    function validarRegistroContraseñaRepetida() {
        let $contraseña = $formRegistro.find("input[name=contraseña]");
        let $contraseñaRepetida = $formRegistro.find("input[name=contraseñaRepetida]");
        let $errorContraseñaRepetida = $formRegistro.find(".error_contraseñaRepetida");

        try {
            let $contraseñaVal = $contraseña.val();
            let $contraseñaRepetidaVal = $contraseñaRepetida.val();

            // Si no esta vacía
            if ($contraseñaRepetidaVal) {

                if ($contraseñaVal == $contraseñaRepetidaVal) {
                    $contraseñaRepetida.css("border-color", "");
                    $errorContraseñaRepetida.html("");
                    return true;

                } else {
                    throw "La contraseña no coincide";
                }

            } else {
                throw "Este campo es obligatorio";
            }

        } catch(error) {
            $contraseñaRepetida.css("border-color", "rgba(255, 0, 0, 0.6)");
            $errorContraseñaRepetida.html(error);
            return false;
        }
    }
});
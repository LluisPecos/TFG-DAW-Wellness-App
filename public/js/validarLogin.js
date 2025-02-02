$(document).ready(function() {
    
    // Submit login
    $("#btnSubmitLogin").each(function() {
        $(this).on("click", function() {
            let $form = $(this).closest('form');
            validarLogin($form);
        });
    });
    
    // Validate login in input / focusout
    $("form[name=form_login]").each(function() {
        let $form = $(this);
        
        $(this).find("input").each(function() {
            $(this).on("input", function() {
                validarCamposLogin($form);
            });
        });
    });
    
    let $formLogin;

    function validarLogin($form) {
        $formLogin = $form;

        let validEmail = validarLoginEmail();
        let validContraseña = validarLoginContraseña();

        if (validEmail == false || validContraseña == false) {
            // No hacer nada
        } else {

            let $email = $formLogin.find("input[name=email]").val();
            let $contraseña = $formLogin.find("input[name=contraseña]").val();

            $.ajax({

                url: "/validar-login-ajax",
                type: "POST",
                data: {'email': $email, 'contraseña': $contraseña},
                success: function (respuesta) {
                    let $error_general = $formLogin.closest("div.modal").find(".error_general");

                    if (respuesta == "loginExito") {
                        $error_general.html("");
                        $formLogin.trigger("submit");

                    } else {
                        if(respuesta == "Dirección de email no registrada") {
                            $formLogin.find("input[name=email]").css("border-color", "rgba(255, 0, 0, 0.6)");
                        } else {
                            $formLogin.find("input[name=contraseña]").css("border-color", "rgba(255, 0, 0, 0.6)");
                        }
                        $error_general.html(respuesta);
                    }
                }
            });
        }
    }

    function validarCamposLogin($form) {
        $formLogin = $form;
        let $error_general = $formLogin.closest("div.modal").find(".error_general");
        $error_general.html("");
        validarLoginEmail();
        validarLoginContraseña();
    }

    function validarLoginEmail() {
        let $email = $formLogin.find("input[name=email]");
        let $errorEmail = $formLogin.find(".error_email");

        try {
            let $emailVal = $email.val();

            if ($emailVal) {

                let patron = /^.+@.+\..+$/;

                if(patron.test($emailVal)) {

                    $email.css("border-color", "");
                    $errorEmail.html("");
                    validarLoginContraseña();
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

    function validarLoginContraseña() {
        let $email = $formLogin.find("input[name=email]");
        let $contraseña = $formLogin.find("input[name=contraseña]");
        let $errorContraseña = $formLogin.find(".error_contraseña");

        try {
            let $contraseñaVal = $contraseña.val();

            if ($contraseñaVal) {

                $contraseña.css("border-color", "");
                $errorContraseña.html("");
                return true;

            } else {
                throw "Este campo es obligatorio";
            }

        } catch(error) {
            $contraseña.css("border-color", "rgba(255, 0, 0, 0.6)");
            $errorContraseña.html(error);
            return false;
        }
    }
});
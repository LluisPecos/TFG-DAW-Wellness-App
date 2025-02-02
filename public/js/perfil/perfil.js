$(document).ready(function() {
    
    // Validación datos perfil
    let $originalNombre = $("#nombre").val();
    let $originalApellidos = $("#apellidos").val();
    let $originalFechaNacimiento = $("#fechaNacimiento").val();
    let $originalGenero = $("#genero").val();
    let $originalEmail = $("#email").val();
    let $originalTelefono = $("#telefono").val();
    
    
    $("#btnSubmitDatos").on("click", function() {
        $(this)[0].disabled = true;
        $(this).parents('form').submit();
    });
    
    $("#form__profileData .form-control").on("input", function() {
        let submitForm = validarCampos();
        
        if(submitForm == true) {
            $("#btnSubmitDatos").attr("disabled", false);
        } else {
            $("#btnSubmitDatos").attr("disabled", true);
        }
    });
    
    function validarCampos() {
        let nombre = validarNombre();
        let apellidos = validarApellidos();
        let fechaNacimiento = validarFechaNac();
        let genero = validarGenero();
        let email = validarEmail();
        let telefono = validarTelefono();
        
        if(nombre == false || apellidos == false || email == false || fechaNacimiento == false || genero == false || telefono == false) {
            return false;
        } else {
            return true;
        }
    }

    function validarNombre() {
        let $nombre = $("#nombre");
        let $nuevoNombre = $nombre.val();
        let $errorMessage = $nombre.siblings(".error");
        let patron = /^.+$/;
        
        if(patron.test($nuevoNombre)) {
            $nombre.css("border-color", "");
            $errorMessage.html("");
            return true;
        } else {
            $nombre.css("border-color", "rgba(255, 0, 0, 0.6)");
            $errorMessage.html("Este campo no puede quedar vacío");
            return false;
        }
    }

    function validarApellidos() {
        let $apellidos = $("#apellidos");
        let $nuevosApellidos = $apellidos.val();
        let $errorMessage = $apellidos.siblings(".error");
        let patron = /^.+$/;

        if(patron.test($nuevosApellidos)) {
            $apellidos.css("border-color", "");
            $errorMessage.html("");
            return true;
        } else {
            $apellidos.css("border-color", "rgba(255, 0, 0, 0.6)");
            $errorMessage.html("Este campo no puede quedar vacío");
            return false;
        }
        
    }

    function validarFechaNac() {
        let $fechaNacimeinto = $("#fechaNacimiento");
        let $nuevafechaNacimiento = $fechaNacimeinto.val();
        let $errorMessage = $fechaNacimeinto.parent().siblings(".error");
        let patron = /^(\d{4}-\d{2}-\d{2}|^$)$/;
        
        if(patron.test($nuevafechaNacimiento)) {
            $fechaNacimeinto.css("border-color", "");
            $errorMessage.html("");
            return true;
        } else {
            $fechaNacimeinto.css("border-color", "rgba(255, 0, 0, 0.6)");
            $errorMessage.html("Fecha incorrecta");
            return false;
        }
    }

    function validarGenero() {
        let $genero = $("#genero");
        let $nuevoGenero = $genero.val();
        let $errorMessage = $genero.parent().siblings(".error");
        let patron = /^(M|F|^$)$/;
        
        if(patron.test($nuevoGenero)) {
            $genero.css("border-color", "");
            $errorMessage.html("");
            return true;
        } else {
            $genero.css("border-color", "rgba(255, 0, 0, 0.6)");
            $errorMessage.html("Género incorrecto");
            return false;
        }
    }
    
    function validarEmail() {
        let $email = $("#email");
        let $nuevoEmail = $email.val();
        let $errorMessage = $email.parent().siblings(".error");
        let patron = /^.+@.+\..+$/;
        
        if($nuevoEmail) {
            if(patron.test($nuevoEmail)) {
                $email.css("border-color", "");
                $errorMessage.html("");
                return true;
            } else {
                $email.css("border-color", "rgba(255, 0, 0, 0.6)");
                $errorMessage.html("Introduce un email válido");
                return false;
            }
        } else {
            $email.css("border-color", "rgba(255, 0, 0, 0.6)");
            $errorMessage.html("Este campo no puede quedar vacío");
            return false;
        }
    }
    
    function validarTelefono() {
        let $telefono = $("#telefono");
        let $nuevoTelefono = $telefono.val();
        let $errorMessage = $telefono.parent().siblings(".error");
        let patron = /^(\d{9}|^$)$/;
        
        if(patron.test($nuevoTelefono)) {
            $telefono.css("border-color", "");
            $errorMessage.html("");
            return true;
        } else {
            $telefono.css("border-color", "rgba(255, 0, 0, 0.6)");
            $errorMessage.html("Introduce un teléfono válido");
            return false;
        }
    }

    function sameValues(nuevo, original) {
        if(original != nuevo) {
            return false;
        } else {
            return true;
        }
    }
    
    // Cambiar foto al hacer click sobre btn
    document.getElementById("btnSelectFile").onclick = function() {
        document.getElementById("imgPerfil").click();
    };
    
    document.getElementById("imgPerfil").addEventListener("change", function(e) {
        validateImgProfile(this);
    });
    
    $("#btnSubmitImg").on("click", function(e) {
        e.preventDefault();
        $(this)[0].disabled = true;
        $(this).parents('form').submit();
    });
    
    // Validación imágen perfil
    let msjErroresImgs = [];
    let $error_img = $(".error_img")[0];
    
    function validateImgProfile() {
        
        msjErroresImgs = [];
        $error_img.innerHTML = "";
        
        let $input = $("input[type=file]")[0];
        let file = $input.files[0];
        let fileType = file.type;
        let fileSizeB = file.size;
        let fileSizekB = fileSizeB / 1024;
        
        $(".imgName").html(file.name);
        
        if($input.value && (fileType == "image/jpeg" || fileType == "image/png") && fileSizekB <= 1024) {
            document.getElementById("btnSubmitImg").disabled = false;
            document.getElementsByClassName("error_img")[0].innerHTML = "";
        } else {
            
            if(fileType != "image/jpeg" && fileType != "image/png") {
                msjErroresImgs.push("Solo se admite formato .jpg o .png");
            }

            if(fileSizekB >= 1024) {
                msjErroresImgs.push("Peso máximo de 1MB");
            }

            document.getElementById("btnSubmitImg").disabled = true;
        }
        
        for(let i = 0; i < msjErroresImgs.length; i++) {
            
            if(i == msjErroresImgs.length - 1) {
                $error_img.innerHTML += msjErroresImgs[i];
            } else {
                $error_img.innerHTML += msjErroresImgs[i] + "<br>";
            }
            
        }
    }
});
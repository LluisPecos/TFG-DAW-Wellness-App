$(document).ready(function() {
    
    // Validación formulario
    $("#btnUpsertProduct").on("click", function(e) {
        insertarProducto(this);
    });
    
    let msjErroresImgs = [];
    let $error_img = $(".error_img")[0];
    
    function insertarProducto(btnUpsertProduct) {
        
        let validFields = validateFields();
        let validImages = validateImages();
        
        if (validFields == false || validImages == false) {
            // No hacer nada
        } else {
            // Activar los input file
            $("input[type=file]").each(function() {
                this.disabled = false;
            });
            
            // Insertar producto haciendo submit del formulario
            $("#btnUpsertProduct")[0].disabled = true;
            $("#form__upsertProduct").submit();
        }
    }
    
    $("#nombre, #categoria, #precio, #estado").on("input", function() {
        emptyFieldValue(this.id);
    });

    function emptyFieldValue(field) {
        let $value = $(field).val();

        if(!$value) {
            $(field).parent().siblings(".error").html("Este campo no puede quedar vacío");
            $(field).css("border-color", "rgba(255, 0, 0, 0.6)");
            return true;
        }
    }
    
    function checkMinMaxPrecio(field) {
        let $value = $(field).val();
        
        if($value < 0) {
            $(field).parent().siblings(".error").html("El precio no puede ser menor a 0 €");
            $(field).css("border-color", "rgba(255, 0, 0, 0.6)");
            return false;
            
        } else if($value > 999999999.99) {
            $(field).parent().siblings(".error").html("El precio no puede ser mayor a 999.999.999,99 €");
            $(field).css("border-color", "rgba(255, 0, 0, 0.6)");
            return false;
        } else {
            return true;
        }
    }
    
    function exceededMaxChars(length) {
        if(length > 640) {
            return true;
        } else {
            return false;
        }
    }
    
    // Validar campos
    function validateFields() {
        let nombre = emptyFieldValue($("#nombre"));
        let categoria = emptyFieldValue($("#categoria"));
        let precio = emptyFieldValue($("#precio"));
        let estado = emptyFieldValue($("#estado"));
        let descripcion = exceededMaxChars($("#descripcion").length);
        let haveMinPrecio = checkMinMaxPrecio($("#precio"));
        
        if(nombre == true || categoria == true || precio == true || estado == true || descripcion == true || haveMinPrecio == false) {
            return false;
        }
        
        return true;
    }
    
    // Validar imgs
    function validateImages() {
        msjErroresImgs = [];
        $error_img.innerHTML = "";
        imgsValidated = true;
        
        $("input[type=file]").each(function() {
            
            $(this).parent().css("border-color", "");
            
            if(validateImageFormat(this) == false){
                imgsValidated = false;
            }
        });
        
        if(isRequiredImage($("input[type=file][required]")) == false) {
            imgsValidated = false;
        }
        
        for(let i = 0; i < msjErroresImgs.length; i++) {
            if(i == (msjErroresImgs.length - 1)) {
                $error_img.innerHTML += msjErroresImgs[i];
            } else {
                $error_img.innerHTML += msjErroresImgs[i] + "<br>";
            }
        }
        
        if(imgsValidated == false) {
            return false;
        }
        
        return true;
    }
    
    function validateImageFormat(input) {
        if(input.value) {
            
            let file = input.files[0];
            let fileType = file.type;
            let fileSizeB = file.size;
            let fileSizekB = fileSizeB / 1024;
            
            if(fileType != "image/jpeg" && fileType != "image/png") {
                msjErroresImgs.push(input.dataset.name + ": Solo se permiten formatos .jpg o .png");
            }
            
            if(fileSizekB > 1024) {
                msjErroresImgs.push(input.dataset.name + ": El tamaño máximo es de 1MB");
            }
            
            if((fileType != "image/jpeg" && fileType != "image/png") || fileSizekB > 1024) {
                $(input).parent().css("border-color", "rgba(255, 0, 0, 0.6)");
                return false;
            }
            
            return true;
        }
    }
    
    function isRequiredImage(field) {
        let urlPath = window.location.pathname;
        
        if(urlPath.includes("/editar-producto/")) {
            return true;
            
        } else {
            if(field[0].files.length == 0) {
                msjErroresImgs.push("La foto principal no puede quedar vacía");
                $(field).closest(".imgContainer").css("border-color", "rgba(255, 0, 0, 0.6)");
                $(field).css("border-color", "rgba(255, 0, 0, 0.6)");
                return false;
            }
        }
    }
    
    // Eliminar mensajes de error inputs
    $("#form__upsertProduct .form-control").on("input", function() {
        $(this).parent().siblings(".error").html("");
        $(this).css("border-color", "");
        
        validateFields();
    });
    
    // Cambiar imágenes producto
    $("input[type=file]").closest(".btnImg").on("click", function() {
        let $inputImg = $(this).find("input[type=file]");
        $inputImg.get(0).click();
    });
    
    $("#form__upsertProduct input[type=file]").on("change", function(){
        if(this.files && this.files[0]) {
            let reader = new FileReader();
            
            $(this).parent().attr("class", "imgContainerDelete");
            $(this).siblings("i").addClass("d-none");
            $(this).siblings("span").addClass("d-none");
            this.disabled = true;
            $imgPreview = $(this).siblings("#imgPreview");
            $imgPreview.append("<div class='deleteImg'><i class='far fa-times'></i></div>");
            addDeleteImgListener(this);
            
            reader.onload = function (e) {
                $imgPreview.attr('style', "background-image: url('" + e.target.result + "')");
            }
            
            reader.readAsDataURL(this.files[0]);
            
            let urlPath = window.location.pathname;
        
            if(urlPath.includes("/editar-producto/")) {
                $(this).siblings("input[type=hidden]").val("0");
            }
        }
        
        validateImages();
    });
    
    // Editar producto
    $(".imgContainerDelete input[type=file]").each(function() {
        this.disabled = true;
        addDeleteImgListener(this);
    });
    
    // Al hacer click sobre el botón de borrar img
    function addDeleteImgListener(input) {
        $(input).siblings("#imgPreview").find(".deleteImg").on("mouseup", function() {
            $(this).parent().attr("style", ""); // Quitar background-image de imgPreview
            input.disabled = false;
            $(input).siblings("i").removeClass("d-none");
            $(input).siblings("span").removeClass("d-none");
            $(input).parent().attr("class", "imgContainer");
            $(input).val("");
            $(this).remove();
            
            let urlPath = window.location.pathname;
            
            if(urlPath.includes("/editar-producto/")) {
                $(input).siblings("input[type=hidden]").val("1");
            }
            
            validateImages();
        });
    }
});

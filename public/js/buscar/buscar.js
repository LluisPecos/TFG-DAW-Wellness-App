$(document).ready(function() {
    let $busqueda = $("#ipt_buscador");
    let $estado = $("select[name=estado]");
    let $categoria = $("select[name=categoria]");
    let $minPrecio = $("input[type=number][name=minPrecio]");
    let $maxPrecio = $("input[type=number][name=maxPrecio]");
    let $modificadoHace = $("select[name=modificadoHace]");
    
    let $busquedaVal = $busqueda.val();
    let $estadoVal = $estado.val();
    let $categoriaVal = $categoria.val();
    let $minPrecioVal = $minPrecio.val();
    let $maxPrecioVal = $maxPrecio.val();
    let $modificadoHaceVal = $modificadoHace.val();
    
    $mostrarMasProductos = $("#mostrarMasProductos");
    $showMoreProducts = $("#showMoreProducts");
    $errorLoadingProducts = $("#errorLoadingProducts");
    $loadingProducts = $("#loadingProducts");
    
    addProductsListeners();
    
    let offset = 20;
    let productsLoaded = true;
    
    $mostrarMasProductos.on("click", function() {
        if(productsLoaded == true) {
            productsLoaded = false;
            
            $mostrarMasProductos.addClass("d-none");
            $loadingProducts.removeClass("d-none");
            
            console.log("offset: " + offset);
            console.log("$busqueda: " + $busquedaVal);
            console.log("$estado: " + $estadoVal);
            console.log("$categoria: " + $categoriaVal);
            console.log("$minPrecio: " + $minPrecioVal);
            console.log("$maxPrecio: " + $maxPrecioVal);
            console.log("$modificadoHace: " + $modificadoHaceVal);

            $.ajax({
                url: "/mostrarMasProductos",
                type: "POST",
                data: {
                    offset : offset,
                    busqueda : $busquedaVal,
                    estado : $estadoVal,
                    categoria : $categoriaVal,
                    minPrecio : $minPrecioVal,
                    maxPrecio : $maxPrecioVal,
                    modificadoHace : $modificadoHaceVal,
                },
                success: function(response){
                    $loadingProducts.addClass("d-none");

                    if(response == false) {
                        $errorLoadingProducts.removeClass("d-none");
                    } else {
                        $(".allProducts").append(response);
                        $mostrarMasProductos.removeClass("d-none");
                        addProductsListeners();
                        offset = offset + 20;
                    }

                    productsLoaded = true;
                },

                error: function(response) {
                    $loadingProducts.addClass("d-none");
                    $errorLoadingProducts.html("ERROR<br><b>Message:</b> " + response.responseJSON.message + "<br>" + "<b>Exception:</b> " + response.responseJSON.exception);
                    $errorLoadingProducts.removeClass("d-none");
                    console.error(response);
                    console.log("Exception: " + response.responseJSON.exception);
                    console.log("Message: " + response.responseJSON.message);
                    productsLoaded = true;
                }
            });
        }
    });
    
    $("#filtros input").on("keyup", function() {
        filtrarProductos();
    });
    
    $("#filtros select").on("change", function() {
        filtrarProductos();
    });
    
    function filtrarProductos() {
        $estadoVal = $estado.val();
        $categoriaVal = $categoria.val();
        $minPrecioVal = $minPrecio.val();
        $maxPrecioVal = $maxPrecio.val();
        $modificadoHaceVal = $modificadoHace.val();
        
        if(productsLoaded == true) {
            productsLoaded = false;
            
            $.ajax({
                url: "/filtrarProductos",
                type: "POST",
                data: {
                    busqueda : $busquedaVal,
                    estado : $estadoVal,
                    categoria : $categoriaVal,
                    minPrecio : $minPrecioVal,
                    maxPrecio : $maxPrecioVal,
                    modificadoHace : $modificadoHaceVal,
                },
                success: function(response){
                    
                    offset = 20;
                    
                    if(response == false) {
                        
                        $.ajax({
                            url: "/searchNoResults",
                            type: "GET",
                            success: function(response){
                                $(".allProducts").html(response);
                                $showMoreProducts.removeClass("d-flex").addClass("d-none");
                                $errorLoadingProducts.addClass("d-none");
                            }
                        });
                        
                    } else {
                        $(".allProducts").html(response);
                        $mostrarMasProductos.removeClass("d-none");
                        $showMoreProducts.removeClass("d-none").addClass("d-flex");
                        $errorLoadingProducts.addClass("d-none");
                        addProductsListeners();
                    }
                    
                    productsLoaded = true;
                },
                
                error: function(response) {
                    $errorLoadingProducts.html("ERROR<br><b>Message:</b> " + response.responseJSON.message + "<br>" + "<b>Exception:</b> " + response.responseJSON.exception);
                    $errorLoadingProducts.removeClass("d-none");
                    $mostrarMasProductos.addClass("d-none");
                    console.error(response);
                    console.log("Exception: " + response.responseJSON.exception);
                    console.log("Messagae: " + response.responseJSON.message);
                    productsLoaded = true;
                }
            });
        }
    }
    
    function addProductsListeners() {
        $("div.producto").each(function() {
            $(this).off("click");
        });
        
        $("div.producto").each(function() {
            $(this).on("click", function(){
                let $actualBusqueda = $("#ipt_buscador").val();
                let $actualEstado = $("select[name=estado]").val();
                let $actualCategoria = $("select[name=categoria]").val();
                let $actualMinPrecio = $("input[type=number][name=minPrecio]").val();
                let $actualMaxPrecio = $("input[type=number][name=maxPrecio]").val();
                let $actualModificadoHace = $("select[name=modificadoHace]").val();

                $(this).find("input[type=hidden][name=busqueda]").val($actualBusqueda);
                $(this).find("input[type=hidden][name=estado]").val($actualEstado);
                $(this).find("input[type=hidden][name=categoria]").val($actualCategoria);
                $(this).find("input[type=hidden][name=minPrecio]").val($actualMinPrecio);
                $(this).find("input[type=hidden][name=maxPrecio]").val($actualMaxPrecio);
                $(this).find("input[type=hidden][name=modificadoHace]").val($actualModificadoHace);

                $(this).find("form").submit();
            });
        });
    }
});
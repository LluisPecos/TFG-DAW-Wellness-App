$(document).ready(function() {
    let $btnFavorite = $("button.btnFavorite");
    
    $(".product__header div button.no-liked").on("click", function() {
        $(this).attr("data-original-title", "Borrar favorito");
        $(this).find("i").removeClass("no-liked").addClass("liked");
        $(this).off("click");
        addLikedListener();
        checkFavoriteProduct();
    });
    
    $(".product__header div button.liked").on("click", function() {
        $(this).attr("data-original-title", "Favorito");
        $(this).find("i").removeClass("liked").addClass("no-liked");
        $(this).off("click");
        addNoLikedListener();
        checkFavoriteProduct();
    });
    
    function addLikedListener() {
        $btnFavorite.removeClass("no-liked").addClass("liked");
        
        $($btnFavorite).on("click", function() {
            $(this).attr("data-original-title", "Favorito");
            $(this).removeClass("liked").addClass("no-liked");
            $(this).find("i").removeClass("liked").addClass("no-liked");
            $(this).off("click");
            addNoLikedListener();
            checkFavoriteProduct();
        });
    }
    
    function addNoLikedListener() {
        $btnFavorite.removeClass("liked").addClass("no-liked");
        
        $($btnFavorite).on("click", function() {
            $(this).attr("data-original-title", "Borrar favorito");
            $(this).removeClass("no-liked").addClass("liked");
            $(this).find("i").removeClass("no-liked").addClass("liked");
            $(this).off("click");
            addLikedListener();
            checkFavoriteProduct();
        });
    }
    
    function checkFavoriteProduct() {
        $.ajax({
            url: "/checkFavoriteProduct",
            type: "POST",
            data: {id_producto : $id_producto},
            success: function(response){
                //
            }
        });
    }
});
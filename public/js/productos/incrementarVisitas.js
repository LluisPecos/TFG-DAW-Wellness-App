$(document).ready(function() {
    $id_producto = $(".product__container input[type=hidden]").val();
    
    $.ajax({
        url: "/incrementarVisitas",
        type: "POST",
        data: {id_producto : $id_producto},
        success: function(response){
            //console.log(response);
        }
    }); 
});
$(document).ready(function() {
    $("#carouselImgs .carousel-inner").on("click", function() {
        $("#carouselBiggerImgs").removeClass("d-none");
    });
    
    $("#closeBiggerImgs").on("click", function() {
        $(this).closest(".carousel").addClass("d-none");
    });
    
    $("#closeBiggerImgs").on("click", function() {
        $(this).closest(".carousel").addClass("d-none");
    });
    
    $("*").on("mousemove", function(e) { 
        //console.log("x:" + e.clientX + " y:" + e.clientY);
    });
    
    $("#carouselBiggerImgs .carousel-inner .carousel-item div").on("click", function(e) {
        let widthArrow = $("#carouselBiggerImgs .carousel-control-prev").width();
        let midWidthELement = $(this).width() / 2;
        let midHeightElement = $(this).height() / 2;
        
        let xClient = e.clientX;
        let yClient = e.clientY;
        
        let xElement = e.originalEvent.layerX;
        let yElement = e.originalEvent.layerY;
        
        let x = xClient - xElement;
        let y = yClient - yElement;
        
        let finalWidth = xElement - widthArrow;
        
        if($(this).hasClass("zoomin")) {
            $(this).toggleClass("zoomin");
            $(this).css("background-position", "center");
        } else {
            $(this).toggleClass("zoomin");
            //$(this).css("background-position", finalWidth + "px, " + yElement + "px");
        }
    });
});
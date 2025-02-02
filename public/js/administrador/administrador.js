$(document).ready(function(){
    $("input[name=userSearch]").on("keyup", function() {
        let $value = $(this).val();
        let dataLoaded = true;
        let patron = /(^.+@.+\..+$)|(^[0-9]{1,}$)/;
        
        if($value) {
            
            if(patron.test($value))
            {
                if(dataLoaded == true)
                {
                    dataLoaded = false;
                    $(".error").html("");
                    $("#loadingData").removeClass("d-none");

                    $.ajax({
                        url: "/buscarUsuario",
                        type: "POST",
                        data: {
                            userSearch : $value
                        },
                        success: function(response){

                            if(response == "noUser")
                            {
                                $(".error").html("No se ha encontrado ningún usuario con la búsqueda");
                                $('#tablesContainer').html("");
                            }
                            else
                            {
                                $(".error").html("");
                                $('#tablesContainer').html(response);
                                $('#userDataTable').DataTable({
                                    paging: false,
                                    searching: false,
                                    ordering:  false,
                                    info: false,
                                });
                                $('#userProductsTable').DataTable();
                                $('[data-toggle="tooltip"]').tooltip()
                            }

                            $("#loadingData").addClass("d-none");
                            dataLoaded = true;
                        },
                        
                        error: function(response) {
                            //$errorLoadingProducts.html("ERROR<br><b>Message:</b> " + response.responseJSON.message + "<br>" + "<b>Exception:</b> " + response.responseJSON.exception);
                            console.error(response);
                            console.log("Exception: " + response.responseJSON.exception);
                            console.log("Message: " + response.responseJSON.message);
                            $("#loadingData").addClass("d-none");
                            dataLoaded = true;
                        }
                    });
                }
            }
            else
            {
                $(".error").html("Introduce un valor de búsqueda válido");
            }
        }
        else
        {
            $(".error").html("");
            $("#tablesContainer").html("");
        }
    });
});
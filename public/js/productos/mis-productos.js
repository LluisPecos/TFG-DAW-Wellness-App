$(document).ready(function() {
    // Containers active and sold products
    let $activeProducts = $("#activeProducts");
    let $soldProducts = $("#soldProducts");
    
    // Delete form and modal
    let $formDelete = $("#formDelete");
    let $deleteModal = $("#deleteModal");
    
    // Sell form and modal
    let $formSell = $("#formSell");
    let $sellModal = $("#sellModal");
    
    // Btns delete active and sold products
    let $btnDeleteActive = $("#btnDeleteActive");
    let $btnDeleteSold = $("#btnDeleteSold");
    
    /* ACTIVE PRODUCTS */
    
    // Active / Disable btnDeleteActive
    $("#activeProducts input[type=checkbox]").on("click", function() {
        let $allCheckbox = $("#activeProducts input[type=checkbox]");
        let $checkboxChecked = $("#activeProducts input[type=checkbox]:checked");
        
        if($checkboxChecked.length >= 1) {
            $btnDeleteActive[0].disabled = false;
        }
        else
        {
            $btnDeleteActive[0].disabled = true;
        }
        
        $allCheckbox.each(function() {
            $productSection = $(this).closest(".product").find(".product__section");

            if(this.checked == true)
            {
                $productSection.addClass("selected");
            }
            else
            {
                $productSection.removeClass("selected");
            }
                
        });
    });
    
    // Show modal sell product
    $(".btnSell").on("click", function() {
        let $id_producto = $(this).find("input[name=id_producto]").val();
        
        $formSell.find("input[name=id_producto]").val($id_producto);
        $sellModal.modal('show');
    });
    
    /* SOLD PRODUCTS */
    
    // Active / Disable btnDeleteSold
    $("#soldProducts input[type=checkbox]").on("click", function() {
        let $allCheckbox = $("#soldProducts input[type=checkbox]");
        let $checkboxChecked = $("#soldProducts input[type=checkbox]:checked");
        
        if($checkboxChecked.length >= 1) {
            $btnDeleteSold[0].disabled = false;
        }
        else
        {
            $btnDeleteSold[0].disabled = true;
        }
        
        $allCheckbox.each(function() {
            $productSection = $(this).closest(".product").find(".product__section");

            if(this.checked == true)
            {
                $productSection.addClass("selected");
            }
            else
            {
                $productSection.removeClass("selected");
            }
                
        });
    });
    
    /* ACTIVE AND SOLD PRODUCTS */
    
    // Show modal delete products
    $("#btnDeleteActive, #btnDeleteSold").on("click", function() {
        let productsValues = [];
        
        if(this.id == "btnDeleteActive")
        {
            $("#activeProducts input[type=checkbox]:checked").each(function() {
                productsValues.push($(this).val());
            });
        } 
        else if(this.id == "btnDeleteSold")
        {
            $("#soldProducts input[type=checkbox]:checked").each(function() {
                productsValues.push($(this).val());
            });
        }
        
        $formDelete.find("input[name=productos]").val(productsValues);
        $deleteModal.modal("show");
    });
    
    // Submit form in btnsActions.js
});
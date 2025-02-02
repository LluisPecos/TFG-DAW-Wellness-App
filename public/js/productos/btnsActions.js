$('.deleteProduct').on("click", function() {
    $(this).closest('form').trigger('submit');
});

$('.sellProduct').on("click", function() {
    $(this).closest('form').trigger('submit');
});
$(document).ready(function() {
    $('#ipt_buscador').on('keydown', function(e) {
        if(e.key == "Enter") {
            let $form = $(this).parents('form');
            $($form).submit();
        }
    }); 
});

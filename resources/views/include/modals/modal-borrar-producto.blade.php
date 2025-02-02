<div id="deleteModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                
                <div class="d-flex">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-exclamation-circle text-danger fa-2x mr-2 mb-0"></i>
                        <h5 class="modal-title mb-0 font-weight-bold">@if(Request::is('mis-productos')) Borrar productos @else Borrar producto @endif</h5>
                    </div>
                    <i class="far fa-times icon_close align-self-start" data-dismiss="modal" aria-label="Close"></i>
                </div>
                
                <p class="mb-4">@if(Request::is('mis-productos')) Se borrarán permanentemente los productos seleccionados. @else Se borrará permanentemente el producto. @endif</p>
                
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger deleteProduct">Borrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
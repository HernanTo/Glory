{{-- Modal error tipo de imagen --}}
<div class="modal modal-general" tabindex="-1" id="err_img_prod">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body modal_erro_img">
            <i class="fi fi-sr-image-slash"></i>
            <h4>Precaución</h4>
            <p>Debe adjuntar solo imágenes</p>
            <small>PNG, JPEG</small>
        </div>
        <div class="modal-footer foo-modal-err">
          <button type="button" class="btn btn-secondary close-modal-err" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
{{-- Modal error tipo de imagen --}}

{{-- Modal Delete post --}}
<div class="modal modal-general modal-delete" tabindex="-1" id="modal-delete-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title">
                <i class="fi fi-ss-circle-trash"></i>
                Eliminar producto
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>¿Seguro que quiere eliminar al siguiente producto? <br> <b id="name-user-delete"></b>?</p>
        </div>
        <form action="{{route('blog.administration.destroy')}}" method="post" id="form-delete-user">
            @csrf
            <input type="text" name="id" id="id_user_delete" style="display: none;">
            <input type="number" name="type" id="type-m" style="display: none;">
        </form>
        <div class="modal-footer modal-foo-c">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" id="btn-eliminar-user">Eliminar</button>
        </div>
        </div>
    </div>
</div>
{{-- Modal Delete post --}}

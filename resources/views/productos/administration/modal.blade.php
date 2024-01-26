{{-- Modal Delete User --}}
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
        <form action="{{route('productos.administration.destroy')}}" method="post" id="form-delete-user">
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
{{-- Modal Delete User --}}

<x-administration.components.modal-error-img />

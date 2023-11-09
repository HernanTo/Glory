{{-- Modal Delete User --}}
<div class="modal modal-general modal-delete" tabindex="-1" id="modal-delete-user">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title">
                <i class="fi fi-ss-circle-trash"></i>
                Eliminar factura
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>¿Seguro que quiere eliminar la siguiente factura? <br> # <b id="name-user-delete"></b>?</p>
        </div>
        <form action="{{route('bills.destroy')}}" method="post" id="form-delete-user">
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

{{-- Modal falta stock --}}
<div class="modal fade modal-general" id="modal_stock_low"  tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                <i class="fi fi-sr-diamond-exclamation"></i>
                Error al generar la factura
              </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal__body__errstock">
          <p class="msg-err-sto">Algunos de los productos seleccionados no disponen del stock necesario, ajuste la factura teniendo en cuenta lo siguiente:</p>
          <table class="table-stock-err">
            <tr>
              <th style="width: 50%;">Producto</th>
              <th>Stock dis.</th>
              <th>Cant. Sol.</th>
            </tr>
            <tbody id="table_stock_err">

            </tbody>
          </table>
        </div>

        <div class="modal-footer" style="justify-content: center;">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
    </div>
  </div>
{{-- Modal falta stock --}}

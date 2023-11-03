
function confirmTrash(id, nameUser, type){
    $('#modal-delete-user').modal('toggle');
    $('#name-user-delete').empty();
    document.getElementById('name-user-delete').appendChild(document.createTextNode(nameUser));
    document.getElementById('id_user_delete').value = id;
    document.getElementById('type-m').value = type;

    document.getElementById('btn-eliminar-user').addEventListener('click', event=>{
        document.getElementById('form-delete-user').submit();
    })
}

let prices = document.querySelectorAll('.prices');
for (let i = 0; i < prices.length; i++) {
   let precio = prices[i].textContent;
    $(prices[i]).empty();
    prices[i].appendChild(document.createTextNode(formatCurrency(precio)));
}

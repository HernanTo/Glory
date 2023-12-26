
$(document).ready(() => {
    let quantitys = $('.quantity');
    for (let i = 0; i < quantitys.length; i++) {
        let idQuantity = document.getElementById(quantitys[i].id);
        idQuantity.addEventListener('change', event => {
            let idProduct = $(idQuantity).data('product');
            if(idQuantity.value == 'delete'){
                document.getElementById(`delete__prod_cart__${idProduct}`).submit();
            }else{
                document.getElementById(`form__update__cart__${idProduct}`).submit();
            }
        });
    }

    document.getElementById('privacy').addEventListener('change', ()=>{
        if(document.getElementById('privacy').checked){
            document.getElementById('btn__pay').disabled = false;
        }else{
            document.getElementById('btn__pay').disabled = true;
        }
    });
});

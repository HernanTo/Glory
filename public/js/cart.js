const sintaxProd = '<div class="prod" id="template__prod"> <a href=":slug" class="con__img__prodc"> <figure> <img src=":image" alt=":name" title=":title"></figure></a><a class="name__prod" href=":slug-name">:nameFor</a> <p class="stock__prod">Can: :can <a href=""><i class="fi fi-sr-pencil"></i></a> </p> <p class="prices">:price</p><button class="btn__trash__product" title="Eliminar" id="trash-:id" data-product=":data-id"><i class="fi fi-sr-trash"></i></button></div>';
const sinxtaxEmpty = $('.con__cl')[0];
$(document).ready(()=>{
    $.ajax({
        url: route_global + "/carrito/show",
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
        },
        dataType: "json",
        method: "POST",
        success: function(response) {
            verficationStock(response.mix);
        },
    });
});
function check(){
    let state = true;
    $.ajax({
        url: route_global + "/check-auth",
        data: {
            "_token": $("meta[name='csrf-token']").attr("content")
        },
        method: 'POST',
        dataType: 'json',
        success: function(response) {
            if(response.login == false){
                window.location.href = route_global + "/login";
            }
        }

    });

    return state
}

function add(route){
    if(check()){
        $.ajax({
            url: route + '/add',
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                "product": $("#btn__add__car__pro").data("product")
            },
            dataType: "json",
            method: "POST",
            success: function(response) {
                console.log(response);
                show(route)
            },
        });
    }
}
let stateCart = false;
function show(route){
    if(check()){
        $.ajax({
            url: route + "/show",
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
            },
            dataType: "json",
            method: "POST",
            success: function(response) {
                printData(response)
                if(!stateCart){
                    $('#con__shopping__cart').addClass('con__shopping__cart__show');
                    $('#body__main').addClass('open__cart');
                    stateCart != stateCart;
                }
            },
        });
    }
}
function destroy(id){
    if(check()){
        $.ajax({
            url: route_global + '/carrito/destroy',
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                "product": id
            },
            method: 'POST',
            dataType: 'json',
            success: function(response) {
                if(response.error == 'login'){
                    window.location.href = response.redirect;
                }else{
                    if(response.state = true){
                        show(route_global + '/carrito');
                    }
                }
            },
        });
    }
}


function closeCart(){
    $('#con__shopping__cart').toggleClass('con__shopping__cart__show');
    $('#body__main').toggleClass('open__cart');
    stateCart = false;
}
function printData(response){

    if(response.mix.length <= 0){
        $('#body__shopping__cart').empty();
        document.getElementById('body__shopping__cart').appendChild(sinxtaxEmpty);
        $('.footer_shopping__cart').removeClass('footer_shopping__cart__hide');
        $('.footer_shopping__cart').addClass('footer_shopping__cart__hide');

    }else{
        verficationStock(response.mix);
        // Seccion precios
        $('.footer_shopping__cart').removeClass('footer_shopping__cart__hide');
        let subtotal = document.getElementById('t_sub_price_s');
        let total = document.getElementById('t_price_s');nav__car
        $(subtotal).empty();
        $(total).empty();
        subtotal.appendChild(document.createTextNode(formatPrice(response.cart.total)));
        total.appendChild(document.createTextNode(formatPrice(response.cart.total)));

        // seccion productos
        $('#body__shopping__cart').empty();
        let products = response.mix;
        products.forEach(product => {
            let productSintax = sintaxProd;
            productSintax = productSintax.replace(':id', product.id);
            productSintax = productSintax.replace(':data-id', product.id);
            productSintax = productSintax.replace(':price', formatPrice(product.priceU * product.stockCart));
            productSintax = productSintax.replace(':name', product.name);
            productSintax = productSintax.replace(':title', product.name);
            productSintax = productSintax.replace(':nameFor', product.nameFor);
            productSintax = productSintax.replace(':image', asset_products_global + `/${product.img}`);
            productSintax = productSintax.replace(':slug', route_global + `/${product.slug}/p`);
            productSintax = productSintax.replace(':slug-name', route_global + `/${product.slug}/p`);
            productSintax = productSintax.replace(':can', product.stockCart);
            let tempCon = document.createElement('div');
            tempCon.innerHTML = productSintax;
            document.getElementById('body__shopping__cart').appendChild(tempCon.firstChild);

            document.getElementById(`trash-` + product.id).addEventListener('click', function (){
                destroy(product.id);
            });
        });
    }
}
function formatPrice(price) {
    price = `${price}`;
    price = price.replace(/[^0-9.]/g, '');
    let parts = price.split('.');
    let integerPart = parts[0];
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    return '$' + integerPart;
}
document.getElementById('nav__car').addEventListener('click', event =>{
    show(route_global + "/carrito");
});

function verficationStock(mix){
        // alerta poco stock
        if(document.getElementById('btn__add__car__pro')){
            idProducty = $('#btn__add__car__pro').data('product');

            mix.forEach(product => {
                if(product['id'] == idProducty){
                    console.log(product);
                    if((product['stockCart'] + 1) == product['stockCurrently']){
                        $('#alert__low__stock__cart').removeClass('alert__hide');
                    }
                }
            });
        }
}

const divNotProducts = $('#not-pro-ord');
const divNotService = $('#not-serv-ord')[0];
let selectProduts = document.getElementById('products');

// Fecha actual
var fecha = new Date();
var fechaFormateada = fecha.toISOString().slice(0, 10);
document.getElementById('date_bill').value = fechaFormateada;
// Fecha actual

var services = [];
let products = [];
var configBill = {
    iva: 1,
    estadoPago: 1,
}

// Module IVA
document.getElementById('iva__check').addEventListener('click', event => {
    if(!event.target.checked){
        configBill.iva = 0;
        $('#iva_info').empty();
        document.getElementById('iva_info').appendChild(document.createTextNode('No aplica'));
        pricesTotal();
    }else{
        configBill.iva = 1;
        pricesTotal();
    }
});
// Module IVA

// Module state pago
document.getElementById('is_paid').addEventListener('change', event=>{
    if(!event.target.checked){
        $('#estado__pago').empty();
        document.getElementById('estado__pago').appendChild(document.createTextNode('Pendiente de pago'));

    }else{
        $('#estado__pago').empty();
        document.getElementById('estado__pago').appendChild(document.createTextNode('Pagada'));

    }
})
// Module state pago

// Module add products
$(selectProduts).change('select2:select', function (e) {
    for (var i = 0; i < selectProduts.options.length; i++) {
        var option = selectProduts.options[i];
        if (option.selected) {
            if(option.value != ""){
                var producto = {
                    id: option.value,
                    name: option.text,
                    price: option.getAttribute('data-price'),
                    stock_max: option.getAttribute('data-amount'),
                    stock: option.getAttribute('data-amount'),
                    img: option.getAttribute('data-img'),
                    quantity: 1,
                    checkManoObra: false,
                    priceManoObra: 0,
                    descuento: 'NA',
                }
                let ver = true;

                if(products.length > 0){
                    products.forEach(element => {
                        if(producto.id == element.id){
                            ver = false;
                        }
                    });

                    // Verificar si el producto ya fue agregado antes
                    if(ver){
                        products.push(producto);
                        $('.con__product__ord').empty();
                        subtotal = 0;
                        total = 0;
                        products.forEach(element => {
                            addProductList(element);
                        });

                        pricesTotal();
                    }else{
                        $('#alert-prod-ag').css('display', 'block');
                        setTimeout(function(){
                            $('#alert-prod-ag').css('display', 'none');
                        }, 3000)
                    }
                }else{
                    products.push(producto);
                    $('.con__product__ord').empty();
                    subtotal = 0;
                    total = 0;
                    products.forEach(element => {
                        addProductList(element);
                    });

                    pricesTotal();
                }
            };
        }
    }
});

function addProductList(product){
    let conProduct = document.createElement('div');
    $(conProduct).addClass("prod-rod");
    $(conProduct).addClass("prod-rod-bill");
    let conImg = document.createElement('div');
    $(conImg).addClass('con-img-prod');
    let imgP = document.createElement('img');
    imgP.src = asset_products_global + "/" + product.img;
    conImg.appendChild(imgP);
    conProduct.appendChild(conImg);

    let textProd = document.createElement('div');
    $(textProd).addClass("text-prod");

    let tagNameProdu = document.createElement('h3');
    tagNameProdu.appendChild(document.createTextNode(`${(product.name)}`));
    textProd.appendChild(tagNameProdu);

    let tagPrice = document.createElement('p');
    tagPrice.appendChild(document.createTextNode(formatCurrency(product.price)));
    textProd.appendChild(tagPrice);

    let canMax = document.createElement('i');
    $(canMax).addClass('stock-con')
    canMax.appendChild(document.createTextNode(`Stock: ${(product.stock_max)}`))
    textProd.appendChild(canMax);

    conProduct.appendChild(textProd);

    let divInfoC = document.createElement('div');
    let divamount = document.createElement('div');
    $(divamount).addClass('divamount');

    let labelCan = document.createElement('label');
    labelCan.appendChild(document.createTextNode('Cantidad: '));
    let inputamount = document.createElement('input');
    inputamount.type = "number";
    inputamount.placeholder = "Cantidad";
    inputamount.setAttribute('id', `can-${product.id}`);
    inputamount.value = product.quantity;
    $(inputamount).addClass('form-control');
    $(inputamount).addClass('can_amo');
    divamount.appendChild(labelCan);
    divamount.appendChild(inputamount);
    divInfoC.appendChild(divamount);
    $(divInfoC).addClass('divInfoC');

    let divManoObra = document.createElement('div');
    $(divManoObra).addClass('con-mo');
    let divConCheck = document.createElement('div');
    $(divConCheck).addClass('con-check');
    let inputCheck = document.createElement('input');
    inputCheck.setAttribute('id', `checkM-${product.id}`);

    inputCheck.type = "checkbox";
    let labelCheck = document.createElement('label');
    labelCheck.appendChild(document.createTextNode('¿Mano de obra?'));

    let divconInputMo = document.createElement('div');
    $(divconInputMo).addClass('con-input-mo');
    let inputPriceMo = document.createElement('input');
    inputPriceMo.type = 'text';
    $(inputPriceMo).addClass('form-control');
    $(inputPriceMo).addClass('price-mo-no');
    inputPriceMo.placeholder = "Precio";
    inputPriceMo.value = product.priceManoObra;
    inputPriceMo.setAttribute('id', `priceM-${product.id}`);

    if(product.checkManoObra){
        inputCheck.checked = true;
        $(inputPriceMo).removeClass('price-mo-no');
        $(inputPriceMo).addClass('price-mo');

    }else{
        inputCheck.checked = false;
        $(inputPriceMo).removeClass('price-mo');
        $(inputPriceMo).addClass('price-mo-no');
    }

    divConCheck.appendChild(inputCheck);
    divConCheck.appendChild(labelCheck);
    divManoObra.appendChild(divConCheck);
    divconInputMo.appendChild(inputPriceMo);
    divManoObra.appendChild(divconInputMo);

    divInfoC.appendChild(divManoObra);


    let conActionProd = document.createElement('div');
    $(conActionProd).addClass('action-prod');

    let imgCross = document.createElement('i');
    $(imgCross).addClass('fi');
    $(imgCross).addClass('fi-br-cross');

    conActionProd.appendChild(imgCross);
    conActionProd.setAttribute('data-id', product.id);

    let divDesc = document.createElement('div');
    $(divDesc).addClass('divDesc');

    let labeldesc = document.createElement('label');
    labeldesc.appendChild(document.createTextNode('Descuento: '));
    divDesc.appendChild(labeldesc);

    let percentagesDesc = [5, 10, 20, 30, 40, 50, 60, 70, 80, 90];

    selectDescuentos = document.createElement('select');
    selectDescuentos.setAttribute('id', `discounts-${product.id}`)
    let opt = document.createElement('option');
    opt.textContent = 'No Aplica';
    opt.value = 'NA';
    if('NA' == product.descuento){
        opt.selected = true;
    }
    selectDescuentos.appendChild(opt);

    percentagesDesc.forEach(desc => {
        let opt = document.createElement('option');
        opt.textContent = `${desc}%`;
        opt.value = desc;
        selectDescuentos.appendChild(opt);

        if(desc == product.descuento){
            opt.selected = true;
        }
    });

    divDesc.appendChild(selectDescuentos);
    divInfoC.appendChild(divDesc);

    conProduct.appendChild(conActionProd);
    conProduct.appendChild(divInfoC);


    $('#con__product__ord').append(conProduct);
    $(conActionProd).on('click', function() {
        deleteProduct(product.id);
    });

    inputamount.onkeydown = function(event) {
        if (event.key === "e" || event.key === "E") {
          return false;
        }
      };

    inputamount.addEventListener('change', event =>{
        if(inputamount.value[0] == 0){
            let value = inputamount.value;
            value = reemplazarzero(value);
            inputamount.value = value;
            product.quantity = inputamount.value;

        }else if(inputamount.value < 0){
            inputamount.value = 1;
            product.quantity = inputamount.value;
        }else{
            product.quantity = inputamount.value;
        }

        if(parseInt(inputamount.value) > product.stock_max){
            product.quantity = 1;
            inputamount.value = 1;
            $(canMax).addClass('stock_sob')
            setTimeout(() => {
                $(canMax).removeClass('stock_sob');

            }, 1000);
        }

        pricesTotal();
    })

    inputCheck.addEventListener('change', event=>{
        if(event.target.checked){
            $(inputPriceMo).removeClass('price-mo-no');
            $(inputPriceMo).addClass('price-mo');
            product.checkManoObra = true;

        }else{
            product.checkManoObra = false;
            $(inputPriceMo).removeClass('price-mo');
            $(inputPriceMo).addClass('price-mo-no');
            inputPriceMo.value = 0;
            product.priceManoObra = 0;
            pricesTotal();
        }
    })
    document.getElementById(`discounts-${product.id}`).addEventListener('change', event =>{
        if(document.getElementById(`discounts-${product.id}`).value == 'NA'){
            product.descuento = 'NA';
            pricesTotal();
        }else{
            product.descuento = document.getElementById(`discounts-${product.id}`).value;
            pricesTotal();
        }
    })

    formatPrice(inputPriceMo);

    inputPriceMo.addEventListener('input', () => {
        formatPrice(inputPriceMo);
        product.priceManoObra = inputPriceMo.value.replace(/,/g, "");
        pricesTotal();
    });
    habBtn();
}
// Module add products

// Module delete porudcts
function deleteProduct(id){
    let produtsR = [];

    for(let i = 0; i < products.length; i++){
        if (products[i].id !== id) {
            produtsR.push(products[i]);
        }
    }
    $('.con__product__ord').empty();
    subtotal = 0;
    total = 0;
    produtsR.forEach(element => {
        addProductList(element);
    });

    products = produtsR;

    if(products.length == 0 ){
        $('.con__product__ord').append(divNotProducts);
        $('.btn-sub-bill').addClass('btn-disabled');
        $( ".btn-sub-bill" ).prop( "disabled", true );
        $('#con-sub-t').empty();
        document.getElementById('con-sub-t').appendChild(document.createTextNode(formatCurrency(0)));
        $('#con-t').empty();
        document.getElementById('con-t').appendChild(document.createTextNode(formatCurrency(0)));
        $('#iva_info').empty();
        document.getElementById('iva_info').appendChild(document.createTextNode(formatCurrency(0)));
    }else{
        pricesTotal();
    }

    habBtn();
}
// Module delete porudcts

// Modulo de servicios

function addServ(element){
    // Agregar elemento visual
    let conServ = document.createElement('div');
    $(conServ).addClass('serv');

    let headerServ = document.createElement('div');
    $(headerServ).addClass('header__serv');
    let h2 = document.createElement('h2');
    h2.appendChild(document.createTextNode('SERVICIO #'));
    let span = document.createElement('span');
    span.appendChild(document.createTextNode(element.id + 1));
    h2.appendChild(span);
    headerServ.appendChild(h2);
    conServ.appendChild(headerServ);

    let divConDesc = document.createElement('div');
    $(divConDesc).addClass('cont__desc');
    let label = document.createElement('label');
    label.appendChild(document.createTextNode('Descripción servicio'));
    divConDesc.appendChild(label);
    let textArea = document.createElement('textarea');
    textArea.setAttribute('name', 'desc[]');
    textArea.setAttribute('class', 'desc');
    textArea.value = element.desc;
    divConDesc.appendChild(textArea);
    conServ.appendChild(divConDesc);
    let divCountChart = document.createElement('div');
    $(divCountChart).addClass('count__chart');
    span = document.createElement('span');
    // $(span).addClass('count__chart');
    span.appendChild(document.createTextNode('0'));
    divCountChart.appendChild(span);
    divCountChart.appendChild(document.createTextNode(' Caracteres de 500'));
    divConDesc.appendChild(divCountChart);

    let formFlo = document.createElement('div');
    $(formFlo).addClass('form-floating');
    let input = document.createElement('input');
    input.type = "text";
    input.setAttribute('data-type', 'currency');
    input.setAttribute('id', 'price');
    input.setAttribute('name', 'priceServ[]');
    input.required = true;
    input.placeholder = "Precio";
    $(input).addClass('form-control');
    $(input).addClass('prices');
    input.value = element.precio;
    formFlo.appendChild(input);
    label = document.createElement('label');
    label.appendChild(document.createTextNode('Precio'));
    formFlo.appendChild(label);
    conServ.appendChild(formFlo);

    let conTrashBtn = document.createElement('div');
    $(conTrashBtn).addClass('con__trash_btn');
    inputTrash = document.createElement('input');
    inputTrash.type = "button";
    inputTrash.value = "Eliminar";
    conTrashBtn.appendChild(inputTrash);
    conServ.appendChild(conTrashBtn);

    document.getElementById('con-serv').appendChild(conServ);

    inputTrash.addEventListener('click', event=>{
        document.getElementById('con-serv').removeChild(conServ);

        servicesTemp = [];
        services.forEach(service => {
            if(service.id != element.id ){
                servicesTemp.push(service);
            }
        });

        services = servicesTemp;

        if(services.length <= 0){
            document.getElementById('con-serv').appendChild(divNotService);
        }
        habBtn();
    })

    textArea.addEventListener('change', event => {
        element.desc = textArea.value;
    })

    formatPrice(input);

    input.addEventListener('input', () => {
        formatPrice(input);
        element.precio = input.value.replace(/,/g, "");
        pricesTotal();
    });
    habBtn();
}

// Botones que añaden servicios
let cotadorServ = 0;
document.getElementById('add-serv').addEventListener('click', event =>{
    if(services.length <= 0){
        services.push({
            id: cotadorServ,
            desc: '',
            precio: 0,
        });
        addServ(services[0]);
        cotadorServ++;
        document.getElementById('con-serv').removeChild(document.getElementById('not-serv-ord'));
    }else{
        services.push({
            id: services.length,
            desc: '',
            precio: 0,
        });
        addServ(services[(services.length - 1)]);
        cotadorServ++;
    }
    pricesTotal();
})

document.getElementById('btn-inser-serv').addEventListener('click', event=>{
    let valInsert = document.getElementById('can_serv_insert').value
    if(valInsert > 1){
        for (let i = 0; i < valInsert; i++) {
            services.push({
                id: cotadorServ,
                desc: '',
                precio: 0,
            });
            addServ(services[(services.length - 1)]);
            cotadorServ++;
        }
    }
})
// Botones que añaden servicios
// Modulo de servicios

// Module total
function pricesTotal(){
    let subtotal = 0;

    if(products.length > 0){
        products.forEach(element => {
            let amount = element.quantity;
            let manoObra = element.priceManoObra;

            precioProduct = (parseInt(element.price) * parseInt(amount));
            let discount =  element.descuento == 'NA' ? 0 : element.descuento / 100;
            let precioWithDiscount = precioProduct - (precioProduct * discount);
            subtotal = subtotal + parseInt(manoObra) + precioWithDiscount;
        })
    }
    // Si el existe un servicio agregará el precio al total
    if(services.length > 0){
        services.forEach(element => {
            subtotal += parseInt(element.precio);
            $('#con-sub-t').empty();
            document.getElementById('con-sub-t').appendChild(document.createTextNode(formatCurrency(subtotal)));
        })

    }else{
        $('#con-sub-t').empty();
        document.getElementById('con-sub-t').appendChild(document.createTextNode(formatCurrency(subtotal)));
    }

    if(configBill.iva == 1){
        iva = subtotal * 0.19;
        $('#iva_info').empty();
        document.getElementById('iva_info').appendChild(document.createTextNode(formatCurrency(iva)));
    }else{
        iva = 0;
        $('#iva_info').empty();
        document.getElementById('iva_info').appendChild(document.createTextNode('No Aplica'));
    }

    $('#con-t').empty();
    document.getElementById('con-t').appendChild(document.createTextNode(formatCurrency(subtotal + iva)));
}
// Module total

function habBtn(){
    let estado = false;
        if(document.getElementById('customers').value != ''){
            if(document.getElementById('sellers').value != ''){
                if(products.length >= 1 || services.length >= 1){

                    estado = true;
                }else{

                    estado = false;
                }
            }else{
                estado = false;
            }
        }else{
            estado = false;
        }
    if(estado){
        $('#btn__sub_bill').removeClass('btn-disabled');
        $("#btn__sub_bill" ).prop( "disabled", false );
    }else{
        $('#btn-sub-bill').addClass('btn-disabled');
        $("#btn__sub_bill" ).prop( "disabled", true );
    }
}
let inpts = ['date_bill', 'customers', 'sellers'];

inpts.forEach(element => {
    $(`#${element}`).on('change', () => {
        let estado = false;
            if(document.getElementById('customers').value != ''){
                if(document.getElementById('sellers').value != ''){
                    if(products.length >= 1 || services.length >= 1){

                        estado = true;
                    }else{

                        estado = false;
                    }
                }else{
                    estado = false;
                }
            }else{
                estado = false;
            }
        if(estado){
            $('#btn__sub_bill').removeClass('btn-disabled');
            $("#btn__sub_bill" ).prop( "disabled", false );
        }else{
            $('#btn__sub_bill').addClass('btn-disabled');
            $("#btn__sub_bill" ).prop( "disabled", true );
        }
    });
});

document.getElementById('btn__sub_bill').addEventListener('click', event => {
    if(products.length >= 1){
        products.forEach(element =>{
            let inputProduct = document.createElement('input');
            inputProduct.type = "number";
            inputProduct.setAttribute('name', 'product_id[]');
            $(inputProduct).addClass('inp-inf');
            inputProduct.value = element.id;
            inputProduct.setAttribute('class', 'hide_in_form');

            let inputAmount = document.createElement('input');
            inputAmount.type = "number";
            inputAmount.setAttribute('name', 'product_amount[]');
            $(inputAmount).addClass('inp-inf');
            inputAmount.value = element.quantity;
            inputAmount.setAttribute('class', 'hide_in_form');

            let CheckManoObra = document.createElement('input');
            CheckManoObra.type = 'check';
            CheckManoObra.value = element.checkManoObra;
            CheckManoObra.setAttribute('name', 'check_mano_obra[]');
            CheckManoObra.setAttribute('class', 'hide_in_form');

            let priceManoObra = document.createElement('input');
            priceManoObra.type = 'text';
            priceManoObra.value = element.priceManoObra;
            priceManoObra.setAttribute('name', 'price_mano_obra[]');
            priceManoObra.setAttribute('class', 'hide_in_form');

            let descuento = document.createElement('input')
            descuento.type = 'text';
            descuento.value = element.descuento;
            descuento.setAttribute('name', 'descuento[]');
            descuento.setAttribute('class', 'hide_in_form');

            $('#form-bill').append(inputProduct);
            $('#form-bill').append(inputAmount);
            $('#form-bill').append(CheckManoObra);
            $('#form-bill').append(priceManoObra);
            $('#form-bill').append(descuento);

            document.getElementById('form-bill').submit();
        })
    }else if(services.length >= 1){
        document.getElementById('form-bill').submit();
    }
});


function errorStock(products){
    $(document).ready(function() {
        $('#modal_stock_low').modal('toggle');
    });

    products.forEach(element => {
        let tr = document.createElement('tr');
        let td = document.createElement('td');

        td.appendChild(document.createTextNode(`${element[0]}`))
        tr.appendChild(td);

        td = document.createElement('td');
        td.appendChild(document.createTextNode(`${element[1]}`))
        tr.appendChild(td);

        td = document.createElement('td');
        td.appendChild(document.createTextNode(`${element[2]}`))
        tr.appendChild(td);

        document.getElementById('table_stock_err').appendChild(tr);
    });
}

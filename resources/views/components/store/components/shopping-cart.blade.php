<div class="con__shopping__cart" id="con__shopping__cart">
    <nav class="nav_shopping__cart">
        <div class="header_shopping__cart">
            <button type="button" onclick="closeCart()" class="btn_close_cart" title="Cerrar carrito">
                <i class="fi fi-br-cross"></i>
            </button>
            <h4>Carrito de compras</h4>
        </div>
        <div class="body__shopping__cart" id="body__shopping__cart">
            <div class="con__cl" id="con__cl">
                <i class="fi fi-br-shopping-cart"></i>
                <h3>Su carrito esta vacio</h3>
            </div>
        </div>
        <div class="footer_shopping__cart footer_shopping__cart__hide">
            <span>
                <h6>Subtotal</h6>
                <p class="prices" id="t_sub_price_s"></p>
            </span>
            <span>
                <h5>Total</h5>
                <p class="prices" id="t_price_s"></p>
            </span>
            <span>
                <a href="{{route('carrito')}}" class="btn_car">Ir al carrito</a>
            </span>
            <span>
                <a href="">Ir a pagar</a>
            </span>
        </div>
    </nav>
</div>

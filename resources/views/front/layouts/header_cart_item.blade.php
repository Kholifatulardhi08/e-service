<?php
$getCartItem = getCartItem();
use App\Models\Product;
$totalCartItem = totalCartItem();
?>
<!-- Header -->
<header>
    <!-- Mini Cart -->
    <div class="mini-cart-wrapper">
        <div class="mini-cart">
            <div class="mini-cart-header">
                YOUR CART
                <button type="button" class="button ion ion-md-close" id="mini-cart-close"></button>
            </div>
            <ul class="mini-cart-list">
                @php $total_harga = 0; @endphp
                @foreach ($getCartItem as $cart)
                <?php
                    $hargaattribute = Product::hargaattribute($cart['product_id'], $cart['paket']);
                    ?>
                <li class="clearfix">
                    <?php
                        $products_imgPath = 'template/images/Photo/Product/Small/' . $cart['product']['gambar'];
                        ?>
                    <a href="{{ url('product/'.$cart['product_id']) }}">
                        <img src="{{ asset($products_imgPath) }}" alt="Product">
                        <span class="mini-item-name">{{ $cart['product']['nama'] }}<br>
                            {{ $cart['paket'] }}</span>
                        <span class="mini-item-price">{{ $hargaattribute['final_harga'] }}</span>
                        <span class="mini-item-quantity"> x {{ $cart['quantity'] }} </span>
                    </a>
                </li>
                @php
                // Calculate the total price for each cart item and add it to the total_harga variable
                $total_harga += ($hargaattribute['final_harga'] * $cart['quantity']);
                @endphp
                @endforeach
            </ul>
            @if (count($getCartItem) > 0)
            <div class="clearfix mini-shop-total">
                <span class="float-left mini-total-heading">Total:</span>
                <span class="float-right mini-total-price">Rp. {{ $total_harga }}</span>
            </div>
            <div class="mini-action-anchors">
                <a href="{{ url('cart') }}" class="cart-anchor">View Cart</a>
                <a href="{{ url('checkout') }}" class="checkout-anchor">Checkout</a>
            </div>
            @else
            <p class="text-center">Your cart is empty.</p>
            @endif
        </div>
    </div>
    <!-- Mini Cart /- -->
</header>
<!-- Header /- -->
<script>
    $('#mini-cart-close').on('click', function () {
        $('.mini-cart-wrapper').removeClass('mini-cart-open');
    });
</script>
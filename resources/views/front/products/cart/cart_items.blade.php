<?php
use App\Models\Product;
?>
<form>
    <!-- Products-List-Wrapper -->
    <div class="table-wrapper u-s-m-b-60">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total_harga = 0 @endphp
                @if(count($getCartItem) == 0)
                <tr>
                    <td class="text-center" colspan="6">Your cart is empty.</td>
                </tr>
                @else
                @foreach ($getCartItem as $cart)
                <?php
                    $hargaattribute = Product::hargaattribute($cart['product_id'], $cart['paket']);
                    {{--  echo "<pre>"; print_r($hargaattribute); die;  --}}
                ?>
                <tr>
                    <td>
                        <div class="cart-anchor-image">
                            <?php
                                $products_imgPath = 'template/images/Photo/Product/Small/'.$cart['product']['gambar']
                            ?>
                            <a href="{{ url('product/'.$cart['product_id']) }}">
                                <img src="{{ $products_imgPath }}" alt="Product">
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="cart-anchor-image">
                            <a href="{{ url('product/'.$cart['product_id']) }}">
                                <h6>{{ $cart['product']['nama'] }}<br>
                                    {{ $cart['paket'] }}
                                </h6>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="cart-price">
                            @if($hargaattribute['diskon']>0)
                            <div class="price-template">
                                <div class="item-new-price">
                                    {{ $hargaattribute['final_harga'] }}
                                </div>
                                <div class="item-old-price" style="margin-left:-30px;">
                                    {{ $hargaattribute['harga'] }}
                                </div>
                            </div>
                            @else
                            <div class="price-template">
                                <div class="item-old-price">
                                    {{ $hargaattribute['final_harga'] }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="cart-quantity">
                            <div class="quantity">
                                <input type="number" class="quantity-text-field" value="{{ $cart['quantity'] }}">
                                <a class="plus-a updateCartItem" data-cartid="{{ $cart['id'] }}"
                                    data-qty="{{ $cart['quantity'] }}" data-max="1000">&#43;</a>
                                <a class="minus-a updateCartItem" data-cartid="{{ $cart['id'] }}"
                                    data-qty="{{ $cart['quantity'] }}" data-min="1">&#45;</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="cart-price">
                            <div class="price-template">
                                <div class="item-new-price">
                                    Rp. {{ $hargaattribute['final_harga'] * $cart['quantity'] }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="action-wrapper">
                            <button class="button button-outline-secondary fas fa-trash deleteCartItem"
                                data-cartid="{{ $cart['id'] }}">

                            </button>
                        </div>
                    </td>
                </tr>
                @php $total_harga = $total_harga + ($hargaattribute['final_harga'] * $cart['quantity']) @endphp
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <!-- Products-List-Wrapper /- -->
    <!-- Coupon -->
    <div class="coupon-continue-checkout u-s-m-b-60">
        <div class="coupon-area">
            <h6>Enter your coupon code if you have one.</h6>
            <div class="coupon-field">
                <label class="sr-only" for="coupon-code">Apply Coupon</label>
                <input id="coupon-code" type="text" class="text-field" placeholder="Coupon Code">
                <button type="submit" class="button">Apply Coupon</button>
            </div>
        </div>
        <div class="button-area">
            <a href="shop-v1-root-category.html" class="continue">Continue Shopping</a>
            <a href="checkout.html" class="checkout">Proceed to Checkout</a>
        </div>
    </div>
    <!-- Coupon /- -->
</form>
<!-- Billing -->
<div class="calculation u-s-m-b-60">
    <div class="table-wrapper-2">
        <table>
            <thead>
                <tr>
                    <th colspan="2">Cart Totals</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-0">Subtotal</h3>
                    </td>
                    <td>
                        <span class="calc-text">Rp. {{ $total_harga }} </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-0">Kupon Diskon</h3>
                    </td>
                    <td>
                        <span class="calc-text">Rp. 0</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-0">Total</h3>
                    </td>
                    <td>
                        <span class="calc-text">Rp. {{ $total_harga }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Billing /- -->
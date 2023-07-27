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
                    <th>Diskon</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total_harga = 0 @endphp
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
                        <div class="price-template">
                            <div class="item-new-price">
                                Rp. {{ $hargaattribute['harga'] }}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="price-template">
                            <div class="item-new-price">
                                Rp. {{ $hargaattribute['diskon'] }}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="cart-price">
                            @if($hargaattribute['diskon']>0)
                            <div class="price-template">
                                <div class="item-new-price">
                                    Rp. {{ $hargaattribute['final_harga'] }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="action-wrapper">
                            <button class="button button-outline-secondary fas fa-trash"></button>
                        </div>
                    </td>
                </tr>
                @php $total_harga = $total_harga + $hargaattribute['final_harga'] @endphp
                @endforeach
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
                        <span class="calc-text">Rp. {{ $total_harga }}</span>
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
                {{--  <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-8">Shipping</h3>
                        <div class="calc-choice-text u-s-m-b-4">Flat Rate: Not Available</div>
                        <div class="calc-choice-text u-s-m-b-4">Free Shipping: Not Available</div>
                        <a data-toggle="collapse" href="#shipping-calculation" class="calc-anchor u-s-m-b-4">Calculate
                            Shipping
                        </a>
                        <div class="collapse" id="shipping-calculation">
                            <form>
                                <div class="select-country-wrapper u-s-m-b-8">
                                    <div class="select-box-wrapper">
                                        <label class="sr-only" for="select-country">Choose your country
                                        </label>
                                        <select class="select-box" id="select-country">
                                            <option selected="selected" value="">Choose your country...
                                            </option>
                                            <option value="">United Kingdom (UK)</option>
                                            <option value="">United States (US)</option>
                                            <option value="">United Arab Emirates (UAE)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="select-state-wrapper u-s-m-b-8">
                                    <div class="select-box-wrapper">
                                        <label class="sr-only" for="select-state">Choose your state
                                        </label>
                                        <select class="select-box" id="select-state">
                                            <option selected="selected" value="">Choose your state...
                                            </option>
                                            <option value="">Alabama</option>
                                            <option value="">Alaska</option>
                                            <option value="">Arizona</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="town-city-div u-s-m-b-8">
                                    <label class="sr-only" for="town-city"></label>
                                    <input type="text" id="town-city" class="text-field" placeholder="Town / City">
                                </div>
                                <div class="postal-code-div u-s-m-b-8">
                                    <label class="sr-only" for="postal-code"></label>
                                    <input type="text" id="postal-code" class="text-field" placeholder="Postcode / Zip">
                                </div>
                                <div class="update-totals-div u-s-m-b-8">
                                    <button class="button button-outline-platinum">Update
                                        Totals</button>
                                </div>
                            </form>
                        </div>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-0" id="tax-heading">Tax</h3>
                        <span> (estimated for your country)</span>
                    </td>
                    <td>
                        <span class="calc-text">$0.00</span>
                    </td>
                </tr>  --}}
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
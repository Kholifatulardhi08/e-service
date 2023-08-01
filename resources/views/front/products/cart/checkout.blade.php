@extends('front.layouts.layout')
@section('content')
<?php
use App\Models\Product;
?>
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Checkout</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="{{ url('checkout') }}">Checkout</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Introduction Wrapper /- -->
<!-- Checkout-Page -->
<div class="page-checkout u-s-p-t-80">
    <div class="container">
        @if(Session::has('error_message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error: </strong>
            {{ Session::get('error_message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        {{--  ganti error disini  --}}
        <form name="checkoutForm" id="checkoutForm" action="{{ url('/checkout') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <!-- Billing-&-Shipping-Details -->
                        <div class="col-lg-6" id="deliveryAddress">
                            @include('front.products.cart.deliveries')
                        </div>
                        <!-- Billing-&-Shipping-Details /- -->
                        <!-- Checkout -->
                        <div class="col-lg-6">
                            <h4 class="section-h4">Your Order</h4>
                            <div class="order-table">
                                <table class="u-s-m-b-13">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
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
                                                <?php
                                                    $products_imgPath = 'template/images/Photo/Product/Small/'.$cart['product']['gambar']
                                                ?>
                                                <h6>
                                                    <a href="{{ url('product/'.$cart['product_id']) }}">
                                                        <img width="30" src="{{ $products_imgPath }}" alt="Product">
                                                    </a>
                                                    {{ $cart['product']['nama'] }}
                                                    <span class="order-span-quantity">x {{ $cart['quantity'] }}</span>
                                                    <br>
                                                    {{ $cart['paket'] }}
                                                </h6>
                                            </td>
                                            <td>
                                                <h6 class="order-h6">
                                                    Rp. {{ $hargaattribute['final_harga'] * $cart['quantity'] }}
                                                </h6>
                                            </td>
                                        </tr>
                                        @php $total_harga = $total_harga + ($hargaattribute['final_harga'] *
                                        $cart['quantity']) @endphp
                                        @endforeach
                                        <tr>
                                            <td>
                                                <h3 class="order-h3">Subtotal</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3">Rp. {{ $total_harga }}</h3>
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td>
                                                <h3 class="order-h3">Shipping</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3">Rp 0.,</h3>
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <td>
                                                <h3 class="order-h3">Total</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3">Rp. {{ $total_harga }}</h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="u-s-m-b-13">
                                    <input value="COD" type="radio" class="radio-box" name="payment_gateway"
                                        id="cash-on-delivery">
                                    <label class="label-text" for="cash-on-delivery">Cash on Delivery</label>
                                </div>
                                <div class="u-s-m-b-13">
                                    <div class="form-check">
                                        <input title="please agree to T&C" type="checkbox" id="accept" name="accept"
                                            value="Yes" class="form-check-input">
                                        <label class="label-text no-color" for="accept">I’ve read and accept the
                                            <a href="#" class="u-c-brand">terms & conditions</a>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="button button-outline-secondary">Place Order</button>
                            </div>
                        </div>
                        <!-- Checkout /- -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout-Page /- -->
@endsection
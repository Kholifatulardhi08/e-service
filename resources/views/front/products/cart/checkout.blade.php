@extends('front.layouts.layout')
@section('content')
<?php
use App\Models\Product;
?>
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Cart</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="/">Home</a>
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
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <form>
                    <div class="row">
                        <!-- Billing-&-Shipping-Details -->
                        <div class="col-lg-6">
                            @if (count($deliveryAddress)>0)
                            <h4 class="section-h4">Alamat User Details</h4>
                            @foreach ($deliveryAddress as $alamat)
                            <div class="control-group" style="float: left; margin-right: 5px;">
                                <input type="radio" id="{{ $alamat['id'] }}" name="alamat_id"
                                    value="{{ $alamat['id'] }}">
                                <label class="control-label">
                                    {{ $alamat['nama'] }}, {{ $alamat['alamat'] }}, {{ $alamat['kecamatan'] }},
                                    {{ $alamat['provinsi'] }}, {{ $alamat['no_hp'] }}, {{ $alamat['kode_pos'] }}
                                </label>
                            </div>
                            @endforeach
                            <br>
                            <h4 class="section-h4">Add Another Address Details</h4>
                            <div class="u-s-m-b-24">
                                <input type="checkbox" class="check-box" id="ship-to-different-address">
                                <label class="label-text" for="ship-to-different-address" data-bs-toggle="collapse"
                                    data-bs-target="#showdifferent" aria-expanded="false"
                                    aria-controls="showdifferent">Ship to a different
                                    address?</label>
                            </div>
                            <div class="collapse" id="showdifferent">
                                <!-- Form-Fields -->
                                <div class="group-inline u-s-m-b-13">
                                    <div class="group-1 u-s-p-r-16">
                                        <label for="first-name-extra">First Name
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="first-name-extra" class="text-field">
                                    </div>
                                    <div class="group-2">
                                        <label for="last-name-extra">Last Name
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="last-name-extra" class="text-field">
                                    </div>
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="select-country-extra">Country
                                        <span class="astk">*</span>
                                    </label>
                                    <div class="select-box-wrapper">
                                        <select class="select-box" id="select-country-extra">
                                            <option selected="selected" value="">Choose your country...</option>
                                            <option value="">United Kingdom (UK)</option>
                                            <option value="">United States (US)</option>
                                            <option value="">United Arab Emirates (UAE)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="street-address u-s-m-b-13">
                                    <label for="req-st-address-extra">Street Address
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="req-st-address-extra" class="text-field"
                                        placeholder="House name and street name">
                                    <label class="sr-only" for="opt-st-address-extra"></label>
                                    <input type="text" id="opt-st-address-extra" class="text-field"
                                        placeholder="Apartment, suite unit etc. (optional)">
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="town-city-extra">Town / City
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="town-city-extra" class="text-field">
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="select-state-extra">State / Country
                                        <span class="astk"> *</span>
                                    </label>
                                    <div class="select-box-wrapper">
                                        <select class="select-box" id="select-state-extra">
                                            <option selected="selected" value="">Choose your state...</option>
                                            <option value="">Alabama</option>
                                            <option value="">Alaska</option>
                                            <option value="">Arizona</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="postcode-extra">Postcode / Zip
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="postcode-extra" class="text-field">
                                </div>
                                <div class="group-inline u-s-m-b-13">
                                    <div class="group-1 u-s-p-r-16">
                                        <label for="email-extra">Email address
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="email-extra" class="text-field">
                                    </div>
                                    <div class="group-2">
                                        <label for="phone-extra">Phone
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="phone-extra" class="text-field">
                                    </div>
                                </div>
                                <!-- Form-Fields /- -->
                            </div>
                            <div>
                                <label for="order-notes">Order Notes</label>
                                <textarea class="text-area" id="order-notes"
                                    placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                            @endif
                            <!-- Form-Fields /- -->
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
                                        <tr>
                                            <td>
                                                <h6 class="order-h6">Product Name</h6>
                                                <span class="order-span-quantity">x 1</span>
                                            </td>
                                            <td>
                                                <h6 class="order-h6">$100.00</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="order-h6">Black Rock Dress with High Jewelery Necklace</h6>
                                                <span class="order-span-quantity">x 1</span>
                                            </td>
                                            <td>
                                                <h6 class="order-h6">$100.00</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="order-h6">Xiaomi Note 2 Black Color</h6>
                                                <span class="order-span-quantity">x 1</span>
                                            </td>
                                            <td>
                                                <h6 class="order-h6">$100.00</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="order-h6">Dell Inspiron 15</h6>
                                                <span class="order-span-quantity">x 1</span>
                                            </td>
                                            <td>
                                                <h6 class="order-h6">$100.00</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="order-h3">Subtotal</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3">$220.00</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="order-h3">Shipping</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3">$0.00</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="order-h3">Tax</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3">$0.00</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="order-h3">Total</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3">$220.00</h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="u-s-m-b-13">
                                    <input type="radio" class="radio-box" name="payment-method" id="cash-on-delivery">
                                    <label class="label-text" for="cash-on-delivery">Cash on Delivery</label>
                                </div>
                                <div class="u-s-m-b-13">
                                    <input type="radio" class="radio-box" name="payment-method" id="credit-card-stripe">
                                    <label class="label-text" for="credit-card-stripe">Credit Card (Stripe)</label>
                                </div>
                                <div class="u-s-m-b-13">
                                    <input type="radio" class="radio-box" name="payment-method" id="paypal">
                                    <label class="label-text" for="paypal">Paypal</label>
                                </div>
                                <div class="u-s-m-b-13">
                                    <input type="checkbox" class="check-box" id="accept">
                                    <label class="label-text no-color" for="accept">I’ve read and accept the
                                        <a href="terms-and-conditions.html" class="u-c-brand">terms & conditions</a>
                                    </label>
                                </div>
                                <button type="submit" class="button button-outline-secondary">Place Order</button>
                            </div>
                        </div>
                        <!-- Checkout /- -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Checkout-Page /- -->
@endsection
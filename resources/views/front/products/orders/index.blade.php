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
                    <a href="{{ url('orders') }}">My Orders</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Introduction Wrapper /- -->
<!-- Cart-Page -->
<div class="page-cart u-s-p-t-80">
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
        @if(Session::has('succses_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success: </strong>
            {{ Session::get('success_message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row pt-0">
            <div class="col-lg-12">
                <h6>Table Orders: </h6>
                <table class="table table-striped table-borderless text-center">
                    <tr>
                        <th>Order Id</th>
                        <th>Order Product</th>
                        <th>Payment Method</th>
                        <th>Grand Total</th>
                        <th>Created on</th>
                    </tr>
                    @if(count($orders) > 0)
                    @foreach ($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ url('orders/'.$order['id']) }}">{{ $order['id'] }}</a>    
                        </td>
                        <td>
                            @foreach ($order['order'] as $item)
                                {{ $item['nama'] }}<br>
                            @endforeach
                        </td>
                        <td>{{ $order['payment_gateway'] }}</td>
                        <td>{{ $order['grand_total'] }}</td>
                        <td>{{ date('d-M-Y H:i:s', strtotime($order['created_at'])) }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5">No orders found. You can place an order through our website.</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Cart-Page /- -->
@endsection
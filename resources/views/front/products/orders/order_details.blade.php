@extends('front.layouts.layout')
@section('content')
<?php
use App\Models\Product;
?>
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Order {{ $orderdetails['id'] }} Details </h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="/">Home</a>
                </li>
                <li class="is-marked">
                    <a href="{{ url('orders') }}">Orders</a>
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
                <tr>
                    <td colspan="2">
                        <strong>
                            Order Details
                        </strong>
                    </td>
                </tr>
                <table class="table table-striped table-borderless">
                    <tr>
                        <td>
                            <strong>
                                Order date
                            </strong>
                        </td>
                        <td>{{ date('d-M-Y H:i:s', strtotime($orderdetails['created_at'])) }}</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Pembayaran
                            </strong>
                        </td>
                        <td>{{ $orderdetails['order_status'] }}</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Total
                            </strong>
                        </td>
                        <td>{{ $orderdetails['grand_total'] }}</td>
                    </tr>
                </table>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">gambar</th>
                            <th scope="col">nama</th>
                            <th scope="col">harga</th>
                            <th scope="col">quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderdetails['order'] as $item)
                        <td>
                            @php $getProductImage = Product::getProductImage($item['product_id']); @endphp
                            <a target="blank_" href="{{ url('product/'.$item['id']) }}">
                                <img style="width: 80px;"
                                    src="{{ asset('template/images/Photo/Product/Small/'.$getProductImage) }}" alt="">
                            </a>
                        </td>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ $item['harga'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        @endforeach
                    </tbody>
                </table>
                <tr>
                    <td colspan="2">
                        <strong>
                            Alamat Details
                        </strong>
                    </td>
                </tr>
                <table class="table table-striped table-borderless">
                    <tr>
                        <td>
                            <strong>
                                Alamat
                            </strong>
                        </td>
                        <td>{{ $orderdetails['alamat'] }}</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Kecamatan
                            </strong>
                        </td>
                        <td>{{ $orderdetails['kecamatan'] }}</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Kota
                            </strong>
                        </td>
                        <td>{{ $orderdetails['kota'] }}</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Provinsi
                            </strong>
                        </td>
                        <td>{{ $orderdetails['provinsi'] }}</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Kota
                            </strong>
                        </td>
                        <td>{{ $orderdetails['kode_pos'] }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Cart-Page /- -->
@endsection
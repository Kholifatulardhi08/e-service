@extends('admin.layouts.layout')
@section('content')
<?php
use App\Models\Product;
?>
<div class="main-panel">
    <div class="content-wrapper">
        @if(Session::has('succses_message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Succses: </strong> {{ Session::get('succses_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">
                            Order #id {{ $orderdetails['id'] }} Details
                        </h3>
                        <h6 class="font-weight-normal mb-0">
                            <a href="{{ url('admin/orders') }}">
                                back
                            </a>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderdetails['order'] as $item)
                        <td>
                            @php $getProductImage = Product::getProductImage($item['product_id']); @endphp
                            <a target="blank_" href="{{ url('product/'.$item['id']) }}">
                                <img src="{{ asset('template/images/Photo/Product/Small/'.$getProductImage) }}" alt="">
                            </a>
                        </td>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ $item['harga'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>
                            <form action="{{ url('admin/update-order-item-status') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="id" id="id"
                                        value="{{ $item['id'] }}">
                                    <select class="form-control" name="item_status" id="item_status" required>
                                        <option value="">select</option>
                                        @foreach ($orderitemstatus as $status)
                                        <option value="{{ $status['nama'] }}" @if(!empty($item['item_status']) &&
                                            $item['item_status']==$status['nama']) selected="" @endif>{{
                                            $status['nama'] }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit">Update</button>
                                </div>
                            </form>
                        </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- First row of the grid -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order Details</h4>
                        <div class="form-group" style="font-weight: 500;">
                            <label style="font-weight: 500;">Order ID:</label>
                            <label>
                                {{ ($orderdetails['id']) }}
                            </label>
                        </div>
                        <div class="form-group" style="font-weight: 500;">
                            <label style="font-weight: 500;">Order Date:</label>
                            <label>
                                {{ date('d-M-Y H:i:s', strtotime($orderdetails['created_at'])) }}
                            </label>
                        </div>
                        <div class="form-group" style="font-weight: 500;">
                            <label style="font-weight: 500;">Payment Method:</label>
                            <?php if ($orderdetails['payment_method'] !== null): ?>
                            <label>
                                {{ $orderdetails['payment_method'] }}
                            </label>
                            <?php else: ?>
                            <label>
                                Tidak ada informasi pembayaran
                            </label>
                            <?php endif; ?>
                        </div>
                        <div class="form-group" style="font-weight: 500;">
                            <label style="font-weight: 500;">Order Status</label>
                            <label>
                                {{ $orderdetails['order_status'] }}
                            </label>
                        </div>
                        <div class="form-group" style="font-weight: 500;">
                            <label style="font-weight: 500;">Payment Gateway</label>
                            <label>
                                {{ $orderdetails['payment_gateway'] }}
                            </label>
                        </div>
                        <div class="form-group" style="font-weight: 500;">
                            <label style="font-weight: 500;">Grand Total</label>
                            <label>
                                {{ $orderdetails['grand_total'] }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Update order status</h4>
                        <form action="{{ url('admin/update-order-status') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="order_id" id="order_id" value="{{ $orderdetails['id'] }}">
                                <select class="form-control" name="order_status" id="order_status" required>
                                    <option value="">select</option>
                                    @foreach ($orderstatus as $item)
                                    <option value="{{ $item['nama'] }}" @if(!empty($orderdetails['order_status']) &&
                                        $orderdetails['order_status']==$item['nama']) selected="" @endif>{{
                                        $item['nama'] }}</option>
                                    @endforeach
                                </select>
                                <button type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Delivery Details</h4>
                        <div class="form-group" style="font-weight: 500;">
                            <label style="font-weight: 500;">Nama</label>
                            <label>
                                {{ $userdetails['name'] }}
                            </label>
                        </div>
                        @if(!empty($orderdetails['kecamatan']))
                        <div class="form-group" style="font-weight: 500;">
                            <label style="font-weight: 500;">Kecamatan</label>
                            <label>
                                {{ $userdetails['kecamatan'] }}
                            </label>
                        </div>
                        @endif
                        @if(!empty($orderdetails['kota']))
                        <div class="form-group" style="font-weight: 500;">
                            <label style="font-weight: 500;">Kota</label>
                            <label>
                                {{ $userdetails['kota'] }}
                            </label>
                        </div>
                        @endif
                        @if(!empty($orderdetails['provinsi']))
                        <div class="form-group" style="font-weight: 500;">
                            <label style="font-weight: 500;">Kota</label>
                            <label>
                                {{ $userdetails['provinsi'] }}
                            </label>
                        </div>
                        @endif
                        @if(!empty($orderdetails['kode_pos']))
                        <div class="form-group" style="font-weight: 500;">
                            <label style="font-weight: 500;">Kota</label>
                            <label>
                                {{ $userdetails['kode_pos'] }}
                            </label>
                        </div>
                        @endif
                        @if(!empty($orderdetails['no_hp']))
                        <div class="form-group" style="font-weight: 500;">
                            <label style="font-weight: 500;">Kota</label>
                            <label>
                                {{ $userdetails['no_hp'] }}
                            </label>
                        </div>
                        @endif
                        <div class="form-group" style="font-weight: 500;">
                            <label style="font-weight: 500;">Email</label>
                            <label>
                                {{ $userdetails['email'] }}
                            </label>
                        </div>
                        @if(!empty($orderdetails['alamat']))
                        <div class="form-group" style="font-weight: 500;">
                            <label style="font-weight: 500;">Alamat</label>
                            <label>
                                {{ $userdetails['alamat'] }}
                            </label>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin\layouts\footer')
    <!-- partial -->
</div>
@endsection
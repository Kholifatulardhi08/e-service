@extends('admin.layouts.layout')
@section('content')
<?php
use App\Models\Product;
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">order</h4>
                        @if(Session::has('succses_message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Succses: </strong> {{ Session::get('succses_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table id="orders" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Order Id
                                        </th>
                                        <th>
                                            Order Date
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Order Product
                                        </th>
                                        <th>
                                            Grand total
                                        </th>
                                        <th>
                                            Payment Method
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    @foreach ($orders as $order)
                                    @if($order['order'])
                                    <tr>
                                        <td>
                                            {{ $no }}
                                        </td>
                                        <td>
                                            {{ $order['id'] }}
                                        </td>
                                        <td>
                                            {{ date('d-M-Y H:i:s', strtotime($order['created_at'])) }}
                                        </td>
                                        <td>
                                            {{ $order['nama'] }}
                                        </td>
                                        <td>
                                            {{ $order['email'] }}
                                        </td>
                                        <td>
                                            @php $count = 0; @endphp
                                            @foreach ($order['order'] as $item)
                                            {{ $item['nama'] }},{{ $item['quantity'] }}<br>
                                            @php $count++; @endphp
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $order['grand_total'] }}
                                        </td>
                                        <td>
                                            {{ $order['order_status'] }}
                                        </td>
                                        <td>
                                            {{ $order['payment_gateway'] }}
                                        </td>
                                        <td>
                                            <a title="Order detail" href="{{ url('admin/orders/'.$order['id']) }}">
                                                <i style="font-size:30px;" class="mdi mdi-file-document"></i>
                                            </a>
                                            <a title="Order detail" href="{{ url('admin/orders/invoice/'.$order['id']) }}">
                                                <i style="font-size:30px;" class="mdi mdi-printer"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                    <?php $no++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layouts.footer')
    <!-- partial -->
</div>
@endsection
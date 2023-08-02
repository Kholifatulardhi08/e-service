<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2>Invoice / E-service</h2>
                <h3 class="pull-right">Order # {{ $orderdetails['id'] }}</h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Billed To:</strong><br>
                        @if(isset($userdetails['name']))
                        {{ $userdetails['name'] }}<br>
                        @endif
                        @if(isset($userdetails['email']))
                        {{ $userdetails['email'] }}<br>
                        @endif
                        @if(isset($userdetails['no_hp']))
                        {{ $userdetails['no_hp'] }}<br>
                        @endif
                        @if(isset($userdetails['kota']) && isset($userdetails['provinsi']))
                        @if(isset($userdetails['name']) || isset($userdetails['email']) || isset($userdetails['no_hp']))
                        {{ $userdetails['kota'] }}, {{ $userdetails['provinsi'] }}
                        @else
                        {{ $userdetails['kota'] }}, {{ $userdetails['provinsi'] }}<br>
                        @endif
                        @endif
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>shipped To:</strong><br>
                        {{ $orderdetails['nama'] }},<br>
                        {{ $orderdetails['email'] }},<br>
                        {{ $orderdetails['no_hp'] }},<br>
                        {{ $orderdetails['kota'] }}, {{ $orderdetails['provinsi'] }}
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <strong>Payment Method:</strong><br>
                    @if(isset($orderdetails['payment_method']) && !empty($orderdetails['payment_method']))
                    {{ $orderdetails['payment_method'] }}
                    @else
                    COD
                    @endif
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Order Date:</strong><br>
                        {{ date('d-M-Y H:i:s', strtotime($orderdetails['created_at'])) }}<br><br>
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order Details</strong></h3>
                    @if($orderdetails['payment_method']=="")
                    <font color="red">Already Paid (COD)</font>
                    @endif
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Product</strong></td>
                                    <td class="text-center"><strong>Price</strong></td>
                                    <td class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-right"><strong>Totals</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $subtotal = 0
                                @endphp
                                @foreach ($orderdetails['order'] as $o)
                                <tr>
                                    <td>{{ $o['nama'] }}</td>
                                    <td class="text-center">{{ $o['harga'] }}</td>
                                    <td class="text-center">{{ $o['quantity'] }}</td>
                                    <td class="text-right">Rp. {{ $o['harga']*$o['quantity'] }}</td>
                                </tr>
                                @endforeach
                                @php
                                $subtotal = $subtotal + ($o['harga']*$o['quantity'])
                                @endphp
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Total</strong></td>
                                    <td class="no-line text-right">{{ $subtotal }}</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Grand Total</strong></td>
                                    <td class="no-line text-right">{{ $subtotal }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
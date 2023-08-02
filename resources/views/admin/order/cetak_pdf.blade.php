<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        /* Gaya CSS untuk tampilan invoice */
        body {
            font-family: Arial, sans-serif;
        }

        .invoice-header {
            background-color: #f0f0f0;
            padding: 10px;
            display: flex;
            justify-content: space-between;
        }

        .invoice-body {
            padding: 20px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice-header">
        <div class="text-left">
            <h1>Invoice</h1>
        </div>
        <div class="text-right">
            @php
            echo DNS1D::getBarcodeHTML($orderdetails['id'], 'C39');
            @endphp
        </div>
    </div>
    <div class="invoice-body">
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @php
                $subtotal = 0
                @endphp
                @foreach($orderdetails['order'] as $item)
                <tr >
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item['harga'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @php
        $subtotal = $subtotal + ($item['harga']*$item['quantity'])
        @endphp
        <p>Total Amount: {{ $subtotal }}</p>
    </div>
</body>

</html>
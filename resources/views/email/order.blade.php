<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Welcome to E-service</title>
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        table {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        td {
            padding: 10px;
        }

        .header {
            background-color: #f2f2f2;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .content {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }

        .footer {
            background-color: #f2f2f2;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <table style="width: 700px">
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td class="header">Hello {{ $name }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Thank you for shopping with us! Your order details are as follows:</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Order No : {{ $order_id }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table style="width: 95%">
                    <tr>
                        <td>Product Name</td>
                        <td>Quantity</td>
                        <td>Harga</td>
                    </tr>
                    @foreach ($order_details['order'] as $order )
                    <tr>
                        <td>{{ $order['nama'] }}</td>
                        <td>{{ $order['quantity'] }}</td>
                        <td>{{ $order['harga'] }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">Grand Total :</td>
                        <td colspan="3">{{ $order_details['grand_total'] }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <table>
            <tr>
                <td>Delivery Address</td>
            </tr>
            <tr>
                <td>{{ $order_details['nama'] }}</td>
                <td>{{ $order_details['alamat'] }}</td>
                <td>{{ $order_details['kecamatan'] }}</td>
                <td>{{ $order_details['kota'] }}</td>
                <td>{{ $order_details['provinsi'] }}</td>
                <td>{{ $order_details['kode_pos'] }}</td>
            </tr>
        </table>
    </table>
</body>

</html>
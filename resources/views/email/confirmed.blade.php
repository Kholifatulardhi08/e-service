<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Penyedia Confirmation</title>
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

        .details {
            border-collapse: collapse;
            width: 100%;
        }

        .details th,
        .details td {
            border: 1px solid #e0e0e0;
            padding: 8px;
            text-align: left;
        }

        .details th {
            background-color: #f2f2f2;
        }

        .footer {
            background-color: #f2f2f2;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <table cellspacing="0" cellpadding="0">
        <tr>
            <td class="header">
                Penyedia Confirmation
            </td>
        </tr>
        <tr>
            <td class="content">
                <p>Dear {{ $nama }},</p>
                <p>Your penyedia account is confirmed. You can now log in and add your personal bank and jasa details.
                </p>
                <p>Your Details:</p>
                <table class="details">
                    <tr>
                        <th>Name</th>
                        <td>{{ $nama }}</td>
                    </tr>
                    <tr>
                        <th>No Handphone</th>
                        <td>{{ $no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $email }}</td>
                    </tr>
                </table>
                <p>Thank you,</p>
                <p>E-service</p>
            </td>
        </tr>
        <tr>
            <td class="footer">
                &copy; 2023 E-service. All rights reserved.
            </td>
        </tr>
    </table>
</body>

</html>
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
    <table cellspacing="0" cellpadding="0">
        <tr>
            <td class="header">
                Welcome to E-service
            </td>
        </tr>
        <tr>
            <td class="content">
                <p>Dear {{ $nama }},</p>
                <p>Please click below to activate your penyedia account:</p>
                <p>
                    <a class="button" href="{{ url('penyedia/confirm/'.$code) }}">
                        Activate Account
                    </a>
                </p>
                <p>If the button above does not work, you can also copy and paste the following link into your browser:</p>
                <p>
                    {{ url('penyedia/confirm/'.$code) }}
                </p>
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

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
</head>

<body>
    <tr>
        <td>
            Dear {{ $nama }}!
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            please click on bellow to active your penyedia account: -
        </td>
    </tr>
    <tr>
        <td>
            <a href="{{ url('penyedia/confirm/'.$code) }}">
                {{ url('penyedia/confirm/'.$code) }}
            </a>
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            thanks
        </td>
    </tr>
    <tr>
        <td>
            E-service
        </td>
    </tr>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Label</title>

    <style>
        @page { size: 8cm 29cm potrait; }
        @page { margin-top: 3mm;
                margin-left: 0.6cm;
        }
    </style>
</head>
<body>
    @for ($i = 1; $i <= $request->counter; $i++)
        <table class="center">
            <tr>
                <td>
                    <p >{{$request->item_desc}} / {{$request->item}} / {{$request->grn}}</p>
                </td>

                <td>
                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($request->item,"QRCODE",6,6) }}"
                    alt="{{ $request->item}}"
                    width="80"
                    height="80">
                </td>
            </tr>
        </table>
    @endfor
</body>
</html>

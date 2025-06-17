<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buana Megah</title>
    <style>
         .brlarge {
            display: block;
            margin-bottom: 11em;
        }
         .brsmall {
            display: block;
            margin-bottom: 9em;
        }
        @page {
            margin: 0 !important;
            margin-top: 0 !important;
            /* padding: 5px !important; */
            size: auto;
            /*  auto is the current printer page size */

        }
        /** Define the header rules **/
        header {
            position: fixed;
            top: 10px;
            left: 10px;
            right: 20px;
            height: 3cm;
        }

        /** Define the footer rules **/
        footer {
            position: absolute;
            bottom: 0cm;
            right: 1cm;
            padding-bottom: 30px;
            text-align: right;
        }


        #footer .page::before {
            /* counter-increment: page; */
            content: counter(page);
        }

        /* p{
                        counter-reset: page;
                    } */

        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: #333;
            text-align: left;
            font-size: 11;
            font-weight: normal;
            font-style: normal;
            /* margin-top: 2.8cm; */
            margin-left: 20px;
            margin-right: 20px;
            font-size: 11px;
        }

        .margin {
            margin-top: 2.8cm;
        }

        .container {
            /* to centre page on screen*/
            /* border:1px solid #333; */
        }

        table {
            width: 100%;
            padding-left: 0;
            padding: 10px;
            border-collapse: collapse;
        }

        table .table-content{
        }

        tr,
        th {
            /* padding-right:3px; */
            padding: 10px;
            width: auto;
        }

        th {
            /* background-color: #E5E4E2; */
            font-size: 11px;
            /* width: 98%; */
            margin: 10px;
            height: 60px;
            border-top: 1px solid #40963b;
            border-bottom: 1px solid #40963b;
        }

        h4,
        p {
            margin: 0px;
            font-size: 12px;
        }

        td {
            padding: 2px;
            font-size: 11px;
            /* vertical-align: text-top; */
            width: auto;
        }

        .table-footer {
            margin-top: 5% !important;
            text-align: center;
            font-size: 12px;
            object-position: center bottom !important;
        }

        .bg {
            background-color: #E5E4E2;
        }

        tfoot {
            margin-top: 5% !important;
            border-top: 1px solid #cacaca;
            border-bottom: 1px dashed #cacaca;
        }

        tbody{
            border: 2px solid #40963b;
        }

        .page_break {
            page-break-before: always;
        }

        hr {
            color: green;
        }
        
        .npwp{
            /* margin-top: 90%; */
            position: fixed;
            bottom: 0;
            width: 100%;
            padding-left: 10px;
            padding-bottom: 30px;
        }

    </style>
</head>

<body>
    <header>
        <table>
            <thead>
            <tr style="height:80px">
                <td style="width: 150%;">
                    <img style="width: 15%; float:left" src="app-assets/images/logo/favicon.png" alt="buana-megah">
                    <p style="font-size:24px; margin-top:5px;"><b style="color: green;">&nbsp; PT. BUANA MEGAH</b></p>
                    <p style="font-size:16px; font-family: Courier; color: green;">&nbsp;PAPER MILLS</p>
                    <p style="font-size:16px; font-family: Courier; color: green;">&nbsp;www.buanamegah.com</p>
                </td>
                <td style="width:70%;">
                    <p style="font-size:20px;  font-family: Courier; color: green;">
                        <b style="color: green;"> &nbsp;&nbsp;&nbsp;</b>
                    </p>
                    <p style="font-size:12px; font-family: Courier; color: green;">ISO 00000/000/0000</p>
                    <p style="font-size:12px; font-family: Courier; color: green;">ISO 00000/000/0000<</p>
                    <p style="font-size:12px; font-family: Courier; color: green;">ISO 00000/000/0000</p>
                </td>
            </tr>
            </thead>
        </table>
    </header>

    {{-- Body --}}
    @foreach ($roll as $roll)
    <div class="container ">
        <table style="margin-top: 100px; height: 250px;" class="table-content">
            <tbody>
                <tr>
                    <th style="color: green;font-size:40px;  font-weight: normal;" colspan="1" align="left">&nbsp; PROFILE</th>
                    <th style="font-size:40px;"align="center" colspan="3">{{$roll->itemmaster->item_code}} {{number_format($roll->attribute_number_gsm,0)}} GSM</th>
                </tr>
                <tr>
                    <th style="color: green;font-size:40px; font-weight: normal;" align="left">&nbsp; WIDTH</th>
                    <th rowspan="2" style=" width:20%;" align="center"><img src="data:image/png;base64,{{DNS2D::getBarcodePNG("$roll->uniq_attribute_roll", "QRCODE",6,6)}}"></th>
                    <th style="font-size:40px;"align="center"> {{number_format($roll->attribute_number_w,0)}}</th>
                    <th style="font-size:40px; color: green; font-weight: normal; width:15%;"align="center">CM &nbsp;</th>
                </tr>
                <tr>
                    <th style="color: green;font-size:40px; font-weight: normal;"align="left">&nbsp; WEIGHT</th>
                    <th style="font-size:40px;"align="center">{{number_format($roll->primary_quantity,0)}}</th>
                    <th style="font-size:40px; color: green; font-weight: normal; width:15%;"align="center">KG &nbsp;</th>
                </tr>
                <tr>
                    <th style="color: green;font-size:40px; font-weight: normal;" colspan="1" align="left">&nbsp; NO ROLL</th>
                    <th style="font-size:40px;"align="center" colspan="3">{{$roll->uniq_attribute_roll}}</th>
                </tr>
                <tr>
                    <th style="color: green;font-size:40px; font-weight: normal;" colspan="1" align="left">&nbsp; Quality</th>
                    <th style="font-size:40px;"align="center" colspan="3">Q{{$roll->attribute_num_quality}}</th>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="page-break"></div>
    @endforeach
</body>
</html>

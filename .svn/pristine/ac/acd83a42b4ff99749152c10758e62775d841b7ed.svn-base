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
            margin-bottom: 10em;
        }
        @page {
            margin: 0 !important;
            margin-top: 0 !important;
            /* padding: 5px !important; */
            size: auto;
            /*  auto is the current printer page size */

        }

        *

        /** Define the header rules **/
        header {
            position: fixed;
            top: 1cm;
            left: 20px;
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
            text-align: center;
            border-top: 1px solid #000000;
            border-bottom: 1px solid #000000;
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

        .page_break {
            page-break-before: always;
        }

        hr {
            color: green;
        }

        .table-content {
            padding: 15px !important;
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
    @foreach($payment as $key => $row)
    {{-- <header> --}}
        <table>
            <tr style="height:90px">
                <td style="width: 100%;">
                    <img style="width: 12%; float:left" src="app-assets/images/logo/favicon.png" alt="buana-megah">
                    <p style="font-size:16px; margin-top:5px"><b style="color: green;">&nbsp;&nbsp;PT. BUANA MEGAH</b></p>
                    <p style="font-size:12px;">
                        <b> &nbsp;&nbsp;Head Office : </b>Jl. Argopuro 42, Surabaya 60251, East Java, Indonesia<br>&nbsp;
                        <b>Pasuruan Office : </b>Jalan Raya Cangkringmalang km. 40, Beji Pasuruan 67154 East Java, Indonesia<br>&nbsp;
                        <b>Tel. </b>&nbsp;082231723136, 08510062998<br>
                    </p>
                </td>
                <td><img style="float:right" src="data:image/png;base64,{{DNS2D::getBarcodePNG("http://192.168.1.210:8080/", "QRCODE", 3,3)}}"></td>
            </tr>
        </table>
        <hr>
    {{-- </header> --}}
    @php $count=1; $page=8;@endphp
    <div class="container ">
        <table style="margin-top: 20px">
            {{-- <br class="brlarge"> --}}
            <tr>
                <td colspan="4">
                    <h3 style="text-align: center"><b>PAYMENTS</b> </h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: text-top; !important">
                    <h4>Payment Receipt: : {{$row->payment_num}}</h4>
                </td>
                <td>
                    <h4>Payment Date: {{$row->accounting_date}}</h4>
                </td>
                <td>
                    <h4>Currency : {{$row->accounting_date}}</h4>
                </td>
            </tr>
            <tr>
                <td>
                    <h4 style="text-align: top">Vendor: {{$row->vendor->vendor_name}}</h4>
                </td>

                <td>
                    <h4>Payment Method: {{$row->invoice_payment_type}}</h4>
                </td>
            </tr>
            <tr>
                <td>
                    <h4 style="text-align: top">Payment Amount:{{ number_format($row->amount, 2, ',', '.') }}</h4>
                </td>
                <td>
                    <h4>Memo: {{$row->attribute1}}</h4>
                </td>
            </tr>
        </table>
        <table>
            <tbody>
                @php $subtotal=0; @endphp
                <tr>
                    <th>Invoice Date</th>
                    <th>Invoice Number</th>
                    <th>Book</th>
                    <th>Reference</th>
                    <th>Currency</th>
                    <th>Amount</th>
                </tr>

                <tr>
                    <td align="center">{{$row->created_at}}</td>
                    <td align="center">{{$row->accpay->invoice_num??''}}</td>
                    <td align="center">{{$row->journal->description }}</td>
                    <td align="center">INV/2018/0057</td>
                    <td align="center">{{$row->payment_currency_code}}</td>
                    <td align="center">{{ number_format($row->amount, 2, ',', '.') }}</td>
                </tr>
                @php $subtotal+=($row->amount);@endphp
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="1"></td>
                    <td align="center"><strong>Due Amount for BILL {{$row->accounting_date}}/{{$row->attribute1}}</strong></td>
                    <td colspan="3"></td>
                    <td align="center"><strong>{{ number_format($subtotal, 2, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>
        <table class="table-footer">
            <tr>
                <td>Prepared By,</td>
                <td>Checked By,</td>
                <td>Approved By,</td>
                <td>Receive By,</td>
            </tr>
            <tr>
                <td style="height: 50px"></td>
            </tr>
            <tr>
                <td> __________________ </td>
                <td> __________________ </td>
                <td> __________________ </td>
                <td> Supplier </td>
            </tr>
        </table>
        <div class="npwp">
            <p style="font-size:10px;"><b>NPWP :</b> 02.208.933.8-614.000 <b> - PT. BUANA MEGAH : </b>Jl. Argopuro 42, Surabaya 60251, East Java, Indonesia </p>
        </div>
    </div>
    @if ($loop->last)
    <div style="page-break-before: avoid"> </div>
    @else
    <div class="page_break"></div>
    @endif
    @endforeach
</body>
</html>

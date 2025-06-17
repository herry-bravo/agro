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

    <header>
        <table>
            <tr style="height:90px">
                <td style="width: 150%;">
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
    </header>


    @foreach($ap as $key => $raw)
    {{-- Footer numbering --}}
    {{-- @if($lg == 1)<div class="margin"></div>@endif --}}
    @php $count=1; $page=2;@endphp
    <footer>
        <div>
            <p>Page {{$count}} /
                @foreach ($counter as $ctr )
                @if ($raw->id==$ctr->invoice_id)
                <?=
                    $last = ceil($ctr->pgs/$page);
                ?>
                @endif
                @endforeach
            </p>
        </div>
    </footer>
    {{-- End Footer numbering --}}

    {{-- Body --}}
    <div class="container ">
        <table style="margin-top: 20px">
            <br class="brsmall">

            <tr>
                <td colspan="6">
                    <h3 style="text-align: center"><b>Account Payable</b> </h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: text-top; !important">
                    <h4>Due Date</h4>
                </td>
                <td>
                    <p>: {{ $raw->invoice_received_date->format('d-M-Y')}}</p>
                </td>
                <td style="width: 80px; vertical-align: text-top; !important">
                    <h4>Invoice No</h4>
                </td>
                <td style="vertical-align: text-top; !important">
                    <p>: {{ $raw->invoice_num}}</p>
                </td>
                <td>
                    <h4>Voucher No</h4>
                </td>
                <td>
                    <p>: {{ $raw->voucher_num ?? '' }} </p>
                </td>
            </tr>
            <tr>

                <td>
                    <h4> Tax</h4>
                </td>
                <td>
                    <p>: {{ number_format($raw->total_tax_amount,2) ?? '' }} </p>
                </td>
                <td>
                    <h4> Currency</h4>
                </td>
                <td>
                    <p>: {{ $raw->invoice_currency_code ?? '' }}</p>
                </td>
                <td>
                    <h4 style="text-align: top">Amount</h4>
                </td>
                <td>
                    <p>: {{number_format($raw->invoice_amount,2) ?? '' }} </p>
                </td>
            </tr>

            <tr>
                <td>
                    <h4 style="text-align: top">Invoice Date</h4>
                </td>
                <td>
                    <p>: {{ $raw->invoice_date->format('d-M-Y') ?? '' }} </p>
                </td>
                <td>
                    <h4>GL Date</h4>
                </td>
                <td>
                    <p>: {{ $raw->gl_date->format('d-M-Y') ?? '' }}</p>
                </td>
            </tr>

        </table>
        <table>
            <tbody>
                @php $subtotal=0; @endphp
                @php $tax=0; @endphp
                @php $totaldebit=0; @endphp
                @php $totalcredit=0; @endphp
                @php $totalcredit=0; @endphp
                @php $subtax=0; @endphp
                <tr>
                    <th align="center">Product</th>
                    <th align="center">Description</th>
                    <th align="center">Qty</th>
                    <th align="center">Price</th>
                    <th align="center">Account</th>
                    <th align="center">Label</th>
                    <th align="right">Debit</th>
                    <th align="right">Credit</th>
                </tr>

                {{-- Looping data --}}
                @php $line = 0; @endphp
                @foreach($ap_lines as $key => $row)
                @if ($row->invoice_id==$raw->invoice_id)
                @php $line ++;@endphp
                <tr>
                    <td align="center">{{ $row->ItemMaster->item_code ?? '' }}</td>
                    <td align="left">{{ $row->item_description ?? '' }}</td>
                    <td align="center" >{{ (float)$row->quantity_invoiced ?? '' }}</td>
                    <td align="center"> {{ number_format($row->unit_price)}}</td>
                    <td align="center">{{ $row->account_segment ?? '' }}</td>
                    <td align="left"> {{$row->item_description}}</td>
                    <td align="right"> {{ number_format($row->unit_price * $row->quantity_invoiced)}}</td>
                    <td align="right">0</td>
                </tr>

                {{-- Count total --}}
                @php $subtotal+=($row->unit_price * $row->quantity_invoiced);@endphp
                @php $totaldebit+=($row->unit_price * $row->quantity_invoiced);@endphp
                @php $totalcredit+=($row->unit_price * $row->quantity_invoiced);@endphp
                @php $tax=($lines->tax_rate);@endphp
                @php $subtax=($subtotal*$tax);@endphp

                {{-- Page Break Setting --}}
                @foreach ($counter as $ctr )
                @if ($raw->id==$ctr->invoice_id)
                {{-- page break boundary --}}
                @if ($line % $page == 0 && $line < $ctr->pgs )
                    {{-- @if($line % $page != 0) --}}

                    {{-- Count page number --}}
                    @php $count++;@endphp
                    <div class="page_break"></div>
                    {{-- @if($lg == 1)<div class="margin"></div>@endif --}}

                    {{-- Looping Header data --}}
                    <tr>
                        <td style="text-align: right" colspan="6">
                            <footer>
                                <div>
                                    <p>Page {{$count}} / {{$last}}</p>
                                </div>
                            </footer>
                        </td>
                    </tr>
                    <br class="brlarge">

                    <tr>
                        <td colspan="6">
                            <h3 style="text-align: center"><b>Account Payable</b> </h3>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: text-top; !important">
                            <h4>Due Date</h4>
                        </td>
                        <td>
                            <p>: {{ $raw->invoice_received_date->format('d-M-Y')}}</p>
                        </td>
                        <td style="width: 80px; vertical-align: text-top; !important">
                            <h4>Invoice No</h4>
                        </td>
                        <td style="vertical-align: text-top; !important">
                            <p>: {{ $raw->invoice_num}}</p>
                        </td>
                        <td>
                            <h4>Voucher No</h4>
                        </td>
                        <td>
                            <p>: {{ $raw->voucher_num ?? '' }} </p>
                        </td>
                    </tr>
                    <tr>

                        <td>
                            <h4> Tax</h4>
                        </td>
                        <td>
                            <p>: {{ number_format($raw->total_tax_amount,2) ?? '' }} </p>
                        </td>
                        <td>
                            <h4> Currency</h4>
                        </td>
                        <td>
                            <p>: {{ $raw->invoice_currency_code ?? '' }}</p>
                        </td>
                        <td>
                            <h4 style="text-align: top">Amount</h4>
                        </td>
                        <td>
                            <p>: {{number_format($raw->invoice_amount,2) ?? '' }} </p>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h4 style="text-align: top">Invoice Date</h4>
                        </td>
                        <td>
                            <p>: {{ $raw->invoice_date->format('d-M-Y') ?? '' }} </p>
                        </td>
                        <td>
                            <h4>GL Date</h4>
                        </td>
                        <td>
                            <p>: {{ $raw->gl_date->format('d-M-Y') ?? '' }}</p>
                        </td>
                    </tr>

                    <br>
                    {{-- Looping Table Head --}}
                    <tr>
                        <tr>
                            <th align="center">Product</th>
                            <th align="center">Description</th>
                            <th align="center">Qty</th>
                            <th align="center">Price</th>
                            <th align="center">Account</th>
                            <th align="center">Label</th>
                            <th align="right">Debit</th>
                            <th align="right">Credit</th>
                        </tr>
                    </tr>
                    @endif
                    @endif
                    {{-- @endif --}}
                    @endforeach

                    @endif
                    @endforeach
            </tbody>
            {{-- Table Footer, Total Counter --}}

            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center">{{$lines->tax_code->tax_account??''}}</td>
                    <td align="left">{{$lines->tax_code->acc->description??''}}</td>
                    <td align="right">{{number_format($subtax)}}</td>
                    <td align="right">0</td>
                    <td align="center"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center">{{ $lines->ItemMaster->category->payable_account_code??''}}</td>
                    <td align="left">{{ $raw->invoice_num}}</td>
                    <td align="right">0</td>
                    <td align="right">{{ number_format($subtotal+$subtax) }}</td>
                    <td align="center"></td>
                </tr>
            </tfoot>
            <tfoot>

                <tr>
                    <td colspan="6"></td>
                    <td align="right">{{ number_format($subtotal+$subtax) }}</td>
                    <td align="right">{{ number_format($subtotal+$subtax) }}</td>
                </tr>
            </tfoot>

        </table>
        <table class="table-footer">
            <tr>
                <td></td>
                <td>Checked By,</td>
                <td>Approved By,</td>
                <td></td>
            </tr>
            <tr>
                <td style="height: 50px"></td>
            </tr>
            <tr>
                <td> </td>
                <td> __________________ </td>
                <td> __________________ </td>
                <td> </td>
            </tr>
        </table>
    </div>




    {{-- Ignore Page Break in Last Loop --}}
    @if ($loop->last)
    <div style="page-break-before: avoid"> </div>
    @else
    <div class="page_break"></div>
    @endif

    @endforeach
</body>
</html>

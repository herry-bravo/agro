<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Buana Megah</title>
        <style>
            @page
                {
                    margin: 0 !important;
                    margin-top: 0 !important;
                    /* padding: 5px !important; */
                    size: auto;  /*  auto is the current printer page size */

                }
                *

                    /** Define the header rules **/
                    header {
                        position: fixed;
                        top: 10px;
                        left: 20px;
                        right: 20px;
                        height: 2cm;
                    }

                    /** Define the footer rules **/
                    footer {
                        position:relative;
                        top: 11.5cm;
                        bottom: 0cm;
                        left: 0cm;
                        /* right: 1cm; */
                        height: 1cm;
                        text-align: right;
                        margin-right: 20px;
                    }


                    #footer .page::before {
                        /* counter-increment: page; */
                        content: counter(page);
                    }

                    /* p{
                        counter-reset: page;
                    } */

            body{
                font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                color:#333;
                text-align:left;
                font-size:12;
                margin-top: 2cm;
                margin-left: 20px;
                margin-right: 20px;
                font-size: 11px;
            }
            .container{
                /* to centre page on screen*/
                /* border:1px solid #333; */
            }
            table{
                width: 100%;
                padding-left: 0;
                padding: 10px;
                border-collapse: collapse;
            }

            tr, th{
                /* padding-right:3px; */
                padding:10px;
                width: auto;
            }
            th{
                /* background-color: #E5E4E2; */
                font-size:11px;
                /* width: 98%; */
                margin:10px;
                text-align: center;
                border-top:    1px solid  #000000;
                border-bottom: 1px solid #000000;
            }
            h4,p{
                margin:0px;
                font-size:14px;
            }
            td{
                padding:5px;
                font-size:12px;
                /* vertical-align: text-top; */
                width: auto;
            }
            .table-footer{
                margin-top: 5% !important;
                text-align: center;
                font-size:14px;
                object-position: center bottom !important;
            }
            .bg{
                background-color: #E5E4E2;
            }
            tfoot{
                margin-top: 5% !important;
                border-top:    1px solid  #cacaca;
                border-bottom: 1px dashed  #cacaca;
            }
            .page_break {
            page-break-before: always;
            }
            hr{
                color: green;
            }
            .table-content{
                padding: 15px !important;
            }

        </style>
    </head>
<body>

<header>
    <table>
        <tr style="height:90px">
            <td style="width: 100%;">
                <img style="width: 12%; float:left" src="app-assets/images/logo/favicon.png" alt="buana-megah">
                <p style="font-size:12px;"><b style="color: green;"> &nbsp;&nbsp;PT. Buana Megah</b><br>
                <b> &nbsp;&nbsp;Head Office : </b>Jl. Argopuro 42, Surabaya 60251, East Java, Indonesia<br>&nbsp;
                <b>Pasuruan Office : </b>Jalan Raya Cangkringmalang km. 40, Beji Pasuruan 67154 <br>&nbsp;&nbsp;East Java, Indonesia<br>&nbsp;
                <b>Tel. </b><a href="tel:+62343656288">656288</a>, <a href="tel:+62343656289">656289</a>  Fax. <a href="fax:+62343655054">655054</a><br></p>
            </td>
            <td  ><img style="float:right" src="data:image/png;base64,{{DNS2D::getBarcodePNG('https://www.google.com/', "QRCODE", )}}"></td>
        </tr>
    </table>
    <hr><br>
</header>
@foreach($header as $key => $raw)

{{-- Footer numbering --}}
@php $count=1; $page=4;@endphp
<footer>
    <div><p>Page {{$count}} /
        @foreach ($counter as $ctr )
            @if ($raw->shipment_header_id==$ctr->shipment_header_id)
                <?=
                    $last = ceil($ctr->pgs/$page);
                ?>
            @endif
        @endforeach
        </p>
    </div>
</footer>
{{-- End Footer numbering --}}
<div class="container ">
            <table>
                <tbody>
                    <tr><td align="center" colspan="4"><h4><strong>Good Receipt Note  </strong></h4></td></tr>
                    <tr>
                        <td>Supplier</td>
                        <td>: ({{ $raw->vendor_id ?? '' }}) {{ $raw->vendor->vendor_name ?? ''}}</td>
                        <td>GRN</td>
                        <td>: {{ $raw->receipt_num ?? '' }} ({{$raw->transaction_type}}) / {{ date('d-M-Y', strtotime($raw->gl_date ?? '')) }}</td>
                    </tr>
                    <tr>
                        <td>Receipt BY</td>
                        <td>: {{ $raw->User->name ?? ''}}</td>
                        <td>Packing Slip</td>
                        <td>: {{ $raw->packing_slip ?? ''}}</td>
                    </tr>
                </tbody>
            </table>
            <table>
                    <tr>
                        <th class="center">#</th>
                        <th class="center">Order No</th>
                        <th>Item</th>
                        <th>Description</th>
                        <th class="text-center">UOM</th>
                        <th class="text-end">Qty</th>
                        <th class="text-end">Decrese</th>
                    </tr>
                <tbody>
                    @php $subtotal=0; $line = 0;@endphp
                    @foreach($data as $key => $row)
                        @if ($row->shipment_header_id==$raw->shipment_header_id)
                            @php $line ++@endphp
                            <tr>
                                <td align="center">{{ $row->id ?? ''}}</td>
                                <td align="center">{{ $row->purchaseorder->segment1 ?? ''}}</td>
                                <td>{{ $row->itemMaster->item_code ?? ''}}</td>
                                <td>{{ $row->item_description ?? ''}}</td>
                                <td align="center">{{ $row->uom_code ?? ''}}</td>
                                <td align="right">{{ number_format(($row->quantity_accepted ?? $row->quantity_received),1,'.')}}/ {{ $row->quantity_received ?? $row->quantity_returned}}</td>
                                <td align="right">{{ number_format($row->quantity_received - $row->quantity_accepted),1,'.'}}</td>
                            </tr>
                            @foreach ($counter as $ctr )
                                @if ($raw->id==$ctr->shipment_header_id)
                                    {{-- page break boundary --}}
                                    @if ($line % $page == 0 && $line < $ctr->pgs)
                                        <div class="page_break"></div>
                                        @php $count++;@endphp
                                        <tr >
                                            <td colspan="6">
                                                <footer>
                                                    <div><p>Page {{$count}} / {{$last}}</p></div>
                                                </footer>
                                            </td>
                                        </tr>
                                        <tr><td align="center" colspan="6"><h4><strong><br>Good Receipt Note </strong></h4></td></tr>
                                        <tr>
                                            <td>Supplier</td>
                                            <td colspan="2">: ({{ $raw->vendor_id ?? '' }}) {{ $raw->vendor->vendor_name ?? ''}}</td>
                                            <td>GRN</td>
                                            <td colspan="2">: {{ $raw->receipt_num ?? '' }} ({{$raw->transaction_type}}) / {{ date('d-M-Y', strtotime($raw->gl_date ?? '')) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Receipt BY</td>
                                            <td colspan="2">: {{ $raw->User->name ?? ''}}</td>
                                            <td>Packing Slip</td>
                                            <td colspan="2">: {{ $raw->packing_slip ?? ''}}</td>
                                        </tr>
                                        <tr><td colspan="6"><br></td></tr>
                                        <tr>
                                            <th class="center">#</th>
                                            <th class="center">Order No</th>
                                            <th>Item</th>
                                            <th>Description</th>
                                            <th class="text-center">UOM</th>
                                            <th class="text-end">Receipt / Return Qty</th>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>

            <table class="table-footer mt-4">
                <tr>
                    <td class="text-center">Received By,</td>
                    <td class="text-center">Checked By,</td>
                    <td class="text-center">Approved By,</td>
                    <td class="text-center">Approved By,</td>
                </tr>
                <tr>
                    <td style="height: 30px"></td>
                </tr>
                <tr>
                    <td class="text-center">_____________________</td>
                    <td class="text-center">_____________________</td>
                    <td class="text-center">_____________________</td>
                    <td class="text-center">_____________________</td>
                </tr>
            </table>
</div>

@if ($loop->last)
    <div style="page-break-before: avoid"></div>
@else
    <div class="page_break"></div>
@endif
@endforeach
<!-- /.content -->
</body>
</html>

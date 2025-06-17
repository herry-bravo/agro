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
                        height: 3cm;
                    }

                    /** Define the footer rules **/
                    footer {
                        position:relative;
                        top: 26cm;
                        bottom: 0cm;
                        left: 0cm;
                        right: 1cm;
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

<body>z
<header>
    <table>
        <tr style="height:90px">
            <td style="width: 85%;">
                <img style="width: 12%; float:left" src="app-assets/images/logo/favicon.png" alt="buana-megah">
                <p style="font-size:14px;"><b style="color: green;"> &nbsp;&nbsp;PT. Buana Megah</b><br>&nbsp;&nbsp;Jalan Raya Cangkringmalang km. 40, Beji
                Pasuruan 67154 East Java, Indonesia<br>&nbsp;
                <b>Head Office : </b>Jl. Argopuro 42, Surabaya 60251, East Java, Indonesia<br>&nbsp;
                <b>Tel. </b><a href="tel:+62343656288">656288</a>, <a href="tel:+62343656289">656289</a>  Fax. <a href="fax:+62343655054">655054</a><br></p></td>
            <td  ><img style="float:right" src="data:image/png;base64,{{DNS2D::getBarcodePNG('https://www.google.com/', "QRCODE", )}}"></td>
        </tr>
    </table>
    <hr>
</header>

{{-- <footer>
    <div id="footer"><p class="page"></p>  </div>
</footer> --}}
@foreach($header as $key => $raw)
@php $count=1; @endphp
<footer>
    <div><p>Page {{$count}} /
        @foreach ($counter as $ctr )
            @if ($raw->id==$ctr->po_header_id)
                {{-- @if ($ctr->pgs == ) --}}
                <?= $last = $ctr->pgs+1;?>
            @endif
        @endforeach
        </p></div>
</footer>
<div class="container ">
    <table>
        <tr >
            <td colspan="4"><h3 style="text-align: center"><b>Purchase Order</b> {{$raw->id}}</h3></td>
        </tr>
        <tr>
            <td style="vertical-align: text-top; !important">
                <h4>Supplier</h4>
            </td>
            <td style="vertical-align: text-top; !important">
                <p>: ({{ $raw->vendor_id ?? '' }}) - {{ $raw->vendor->vendor_name ?? '' }}
                    <br> {{ $raw->vendor->address1 ?? '' }}
                    {{ $raw->vendor->city ?? '' }}, {{ $raw->vendor->province ?? '' }}
                    <br>{{ $raw->vendor->phone ?? '' }}
                </p>
            </td>
            <td style="width: 100px; vertical-align: text-top; !important">
                <h4>Delivery To</h4>
            </td>
            <td style="vertical-align: text-top; !important">
                <p>: ({{ $raw->ship_to_location ?? '' }})  {{ $raw->site->address1}}
                    <br> {{ $raw->site->address2}} {{ $raw->site->city ?? '' }}, {{ $raw->site->province ?? '' }}
                    <br>{{ $raw->site->phone ?? '' }}
                </p>
            </td>
        </tr>
        <tr>
            <td >
                <h4>Term</h4>
            </td>
            <td >
                <p>: {{ $raw->term_id ?? '' }} </p>
            </td>
            <td>
                <h4> Number</h4>
            </td>
            <td>
                <p>: {{ $raw->segment1 ?? '' }} </p>
            </td>
        </tr>
        <tr>
            <td>
                <h4 style="text-align: top">Freight</h4>
            </td>
            <td >
                <p>: {{ $raw->freight ?? '' }} </p>
            </td>
            <td>
                <h4> Date</h4>
            </td>
            <td>
                <p>: {{ $raw->created_at ?? '' }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <h4 style="text-align: top">Carrier</h4>
            </td>
            <td >
                <p>: {{ $raw->carrier ?? '' }}</p>
            </td>
            <td>
                <h4>Curenncy</h4>
            </td>
            <td >
                <p>: {{ $raw->currency_code ?? '' }}</p>
            </td>
        </tr>
    </table>
    <table >
        <tbody>
            @php $subtotal=0; @endphp
                    <tr>
                        <th>#</th>
                        <th colspan="">Item</th>
                        <th >Description</th>
                        <th style="width: 120px; !important">Unit Cost</th>
                        <th >Qty</th>
                        <th style="width: 150px; !important">Total</th>
                    </tr>
                {{-- @for ($i = 0; $i < 10; $i++) --}}
                @php $line = 0; @endphp
                @foreach($data as $key => $row)
                    @if ($row->po_header_id==$raw->id)
                        @php $line ++;@endphp
                        <tr>
                            <td align="center">{{ $row->line_id ?? '' }}</td>
                            <td>{{ $row->itemMaster->item_code ?? '' }}</td>
                            <td>{{ $row->item_description ?? '' }}</td>
                            <td width="10%" align="right"> {{ number_format($row->unit_price, 2, ',', '.') }}</td>
                            <td align="right">{{ $row->po_quantity ?? '' }}</td>
                            <td align="right">{{ number_format($row->unit_price * $row->po_quantity, 2, ',', '.') }}</td>
                        </tr>
                        @php $subtotal+=($row->unit_price * $row->po_quantity);@endphp
                        @foreach ($counter as $ctr )
                            @if ($raw->id==$ctr->po_header_id)
                                @if ($line % 5 == 0 && $line < $ctr->rows)
                                    <p>{{$line}}</p>
                                    @php $count++;@endphp
                                    <div class="page_break"></div>
                                    <tr >
                                        <td colspan="6">
                                            <footer>
                                                <div><p>Page {{$count}} / {{$last}}</p></div>
                                            </footer>
                                        </td>
                                    </tr>
                                    <tr >
                                        <td colspan="6"><h3 style="text-align: center"><b>Purchase Order</b> {{$raw->id}}</h3></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: text-top; !important">
                                            <h4>Supplier</h4>
                                        </td>
                                        <td colspan="2" style="vertical-align: text-top; !important">
                                            <p>: ({{ $raw->vendor_id ?? '' }}) - {{ $raw->vendor->vendor_name ?? '' }}
                                                <br> {{ $raw->vendor->address1 ?? '' }}
                                                {{ $raw->vendor->city ?? '' }}, {{ $raw->vendor->province ?? '' }}
                                                <br>{{ $raw->vendor->phone ?? '' }}
                                            </p>
                                        </td>
                                        <td style="width: 100px; vertical-align: text-top; !important">
                                            <h4>Delivery To</h4>
                                        </td>
                                        <td colspan="2" style="vertical-align: text-top; !important">
                                            <p>: ({{ $raw->ship_to_location ?? '' }})  {{ $raw->site->address1}}
                                                <br> {{ $raw->site->address2}} {{ $raw->site->city ?? '' }}, {{ $raw->site->province ?? '' }}
                                                <br>{{ $raw->site->phone ?? '' }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4>Term</h4>
                                        </td>
                                        <td colspan="2">
                                            <p>: {{ $raw->term_id ?? '' }} </p>
                                        </td>
                                        <td>
                                            <h4> Number</h4>
                                        </td>
                                        <td colspan="2">
                                            <p>: {{ $raw->segment1 ?? '' }} </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 style="text-align: top">Freight</h4>
                                        </td>
                                        <td colspan="2">
                                            <p>: {{ $raw->freight ?? '' }} </p>
                                        </td>
                                        <td>
                                            <h4> Date</h4>
                                        </td>
                                        <td colspan="2">
                                            <p>: {{ $raw->created_at ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 style="text-align: top">Carrier</h4>
                                        </td>
                                        <td colspan="2">
                                            <p>: {{ $raw->carrier ?? '' }}</p>
                                        </td>
                                        <td>
                                            <h4>Curenncy</h4>
                                        </td colspan="2">
                                        <td >
                                            <p>: {{ $raw->currency_code ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th colspan="">Item</th>
                                        <th >Description</th>
                                        <th style="width: 120px; !important">Unit Cost</th>
                                        <th >Qty</th>
                                        <th style="width: 150px; !important">Total</th>
                                    </tr>
                                @endif
                            @endif
                        @endforeach

                    @endif
                @endforeach
        </tbody>
        <tfoot >
            <tr>
                <td colspan="3"></td>
                <td align="left"><strong>Subtotal</strong></td>
                <td align="right">{{$raw->currency_code}} </td>
                <td align="right">{{ number_format($subtotal, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td  align="left" ><strong>Miscellaneous expense</strong></td>
                <td align="right">{{$raw->currency_code}}</td>
                <td align="right">{{ number_format($raw->attribute2, 2, ',', '.')}}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="left"><strong>{{$raw->vendor->tax->tax_name}}</strong></td>
                <td align="right">{{$raw->currency_code}}</td>
                <td align="right"> {{ number_format(($subtotal*$raw->vendor->tax->tax_rate), 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td  align="left"><strong>Total</strong></td>
                <td align="right">{{$raw->currency_code}} </td>
                <td align="right"> {{ number_format($subtotal+($subtotal*$raw->vendor->tax->tax_rate)+($raw->attribute2), 2, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <table class="table-footer">
        <tr >
            <td >Prepared By,</td>
            <td >Checked By,</td>
            <td >Approved By,</td>
            <td >Receive By,</td>
        </tr>
        <tr><td style="height: 50px"></td></tr>
        <tr >
            <td > __________________  </td>
            <td > __________________  </td>
            <td > __________________  </td>
            <td > Supplier </td>
        </tr>
    </table>
 </div>
@if ($loop->last)
    <div style="page-break-before: avoid"> </div>
@else
    <div class="page_break"></div>
@endif
{{-- </page> --}}
@endforeach
</body>
</html>

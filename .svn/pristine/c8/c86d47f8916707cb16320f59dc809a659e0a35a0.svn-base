<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buana Megah</title>
    <style>
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
        @if($lg == 1)
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
        @endif
    </header>


    @foreach($header as $key => $raw)
    {{-- Footer numbering --}}
    @if($lg == 1)<div class="margin"></div>@endif
    @php $count=1; $page=8;@endphp
    <footer>
        <div>
            <p>Page {{$count}} /
                @foreach ($counter as $ctr )
                @if ($raw->po_head_id==$ctr->po_header_id)
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
            <tr>
                <td colspan="4">
                    <h3 style="text-align: center"><b>Purchase Order</b> </h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: text-top; !important">
                    <h4>Supplier</h4>
                </td>
                @if ((isset($raw->vendor_site_id)) && ($raw->vendor_site_id != 'BM-000000000') )
                    <td>
                        <p>:{{ $raw->supplierSite->address1 ?? '' }}
                            <br> {{ $raw->supplierSite->address2 ?? '' }}
                            {{ $raw->supplierSite->city ?? '' }}, {{ $raw->supplierSite->province ?? '' }} - {{ $raw->supplierSite->country ?? '' }}
                            <br>{{ $raw->supplierSite->phone ?? '' }}
                        </p>

                    </td>
                @else
                    <td style="vertical-align: text-top; !important">
                        <p>:  {{ $raw->vendor->vendor_name ?? '' }}
                            <br> {{ $raw->vendor->address1 ?? '' }}
                            {{ $raw->vendor->city ?? '' }}, {{ $raw->vendor->province ?? '' }} - {{ $raw->vendor->country ?? '' }}
                            <br>{{ $raw->vendor->phone ?? '' }}
                        </p>
                    </td>
                @endif

                <td style="width: 80px; vertical-align: text-top; !important">
                    <h4>Delivery To</h4>
                </td>
                <td style="vertical-align: text-top; !important">
                    <p>:{{ $raw->site->address1}}
                        <br> {{ $raw->site->address2}} {{ $raw->site->city ?? '' }}, {{ $raw->site->province ?? '' }}
                        <br>{{ $raw->site->phone ?? '' }}
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Term</h4>
                </td>
                <td>
                    <p>: {{ $raw->terms->terms_name ?? '' }} </p>
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
                <td>
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
                    <h4 style="text-align: top">Origin </h4>
                </td>
                <td>
                    <p>: {{ $raw->origin->terms_name ?? '' }} </p>
                </td>
                <td>
                    <h4>Curenncy</h4>
                </td>
                <td>
                    <p>: {{ $raw->currency_code ?? '' }}</p>
                </td>
            </tr>
        </table>
        <table>
            <tbody>
                @php $subtotal=0; @endphp
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Description</th>
                    <th>ETA</th>
                    <th>Unit Cost</th>
                    <th>Qty</th>
                    <th>Total </th>
                </tr>

                {{-- Looping data --}}
                @php $line = 0; @endphp
                @foreach($data as $key => $row)
                @if ($row->po_header_id==$raw->po_head_id)
                @php $line ++;@endphp
                <tr>
                    <td style="padding:5px; width: 5%; !important" align="center">{{ $row->line_id ?? '' }}</td>
                    <td style="padding:5px; width: 10%; !important">{{ $row->itemMaster->item_code ?? '' }}</td>
                    <td style="width: 30%; !important" >{{ $row->item_description ?? '' }}</td>
                    <td style="width: 10%; !important" align="center" >{{ date('M-Y',strtotime($row->need_by_date)) ?? '' }}</td>
                    <td style="padding:5px; width: 15%; !important" align="right"> {{ number_format($row->unit_price, 2, ',', '.') }}</td>
                    <td style="padding:5px; width: 15%; !important" align="right">{{ $row->po_quantity ?? '' }} {{ $row->po_uom_code ?? '' }}</td>
                    <td style="padding:5px; width: 20%; !important" align="right">{{ number_format($row->unit_price * $row->po_quantity, 2, ',', '.') }}</td>
                </tr>
                {{-- Count total --}}
                @php $subtotal+=($row->unit_price * $row->po_quantity); $tax=$row->tax_name; @endphp

                {{-- Page Break Setting --}}
                @foreach ($counter as $ctr )
                @if ($raw->id==$ctr->po_header_id)
                {{-- page break boundary --}}
                @if ($line % $page == 0 && $line < $ctr->pgs )
                    {{-- @if($line % $page != 0) --}}

                    {{-- Count page number --}}
                    @php $count++;@endphp
                    <div class="page_break"></div>
                    @if($lg == 1)<div class="margin"></div>@endif

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
                    <tr>
                        <td colspan="6">
                            <h3 style="text-align: center"><b>Purchase Order</b></h3>
                        </td>
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
                            <p>: ({{ $raw->ship_to_location ?? '' }}) {{ $raw->site->address1}}
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
                            <p>: {{ $raw->terms->terms_name ?? '' }} </p>
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
                            <h4 style="text-align: top">Origin</h4>
                        </td>
                        <td colspan="2">
                            <p>: {{ $raw->origin->terms_name ?? '' }} </p>
                        </td>
                        <td>
                            <h4>Curenncy</h4>
                        </td colspan="2">
                        <td>
                            <p>: {{ $raw->currency_code ?? '' }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6"><br></td>
                    </tr>
                    {{-- Looping Table Head --}}
                    <tr>
                        <th>#</th>
                        <th colspan="">Item</th>
                        <th>Description</th>
                        <th>(ETA)</th>
                        <th>Unit Cost</th>
                        <th>Qty</th>
                        <th >Total</th>
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
                    <td colspan="4"></td>
                    <td align="left"><strong>Subtotal</strong></td>
                    <td align="right">{{$raw->currency_code}} </td>
                    <td align="right">{{ number_format($subtotal, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="left"><strong>Miscellaneous expense</strong></td>
                    <td align="right">{{$raw->currency_code}}</td>
                    <td align="right">{{ number_format($raw->attribute2, 2, ',', '.')}}</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="left"><strong>{{$tax}}</strong></td>
                    <td align="right">{{$raw->currency_code}}</td>
                    <td align="right"> {{ number_format(($subtotal*$data[0]->tax->tax_rate), 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="left"><strong>Total</strong></td>
                    <td align="right">{{$raw->currency_code}} </td>
                    <td align="right"> {{ number_format($subtotal+($subtotal*$data[0]->tax->tax_rate)+($raw->attribute2), 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        {{-- Aproval Colomn --}}
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
        <table>
            <tr>
                <td style="height: 50px; font-size:10px;">Remarks : <br>{{$raw->description}}</td>

            </tr>
            <tr>
                <td style="font-size:10px;">Notes : {{$raw->notes}}</td>
            </tr>
        </table>
        <div class="npwp">
            <p style="font-size:10px;"><b>NPWP :</b> 02.208.933.8-614.000 <b> - PT. BUANA MEGAH : </b>Jl. Argopuro 42, Surabaya 60251, East Java, Indonesia </p>
            <p style="font-size:10px;"><b>Instructions :</b> {{$raw->comment->comments?? ''}}</p><br>

        </div>
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

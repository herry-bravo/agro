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
                        /* height: 3cm; */
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

            body{
                font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                color:#333;
                text-align:left;
                font-size:12;
                margin-left: 20px;
                margin-right: 20px;
                font-size: 11px;
                /* margin-top: 2cm; */
            }
            .text-center{
                /* text-align: center; */
            }
            .margin{
                margin-top: 3cm;
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

            th{
                /* padding-right:3px; */
                padding:10px;
                width: auto;
            }
            th{
                /* background-color: #E5E4E2; */
                font-size:11px;
                /* width: 98%; */
                /* margin:10px; */
                text-align: center;
                border-top:    1px solid  #000000;
                border-bottom: 1px solid #000000;
            }
            h4,p{
                margin:0px;
                font-size:14px;
            }
            td{
                padding:2px;
                font-size:12px;
                /* vertical-align: text-top; */
                width: auto;
            }
            .table-footer{
                margin-top: 50% !important;
                text-align: right;
                /* float: right; */
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
            .npwp{
            /* margin-top: 90%; */
            position: fixed;
            bottom: 0;
            width: 80%;
            padding-left: 5px;
            padding-bottom: 5px;
        }
        </style>
    </head>

<body>
    @if($lg == 1)
        <header>
            <table>
                <tr style="height:90px">
                    <td style="width: 100%;">
                        <img style="width: 14%; float:left" src="app-assets/images/logo/favicon.png" alt="buana-megah">
                        <p style="font-size:16px; margin-top:5px"><b style="color: green;">&nbsp;&nbsp;NEXZO-APP</b></p>
                        <b> &nbsp;&nbsp;Head Office : </b>Jl. Argopuro 42, Surabaya 60251, East Java, Indonesia<br>&nbsp;
                        <b>Pasuruan Office : </b>Jalan Raya Cangkringmalang km. 40, Beji Pasuruan 67154 <br>&nbsp;&nbsp;East Java, Indonesia<br>&nbsp;
                        <b>Tel. </b> tel:+62343656288 , +62343656289 Fax. fax:+62343655054<br></p>
                    </td>
                    <td  ><img style="float:right" src="data:image/png;base64,{{DNS2D::getBarcodePNG('https://www.google.com/', "QRCODE", )}}"></td>
                </tr>
            </table>
            <hr>
        </header>
    @endif

@foreach($header as $key => $raw)
@if($lg==1) <div class="margin"></div> @endif

{{-- Footer numbering --}}
@php $count=1; $page=8;@endphp
<footer>
    <div><p>Page {{$count}} /
        @foreach ($counter as $ctr )
            @if ($raw->customer_trx_id==$ctr->customer_trx_id)
                <?=$last = ceil($ctr->pgs/$page);?>
            @endif
        @endforeach
        </p>
    </div>
</footer>
{{-- End Footer numbering --}}

<div class="container ">
    <table>
        <tr >
            <td colspan="6"><b><h2 style="text-align: center">Invoice</h2></b></td>
        </tr>
        <tr>
            <td colspan="2" style="vertical-align: text-top; !important">
                <h4>Invoice No</h4>
            </td>
            <td colspan="2" style="vertical-align: text-top; !important">
                <p>: {{$raw->trx_number}}
                </p>
            </td>
            <td style="width: 100px; vertical-align: text-top; !important">
                <h4>Delivery Date</h4>
            </td>
            <td colspan="2" style="vertical-align: text-top; !important">
                <p>: {{$raw->dalivery->on_or_about_date ?? ''}}
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width: 150px; vertical-align: text-top; !important">
                <h4>Bill To</h4>
            </td>
            <td colspan="2" >
                <p>: {{$raw->customer->party_name}} </p>
                <p>&nbsp; {{$raw->customer->address1}} </p>
                <p>&nbsp; {{$raw->customer->address2}} </p>
            </td>
            <td style="vertical-align: text-top; !important">
                <h4> Delivery To</h4>
            </td>
            <td  colspan="2" style="vertical-align: text-top; !important">
                <p>: {{$raw->party_site->address2 ?? $raw->customer->address1}} </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <h4 style="text-align: top">Customer PO</h4>
            </td>
            <td colspan="2" >
                <p>: {{$raw->dalivery->detail->cust_po_number ?? ''}}  </p>
            </td>
            <td>
                <h4> Delivery By</h4>
            </td>
            <td colspan="2" >
                <p>: {{$raw->dalivery->ship_method_code ?? '-'}}</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <h4 style="text-align: top">SO Number</h4>
            </td>
            <td colspan="2" >
                <p>: {{$raw->dalivery->detail->source_header_number ?? ''}}</p>
            </td>
            <td>
                <h4>Term</h4>
            </td>
            <td colspan="2" >
                <p>: {{$raw->term->terms_name??''}}</p>
            </td>
        </tr>
    </table>
    <table class="table-content">
        <tbody>
                    <tr class="tr">
                        <th>#</th>
                        <th style="text-align:left">Item</th>
                        <th style="text-align:left" >Description</th>
                        <th >Unit Price</th>
                        <th >Qty</th>
                        <th >Total</th>
                    </tr>
                {{-- @for ($i = 0; $i < 10; $i++) --}}
                @php $line = 0;   $total_roll=0; $total_weight=0; $subtotal=0; @endphp
                @foreach($data as $key => $row)
                    @if ($row->customer_trx_id==$raw->customer_trx_id)
                        @php $line++ @endphp
                            <tr>
                                <td style="padding:5px; width: 2%; !important" align="center">{{ $line }}</td>
                                <td style="padding:5px;" width="auto">{{ $row->itemMaster->item_code ?? '' }}</td>
                                <td style="padding:5px; width: 40%; !important"> {{ $row->description ?? '' }}</td>
                                <td style="padding:5px; width: auto; !important" align="right">{{ number_format($row->unit_selling_price, 2, ',', '.') }}</td>
                                <td style="padding:5px; width: 20%; !important"  align="right"> {{ number_format($row->quantity_invoiced,0,','.'') }} {{$row->requested_quantity_uom}} / {{$row->rollCount()}} {{$row->lot_number}} </td>
                                <td style="padding:5px;" align="right">{{ number_format($row->amount_due_original, 2, ',', '.') }}</td>
                            </tr>
                            {{-- Count total --}}

                        {{-- Page Break Setting --}}
                        @foreach ($counter as $ctr )
                            @if ($raw->customer_trx_id==$ctr->customer_trx_id)
                                {{-- page break boundary --}}
                                @if ($line % $page == 0 && $line < $ctr->pgs)
                                    <div class="page_break"></div>
                                    @php $count++;@endphp
                                    @if($lg == 1)<div class="margin"></div>@endif
                                    <tr >
                                        <td colspan="6">
                                            <footer>
                                                <div><p>Page {{$count}} / {{$last}}</p></div>
                                            </footer>
                                        </td>
                                    </tr>
                                    <tr >
                                        <td colspan="6"><h3 style="text-align: center"><b>Invoice</b></h3></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="vertical-align: text-top; !important">
                                            <h4>Invoice Number</h4>
                                        </td>
                                        <td colspan="2" style="vertical-align: text-top; !important">
                                            <p>: {{$raw->trx_number}}
                                            </p>
                                        </td>
                                        <td style="width: 100px; vertical-align: text-top; !important">
                                            <h4>Delivery Date</h4>
                                        </td>
                                        <td colspan="2" style="vertical-align: text-top; !important">
                                            <p>: {{$raw->dalivery->on_or_about_date}}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="width: 120px; !important">
                                            <h4>Bill To</h4>
                                        </td>
                                        <td colspan="2" >
                                            <p>: {{$raw->customer->party_name}} </p>
                                        </td>
                                        <td>
                                            <h4> Delivery To</h4>
                                        </td>
                                        <td  colspan="2" >
                                            <p>: {{$raw->party_site->address2}} </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h4 style="text-align: top">Customer PO</h4>
                                        </td>
                                        <td colspan="2" >
                                            <p>: {{$raw->dalivery->detail->cust_po_number ?? ''}}  </p>
                                        </td>
                                        <td>
                                            <h4> Delivery By</h4>
                                        </td>
                                        <td colspan="2" >
                                            <p>: {{$raw->dalivery->ship_method_code}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h4 style="text-align: top">SO Number</h4>
                                        </td>
                                        <td colspan="2" >
                                            <p>: {{$raw->dalivery->detail->source_header_number ?? ''}}</p>
                                        </td>
                                        <td>
                                            <h4>Term</h4>
                                        </td>
                                        <td colspan="2" >
                                            <p>: {{$raw->term->terms_name??''}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th >Item</th>
                                        <th >Description</th>
                                        <th >Unit Cost</th>
                                        <th >Qty</th>
                                        <th >Total</th>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                        @php  $total_roll += $row->rollCount();  $total_weight +=$row->quantity_invoiced;$subtotal+= $row->amount_due_original; @endphp
                    @endif
                @endforeach
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2" align="left"><strong>Total  </strong></td>
                    <td align="right"><strong>{{ number_format( $total_weight ,0,','.'') }} KG / {{  $total_roll}} {{$row->lot_number ?? 'roll'}} </strong></td>
                <td></td></tr>
       </tbody>
        {{-- Table Footer, Total Counter --}}
        <tfoot >
            <tr><td colspan="6"></td></tr>
            <tr></tr>
            <tr>
                <td colspan="3"></td>
                <td align="left"><strong>Subtotal</strong></td>
                <td align="right">{{$raw->currency->currency_code}} </td>
                <td align="right">{{ number_format($subtotal, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="left"><strong>{{$raw->arapp->tax_code}}</strong></td>
                <td align="right">{{$raw->currency->currency_code}}</td>
                <td align="right"> {{number_format($raw->arapp->tax_applied, 2, ',', '.')}}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td  align="left"><strong>Total</strong></td>
                <td align="right">{{$raw->currency->currency_code}} </td>
                <td align="right"> {{ number_format($raw->arapp->amount_applied, 2, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <table class="table-footer">
        <tr >
            <td class="text-center">Authorized By, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr><td style="height: 40px"></td></tr>
        <tr><td style="height: 20px"></td></tr>
        <tr >
            <td> ___________________________  </td>
        </tr>
    </table>
    <div class="npwp">
        <p style="font-size:10px;color:rgb(18, 190, 18);"><b>*) Produk dengan tanda ini adalah merupakan FSC  <b> - Recycled 100% nomor sertifikat SGSHK-COC-440032 </p><br>
            <p style="font-size:10px; color:rgb(18, 190, 18);"><b>&nbsp;&nbsp;&nbsp;&nbsp; FORM/F2FG/006.Rev0</b></p><br>
    </div>
 </div>

@if ($loop->last)
    <div style="page-break-before: avoid"></div>
@else
    <div class="page_break"></div>
@endif
@endforeach
</body>
</html>

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
                        position:relative;
                        top: 26cm;
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
                margin-left: 20px;
                margin-right: 20px;
                font-size: 11px;
            }

            .margin{
                margin-top: 2.8cm;
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
                padding:2px;
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
            table.table-content td{
                /* vertical-align: text-top; */
                padding: 5px;
                border-bottom: 1px dashed  #cacaca;
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


        </style>
    </head>

<body>
    @if($lg == 1)
        <header>
            <table>
                <tr style="height:90px">
                    <td style="width: 100%;">
                        <img style="width: 14%; float:left" src="app-assets/images/logo/favicon.png" alt="buana-megah">
                        <p style="font-size:14px;"><b style="color: green;"> &nbsp;&nbsp;PT. Buana Megah</b><br>
                        <b> &nbsp;&nbsp;Head Office : </b>Jl. Argopuro 42, Surabaya 60251, East Java, Indonesia<br>&nbsp;
                        <b>Pasuruan Office : </b>Jalan Raya Cangkringmalang km. 40, Beji Pasuruan 67154 <br>&nbsp;&nbsp;East Java, Indonesia<br>&nbsp;
                        <b>Tel. </b><a href="tel:+62343656288">656288</a>, <a href="tel:+62343656289">656289</a>  Fax. <a href="fax:+62343655054">655054</a><br></p>
                    </td>
                    <td  ><img style="float:right" src="data:image/png;base64,{{DNS2D::getBarcodePNG('https://www.google.com/', "QRCODE", )}}"></td>
                </tr>
            </table>
            <hr>
        </header>
    @endif

{{-- <footer>
    <div id="footer"> <p class="page">Page </p> </div>
</footer> --}}

@foreach($header as $key => $raw)
@if($lg == 1)<div class="margin"></div>@endif
{{-- Footer numbering --}}
@php $count=1; $page=8;@endphp
{{-- <footer>
    <div><p>Page {{$count}} /
        @foreach ($counter as $ctr )
            @if ($raw->id==$ctr->delivery_detail_id)
                <?=
                    $last = ceil($ctr->pgs/$page);
                ?>
            @endif
        @endforeach
        </p>
    </div>
</footer> --}}
{{-- End Footer numbering --}}

<div class="container ">
    <table>
        <tr >
            <td colspan="7"><h3 style="text-align: center"><b>Packing List</b></h3></td>
        </tr>
        <tr>
            <td colspan="2" style="vertical-align: text-top; !important">
                <h4>Packing List</h4>
            </td>
            <td colspan="2" style="vertical-align: text-top; text-transform:uppercase !important">
                <p>: {{$raw->packing_slip_number}}
                </p>
            </td>
            <td style="width: 100px; vertical-align: text-top; !important">
                <h4>Delivery Date</h4>
            </td>
            <td colspan="2" style="vertical-align: text-top; !important">
                <p>: {{$raw->on_or_about_date}}
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width: 120px; !important">
                <h4>Customer</h4>
            </td>
            <td colspan="2" >
                <p>: {{$raw->customer->party_name}} </p>
            </td>
            <td>
                <h4> Delivery To</h4>
            </td>
            <td  colspan="2" >
                <p>: {{$raw->party_site->address1 ?? ''}} </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <h4 style="text-align: top">Customer PO</h4>
            </td>
            <td colspan="2" >
                <p>: {{$raw->detail->cust_po_number ?? ''}}  </p>
            </td>
            <td>
                <h4> Note  </h4>
            </td>
            <td colspan="3" >
                <p>: {{$raw->attribute2}}</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <h4 style="text-align: top">SO Number</h4>
            </td>
            <td colspan="2" >
                <p>: {{$raw->detail->source_header_number ?? ''}}</p>
            </td>
            <td>
                <h4>Delevery No. </h4>
            </td>
            <td colspan="2" >
                <p>: {{$raw->delivery_name}}</p>
            </td>
        </tr>
    </table>
    <table class="table-content">
        <tbody>
            <tr class="tr">
                <th>#</th>
                <th >Item</th>
                <th >Description</th>
                <th colspan="2">Net Weight</th>
            </tr>
            {{-- @for ($i = 0; $i < 10; $i++) --}}

            @php $roll =0;  $rowspan=0; $weight=0; $number = 0; @endphp
            @foreach ($data as $key =>$r)
                @php $no = 0; $roll_w = 0; @endphp
                @if($r->delivery_detail_id == $raw->delivery_id)
                    @php $number ++; @endphp
                    @foreach ($line as $key => $l)
                        @if ($r->id == $l->line_id)\
                            @php $no++; $rowspan=$r->rollCount(); @endphp
                            <tr>
                                @if ($no == 1)
                                    <td rowspan="{{$rowspan}}" width="auto">{{$number}}</td>
                                    <td rowspan="{{$rowspan}}" width="auto">{{$l->ItemMaster->item_code  ?? ''}} {{$l->attribute1}} GSM {{$l->attribute3}} CM</td>
                                @endif
                                <td >{{$l->container_item_id}}</td>
                                <td align="right">{{number_format($l->attribute_number1,'1','.')}}</td>
                                <td align="left">Kg</td>
                            </tr>
                        @endif
                    @endforeach
                    @php $roll += $r->rollCount(); $weight += $r->rollSum() @endphp
                    {{-- Page Break Setting --}}
                    @foreach ($counter as $ctr )
                        @if ($raw->id==$ctr->delivery_detail_id)
                            {{-- page break boundary --}}
                            @if ($line % $page == 0 && $line < $ctr->pgs)
                                <div class="page_break"></div>
                                @php $count++;@endphp
                                <tr >
                                    <td colspan="8">
                                        <footer>
                                            <div><p>Page {{$count}} / {{$last}}</p></div>
                                        </footer>
                                    </td>
                                </tr>
                                <tr >
                                    <td colspan="7"><h3 style="text-align: center"><b>Packing List</b></h3></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="vertical-align: text-top; !important">
                                        <h4>Packing List</h4>
                                    </td>
                                    <td  style="vertical-align: text-top; !important">
                                        <p>: {{$raw->packing_slip_number}}
                                        </p>
                                    </td>
                                    <td style="width: 100px; vertical-align: text-top; !important">
                                        <h4>Delivery Date</h4>
                                    </td>
                                    <td colspan="3" style="vertical-align: text-top; !important">
                                        <p>: {{$raw->on_or_about_date}}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 120px; !important">
                                        <h4>Customer</h4>
                                    </td>
                                    <td  >
                                        <p>: {{$raw->ship_to_party_id}} </p>
                                    </td>
                                    <td>
                                        <h4> Delivery To</h4>
                                    </td>
                                    <td  colspan="3" >
                                        <p>: {{$raw->sold_to_party_id}} </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h4 style="text-align: top">Customer PO</h4>
                                    </td>
                                    <td >
                                        <p>: {{$raw->detail->cust_po_number}} </p>
                                    </td>
                                    <td>
                                        <h4> Note : </h4>
                                    </td>
                                    <td colspan="3" >
                                        <p>: {{$raw->attribute2}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h4 style="text-align: top">SO Number</h4>
                                    </td>
                                    <td colspan="" >
                                        <p>: {{$raw->detail->source_header_number}}</p>
                                    </td>
                                    <td>
                                        <h4>Delivery No.</h4>
                                    </td>
                                    <td colspan="3" >
                                        <p>: {{$raw->delivery_name}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th colspan="">Item</th>
                                    <th >Description</th>
                                    <th >Qty</th>
                                    <th>GSM</th>
                                    <th >Net Weight</th>
                                    <th >Length (M)</th>
                                    <th>Width (M) </th>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                @endif
            @endforeach
       </tbody>
       <tfoot >
        <tr class="tr">
            {{-- <td colspan="4"  align="right"> </td> --}}
            <td colspan="2" align="center"><strong>Total</strong></td>
            <td align="center">{{$roll}} Roll</td>
            <td align="right">{{number_format($weight,'1','.')}} </td>
            <td align="left">Kg </td>
        </tr>
    </tfoot>
    </table>

    <table class="table-footer">
        <tr >
            <td >Prepared By,</td>
            <td >WH Manager</td>
            <td >PPIC</td>
            <td >Receive By,</td>
        </tr>
        <tr><td style="height: 50px"></td></tr>
        <tr >
            <td > __________________  </td>
            <td > __________________  </td>
            <td > __________________  </td>
            <td > Customer </td>
        </tr>
    </table>
 </div>
{{-- </page> --}}

@if ($loop->last)
    <div style="page-break-before: avoid"></div>
@else
    <div class="page_break"></div>
@endif
@endforeach
</body>
</html>

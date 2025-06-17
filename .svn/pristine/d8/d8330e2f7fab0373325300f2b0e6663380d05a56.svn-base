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
            top: 0.5cm;
            left: 20px;
            right: 20px;
            height: 3cm;
        }

        /** Define the footer rules **/
        footer {
            position: relative;
            top: 25cm;
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

        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: #333;
            text-align: left;
            font-size: 12;
            /* margin-top: 2.8cm; */
            margin-left: 20px;
            margin-right: 20px;
            font-size: 11px;
        }

        .margin {
            margin-top: 1.5cm;
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
            padding: 5px;
            width: auto;
        }

        th {
            /* background-color: #E5E4E2; */
            font-size: 11px;
            /* width: 98%; */
            margin: 5px;
            text-align: center;
            border-top: 1px solid #000000;
            border-bottom: 1px solid #000000;
        }

        b,
        p {
            margin: 0px;
            font-size: 12px;
        }

        td {
            padding: 2px;
            font-size: 12px;
            /* vertical-align: text-top; */
            width: auto;
        }

        .table-footer {
            margin-top: 5% !important;
            text-align: center;
            font-size: 14px;
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

    </style>
</head>

<body>

    <header>
        @if($lg == 1)
        <table>
            <tr style="height:90px">
                <td style="width: 100%;">
                    <img style="width: 11%; float:left" src="app-assets/images/logo/favicon.png" alt="buana-megah">
                    <p style="font-size:14px;"><b style="color: green;"> &nbsp;&nbsp;PT. Buana Megah</b><br>
                        <b> &nbsp;&nbsp;Head Office : </b>Jl. Argopuro 42, Surabaya 60251, East Java, Indonesia<br>&nbsp;
                        <b>Pasuruan Office : </b>Jalan Raya Cangkringmalang km. 40, Beji Pasuruan 67154 East Java, &nbsp;&nbsp;Indonesia
                        <b>Tel. </b><a href="tel:+62343656288">656288</a>, <a href="tel:+62343656289">656289</a> Fax. <a href="fax:+62343655054">655054</a><br></p>
                </td>
                <td><img style="float:right" src="data:image/png;base64,{{DNS2D::getBarcodePNG("http://192.168.1.210:8080/", "QRCODE", 2.5,2.5)}}"></td>
            </tr>
        </table>
        <hr>
        @endif
    </header>


    @foreach($header as $key => $raw)
    {{-- Footer numbering --}}
    @if($lg == 1)<div class="margin"></div>@endif
    @php $count=1; $page=5;@endphp
    <footer>
        <div>
            <p>Page {{$count}} /
                @foreach ($counter as $ctr )
                @if ($raw->id==$ctr->header_id)
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
        <table>
            <tr>
                <td colspan="5">
                    <h2 style="text-align: center"><b>Purchase Requisition</b> </h2>
                </td>
            </tr>
            <tr>
                <td align="center"><b>Number</b> <p> {{ $raw->segment1 ?? '' }}</p></td>
                <td align="center"><b>Cost Center</b><p>{{$raw->attribute1}} ({{$raw->CcBook->cc_name}})</p></td>
                <td align="center"><b>Requested By</b><p> {{$raw->user->name?? ''}}</p></td>
                <td align="center"><b>Created Date</b><p> {{$raw->transaction_date}}</p></td>
                <td align="center"><b>Status</b><p> @if($raw->authorized_status == 2)
                    Approve
                    @else
                    Request Approval
                    @endif
                    </p>
                </td>
            </tr>
        </table>
        <table>
            <tbody>
                @php $subtotal=0; @endphp
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>UOM</th>
                    <th>Qty</th>
                    <th>Estimated Cost</th>
                </tr>

                {{-- Looping data --}}
                @php $line = 0; @endphp
                @foreach($data as $key => $row)
                @if ($row->header_id==$raw->id)
                    @php $line ++;@endphp
                    <tr>
                        <td style="padding:5px;" align="center">{{ $row->line_id ?? '' }}</td>
                        <td>{{ $row->ItemMaster->item_code}} - {{ $row->attribute1}} </td>
                        <td  align="center">{{ $row->pr_uom_code}}</td>
                        <td  align="right">{{ $row->quantity}}</td>
                        <td  align="right">{{ $row->estimated_cost}}</td>
                    </tr>
                    {{-- Page Break Setting --}}
                    @foreach ($counter as $ctr )
                        @if ($raw->id==$ctr->header_id)
                        {{-- page break boundary --}}
                            @if ($line % $page == 0 && $line < $ctr->pgs)

                            {{-- Count page number --}}
                            @php $count++;@endphp
                            <div class="page_break"></div>
                                @if($lg == 1)<div class="margin"></div>@endif

                                {{-- Looping Header data --}}
                                <tr>
                                    <td colspan="5">
                                        <footer>
                                            <div>
                                                <p>Page {{$count}} / {{$last}}</p>
                                            </div>
                                        </footer>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <h3 style="text-align: center"><b>Purchase Requisition</b> </h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:5px;" align="center">{{ $row->line_id ?? '' }}</td>
                                    <td>{{ $row->ItemMaster->item_code}} - {{ $row->attribute1}} </td>
                                    <td  align="center">{{ $row->pr_uom_code}}</td>
                                    <td  align="right">{{ $row->quantity}}</td>
                                    <td  align="right">{{ $row->estimated_cost}}</td>
                                </tr>
                                <tr>
                                    <td colspan="5"><br></td>
                                </tr>
                                {{-- Looping Table Head --}}
                                <tr>
                                    <th>#</th>
                                    <th>Item</th>
                                    <th>UOM</th>
                                    <th>Qty</th>
                                    <th>Estimated Cost</th>
                                </tr>
                                @endif
                            @endif
                        @endforeach

                    @endif
                @endforeach
            </tbody> --}}
        </table>

        {{-- Aproval Colomn --}}
        <table class="table-footer">
            <tr>
                <td>Created By</td>
                <td>Approved By</td>
                <td>W/H Manager</td>
                <td>Purchasing Manager</td>
            </tr>
            <tr>
                <td style="height: 20px"></td>
            </tr>
            <tr>
                <td> {{$raw->createdby->name}} </td>
                <td> @if($raw->app_lvl==0)
                    #NA
                    @else
                    {{$raw->createdby->userManager->name ?? '#NA'}}
                    @endif </td>
                <td> {{$raw->appwh->name ?? '#NA'}} </td>
                <td> @if ($raw->authorized_status==2)
                    Purchasing Manager
                    @else
                    #NA
                    @endif
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="height: 50px;">Note : <br>
                    @foreach($comment as $key => $cmn)
                        {{ $cmn->userID ?? ''}} - {{ $cmn->comments ?? ''}}<br>
                    @endforeach
                </td>
            </tr>
            <tr><td>Generated from eWorkflow Online Workspace application system</td></tr>
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

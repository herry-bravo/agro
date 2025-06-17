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

        @media print {
            .header-navbar {
                display: none;
            }

            .breadcrumb-wrapper {
                display: none;
            }

            footer {
                display: none;
            }

            .btn-icon {
                display: none;
            }

            #buttonscroll {
                display: none;
                visibility: hidden;
            }

            .nav {
                display: None;
            }

            .page-break {
                display: block;
                page-break-after: always;
            }

            .page {
                margin: 0;
                box-shadow: 0;
            }


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
            position: relative;
            top: 26cm;
            bottom: 0cm;
            left: 0cm;
            right: 1cm;
            height: 1cm;
            text-align: right;
            margin-right: 20px;
        }


        .container {
            /* to centre page on screen*/
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: #000000;
            text-align: left;
            font-size: 12;
            margin: 5px;
            padding: 3px;
            /* margin-right: 20px; */
            font-size: 11px;
            border: solid 1px;
        }

        table {
            padding-left: 0;
            /* padding: 50px; */
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
            border: 1px;
        }

        tr,
        th {
            /* padding-right:3px; */
            /* padding: 10px; */
            width: auto;
        }

        th {
            /* background-color: #E5E4E2; */
            font-size: 12px;
            margin: 10px;
            padding: 2px;
            text-align: center;
            border-top: 1px solid #1d1d1d33;
            border-bottom: 1px solid #1d1d1d33;
        }

        h4,
        p {
            margin: 1px;
            font-size: 12px;
        }

        td {
            padding: 2px;
            font-size: 11px;
            /* vertical-align: text-top; */
            width: auto;
        }

        .table-footer {
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
            width: 98%;
            margin-top: 0px !important;
        }

        .table-content {
            padding: 50px !important;
        }


    </style>
</head>
<body>
    @foreach ($header as $key => $header)
    @php
        $code = $header->planning->item_code.' '.$header->planning->attribute_number_gsm.' GSM '.$header->planning->attribute_number_w.' CM';
    @endphp
    <div class="container">
        <table>
            <tr>
                <td style="width: 50%"><img style="float:left;" src="data:image/png;base64,{{DNS1D::getBarcodePNG($header->work_order_number, 'C128',1,20)}}" alt="barcode" ></td>
                <td style="width: 40%"><img style="float:left;" src="data:image/png;base64,{{DNS1D::getBarcodePNG($code, 'C128',1,20)}}" alt="barcode"></td>
                <td style="width: 10%"><img style="width: 40%; float:left" src="app-assets/images/logo/favicon.png" alt="buana-megah"></td>
            </tr>
        </table>
        <br>
        <table >
            <tr>
                <td style="width: 50%; text-align:left;">{{ $header->work_order_number}} </td>
                <td style="width: 45%; text-align:left;">{{$code}}</td>
                <td><b style="color: red; text-align:right;  background: #FFDF00;"> {{ $header->planning->operation_unit }}</b></td>
            </tr>
        </table>
        <table >
            <tr>
                <td colspan="2">
                    Comp. Subinventory :
                </td>
                <td>{{$header->compl_subinventory_code}} </td>
                <td >Shift :</td>
                <td>________</td>
                <td ></td>
                <td  style="width: 40%;  border: 1px solid black; vertical-align: top; text-align: left; padding:5px;" rowspan="3"> Keterangan : <br> {{ $header->planning->cust_prod->party_name ?? '' }}</td>
            </tr>
            <tr>
                <td>
                    Start Date :
                </td>
                <td>{{$header->need_by_date->format ('Y-m-d')}}</td>
            </tr>
            <tr>
                <td>
                    Supply To :
                </td>
                <td>________</td>
                <td >Planned Qty :</td>
                <td>{{$header->planned_start_quantity}}</td>
                <td >Actual Qty :</td>
                <td >{{$header->completed_quantity}} </td>

            </tr>
        </table>
        <br>
        <h4><b>Component Item :</b></h4>
        <hr>
        <table >
            <tbody>
                @php $subtotal=0; @endphp
                <tr>
                    <th >#</th>
                    <th>Item</th>
                    <th>Description</th>
                    <th>UOM</th>
                    <th>Qty Per</th>
                    <th>Qty</th>
                    <th>Onhand</th>
                    <th>Fix Location</th>
                    <th>Issue</th>
                </tr>

                {{-- Looping data --}}
                @php $line = 0; @endphp
                @foreach($data as $key => $row)
                    @if ($row->work_order_id==$header->work_order_id)
                    {{-- @php $line ++;@endphp --}}
                    <tr>
                        <td >{{$key+1}}</td>
                        <td>{{$row->item_list->item_code ?? ''}}</td>
                        <td> {{$row->item_list->description ?? ''}}</td>
                        <td align="center"> {{$row->uom_code}}</td>
                        <td align="center">{{$row->quantity_per_product}}</td>
                        <td align="center">{{number_format($row->quantity)}}</td>
                        <td align="center"></td>
                        <td align="center">{{$row->supply_subinventory}}</td>
                        <td align="center"></td>
                    </tr>
                    {{-- Count total --}}
                    {{-- @php $subtotal+=($row->unit_price * $row->po_quantity);@endphp --}}

                    @endif
                @endforeach
            </tbody>
        </table>

        <table>
            <tr>
                <td style="text-align:left;"><h4><b>Finish Good Result :  </b><b style="color: red; background: #FFDF00;">Trim Popreel PM &nbsp; &nbsp; &nbsp; {{$header->planning->attribute_number_w + 5}} CM</b></h4></td>
                <td style="text-align:right;"><b style="color: red">TRIM &nbsp; &nbsp; &nbsp; {{$header->planning->attribute_number_w}} CM</b></td>
            </tr>
        </table>
        <hr>
        <table >
            <tbody>
                @php $subtotal=0; @endphp
                <tr>
                    <th >#</th>
                    <th>Item</th>
                    <th>Detail</th>
                    <th>Qty / Roll</th>
                    <th>Roll</th>
                    <th>Qty </th>
                </tr>

                {{-- Looping data --}}
                @php $line = 0; $roll =0; $qty=0;@endphp
                @foreach($planDet as $key => $row)
                    @if ($row->header_id==$header->source_header_ref)
                        <tr>
                            <td >{{$key+1}}</td>
                            <td>{{$row->item_description}}</td>
                            <td> {{$row->attribute_gsm_line}} GSM {{$row->attribute_w_line}} CM</td>
                            <td align="center"> {{number_format($row->qty_estimation)}}</td>
                            <td align="center">{{$row->total_roll_by_line}}</td>
                            <td align="center">{{number_format($row->total_qty)}}</td>
                        </tr>
                        @php $roll += $row->total_roll_by_line; $qty += $row->total_qty; @endphp
                    @endif
                @endforeach
            </tbody>
            <tfoot>
                <th colspan="4"> Total :</th>
                <th> {{ number_format($roll) }}</th>
                <th> {{ number_format($qty) }}</th>
            </tfoot>
        </table>

        <table class="table-footer">
            <tr>
                <td>Created By,</td>
                <td>Checked By,</td>
                <td>Approved By,</td>
            </tr>
            <tr>
                <td style="height: 50px"></td>
            </tr>
            <tr>
                <td> Staff PPIC </td>
                <td> Kepala PPIC </td>
                <td> Kepala  </td>
            </tr>
        </table>

        <table>
            <tr>
                <td style="height: 30px;"><b>Note : </b><br>{{$header->notes}}</td>
            </tr>
        </table>

    </div>
    <br>
    {{-- Ignore Page Break in Last Loop --}}
    @if ($loop->last)
        <div style="page-break-before: avoid"> </div>
    @elseif($loop->iteration  % 2 == 0)
        <div class="page_break"></div>
    @endif

    {{-- @endforeach --}}
    @endforeach
</body>
</html>


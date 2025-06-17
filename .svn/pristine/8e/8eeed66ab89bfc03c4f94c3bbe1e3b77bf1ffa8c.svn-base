@extends('layouts.admin')
@section('styles')
<style>
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

        @page {
            size: 20cm 14.7cm;
            margin: 1mm 1mm 1mm 1mm;
            /* change the margins as you want them to be. */
        }
    }

    .body-row {

        width: 800px;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
        font-size: 11px;
    }

    .table-cont {
        font-family: "Calibri", Courier, monospace;
        font-size: 11px;
        width: 100%;
        border-collapse: collapse;
    }

    .footer .page-number:after {
        content: counter(page);
    }

    page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.1cm rgba(0, 0, 0, 0.2);
    }

    page[size="A5"] {
        width: 25cm;
        height: 14.8cm;
    }

    td {
        padding: 1rem;
    }

</style>
@endsection
@push('script')
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@endpush
@section('breadcrumbs')
<a href="{{route('admin.std-reports.index')}}" class="breadcrumbs__item">Purchase Report</a>

<a href="#" class="breadcrumbs__item">GRN Report</a>

@endsection
@section('content')
<ul class="nav navbar-nav align-items-end ms-auto">
    <li class="nav-item dropdown dropdown-user nav-item has">
        <button type="button" class="btn btn-primary btn-icon" id="dropdown-user" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="feather-16" data-feather="settings"> </i>
        </button>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
            <a class="dropdown-item" href="javascript:if(window.print)window.print()"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer font-small-4 me-50">
                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                        <rect x="6" y="14" width="12" height="8"></rect>
                    </svg>Print</span></a>
            <a class="dropdown-item" href="{{ route('admin.grn.pdf', [$from,$to]) }}" data-toggle="modal" target="_blank"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard font-small-4 me-50">
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                        <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                    </svg>Export To Pdf</span></a>
            <a class="dropdown-item" href="#demoModal" data-bs-toggle="modal"> <i class="me-50 feather-16" data-feather="sliders"> </i> More Filter</a>
        </div>
    </li>
</ul>
@foreach($header as $key => $raw)
<section id="multiple-column-form" class='page-break'>
    <page size="A5">
        <div class="row body-row">
            <table>
                <tr>
                    <td><br>
                        <img style="width: 9%; float:left;" src="{{ asset('app-assets/images/logo/favicon.png') }}" alt="buana-megah">
                        <p style="font-size:12px;"><b style="color: green;"> &nbsp;&nbsp;PT. Buana Megah</b><br>
                            <b>&nbsp;&nbsp;Head Office : </b>Jl. Argopuro 42, Surabaya 60251, East Java, Indonesia<br>&nbsp;
                            <b>Pasuruan Office : </b>Jalan Raya Cangkringmalang km. 40, Beji Pasuruan 67154 East Java, Indonesia<br>&nbsp;
                            <b>Tel. </b><a href="tel:+62343656288">656288</a>, <a href="tel:+62343656289">656289</a> Fax. <a href="fax:+62343655054">655054</a><br></p>
                    </td>
                </tr>
                <tr>
            </table>
            <hr style="color: green;    margin-left: 3%;    margin-right: 5%;">
            <div class="d-flex justify-content-center ">
                <h4><strong></br>Good Receipt Note - {{$raw->transaction_type}}</br></strong></h4>
            </div>
            <table class="table table-borderless " style="line-height: 0.1;margin-top: .2%;">
                <tbody>
                    <tr>
                        <td style=" padding:1rem;width: 20%;" scope="row">Supplier</td>
                        <td style="padding:1rem; width: 35%;">: ({{ $raw->vendor_id ?? '' }}) {{ $raw->vendor->vendor_name ?? ''}}</td>
                        <td style=" padding:1rem;width:13%;" scope="row">GRN</td>
                        <td style="padding:1rem;">: {{ $raw->receipt_num ?? '' }} / {{ date('d-M-Y', strtotime($raw->gl_date ?? '')) }}</td>
                    </tr>
                    <tr>
                        <td style="padding:1rem;width: 15%;" scope="row">Receipt BY</td>
                        <td style="padding:1rem;width: 35%;">: {{ $raw->User->name ?? ''}}</td>
                        <td style="padding:1rem;width:20%;" scope="row">Packing Slip</td>
                        <td style="padding:1rem;">: {{ $raw->packing_slip ?? ''}}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-cont" mt-2>
                <thead>
                    <tr>
                        <th class="center">#</th>
                        <th class="center">Order No</th>
                        <th>Item</th>
                        <th>Description</th>
                        <th class="text-center">UOM</th>
                        <th class="text-center">Receipt Qty</th>
                        <th class="text-center">Decrese</th>
                    </tr>
                </thead>
                <tbody>
                    @php $subtotal=0; @endphp
                    @foreach($data as $key => $row)
                    @if ($row->shipment_header_id==$raw->shipment_header_id)
                    <tr>
                        <td class="center">{{ $row->id ?? ''}}</td>
                        <td class="center">{{ $row->purchaseorder->segment1 ?? ''}} / {{$row->purchaseorderdet->attribute1}} </td>
                        <td class="left strong">{{ $row->itemMaster->item_code ?? ''}}</td>
                        <td class="left">{{ $row->item_description ?? ''}}</td>
                        <td class="text-center">{{ $row->uom_code ?? ''}}</td>
                        <td class="text-end">{{ number_format(($row->quantity_accepted ?? $row->quantity_received),1,'.')}}/ {{ $row->quantity_received ?? $row->quantity_returned}}</td>
                        <td class="text-end">{{ number_format($row->quantity_received - $row->quantity_accepted),1,'.'}}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            <br>

            <table class="table-footer mt-4">
                <tr>
                    <th class="text-center">Received By,</th>
                    <th class="text-center">Checked By,</th>
                    <th class="text-center">Approved By,</th>
                    <th class="text-center">Approved By,</th>
                </tr>
                <tr>
                    <td style="height: 50px"></td>
                </tr>
                <tr>
                    <td class="text-center">_____________________</td>
                    <td class="text-center">_____________________</td>
                    <td class="text-center">_____________________</td>
                    <td class="text-center">_____________________</td>
                </tr>
            </table>

        </div>
    </page>
    @include('admin.stdReports.grnFilter')
</section>
@endforeach
<!-- /.content -->
@endsection

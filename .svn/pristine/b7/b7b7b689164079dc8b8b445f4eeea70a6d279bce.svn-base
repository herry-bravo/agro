@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="./">Purchase Order</a>
</li>
<li class="breadcrumb-item"><a href="#">Purchase Order</a>
</li>
@endsection
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <hr>
                <div class="container">
                    <div class="card">
                        <!--<div class="d-flex justify-content-start">PT. BUANA MEGAH</div> -->
                        <div class="d-flex justify-content-center ">
                            <h4><strong>Purchase Order</strong></h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4 d-flex justify-content-between">
                                <div class="col-lg-4 col-sm-6">
                                </div>
                                <div class="col-lg-4 col-sm-6 ml-auto">
                                </div>
                                <table class="table table-borderless" style="line-height: 0.1;margin-top: .2%;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 15%;" scope="row">Supplier</td>
                                            <td style="width: 35%;">: ({{ $purchaseorder->vendor_id ?? '' }}) {{ $purchaseorder->vendor->vendor_name}}</td>
                                            <td style="width:13%;" scope="row">Delivery To</td>
                                            <td>: ({{ $purchaseorder->ship_to_location ?? '' }}) {{ $purchaseorder->Site->address1}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 15%;" scope="row"></td>
                                            <td style="width: 35%;"> &nbsp {{ $purchaseorder->vendor->address2}} {{ $purchaseorder->vendor->city}}, {{ $purchaseorder->vendor->province}} {{ $purchaseorder->vendor->phone}}</td>
                                            <td style="width:13%;" scope="row"></td>
                                            <td> &nbsp {{ $purchaseorder->Site->address2}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 15%;" scope="row"></td>
                                            <td style="width: 35%;"> &nbsp {{ $purchaseorder->vendor->address1}}</td>
                                            <td style="width:13%;" scope="row"></td>
                                            <td> &nbsp {{ $purchaseorder->Site->address3}}
                                                {{ $purchaseorder->Site->city}}, {{ $purchaseorder->Site->province}} {{ $purchaseorder->Site->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 15%;" scope="row">Payment Term</td>
                                            <td style="width: 35%;">: {{ $purchaseorder->term_id ?? ''}}</td>
                                            <td style="width:13%;" scope="row">Purchase Number</td>
                                            <td>: {{ $purchaseorder->segment1 ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 15%;" scope="row">Freight</td>
                                            <td style="width: 35%;">: {{ $purchaseorder->freight ?? ''}}</td>
                                            <td style="width:13%;" scope="row">Purchase Date</td>
                                            <td>: {{ $purchaseorder->created_at->isoFormat('D-MM-Y') ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 15%;" scope="row">Carrier</td>
                                            <td style="width: 35%;">: {{ $purchaseorder->carrier ?? ''}}</td>
                                            <td style="width:13%;" scope="row">Notes</td>
                                            <td>: {{ $purchaseorder->description}} {{ $purchaseorder->notes}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive-sm">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>Item</th>
                                            <th>Description</th>

                                            <th class="right">Unit Cost</th>
                                            <th class="center">Qty</th>
                                            <th class="right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $subtotal=0; @endphp
                                        @foreach($purchaseorderdet as $key => $order)
                                        <tr>
                                            <td class="center">{{ $order->line_id ?? ''}}</td>
                                            <td class="left strong">{{ $order->itemMaster->item_code ?? ''}}</td>
                                            <td class="left">{{ $order->item_description ?? ''}}</td>

                                            <td class="text-end"> {{ number_format($order->unit_price, 2, ',', '.') }}</td>
                                            <td class="text-end">{{ $order->po_quantity ?? ''}}</td>
                                            <td class="text-end">{{ number_format($order->unit_price * $order->po_quantity, 2, ',', '.') }}</td>
                                        </tr>
                                        @php $subtotal+=($order->unit_price * $order->po_quantity); @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </br>
                            <div class="row d-flex justify-content-between">
                                <div class="col-lg-4 col-sm-5">

                                </div>

                                <div class="col-lg-4 col-sm-5 ml-auto">
                                    <table class="table table-clear">
                                        <tbody>
                                            <tr>
                                                <td class="left">
                                                    <strong>Subtotal</strong>
                                                </td>
                                                <td class="text-end"> {{$purchaseorder->currency_code}} {{ number_format($subtotal, 2, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="left">
                                                    <strong>Discount (%)</strong>
                                                </td>
                                                <td class="text-end">0</td>
                                            </tr>
                                            <tr>
                                                <td class="left">
                                                    <strong>VAT (10%)</strong>
                                                </td>
                                                <td class="text-end">{{$purchaseorder->currency_code}} {{ number_format(($subtotal*$order->tax_name/100), 2, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="left">
                                                    <strong>Total</strong>
                                                </td>
                                                <td class="text-end">
                                                    <strong>{{$purchaseorder->currency_code}} {{ number_format($subtotal+($subtotal*$order->tax_name/100), 2, ',', '.') }}</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</section>
<!-- /.content -->
@endsection

@extends('layouts.admin')
@section('styles')
@section('content')
@section('breadcrumbs')
<a href="#"class="breadcrumbs__item">Order Management</a>
<a href="#"class="breadcrumbs__item">Sales Order</a>
@endsection
@section('content')
<div class="d-print-none mb-3 px-2 d-flex gap-2">
    <a href="{{ route('admin.salesorder.index') }}" class="btn btn-sm btn-secondary">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
    @if($sales->open_flag != 12)
    <a href="{{ route('admin.salesorder.konfirmasi-kirim', $sales->id) }}" class="btn btn-sm btn-success">
        <i class="fa fa-truck"></i> Send
    </a>
    @else
    <a href="{{ route('admin.salesorder.surat-jalan', $sales->id) }}" class="btn btn-sm btn-info">
        <i class="fa fa-print"></i> Cetak Surat Jalan
    </a>
    @endif
    <button onclick="window.print()" class="btn btn-sm btn-outline-secondary">
        <i class="fa fa-print"></i> Print SO
    </button>
</div>
{{-- @foreach($purchaseRequisition as $key => $raw) --}}
<page size="A5">
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <table>
                        <tr>
                            <td><br>
                                <img style="width: 6%; float:left; margin-left:4%;" src="{{ asset('app-assets/images/logo/suryaagro.png') }}" alt="surya-agro">
                                <p style="font-size:12px; padding-left:110px; line-height:1.6;">
                                    <b style="color: green;">SURYA-AGRO</b><br>
                                    <b>Head Office : </b>Jl. Peterongan-Sumobito, RT.6/RW.1, Klampisan, Segodorejo,<br>
                                    Kec. Sumobito, Kabupaten Jombang, Jawa Timur 61483<br>
                                    <b>Tel. </b><a href="tel:+6281615824494" style="color:inherit;text-decoration:none;">0816-1582-4494</a>, <a href="tel:+6285100256990" style="color:inherit;text-decoration:none;">0851-0025-6990</a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                    </table>
                    <hr style="color: green;    margin-left: 5%;    margin-right: 5%;">
                    <div class="d-flex justify-content-center ">
                        <h4><strong><br>Sales Order <br><br></strong></h4>
                    </div>

                    <div class="card-body">
                        <div class="container-fluid mt-100 mb-100">
                            <div id="ui-view">
                                <div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-sm-2">
                                                    <h6 class="mb-2">Salses Number</h6>
                                                    <h6 class="mb-2">Bill To</h6>
                                                    <h6 class="mb-2" style="display:none;">Customer PO</h6>
                                                </div>
                                                <div class="col-sm-3">
                                                    <p class="mb-2">: {{$sales->order_number}}</p>
                                                    <p class="mb-2">: {{optional($sales->customer)->party_name ?? 'Walk-in Customer'}}</p>
                                                    <p class="mb-2" style="display:none;">: {{$sales->cust_po_number}}</p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <h6 class="mb-2">Date</h6>
                                                    <h6 class="mb-2">Delivery To</h6>
                                                    <h6 class="mb-2">Term</h6>
                                                </div>
                                                <div class="col-sm-3">
                                                    <p class="mb-2">: {{$sales->ordered_date}}</p>
                                                    <p class="mb-2">: {{$sales->party_site->id ?? ''}}</p>
                                                    <p class="mb-2">: {{is_numeric($sales->attribute3) ? (optional($sales->term)->terms_name ?? '-') : '-'}}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="table-responsive-sm mb-4">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">#</th>
                                                            <th>Item</th>
                                                            <th>Description</th>
                                                            <th class="right">Unit Cost</th>
                                                            <th class="center">Quantity</th>
                                                            <th class="right">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $subtotal=0; $taxAmount = 0;@endphp
                                                        @foreach($detail as $key => $row)
                                                            <tr>
                                                                <td class="center">{{ $key+1}} </td>
                                                                <td>{{ $row->ItemMaster->item_code}} </td>
                                                                <td >{{ $row->user_description_item}}</td>
                                                                <td class="text-left">{{ $row->unit_selling_price}}</td>
                                                                <td class="text-right">{{ $row->ordered_quantity}}</td>
                                                                <td align="right">{{  number_format($row->unit_selling_price * $row->ordered_quantity, 2, ',', '.')}}</td>
                                                            </tr>

                                                            @php
                                                                $subtotal += $row->unit_selling_price * $row->ordered_quantity;
                                                                $taxAmount += ($row->tax_code / 100) * ($row->unit_selling_price * $row->ordered_quantity)
                                                            @endphp
                                                        @endforeach

                                                    </tbody>

                                                </table>
                                            </div>
                                            <br>
                                            <div class="row ">
                                                <div class="col-lg-9 col-sm-5"></div>
                                                <div class="col-lg-3 col-sm-5 ml-auto">
                                                    <table class="table table-clear">
                                                        <tbody>
                                                            <tr>
                                                                <td class="left">

                                                                </td>
                                                                <td class="text-end">

                                                                </td>
                                                                <td class="text-end"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="left">

                                                                    <strong>Sub Total</strong>
                                                                </td>
                                                                <td class="text-end">

                                                                </td>
                                                                <td class="text-end">
                                                                    <strong>{{ number_format($subtotal, 2, ',', '.') }}</strong>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="left">

                                                                    <strong> Tax</strong>
                                                                </td>
                                                                <td class="text-end">
                                                                    {{-- {{$detail->tax_code}} --}}
                                                                </td>
                                                                <td class="text-end">
                                                                    <strong>{{ number_format($taxAmount, 2, ',', '.') }}</strong>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="left">

                                                                    <strong> Total</strong>
                                                                </td>
                                                                <td class="text-end">

                                                                </td>
                                                                <td class="text-end">
                                                                    <strong>{{ number_format($subtotal, 2, ',', '.') }}</strong>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    {{-- @endforeach --}}
    <!-- /.content -->
    @endsection

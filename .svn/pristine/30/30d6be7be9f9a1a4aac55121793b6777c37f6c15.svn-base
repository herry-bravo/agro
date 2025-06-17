@extends('layouts.admin')
@section('styles')
@section('content')
@section('breadcrumbs')
<a href="#"class="breadcrumbs__item">Order Management</a>
<a href="#"class="breadcrumbs__item">Sales Order</a>
@endsection
@section('content')
{{-- @foreach($purchaseRequisition as $key => $raw) --}}
<page size="A5">
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <table>
                        <tr>
                            <td><br>
                                <img style="width: 5%; float:left;margin-left:4%;" src="{{ asset('app-assets/images/logo/favicon.png') }}" alt="buana-megah">
                                <p style="font-size:12px;"><b style="color: green;"> &nbsp;&nbsp;PT. Buana Megah</b><br>
                                    <b>&nbsp;&nbsp;Head Office : </b>Jl. Argopuro 42, Surabaya 60251, East Java, Indonesia<br>&nbsp;
                                    <b>Pasuruan Office : </b>Jalan Raya Cangkringmalang km. 40, Beji Pasuruan 67154 East Java, Indonesia<br>&nbsp;
                                    <b>Tel. </b><a href="tel:+62343656288">656288</a>, <a href="tel:+62343656289">656289</a> Fax. <a href="fax:+62343655054">655054</a><br></p>
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
                                                    <h6 class="mb-2">Customer PO</h6>
                                                </div>
                                                <div class="col-sm-3">
                                                    <p class="mb-2">: {{$sales->order_number}}</p>
                                                    <p class="mb-2">: {{$sales->customer->party_name}}</p>
                                                    <p class="mb-2">: {{$sales->cust_po_number}}</p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <h6 class="mb-2">Date</h6>
                                                    <h6 class="mb-2">Delivery To</h6>
                                                    <h6 class="mb-2">Term</h6>
                                                </div>
                                                <div class="col-sm-3">
                                                    <p class="mb-2">: {{$sales->ordered_date}}</p>
                                                    <p class="mb-2">: {{$sales->party_site->id ?? ''}}</p>
                                                    <p class="mb-2">: {{$sales->term->terms_name}}</p>
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

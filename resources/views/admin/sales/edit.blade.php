@extends('layouts.admin')
@section('styles')
<style>
    .card-body {
        padding-bottom: 0em;
    }
    .modal-dialog {
    max-width: 600px; /* Adjust the width as per your preference */
    margin: 1.75rem auto; /* Center the modal horizontally */
}
</style>
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
@endpush
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.salesorder.update',[$sales->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">
                        <a href="{{ route("admin.salesorder.index") }}" class="breadcrumbs__item">{{ trans('cruds.OrderManagement.title') }} </a>
                        <a href="{{ route("admin.salesorder.index") }}" class="breadcrumbs__item">{{ trans('cruds.OrderManagement.title_singular') }} </a>
                            <a href="" class="breadcrumbs__item">Edit </a>
                        </h6>
                        <div class="row">
                            <div class="col-lg-12">
                                <a class="btn btn-second" href="{{ route('admin.sales.data_shipment', ['order_number' => $sales->order_number]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-truck me-50 font-small-4">
                                        <rect x="1" y="3" width="15" height="13"></rect>
                                        <polygon points="16 8 20 8 23 11 23 16 16 16"></polygon>
                                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                        <line x1="5.5" y1="21" x2="5.5" y2="21"></line>
                                        <line x1="18.5" y1="21" x2="18.5" y2="21"></line>
                                    </svg>
                                    Delivery Order
                                </a>
                                @if (is_null($sales->inv_number))
                                    <a class="btn btn-primary" href="{{ route('admin.invoices.create', ['header_id' => $sales->header_id]) }}">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-file-text me-50 font-small-4">
                                            <path d="M6 2H18a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z"></path>
                                            <line x1="6" y1="8" x2="18" y2="8"></line>
                                            <line x1="6" y1="12" x2="18" y2="12"></line>
                                            <line x1="6" y1="16" x2="18" y2="16"></line>
                                        </svg></span>
                                        {{ trans('cruds.OrderManagement.invoice') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row  mb-25">
                            <div class="col-md-12">
                                <div class="row  mb-25">
                                    <div class="col-md-4">
                                        <label class="form-label" for="order_number">{{ trans('cruds.order.fields.order_number') }}</label>
                                        <input type="text" id="purpose_date" name="purpose_date" class="form-control" hidden value="{{ now()->format ('Y-m-d') }}">
                                        <input type="number" hidden id="created_by" name="created_by" value="{{ auth()->user()->id }}" class="form-control">
                                        <input type="text" id="order_number" name="order_number" class="form-control" value="{{ $sales->order_number }}" readonly>
                                        <input type="hidden" name="header_id" class="form-control" value="{{ $sales->id }}" readonly>
                                        <input type="hidden" name="headerId" class="form-control" value="{{ $sales->header_id }}" readonly>
                                        <input type="hidden" name="flag" class="form-control" value="{{ $sales->open_flag }}" readonly>
                                        <input type="hidden" name="booked" class="form-control" value="{{ $sales->booked_flag }}" readonly>
                                        <input type="hidden" name="org" class="form-control" value="{{ $sales->org_id }}" readonly>
                                        @if($errors->has('order_number'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('order_number') }}
                                        </em>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="currency">{{ trans('cruds.order.fields.type') }}</label>
                                        <select type="text" id="type" name="type" class="form-control select2" value="{{ old('type', isset($order) ? $order->type : '') }}" required>
                                            @if (($sales->attribute2)== 50)
                                            <option value="50" selected>Local Sales</option>
                                            <!-- <option value="51">Oversea Sales</option>
                                            <option value="60">Return Local Sales</option>
                                            <option value="61">Return Oversea Sales</option> -->
                                            @elseif (($sales->attribute2)== 51)
                                            <!-- <option value="50">Local Sales</option> -->
                                            <option value="51" selected>Oversea Sales</option>
                                            <!-- <option value="60">Return Local Sales</option>
                                            <option value="61">Return Oversea Sales</option> -->
                                            @elseif (($sales->attribute2)== 60)
                                            <!-- <option value="50">Local Sales</option>
                                            <option value="51">Oversea Sales</option> -->
                                            <option value="60" selected>Return Local Sales</option>
                                            <!-- <option value="61">Return Oversea Sales</option> -->
                                            @else
                                            <!-- <option value="50">Local Sales</option>
                                            <option value="51">Oversea Sales</option>
                                            <option value="60">Return Local Sales</option> -->
                                            <option value="61" selected>Return Oversea Sales</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="customer_currency">{{ trans('cruds.order.fields.customer_currency') }}</label>
                                        <select name="customer_currency" id="customer_currency" class="form-control select2" required value="{{$sales->attribute1}}">
                                            <!-- {{-- @foreach($currency as $row)
                                            @if (($row->id)== $sales->attribute1))
                                            <option value="{{$row->currency_code}}" {{old('customer_currency') ? 'selected' : '' }} selected> {{$row->currency_code}} - {{$row->currency_name}} </option>
                                            @else

                                            <option value="{{$row->currency_code}}" {{old('customer_currency') ? 'selected' : '' }}> {{$row->currency_code}} - {{$row->currency_name}} </option>
                                            @endif
                                            @endforeach --}} -->
                                            @foreach($currency as $raw)
                                                @if($sales->attribute1 == $raw->currency_code)
                                                    <option value="{{$raw->currency_code}}" selected>{{$raw->currency_code}} - {{$raw->currency_name}}</option>
                                                @endif
                                            @endforeach

                                        </select>
                                        @if($errors->has('customer_currency'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('customer_currency') }}
                                        </em>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Faktur</label>
                                        <input type="text" id="faktur" name="faktur" class="form-control" value="{{$sales->faktur}}">
                                    </div>
                                </div>

                                <div class="row  mb-25">
                                    <div class="col-md-4">
                                        <label class="form-label" for="bill_to">{{ trans('cruds.order.fields.bill_to') }}</label>
                                        <select name="bill_to" id="customer" class="form-control select2" required>
                                            @foreach($customer as $row)
                                                @if (($row->cust_party_code)== $sales->invoice_to_org_id))
                                                    <option value="{{$sales->invoice_to_org_id}}" {{old('customer_name') ? 'selected' : '' }} selected> {{$sales->customer->party_name}} - {{$sales->customer->address1}}, {{$sales->customer->city}} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('bill_to'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('bill_to') }}
                                        </em>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="sales_order_date">{{ trans('cruds.order.fields.sales_order_date') }}</label>
                                        <input type="text" id="fp-default" name="ordered_date" class="form-control flatpickr-basic flatpickr-input active" value="{{  $sales->ordered_date->format('Y-m-d') }}" autocomplete="off">
                                        @if($errors->has('sales_order_date'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('sales_order_date') }}
                                        </em>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="currency">{{ trans('cruds.order.fields.po_number') }} </label>
                                        <select name="po_number" id="po_number" class="form-control select2" required>
                                            @foreach($price as $row)
                                                @if (($row->id)== $sales->price_list_id))
                                                    <option value="{{$row->id}}" {{old('price_list_name') ? 'selected' : '' }} selected> {{$row->description}} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('po_number'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('po_number') }}
                                        </em>
                                        @endif
                                    </div>
                                </div>

                                <div class="row  mb-25">
                                    <div class="col-md-4">
                                        <label class="form-label" for="ship_to">{{ trans('cruds.order.fields.ship_to') }}</label>
                                        {{-- <input type="number" id="ship_to" name="deliver_to_org_id" class="form-control" value="{{$sales-> deliver_to_org_id}}" required> --}}
                                        <select id="ship_to" name="deliver_to_org_id" class="form-control select2" required>
                                            @foreach($site as $row)
                                                @if (($row->site_code)== $sales->deliver_to_org_id))
                                                    <option value="{{$row->site_code}}" {{old('customer_name') ? 'selected' : '' }} selected> {{$row->address1}}, {{$row->address2}}, {{$row->city}} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('ship_to'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('ship_to') }}
                                        </em>
                                        @endif
                                    </div>
                                    <!-- <div class="col-md-4">
                                        <label class="form-label" for="currency">{{ trans('cruds.order.fields.terms') }}</label>
                                        <select name="freight_terms_code" id="terms" class="form-control select2" required>
                                            @foreach($terms as $row)
                                            @if (($row->id)== $sales->freight_terms_code))
                                            <option value="{{$row->id}}" {{old('terms') ? 'selected' : '' }} selected> {{$row->term_code}} - {{$row->terms_name}} </option>
                                            @else
                                            <option value="{{$row->id}}" {{old('terms') ? 'selected' : '' }}> {{$row->term_code}} - {{$row->terms_name}} </option>
                                            @endif
                                            @endforeach
                                        </select>

                                        @if($errors->has('terms'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('terms') }}
                                        </em>
                                        @endif
                                    </div> -->
                                    <div class="col-md-2">
                                        <label class="form-label" for="terms_start">{{ trans('cruds.order.fields.customer_po') }}</label>
                                        <input readonly type="text" id="terms_start" name="cust_po_number" class="form-control" value="{{ old('cust_po_number', isset($sales) ? $sales->cust_po_number : '') }}" required>
                                        @if($errors->has('terms_start'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('terms_start') }}
                                        </em>
                                        @endif
                                    </div>
                                    @php
                                        $paymentMethodValue = old('attribute3', isset($sales) ? $sales->attribute3 : '');
                                        $paymentMethodLabel = match($paymentMethodValue) {
                                            'cash' => 'Cash',
                                            'credit_30' => 'Credit 30 Hari',
                                            'credit_60' => 'Credit 60 Hari',
                                            'credit_90' => 'Credit 90 Hari',
                                            'credit_120' => 'Credit 120 Hari',
                                            default => '',
                                        };
                                    @endphp

                                    <div class="col-md-2">
                                        <label class="form-label" for="paymentmethod">{{ trans('cruds.order.fields.paymentmethod') }}</label>
                                        <select id="paymentmethod" name="paymentmethod" class="form-control select2" required>
                                            @foreach($terms as $row)
                                                @if (($row->id)== $sales->attribute3))
                                                    <option value="{{$row->id}}" {{old('customer_name') ? 'selected' : '' }}> {{$row->terms_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="terms_start">{{ trans('cruds.order.fields.tax') }}</label>
                                        <select id="ship_to" name="deliver_to_org_id" class="form-control select2" required>
                                            @foreach($tax as $row)
                                                @if (($row->tax_rate)== $sales->tax_exempt_flag))
                                                    <option value="{{$row->tax_rate}}" {{old('customer_name') ? 'selected' : '' }}> {{$row->tax_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Body --}}

                    <div class="card-header">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-sales-tab" data-bs-toggle="tab" data-bs-target="#nav-sales" type="button" role="tab" aria-controls="nav-sales" aria-selected="true">
                                    {{ trans('cruds.OrderManagement.field.sales') }}
                                    <span class="bs-stepper-box">
                                        <i data-feather="shopping-bag" class="font-medium-3"></i>
                                    </span>
                                </button>
                               
                            </div>
                        </nav>

                        <div class="text-right">
                            <!-- <button type="button" class="btn btn btn-outline-success float-right dropdown-toggle " data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ trans('cruds.OrderManagement.field.action') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a id="btnCopyLines" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#copyLine">
                                    {{ trans('cruds.OrderManagement.field.copyline') }}
                                </a>
                                <button id="btnDelete" type="submit" class="btn btn btn-link" name='action' value="multipleDelete">
                                    {{ trans('cruds.OrderManagement.field.multipledelete') }}
                                </button>
                                <a id="btnSplit" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalSplit">
                                    {{ trans('cruds.OrderManagement.field.splitline') }}
                                </a>
                                <div role="separator" class="dropdown-divider"></div>
                            </div> -->
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="tab-content" id="nav-tabContent">
                            {{-- Tab sales --}}
                            <div class="tab-pane fade show active" id="nav-sales" role="tabpanel" aria-labelledby="nav-sales-tab">
                                <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                    <table class="table table-striped tableFixHead" id="tab_logic">
                                        <thead>
                                            <tr>
                                                <th width="auto">
                                                    {{-- <input class="form-check-input" type="checkbox" style="width:1%px;" value="" id="masterckcbx" /> --}}
                                                </th>
                                                <th scope="col" class="text-center">{{ trans('cruds.OrderManagement.field.line') }}</th>
                                                <th scope="col">Product Category</th>
                                                <!-- <th scope="col" class="text-center">Product Detail (GSM L x W)</th>
                                                <th scope="col" class="text-center">Seq</th> -->
                                                <th scope="col" class="text-center">{{ trans('cruds.OrderManagement.field.qty') }}</th>

                                                <th scope="col" class="text-center">{{ trans('cruds.OrderManagement.field.price') }}</th>
                                                <th scope="col" class="text-center">Disc</th>
                                                <th width="auto" scope="col">{{ trans('cruds.OrderManagement.field.shipmentschedule') }}</th>
                                                <th width="auto" scope="col">{{ trans('cruds.OrderManagement.field.up') }}</th>

                                                <th scope="col" class="text-end">{{ trans('cruds.OrderManagement.field.subtotal') }}</th>
                                                <!-- <th scope="col" class="text-center">#</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="sales_order_container">
                                            @php $no = 1; @endphp
                                            @php $subtotal=0; $taxAfter=0; $subtotal2=0; $tax=0; $taxAfter2=0;@endphp
                                            @foreach ($salesDetail as $key => $row)

                                            <tr class="tr_input" data-entry-id="{{ $row->id }}">
                                                <td width="auto" class="text-center">

                                                    <input type="checkbox" name="item_ids[]" id="item_ids" value="{{ $row->id }}" class="form-check-input sub_chk text-center" data-id="{{ $row->id }}">
                                                    <input type="hidden" name="item_code[]" value="{{$row->itemMaster->item_code}}" class="form-check-input sub_chk" data-id="{{$row->itemMaster->item_code}}">
                                                    {{-- <input type="hidden" name="item_description[]" value="{{$row->user_item_description}}"class="form-check-input sub_chk"data-id="{{$row->user_item_description}}"> --}}
                                                    {{-- <input type="hidden" name="header_id[]" value="{{$row->header_id}}"class="form-check-input sub_chk"data-id="{{$row->header_id}}"> --}}
                                                    <input type="hidden" name="item_qty[]" value="{{$row->ordered_quantity}}" class="form-check-input sub_chk" data-id="{{$row->ordered_quantity}}">
                                                    <input type="hidden" name="item_price[]" value="{{$row->unit_selling_price}}" class="form-check-input sub_chk" data-id="{{$row->unit_selling_price}}">
                                                    <input type="hidden" name="order_quantity_uom[]" value="{{$row->order_quantity_uom}}" class="form-check-input sub_chk" data-id="{{$row->order_quantity_uom}}">

                                                    <input type="hidden" name="checkid[]" value="{{ $row->id }}">

                                                </td>
                                                <td class="rownumber text-center" width="3%">{{$no}}</td>
                                                <td width="30%">
                                                    <input type="hidden" class="line_id" value="{{$row->line_id}}" name="line_id[]">
                                                    <input type="hidden" value="{{$row->id}}" name="id_line[]">
                                                    <input type="hidden" value="{{$row->split_line_id}}" name="split_line_id[]">
                                                    <input type="text" readonly class="form-control search_sales" value="{{$row->itemMaster->item_code}} {{$row->user_description_item}}" name="item_sales[]" autocomplete="off">
                                                    <span class="help-block search_item_code_empty glyphicon" style="display: none;"> No Results Found </span>
                                                    <input type="hidden" class="search_inventory_item_id" value='{{$row->inventory_item_id}}' name="inventory_item_id[]" value="">
                                                </td>
                                               
                                                
                                               
                                                <td width="auto">
                                                    @if(($row->flow_status_code) ==5 || ($row->flow_status_code)==6)
                                                    <input type="number" class="form-control recount text-end" readonly value="{{(float)$row->ordered_quantity}}" name="ordered_quantity[]" oninput="validity.valid||(value='');" min=1 >
                                                    @else
                                                    <input type="number" class="form-control recount text-end" readonly value="{{(float)$row->ordered_quantity}}" name="ordered_quantity[]" >
                                                    @endif
                                                </td>

                                                <td width="auto">
                                                    <input type="text" style="text-align: right" readonly  class="form-control harga text-end" value="{{number_format($row->unit_selling_price, 2, ',', '.')}}" name="unit_selling_price[]">
                                                </td>
                                                <td width="auto">
                                                    <input type="text" style="text-align: right" readonly  class="form-control harga text-end" value="{{number_format($row->disc)}}" name="disc[]">
                                                </td>
                                                <td width="auto">
                                                    @if(($row->flow_status_code) ==5 || ($row->flow_status_code)==6)
                                                    <input type="date" readonly value="{{$row->schedule_ship_date->format ('Y-m-d')}}" name="schedule_ship_date[]" class="form-control text-end">
                                                    @else
                                                    <input type="date" class="form-control text-end" readonly value="{{$row->schedule_ship_date->format ('Y-m-d')}}" name="schedule_ship_date[]">
                                                    @endif
                                                </td>

                                                @php $taxAfter = (($row->unit_selling_price * $row->ordered_quantity)*($row->tax->tax_rate ?? 0)); @endphp
                                                <input type="hidden" style="text-align: right" readonly id="pajak_hasil_{{$key+1}}" class="form-control pajak_hasil" value="{{number_format($taxAfter, 2, ',', '.') }}" name="pajak_hasil[]">

                                                @php $subtotal =($row->unit_selling_price * $row->ordered_quantity + $taxAfter); @endphp
                                                <td width="auto">
                                                    <input type="text" readonly class="form-control search_sales" value="{{number_format($row->unit_percent_base_price, 2, ',', '.')}}" name="unitprice[]" autocomplete="off">
                                                </td>
                                                <td width="auto">
                                                    <input type="text" style="text-align: right" readonly id="subtotal1_{{$key+1}}" class="form-control" name="subtotal[]" value="{{ number_format($row->unit_list_price, 2, ',', '.') }}">
                                                    <input type="hidden" style="text-align: right" readonly id="subtotal_{{$key+1}}" class="form-control subtotal123" name="" value="{{ $subtotal}}">
                                                </td>
                                                <!-- <td>
                                                    @if ($row->flow_status_code==12 || $row->flow_status_code==11 )
                                                    <button type="submit" class="btn btn-secondary" disabled style="position: inherit;">X</button>
                                                    @else
                                                    @if($loop->first) <form></form> @endif
                                                    <form type="hidden" action="{{ route('admin.salesOrder-detail.destroy',$row->id) }}" enctype="multipart/form-data" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" class="btn btn-ligth btn-sm" --disabled- style="position: inherit;">X</button>
                                                    </form>
                                                    @endif
                                                </td> -->
                                            </tr>
                                            {{-- @php $subtotal+=($row->unit_price * $row->po_quantity); @endphp --}}
                                            @php
                                            $subtotal2 += $subtotal;
                                            $taxAfter2 = $subtotal2*(1-$sales->tax_exempt_flag/100);
                                            $tax = $subtotal2-$taxAfter2
                                            @endphp
                                            @php $no++; @endphp
                                            @endforeach
                                        </tbody>
                                        <!-- <tfoot>
                                            <tr>
                                                <td colspan="4">
                                                    <button type="button" class="btn btn-light add_sales_order btn-sm" style="font-size: 12px;"><i data-feather='plus'></i> {{ trans('cruds.OrderManagement.field.addrow') }}</button>
                                                </td>
                                            </tr>
                                        </tfoot> -->
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> {{ trans('cruds.OrderManagement.field.level')}}</label>
                                    @if(($row->flow_status_code==5) || ($row->flow_status_code==6) && $row->shipping_interfaced_flag == NULL)
                                    <select class="form-control select2 " id="" name="flow_status_code" required>
                                        @if(($sales->booked_flag)==11)
                                        <option value="14">Open</option>
                                        <option value="1">Book</option>
                                        <option value="12">Close</option>
                                        <option value="11" selected>Cancel</option>
                                        @elseif(($sales->booked_flag)==1)
                                        {{-- <option value="14">Open</option> --}}
                                        <option value="1" selected>Book</option>
                                        <option value="12">Close</option>
                                        <option value="11">Cancel</option>
                                        @elseif(($sales->booked_flag)==12)
                                        <option value="14">Open</option>
                                        <option value="1">Book</option>
                                        <option value="12" selected>Close</option>
                                        <option value="11">Cancel</option>
                                        @else
                                        <option value="14" selected>Open</option>
                                        <option value="1">Book</option>
                                        <option value="12">Close</option>
                                        <option value="11">Cancel</option>
                                        @endif
                                    </select>
                                    @else
                                    <select class="form-control select2 " id="" name="flow_status_code" readonly required>
                                        <option value="{{$sales->booked_flag}}" selected>Book</option>
                                    </select>
                                    @endif
                                    <input type="hidden" class="form-control" name="status_name" value='1' readonly="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group text-end">
                                    <label>{{ trans('cruds.OrderManagement.field.untax')}}</label><br>
                                    <input readonly type="text" class="form-control text-end" id="tax_amount" name="tax_amount" value="{{  number_format($taxAfter2, 2, ',', '.') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group text-end">
                                    <label>{{ trans('cruds.OrderManagement.field.ppn')}}</label><br>
                                    <input readonly type="text" class="form-control text-end" id="ppn" name="ppn" value="{{  number_format($tax, 2, ',', '.') }}">
                                </div>
                            </div>
                            <div class=" col-md-3">
                                <div class="form-group text-end">
                                    <label>{{ trans('cruds.OrderManagement.field.total')}}</label>
                                    <input type="text" class="form-control purchase_total text-end" value="{{ number_format($subtotal2, 2, ',', '.')}}" id="total" readonly="" name="purchase_total">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-1 mb-50">
                            <div></div>
                            <!-- <button type="reset" class="btn btn-warning pull-left">Reset</button> -->
                            <button class="btn btn-primary btn-submit" name='action' value="save" type="submit"><i data-feather='save'></i>
                                {{ trans('global.save') }}</button>
                        </div>
                        <br>
                    </div>
                    <!-- /.box-body -->
                </div>

                <!-- Modal Example Start-->
                <div class="modal fade" id="demoModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLongTitle">Split Line </h4>
                                <div class="modal-header bg-primary">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2 col-12">
                                            <div class="mb-1">
                                                <label class="col-sm-0 control-label" for="number">ID</label>
                                                <input class="form-control" name="req_line_id">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="mb-1">
                                                <label class="col-sm-0 control-label" for="number">Header Id</label>
                                                <input class="form-control" name="header">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="mb-1">
                                                <label class="col-sm-0 control-label" for="number">Line Id</label>
                                                <input class="form-control" name="line">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="mb-1">
                                                <label class="col-sm-0 control-label" for="site">Items</label>
                                                <input class="form-control" name="item">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="mb-1">
                                                <label class="col-sm-0 control-label" for="site">Quantity</label>
                                                <input class="form-control" name="split_quantity">
                                                <input type="hidden" class="form-control" name="id">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-secondary " name='action' value="add_lines" data-dismiss="modal"><i data-feather='plus'></i>{{ trans('global.add') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Modal Example Start-->
                <div class="input-group">
                    {{-- MODAL Copy Line --}}
                    <div class="modal fade" id="copyLine" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header bg-primary">
                                    <h4 class="modal-title text-white">{{ trans('cruds.OrderManagement.field.copyline')}}</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="card box-default overflow-auto">
                                        <div class="card-body" style="height: 350px;">
                                            <br>
                                            {{-- <form action="/search/sreturnselected"> --}}
                                            <table class="table table-striped w-100" id="copyLines" data-toggle="1">
                                                <thead>
                                                    <tr>
                                                        <th>{{ trans('cruds.OrderManagement.field.ordernumber')}}</th>
                                                        <th>{{ trans('cruds.OrderManagement.field.productname')}}</th>
                                                        <th scope="col" class="text-center">Product Detail (GSM L x W)</th>
                                                        <th>{{ trans('cruds.OrderManagement.field.line')}}</th>
                                                        <th>{{ trans('cruds.OrderManagement.field.qty')}}</th>
                                                        <th>{{ trans('cruds.OrderManagement.field.uom')}}</th>
                                                        <th>{{ trans('cruds.OrderManagement.field.pricelist')}}</th>
                                                        <th>{{ trans('cruds.OrderManagement.field.shippinginv')}}</th>
                                                        <th>{{ trans('cruds.OrderManagement.field.shippingschedule')}}</th>
                                                    </tr>
                                                </thead>
                                            </table>

                                            {{-- </form> --}}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div class="form-group row col-sm-5">
                                            <label class="col-sm-2 control-label" for="header_id">{{ trans('cruds.OrderManagement.field.type')}}</label>
                                            <div class="col-sm-6">
                                                <select type="text" id="actionreturn" name="actionreturn" class="form-control select2" required>
                                                    <option value="50" selected>Local Sales</option>
                                                    <option value="51">Oversea Sales</option>
                                                    <option value="60">Return Local Sales</option>
                                                    <option value="61">Return Oversea Sales</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name='action' value="CpyLines">
                                            <i data-feather='plus'></i> {{ trans('cruds.OrderManagement.field.submmitline')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- MODAL RETURN --}}
                    {{-- MODAL SPLIT LINE --}}
                    <div class="modal fade" id="modalSplit" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header bg-primary">
                                    <h4 class="modal-title text-white"> {{ trans('cruds.OrderManagement.field.splitline')}}</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <br>
                                            <table class="table table-striped w-100" id="splitLine">
                                                <thead>
                                                    <tr>
                                                        <th> {{ trans('cruds.OrderManagement.field.id')}}</th>
                                                        <th>{{ trans('cruds.OrderManagement.field.headerid')}}</th>
                                                        <th>{{ trans('cruds.OrderManagement.field.line')}}</th>
                                                        <th>{{ trans('cruds.OrderManagement.field.items')}}</th>
                                                        <th>{{ trans('cruds.OrderManagement.field.qty')}}</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <div class="d-flex justify-content-between mb-50">
                                                <button type="reset" class="btn btn-warning pull-left">Reset</button>

                                                <button type="submit" class="btn btn-outline-secondary" name='action' value="split_lines" data-dismiss="modal">
                                                    {{ trans('cruds.OrderManagement.field.add')}}
                                                </button>
                                            </div>
                                            {{-- </form> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- MODAL SPLIT LINE --}}
                </div>
            </form>
        </div>
    </div>
</section>
@include('admin.sales.img');
@endsection
@push('script')
<script>
    // jQuery for opening the modal when the button is clicked
    $(document).ready(function () {
        $('#createInvoiceBtn').on('click', function () {
            $('#invoiceModal').modal('show'); // Show the modal
        });
    });

    $(document).ready(function() {

        var idReturn = [];
        $(".sub_chk:checked").each(function() {
            idReturn.push($(this).attr('data-id'));

        });

        var idSplit = [];
        $(".sub_chk:checked").each(function() {
            idSplit.push($(this).attr('data-id'));
        });

        console.log(idSplit);

        // CHECK ALL
        $('#masterckcbx').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
        });

        // CHECK ALL
        $('.add_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });

            if (allVals.length <= 0) {
                alert("Please select row.");

            } else {
                var check = alert("Add Row Success");
                if (check == true) {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: $(this).data('url')
                        , type: 'POST'
                        , headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        , data: 'id=' + join_selected_values
                        , success: function(data) {
                            alert(data['success']);
                        }
                        , error: function(data) {
                            alert(data.responseText);
                        }
                    });
                }
            }
        });
    });

</script>
@endpush

@section('scripts')
<script>
    function deleteItem(id) {
        console.log(id);
        var check = confirm("Are you sure you want to Delete this row?");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (check == true) {
            $.ajax({
                url: "./../salesOrder-detail/destroy" + id
                , type: "DELETE"
                , data: {
                    id: id
                , }
                , success: function(result) {
                    location.reload();
                    alert('Success');
                }
                , error: function(result) {
                    alert('error');
                }
            , });
        }
    }

</script>
@endsection

@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
@endpush
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header  mt-1 mb-70">
                    <h6 class="card-title">
                        <a href="{{ route("admin.orders.index") }}" class="breadcrumbs__item">{{ trans('cruds.quotation.po') }} </a>
                        <a href="{{ route("admin.orders.index") }}" class="breadcrumbs__item">Purchase Order List </a>
                        <a href="" class="breadcrumbs__item">{{ trans('cruds.purchaseOrder.fields.edit') }} </a>
                    </h6>
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary" href="{{ route('admin.orders.update', [$purchaseorder->id]) }}">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                                        stroke-linejoin="round" class="feather feather-check-circle me-50 font-small-4">
                                        <path d="M22 12A10 10 0 1 1 12 2a10 10 0 0 1 10 10z"></path>
                                        <polyline points="9 12 12 15 16 10"></polyline>
                                    </svg>
                                </span>

                                Confirm
                            </a>

                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <form action="{{ route("admin.orders.update",[$purchaseorder->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="number">{{ trans('cruds.quotation.fields.number') }}</label>
                                    <input type="text" class="form-control" value="{{$purchaseorder->segment1}}" id="order_number" readonly name="segment1" autocomplete="off" maxlength="10" required>
                                    <input type="hidden" id="id" name="id" value="{{$purchaseorder->id}}">
                                    <input type="hidden" name="header_id" value="{{$purchaseorder->po_head_id}}" id="header_id">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">{{ trans('cruds.quotation.fields.supplier') }}</label>
                                    <input type="text" readonly class="form-control search_supplier_name" value="{{$purchaseorder->Vendor->vendor_name}}" placeholder="Type here ..." name="supplier_name" autocomplete="off" required>
                                    <span class="help-block search_supplier_name_empty" style="display: none;">No Results Found ...</span>
                                    <input type="hidden" class="search_vendor_id" name="vendor_id" value='{{$purchaseorder->Vendor->vendor_id}}'>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">Currency</label>
                                    <input type="text"readonly class="form-control search_currency" value="{{$purchaseorder->currency_code}}" name="currency_code" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">Taxes</label>
                                    <input type="text"readonly class="form-control" value="{{$purchaseorder->taxes->tax_code}}" name="taxes" autocomplete="off" readonly>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <input type="hidden" id="created_by" name="created_by" value="{{$purchaseorder->created_by}}">
                            <input type="hidden" id="type_lookup_code" value='1' name="type_lookup_code">
                            <input type="hidden" id="organization_id" value='{{$purchaseorder->organization_id}}' name="organization_id">
                            <input type="hidden" id="bill_to_location" name="bill_to_location" value="BL-982221229">
                            <input type="hidden" id="rate_date" value="{{ date('d-M-Y H:i:s'); }}" name="rate_date">
                            <div class="col-md-4 col-12">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="number"> Supplier Site</label>
                                    {{-- <select name="agent_id" id="agent_id" class="form-control select2" required>
                                        <option class="form-control" value="{{$purchaseorder->agent_id}}">{{$purchaseorder->User->name ?? ''}} </option>
                                    @foreach ($agent as $row)
                                    @if( $row->agent_id != $purchaseorder->agent_id)
                                    <option class="form-control" value="{{$row->agent_id}}">{{$row->User->name ?? ''}}</option>
                                    @endif
                                    @endforeach
                                    </select> --}}
                                    <input type="text" readonly class="form-control supplier_site_id" value="{{$purchaseorder->supplierSite->address1??''}}" placeholder="Type here ..." name="site_name" autocomplete="off" required>
                                    <span class="help-block supplier_site_id_empty" style="display: none;">No Results Found ...</span>
                                    <input type="hidden" class="search_vendor_site_id" name="vendor_site_id" value='{{$purchaseorder->supplierSite->site_code ??''}}'>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">Delivery To</label>
                                    <input type="text" readonly class="form-control search_address1 " value="{{$purchaseorder->Site->address1}}" placeholder="Type here ..." name="address1" autocomplete="off" required>
                                    <span class="help-block search_address1_empty" style="display: none;">No Results Found ...</span>
                                    <input type="hidden" class="search_ship_to_location" name="ship_to_location" value="{{$purchaseorder->Site->site_code}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">Payment Method</label>
                                    <input type="text"readonly class="form-control" value="{{$purchaseorder->terms->terms_name}}" name="payment_method" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-25">
                                    <label class="col-sm-0 form-label" for="site">Creation Date</label>
                                    <input readonly type="text" id="datepicker-1_" name="created_at" class="form-control form-control flatpickr-basic flatpickr-input" value=" {{$purchaseorder->created_at->format('d-M-Y H:i:s')}}" required>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                
                            </div>
                            <!-- <div class="col-md-1">
                                <div class="mb-25">
                                    <a href="#" class="nav-link ">
                                        <img src="{{ asset('app-assets/fonts/feather/edit.svg') }}" width="25" height="25" />
                                        <p>
                                            <span>Bill</span>
                                        </p>
                                    </a>
                                </div>
                            </div> -->
                            <div class="col-md-1">
                                <div class="mb-">
                                    <a href="{{ route('admin.rcv.create', ['header_id' => $purchaseorder->po_head_id]) }}" class="nav-link ">
                                    <!-- <a href="" class="nav-link " id="IDrcvDet" data-bs-toggle="modal" data-bs-target="#rcv_modal"> -->
                                        <img src="{{ asset('app-assets/fonts/feather/truck.svg') }}" width="25" height="25" />
                                        <p>
                                            <span>Receipt</span>
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                                        
                        <div class="row">
                            <div class="box box-default">
                                <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                    <table class="table table-fixed  table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Purchase Item</th>
                                                <!-- <th>Category</th> -->
                                                <th>UOM</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Need By Date</th>
                                                <th>Total</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="purchase_container">
                                            @php $grand_total=0 @endphp
                                            @if ($purchaseOrderDet->isEmpty())

                                            @endif
                                            @foreach($purchaseOrderDet as $key => $raw)

                                            <tr class="tr_input">
                                                <td width="30%">
                                                    <input type="text" class="form-control search_purchase_item" placeholder="Type here ..." name="item_code[]" id="searchitem_{{$key+1}}" autocomplete="off" required value="{{$raw->ItemMaster->item_code ?? ''}} - {{$raw->item_description ?? ''}}"><span class="help-block " style="display: none;" id="search_item_code_empty_1" required>No Results Found ...</span>
                                                    <input type="hidden" class="search_inventory_item_id" id="id_{{$key+1}}'" value="{{$raw->inventory_item_id ?? ''}}" name="inventory_item_id[]" autocomplete="off">
                                                    <input type="hidden" class="form-control" value="{{$raw->item_description ??''}}" id="description_{{$key+1}}" name="description_item[]" autocomplete="off">
                                                    <input type="hidden" class="form-control" value="{{$raw->line_id ?? ''}}" id="line_id_{{$key+1}}" name="line_id[]" autocomplete="off">
                                                    <input type="hidden" class="form-control" value="{{$raw->id}}" id="po_line_id_{{$key+1}}" name="po_line_id[]" autocomplete="off">
                                                    <input type="hidden" id="updated_by" name="updated_by" value="{{auth()->user()->id}}">
                                                </td>
                                                <!-- <td width="15%">
                                                    <input type="text" class="form-control search_subcategory_code" placeholder="Type here ..." value="{{$raw->attribute2}}" name="category[]" id="category_1" autocomplete="off" required>
                                                    <input type="hidden" class="form-control  id_cc" placeholder="Type here ..." name="id_cc" autocomplete="off" required>
                                                </td> -->
                                                <td width="10%">
                                                    <input type="text" class="form-control" name="po_uom_code[]" id="uom_{{$key+1}}" value="{{$raw->po_uom_code}}" autocomplete="off" readonly>
                                                </td>
                                                <td width="10%">
                                                    @if ($raw->po_quantity<=$raw->quantity_receive)
                                                        <input type="text" class="form-control purchase_quantity text-end" value="{{$raw->po_quantity}}" name="purchase_quantity[]" id="qty_1" min="0" autocomplete="off" readonly required>
                                                        @else
                                                        <input type="text" class="form-control purchase_quantity text-end" value="{{$raw->po_quantity}}" name="purchase_quantity[]" id="qty_1" min="0" autocomplete="off"readonly required>
                                                        @endif
                                                </td>
                                                <td width="10%">
                                                    <input readonly type="text" class="form-control purchase_cost text-end" value="{{number_format(($raw->unit_price ?? $raw->base_model_price ),2,',','.')}}" name="purchase_cost[]" id="price_{{$key+1}}" onblur="cal()" autocomplete="off">
                                                </td>
                                                <td width="10%">
                                                    <input readonly type="date" name="need_by_date[]" value="{{$raw->need_by_date}}" class="form-control">
                                                </td>
                                                <td width="15%">
                                                    <input type="text" class="form-control stock_total text-end" name="sub_total[]" value="{{number_format(($raw->attribute2), 2, ',', '.') }}" id="total_1"="" readonly="">
                                                </td>
                                                <!-- <td>
                                                    @if($raw->line_status !=1 && $raw->quantity_receive !=0 )
                                                    <button type="button" class="btn btn-ligth btn-sm" style="position: inherit;">X</button>
                                                    @else
                                                    @if($loop) <form></form> @endif
                                                    <form type="hidden" action="{{ route('admin.orderDet.destroy',$raw->id) }}" enctype="multipart/form-data" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" class="btn btn-ligth btn-sm" --disabled- style="position: inherit;">X</button>
                                                    </form>
                                                    @endif
                                                </td> -->
                                            </tr>
                                            @php $grand_total += $raw->po_quantity * $raw->unit_price @endphp
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <!-- <tr>
                                                <td colspan="3">
                                                    <button type="button" class="btn btn-light btn-sm add_purchase_product"><i data-feather='plus'></i> Add More</button>
                                                </td>
                                                <td></td>
                                            </tr> -->
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Miscellaneous expense</label><br>
                                    <input type="text" class="form-control " name="attribute2" value="{{$purchaseorder->attribute2}}" min="0">
                                </div>
                            </div> -->
                            <!-- <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Tax ( % )</label><br>
                                    @php
                                    $rate=0;
                                    @endphp
                                    @php
                                    if (isset($raw->tax->tax_rate)){
                                    $rate=$raw->tax->tax_rate;
                                    }
                                    @endphp
                                    <select name="tax_id" id="tax_id" class="form-control" required>
                                        <option value="{{$raw->tax_name?? ''}}">{{$raw->tax_name?? ''}}</option>
                                        @foreach($tax as $rw)
                                        @isset($raw->tax_name)
                                        @if($raw->tax_name!=$rw->tax_code)
                                        <option value="{{ $rw->tax_code }}">{{ $rw->tax_name }}</option>
                                        @endif
                                        @endisset
                                        @empty($raw->tax_name)
                                        <option value="{{ $rw->tax_code }}">{{ $rw->tax_name }}</option>
                                        @endempty
                                        @endforeach
                                    </select>

                                </div>
                            </div> -->
                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tax ( Amount )</label><br>
                                    <input type="text" class="form-control purchase_tax_amount" name="tax_amount" readonly value="{{number_format($tax=$grand_total*$rate,2,',','.')}}">
                                </div>
                            </div> -->
                            <div class=" col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Purchase Total</label>
                                    <input type="text" class="form-control purchase_total" value="{{number_format($purchaseorder->attribute1, 2, ',', '.') }} " readonly="" name="purchase_total">
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="box box-default">
                                <div class="box-body">
                                    <div class="row mt-1 mb-2">
                                        <!-- <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="form-label">Notes</label>

                                                <input type="text" class="form-control" value="{{$purchaseorder->notes ??''}}" name="notes" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="form-label">ATP Reply</label>
                                                <input type="button" class="form-control grand_total btn  btn-secondary" data-bs-toggle="modal" data-bs-target="#atpModal" name="atpId" id="atpId " value="Set ATP" readonly="">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="form-label">Terms</label>
                                                <input type="button" class="form-control purchase_payment btn btn-info" data-bs-toggle="modal" data-bs-target="#demoModal" value="Set Terms" name="payment" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="form-label">Shipment By</label>
                                                <select name="ship_via_code" id="status" class="form-control">
                                                    <option value='Land'>Land</option>
                                                    <option value='Air'>Air</option>
                                                    <option value='Sea'>Sea</option>
                                                </select>
                                            </div>
                                        </div> -->

                                        <!-- <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="form-label">Approval Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value='{{$purchaseorder->status??''}}'>{{$purchaseorder->TrxStatuses->trx_name ??''}}</option>
                                                    @foreach($status as $id => $status)
                                                    <?php if( $purchaseorder->status != $status->trx_code) { ?>
                                                    <option value="{{ $status->trx_code }}">{{ $status->trx_name }}</option>
                                                    <?php } ?>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-sm-1">
                                            <div class="form-group">

                                                <label class="form-label">Action</label>
                                                <input type="submit" class="form-control purchase_payment btn btn-primary" value="{{ trans('global.save') }}" name="payment" autocomplete="off">
                                            </div>
                                        </div> -->
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="modal fade" id="demoModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header  bg-primary">
                                        <h4 class="modal-title text-white " id="exampleModalLongTitle">Terms</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div class="row mt-25">
                                                <div class="col-md-4 col-12">
                                                    <div class="mb-25">
                                                        <label class="col-sm-0 form-label" for="number">Payment</label>
                                                        <select name="term_id" id="term_id" class="form-control select2" required>
                                                            <option value="{{$purchaseorder->term_id}}">{{$purchaseorder->terms->terms_name??''}}</option>
                                                            @foreach ($term as $row)
                                                            @php if( $row->term_category =="PAYMENT" && $purchaseorder->term_id!=$row->term_code) { @endphp
                                                            <option value="{{$row->term_code}}">{{$row->terms_name}}</option>
                                                            @php }@endphp
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-25">
                                                        <label class="col-sm-0 form-label" for="site">Freight</label>
                                                        <select name="freight" id="freight" class="form-control select2" required>
                                                            <option value="{{$purchaseorder->freight}}">{{$purchaseorder->freight}}</option>
                                                            @foreach ($term as $row)
                                                            @php if( $row->term_category =="FREIGHT" && $purchaseorder->freight!=$row->term_code) { @endphp
                                                            <option value="{{$row->term_code}}">{{$row->terms_name}}</option>
                                                            @php }@endphp
                                                            @endforeach
                                                        </select></br>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <div class="mb-25">
                                                        <label class="col-sm-0 form-label" for="number">Origin</label>
                                                        <select name="attribute3" id="attribute3" class="form-control select2">
                                                            <option value="{{$purchaseorder->attribute3}}">{{$purchaseorder->attribute3}}</option>
                                                            @foreach ($term as $row)
                                                            @php if( $row->term_category =="ORIGIN" && $purchaseorder->attribute3!=$row->term_code ) { @endphp
                                                            <option value="{{$row->term_code}}">{{$row->terms_name}}</option>
                                                            @php }@endphp
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="mt-1 col-12">
                                                    <div class="form-floating mb-0">
                                                        <textarea class="form-control mb-1" rows="3" id="textarea-counter" name="description">{{$purchaseorder->description ??''}}</textarea>
                                                        <label class="col-sm-0 form-label">Remarks</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="mt-0 col-12">
                                                    <div class="mb-25">
                                                        <label class="col-sm-0 form-label" for="number">Instructions</label>
                                                        <select name="istructions" class="form-control select2">
                                                            @if (isset($purchaseorder->attribute_number1))
                                                            <option value="{{$purchaseorder->attribute_number1 ?? 0}}">Bank Number & Invoice </option>
                                                            <option value="0">Blank</option>
                                                            @else
                                                            <option value=""></option>
                                                            <option value="1111">Bank Number & Invoice
                                                                @endif
                                                            </option>


                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Modal Example Start-->
                        <!-- /.box-body -->
                        
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        @include('admin.purchase.rcv-src');
        @include('admin.purchase.atp-reply');
</section>
<!-- /.content -->

@endsection

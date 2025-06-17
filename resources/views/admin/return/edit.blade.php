
@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@endpush
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route("admin.return.index") }}">Purchase Order</a>
    </li>
    <a href="{{ route("admin.return.index") }}" class="breadcrumbs__item">Return</a>

    <li class="breadcrumb-item active"><a href="#">Edit</a>
    </li>
@endsection
@section('content')
<section id="multiple-column-form">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                 Purchase Order Edit
				 </div>
                <hr>
                <div class="card-body">
            <form action="{{ route("admin.orders.update",[$purchaseorder->id]) }}" method="POST" enctype="multipart/form-data">
               @csrf
				@method('PUT')
                    <div class="row">
							<div class="col-md-4">
                                <div class="mb-1">
									<label class="col-sm-0 control-label" for="number">{{ trans('cruds.quotation.fields.number') }}</label>
									<input type="text" class="form-control" value="{{$purchaseorder->segment1}}" name="segment1" autocomplete="off" maxlength="10" required>
									 <input type="hidden" id="id" name="id" value="{{$purchaseorder->id}}">
								</div>
							</div>
							<div class="col-md-5">
                                <div class="mb-1">
									<label class="col-sm-0 control-label" for="site">{{ trans('cruds.quotation.fields.supplier') }}</label>
									 <input type="text" class="form-control search_supplier_name" value="{{$purchaseorder->Vendor->vendor_name}}" placeholder="Type here ..." name="supplier_name" autocomplete="off" required >
                                     <span class="help-block search_supplier_name_empty" style="display: none;">No Results Found ...</span>
                                    <input type="hidden" class="search_vendor_id" name="vendor_id" value='{{$purchaseorder->Vendor->vendor_id}}' >
								</div>
							</div>
							<div class="col-md-3">
                                <div class="mb-1">
									<label class="col-sm-0 control-label" for="site">Currency</label>
									<input type="text" class="form-control search_currency" value="{{$purchaseorder->currency_code}}" name="currency_code" autocomplete="off" readonly>
								</div>
							</div>
					</div>
					 <div class="row">
						 <input type="hidden" id="created_by" name="created_by" value="{{$purchaseorder->created_by}}">
						 <input type="hidden" id="type_lookup_code" value='1' name="type_lookup_code" >
						 <input type="hidden" id="organization_id" value='222' name="organization_id" >
						 <input type="hidden" id="bill_to_location"  name="bill_to_location" value="BL-982221229" >
						 <input type="hidden" id="rate_date" value="{{ date('d-M-Y H:i:s'); }}"  name="rate_date" >
						<div class="col-md-4 col-12">
                                <div class="mb-1">
									<label class="col-sm-0 control-label" for="number"> Buyer</label>
									<select name="agent_id" id="agent_id"  class="form-control select2" required>
									<option value="{{$purchaseorder->agent_id}}">{{$purchaseorder->User->name}} </option>
									 @foreach ($agent as $row)
											   <?php if( $row->agent_id != $purchaseorder->agent_id) { ?>
													<option value="{{$row->agent_id}}">{{$row->User->name}}</option>
											   <?php }?>
												@endforeach
                                     </select>
								</div>
                         </div>
						 <div class="col-md-5 col-12">
                                <div class="mb-1">
									<label class="col-sm-0 control-label" for="site">Delivery To</label>
									<input type="text" class="form-control search_address1 " value="{{$purchaseorder->Site->address1}}" placeholder="Type here ..." name="address1" autocomplete="off" required>
									<span class="help-block search_address1_empty" style="display: none;">No Results Found ...</span>
									<input type="hidden" class="search_ship_to_location" name="ship_to_location" value="{{$purchaseorder->Site->site_code}}">
								</div>
                          </div>
						  <div class="col-md-3">
                                <div class="mb-3">
									<label class="col-sm-0 control-label" for="site">Creation Date</label>
									<input type="text" id="created_at" name="created_at" class="form-control" value="{{ date('d-M-Y H:i:s'); }}" required>
								</div>
                        </div>
                      </div>
					 <div class="row">
                      <div class="box box-default">
                          <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                            <table class="table table-fixed">
                              <thead>
                                <tr>
                                  <th>Purchase Item</th>
                                  <th>Category</th>
                                  <th>UOM</th>
                                  <th>Quantity</th>
                                  <th>Price</th>
                                  <th>Need By Date</th>
                                  <th>Total</th>
                                  <th style="text-align: center;">#</th>
                                </tr>
                              </thead>
                              <tbody class="purchase_container">
							   @php $grand_total=0 @endphp
							  @foreach($purchaseOrderDet as $key => $raw)
							  <tr class="tr_input">
							  <td width="30%">
							  <input type="text" class="form-control search_purchase_item" placeholder="Type here ..." name="item_code[]" id="searchitem_1" autocomplete="off" required value="{{$raw->itemMaster->item_code}} - {{$raw->item_description}}"><span class="help-block " style="display: none;" id="search_item_code_empty_1" required>No Results Found ...</span>
							  <input type="hidden" class="search_inventory_item_id" id="id_1'" value="{{$raw->inventory_item_id}}" name="inventory_item_id[]" autocomplete="off">
							  <input type="hidden" class="form-control" value="{{$raw->item_description}}" id="description_1"  name="description_item[]" autocomplete="off">
							  <input type="hidden" class="form-control" value="{{$raw->line_id}}" id="line_id_1"  name="line_id[]" autocomplete="off">
							  <input type="hidden" class="form-control" value="{{$raw->id}}" id="po_line_id_1"  name="po_line_id[]" autocomplete="off">
							   <input type="hidden" id="updated_by" name="updated_by" value="{{auth()->user()->id}}">
							  </td>
							  <td width="15%">
							  <input type="text" class="form-control closing_stock" value="{{$raw->attribute2}}" name="category[]" id="category_1" readonly>
							  </td>
							  <td width="10%">
							  <input type="text" class="form-control" name="po_uom_code[]" id="uom_1" value="{{$raw->po_uom_code}}" autocomplete="off" readonly>
							  </td>
							  <td width="10%">
							  <input type="text" class="form-control purchase_quantity" value="{{$raw->po_quantity}}" name="purchase_quantity[]" id="qty_1" autocomplete="off" required >
							  </td>
							  <td width="10%">
							  <input type="text" class="form-control purchase_cost" value="{{$raw->unit_price}}" name="purchase_cost[]" id="price_1" onblur="cal()" autocomplete="off" readonly>
							  </td>
							  <td width="10%">
							  <input type="date" name="need_by_date[]" value="{{$raw->need_by_date}}" class="form-control datepicker" id="need_1" autocomplete="off">
							  </td>
							  <td width="10%">
							  <input type="text" class="form-control stock_total" name="sub_total[]"  value="{{$raw->po_quantity * $raw->unit_price }}" id="total_1" ="" readonly="">
							  </td>
							  <td>
							  @if($raw->line_status !=1)
							  <button type="button" class="btn btn-danger" style="position: inherit;">&times;</button>
							  @else
							  @if($loop->first) <form ></form> @endif
									<form type="hidden" action="{{ route('admin.orders.destroy',$raw->id) }}" enctype="multipart/form-data" method=	"POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
										 <button type="submit" class="btn btn-danger" --disabled- >&times;</button>
									</form>
							  @endif
							  </td>
							  </tr>
							 @php $grand_total += $raw->po_quantity * $raw->unit_price @endphp
							    @endforeach
                              </tbody>
                              <tfoot>
                                <tr>
                                  <td colspan="3">
                                    <button type="button" class="btn btn-outline-info add_purchase_product" ><i class="fa fa-plus"></i> Add More</button>
                                  </td>
                                  <td></td>
                                </tr>
                              </tfoot>
                            </table>
							</br>
							 </div>
						</div>
                      </div>
                            <div class="row">
							<div class="col-md-3">
                                <div class="form-group">
                                  <label>Miscellaneous expense</label><br>
                                  <input type="text" class="form-control " name="attribute2"  min="0" value="0">
                                </div>
                              </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                  <label>Tax ( % )</label><br>
                                  <input type="number" class="form-control purchase_tax_percent" name="tax_percent"  step="0.01" min="0" max="100" value="0">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Tax ( Amount )</label><br>
                                  <input type="text" class="form-control purchase_tax_amount" name="tax_amount"   min="0" value="0">
                                </div>
                              </div>
                              <div class=" col-md-4">
                                <div class="form-group">
                                  <label>Purchase Total</label>
                                  <input type="text" class="form-control purchase_total" value="{{ $grand_total }}" readonly="" name="purchase_total">
                                </div>
                              </div>
                            </div>
					</br>
					</br>
					<div class="row">
                      <div class="box box-default">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label>Description</label>
                                <input type='text' class="form-control" value="{{$purchaseorder->description ??''}}" name="description" autocomplete="off">
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Catalog</label>
                                <input type="text" class="form-control grand_total btn  btn-secondary" name="grand_total" readonly="">
                              </div>
                            </div>

                            <div class="col-sm-1">
                              <div class="form-group">
                                <label>Terms</label>
                                <input type="button" class="form-control purchase_payment btn btn-info" data-toggle="modal" data-target="#demoModal" value="Set Terms" name="payment" autocomplete="off">
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Shipment By</label>
                                <select name="ship_via_code" id="status" class="form-control" >
											<option value='Land'>Land</option>
											<option value='Air'>Air</option>
											<option value='Sea'>Sea</option>
									</select>
                              </div>
                            </div>

                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Approval Status</label>
                               		<select name="status" id="status" class="form-control" >
											<option value='{{$purchaseorder->status??''}}'>{{$purchaseorder->TrxStatuses->trx_name ??''}}</option>
										@foreach($status as $id => $status)
										  <?php if( $purchaseorder->status != $status->trx_code) { ?>
											<option value="{{ $status->trx_code }}">{{ $status->trx_name }}</option>
										  <?php } ?>
										@endforeach
									</select>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
					<!-- Modal Example Start-->
						<div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h4 class="modal-title text-white" id="exampleModalLongTitle">Terms</h4>
								<button type="button" class="border-0 bg-success text-white" data-dismiss="modal" aria-label="Close">
								  X
								</button>
							  </div>
							  <div class="modal-body">
							   <div class="card-body">
								<div class="row">
									<div class="col-md-6 col-12">
										<div class="mb-1">
										  <label class="col-sm-0 control-label" for="number">Payment</label>
										  <select name="term_id" id="term_id"  class="form-control select2" required>
										  <option value="{{$purchaseorder->term_id}}">{{$purchaseorder->term_id}}</option>
													@foreach ($term as $row)
													@php if( $row->term_category =="PAYMENT" && $purchaseorder->term_id!=$row->term_code) { @endphp
													<option value="{{$row->term_code}}">{{$row->term_code}}</option>
													@php }@endphp
												@endforeach
										 </select>
										  </div>
									</div>
									 <div class="col-md-6 col-12">
										<div class="mb-1">
										 <label class="col-sm-0 control-label" for="site">Freight</label>
										<select name="freight" id="freight"  class="form-control select2" required>
										  <option value="{{$purchaseorder->freight}}">{{$purchaseorder->freight}}</option>
													@foreach ($term as $row)
													@php if( $row->term_category =="FREIGHT" && $purchaseorder->freight!=$row->term_code) { @endphp
													<option value="{{$row->term_code}}">{{$row->term_code}}</option>
													@php }@endphp
												@endforeach
										 </select></br>
										</div>
									 </div>
							  </div>
							  <div class="row">
									<div class="col-md-6 col-12">
										<div class="mb-1">
										  <label class="col-sm-0 control-label" for="number">Carrier</label>
										<select name="carrier" id="carrier"  class="form-control select2" required>
										 <option value="{{$purchaseorder->carrier}}">{{$purchaseorder->carrier}}</option>
													@foreach ($term as $row)
													@php if( $row->term_category =="CARRIER" && $purchaseorder->carrier!=$row->term_code ) { @endphp
													<option value="{{$row->term_code}}">{{$row->term_code}}</option>
													@php }@endphp
												@endforeach
										 </select>
										  </div>
									</div>
									 <div class="col-md-6 col-12">
										<div class="mb-1">
										 <label class="col-sm-0 control-label" for="site">Notes</label>
										<input type="text" class="form-control" value="{{$purchaseorder->notes ??''}}"  name="notes" autocomplete="off" >
										</div>
									 </div>
							  </div>
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>

							  </div>
							  </div>
							</div>
						  </div>
						</div>
			<!-- END Modal Example Start-->
                    <!-- /.box-body -->
                     <div class="d-flex justify-content-between">
                      <button type="reset" class="btn btn-danger pull-left">Reset</button>
                      <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('global.save') }}</button>
                    </div>
            </form>
          </div>
          <!-- /.box-body -->
          </div>
        </div>

    </section>
    <!-- /.content -->

@endsection
@section('scripts')
@parent
@endsection

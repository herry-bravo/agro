
@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush
@section('breadcrumbs')
    <a href="#" class="breadcrumbs__item">Purchase Order</a>
    <a href="#" class="breadcrumbs__item">Requisition</a>
@endsection
@section('content')
<section id="multiple-column-form">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-2">Add Requisition</h4>
                </div>
                <hr>
                <div class="card-body">
			<form action="{{ route('admin.purchase-requisition.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field()}}
				   <div class="row">

                            <div class="col-md-3 col-12">
                                <div class="mb-1">
								  <label class="col-sm-0 control-label" for="number">{{ trans('cruds.requisition.fields.number') }}</label>
								  <input type="text" class="form-control" value="{{$number}}" name="segment1" autocomplete="off" maxlength="10" readonly >
								  <input type="hidden" id="id" name="id" value="{{$head_id}}">
								 <input type="hidden" id="created_by" name="created_by" value="{{auth()->user()->id}}">
								 <input type="hidden" id="created_by" name="updated_by" value="{{auth()->user()->id}}">
								 <input type="hidden" id="organization_id" value='222' name="org_id" >
								  </div>
							</div>
							 <div class="col-md-2 col-12">
                                <div class="mb-1">
								 <label class="col-sm-0 control-label" for="site">{{ trans('cruds.requisition.fields.cost_center') }}</label>
                                <input type="text" class="form-control search_supplier_name" name="attribute1" autocomplete="off" >
								</div>
							 </div>

							<div class="col-md-2 col-12">
                                <div class="mb-1">
								<label class="col-sm-0 control-label" for="number"> {{ trans('cruds.requisition.fields.requested') }}</label>
								 <select name="requested_by" id="agent_id" class="form-control select2" >
										@foreach($users as $id => $users)
											<option value="{{ $users->id }}" {{ (in_array($id, old('users', [])) || isset($role) && $users->contains($id)) ? 'selected' : '' }}>{{ $users->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-3 col-12">
                                <div class="mb-1">
								  <label class="col-sm-0 control-label" for="site">Creation Date</label>
								   <input type="text" id="transaction_date" name="transaction_date" class="form-control" value="{{ date('d-M-Y H:i:s'); }}" >
								</div>
							</div>
							<div class="col-md-2 col-12">
                                <div class="mb-1">
									<label class="col-sm-0 control-label" for="site">{{ trans('cruds.requisition.fields.status') }}</label>
									<input type="text" class="form-control search_address1 " name="authorized_status" value="1" autocomplete="off" readonly >
								</div>
							</div>
                      </div><br>
					   <div class="row">
					   </hr>
                       <div class="box box-default">
                          <div class="box-body scrollx" style="height: 450px;overflow: scroll;">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>Product</th>
                                  <th>UOM</th>
                                  <th>Quantity</th>
                                  <th>Estimated Cost</th>
                                  <th>Need By Date</th>
                                  <th>PO Status</th>
                                  <th></th>
                                </tr>
                              </thead>
                          <tbody class="requisition_container">
							  <tr class="tr_input">
							  <td width="30%">
								  <input type="text" class="form-control search_purchase_item" placeholder="Type here ..." name="item_code[]" id="searchitem_1" autocomplete="off" required ><span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ...</span>
								  <input type="hidden" class="search_inventory_item_id" id="id_1'" value='1' name="inventory_item_id[]" autocomplete="off">
							  </td>
							  <td width="10%">
									<input type="text" class="form-control" name="pr_uom_code[]" id="uom_1" autocomplete="off" readonly>
							  </td>
							  <td width="10%">
									<input type="text" class="form-control purchase_quantity" name="quantity[]" id="qty_1" autocomplete="off" required >
							  </td>
							  <td width="20%">
								<input type="text" class="form-control purchase_cost" name="estimated_cost[]" id="price_1" onblur="cal()" autocomplete="off" readonly>
							  </td>
							  <td width="15%">
									<input type="date" name="requested_date[]" class="form-control datepicker" id="requested_date_1" autocomplete="off">
							  </td>
							  <td width="10%">
									<input type="text" class="form-control stock_total" name="status[]" id="status_1" ="" readonly="1">
							  </td>
							  <td>
							  <button type="button" class="btn btn-danger">&times;</button>
							  </td>
							  </tr>
                              </tbody>
                              <tfoot>
                                <tr>
                                  <td colspan="2">
									<button type="button" class="btn btn-outline-danger add_requisition_product " style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button>
                                  </td>
                                  <td></td>
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                      </div>

                      <div class="box box-default">
                        <div class="box-body">
                          <div class="row ">

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Description</label><br>
                                <input type='text' class="form-control"  name="description" autocomplete="off">
                              </div>
                            </div>
							<div class="col-sm-2">
                              <div class="form-group">
                                <label>Mode</label>
                                <select class="form-control" name="mode">
                                  <option value="1">Split</option>
                                  <option value="2">Cancel</option>
                                  <option value="3">Copy Line</option>
                                </select> </br>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->


					 <div class="d-flex justify-content-between">
					 <button class="btn btn-warning" type="reset"><i data-feather='refresh-ccw'></i> Reset</button>
					  <button type="submit" class="btn btn-success pull-left btn-submit"><i data-feather='save'></i> {{ trans('global.save') }}</button>
						<!--		<form action="{{ route('admin.purchase-requisition.destroy',(int)$number) }}" method="POST" onsubmit="return confirm('{{trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger pull-left btn-submit"><i data-feather='save'></i> {{ trans('global.save') }}</button>

								</form> -->
					</div>
				</div>
			</form>
          <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
@parent
<script>
 $(function () {
@can('order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.purchase-requisition.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan
})

</script>
@endsection

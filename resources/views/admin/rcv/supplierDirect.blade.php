@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush
@section('breadcrumbs')
<a href="{{ route("admin.rcv.index") }}" class="breadcrumbs__item">{{ trans('cruds.quotation.po') }} </a>
<a href="{{ route("admin.rcv.index") }}" class="breadcrumbs__item">{{ trans('cruds.rcv.title') }} </a>
<a href="" class="breadcrumbs__item active">{{ trans('cruds.rcv.fields.other') }} </a>
@endsection
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-2"></h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.rcvdirect-store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        <div class="row">

                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">{{ trans('cruds.rcv.fields.supplier') }}</label>
                                    <select id="supplier" name="vendor_id" class="form-control select2 filter">
                                        <option selected></option>
                                        @foreach ($vendor as $key => $row)
                                        <option value="{{$row->vendor_id}}">{{$row->vendor_name}} - {{$row->province}}, {{$row->country}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="site">Container No.</label>
                                    <input type="text" id="transaction_date" name="num_of_containers" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">{{ trans('cruds.rcv.fields.packingslip') }}</label>
                                    <input type="text" class="form-control search_supplier_name" name="packing_slip" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">{{ trans('cruds.rcv.fields.grn') }}</label>
                                    <input type="text" class="form-control" value="{{$grn->id??''}}" readonly value="" name="receipt_num" autocomplete="off" maxlength="10" required>
                                    <input type="hidden" class="form-control" name="segment1" value="{{$po_number}}" autocomplete="off" maxlength="10" required>
                                    <input type="hidden" id="agent_id" name="agent_id" value="{{auth()->user()->id?? ''}}">
                                    <input type="hidden" id="created_by" name="created_by" value="{{auth()->user()->id ?? ''}}">
                                    <input type="hidden" id="updated_by" name="updated_by" value="{{auth()->user()->id?? ''}}">
                                    <input type="hidden" id="ship_to_location" value='SH-982221229' name="ship_to_location">
                                    <input type="hidden" id="bill_to_location" value='BL-982221229' name="bill_to_location">
                                    <input type="hidden" id="type_lookup_code" value='1' name="type_lookup_code">
                                    <input type="hidden" id="source" value='1' name="source">
                                    <input type="hidden" id="currency" value='IDR' name="currency_code">
                                    <input type="hidden" id="rate_date" value='<?php echo date('Y-m-d'); ?>' name="rate_date">
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="site">{{ trans('cruds.autocreate.fields.org') }}</label></br>
                                    <div class="form-check form-switch form-check-primary">
                                        <input type="checkbox" class="form-check-input" name="organization_id" id="customSwitch10" value="222" >
                                        <label class="form-check-label" for="customSwitch10">
                                            <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg></span>
                                            <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row mt-2">
                            <div class="box box-default">
                                <div class="card-header">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-sales-tab" data-bs-toggle="tab" data-bs-target="#nav-sales" type="button" role="tab" aria-controls="nav-sales" aria-selected="true">
                                                <span class="bs-stepper-box">
                                                    <i data-feather="package" class="font-medium-3"></i>
                                                </span>
                                                Product
                                            </button>
                                            <button class="nav-link" id="nav-priceList-tab" data-bs-toggle="tab" data-bs-target="#nav-priceList" type="button" role="tab" aria-controls="nav-priceList" aria-selected="false">
                                                <span class="bs-stepper-box">
                                                    <i data-feather="cloud-drizzle" class="font-medium-3"></i>
                                                </span>
                                                Detail
                                            </button>
                                        </div>
                                    </nav>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="tab-content" id="nav-tabContent">
                                        {{-- Tab product --}}
                                        <div class="tab-pane fade show active" id="nav-sales" role="tabpanel" aria-labelledby="nav-sales-tab">
                                            <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                                <table class="table table-fixed table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th class='float-center text-center'>Sub Category</th>
                                                            <th class='float-center text-center'>UOM</th>
                                                            <th>Quantity</th>
                                                            <th class='float-center text-center'>Sub Inventory</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="rcv_container">
                                                        <tr class="tr_input">
                                                            <td width="40%">
                                                                <input type="text" class="form-control search_item_code" placeholder="Type here ..." name="item_code[]" id="searchitem_1" autocomplete="off" required><span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ..</span>
                                                                <input type="hidden" class="search_inventory_item_id" id="id_1" value='1' name="inventory_item_id[]" autocomplete="off">
                                                                <input type="hidden" class="form-control" id="description_1" value="" name="description_item[]" autocomplete="off">
                                                                <input type="hidden" class="form-control" id="category_1" value="" name="category[]" autocomplete="off">
                                                            </td>
                                                            <td width="15%">
                                                                <input type="text" class="form-control purchase_quantity float-end text-end" name="sub_category[]" id="sub_category_1" autocomplete="off" readonly required>
                                                            </td>
                                                            <td width="15%">
                                                                <input type="text" class="form-control search_uom_conversion" name="pr_uom_code[]" id="uom_1" autocomplete="off">
                                                                <span class="help-block search_uom_code_empty glyphicon" style="display: none;"> No Results Found </span>
                                                            </td>
                                                            <td width="15%">
                                                                <input type="text" class="form-control purchase_quantity float-end text-end" value="0" name="quantity[]" id="qty_1" autocomplete="off" required>
                                                            </td>
                                                            <td width="15%">
                                                                <input type="text" name="subinventory[]" class="form-control search_subinventory" id="subinvfrom_1" autocomplete="off">
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn  btn-sm  btn-secondary remove_tr_sales" >&times;</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="2">
                                                                <button type="button" class="btn btn-outline-danger add_rcv_direct " style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- Tab lain -lain --}}
                                        <div class="tab-pane fade" id="nav-priceList" role="tabpanel" aria-labelledby="nav-priceList-tab">
                                            <div class="box-body scrollx" style="height: 380px;overflow: scroll;">
                                                <table class="table table-striped tableFixHead" id="tab_logic">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" scope="col">% Water</th>
                                                            <th class="text-center" scope="col">% Gross</th>
                                                            <th class="text-center" scope="col">% Gross Tolerance</th>
                                                            <th class="text-center" scope="col">% Supplier Tolerance</th>
                                                            <th class="text-center" scope="col">% BM Tolerance</th>
                                                            <th class="text-center" scope="col">% Prohibitive</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="rcv_detail_container">
                                                        <tr class="tr_input1">
                                                            <td><input type="number" class="form-control " id="attribute_integer1_1" value="0" name="attribute_integer1[]" autocomplete="off" required ></td>
                                                            <td> <input type="number" id="attribute1_1" name="attribute1[]" value="0" class="form-control " ></td>
                                                            <td> <input type="number" id="attribute2_1" name="attribute2[]" value="0" class="form-control " ></td>
                                                            <td> <input type="number" id="attribute_integer2_1" name="attribute_integer2[]" value="0" class="form-control " ></td>
                                                            <td> <input type="number" id="transfer_percentage_1" name="transfer_percentage[]" value="0" class="form-control " ></td>
                                                            <td><input type="number" id="attribute_integer3_1" name="attribute_integer3[]" value="0" class="form-control "></td>
                                                            <td width="3px"> <button type="button" class="btn  btn-sm  btn-secondary remove_tr_sales" >&times;</button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-warning" type="reset"><i data-feather='refresh-ccw'></i>
                            Reset</button>
                        <button class="btn btn-primary btn-submit" type="submit"><i data-feather='save'></i>
                            {{ trans('global.save') }}</button>
                    </div>
                </div>
                </br>
            </div>
            </br>
        </div>


        </form>
        <!-- /.box-body -->
    </div>
    </div>

</section>
<!-- /.content -->
@endsection
@section('scripts')
@parent
<script>
    $(function() {
        @can('order_delete')
        let deleteButtonTrans = '{{ trans('
        global.datatables.delete ') }}'
        let deleteButton = {
            text: deleteButtonTrans
            , url: "{{ route('admin.purchase-requisition.massDestroy') }}"
            , className: 'btn-danger'
            , action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('{{ trans('
                        global.datatables.zero_selected ') }}')

                    return
                }

                if (confirm('{{ trans('
                        global.areYouSure ') }}')) {
                    $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            }
                            , method: 'POST'
                            , url: config.url
                            , data: {
                                ids: ids
                                , _method: 'DELETE'
                            }
                        })
                        .done(function() {
                            location.reload()
                        })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan
    })

</script>
@endsection

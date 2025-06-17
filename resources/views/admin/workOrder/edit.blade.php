@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush



@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    {{ $error }}
    @endforeach
</div>
@endif
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.work-order.update',[$wo->id]) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header" style="height: 40px">
                        <h6 class="card-title mb-25 mt-1">
                            <a href="{{route('admin.work-order.index')}}" class="breadcrumbs__item">{{ trans('cruds.bom.manufacture') }}</a>
                            <a href="{{route('admin.work-order.index')}}" class="breadcrumbs__item">{{ trans('cruds.workorder.title') }} {{ trans('global.list') }}</a>
                            <a href="#" class="breadcrumbs__item ">{{ trans('cruds.workorder.fields.edit') }}</a>
                        </h6>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-md-12">
                                    {{-- <button type="submit"name='action' value="product_move" class="btn btn-outline-primary " style="width: 100%"><i data-feather='inbox'></i> Product Move</button> --}}
                                    <div class="btn-group rounded-pill" role="group" aria-label="Basic example" style="margin-top: 3%;">
                                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#wipCompletion"><i data-feather='briefcase'></i> WIP Completion</button>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#productMove"><i data-feather='archive'></i> Product Move</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body mt-1">
                        <div class="row mb-50">
                            <div class="col-md-1">
                                <b>
                                    <p class="text-end">Product :<p>
                                </b>
                            </div>
                            <div class="col-md-5">
                                <div class="row p-0">
                                    <div class="col-md-4">
                                        <input type="text" name="parent_inventory_item_id" class="form-control" readonly value="{{$wo->bom->parent_item}} - {{$wo->bom->parent_description}}" autocomplete="off" required>
                                        <input type="hidden" name="h_inventory_item_id" class="form-control" readonly value="{{$wo->inventory_item_id}}" autocomplete="off" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="attribute_float1" class="form-control" readonly value="{{(int)$wo->attribute_float1 ?? 0}} GSM" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="attribute_float10" class="form-control" readonly value="{{(int)$wo->attribute_float10 ?? 0}} CM " required>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="attribute_float2" class="form-control" readonly value="{{(int)$wo->attribute_float2 ?? 0}} CM " required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <b>
                                    <p class="text-end">Date :</p>
                                </b>
                            </div>
                            <div class="col-md-5">
                                <input type="text" id="datepicker-1" name="need_by_date" value="{{$wo->need_by_date->format('d-M-Y')}}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-50">
                            <div class="col-md-1">
                                <b>
                                    <p class="text-end">Quantity :<p>
                                </b>
                            </div>
                            <div class="col-md-4">
                                <div class="row mt-1">
                                    <div class="col-md-8">
                                        <input type="text" name="planned_start_quantity_view" class="form-control" value="{{$wo->planned_start_quantity}} ( Kg )" required>
                                        <input type="hidden" name="planned_start_quantity" class="form-control" value="{{$wo->planned_start_quantity}}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="rolltotal" class="form-control" value="{{$planning[0]->total_roll_by_line ?? 0}} ( Roll )" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-1">
                                <b>
                                    <p class="text-end">PM :</p>
                                </b>
                            </div>
                            <div class="col-md-5">
                                {{-- <input type="text"   class="form-control datepicker" id="" autocomplete="off" required> --}}
                                <select id="pm" name="pm" class="form-control select2 filter_WorkOrder">
                                    @foreach ($pm as $key => $pm )
                                    <option value="{{$pm->short_name}}" {{ $wo->job_definition_name == $pm->short_name ? 'selected' : '' }}>{{$pm->name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="created_by" name="created_by" value="{{ auth()->user()->id }}" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-1">
                                <b>
                                    <p class="text-end">WO Number : <p>
                                </b>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="work_order_number" class="form-control" readonly value="{{$wo->work_order_number}}" autocomplete="off" required>
                                <input type="hidden" name="work_order_id" class="form-control" readonly value="{{$wo->work_order_id}}" autocomplete="off" required>
                                <input type="hidden" name="compl_subinventory_code" class="form-control" readonly value="{{$wo->compl_subinventory_code}}" autocomplete="off" required>
                                <input type="hidden" name="id" class="form-control" readonly value="{{$wo->id}}" autocomplete="off" required>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-1">
                                <b>
                                    <p class="text-end">Source :</p>
                                </b>
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="source_line_ref" value="{{$wo->source_line_ref}}" class="form-control datepicker" id="" autocomplete="off" required>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    {{-- </div>

                <div class="card"> --}}
                    <div class="card-header mt-1">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-micellaneous-tab" data-bs-toggle="tab" data-bs-target="#nav-micellaneous" type="button" role="tab" aria-controls="nav-micellaneous" aria-selected="true">
                                    <span class="bs-stepper-box">
                                        <i data-feather="file-text" class="font-medium-3"></i>
                                    </span>
                                    Expected Result
                                </button>
                                <button class="nav-link" id="nav-component-tab" data-bs-toggle="tab" data-bs-target="#nav-component" type="button" role="tab" aria-controls="nav-component" aria-selected="false">
                                    <span class="bs-stepper-box">
                                        <i data-feather="tool" class="font-medium-3"></i>
                                    </span>
                                    Component
                                </button>
                            </div>
                        </nav>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div>
                            <div class="tab-content" id="nav-tabContent">
                                {{-- Tab Misscellaneous --}}
                                <div class="tab-pane fade  show active" id="nav-micellaneous" role="tabpanel" aria-labelledby="nav-micellaneous-tab">
                                    <div class="box-body scrollx" style="height: 350px; overflow: scroll;">
                                        <table class="table table-striped tableFixHead">
                                            <thead>
                                                <th width="auto">
                                                </th>
                                                <th scope="col" class="text-center">{{ trans('cruds.planning.fields.no') }}</th>
                                                <th scope="col" class="text-center">{{ trans('cruds.planning.fields.item') }}</th>
                                                <th scope="col" class="text-center">Product Detail (GSM L x W)</th>
                                                <th scope="col" class="text-center">Qty(KG) / Roll</th>
                                                <th scope="col" class="text-center">Roll</th>
                                                <th scope="col" class="text-center">{{ trans('cruds.planning.fields.qty') }}</th>
                                                <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="sales_order_container">
                                                @php
                                                $roll=0; $qty=0;
                                                @endphp
                                                @foreach ($planning as $key => $row )
                                                <tr class="tr_input">
                                                    <td width="auto">
                                                    </td>
                                                    <td class="rownumber" style="width:3%">{{$key+1}}</td>
                                                    <td width="30%">
                                                        <input type="text" class="form-control search_sales" id="item_sales_1" placeholder="Type here ..." name="item_sales[]" value="{{$row->item_description}}" autocomplete="off" required>
                                                    <td width="35%">
                                                        <div class="col-xs-2">
                                                            <input class="form-control text-center" id="gsm_1" name='attribute_number_gsm[]' type="number" value="{{$row->attribute_gsm_line}}" placeholder="GSM" style="width: 30%;">/
                                                            <input class="form-control text-center" id="l_1" name='attribute_number_l[]' type="number" value="{{$row->attribute_number_l ?? 0}}" placeholder="L" style="width: 30%;">/
                                                            <input class="form-control text-center" id="w_1" name='attribute_number_w[]' type="number" value="{{$row->attribute_w_line}}" placeholder="W" style="width: 30%;">
                                                        </div>
                                                    </td>
                                                    <td width="auto">
                                                        <input type="number" class="form-control recount text-end" value="{{$row->qty_estimation}}" id="jumlah_1" name="ordered_quantity[]" required>
                                                    </td>
                                                    <td width="10%">
                                                        <input class="form-control text-end" id="roll_1" value="{{$row->total_roll_by_line}}" name='line_number[]' type="number">
                                                    </td>
                                                    <td width="auto">
                                                        <input type="number" class="form-control recount text-end" value="{{$row->total_qty}}" id="jumlah_1" name="ordered_quantity[]" required>
                                                    </td>
                                                    <td><button type="button" class="btn btn-ligth btn-sm remove_tr_sales" disabled>X</button></td>
                                                </tr>
                                                @php
                                                $roll += $row->total_roll_by_line;
                                                $qty += $row->total_qty;
                                                @endphp
                                                @endforeach
                                                <tr>
                                                    <th colspan="5" class="text-center">
                                                        <b>Total</b>
                                                    </th>
                                                    <td width="auto">
                                                        <input type="number" class="form-control recount text-end" value="{{$roll}}" required>
                                                    </td>
                                                    <td width="auto">
                                                        <input type="number" class="form-control recount text-end" value="{{$qty}}" required>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- Tab Component --}}
                                <div class="tab-pane fade" id="nav-component" role="tabpanel" aria-labelledby="nav-component-tab">
                                    <div class="box-body scrollx" style="height: 350px; overflow: scroll;">
                                        <table class="table">
                                            <thead>
                                                {{-- <th scope="col">Sequence</th> --}}
                                                <th class="text-center" scope="col">Item</th>
                                                <th class="text-center" scope="col">Description</th>
                                                <th class="text-center" scope="col">UOM</th>
                                                <th class="text-center" scope="col">To Consume</th>
                                                <th class="text-center" scope="col">Supply Subinventory</th>
                                                <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="workOrder_container">
                                                @foreach ($wo_detail as $key => $row)
                                                <tr class="tr_input1">
                                                    <td width="20%">{{$row->bomChild->child_item ?? $row->item_list->item_code ?? ''}} {{ $row->roll->attribute_number_gsm ?? ''}} GSM  {{ $row->roll->attribute_number_w ??'' }} CM
                                                        <input type="hidden" name="inventory_item_id[]" class="form-control" value="{{$row->inventory_item_id}}" required>
                                                        <input type="hidden" name="id_detail[]" class="form-control" value="{{$row->id}}" required>
                                                        <input type="hidden" name="sub_category[]" id="sub_category_{{$key+1}}" class="form-control" value="{{$row->id}}" required>
                                                        <input type="hidden" name="type_code[]" id="type_code_{{$key+1}}" class="form-control" value="{{$row->id}}" required>
                                                    </td>
                                                    <td width="35%">{{$row->bomChild->child_description ?? $row->item_list->description ?? $row->roll->uniq_attribute_roll}}</td>
                                                    <td width="10%">{{$row->uom_code ?? ''}}
                                                        <input type="hidden" name="uom_code[]" class="form-control" value="{{$row->uom_code }}" required>
                                                        <input type="hidden" name="wo_operation_material_id[]" class="form-control" value="{{$row->wo_operation_material_id }}" required>
                                                    </td>
                                                    <td width="25%">
                                                        <input type="number" name="quantity[]" class="form-control" value="{{$row->quantity}}" required readonly>
                                                        <input type="hidden" name="quantity_per_product[]" class="form-control" value="{{$row->quantity_per_product}}" required>
                                                        <input type="hidden" name="produced_quantity[]" class="form-control" value="{{$row->produced_quantity}}" required>
                                                    </td>
                                                    <td width="15%">
                                                        <input type="text" class="form-control search_subinventoryto" name="subinventory_to[]" id="subinventoryto_{{$key+1}}" value="{{$row->supply_subinventory}}" autocomplete="off">
                                                        <input type="hidden" class="form-control subinvto_'+index+'" name="supply_subinventory[]" id="subinvto_{{$key+1}}" value="{{$row->supply_subinventory}}" autocomplete="off">
                                                    </td>
                                                    <td width="5%">
                                                        <button type="button" class="btn btn-ligth btn-sm" disabled style="position: inherit;">X</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="add_row">
                                                    <td><input type="hidden" name="revision[]" class="form-control " id="rev_1" autocomplete="off">
                                                        <button type="button" class="btn btn-outline-success add_workOrder btn-sm" style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button></td>
                                                </tr>
                                            </tfoot>
                                        </table><br>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <br>

                        <div class="d-flex justify-content-between mb-2">
                            <button type="button" class="btn btn-danger pull-left" data-bs-toggle="modal" data-bs-target="#cancel">Cancel Work Order</button>
                            <button type="submit" name='action' value="save" class="btn btn-primary pull-right "><i class="fa fa-plus"></i> Add</button>
                        </div>

                    </div>
                    <!-- /.box-body -->

                </div>

                <!-- Modal WIP Completion Example Start-->
                @include('admin.workOrder.wipCompletion')

                <!-- END Modal Example Start-->


                <!-- Modal Cancel -->
                @include('admin.workOrder.cancel')
                <!-- END Modal Cancel-->

            </form>
        </div>

        <!-- Modal Product Move Example Start-->
        @include('admin.workOrder.productMove')
        <!-- END Modal Example Start-->
</section>
<!-- /.content -->
@endsection

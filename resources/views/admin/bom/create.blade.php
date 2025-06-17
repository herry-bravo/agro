@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush
@section('content')
@if(session()->has('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif

<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <form action="{{ route("admin.bom.store") }}" novalidate method="POST" enctype="multipart/form-data" class="form-horizontal create_purchase">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header mt-1">
                        <h6 class="card-title">
                            <a href="{{ route("admin.bom.index") }}" class="breadcrumbs__item">{{ trans('cruds.bom.manufacture') }} </a>
                            <a href="{{ route("admin.bom.index") }}" class="breadcrumbs__item"> {{ trans('cruds.prod.bom') }} </a>
                            <a href="{{ route("admin.bom.create") }}" class="breadcrumbs__item">Create </a>
                        </h6>
                    </div>
                    <hr>
                    <div class="card-body mt-2">
                        <div class="row mb-2">
                            <div class="col-md-1">
                                <b>
                                    <p class="text-end">Product :<p>
                                </b>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control search_item_code_parent" placeholder="Type here ..." id="searchitem" autocomplete="off" required><span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ...</span>
                                <input type="hidden" class="search_inventory_item_id" id="id" name="parent_inventory_it" autocomplete="off">
                                <input type="hidden" class="form-control" id="description" value="" name="parent_description" autocomplete="off">
                                <input type="hidden" class="form-control" id="item_code" value="" name="parent_item" autocomplete="off">
                                <input type="hidden" class="form-control" id="type_code" value="" name="parent_item_type" autocomplete="off">
                                {{-- <input type="hidden" class="form-control"  value="{{ auth()->user()->id }}" name="parent_item_type" autocomplete="off"> --}}
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-1">
                                <b>
                                    <p class="text-end">Date :</p>
                                </b>
                            </div>
                            <div class="col-md-5">
                                <input type="text" id="datepicker-1" name="efectivity_date" value="{{date('d-M-Y')}}" class="form-control" required>
                            </div>
                        </div>


                        <div class="row mb-2">
                            <div class="col-md-1">
                                <b>
                                    <p class="text-end">Quantity :<p>
                                </b>
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" name="substitute_quantity" min="1" required>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-1">
                                <b>
                                    <p class="text-end">Responsible :</p>
                                </b>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control datepicker" id="" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-1">
                                <b>
                                    <p class="text-end">Sub Inventory :<p>
                                </b>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control search_subinventory" value="" name="subinventory_from[]" id="subinventoryfrom_1" required>
                                <input type="hidden" class="form-control subinvfrom_1" name="completion_subinventory" id="subinvfrom_1" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    {{-- </div>

                <div class="card"> --}}
                    <div class="card-header">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-component-tab" data-bs-toggle="tab" data-bs-target="#nav-component" type="button" role="tab" aria-controls="nav-component" aria-selected="true">
                                    <span class="bs-stepper-box">
                                        <i data-feather="layers" class="font-medium-3"></i>
                                    </span>
                                    Component
                                </button>
                                <button class="nav-link" id="nav-operation-tab" data-bs-toggle="tab" data-bs-target="#nav-operation" type="button" role="tab" aria-controls="nav-operation" aria-selected="false">
                                    <span class="bs-stepper-box">
                                        <i data-feather="settings" class="font-medium-3"></i>
                                    </span>
                                    Operation
                                </button>
                                <button class="nav-link" id="nav-micellaneous-tab" data-bs-toggle="tab" data-bs-target="#nav-micellaneous" type="button" role="tab" aria-controls="nav-micellaneous" aria-selected="false">
                                    <span class="bs-stepper-box">
                                        <i data-feather="shuffle" class="font-medium-3"></i>
                                    </span>
                                    Micellaneous
                                </button>
                            </div>
                        </nav>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div>
                            <div class="tab-content" id="nav-tabContent">
                                {{-- Tab Component --}}
                                <div class="tab-pane fade show active" id="nav-component" role="tabpanel" aria-labelledby="nav-component-tab">
                                    <table class="table table-striped tableFixHead">
                                        <thead>
                                            <th scope="col">Sequence</th>
                                            <th scope="col">Item</th>
                                            <th scope="col">UOM</th>
                                            <th scope="col">Usage</th>
                                            <th scope="col">Cost</th>
                                            <th scope="col">Supply Inventory</th>
                                            <th scope="col">Active</th>
                                            <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="bomComponent_container">
                                            <tr class="tr_input">
                                                {{-- <td class="">1</td> an original code --}}
                                                <td class="" width="10%" value="10">10</td>
                                                <td width="30%">
                                                    <input type="text" class="form-control search_item_code " placeholder="Type here ..." id="searchitem_1" autocomplete="off" required>
                                                    <span class="help-block search_item_code_empty glyphicon" style="display: none;"> No Results Found </span>
                                                    <input type="hidden" class="search_inventory_item_id" id="id_1" name="child_inventory_id[]">
                                                    <input type="hidden" class="form-control" value="" id="description_1" name="child_description[]">
                                                    <input type="hidden" class="form-control" value="" id="item_code_1" name="child_item[]">
                                                    <input type="hidden" class="form-control" value="" id="type_code_1" name="child_item_type[]">
                                                    <input type="hidden" class="form-control" value="" id="sub_category_1" name="sub_category[]">
                                                </td>
                                                <td width="10%">
                                                    <input type="text" class="form-control" name="uom[]" id="uom_1" value="" autocomplete="off" readonly>
                                                </td>
                                                <td width="15%">
                                                    <input type="text" name="usage[]" class="form-control" id="locator_1" autocomplete="off" required>
                                                </td>
                                                <td width="10%">
                                                    <input type="text" name="standard_cost[]" class="form-control " id="rev_1" autocomplete="off">
                                                </td>
                                                <td width="15%">
                                                    <input type="text" name="shipping" id="subinventoryto_1" class="form-control search_subinventoryto" />
                                                    <input type="hidden" class="form-control subinvto_1" name="supply_subinventory[]" id="subinvto_1" autocomplete="off">
                                                </td>
                                                <td width="5%">
                                                    <div class="form-check form-switch form-check-primary">
                                                        <input type="checkbox" class="form-check-input" name="organization_id" id="customSwitch10_'+index+'" value="222" checked="">
                                                        <label class="form-check-label" for="customSwitch10_'+index+'">
                                                            <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                                </svg></span>
                                                            <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                </svg></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td width="5%">
                                                    <button type="button" class="btn btn-ligth btn-sm remove_tr_bom" style="position: inherit;">X</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">
                                                    <button type="button" class="btn btn-outline-success add_bomComponent btn-sm" style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table><br>
                                </div>

                                {{-- Tab Operation --}}
                                <div class="tab-pane fade" id="nav-operation" role="tabpanel" aria-labelledby="nav-operation-tab">
                                    <table class="table table-striped tableFixHead">
                                        <thead>
                                            <th scope="col">Operation</th>
                                            <th scope="col">Work Center</th>
                                            <th scope="col">Item</th>
                                            <th scope="col">Schedule Started Date</th>
                                            <th scope="col">Expected Duration</th>
                                            <th scope="col">Real Durtion</th>
                                            <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="bomOperation_container">
                                            <tr class="tr_input">
                                                <td width="5%" class="">10</td>
                                                <td class="rownumber">
                                                    <input type="text" id="work_center_1" class="form-control" autocomplete="off">
                                                </td>
                                                <td>
                                                    <input type="text" id="real_duration_1" class="form-control" autocomplete="off">
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control" autocomplete="off">
                                                </td>
                                                <td>
                                                    <input type="datetime-local" class="form-control" autocomplete="off">
                                                </td>
                                                <td>
                                                    <input type="datetime-local" class="form-control" autocomplete="off">
                                                </td>
                                                <td width="5%">
                                                    <button type="button" class="btn btn-ligth btn-sm" style="position: inherit;">X</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">
                                                    <button type="button" class="btn btn-outline-success add_bomComponent btn-sm" style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                {{-- Tab Misscellaneous --}}
                                <div class="tab-pane fade" id="nav-micellaneous" role="tabpanel" aria-labelledby="nav-micellaneous-tab">
                                    <table class="table table-striped tableFixHead">
                                        <thead>
                                            <th scope="col">Micellaneous</th>
                                            <th scope="col">Work Center</th>
                                            <th scope="col">Item</th>
                                            <th scope="col">Schedule Started Date</th>
                                            <th scope="col">Expected Duration</th>
                                            <th scope="col">Real Durtion</th>
                                            <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="bomMicellaneous_container">
                                            <tr class="tr_input">
                                                <td width="5%" class="">10</td>
                                                <td class="rownumber">
                                                    <input type="text" class="form-control" autocomplete="off">
                                                </td>
                                                <td width="20%">
                                                    <input type="text" class="form-control  " placeholder="Type here ..." id="searchitem_1" autocomplete="off" required>
                                                    <span class="help-block search_item_code_empty glyphicon" style="display: none;"> No Results Found </span>
                                                    <input type="hidden" class="search_inventory_item_id" id="id_1"></td>
                                                <input type="hidden" class="form-control" value="" id="description_1" autocomplete="off">
                                                <td width="15%">
                                                    <input type="date" class="form-control" id="locator_1" autocomplete="off" required>
                                                </td>
                                                <td width="15%">
                                                    <input type="datetime-local" class="form-control" id="locator_1" autocomplete="off" required>
                                                </td>
                                                <td width="15%">
                                                    <input type="datetime-local" class="form-control" id="locator_1" autocomplete="off" required>
                                                </td>
                                                <td width="5%">
                                                    <button type="button" class="btn btn-ligth btn-sm remove_tr_bom" style="position: inherit;">X</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">
                                                    <button type="button" class="btn btn-outline-success add_bomComponent btn-sm" style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <button type="reset" class="btn btn-danger pull-left">Reset</button>
                            <button type="submit" class="btn btn-primary pull-right "><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

            </form>
        </div>

</section>
<!-- /.content -->
@endsection

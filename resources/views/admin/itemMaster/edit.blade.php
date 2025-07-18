@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/wizard/bs-stepper.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-wizard.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" integrity="sha512-2eMmukTZtvwlfQoG8ztapwAH5fXaQBzaMqdljLopRSA0i6YKM8kBAOrSSykxu9NN9HrtD45lIqfONLII2AFL/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    #my-image,
    #use {
        display: none;
    }

</style>
@endsection
@push('script')
<script src="{{ asset('app-assets/vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/forms/form-wizard.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery-ui.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@section('breadcrumbs')
<a href="#" class="breadcrumbs__item"> {{ trans('cruds.itemMaster.inv') }}</a>
<a href="{{ route("admin.item-master.index") }}" class="breadcrumbs__item"> {{ trans('cruds.itemMaster.item_master') }}</a>
<a href="#" class="breadcrumbs__item">{{ trans('cruds.itemMaster.fields.edit') }}</a>

@endsection
@section('content')
<!-- Modern Horizontal Wizard -->
<section class="modern-horizontal-wizard">
    <form id="itemMasterForm" action="{{ route("admin.item-master.update", [$itemMaster->inventory_item_id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="bs-stepper wizard-modern modern-wizard-example">
            <div class="bs-stepper-header">
                <div class="step" data-target="#step1" role="tab" id="step1-trigger">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Items Master Details</span>
                            <span class="bs-stepper-subtitle">Setup Items Details</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="step" data-target="#step2" role="tab" id="step2-trigger">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="info" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Details Info</span>
                            <span class="bs-stepper-subtitle">Add Details Info</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="step" data-target="#step3" role="tab" id="step3-trigger">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">
                            <i data-feather="link" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">COA</span>
                            <span class="bs-stepper-subtitle">Add COA Account</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <div id="step1" class="content" role="tabpanel" aria-labelledby="step1-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Item Master Details</h5>
                        <small class="text-muted">Enter Your Item Master Details.</small>
                    </div>
                    <div class="row">
                        <div class="mb-25 col-md-5">
                            <label class="form-label" for="item_code">{{ trans('cruds.itemMaster.fields.item_code') }}</label>
                            <input type="text" name="item_code" id="item_code" class="form-control" value="{{isset($itemMaster->item_code)?$itemMaster->item_code :'';}}" autocomplete="off" readonly required />
                            <input type="hidden" name="id" id="id" class="form-control" value="{{isset($itemMaster->inventory_item_id)}}" autocomplete="off" readonly required />
                        </div>
                        <div class="mb-25 col-md-5">
                            <label class="form-label" for="description">{{ trans('cruds.itemMaster.fields.description') }}</label>
                            <input type="text" name="description" id="description" class="form-control" value="{{isset($itemMaster->description)?$itemMaster->description :'';}}" autocomplete="off" required aria-required="true" />
                        </div>
                        <div class="d-flex flex-column mb-25 col-md-2">
                            <label class="form-check-label mb-50" for="customSwitch10">Master</label>
                            <div class="form-check form-switch form-check-primary">
                                <input type="checkbox" class="form-check-input" id="customSwitch10" checked="">
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


                    <div class="row">
                        <div class="mb-25 col-md-4">
                            <label class="form-label" for="primary_uom_code">{{ trans('cruds.itemMaster.fields.uom') }}</label>
                            <select name="primary_uom_code" id="primary_uom_code" class="form-control select2" required>
                                <option value="{{ $itemMaster->primary_uom_code }}">{{ $itemMaster->primary_uom_code }}</option>
                            </select>
                        </div>
                        <div class="mb-25 col-md-4">
                            <label class="form-label" for="type_code">{{ trans('cruds.itemMaster.fields.type') }}</label>
                            <select name="type_code" id="type_code" class="form-control " required>
                                <option value="{{ $itemMaster->type_code }}">{{ $itemMaster->type_code }}</option>
                            </select>
                        </div>
                        <div class="mb-25 col-md-4">
                            <label class="form-label" for="status_id">{{ trans('cruds.itemMaster.fields.status') }}</label>
                            <select name="status_id" id="status_id" class="form-control" required>
                                <option value="{{$itemMaster->status_id}}">{{$itemMaster->itemstatuses->stts_name}}</option>
                                @foreach($itemstatus as $status)
                                @if ($itemMaster->status_id!=$status->stts_code)
                                <option value="{{ $status->stts_code }}">{{ $status->stts_name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="mb-25 col-md-4">
                            <label class="form-label" for="buyer_id">{{ trans('cruds.itemMaster.fields.buyer') }}</label>
                    <input type="text" name="buyer_id" id="buyer_id" class="form-control" value="{{$itemMaster->buyer_id}}" required />
                </div>
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="planner_code">{{ trans('cruds.itemMaster.fields.planner') }}</label>
                    <input type="text" name="planner_code" id="planner_code" value="{{$itemMaster->planner_code}}" class="form-control" required />
                </div>
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="mapping_item">{{ trans('cruds.itemMaster.fields.barcode') }}</label>
                    <input type="text" name="mapping_item" id="mapping_item" value="{{$itemMaster->mapping_item}}" class="form-control" required />
                </div>
            </div> --}}

            <div class="row">
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="buyer_id">{{ trans('cruds.itemMaster.fields.buyer') }}</label>
                    <select name="buyer_id" id="buyer_id" class="form-control select2" autocomplete="off">
                        <option value="{{$itemMaster->buyer_id ?? ''}}">{{$itemMaster->buyer->name ?? ''}}</option>

                        @foreach ( $agent as $poAgent)
                        @if ($itemMaster->buyer_id!=$poAgent->agent_id)
                        <option value="{{$poAgent->agent_id}}">{{$poAgent->user->name}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="make_buy_code">{{ trans('cruds.itemMaster.fields.makeOrbuy') }}</label>
                    <select name="make_buy_code" id="type_code" class="form-control " required>
                        <option value="{{$itemMaster->make_buy_code}}">{{$itemMaster->makeorbuy->make_or_buy}}</option>
                        @foreach ( $makeorbuy as $row)
                        @if ($itemMaster->make_buy_code!=$row->make_or_buy_code)
                        <option value="{{$row->make_or_buy_code}}">{{$row->make_or_buy}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-25 col-md-2">
                    <label class="form-label" for="mapping_item">{{ trans('cruds.itemMaster.fields.purchaseItem') }}</label>
                    <div class="form-check">
                        <input class="form-check-input" name="purchasing_item_flag" type="checkbox" value="1" id="inlineCheckbox1" checked="">
                        <label class="form-check-label" for="inlineCheckbox1">Purchased Item</label>
                    </div>
                </div>

                <div class="mb-25 col-md-2">
                    <label class="form-label" for="mapping_item">{{ trans('cruds.itemMaster.fields.inventory') }}</label>
                    <div class="form-check">
                        <input class="form-check-input" name="inventory_item_flag" type="checkbox" value="1" id="inlineCheckbox1" checked="">
                        <label class="form-check-label" for="inlineCheckbox1">{{ trans('cruds.itemMaster.fields.inventory') }} Item</label>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="mt-2 col-6">
                    <div class="form-floating mb-0">
                        <textarea data-length="100" class="form-control char-textarea" id="textarea-counter" name="item_note" rows="1" placeholder="Counter">{{$itemMaster->item_note}}</textarea>
                        <label for="form-label textarea-counter">Notes</label>
                    </div>
                    <small class="textarea-counter-value float-end">This Note Only For Internal Purposes, <b>Char Left : <span class="char-count">0</span> / 100 </b></small> </br>
                </div>
                <div class="mt-2 col-6">
                    <div class="form-floating mb-0">
                        <textarea data-length="100" class="form-control char-textarea" id="textarea-counter" name="item_brand" rows="1" placeholder="Counter">{{$itemMaster->item_brand}}</textarea>
                        <label for="form-label textarea-counter">Item Brand</label>
                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-between">
                <button class="btn btn-outline-secondary btn-prev" disabled>
                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button type="button" class="btn btn-primary btn-next">
                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                </button>
            </div>

        </div>
        <div id="step2" class="content" role="tabpanel" aria-labelledby="step2-trigger">
            <div class="content-header">
                <h5 class="mb-0">Detail Info</h5>
                <small>Enter Your Detail Info.</small>
            </div>

            <div class="row">
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="modern-first-name">{{ trans('cruds.itemMaster.fields.category') }}</label>
                    <select name="category_code" id="category_code" class="form-control select2" required>
                        <option value="{{$itemMaster->category_code}}">{{$itemMaster->Category->category_name}} {{$itemMaster->Category->description}}</option>
                        @foreach ($Category as $row)
                        <?php if( $row->category_code != $itemMaster->category_code) { ?>
                        <option value="{{$row->category_code}}">{{$row->category_name}} {{$row->description}}</option>
                        <?php }?>
                        @endforeach
                    </select>
                </div>
                <div class="mb-25 col-md-2">
                    <label class="form-label" for="modern-last-name">{{ trans('cruds.itemMaster.fields.subcat') }}</label>
                    <input type="text" id="sub_category_code" name="attribute2" class="form-control sub_category_code" value="{{$itemMaster->attribute2??''}}" />
                </div>
                <div class="mb-25 col-md-2 form-check-primary">
                    <label class="form-check-label mb-50" for="modern-last-name">{{ trans('cruds.itemMaster.fields.asset') }}</label>
                    <div class="form-check">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="asset" id="inlineRadio1" value="1" checked="">
                            <label class="form-check-label" for="inlineRadio1">Asset</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="asset" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2">Non Asset</label>
                        </div>
                    </div>
                </div>
                <div class="mb-25 col-md-3">
                    <a href="#imgModal" data-bs-toggle="modal" class="link-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                            <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z" />
                        </svg>
                        {{ trans('cruds.itemMaster.fields.img') }}
                    </a>
                </div>
            </div>


            <div class="row">
                <!-- <div class="mb-25 col-md-4">
                    <label class="form-label" for="item_weight">{{ trans('cruds.itemMaster.fields.weight') }}</label>
                    <input type="text" name="weight" id="item_weight" class="form-control" value="{{$itemMaster->weight}}" />
                </div>
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="item_volume">{{ trans('cruds.itemMaster.fields.height') }}</label>
                    <input type="text" name="height" id="height" class="form-control" value="{{$itemMaster->height}}" />
                </div>
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="item_volume">{{ trans('cruds.itemMaster.fields.volume') }}</label>
                    <input type="text" name="volume" id="item_volume" class="form-control" value="{{$itemMaster->volume}}" />
                </div> -->
                <!-- <div class="mb-25 col-md-4">
                            <label class="form-label" for="lta">{{ trans('cruds.itemMaster.fields.lta') }}</label>
                            <input type="text" name="lta" id="lta" class="form-control" required/>
                        </div> -->
            </div>

            {{-- <div class="row">
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="ltp">{{ trans('cruds.itemMaster.fields.ltp') }}</label>
            <input type="text" name="ltp" id="ltp" class="form-control" disabled />
        </div>
        <div class="mb-25 col-md-4">
            <label class="form-label" for="item_hscode">{{ trans('cruds.itemMaster.fields.hscode') }}</label>
            <input type="text" name="item_hscode" id="item_hscode" class="form-control" />
        </div>
        <div class="mb-25 col-md-4">
            <label class="form-label" for="item_pack_qty">{{ trans('cruds.itemMaster.fields.packingqty') }}</label>
            <input type="text" name="packing_quantity" value="{{$itemMaster->packing_quantity}}" id="item_pack_qty" class="form-control" />
        </div>
        </div>--}}


        <div class="row">
            <div class="mb-25 col-md-4">
                <label class="form-label" for="item_cost">{{ trans('cruds.itemMaster.fields.itemcost') }}</label>
                <input type="text" name="item_cost" id="item_cost" value="{{$itemMaster->item_cost}}" class="form-control" />
            </div>
            <div class="mb-25 col-md-4">
                <label class="form-label" for="bomflag">{{ trans('cruds.itemMaster.fields.sp') }}</label>
                <input type="text" name="min_o_qty" id="min_o_qty" class="form-control" value="{{$itemMaster->min_o_qty}}" autocomplete="off" />
            </div>
            <div class="mb-25 col-md-4">
                <label class="form-label" for="receiving_inventory">{{ trans('cruds.itemMaster.fields.subre') }}</label>
                <input type="text" name="receiving" value="{{$itemMaster->receiving_inventory}}" id="subinventoryfrom_1" class="form-control search_subinventory " />
                <input type="hidden" class="form-control subinvfrom_1" value="{{$itemMaster->receiving_inventory}}" name="receiving_inventory" id="subinvfrom_1" autocomplete="off">
            </div>
        </div>

        <div class="row mb-4">
            <div class="mb-25 col-md-4">
                <label class="form-label" for="shipping_inventory">{{ trans('cruds.itemMaster.fields.subshi') }}</label>
                <input type="text" name="shipping" id="subinventoryto_1" value="{{$itemMaster->shipping_inventory}}" class="form-control search_subinventoryto" />
                <input type="hidden" class="form-control subinvto_1" value="{{$itemMaster->shipping_inventory}}" name="shipping_inventory" id="subinvto_1" autocomplete="off">
            </div>
            <div class="mb-25 col-md-4">
                <label class="form-label" for="location">{{ trans('cruds.itemMaster.fields.location') }}</label>
                <input type="text" name="attribute1" id="location" value="{{$itemMaster->attribute1?? ''}}" class="form-control" />
            </div>
            <div class="mb-25 col-md-4">
                <label class="form-label" for="item_pack_qty">{{ trans('cruds.itemMaster.fields.packingqty') }}</label>
                <input type="text" name="packing_quantity" value="{{$itemMaster->packing_quantity}}" id="item_pack_qty" class="form-control" />
                {{-- <label class="form-label" for="refrence">{{ trans('cruds.itemMaster.fields.ref') }}</label>
                <input type="text" id="last_name" name="ref" class="form-control"> --}}
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-primary btn-prev">
                <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button type="button" class="btn btn-primary btn-next">
                <span class="align-middle d-sm-inline-block d-none">Next</span>
                <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
            </button>
        </div>
        </div>

        <div id="step3" class="content" role="tabpanel" aria-labelledby="step3-trigger">
            <div class="content-header">
                <h5 class="mb-0">Edit Links</h5>
                <small>Enter Your Social Links.</small>
            </div>
            <div class="row">
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="account_payable">{{ trans('cruds.itemMaster.fields.payable') }}</label>
                    <input readonly type="text" id="account_payable" name="account_payable" class="form-control" value="{{$itemMaster->Category->payable_account_code}}">
                    
                </div>
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="account_receivable">{{ trans('cruds.itemMaster.fields.receivable') }}</label>
                    <input readonly type="text" id="account_receivable" name="account_receivable" class="form-control" value="{{$itemMaster->Category->receivable_account_code}}">
                </div>
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="account_inventory">{{ trans('cruds.itemMaster.fields.inventory') }}</label>
                    <input readonly type="text" id="account_inventory" name="account_inventory" class="form-control" value="{{$itemMaster->Category->inventory_account_code}}">
                </div>
            </div>
            <div class="row mb-4">
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="account_consumption">{{ trans('cruds.itemMaster.fields.usage') }}</label>
                    <input readonly type="text" id="account_consumption" name="account_consumption" class="form-control" value="{{$itemMaster->Category->consumption_account_code}}">
                </div>
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="attribute1">{{ trans('cruds.itemMaster.fields.salescc') }}</label>
                    <input readonly type="text" id="attribute1" name="salescc" class="form-control" value="{{$itemMaster->Category->attribute1}}">
                </div>
                <div class="mb-25 col-md-4">
                    <label class="form-label" for="attribute2">{{ trans('cruds.itemMaster.fields.other') }}</label>
                    <input readonly type="text" name="attribute2" id="other" class="form-control"  value="{{$itemMaster->Category->attribute2}}" disabled />
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary btn-prev">
                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button type="button" onclick="document.getElementById('itemMasterForm').submit()" class="btn btn-info">
                    <i data-feather='save'></i> {{ trans('global.save') }}
                </button>

                <!-- <button type="submit" class="btn btn-info"><i data-feather='save'></i> {{ trans('global.save') }}</button> -->
            </div>
        </div>
        </div>
        </div>
    </form>
</section>
@include('admin.itemMaster.img')
<!-- /Horizontal Wizard -->
@endsection

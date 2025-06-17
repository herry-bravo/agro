@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/wizard/bs-stepper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-wizard.css') }}">
@endsection
@push('script')
    <script src="{{ asset('app-assets/vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-wizard.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/jquery-ui.min.js')}}"></script>
@endpush
@section('breadcrumbs')
        <a href="" class="breadcrumbs__item">Settings</a>
        <a href="" class="breadcrumbs__item">Unit Of Measurement</a>
        <a href="" class="breadcrumbs__item">Edit UOM</a>
@endsection
@section('content')
<!-- Modern Horizontal Wizard -->
<section class="modern-horizontal-wizard">
    <form action="{{ route("admin.uom-conversion.update",[$uomCon->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="bs-stepper wizard-modern modern-wizard-example">
            <div class="bs-stepper-header">
                <div class="step" data-target="#step3" role="tab" id="step3-trigger">
                    <button type="button" class="step-trigger">
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <div id="step3" class="content" role="tabpanel" aria-labelledby="step3-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Edit UOM Conversion</h5><br>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-3">
                            <label class="form-label">{{ trans('cruds.uomconversion.fields.item_code') }}</label>
                            <input type="text" class="form-control search_item_code " placeholder="Type here ..." name="item_code[]" value="{{$uomCon->itemMaster->item_code}}" id="searchitem_1" autocomplete="off" required>
                            <span class="help-block search_item_code_empty glyphicon" style="display: none;"> No Results Found </span>
                            <input type="hidden" class="search_inventory_item_id" id="id_1" name="inventory_item_id" value="{{$uomCon->inventory_item_id}}">
                        </div>
                        <div class="mb-1 col-md-3">
                            <label class="form-label">{{ trans('cruds.uomconversion.fields.uom_code') }}</label>
                            <input type="text" readonly name="uom_code" id="uom_1" value="{{$uomCon->uom_code}}" class="form-control" required/>
                            <label class="form-label">* 1 item</label>
                        </div>
                        <div class="mb-1 col-md-3">
                            <label class="form-label">{{ trans('cruds.uomconversion.fields.con_rate') }}</label>
                            <input type="text" name="conversion_rate" class="form-control" value="{{$uomCon->conversion_rate}}" required/>
                        </div>
                        <div class="mb-1 col-md-3">
                            <label class="form-label">{{ trans('cruds.uomconversion.fields.interior_code') }}</label>
                            <select name="interior_unit_code" id="primary_uom_code" class="form-control select2" required>
                                @foreach($uom as $row)
                                    @if($uomCon->interior_unit_code == $row->uom_code)
                                        <option selected value="{{ $row->uom_code }}  {{ in_array($row->uom_code, old('uom_code', [])) ? 'selected' : '' }}">{{ $row->uom_code }}</option>
                                    @else
                                        <option value="{{ $row->uom_code }}  {{ in_array($row->uom_code, old('uom_code', [])) ? 'selected' : '' }}">{{ $row->uom_code }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success"><i data-feather='save'></i> {{ trans('global.save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection

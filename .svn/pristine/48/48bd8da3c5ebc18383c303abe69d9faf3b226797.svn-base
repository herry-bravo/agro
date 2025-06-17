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

<a href="{{ route("admin.site.index") }}" class="breadcrumbs__item">Settings</a>
<a href="{{ route("admin.site.index") }}" class="breadcrumbs__item">Site</a>
<a href="" class="breadcrumbs__item active">Edit</a>

@endsection
@section('content')
<!-- Modern Horizontal Wizard -->
<section class="modern-horizontal-wizard">
    <form action="{{ route("admin.site.update", [$site->id]) }}" method="POST" enctype="multipart/form-data">
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
                        <h5 class="mb-0">Add Site</h5><br>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6"><label class="col-sm-1 control-label" for="number">{{ trans('cruds.site.fields.type') }}</label>
                            <select name="site_type" id="type_code" class="form-control select2" required>
                                @if (($site->site_type) == 'Billto')
                                <option value="Billto" selected>Bill To</option>
                                <option value="Shipto">Ship To</option>
                                <option value="Deliveryto">Delivery To</option>
                                @elseif (($site->site_type) == 'Shipto')
                                <option value="Shipto" selected>Ship To</option>
                                <option value="Deliveryto">Delivery To</option>
                                <option value="Billto">Bill To</option>
                                @else
                                <option value="Deliveryto" selected>Delivery To</option>
                                <option value="Billto">Bill To</option>
                                <option value="Shipto">Ship To</option>
                                @endif
                            </select>
                            @if($errors->has('type_code'))
                            <p class="help-block">
                                {{ $errors->first('type_code') }}
                            </p>
                            @endif
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="col-sm-1 control-label" for="number">{{ trans('cruds.vendor.fields.vendor_code') }}</label>
                            <input type="text" class="form-control" name="site_code" value="{{$site->site_code}}" placeholder="Party Site Code" required="required" maxlength="12" minlength="8">
                        </div>
                    </div>


                    <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-1 control-label" for="number">{{ trans('cruds.site.fields.name') }}</label>
                            <input type="text" class="form-control" name="address1" value="{{$site->address1}}">
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-1 control-label" for="number">{{ trans('cruds.site.fields.address2') }}</label>
                            <input type="text" class="form-control" name="address2" value="{{$site->address2}}">
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-1 control-label" for="number">{{ trans('cruds.site.fields.address3') }}</label>
                            <input type="text" class="form-control" name="address3" value="{{$site->address3}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-0 form-label" for="number">{{ trans('cruds.site.fields.city') }}</label>
                            <input type="text" class="form-control" name="city" value="{{$site->city}}">
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-0 form-label" for="number">{{ trans('cruds.site.fields.province') }}</label>
                            <input type="text" class="form-control" name="province" value="{{$site->province}}">
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-0 form-label" for="number">{{ trans('cruds.site.fields.country') }}</label>
                            <input type="text" class="form-control" name="country" value="{{$site->country}}">
                        </div>
                    </div>


                    <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-0 form-label" for="number">{{ trans('cruds.site.fields.phone') }}</label>
                            <input type="text" name="phone" class='form-control' value="{{$site->phone}}" required="required" maxlength="12" minlength="10" />
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-0 form-label" for="number">{{ trans('cruds.site.fields.email') }}</label>
                            <input type="text" name="email" class='form-control' value="{{$site->email}}" />
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-3">{{ trans('cruds.site.fields.bank_number') }}</label>
                            <input type="text" name="bank_number" class='form-control' value="{{$site->bank_number}}" maxlength="16" minlength="10" />
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

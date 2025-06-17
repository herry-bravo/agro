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
        <a href="" class="breadcrumbs__item">Create UOM</a>
@endsection
@section('content')
<!-- Modern Horizontal Wizard -->
<section class="modern-horizontal-wizard">
    <form action="{{ route("admin.uom.store") }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
    @csrf
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
                        <h5 class="mb-0">Add Unit Of Measurement</h5><br>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="form-label">{{ trans('cruds.uom.fields.uom_code') }}</label>
                            <input type="text" name="uom_code" class="form-control" required/>
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label">{{ trans('cruds.uom.fields.uom_name') }}</label>
                            <input type="text" name="uom_name" class="form-control" required/>
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label">{{ trans('cruds.uom.fields.description') }}</label>
                            <input type="text" name="description" class="form-control" required/>
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



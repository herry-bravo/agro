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
    <li class="breadcrumb-item"><a href="#">Setting</a>
    </li>
    <li class="breadcrumb-item"><a href="#">trx-statuses</a>
    </li>
@endsection
@section('content')
<!-- Modern Horizontal Wizard -->
<section class="modern-horizontal-wizard">
    <form action="{{ route("admin.trx-statuses.store") }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
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
                        <h5 class="mb-0">Add Transaction Status</h5><br>
                    </div>

                    <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-4 control-label" for="number">{{ trans('cruds.trx-statuses.fields.trx_code') }}</label>
                            <input type="text" class="form-control" name="trx_code" placeholder=" Code" required="required" >
                            <input type="hidden" id="created_by" name="created_by" value="{{auth()->user()->id}}">
                            <input type="hidden" id="updated_by" name="updated_by" value="{{auth()->user()->id}}">
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-4 control-label" for="number">{{ trans('cruds.trx-statuses.fields.trx_name') }}</label>
                             <input type="text" class="form-control" name="trx_name" placeholder="Status Name">
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="col-sm-4 control-label" for="number">{{ trans('cruds.trx-statuses.fields.trx_function') }}</label>
                              <input type="text" class="form-control" name="trx_function" placeholder="Function">
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




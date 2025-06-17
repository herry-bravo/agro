@extends('layouts.admin')
@section('content')
@push('script')
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/currency.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endpush
@section('breadcrumbs')
    <a href="{{route('admin.tax.index')}}" class="breadcrumbs__item">{{ trans('cruds.clientManagementSetting.title') }}</a>
    <a href="{{route('admin.tax.index')}}" class="breadcrumbs__item">{{ trans('cruds.tax.title') }}</a>
    <a href="{{route('admin.tax.create')}}" class="breadcrumbs__item active">{{ trans('cruds.tax.fields.edit') }}</a>
@endsection
@section('content')
<div class="card" >
    <div class="card-header">
        <h4 class="card-title mb-2">{{ trans('cruds.tax.title') }}</h4>
    </div>
    <hr>
    <br>
    <div class="card-body">
        <form id = "formship" action="{{ route("admin.tax.update",$tax->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="form-group row">
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.tax.fields.taxcode') }}</label>
                            <input type="text" id="tax_code" name="tax_code" class="form-control" value='{{$tax->tax_code}}' required autocomplete="off">

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.tax.fields.taxreg') }}</label>
                            <input type="text" id="tax_regimes_b" name="tax_regimes_b" class="form-control" value="{{$tax->tax_regimes_b}}" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label class="form-label"
                                for="segment1">{{ trans('cruds.tax.fields.taxname') }}</label>
                            <input type="text" id="tax_name" name="tax_name" class="form-control" value="{{$tax->tax_name}} " required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.tax.fields.taxrate') }}</label>
                            <input type="text" id="tax_rate" name="tax_rate" class="form-control" value="{{(FLOAT)$tax->tax_rate}} " required autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group row">
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.tax.fields.taxtaxes') }}</label>
                            <input type="text" id="tax_taxes_tl" name="tax_taxes_tl" class="form-control" value="{{$tax->tax_taxes_tl}}" required autocomplete="off">

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-2">
                            <label class="form-label"
                                for="segment1">{{ trans('cruds.tax.fields.taxtype') }}</label>
                            <input type="text" id="type_tax_use" name="type_tax_use" class="form-control" value="{{$tax->type_tax_use}}" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.tax.fields.taxaccount') }}</label>
                            <input type="text" id="tax_account" name="tax_account" class="form-control"value="{{$tax->tax_account}}" required autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div></div>
                <button class="btn btn-primary btn-submit"name='action' value="create" id="add_all" type="submit"><i data-feather='save'></i> {{ trans('global.save') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.admin')
@section('styles')
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/currency.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endpush
@section('content')
<div class="card">
    <div class="card-header mt-1 mb-50">
        <h6 class="card-title">
            <a href="{{ route("admin.currencies.index") }}" class="breadcrumbs__item">Currency </a>
            <a href="#" class="breadcrumbs__item"> {{ trans('cruds.currency.fields.create') }}</a>
        </h6>
    </div>
    <hr>
    <div class="card-body">
        <form action="{{ route("admin.currencies.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.currency.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($currency) ? $currency->name : '') }}" required>
                @if($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.currency.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group">
                <label for="currency_code">{{ trans('cruds.currency.fields.code') }}*</label>
                <input type="text" id="currency_code" name="currency_code" class="form-control" value="{{ old('currency_code', isset($currency) ? $currency->currency_code : '') }}" required>
                @if($errors->has('currency_code'))
                <p class="help-block">
                    {{ $errors->first('currency_code') }}
                </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.currency.fields.code_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('main_currency') ? 'has-error' : '' }}">
                <label for="main_currency">{{ trans('cruds.currency.fields.main_currency') }}</label>
                <input name="main_currency" type="hidden" value="0">
                <input value="1" type="checkbox" id="main_currency" name="main_currency" {{ old('main_currency', 0) == 1 ? 'checked' : '' }}>
                @if($errors->has('main_currency'))
                <p class="help-block">
                    {{ $errors->first('main_currency') }}
                </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.currency.fields.main_currency_helper') }}
                </p>
            </div>
            <div class="mb-1">
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection

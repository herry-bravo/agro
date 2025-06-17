@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
@endpush
@section('breadcrumbs')

<a href="{{ route("admin.permissions.index") }}" class="breadcrumbs__item">User Management</a>
<a href="{{ route("admin.permissions.index") }}" class="breadcrumbs__item">{{ trans('global.permission') }}</a>
<a href="" class="breadcrumbs__item active">Create</a>

@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-2">{{ trans('global.create') }} {{ trans('cruds.permission.title_singular') }}</h4>
    </div>

    <div class="card-body">
        <form action="{{ route("admin.permissions.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('cruds.permission.fields.title') }}*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($permission) ? $permission->title : '') }}" required>
                @if($errors->has('title'))
                <p class="help-block">
                    {{ $errors->first('title') }}
                </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.permission.fields.title_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-sm btn-primary" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection

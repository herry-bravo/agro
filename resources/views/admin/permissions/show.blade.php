@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
@endsection
@push('script')
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
@endpush
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <a href="{{ route("admin.permissions.index") }}" class="breadcrumbs__item">User Management</a>
        <a href="{{ route("admin.permissions.index") }}" class="breadcrumbs__item">{{ trans('global.permission') }}</a>
        <a href="" class="breadcrumbs__item active">View</a>
    </nav>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-2">{{ trans('global.show') }} {{ trans('cruds.permission.title') }}</h4>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.permission.fields.id') }}
                        </th>
                        <td>
                            {{ $permission->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.permission.fields.title') }}
                        </th>
                        <td>
                            {{ $permission->title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div >
                <a class="btn btn-warning btn-submit waves-effect waves-float waves-light mt-2" href="{{ url()->previous() }}">
                    <i data-feather='arrow-left'></i> {{ trans('global.back') }}
                </a>
            </div>

        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('breadcrumbs')
    <a href="{{ route("admin.materialTrnTypes.index") }}" class="breadcrumbs__item">Settings</a>
    <a href="{{ route("admin.materialTrnTypes.index") }}" class="breadcrumbs__item">Material Transaction Types</a>
    <a href="" class="breadcrumbs__item active">View</a>
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.materialTrnTypes.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.materialTrnTypes.fields.trx_code') }}
                        </th>
                        <td>
                            {{ $mtrl->trx_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialTrnTypes.fields.trx_type') }}
                        </th>
                        <td>
                            {{ $mtrl->trx_types }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialTrnTypes.fields.trx_action') }}
                        </th>
                        <td>
                            {{ $mtrl->trx_actions }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materialTrnTypes.fields.trx_source_types') }}
                        </th>
                        <td>
                            {{ $mtrl->trx_source_types }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection

@extends('layouts.admin')
@section('breadcrumbs')

<a href="{{ route("admin.site.index") }}" class="breadcrumbs__item">Settings</a>
<a href="{{ route("admin.site.index") }}" class="breadcrumbs__item">Site</a>
<a href="" class="breadcrumbs__item active">View</a>

@endsection
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.site.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.site.fields.type') }}                        </th>
                        <td>
                            {{ $site->site_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.site.fields.code') }}
                        </th>
                        <td>
                            {{ $site->site_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.site.fields.name') }}
                        </th>
                        <td>
                            {{ $site->address1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.site.fields.address2') }}
                        </th>
                        <td>
                            {{ $site->address2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.site.fields.address3') }}
                        </th>
                        <td>
                            {{ $site->address3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.site.fields.city') }}
                        </th>
                        <td>
                            {{ $site->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.site.fields.province') }}
                        </th>
                        <td>
                            {{ $site->province }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.site.fields.country') }}
                        </th>
                        <td>
                            {{ $site->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.site.fields.phone') }}
                        </th>
                        <td>
                            {{ $site->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.site.fields.email') }}
                        </th>
                        <td>
                            {{ $site->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.site.fields.bank_number') }}
                        </th>
                        <td>
                            {{ $site->bank_number }}
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

@extends('layouts.admin')
@section('content')
@section('breadcrumbs')
        <a href="" class="breadcrumbs__item">Settings</a>
        <a href="" class="breadcrumbs__item">Unit Of Measurement</a>
        <a href="" class="breadcrumbs__item">View UOM</a>
@endsection
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.uom.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.uom.fields.id') }}
                        </th>
                        <td>
                            {{ $uom->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.uom.fields.uom_code') }}
                        </th>
                        <td>
                            {{ $uom->uom_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.uom.fields.uom_name') }}
                        </th>
                        <td>
                            {{ $uom->uom_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.uom.fields.description') }}
                        </th>
                        <td>
                            {{ $uom->description }}
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

@extends('layouts.admin')
@section('content')

@section('breadcrumbs')
    <a href="{{ route("admin.subInventory.index") }}" class="breadcrumbs__item">{{ trans('cruds.subInventory.fields.inv') }}</a>
    <a href="{{ route("admin.subInventory.index") }}" class="breadcrumbs__item"> {{ trans('cruds.subInventory.title') }}</a>
    <a href="#" class="breadcrumbs__item active">{{ trans('cruds.subInventory.fields.show') }}</a>
@endsection

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.subInventory.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.subInventory.fields.sub_inventory_name') }}
                        </th>
                        <td>
                            {{ $sub->sub_inventory_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subInventory.fields.description') }}
                        </th>
                        <td>
                            {{ $sub->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subInventory.fields.locator_type') }}
                        </th>
                        <td>
                            {{ $sub->locator_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subInventory.fields.attribute_category') }}
                        </th>
                        <td>
                            {{ $sub->attribute_category }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subInventory.fields.sub_inventory_group') }}
                        </th>
                        <td>
                            {{ $sub->sub_inventory_group }}
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

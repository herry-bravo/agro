@extends('layouts.admin')
@section('content')
@section('breadcrumbs')
        <a href="" class="breadcrumbs__item">Settings</a>
        <a href="" class="breadcrumbs__item">Chart Of Account</a>
        <a href="" class="breadcrumbs__item">View Chart Of Account</a>
@endsection
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.coa.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.coa.fields.code') }}
                        </th>
                        <td>
                            {{ $coa->account_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coa.fields.parent') }}
                        </th>
                        <td>
                            {{ $coa->parent_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coa.fields.description') }}
                        </th>
                        <td>
                            {{ $coa->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coa.fields.type') }}
                        </th>
                        <td>
                            {{ $coa->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coa.fields.level') }}
                        </th>
                        <td>
                            {{ $coa->level }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coa.fields.group') }}
                        </th>
                        <td>
                            {{ $coa->group }}
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

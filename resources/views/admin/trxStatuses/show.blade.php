@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.trx-statuses.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.trx-statuses.fields.trx_code') }}                        </th>
                        <td>
                            {{ $status->trx_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trx-statuses.fields.trx_name') }}
                        </th>
                        <td>
                            {{$status->trx_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trx-statuses.fields.trx_function') }}
                        </th>
                        <td>
                            {{ $status->trx_function }}
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

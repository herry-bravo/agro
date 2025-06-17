@extends('layouts.admin')
@section('content')
@section('breadcrumbs')
    <nav class="breadcrumbs">
        <a href="" class="breadcrumbs__item">Settings</a>
        <a href="" class="breadcrumbs__item">Global Terms</a>
        <a href="" class="breadcrumbs__item">View Global Terms</a>
    </nav>
@endsection
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.terms.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.terms.fields.term_code') }}
                        </th>
                        <td>
                            {{ $terms->term_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.terms.fields.term_category') }}
                        </th>
                        <td>
                            {{ $terms->term_category }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.terms.fields.terms_name') }}
                        </th>
                        <td>
                            {{ $terms->terms_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.terms.fields.attribute1') }}
                        </th>
                        <td>
                            {{ $terms->attribute1 }}
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

@extends('layouts.admin')
@section('styles')
@endsection
@push('script')
@endpush
@section('content')
<div class="card">
    <div class="card-header ">
        <h6 class="card-title">
            <a href="{{ route('admin.bom.index') }}" class="breadcrumbs__item">{{ trans('cruds.bom.manufacture') }} </a>
            <a href="{{ route('admin.bom.index') }}" class="breadcrumbs__item"> {{ trans('cruds.prod.bom') }} </a>
        </h6>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route('admin.bom.create') }}">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </span>
                    {{ trans('global.add') }} {{ trans('cruds.prod.bom') }}
                </a>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-bordered table-hover datatable table-flush-spacing table-responsive-lg table">
                <thead>
                    <tr>
                        <th class="display:none;">

                        </th>
                        <th>
                            {{ trans('cruds.bom.fields.parent_item') }}
                        </th>
                        <th>
                            Type
                        </th>
                        <th>
                            {{ trans('cruds.bom.fields.child_item') }}
                        </th>
                        <th>
                            {{ trans('cruds.bom.fields.child_item_uom') }}
                        </th>
                        <th>
                            {{ trans('cruds.bom.fields.child_item_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.bom.fields.usage') }}
                        </th>
                        <th>
                            {{ trans('cruds.bom.fields.cost') }}
                        </th>
                        <th class="text-end">
                            {{ trans('cruds.bom.fields.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.bom.fields.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php($first = true) @endphp
                    @foreach ($bom as $key => $row)
                    <tr data-entry-id="">
                        <td class=" text-center;display:none; ">{{ $loop->iteration }}</td>
                        <td>{{ $row->parent_item ?? '' }} - {{ $row->parent_description ?? '' }}</td>
                        <td>{{ $row->parent_item_type ?? '' }}</td>
                        <td title="{{ $row->child_description ?? ''}}">{{ substr($row->child_description ?? '', 0, 35)  }} . . . </td>
                        <td class="text-center">{{ $row->uom ?? '' }} </td>
                        <td class="text-center">{{ $row->child_item_type ?? '' }}</td>
                        <td class="text-end">{{ $row->usage ?? '' }}</td>
                        <td class="text-end">{{ $row->standard_cost ?? '' }}</td>
                        <td class="text-end">{{ $row->created_at->isoFormat('D-MM-Y') ?? '' }}</td>
                        <td class="text-center">
                            @can('item_show')
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.bom.show', $row->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan
                            @can('item_edit')
                            <a class="btn btn-warning btn-sm waves-effect waves-float waves-light" href="{{ route('admin.bom.edit', $row->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
</script>
@endsection

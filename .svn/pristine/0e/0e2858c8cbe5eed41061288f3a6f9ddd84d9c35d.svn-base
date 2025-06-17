@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js') }}"></script>
@endpush
@section('content')
<div class="card">
    <div class="card-header">
        <h6 class="card-title">
            <a href="{{ route('admin.subInventory.index') }}" class="breadcrumbs__item">Inventory
            </a>
            <a href="{{ route('admin.subInventory.index') }}" class="breadcrumbs__item">{{ trans('cruds.subInventory.title_singular') }} {{ trans('global.list') }} </a>
        </h6>
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route('admin.subInventory.create') }}">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></span>
                    {{ trans('global.add') }} {{ trans('cruds.subInventory.title_singular') }}
                </a>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tblSubInventory" class="table datatable table-responsive-lg ">
                <thead>
                    <tr>
                        <th class="text-center">
                            #
                        </th>
                        <th>
                            {{ trans('cruds.subInventory.fields.sub_inventory_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.subInventory.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.subInventory.fields.locator_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.subInventory.fields.attribute_category') }}
                        </th>
                        <th>
                            {{ trans('cruds.subInventory.fields.sub_inventory_group') }}
                        </th>
                        <th class="text-center">Option
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($sub as $key => $row)
                    <tr data-entry-id="{{ $row->id }}">
                    <td class="display:none;">
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $row->sub_inventory_name ?? '' }}
                    </td>
                    <td>
                        {{ $row->description ?? '' }}
                    </td>
                    <td>
                        {{ $row->locator_type ?? '' }}
                    </td>
                    <td>
                        {{ $row->attribute_category ?? '' }}
                    </td>
                    <td>
                        {{ $row->sub_inventory_group ?? '' }}
                    </td>
                    <td class="text-center">
                        @can('item_show')
                        <a class="btn btn-primary btn-sm " href="{{ route('admin.subInventory.show', $row->id) }}">
                            {{ trans('global.view') }}
                        </a>
                        @endcan
                        @can('item_edit')
                        <a class="btn btn-warning btn-sm waves-effect waves-float waves-light" href="{{ route('admin.subInventory.edit', $row->id) }}">
                            {{ trans('global.edit') }}
                        </a>
                        @endcan
                        @can('item_delete')
                        <form action="{{ route('admin.subInventory.destroy', $row->id) }}" method="POST" style="display: inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-sm btn-danger hapusdata" value="{{ trans('global.delete') }}">
                        </form>
                        @endcan
                    </td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        , }
    });

    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        var table = $('#tblSubInventory').DataTable({
            "bServerSide": true
            , ajax: {
                url: '{{url("search/subinv-data") }}'
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    return d
                }
            }
            , responsive: false
            , scrollY: true
            , searching: true
            , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                    <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
            , displayLength: 20
            , "lengthMenu": [
                [10, 25, 50, -1]
                , [10, 25, 50, "All"]
            ]
            , buttons: [{
                    extend: 'print'
                    , text: feather.icons['printer'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Print'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'csv'
                    , text: feather.icons['file-text'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Csv'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'excel'
                    , text: feather.icons['file'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Excel'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'pdf'
                    , text: feather.icons['clipboard'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Pdf'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
            , ]
            , columnDefs: [{
                    render: function(data, type, row, index) {
                        var info = table.page.info();
                        return index.row + info.start + 1;
                    }
                    , targets: [0]
                }
                , {
                    render: function(data, type, row, index) {
                        content = `
                        @can('price_list_edit')
                        <a class=" badge btn  btn-sm btn-info" href="subInventory/${row.id}/edit">
                            {{ trans('global.open') }}
                        </a>
                        @endcan
                        @can('order_delete')<button type="button" class=" badge btn btn-delete btn-accent btn-danger m-btn--pill btn-sm m-btn m-btn--custom" data-index="${row.id}">{{ trans('global.delete') }}</button>
                         @endcan
                       `;
                        return content;
                    }
                    , targets: [6]
                }
            ]
            , columns: [{
                    data: 'id'
                    , className: "text-center"
                }
                , {
                    data: 'sub_inventory_name'
                }
                , {
                    data: 'description'
                }, {
                    data: 'locator_type'
                }, {
                    data: 'attribute_category'
                }, {
                    data: 'sub_inventory_group'
                    , class: 'text-start'
                }, {
                    data: ''
                    , class: 'text-center'
                }
            ]
        })
    });

</script>
@endpush

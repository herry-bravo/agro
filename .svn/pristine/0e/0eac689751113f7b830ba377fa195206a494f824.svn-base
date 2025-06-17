@extends('layouts.admin')
@section('content')
    @can('order_create')
    @endcan
{{-- @section('breadcrumbs')
    <a href="{{ route('admin.asset.index') }}" class="breadcrumbs__item">Asset Management</a>
    <a href="{{route('admin.asset.index')}}" class="breadcrumbs__item active">Asset</a>
@endsection --}}
<div class="card">
    <div class="card-header pt-1">
        <h6 class="card-title">
            <a href="" class="breadcrumbs__item"> {{ trans('cruds.assetMng.title') }}</a>
            <a href="{{ route("admin.asset.index") }}" class="breadcrumbs__item">  {{ trans('cruds.assetMng.title') }} </a>
        </h6>
        @can('role_create')
            <div class="row">
                <div class="col-lg-12">
                    <a class="btn btn-primary" href="{{ route('admin.asset.create') }}">
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg></span>
                        Add Asset</a>
                </div>
            </div>
        @endcan
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="asset_table" class="table table-striped table-hover datatable datatable-Order">
                <thead>
                    <tr>
                        <th style="text-align: left;">
                            No
                        </th>
                        <th>
                            {{ trans('cruds.assetMng.field.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.assetMng.field.value') }}
                        </th>
                        <th>
                            {{ trans('cruds.assetMng.field.currency_id') }}
                        </th>
                        <th>
                            {{ trans('cruds.assetMng.field.company_id') }}
                        </th>
                        <th>
                            {{ trans('cruds.assetMng.field.category_id') }}
                        </th>

                        <th>
                            {{ trans('cruds.assetMng.field.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.assetMng.field.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
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
            var table = $('#asset_table').DataTable({
                "bDestroy":true,
                "lengthMenu": [
                    [10, 25,]
                    , [10, 25]
                ]
                , scrollY: true
                , searching: true
                , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                        <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
                , language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                },
                "ajax":{
                    url: "/search/asset",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                },

                buttons: [
                    {
                        extend: 'print'
                        , text: feather.icons['printer'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Print'
                        , className: ''
                        , exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv'
                        , text: feather.icons['file-text'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Csv'
                        , className: ''
                        , exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel'
                        , text: feather.icons['file'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Excel'
                        , className: ''
                        , exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf'
                        , text: feather.icons['clipboard'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Pdf'
                        , className: ''
                        , exportOptions: {
                            columns: ':visible'
                        }
                    }
                    , {
                        extend: 'copy'
                        , text: feather.icons['copy'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Copy'
                        , className: ''
                        , exportOptions: {
                            columns: ':visible'
                        }
                    }
                    , {
                        extend: 'colvis'
                        , text: feather.icons['eye'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Colvis'
                        , className: ''
                    , }
                , ],
                columnDefs: [
                    {
                        "targets": 0,
                        "render": function(data, type, row, meta){
                            return row.id;
                        }
                    },
                    {
                        "targets": 1,
                        "render": function(data, type, row, meta){
                            return row.name;
                        }
                    },
                    {
                        "targets": 2,
                        "render": function(data, type, row, meta){
                            return row.value;
                        }
                    },
                    {
                        "targets": 3,
                        "render": function(data, type, row, meta){
                            return row.currency_id;
                        }
                    },
                    {
                        "targets": 4,
                        "render": function(data, type, row, meta){
                            return row.company_id;
                        }
                    },
                    {
                        "targets": 5,
                        "render": function(data, type, row, meta){
                            return row.category_id;
                        }
                    },

                    {
                        "targets": 6,
                        "render": function(data, type, row, meta){
                            return row.created_at;
                        }
                    },
                    {
                        "targets": 7,
                        className: "text-center",
                        render: function(data, type, row, index) {
                        content = `
                        <a class="btn btn-sm btn-warning" href="asset/${row.id}/edit">
                            {{ trans('global.edit') }}
                        </a>`;
                    //    del =`
                    //     @can('order_delete')
                    //             <button type="button" class="btn btn-delete btn-accent btn-danger m-btn--pill btn-sm m-btn m-btn--custom" data-index="${row.id}">{{ trans('global.delete') }}</button>
                    //      @endcan`;

                        return content;
                    }
                    , }

                ],
                fixedColumns: true,
                searching: true
                , displayLength:10,
            });
        });
    </script>
@endpush


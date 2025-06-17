@extends('layouts.admin')
@section('styles')
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
@endpush
@section('content')
<div class="card">
    <div class="card-header">

        <h6 class="card-title">
            <a href="" class="breadcrumbs__item">Settings </a>
            <a href="{{ route("admin.uom.index") }}" class="breadcrumbs__item">  {{ trans('cruds.uom.title_singular') }} </a>
        </h6>
        @can('role_create')
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route("admin.uom.create") }}" style="margin-top: 8%;">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></span>
                    {{ trans('global.add') }} {{ trans('cruds.uom.title_singular') }}
                </a>
            </div>
        </div>
        @endcan
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-uom">
                <thead>
                    <tr>
                        <th>

                        </th>
                        <th>
                            {{ trans('cruds.uom.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.uom.fields.uom_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.uom.fields.uom_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.uom.fields.description') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($uom as $key => $row)
                    <tr data-entry-id="{{ $row->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $row->id ?? '' }}
                        </td>
                        <td>
                            {{ $row->uom_code ?? '' }}
                        </td>
                        <td>
                            {{ $row->uom_name ?? '' }}
                        </td>
                        <td>
                            {{ $row->description ?? '' }}
                        </td>
                        <td class="text-center">
                            @can('item_show')
                            <a class="btn btn-primary btn-sm " href="{{ route('admin.uom.show', $row->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan
                            @can('item_edit')
                            <a class="btn btn-warning btn-sm waves-effect waves-float waves-light" href="{{ route('admin.uom.edit', $row->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan
                            @can('item_delete')
                            <form action="{{ route('admin.uom.destroy', $row->id) }}" method="POST" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-sm btn-danger hapusdata" value="{{ trans('global.delete') }}">
                            </form>
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
    $(function() {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('transaction_type_delete')
        let deleteButtonTrans = '{{ trans('
        global.datatables.delete ') }}'
        let deleteButton = {
            text: deleteButtonTrans
            , url: "{{ route('admin.transaction-types.massDestroy') }}"
            , className: 'btn-danger'
            , action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('{{ trans('
                        global.datatables.zero_selected ') }}')

                    return
                }

                if (confirm('{{ trans('
                        global.areYouSure ') }}')) {
                    $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            }
                            , method: 'POST'
                            , url: config.url
                            , data: {
                                ids: ids
                                , _method: 'DELETE'
                            }
                        })
                        .done(function() {
                            location.reload()
                        })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan

        $.extend(true, $.fn.dataTable.defaults, {
            order: [
                [1, 'desc']
            ]
            , pageLength: 100
        , });
        $('.datatable-TransactionType:not(.ajaxTable)').DataTable({
            buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })

</script>
@endsection

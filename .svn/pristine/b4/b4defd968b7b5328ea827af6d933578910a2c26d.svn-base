@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        <a href="{{ route("admin.quotation.index") }}" class="breadcrumbs__item">{{ trans('cruds.quotation.po') }} </a>
                        <a href="{{ route("admin.quotation.index") }}" class="breadcrumbs__item"> {{ trans('cruds.quotation.title_singular') }}</a>
                    </h6>
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary" href="{{ route("admin.quotation.create") }}">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg></span>
                                {{ trans('global.add') }} {{ trans('cruds.quotation.title_singular') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable table-flush-spacing datatable-Order">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.quotation.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.quotation.fields.site') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.quotation.fields.supplier') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.quotation.fields.number') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.quotation.fields.currency') }}
                                    </th>
                                    <th class="text-end">
                                        {{ trans('cruds.quotation.fields.effective_date') }}
                                    </th>
                                    <th class="text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quotation as $key => $raw)
                                <tr data-entry-id="{{ $raw->line_id }}">
                                    <td>

                                    </td>
                                    <td>
                                        {{ $raw->vendor_id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $raw->vendor_site_id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $raw->vendor->vendor_name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $raw->segment1 ?? '' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $raw->currency_code ?? '' }}
                                    </td>
                                    <td class="text-end">
                                        {{ $raw->effective_date ?? '' }}
                                    </td>
                                    <td class="text-center">
                                        @can('order_show')
                                        <a class="badge btn btn-primary btn-sm" href="{{ route('admin.quotation.show', $raw->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                        @endcan

                                        @can('order_edit')
                                        <a class="badge btn btn-warning btn-sm waves-effect waves-float waves-light" href="{{ route('admin.quotation.edit', $raw->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                        @endcan

                                        @can('order_delete')
                                        <form action="{{ route('admin.quotation.destroy', $raw->id) }}" method="POST" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="badge btn btn-sm btn-danger hapusdata" value="" style="  vertical-align: super;"> {{ trans('global.delete') }} </button>
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
        </div>
    </div>
</section>

@endsection
@section('scripts')
@parent
<script>
    $(function() {
        console.log('fungsi');
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('order_delete')
        let deleteButtonTrans = '{{ trans('
        global.datatables.delete ') }}'
        let deleteButton = {
            text: deleteButtonTrans
            , url: "{{ route('admin.orders.massDestroy') }}"
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
        $('.datatable-Order:not(.ajaxTable)').DataTable({
            buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })

</script>
@endsection

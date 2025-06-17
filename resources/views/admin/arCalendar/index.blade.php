@extends('layouts.admin')
@section('content')
@can('order_create')
@endcan
<div class="card">
    <div class="card-header p-1">

        <h6 class="card-title">
            <a href="" class="breadcrumbs__item">{{ trans('cruds.aReceivable.title') }} </a>
            <a href="{{ route("admin.credit-note.index") }}" class="breadcrumbs__item"> {{ trans('cruds.aReceivable.cal') }} </a>
        </h6>
        @can('role_create')
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route("admin.arCalendar.create") }}">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></span>
                     {{ trans('cruds.aReceivable.cal') }}</a>
            </div>
        </div>
        @endcan
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Order">
                <thead>
                    <tr>
						<th style="text-align: left;">
							<input type="checkbox" class='form-check-input dt-checkboxes text-end' id="head-cb">
						</th>
                        <th >
                        {{ trans('cruds.aReceivable.ar_calendar.id') }}
                        </th>
						<th>
                            {{ trans('cruds.aReceivable.ar_calendar.num') }}
                        </th>
						<th>
                            {{ trans('cruds.aReceivable.ar_calendar.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.aReceivable.ar_calendar.year') }}
                        </th>
						<th>
                            {{ trans('cruds.aReceivable.ar_calendar.from') }}
                        </th>
						<th>
                            {{ trans('cruds.aReceivable.ar_calendar.to') }}
                        </th>
						<th>
                            {{ trans('cruds.aReceivable.ar_calendar.status') }}
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cal as $key => $raw)
                        <tr data-entry-id="{{ $raw->id }}">
                            <td></td>
                            <td>
                                {{ $raw->id ?? '' }}
                            </td>
                            <td>
                                {{ $raw->num ?? '' }}
                            </td>
                            <td>
                                {{ $raw->setname ?? '' }}
                            </td>
                            <td>
                                {{ $raw->year ?? '' }}
                            </td>
                            <td>
                                {{ $raw->startdate ?? '' }}
                            </td>
                            <td>
                                {{ $raw->enddate ?? '' }}
                            </td>
                            <td class="text-center">
                                @if ($raw->confirmationstatus==14)
                                    <a class="badge bg-primary text-white">{{$raw->trx_code->trx_name}}</a>
                                @elseif ($raw->confirmationstatus==12)
                                    <a class="badge bg-secondary text-white">{{$raw->trx_code->trx_name}}</a>
                                @endif
                            </td>
                            <td>
                                @can('permission_show')
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.arCalendar.show', $raw->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('permission_edit')
                                    <a class="btn btn-warning btn-sm waves-effect waves-float waves-light" href="{{ route('admin.arCalendar.edit', $raw->id) }}">
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

 $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.orders.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  $('.datatable-Order:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection

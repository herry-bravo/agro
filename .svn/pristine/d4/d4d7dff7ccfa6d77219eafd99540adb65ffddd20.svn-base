@extends('layouts.admin')
@section('content')
@can('order_create')
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.rcv.title_singular') }} {{ trans('global.list') }}
        @can('role_create')
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route("admin.rcv.create") }}">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></span>
                     {{ trans('cruds.rcv.title_singular') }}                 </a>
            </div>
        </div>
        @endcan
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table  table-hover datatable datatable-Order">
                <thead>
                    <tr>
						<th style="text-align: left;">
							<input type="checkbox" class='form-check-input dt-checkboxes' id="head-cb">
						</th>
                        <th>
                            {{ trans('cruds.rcv.fields.transactiontype') }}
                        </th>
                        <th>
                            {{ trans('cruds.rcv.fields.orderno') }}
                        </th> 
						<th>
                            {{ trans('cruds.rcv.fields.product') }}
                        </th>
                        <th>
                            {{ trans('cruds.rcv.fields.packingslip') }}
                        </th>
						<th class="text-end">
                            {{ trans('cruds.rcv.fields.qty') }}
                        </th>
						<th  class="text-end">
                            {{ trans('cruds.rcv.fields.price') }}
                        </th>
                        <th  class="text-end">
                            {{ trans('cruds.rcv.fields.receivedqty') }}
                        </th>
						<th>
                            {{ trans('cruds.rcv.fields.transactiondate') }}
                        </th> 
						
                        <th style="text-align: center;">
                        {{ trans('cruds.rcv.fields.grnno') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rcv as $key => $raw)
                        <tr data-entry-id="{{ $raw->id }}">
                            <td style="display:none">
                                {{ $raw->id ?? '' }}
                            </td>
                            <td>
                                 {{ $raw->RcvHeader->transaction_type ?? '' }}
                            </td> 
							<td>
                            {{ $raw->PurchaseOrder->segment1 ?? '' }}  
                            </td>
                            <td>
                            {{ $raw->itemMaster->item_code ?? '' }} {{ $raw->item_description ?? '' }}
                            </td> 
							<td>
                            {{ $raw->RcvHeader->packing_slip ?? '' }}  
                            </td>
							<td  class="text-end">
                            {{ $raw->PurchaseOrderDet->po_quantity ?? '' }}  
                            </td>
							<td  class="text-end">
                            {{ $raw->PurchaseOrderDet->unit_price ?? '' }}  
                            </td>
                            <td  class="text-end"> 
                            {{ $raw->quantity_received ?? '' }}  
                            </td> 
							<td>
                            {{ $raw->RcvHeader->gl_date ?? '' }}  
                            </td> 
							<td  class="text-center">
                            {{ $raw->RcvHeader->receipt_num ?? '' }} 
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
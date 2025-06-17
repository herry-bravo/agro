@extends('layouts.admin')
@section('content')
@can('order_create')
@endcan
<div class="row">
    <div class="col-12">
        <form action="{{ route('admin.salesorder.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header  mt-2 mb-50">
                    <h6 class="card-title">
                        <a href="{{ route("admin.salesorder.index") }}" class="breadcrumbs__item">Shipment </a>
                        <a href="{{ route("admin.salesorder.index") }}" class="breadcrumbs__item">Report</a>
                    </h6>
                </div>
                <hr>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table id="table-sales" class=" table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">
                                        #
                                    </th>
                                    <th>
                                        Customer
                                    </th>
                                    <th>
                                        DeliveryID
                                    </th>
                                    <th>
                                        PONUM
                                    </th>
                                    <th>
                                        SONUM
                                    </th>
                                    <th>
                                        Product
                                    </th>
                                    <th class="">
                                        REQQTY
                                    </th>
                                    <th class="">
                                        QTY
                                    </th>
                                    <th class="text-center">
                                        UOM
                                    </th>
                                    <th class="text-center">
                                        PACQTY
                                    </th>

                                    <th class="text-center">
                                        Curr
                                    </th>
                                    <th class="text-center">
                                        Price
                                    </th>
                                    <th class="text-center">
                                        Total
                                    </th>
                                    <th class="text-center">
                                        {{ trans('cruds.OrderManagement.field.status') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="7">Total</th>
                                    <th id="total_order" class="text-end w-20"></th>
                                    <th class="text-end w-20"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>


                </div>
            </div>
            <!-- Start Modal GRN -->
            <div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-white" id="exampleModalLongTitle">Filter</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="card-body">
                                    <div class="row mt-1">
                                        <div class="col-md-12 col-12">
                                            <label class="col-sm-0 control-label" for="number">{{ trans('cruds.order.fields.customer_name') }}</label>
                                            <select name="customer" id="customer" class="form-control select2" required>
                                                <option hidden selected></option>
                                                @foreach($customer as $key => $row)
                                                <option value="{{ $row->cust_party_code }}">{{ $row->party_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- <div class="col-md-6 col-12">
                            <label class="col-sm-0 control-label" for="number">{{ trans('cruds.rcv.fields.rev') }}</label>
                                        <input type="input" class="form-control" id="rev" name="transaction_datefrom" placeholder="PO, Surat Jalan" autocomplete="off">
                                    </div> --}}
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="col-sm-0 control-label" for="number">{{ trans('cruds.rcv.fields.transactiondate') }}</label>
                                            <input type="date" id="from" name="ordered_date" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="col-sm-0 control-label" for="rate">{{ trans('cruds.rcv.fields.orderto') }}</label>
                                            <input type="date" id="to" name="ordered_date" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="sales_filter" class="btn btn-primary sales_filter" name="action">View</button>
                        </div>
                    </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
</div>
<!-- END  Modal GRN -->
@endsection
@section('scripts')
@push('script')
<script>
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        rev = $("#rev").val()
            , customer = $("#customer").val();
        from = $("#from").val();
        to = $("#to").val();

        var table = $('#table-sales').DataTable({
            "bServerSide": true
            , ajax: {
                url: '{{url("search/shipment-report") }}'
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    d.customer = $("#customer").val();
                    d.rev = $("#rev").val();
                    d.from = $("#from").val();
                    d.to = $("#to").val();
                    return d
                }
            }
            , responsive: false
            , scrollX: true
            , searching: true
            , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                    <"d-flex justify-content-between mx-0 row"\
                        <"d-flex justify-content-between mx-0 mt-2 row"\
                        <"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-3 text-end"><"col-sm-12 col-md-1"p>\
                        >t>'
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
                    extend: 'colvis'
                    , text: feather.icons['eye'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Colvis'
                    , className: ''
                }, {
                    text: feather.icons['filter'].toSvg({
                        class: 'font-small-4 me-50 '
                    }) + 'Filter'
                    , className: 'btn-warning'
                    , action: function(e, node, config) {
                        $('#modalFilter').modal('show')
                    }
                , }
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

                        content = `<a class="badge bg-danger text-white">${row.trx_name}</a>`;

                        return content;
                    }
                    , className: "text-center"
                    , targets: [13]
                }
            ]
            , columns: [{
                    data: 'id'
                    , className: "text-center"
                }
                , {
                    data: 'customer_name'
                    , className: "text-start"
                }, {
                    data: 'packing_slip_number'
                    , className: "text-center"
                }, {
                    data: 'customer_po_number'
                    , className: "text-start"
                }, {
                    data: 'so_number'
                    , className: "text-start"
                }, {
                    data: 'item_code'
                    , className: "text-start"
                }, {
                    data: 'requested_qty'
                    , className: "text-end"
                }, {
                    data: 'qty'
                    , className: "text-end"
                }, {
                    data: 'uom'
                    , className: "text-center"
                }, {
                    data: 'roll'
                    , className: "text-center"
                }, {
                    data: 'currency_code'
                    , className: "text-center"
                }, {
                    data: 'unit_price'
                    , className: "text-center"
                }, {
                    data: 'total'
                    , className: "text-end"
                }
            ]
            , "footerCallback": function(tfoot, data, start, end, display) {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };

                // Total over all pages
                total = api
                    .column(12)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal = api
                    .column(12, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(7).footer()).html('' + pageTotal.toLocaleString());
                $(api.column(8).footer()).html('' + total.toLocaleString());
            }
        });

        $(document).on('click', '.sales_filter', function() {

            var rev = $("#rev").val();
            var customer = $("#customer").val();
            var from = $("#from").val();
            var to = $("#to").val();
            console.log(from, to);

            $('#modalFilter').modal('hide');
            $('#table-sales').DataTable().ajax.reload()
        });
    });

</script>
@endpush

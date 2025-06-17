@extends('layouts.admin')
@section('content')
@can('order_create')
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.order.title_singular') }} {{ trans('global.list') }}
        @can('role_create')
        <div class="row">
        </div>
        @endcan
    </div>
    <div class="card-body " >

        <div class="table-responsive">
            <table id="table-sales" class=" table table-bordered table-striped" >
                <thead>
                    <tr>
                        <th style="text-align: center;">
                            <input type="checkbox" class='form-check-input dt-checkboxes' id="head-cb">
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.order_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.customer_po2') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.customer_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.products') }}
                        </th>
                        <th>
                            {{ trans('cruds.OrderManagement.field.gsm') }}
                        </th>
                        <th>
                            {{ trans('cruds.OrderManagement.field.w') }}
                        </th>
                        <th class="text-end">
                            {{ trans('cruds.OrderManagement.field.price') }}
                        </th>
                        <th class="text-end">
                            {{ trans('cruds.OrderManagement.field.qty') }}
                        </th>
                        <th class="text-end">
                            {{ trans('cruds.OrderManagement.field.delivery_qty') }}
                        </th>
                        <th class="text-end">
                            {{ trans('cruds.OrderManagement.field.outstandingqty') }}
                        </th>
                        <th>
                            {{ trans('cruds.OrderManagement.field.packingslip') }}
                        </th>
                        <th>
                            {{ trans('cruds.OrderManagement.field.surat_jalan') }}
                        </th>
                        <th>
                            {{ trans('cruds.OrderManagement.field.delivery_id') }}
                        </th>
                        <th class="">
                            {{ trans('cruds.OrderManagement.field.currency') }}
                        </th>
                        <th>
                            {{ trans('cruds.OrderManagement.field.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.OrderManagement.field.status') }}
                        </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
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
                <form >
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
                                <input type="date" id="from" name="ordered_date" class="form-control"  required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="rate">{{ trans('cruds.rcv.fields.orderto') }}</label>
                                <input type="date" id="to" name="ordered_date" class="form-control"  required>
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


         rev = $("#rev").val(),
         customer = $("#customer").val();
         from = $("#from").val();
         to = $("#to").val();

         console.log(rev);
        const table = $('#table-sales').DataTable({
            "bServerSide": true
            , ajax: {
                url: '{{url("search/sales-report") }}'
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    d.customer =  $("#customer").val();
                    d.rev = $("#rev").val();
                    d.from = $("#from").val();
                    d.to = $("#to").val();
                    return d
                }
            }
            , responsive: false
            , scrollX: true
            , searching: true
            , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-8"Bl><"col-sm-12 col-md-4"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
            , displayLength: 10
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

                        if (row.flow_status_code  == 5){
                            content = `<a class="badge bg-info text-white">${row.trx_name}</a>`;
                        }else if (row.flow_status_code == 6){
                            content = `<a class="badge bg-primary text-white">${row.trx_name}</a>`;
                        }else if (row.flow_status_code == 7){
                            content = `<a class="badge bg-primary text-white">${row.trx_name}</a>`;
                        }else if (row.flow_status_code == 8){
                            content = `<a class="badge bg-warning text-white">${row.trx_name}</a>`;
                        }else if (row.flow_status_code == 12){
                            content = `<a class="badge bg-danger text-white">${row.trx_name}</a>`;
                        }else{
                            content = `<a class="badge bg-secondary text-white">${row.trx_name}</a>`;
                        }

                        return content;
                    }
                    , className: "text-center"
                    , targets: [16]
                }
            ]
            , columns: [{
                data: 'id'
                , className: "text-center"
            }
            , {
                data: 'order_number'
            }, {
                data: 'cust_po_number'
            }, {
                data: 'customer_name'
            }, {
                data: 'item_code'
            },  {
                data: 'attribute_number_gsm'
                , className: "text-end"
            }, {
                data: 'attribute_number_w'
                    , className: "text-end"
                },{
                    data: 'unit_selling_price'
                    , className: "text-end"
                }, {
                    data: 'ordered_quantity'
                    , className: "text-end"
                }, {
                    data: 'delivered_quantity'
                    , className: "text-end"
                }, {
                    data: 'outstanding_qty'
                    , className: "text-end"
                }, {
                    data: 'packing_slip_number'
                    , className: "text-center"
                }, {
                    data: 'dock_code'
                    , className: "text-center"
                },{
                    data: 'delivery_id'
                    , className: "text-center"
                }, {
                    data: 'currency'
                    , className: "text-center"
                }, {
                    data: 'created_at'
                    , className: "text-center"
                }
            ]
        })

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

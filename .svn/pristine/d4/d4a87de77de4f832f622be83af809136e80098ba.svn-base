@extends('layouts.admin')
@section('content')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
  @endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush
@can('order_create')
@endcan
<div class="card">
    <div class="card-header">
        <h6 class="card-title">
            <a href="" class="breadcrumbs__item">Account Payables </a>
            <a href="{{ route("admin.credit-memo.index") }}" class="breadcrumbs__item"> Credit Memo </a>
        </h6>

        @can('role_create')
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route("admin.credit-memo.create") }}">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></span>
                    {{ trans('global.add') }} Credit Memo
                </a>
            </div>
        </div>
        @endcan
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="aptable" class=" table table-striped w-100" data-source="data-source">
                <thead>
                    <tr>
                        <th>
                            Invoice
                        </th>
                        <th class="text-end">
                            Vendor
                        </th>
                        <th class="text-end">
                            Invoice Number
                        </th>
                        <th class="text-end">
                            Voucher Number
                        </th>
                        <th class="text-end">
                            Invoice Date
                        </th>
                        <th class="text-end">
                            Received Date
                        </th>
                        <th class="text-end">
                            Gl Date
                        </th>
                        <th class="text-center">
                            Currency
                        </th>
                        <th class="text-center">
                            Tax
                        </th>
                        <th class="text-center">
                            Invoice Amount
                        </th>

                        <th class="text-end">
                            {{ trans('cruds.aPayable.fields.action') }}
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
            var table = $('#aptable').DataTable({
                "bDestroy":true,
                "lengthMenu": [
                    [10, 25,'All']
                    , [10, 25,'All']
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
                    url: "/search/credit-memo",
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
                            return row.invoiceID;
                        }
                    },
                    {
                        "targets": 1,
                        "render": function(data, type, row, meta){
                            return row.vendorID;
                        }
                    },
                    {
                        "targets": 2,
                        "render": function(data, type, row, meta){
                            return row.invoice;
                        }
                    },{
                        "targets": 3,
                        "render": function(data, type, row, meta){
                            return row.voucher_num;
                        }
                    },{
                        "targets": 4,
                        "render": function(data, type, row, meta){
                            return row.invoice_date;
                        }
                    },{
                        "targets": 5,
                        "render": function(data, type, row, meta){
                            return row.invoice_received_date;
                        }
                    },{
                        "targets": 6,
                        "render": function(data, type, row, meta){
                            return row.gl_date;
                        }
                    },{
                        "targets": 7,
                        "render": function(data, type, row, meta){
                            return row.currency;
                        }
                    },{
                        "targets": 8,
                        "render": function(data, type, row, meta){
                            return row.tax_amount;
                        }
                    },
                    {
                        "targets": 9,
                        "render": function(data, type, row, meta){
                            return row.invoice_amount;
                        }
                    },

                    {
                        "targets": 10,
                        className: "text-center",
                            render: function(data, type, row, index) {
                            content = `
                            <a class="btn btn-sm btn-info" href="credit-memo/${row.id}/edit">
                                {{ trans('global.open') }}
                            </a>`;

                            return content;
                        }
                    },
                ],
                fixedColumns: true,
                searching: true
                , displayLength:10,
                    });
                });

</script>
@endpush

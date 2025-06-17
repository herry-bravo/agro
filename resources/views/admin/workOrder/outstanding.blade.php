
<div class="card">
    <div class="card-header">
        <h6 class="card-title">
            <a href="{{ route("admin.prodplan.index") }}" class="breadcrumbs__item">{{ trans('cruds.bom.manufacture') }} </a>
            <a href="{{ route("admin.prodplan.index") }}" class="breadcrumbs__item"> Out Standing</a>
        </h6>

        @can('role_create')
        <div class="row">
            <div class="">
                <button class="btn btn-info" id="getTrim">
                    <i data-feather='refresh-cw'></i> Generate
                </button>
            </div>
        </div>
        @endcan
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="outstanding" class="table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox"name="" class="" id="">
                        </th>
                        <th>
                            {{ trans('cruds.workorder.table.wonum') }}
                        </th>
                        <th>
                            Sales Ref
                        </th>
                        <th>
                            Customer Code
                        </th>
                        <th>
                            Customer PO
                        </th>
                        <th>
                            Item Code
                        </th>
                        <th>
                            GSM
                        </th>
                        <th>
                            Weight
                        </th>
                        <th>
                            Qty
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<form action="{{ route('admin.fg-ostd.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal" novalidate>
    {{ csrf_field() }}
    <div class="modal fade" id="getTrimModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content" style="height: 600px">
                <div class="modal-header">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Trim Expected</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <table id="trim-expected" class="table w-100 table-hover">
                        <thead>
                            <tr>
                                <th>{{ trans('cruds.planning.fields.no') }}</th>
                                <th>{{ trans('cruds.planning.fields.order_num') }}</th>
                                <th>{{ trans('cruds.planning.fields.customer') }}</th>
                                <th>{{ trans('cruds.planning.fields.po_num') }}</th>
                                <th>{{ trans('cruds.planning.fields.item') }}</th>
                                <th>{{ trans('cruds.planning.fields.gsm') }}</th>
                                <th>{{ trans('cruds.planning.fields.width') }}</th>
                                <th>{{ trans('cruds.planning.fields.qty') }}</th>
                                <th>{{ trans('cruds.planning.fields.opration') }}</th>
                                <th>{{ trans('cruds.planning.fields.roll') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>

@push('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            , }
        });
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';
            var table = $('#outstanding').DataTable({
                ajax: {
                    url: "/search/outstanding"
                    , type: "GET"
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , data: function(d) {
                        return d
                    }
                }
                ,"bDestroy": true
                , displayLength: 10
                , "lengthMenu": [
                    [10, 25, 'All']
                    , [10, 25, 'All']
                ]
                ,searching: true
                ,columnDefs: [
                    {
                        "targets": 0,
                        "render": function(data, type, row, meta){
                            return (`
                                <input type="checkbox" class="form-check-input cb-child item_check" name="id[]" id="${row.id}" value="${row.id}">
                            `);
                        }
                    },
                    {
                        "targets": 1,
                        "render": function(data, type, row, meta){
                            return row.wonumber;
                        }
                    },
                    {
                        "targets": 2,
                        "render": function(data, type, row, meta){
                            return row.sales_ref;
                        }
                    },
                    {
                        "targets": 3,
                        className: "text-center",
                        "render": function(data, type, row, meta){
                            return row.customer_code;
                        }
                    },
                    {
                        "targets": 4,
                        "render": function(data, type, row, meta){
                            return row.customer_po;
                        }
                    },
                    {
                        "targets": 5,
                        "render": function(data, type, row, meta){
                            return row.item_code;
                        }
                    },
                    {
                        "targets": 6,
                        render: function(data, type, row, meta){
                            return row.gsm;
                        }
                    },
                    {
                        "targets": 7,
                        render: function(data, type, row, meta){
                            return row.attchar;
                        }
                    },
                    {
                        "targets": 8,
                        "render": function(data, type, row, index){
                            return row.qty;
                        }
                    },
                ]
                , responsive: false
                , scrollX: true
                , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                        <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
                ,buttons: [{
                        text: feather.icons['printer'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Print'
                        , className: 'print'
                        , attr: {
                            id: 'print'
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
                    , }
                , ]
                ,language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;'
                        , next: '&nbsp;'
                    }
                }


            })

        });

        $(document).on('click', '#getTrim', function () {
            console.log('masuk');
            $.ajax({
                url: '/admin/fg-ostd',
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $('#getTrimModal').modal('show');

                    var table = $('#trim-expected').DataTable({
                        ajax: {
                            url: "/admin/fg-ostd/create"
                            , type: "GET"
                            , headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                            , data: function(d) {
                                return d
                            }
                        }
                        ,"bDestroy": true
                        , displayLength: 10
                        , "lengthMenu": [
                            [10, 25, 'All']
                            , [10, 25, 'All']
                        ]
                        ,searching: true
                        ,columnDefs: [
                            {
                                "targets": 0,
                                "render": function(data, type, row, meta){
                                    return (`
                                        <input type="checkbox" class="form-check-input cb-child item_check" name="id[]" id="${row.id}" value="${row.id}">
                                    `);
                                }
                            },
                            {
                                "targets": 1,
                                "render": function(data, type, row, meta){
                                    return row.sales_reference_num;
                                }
                            },
                            {
                                "targets": 2,
                                "render": function(data, type, row, meta){
                                    return row.customer_po_number;
                                }
                            },
                            {
                                "targets": 3,
                                className: "text-center",
                                "render": function(data, type, row, meta){
                                    return row.item_code;
                                }
                            },
                            {
                                "targets": 4,
                                "render": function(data, type, row, meta){
                                    return row.customer_po;
                                }
                            },
                            {
                                "targets": 5,
                                "render": function(data, type, row, meta){
                                    return row.item_code;
                                }
                            },
                            {
                                "targets": 6,
                                render: function(data, type, row, meta){
                                    return row.attribute_number_gsm;
                                }
                            },
                            {
                                "targets": 7,
                                render: function(data, type, row, meta){
                                    return row.attribute_number_w;
                                }
                            },
                            {
                                "targets": 8,
                                "render": function(data, type, row, index){
                                    return row.attribute_char2;
                                }
                            },
                            {
                                "targets": 9,
                                "render": function(data, type, row, index){
                                    return row.attribute_int1;
                                }
                            },
                        ]
                        , responsive: false
                        , scrollX: true
                        , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                                <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'

                        ,language: {
                            paginate: {
                                // remove previous & next text from pagination
                                previous: '&nbsp;'
                                , next: '&nbsp;'
                            }
                        }


                    })
                }
            });
        })
    </script>
@endpush

@extends('layouts.admin')
@push('script')
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/jquery-ui.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/charts/highchart/highcharts.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/charts/highchart/highcharts-3d.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/charts/highchart/exporting.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/charts/highchart/export-data.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/charts/highchart/accessibility.js') }}"></script>
@endpush
@section('content')
    <div class="card">
        <div class="card-header ">
            <h6 class="card-title">
                <a href="{{ route('admin.prodplan.index') }}"
                    class="breadcrumbs__item">{{ trans('cruds.planning.manufacture') }} </a>
                <a href="{{ route('admin.prodplan.index') }}" class="breadcrumbs__item">{{ trans('cruds.planning.title') }}
                </a>
            </h6>
            <form action="{{ route('admin.work-order.store') }}" method="POST" enctype="multipart/form-data"
                class="form-horizontal" novalidate>
                {{ csrf_field() }}
                <div class="d-flex justify-content-center bd-highlight inline">
                    <div class="p-25 mt-50 bd-highlight " style="margin-top: 0.5%;font-weight: bold;">
                        Plan Date:
                    </div>
                    <div class="p-50 bd-highlight">
                        <input type="text" id="datepicker" name="planning_date"
                            class="form-control text-center flatpickr-basic" value=" {{ date('Y-m-d') }}" required>
                    </div>
                    <div class="p-25">
                        <button type='submit' class="btn btn-secondary" Value='auto' name="action" autocomplete="off">
                            Import</button>
                    </div>
                </div>
            </form>

            @can('price_list_create')
                <div class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#orderData">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg></span>
                            {{ trans('global.add') }} {{ trans('cruds.planning.title') }}


                        </a>
                        {{-- <button type="button" style="margin-top: 8%;"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderData"> {{ trans('global.add') }} {{ trans('cruds.planning.title') }} </button> --}}
                    </div>
                </div>
            @endcan
        </div>

        <div class="card-body">
            <table id="planning" class=" table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.planning.fields.no') }}
                        </th>
                        <th>
                            {{ trans('cruds.planning.fields.plan_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.planning.fields.order_num') }}
                        </th>
                        <th>
                            {{ trans('cruds.planning.fields.po_num') }}
                        </th>
                        <th>
                            {{ trans('cruds.planning.fields.customer') }}
                        </th>
                        <th>
                            {{ trans('cruds.planning.fields.item') }}
                        </th>
                        <th>
                            {{ trans('cruds.planning.fields.gsm') }}
                        </th>
                        <th>
                            {{ trans('cruds.planning.fields.width') }}
                        </th>
                        <th>
                            {{ trans('cruds.planning.fields.qty') }}
                        </th>
                        <th>
                            {{ trans('cruds.planning.fields.opration') }}
                        </th>
                        <th>
                            {{ trans('cruds.planning.fields.complate_date') }}
                        </th>
                        <th>
                            {{ trans('global.status') }}
                        </th>
                        <th>
                            {{ trans('global.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            @include('admin.productionPlanning.detail')
        </div>

        <!-- Modal Cancel -->
        @include('admin.productionPlanning.orderData')
        @include('admin.productionPlanning.open')
        @include('admin.productionPlanning.chart')
        @include('admin.productionPlanning.filter')
        <!-- END Modal Cancel-->
    </div>
@endsection

@push('script')
    <script>
        $(document).on('click', '#detPlanning', function() {
            $('#table_008').DataTable().destroy();
            var value = $(this).data('sonumber');
            var linegroup = $(this).data('linegroup');

            var tableDt = $('#table_008').DataTable({
                "bServerSide": true,
                ajax: {
                    url: '{{ url('search/plnDet') }}',
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function(d) {
                        d.sonum = value;
                        d.linegroup = linegroup;
                        return d
                    }
                }

                ,
                info: false,
                paging: false,
                // displayLength: 10,
                searching: false,
                columns: [{
                    data: 'order_number',
                    className: "text-center"
                }, {
                    data: 'order_number'
                }, {
                    data: 'item'
                }, {
                    data: 'gsm',
                    class: "text-end"
                }, {
                    data: 'size',
                    class: "text-end"
                }, {
                    data: 'qty',
                    class: "text-end"
                }]
            })
        });
        $(document).on('click', '.planning_filter', function() {
            var item = $("#item").val();
            var opunit = $("#opunit").val();
            var status = $("#status").val();
            var min = $("#min").val();
            var max = $("#max").val();
            $('#filterplaning').modal('hide');
            $('#planning').DataTable().ajax.reload()
        });
        $(document).ready(function() {

            var table_planning = $('#planning').DataTable({
                "bServerSide": true,
                ajax: {
                    url: '{{ url("search/planning-report") }}',
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function(d) {
                        d.item = $("#item").val();
                        d.opunit = $("#opunit").val();
                        d.status = $("#status").val();
                        d.min = $("#min").val();
                        d.max = $("#max").val();
                        return d
                    }
                },
                responsive: false,
                scrollX: true,
                searching: true,
                dom: '<"card-header border-bottom"\
                                                <"head-label">\
                                                <"dt-action-buttons text-end">\
                                            >\
                                            <"d-flex justify-content-between row mt-1"\
                                                <"col-sm-12 col-md-7"Bl>\
                                                <"col-sm-12 col-md-2"f>\
                                                <"col-sm-12 col-md-2"p>\
                                            ti>',
                displayLength: 7,
                "lengthMenu": [
                    [7, 25, 50, -1],
                    [7, 25, 50, "All"]
                ],
                buttons: [{
                        extend: 'print',
                        text: feather.icons['printer'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Print',
                        className: '',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                    // , {
                    //     extend: 'csv'
                    //     , text: feather.icons['file-text'].toSvg({
                    //         class: 'font-small-4 me-50'
                    //     }) + 'Csv'
                    //     , className: ''
                    //     , exportOptions: {
                    //         columns: ':visible'
                    //     }
                    // }
                    , {
                        extend: 'excel',
                        text: feather.icons['file'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Excel',
                        className: '',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }, {
                        extend: 'pdf',
                        text: feather.icons['clipboard'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Pdf',
                        className: '',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }, {
                        extend: 'copy',
                        text: feather.icons['copy'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Copy',
                        className: '',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }, {
                        extend: 'colvis',
                        text: feather.icons['eye'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Colvis',
                        className: ''
                    }, {
                        text: feather.icons['bar-chart-2'].toSvg({
                            class: 'font-small-4 me-50 '
                        }) + 'Chart',
                        className: 'bg-info ',
                        action: function(e, node, config) {
                            $('#chart').modal('show');
                        }
                    }, {
                        text: feather.icons['filter'].toSvg({
                            class: 'font-small-4 me-50 '
                        }) + 'Filter',
                        className: 'btn-warning',
                        action: function(e, node, config) {
                            $('#filterplaning').modal('show');
                        }
                    }

                    ,
                ],
                columnDefs: [{
                    render: function(data, type, row, index) {
                        content = `
                        @can('price_list_edit')
                        <a class="" href="prodplan/${row.prod_planning_id}/edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1l1-4l9.5-9.5z"/></g></svg> </a>
                        <a id="detPlanning" data-sonumber="${row.order_number}" data-linegroup="${row.line_number}" data-bs-toggle="modal" data-bs-target="#demoModal"  style="font-size:11px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m12 16l4-4l-4-4m-4 4h8"/></g></svg>
                        </a>
                        @endcan
                        `;
                        return content;
                    },
                    targets: [12],
                    class: "text-center"
                }],
                columns: [{
                    data: 'id',
                    className: "text-center"
                }, {
                    data: 'planning_schedule',
                    class: "text-end"
                }, {
                    data: 'order_number'
                }, {
                    data: 'customer_po_number'
                }, {
                    data: 'customer_code'
                }, {
                    data: 'item_code',
                }, {
                    data: 'attribute_number_gsm',
                    class: 'text-end'
                }, {
                    data: 'attribute_number_w',
                    class: "text-end"
                }, {
                    data: 'ordered_quantity',
                    class: "text-end"
                }, {
                    data: 'operation_unit',
                    render: function(data, type, row) {
                        if (row.operation_unit == 'PM1') {
                            return '<span class="badge bg-pm1">PM 1</span>';
                        } else if (row.operation_unit == 'PM2') {
                            return '<span class="badge bg-pm2">PM 2</span>';
                        } else {
                            return '<span class="badge bg-pm3">PM 3</span>';
                        }
                    },
                    class: "text-center"
                }, {
                    data: 'completed_schedule',
                    class: "text-end"
                }, {
                    data: 'status',
                    render: function(data, type, row) {
                        if (row.status == 'Imported') {
                            return '<span class="badge bg-primary">Imported WO</span>';
                        } else if (row.status == 'Enter') {
                            return '<span class="badge bg-warning">Enter From SO</span>';
                        } else {
                            return '<span class="badge bg-danger"> - </span>';
                        }
                    },
                    class: "text-center"

                }],
                language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                },
            });

            function chartDatas(table_planning) {
                var counts = {};

                // Count the number of entries for each position
                table_planning
                    .column(9, {
                        search: 'applied'
                    })
                    .data()
                    .each(function(val) {
                        if (counts[val]) {
                            counts[val] += 1;
                        } else {
                            counts[val] = 1;
                        }
                    });

                // And map it to the format highcharts uses
                return $.map(counts, function(val, key) {
                    return {
                        name: key,
                        y: val,
                    };
                });
            }

            function sum(object) {
                var length = 0;
                const descriptor1 = object;

                var total = 0;
                descriptor1.forEach(item => {
                    total += item.y;
                });

                return total;
            };

            // Create the chart with initial data
            var container = $('#chart').on('shown.bs.modal', function(e) {
                var plan = chartDatas(table_planning);
                var keyes = sum(plan);
                // Object.keys(kuntul).forEach(key => {
                //     var isi = kuntul[key].name;
                // });
                var chart = Highcharts.chart(container[0], {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        align: 'left',
                        text: 'Production Planning per PM Percentage',
                    },
                    subtitle: {
                        text: 'Total : '+keyes+' Production Plan</a>',
                        align: 'left',
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{series.y}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                style: { lineHeight: '12px', fontSize: '12px' }
                            }
                        }
                    },
                    series: [{
                        data: plan,
                        colorByPoint: true,
                    }, ],
                });

                // On each draw, update the data in the chart
                table_planning.on('draw', function() {
                    chart.series[0].setData(chartDatas(table_planning));
                });


                // console.log(color1, color2, color3);
                var color = Highcharts.setOptions({
                    // if(name =='PM 1'){
                    //     colors: ['#483D8B']
                    // },elseif(key=='PM 2'){
                    //     colors: ['#ED561B']
                    // },{
                    //     colors :['#8B483D']
                    // }

                });

            });

            var table_order = $('#order-summary').DataTable({
                "bServerSide": true,
                ajax: {
                    url: '{{ url('search/order-summary') }}',
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function(d) {
                        return d
                    }
                },
                responsive: false,
                searching: true,
                dom: '<"card-header border-bottom"\
                                                <"head-label">\
                                                <"dt-action-buttons text-end">\
                                            >\
                                            <"d-flex justify-content-between row mt-1"\
                                                <"col-sm-12 col-md-8"Bl>\
                                                <"col-sm-12 col-md-2"f>\
                                                <"col-sm-12 col-md-2"p>\
                                            t>',
                displayLength: 7,
                "lengthMenu": [
                    [7, 25, 50, -1],
                    [7, 25, 50, "All"]
                ],
                buttons: [{
                        extend: 'print',
                        text: feather.icons['printer'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Print',
                        className: '',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }, {
                        extend: 'csv',
                        text: feather.icons['file-text'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Csv',
                        className: '',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }, {
                        extend: 'excel',
                        text: feather.icons['file'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Excel',
                        className: '',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }, {
                        extend: 'pdf',
                        text: feather.icons['clipboard'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Pdf',
                        className: '',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }, {
                        extend: 'copy',
                        text: feather.icons['copy'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Copy',
                        className: '',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }, {
                        extend: 'colvis',
                        text: feather.icons['eye'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Colvis',
                        className: ''
                    },
                    // {
                    //     text: feather.icons['filter'].toSvg({
                    //         class: 'font-small-4 me-50 '
                    //     }) + 'Filter'
                    //     , className: 'btn-warning'
                    //     , action: function(e, node, config) {
                    //         $('#modalFilter').modal('show')
                    //     }
                    // , }
                    {
                        text: feather.icons['refresh-cw'].toSvg({
                            class: 'font-small-4 me-50 '
                        }) + 'Refresh',
                        className: 'btn-secondary',
                        action: function(e, node, config) {
                            var dtable = $('#order-summary').DataTable();
                            dtable.ajax.reload();
                            console.log('masuk');
                        },
                    },
                ],
                columns: [{
                    data: 'id',
                    className: "text-center"
                }, {
                    data: 'order_number'
                }, {
                    data: 'customer_name'
                }, {
                    data: 'cust_po_number'
                }, {
                    data: 'schedule_ship_date'
                }, {
                    data: 'item_code'
                }, {
                    data: 'gsm'
                }, {
                    data: 'width'
                }, {
                    data: 'ordered_quantity',
                    class: 'text-end'
                }, {
                    data: 'opration',
                    render: function(data, type, row) {
                        if (row.opration == 'PM1') {
                            return '<span class="badge bg-pm1">PM 1</span>';
                        } else if (row.opration == 'PM2') {
                            return '<span class="badge bg-pm2">PM 2</span>';
                        } else if (row.opration == 'PM3') {
                            return '<span class="badge bg-pm3">PM 3</span>';
                        } else {
                            return '<span class="badge bg-danger">Unknown</span>';
                        }
                    },
                }, {
                    data: 'roll'
                }],
                language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                }
            });
        });
    </script>
@endpush

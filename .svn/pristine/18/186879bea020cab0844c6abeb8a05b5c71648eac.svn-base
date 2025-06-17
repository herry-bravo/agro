@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
@endsection
@push('script')
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/charts/highchart/highcharts.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/charts/highchart/highcharts-3d.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/charts/highchart/exporting.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/charts/highchart/export-data.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/charts/highchart/accessibility.js') }}"></script>
@endpush

@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header ">
                    <h6 class="card-title ">
                        <a href="{{ route('admin.salesorder.index') }}"
                            class="breadcrumbs__item">{{ trans('cruds.OrderManagement.title') }} </a>
                        <a href="{{ route('admin.salesorder.index') }}"
                            class="breadcrumbs__item">{{ trans('cruds.OrderManagement.title_singular') }} </a>
                    </h6>
                    @can('price_list_create')
                        <div class="row">
                            <div class="col-lg-12">
                                <a class="btn btn-primary" href="{{ route('admin.salesorder.create') }}">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg></span>
                                    {{ trans('global.add') }} {{ trans('cruds.order.title') }}
                                </a>
                            </div>
                        </div>
                    @endcan
                </div>
                <div class="card-body">
                    <table id="salesindex" class=" table table-bordered table-striped table-hover w-100">
                        <thead>
                            <tr>
                                <th width="10">
                                </th>
                                <th>
                                    {{ trans('cruds.order.fields.order_number') }}
                                </th>
                                <th>
                                    Customer PO
                                </th>
                                <th>
                                    {{ trans('cruds.order.fields.customer_name') }}
                                </th>
                                <th>
                                    ShipTo
                                </th>
                                <th>
                                    Currency
                                </th>
                                <th>
                                    {{ trans('cruds.order.fields.order_date') }}
                                </th>
                                <th class="text-center">
                                    {{ trans('cruds.order.fields.status') }}
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                @include('admin.sales.chart')
                @include('admin.sales.filter')
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $(document).on('click', '.sales_filter', function() {
            var cust = $("#cust").val();
            var status = $("#status").val();
            var min = $("#min").val();
            var max = $("#max").val();

            $('#filtersales').modal('hide');
            $('#salesindex').DataTable().ajax.reload()
        });
        $(document).ready(function() {
            var table_sales = $('#salesindex').DataTable({
                "bServerSide": true,
                ajax: {
                    url: '{{ url('search/sales-data') }}',
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function(d) {
                        d.cust = $("#cust").val();
                        d.status = $("#status").val();
                        d.min = $("#min").val();
                        d.max = $("#max").val();
                        return d
                    }
                },
                responsive: false,
                scrollY: true,
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
                displayLength: 20,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
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
                    },
                    {
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
                    },
                    {
                        extend: 'colvis',
                        text: feather.icons['eye'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Colvis',
                        className: '',
                    },
                    {
                        text: feather.icons['bar-chart-2'].toSvg({
                            class: 'font-small-4 me-50 '
                        }) + 'Chart',
                        className: 'bg-info ',
                        action: function(e, node, config) {
                            $('#chart').modal('show');
                        }
                    },
                    {
                        text: feather.icons['filter'].toSvg({
                            class: 'font-small-4 me-50 '
                        }) + 'Filter',
                        className: 'btn-warning',
                        action: function(e, node, config) {
                            $('#filtersales').modal('show');
                        }
                    }

                ],
                columnDefs: [{
                        render: function(data, type, row, index) {
                            var info = table_sales.page.info();
                            return index.row + info.start + 1;
                        },
                        targets: [0]
                    },
                    {
                        render: function(data, type, row, index) {
                            content = `
                        @can('price_list_edit')
                        <a class=" badge btn  btn-sm btn-info" href="salesorder/${row.header_id}/edit">
                            {{ trans('global.open') }}
                        </a>
                        @endcan
                        @can('order_delete')
                        <button type="button" class=" badge btn btn-delete btn-accent btn-danger m-btn--pill btn-sm m-btn m-btn--custom" data-index="${row.header_id}">{{ trans('global.delete') }}</button>
                        @endcan
                        `;
                            return content;
                        },
                        targets: [8]
                    }
                ],
                columns: [{
                    data: 'id',
                    className: "text-center"
                }, {
                    data: 'order_number'
                }, {
                    data: 'customer_po'
                }, {
                    data: 'customer_name'
                }, {
                    data: 'shipto'
                }, {
                    data: 'currency',
                    class: 'text-center'
                }, {
                    data: 'ordered_date',
                    class: 'text-end'
                }, {
                    data: 'status',
                    class: 'text-center'
                }, {
                    data: 'action',
                    class: 'text-center'
                }],
                language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                }
            });



            function chartDatas(table_sales) {
                var counts = {};

                // Count the number of entries for each position
                table_sales
                    .column(3, {
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

            function chartDetail(table_sales) {
                var counts = {};

                // Count the number of entries for each position
                table_sales
                    .column(7, {
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
                var sales = chartDatas(table_sales);
                var sales_detail = chartDetail(table_sales);
                var keyes = sum(sales);

                console.log();
                var chart = Highcharts.chart(container[0], {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 45
                        }
                    },
                    title: {
                        align: 'left',
                        text: 'Sales Order by Customer Percentage',
                    },
                    subtitle: {
                        text: 'Total : ' + keyes + ' Sales Order</a>',
                        align: 'left',
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{series.y}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            innerSize: 100,
                            depth: 45,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                style: {
                                    lineHeight: '12px',
                                    fontSize: '12px'
                                }
                            }
                        }
                    },
                    series: [{
                        data: sales,
                        colorByPoint: true,
                    }, ],
                });

                // On each draw, update the data in the chart
                table_sales.on('draw', function() {
                    chart.series[0].setData(chartDatas(table_sales));
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
        });
    </script>
@endpush

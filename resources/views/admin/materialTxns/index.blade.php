@extends('layouts.admin')
@push('script')
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js') }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
@endpush
@section('content')
<div class="card">
    <div class="card-header mt-2 mb-2 ml-1">
        <h6 class="card-title ">
            <a href="{{ route("admin.material-txns.index") }}" class="breadcrumbs__item">{{ trans('cruds.trx.fields.inv') }} </a>
            <a href="#" class="breadcrumbs__item">{{ trans('cruds.trx.title') }} </a>
        </h6>
    </div>
    <div class="card-body">
        <table id="table-mtl-trx" class=" table table-striped display " style="width:190%" data-source="data-source">
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        {{ trans('cruds.trx.fields.item') }}
                    </th>
                    <th>
                        {{ trans('cruds.trx.fields.description') }}
                    </th>
                    <th>
                        SubInventory
                    </th>
                    <th class="text-center">
                        ToSubInventory
                    </th>
                    <th class="text-center">
                        TransactionQTY
                    </th>
                    <th class="text-center">
                        {{ trans('cruds.trx.fields.transaction_uom') }}
                    </th>
                    <th class="text-center">
                        PRIMARYQTY
                    </th>
                    <th class="text-center">
                        {{ trans('cruds.trx.fields.base_uom') }}
                    </th>
                    <th class="text-center">
                        Reference
                    </th>
                    <th class="text-center">
                        Document
                    </th>
                    <th class="text-center">
                        Attribute
                    </th>
                    <th class="text-end">
                        {{ trans('cruds.trx.fields.transaction_cost') }}
                    </th>
                    <th>
                        Date
                    </th>
                    <th style="text-align: center;">
                        Resource
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>

            </tfoot>
        </table>

    </div>
</div>
<!-- Start Modal GRN -->
<form action="#">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Filter</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
</form>
<!-- END  Modal GRN -->
@endsection
@push('script')
<script>
    $(document).ready(function() {
        //  $.fn.dataTable.ext.errMode = 'none';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#table-mtl-trx').DataTable({
            "bServerSide": true
            , ajax: {
                url: '{{url("search/mtl-trx-report") }}'
                , type: "GET"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    return d
                }
            }
            , responsive: false
            , scrollX: true
            , searching: true
            , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                    <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-7"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
            , displayLength: 15
            , "lengthMenu": [
                    [10, 25, 50, -1]
                    , [10, 25, 50, "All"]
                ]

            , columnDefs: [{

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                    , targets: [0]
                }, {
                    width: 200
                    , targets: 2
                }

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
                    , customize: function(win) {
                        $(win.document.body)
                            .css('font-size', '10pt')


                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', '10pt');
                    }
                    , header: true
                    , title: '<i>Internal</i> Surat Jalan</br> '
                    , orientation: 'landscape'
                }, {
                    extend: 'csv'
                    , text: feather.icons['file-text'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Csv'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'excel'
                    , text: feather.icons['file'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Excel'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'pdf'
                    , text: feather.icons['clipboard'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Pdf'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'copy'
                    , text: feather.icons['copy'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Copy'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'colvis'
                    , text: feather.icons['eye'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Colvis'
                    , className: ''
                }
                , {
                    text: feather.icons['bar-chart-2'].toSvg({
                        class: 'font-small-4 me-50 '
                    }) + 'Chart'
                    , className: 'btn-primary'
                    , action: function(e, node, config) {
                        $('#myModal').modal('show')
                    }
                , }
            , ]
            , columnDefs: [{
                render: function(data, type, row, index) {
                    var info = table.page.info();
                    return index.row + info.start + 1;
                }
                , targets: [0]
            }, {
                render: function(data, type, row, index) {
                    return type === 'display' && data.length > 20 ?
                        '<span id="outer" title="' + data + '">' + data.substr(0, 20) + '</span><span id="show"> ...</span>' :
                        data;
                }
                , targets: [2]
            }]
            , columns: [{
                data: 'id'
                , className: "text-center"
            , }, {
                data: 'item_code'
                , className: "text-start"
            }, {
                data: 'description'
                , className: "text-start"
            }, {
                data: 'subinventory_code'
                , className: "text-start"
            }, {
                data: 'transfer_subinventory'
                , className: "text-start"
            }, {
                data: 'transaction_quantity'
                , className: "text-end"
            }, {
                data: 'primary_uom_code'
                , className: "text-center"
            }, {
                data: 'primary_qty'
                , className: "text-end"
            }, {
                data: 'secondary_uom'
                , className: "text-center"
            }, {
                data: 'transaction_reference'
                , className: "text-start"
            }, {
                data: 'receiving_document'
                , className: "text-start"
            }, {
                data: 'attribute_category'
                , className: "text-start"
            }, {
                data: 'transaction_cost'
                , className: "text-end"
            }, {
                data: 'transaction_date'
                , className: "text-end"
            }, {
                data: 'transaction_source_name'
                , className: "text-start"
            }]
            , language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;'
                    , next: '&nbsp;'
                }
            }

        });

        // Create the chart with initial data
        var container = $('#myModal').on('shown.bs.modal', function(e) {

            var chart = Highcharts.chart(container[0], {
                chart: {
                    type: 'column'
                , }
                , title: {
                    align: 'left'
                    , text: 'Material Transaction'
                , }
                , xAxis: {
                    type: 'category'
                }
                , yAxis: {
                    title: {
                        text: 'Group by Material Trasaction'
                    }

                }
                , legend: {
                    enabled: true
                }
                , series: [{
                    data: chartData(table)
                , }, ]
            , });

            // On each draw, update the data in the chart
            table.on('draw', function() {
                chart.series[0].setData(chartData(table));
            });

        });
    });

    function chartData(table) {
        var counts = {};

        // console.log(table);
        // Count the number of entries for each position
        table
            .column(14, {
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
            // console.log(key, val);
            return {
                name: key
                , y: val
            , };
        });
    }

</script>
@endpush

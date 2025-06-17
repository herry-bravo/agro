@extends('layouts.admin')
@section('content')
@push('script')
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush
{{-- @section('breadcrumbs')
    <a href="" class="breadcrumbs__item">{{ trans('cruds.quality_management.title') }} </a>
    <a href="" class="breadcrumbs__item active">{{ trans('cruds.quality_management.material') }}</a>
@endsection --}}
@section('content')
@can('order_create')
@endcan
@section('content')
<div class="card">
    <div class="card-header">
        <h6 class="card-title">
            <a href="{{ route("admin.qm-finsihGood.index") }}" class="breadcrumbs__item">{{ trans('cruds.quality_management.title') }} </a>
            <a href="{{ route("admin.qm-finsihGood.index") }}" class="breadcrumbs__item"> {{ trans('cruds.quality_management.finish_good') }}</a>
        </h6>

        @can('role_create')
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaladd">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></span>
                        Finish Good Quality </a>
            </div>
        </div>
        @endcan
    </div>


    <div class="card-body">
        <div class="table-responsive">
            <table id="qm-finishGood" class="table table-striped " data-source="data-source">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.quality_management.fg.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.quality_management.fg.item') }}
                        </th>
                        <th>
                            {{ trans('cruds.quality_management.fg.roll') }}
                        </th>
                        <th>
                            {{ trans('cruds.quality_management.fg.PM') }}
                        </th>
                        <th>
                            {{ trans('cruds.quality_management.fg.gsm') }}
                        </th>
                        <th>
                            {{ trans('cruds.quality_management.fg.moizture') }}
                        </th>
                        <th>
                            {{ trans('cruds.quality_management.fg.thickness') }}
                        </th>
                        <th>
                            {{ trans('cruds.quality_management.fg.bursting') }}
                        </th>
                        <th>
                            {{ trans('cruds.quality_management.fg.ring') }}
                        </th>
                        <th>
                            {{ trans('cruds.quality_management.fg.ply') }}
                        </th>
                        <th>
                            {{ trans('cruds.quality_management.fg.cobbTop') }}
                        </th>
                        <th>
                            {{ trans('cruds.quality_management.fg.cobbBottom') }}
                        </th>
                        <th>
                            #
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>


    </div>
</div>
<form action="{{ route("admin.qm-finsihGood.create") }}" method="GET" enctype="multipart/form-data">
    @csrf
    <!-- Modal Example Start-->
    <div class="modal fade" id="modaladd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="control-label" for="number" required>Big Roll</label>
                            </div>
                            <div class="mb-3 col-md-8">
                                <select id="rpll" name="roll" class="form-control select2 filterMissExpense">
                                    <option selected></option>
                                        @foreach ($roll as $key => $row)
                                            <option value="{{$row->job_definition_name}}">{{$row->job_definition_name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i data-feather='plus'></i>Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection
@push('script')
<script>
    $(document).ready(function() {

        $('#qm-finishGood').DataTable({
            "bServerSide": true
            , ajax: {
                url: '{{url("search/qm_fg_report") }}'
                , type: "GET"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    return d
                }
            }
            , responsive: false
            , scrollY: true
            , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                    <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
            ,language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                }
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
                },
                {
                    render: function(data, type, row, index) {
                        content = `<a class="btn btn-sm btn-info" href="qm-finsihGood/${row.uniq_attribute_roll}/edit">
                                {{ trans('global.actions') }}
                                  </a>`;
                        return content;
                    }
                    , targets: [12]
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
            , columns: [{
                    data: 'id'
                    , className: "text-center"
                }
                ,{
                    data: 'inventory_item_id'
                    , className: "text-center"
                }
                , {
                    data: 'uniq_attribute_roll'
                },  {
                    data: 'attribute_char'
                    , className: "text-end"
                },{
                    data: 'gsm'
                }, {
                    data: 'mois'
                }, {
                    data: 'thick'
                    , className: "text-end"
                }, {
                    data: 'bursting'
                    , className: "text-end"
                }, {
                    data: 'ring'
                    , className: "text-end"
                }, {
                    data: 'ply'
                    , className: "text-end"
                }, {
                    data: 'cobbTop'
                    , className: "text-end"
                }, {
                    data: 'cobbBottom'
                    , className: "text-end"
                },
            ]

        });

    });

</script>
@endpush

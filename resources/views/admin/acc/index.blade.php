@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush
@section('content')
@can('order_create')
@endcan
<div class="card">
    <div class="card-header">
        <h6 class="card-title">
            <a href="" class="breadcrumbs__item">Setting </a>
            <a href="{{ route("admin.accountCode.index") }}" class="breadcrumbs__item">  {{ trans('cruds.coa.title_singular') }} </a>
        </h6>
        @can('role_create')
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route("admin.accountCode.create") }}" style="margin-top: 8%;">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></span>
                    {{ trans('global.add') }} {{ trans('cruds.coa.title_singular') }}
                </a>
            </div>
        </div>
        @endcan

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="acc_table" class=" table table-striped " data-source="data-source">
                <thead>
                    <tr>
                        <th class="text-center">
                            {{ trans('cruds.client.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.coa.fields.parent') }}
                        </th>
                        <th>
                            {{ trans('cruds.coa.fields.code') }}
                        </th>
                        <th>
                            {{ trans('cruds.coa.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.coa.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.coa.fields.level') }}
                        </th>
                        <th>
                            {{ trans('cruds.itemMaster.fields.creation_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.itemMaster.fields.updated_at') }}
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
        @include('admin.acc.editModal')
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.fn.dataTable.ext.errMode = 'none';
        var opval = $(this).val();
        var id = '';
        table = $('#acc_table').DataTable({

            "bServerSide": true
            , ajax: {
                url: '{{url("search/acc-code") }}'
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    return d
                }
            }
            , responsive: true
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
            }
            , displayLength: 15
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
                        content = '<button type="button" class="btn btn-edit btn-warning m-btn--pill btn-sm m-btn m-btn--custom" data-index="' + index.row + '"><i class="m-nav__link-icon fa fa-pencil"></i>Edit</button>';;
                        return content;
                    }
                    , targets: [8]
                }
            , ]
            , columns: [{
                    data: 'id'
                    , className: "text-center"
                }
                , {
                    data: 'parent_code'
                }
                , {
                    data: 'account_code'
                }
                , {
                    data: 'description',
                    createdCell: function(cell, data, rowData, rowIndex, colIndex) {
                        // Cek apakah level == 2
                        if (rowData.level == 2) {
                            // Tambahkan 2 &nbsp; di depan description jika level == 2
                            $(cell).html('&nbsp;&nbsp;&nbsp;' + data);
                        } else if (rowData.level == 3) {
                            // Tambahkan 3 &nbsp; di depan description jika level == 3
                            $(cell).html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + data);
                        }else if (rowData.level == 4) {
                            // Tambahkan 3 &nbsp; di depan description jika level == 3
                            $(cell).html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + data);
                        } else if (rowData.level == 5) {
                            // Tambahkan 3 &nbsp; di depan description jika level == 3
                            $(cell).html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + data);
                        } else {
                            // Jika level != 2, tambahkan 1 &nbsp;
                            $(cell).html(data);
                        }
                    }
                }
                , {
                    data: 'type'
                    , className: "text-center"
                }
                , {
                    data: 'level'
                    , className: "text-center"
                }
                , {
                    data: 'created_at'
                    , className: "text-center"
                }
                , {
                    data: 'updated_at'
                    , className: "text-center"
                }
                , {
                    data: ""
                    , className: "text-center"

                }
            ]
            , drawCallback: function(e, response) {
                $(".btn-edit").click(function(event) {
                    var index = $(this).data('index');
                    var data = table.row(index).data();
                    id = data.id;
                    $("input[name=description]").val(data.description);
                    $("input[name=parent_code]").val(data.parent_code);
                    $("input[name=account_code]").val(data.account_code);
                    $("input[name=type]").val(data.type);
                    $("input[name=level]").val(data.level);
                    $("input[name=account_group]").val(data.account_group);
                    $("input[name=id]").val(data.id);
                    $('#modalForm').modal('show');
                });
            }
            , destroy: true
        })


        $("#formData").submit(function(e) {
            e.preventDefault();
            var btn = $("#btnSave");
            btn.text('Processing...').attr('disabled', true);
            var postData = new FormData($('#formData')[0]);
            $.ajax({
                    url: '{{url("admin/accountCode")}}/' + id
                    , method: 'POST'
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , data: postData
                    , processData: false
                    , cache: false
                    , contentType: false
                    , dataType: 'json'
                })
                .done(function(resp) {
                    if (resp.success) {
                        $("#modalForm").modal("hide");
                        swal.fire("Info", resp.message, "success");
                        table.ajax.reload();
                    } else {
                        swal.fire("Warning", resp.message, "warning");
                    }
                })
                .fail(function() {
                    swal.fire("Warning", 'Unable to process request at this moment', "warning");
                })
                .always(function() {
                    btn.text('Simpan');
                    btn.attr('disabled', false);
                });
        })
    });

</script>
@endpush

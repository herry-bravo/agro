@extends('layouts.admin')
@section('content')
@push('script')
<style>
    .mdlRows {
        background-color: #a4a9af !important;
        border-color: #a9aeb4 !important;
        color: #fff9f9 !important;
    }

</style>
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
@endpush
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">
                        <a href="{{route('admin.shipment.index')}}" class="breadcrumbs__item">{{ trans('cruds.OrderManagement.title') }} </a>
                        <a href="{{route('admin.shipment.index')}}" class="breadcrumbs__item">{{ trans('cruds.shiping.title_singular') }} </a>
                        <a href="{{route('admin.shipment.create')}}" class="breadcrumbs__item">Edit</a>
                    </h6>
                </div>
                <hr>
                <br>
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <form id="formship" action="{{ route('admin.shipment.update', $DeliveryHeader->delivery_id) }}" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group ">
                                        <div class="form-group row">
                                            <div class="col-md-5">
                                                <div class="mb-2">
                                                    <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.customer_name') }}</label>
                                                    @if ($DeliveryHeader->lvl == 6)
                                                    <select type="text" id="customer" name="customer" class="form-control select2" value="{{ $DeliveryHeader->sold_to_party_id }}" required>
                                                        <option value="{{ $DeliveryHeader->id }}">{{ $DeliveryHeader->cust_party_code }}
                                                            -{{ $DeliveryHeader->party_name }} </option>
                                                    </select>
                                                    @else
                                                    <select disabled type="text" id="customer" name="customer" class="form-control select2" value="{{ $DeliveryHeader->sold_to_party_id }}" required>
                                                        <option value="{{ $DeliveryHeader->id }}">{{ $DeliveryHeader->cust_party_code }}
                                                            -{{ $DeliveryHeader->party_name }} </option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="mb-2">
                                                    <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.customer_shipto') }}</label>
                                                    @if ($DeliveryHeader->lvl == 6)
                                                    <select type="text" id="customer_shipto" name="customer_shipto" class="form-control select2" value="{{ $DeliveryHeader->ship_to_party_id }}" required>
                                                        @foreach ($customershiipto as $row)
                                                        <option value="{{ $row->site_code }}" {{ $DeliveryHeader->ship_to_party_id == $row->site_code ? 'selected' : '' }}>
                                                            {{ $row->site_code }} / {{ $row->address1 }}</option>
                                                        @endforeach
                                                    </select>
                                                    @else
                                                    <select disabled type="text" id="customer_shipto" name="customer_shipto" class="form-control select2" value="{{ $DeliveryHeader->ship_to_party_id }}" required>
                                                        @foreach ($customershiipto as $row)
                                                        <option value="{{ $row->site_code }}" {{ $DeliveryHeader->ship_to_party_id == $row->site_code ? 'selected' : '' }}>
                                                            {{ $row->site_code }} / {{ $row->address1 }}</option>
                                                        @endforeach
                                                    </select>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mb-2">
                                                    <label class="form-label" for="segment1">Attribute</label>
                                                    <input type="text" class="form-control" name="text" value="{{$DeliveryHeader->attribute1}}" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <div class="mb-2">
                                                    <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.surat_jalan') }}</label>
                                                    @if ($DeliveryHeader->lvl == 6)
                                                    <input autocomplete="off" required id="invoice_no" name="invoice_no" class="form-control" value="{{$DeliveryHeader->delivery_name }}" required>
                                                    @else
                                                    <input readonly required id="invoice_no" name="invoice_no" class="form-control" value="{{$DeliveryHeader->delivery_name }}">
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-2">
                                                    <div class="mb-2">
                                                        <label class="form-label"
                                                            for="segment1">{{ trans('cruds.shiping.fields.order_letter_no') }}</label> --}}
                                            <input readonly="readonly" type="hidden" id="delivery_name" name="delivery_name" class="form-control text-end" value="{{ $DeliveryHeader->delivery_name }}">
                                            <input type="hidden" id="id" name="id" value="{{ $DeliveryHeader->id }}">
                                            <input type="hidden" id="delivery_id" name="delivery_id" value="{{ $DeliveryHeader->delivery_id }}">
                                            {{-- </div>
                                                </div> --}}
                                            <div class="col-md-2">
                                                <div class="mb-2">
                                                    <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.note') }}</label>
                                                    @if ($DeliveryHeader->lvl == 6)
                                                    <input autocomplete="off" required type="text" id="note" name="note" class="form-control" value="{{ $DeliveryHeader->attribute2 }}" required>
                                                    @else
                                                    <input readonly required type="text" id="note" name="note" class="form-control" value="{{ $DeliveryHeader->attribute2 }}" required>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mb-2">
                                                    <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.invoice_date') }}</label>
                                                    <input autocomplete="off" type="date" id="invoice_date" name="invoice_date" class="form-control flatpickr-basic-custom flatpickr-input active text-end" value="{{ $DeliveryHeader->on_or_about_date }}" required>
                                                    
                                                    <!-- @if ($DeliveryHeader->lvl == 6)
                                                    <input autocomplete="off" type="text" id="invoice_date" name="invoice_date" class="form-control flatpickr-basic-custom flatpickr-input active text-end" value="{{ $DeliveryHeader->on_or_about_date }}" required>
                                                    @if ($errors->has('on_or_about_date'))
                                                    <em class="invalid-feedback">
                                                        {{ $errors->first('on_or_about_date') }}
                                                    </em>
                                                    @endif
                                                    @else
                                                    <input disabled type="text" id="datepicker-1" name="invoice_date" class="form-control datepicker text-end" value="{{ $DeliveryHeader->on_or_about_date->format('d-M-Y')}}" required>
                                                    @if ($errors->has('on_or_about_date'))
                                                    <em class="invalid-feedback">
                                                        {{ $errors->first('on_or_about_date') }}
                                                    </em>
                                                    @endif
                                                    @endif -->
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <label class="form-label" for="segment1">
                                                        Attribute
                                                    </label>
                                                    <input type="text" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mb-2">
                                                    <label class="form-label" for="segment1">
                                                        {{ trans('cruds.shiping.fields.status') }}
                                                    </label>
                                                    @if ($DeliveryHeader->lvl == 6)
                                                    <select type="text" id="status" name="status" class="form-control select2" value="{{ $DeliveryHeader->status_code }}" required>
                                                        <option value="{{ $DeliveryHeader->status_code }}">
                                                            {{ $DeliveryHeader->trx_name }}
                                                        </option>
                                                    </select>
                                                    @else
                                                    <select disabled type="text" id="status" name="status" class="form-control select2" value="{{ $DeliveryHeader->status_code }}" required>
                                                        <option value="{{ $DeliveryHeader->status_code }}}">
                                                            {{ $DeliveryHeader->trx_name }}
                                                        </option>
                                                    </select>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    </br>

                                    <div class="row mb-4">
                                        <div class="box box-default overflow-auto">
                                            <div class="box-body" style="height: 350px;">
                                                <table class="table table-bordered table-striped table-hover  w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>{{ trans('cruds.shiping.table.sn') }}</th>
                                                            <th>{{ trans('cruds.shiping.table.custpo') }}</th>
                                                            <th>{{ trans('cruds.shiping.table.item_desc') }}</th>
                                                            <th class="text-end">{{ trans('cruds.shiping.modaltable.qty') }}</th>
                                                            <!-- <th class='text-center'> ID Product </th> -->
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($DeliveryDetail as $key =>$row)
                                                        @if ($row->delivery_detail_id == $DeliveryHeader->delivery_id)
                                                        <tr>
                                                           
                                                            <td>{{ $no++ }}</td>
                                                            <td class="text-center" style="width: 10%">
                                                                {{ $row->source_header_number ?? '' }}
                                                            </td>
                                                            <td style="width: 20%">
                                                                {{ $row->cust_po_number ?? '' }}
                                                            </td>

                                                            <td>
                                                                {{ $row->item_description ?? '' }}
                                                            </td>
                                                            <td class="text-end" style="width: 0%">
                                                                {{ (float)$row->requested_quantity ?? '' }}
                                                            </td>
                                                            <!-- <td style="width: 10%" class="text-center">
                                                                <a class="btn btn-sm addRollID btn-secondary mdlRows" id='addRollID' data-bs-toggle="modal" data-bs-target="#modalRoll" value="{{$row->id}}" data-header="{{$DeliveryHeader->delivery_id}}" data-id="{{ $row->id }}" data-sales="{{$row->source_header_number}}">
                                                                    Add ID +
                                                                    <input type="hidden" value="{{$row->id}}" name="" id="LinesID">
                                                                </a>
                                                            </td> -->
                                                            <!-- <td style="width: 2%">
                                                                @if ($DeliveryHeader->lvl == 6)
                                                                <button type="button" class="btn  btn-ligth btn-sm btn-delete" data-bs-toggle="modal" data-bs-target="#modaldelete" value="{{$row->id}}" data-id="{{$row->id}}" data-header_id="{{$row->source_header_id}}" data-line_id="{{$row->source_line_id}}">
                                                                    X
                                                                </button>
                                                                @else
                                                                <button type="button" class="btn btn-ligth btn-sm" value="{{$row->id}}" data-id="{{$row->id}}" data-header_id="{{$row->source_header_id}}" data-line_id="{{$row->source_line_id}}">
                                                                    X
                                                                </button>
                                                                @endif
                                                            </td> -->
                                                           
                                                        </tr>
                                                        @endif
                                                        @endforeach
                                                    </tbody>

                                                    <tfoot>
                                                        <div class="d-flex justify-content-between">

                                                        </div>
                                                    </tfoot>
                                                </table>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        @if ($DeliveryHeader->lvl == 6)
                                        <div></div>
                                        <button class="btn btn-primary btn-submit" name='action' value="edit" id="add_all" type="submit"><i data-feather='save'></i> {{ trans('global.save') }}
                                        </button>
                                        @endif
                                    </div>
                            </form>
                            <div class="modal fade" id="modaldelete" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title text-white">{{ trans('cruds.shiping.modaltable.deleteitem') }}</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form id="formship" action="{{ route('admin.shipment.update', $DeliveryHeader->delivery_id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="container">
                                                    <p class="text-center">{{ trans('cruds.shiping.modaltable.areyousure') }}</p>
                                                    <hr>
                                                    <div class="col text-center">
                                                        <button type="submit" name="action" value="delete" class="btn btn-primary pull-center"><i class="fa fa-plus"></i> {{ trans('cruds.shiping.modaltable.yes') }} </button>
                                                        <input type="hidden" id="id" name="id" class="form-control">
                                                        <input type="hidden" id="header_id" name="header_id" class="form-control">
                                                        <input type="hidden" id="line_id" name="line_id" class="form-control">

                                                        <button type="button" class="btn btn-danger pull-center" data-bs-dismiss="modal"><i class="fa fa-plus"></i> {{ trans('cruds.shiping.modaltable.no') }} </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modalRoll" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title text-white">Add Detail ID</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <hr>
                                            <br>
                                            <form id="formship" action="" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <select type="text" name="mainMenuSelect[]" data-dropdown="true" data-tags="true" id="mainMenuSelect" class="form-control select2 form-control-sm" multiple="multiple" autocomplete="off" placeholder="RollID">
                                                            </select>
                                                            <input type="hidden" name='IDDlvy' id="IDDlvy" class="form-control">
                                                            <input type="hidden" name='HDDlvy' id="HDDlvy" class="form-control">
                                                            <input type="hidden" name='SLSNum' id="SLSNum" class="form-control">
                                                        </div>
                                                        <div class=" col-sm-12 float-right">
                                                            <div class="d-flex justify-content-between mb-50 mt-1">
                                                                <button type="reset" class="btn btn-warning">Reset</button>
                                                                <button name="save-details" id="btnSave" class="btn  btn-primary bkgrnd-cyan save-details" style="  margin-top: 4px;" type="button">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </form>
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
<script>
    ///////////// DELETE BUTTON//////////////
    function deleteItem(id) {
        console.log(id);
        var check = confirm("Are you sure you want to Delete this row?");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (check == true) {
            console.log(check);
            $.ajax({
                url: "./../destroy/" + id
                , type: 'DELETE'
                , data: {
                    id: id
                , }
                , success: function(result) {
                    location.reload();
                    alert('Success');
                }
                , error: function(result) {
                    alert('Success');
                    location.reload();

                }
            });
        }
    }
    ///////////// DELETE BUTTON//////////////
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        , }
    });
    $(document).ready(function() {
        var MyApp = {};
        var idReturn = [];


        $(".sub_chk:checked").each(function() {
            idReturn.push($(this).attr('data-id'));
        });

        $('#detailitem').DataTable({
            dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-8'i><'col-sm-4'p>>",

        });
        ///////////// RESET BUTTON//////////////
        $(".resetbtn").click(function() {
            $("#formship").trigger("reset");
        });
        $('#masterckcbx').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
        });

        $(".addRollID").click(function() {

            $(".modal").on("hidden.bs.modal", function() {
                $(this).removeData();
            });
            var dlvyDetID = $(this).attr('data-id');
            var dlvyHDID = $(this).attr('data-header');
            var dlvySlsNum = $(this).attr('data-Sales');
            document.getElementById('IDDlvy').value = dlvyDetID;
            document.getElementById('HDDlvy').value = dlvyHDID;
            document.getElementById('SLSNum').value = dlvySlsNum;
            $.ajax({
                url: '{{url("search/getRollID") }}'
                , type: 'POST'
                , data: {
                    id: dlvyDetID,
                    sales: dlvySlsNum
                , }
                , success: function(result) {
                    var options = JSON.parse(result);
                    select = document.getElementById('mainMenuSelect');

                    options.forEach(function(option, i) {
                        console.log(option[i]);
                        select.options[i] = new Option(option.rollID, option.rollID);
                    })
                }

            })

        })

        $("#btnSave").click(function() {
            var RollID = $("#mainMenuSelect").val();
            var IDDlvy = $("#IDDlvy").val();
            var HDDlvy = $("#HDDlvy").val();
            $.ajax({
                url: '{{url("search/storeRollID") }}'
                , type: 'POST'
                , data: {
                    line_id: IDDlvy
                    , container_item_id: RollID
                    , header_id: HDDlvy
                , }
                , success: function(result) {
                    $("#modalRoll").modal("hide");
                    $("#modalRoll").removeData();
                    swal.fire("Info", result.message, "success");
                }
            })
        })
        $(".mdlRows").click(function() {
            var IDLines = $(this).attr('data-id');
            $.ajax({
                url: '{{url("search/RollDist") }}'
                , type: 'POST'
                , data: {
                    line_id: IDLines
                , }
                , success: function(result) {
                    $("#mainMenuSelect").val(result);
                    var element = document.getElementById('mainMenuSelect');
                    var values = result;
                    for (var i = 0; i < element.options.length; i++) {
                        element.options[100] = new Option(values[i], values[i]);
                    }
                }
            })
        })

    });

</script>
@endpush

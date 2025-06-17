@extends('layouts.admin')
@section('content')
    @push('script')
        <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
    @endpush
    @section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@section('breadcrumbs')
    <a href="{{ route('admin.home') }}" class="breadcrumbs__item">{{ trans('cruds.OrderManagement.title') }}</a>
    <a href="{{ route('admin.deliveries.index') }}"
        class="breadcrumbs__item">{{ trans('cruds.Delivery.title_singular') }}</a>
    <a href="#" class="breadcrumbs__item">{{ trans('cruds.Delivery.fields.fullfillment') }}</a>
@endsection
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-2">{{ trans('cruds.Delivery.fields.fullfillment') }}</h4>
    </div>
    <form id="formship"
        action="{{ route('admin.deliveries.update', $DeliveryHeader->id, $DeliveryHeader->delivery_id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <div class="form-group row">
                    <div class="col-md-3">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.Delivery.table.cname') }}</label>
                            <select disabled type="text" id="customer" name="customer" class="form-control select2"
                                value="{{ $DeliveryHeader->sold_to_party_id }}" required>
                                <option value="{{ $DeliveryHeader->id }}">{{ $DeliveryHeader->cust_party_code }}
                                    -{{ $DeliveryHeader->party_name }} </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <label class="form-label"
                                for="segment1">{{ trans('cruds.Delivery.table.shipto') }}</label>
                            <select disabled type="text" id="customer_shipto" name="customer_shipto"
                                class="form-control select2" value="{{ $DeliveryHeader->ship_to_party_id }}" required>
                                @foreach ($customershiipto as $row)
                                    <option
                                        value="{{ $row->id }}"{{ $DeliveryHeader->ship_to_party_id == $row->id ? 'selected' : '' }}>
                                        {{ $row->site_code }} / {{ $row->address1 }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-1">
                            <label class="form-label"
                                for="segment1">{{ trans('cruds.shiping.fields.note') }}</label>
                            <input readonly autocomplete="off" required type="text" id="note" name="note"
                                class="form-control" value="{{ $DeliveryHeader->attribute2 }}" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-1">
                            <label class="form-label" for="segment1">{{ trans('cruds.Delivery.table.dt') }}</label>
                            {{-- <input readonly type="date" id="invoice_date" name="invoice_date" class="form-control" value="{{ $DeliveryHeader->on_or_about_date }}"  required> --}}
                             <input readonly type="text" id="datepicker-1" name="invoice_date" value="{{$DeliveryHeader->on_or_about_date->format('d-M-Y')}}" class="form-control datepicker text-end" autocomplete="off" required>

                        </div>
                    </div>

                    {{-- <div class="col-md-2">
                        <div class="mb-1">
                            <label class="form-label"
                                for="segment1">{{ trans('cruds.Delivery.table.curenci') }}</label>
                            <select disabled type="text" id="currencies" name="currencies"
                                class="form-control select2" value="{{ $DeliveryHeader->currency_code }}" required>
                                <option value="{{ $DeliveryHeader->id }}">{{ $DeliveryHeader->currency_code }}
                                    -{{ $DeliveryHeader->currency_name }} </option>
                            </select>
                        </div>
                    </div> --}}


                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.Delivery.fields.sj') }}</label>
                            <input readonly required id="invoice_no" name="invoice_no" class="form-control"
                                value="{{ $DeliveryHeader->packing_slip_number }}" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-1">
                            <label class="form-label"
                                for="segment1">{{ trans('cruds.Delivery.table.no_barang') }}</label>
                            <input readonly="readonly" id="delivery_name" name="delivery_name" class="form-control"
                                value="{{ $DeliveryHeader->delivery_id }}">
                            <input type="hidden" id="id" name="id" value="{{ $DeliveryHeader->id }}">
                            <input type="hidden" id="delivery_id" name="delivery_id"
                                value="{{ $DeliveryHeader->delivery_id }}">
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="mb-1">
                            <label class="form-label"
                                for="segment1">{{ trans('cruds.shiping.fields.freight_term') }}</label>
                            <select disabled type="text" id="freight_term" name="freight_term"
                                class="form-control select2" value="{{ $DeliveryHeader->freight_terms_code }}"
                                required>
                                @foreach ($freight_terms as $row)
                                    <option
                                        value="{{ $row->id }}"{{ $DeliveryHeader->freight_terms_code == $row->id ? 'selected' : '' }}>
                                        {{ $row->term_code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-1">
                            <label class="form-label"
                                for="segment1">{{ trans('cruds.Delivery.table.status') }}</label>
                            <select disabled type="text" id="status" name="status" class="form-control select2"
                                value="{{ $DeliveryHeader->status_code }}" required>
                                <option value="{{ $DeliveryHeader->status_code }}}">{{ $DeliveryHeader->trx_name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="mb-1">
                            <label class="form-label"
                                for="segment1">{{ trans('cruds.Delivery.fields.acepdet') }}</label>
                            <input autocomplete="off" type="text" id="fp-default" name="accepted_date"  class="form-control flatpickr-basic flatpickr-input" required>
                        </div>
                    </div>
                    {{-- <div class="col-md-1">
                        <div class="mb-1">
                            <label class="form-label"
                                for="segment1">{{ trans('cruds.shiping.fields.gross_weight') }}</label>
                            <input readonly autocomplete="off" required type="number" id="gross_weight"
                                name="gross_weight" class="form-control" value="{{ $DeliveryHeader->gross_weight }}"
                                required>
                        </div>
                    </div> --}}
                </div>
            </div>

            <div class="row mb-4">
                <div class="box box-default overflow-auto">
                    <div class="box-body" style="height: 350px;">
                        <table class="table table-bordered table-striped table-hover" id="detailitem">
                            <thead>
                                <tr>
                                    <th >
                                        <input class="form-check-input" type="checkbox" style="width:1%px;"
                                            value="" id="masterckcbx" />
                                    </th>
                                    <th>NO</th>
                                    <th>{{ trans('cruds.shiping.table.sn') }}</th>
                                    <th>{{ trans('cruds.shiping.table.item_no')}}</th>
                                    <th>{{ trans('cruds.shiping.table.item_desc') }}</th>
                                    <th class="text-center" >{{ trans('cruds.shiping.modaltable.line') }}</th>
                                    <th class="text-center"> {{ trans('cruds.shiping.table.request_qty') }}</th>
                                    <th class="text-center"> {{ trans('cruds.shiping.table.ship_qty') }}</th>
                                    <th class="text-center">{{ trans('cruds.shiping.table.uom') }}</th>
                                    {{-- <th>
                                        &nbsp;
                                    </th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($DeliveryDetail as $row)
                                    @if ($row->delivery_detail_id == $DeliveryHeader->delivery_id)
                                        <tr>
                                            <td style="width: 0%">
                                                <input type="checkbox"name="ids[]" value="{{ $row->id }}"
                                                    class="form-check-input sub_chk" data-id="{{ $row->id }}">
                                                <input type="hidden" name="header[]"
                                                    value="{{ $row->source_header_id }}"
                                                    class="form-check-input sub_chk"data-id="{{ $row->source_header_id }}">
                                                <input type="hidden" name="line[]"
                                                    value="{{ $row->source_line_id }}"class="form-check-input sub_chk"data-id="{{ $row->source_line_id }}">
                                                <input type="hidden" name="checkid[]" value="{{ $row->id }}">

                                            </td>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->source_header_number ?? '' }}</td>
                                            <td>{{ $row->item_code ?? '' }}</td>
                                            <td>{{ $row->item_description ?? '' }}</td>
                                            <td class="text-center">{{ (float)$row->source_line_id ?? '' }}</td>
                                            <td class="text-center">{{ (float)$row->requested_quantity ?? '' }}</td>
                                            <td class="text-center" > <input type="number" name="fulfilled_quantity[]" min=1  oninput="validity.valid||(value='');" class="form-control text-center w-50 " style="background-color: #dcfdf2;"
                                                    value="{{ $row->shipped_quantity ?? '' }}"></td>
                                            <td style="width: 15%" class="text-center">{{ $row->requested_quantity_uom ?? '' }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-1">
                <div></div>
                @if ($DeliveryHeader->status_code==8)
                    <button class="btn btn-primary btn-submit add_all"name='action' value="fullfillment" id="add_all"
                    type="submit"><i data-feather='save'></i> {{ trans('global.save') }}</button>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection
@push('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    $(document).ready(function() {
        $('#detailitem').DataTable({
            paging:false,
            dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-8'i><'col-sm-4'p>>",
        });

        $('#masterckcbx').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
        });

        $('.add_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            console.log(allVals);
            if (allVals.length <= 0) {
                alert("Please select row.");

            } else {
                var check = alert("Add Row Success");
                if (check == true) {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'idss='+join_selected_values,
                        success: function(data) {
                            // alert(data['success']);
                        },
                        error: function(data) {
                            // alert(data.responseText);
                        }
                    });
                }
            }
        });
        $(document).on('confirm', function(e) {
            var ele = e.target;
            e.preventDefault();
            $.ajax({
                url: ele.href,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function(data) {
                    alert(data.responseText);
                }
            });
            return false;
        });
        ///////////// RESET BUTTON//////////////
        $(".resetbtn").click(function() {
            $("#formship").trigger("reset");
        });
        ///////////// RESET BUTTON//////////////
    });
</script>
@endpush


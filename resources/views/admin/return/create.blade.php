@extends('layouts.admin')
@section('styles')
@endsection
@push('script')
<!-- <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script> -->
@endpush
@section('content')
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header mt-1 mb-25">
                <h6 class="card-title">
                    <a href="{{ route("admin.return.index") }}" class="breadcrumbs__item">{{ trans('cruds.quotation.po') }} </a>
                    <a href="{{ route("admin.return.index") }}" class="breadcrumbs__item">Create</a>
                </h6>
            </div>
            <hr>
            <div class="card-body">
                <form action="{{ route("admin.return.store") }}" method="POST" enctype="multipart/form-data" class="form-horizontal create_purchase">
                    {{ csrf_field() }}
                    <div class="row mt-2 mb-1">
                        <div class="col-md-3">
                            <label class="col-sm-0 control-label" for="number">{{ trans('cruds.return.fields.transactiondate') }}</label>
                            <input type="date" id="datePicker" name="gl_date" class="form-control datepicker" value="" required>
                            <input type="hidden" hidden id="created_by" name="created_by" value="{{ auth()->user()->id }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="col-sm-0 control-label" for="number">{{ trans('cruds.return.fields.orderno') }}</label>
                            <select id="order" name="segment1" class="form-control select2 filterReturn">
                                <option selected></option>
                                @foreach ($order_head as $key => $row)
                                <option value="{{$row->segment1}}">{{$row->segment1}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="col-sm-0 control-label" for="site">{{ trans('cruds.return.fields.grn') }} </label>
                            <select id="grn" name="receipt_num" class="form-control select2 filterReturn">
                                <option selected></option>
                                @foreach ($return as $key => $row)
                                @if ($row->transaction_type == "RECEIVE")
                                <option value="{{$row->receipt_num}}">{{$row->receipt_num}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="col-sm-0 control-label" for="site">{{ trans('cruds.return.fields.item') }}</label>
                            <input type="text" id="item" class="form-control filterReturn" name="item_code" placeholder="items">
                            <input type="hidden" id="type_lookup_code" value='1' name="type_lookup_code">
                        </div>
                    </div>

                    <div class="box box-default">
                        <div class="table-responsive scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                            <table id="tableReturn" class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center"><input type="checkbox" class='form-check-input dt-checkboxes' id="head-cb"></th>
                                        <th class="text-center">Transaction Type</th>
                                        <th class="text-end">QTY</th>
                                        <th class="text-center">UOM</th>
                                        <th class="text-start">Purchase Item</th>
                                        <th class="text-end">Price</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-center">Location To</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table></br>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-1 mb-2">
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> {{ trans('global.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.content -->
@endsection

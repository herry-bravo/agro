@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush

@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header mt-2">
                    <h6 class="card-title">
                        <a href="{{ route("admin.category.index") }}" class="breadcrumbs__item">Category</a>
                        <a href="#" class="breadcrumbs__item">Create</a>
                    </h6>
                </div>
                <hr>
                <div class="card-body">
                    <form action="{{ route("admin.category.store") }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="mb-1">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="created_by" name="created_by" value="{{auth()->user()->id}}">
                                    <input type="hidden" id="status" name="status" value="1">
                                    <div class="form-group row">
                                        <label class="col-sm-1 control-label" for="number">{{ trans('cruds.category.fields.code') }}</label>

                                        <div class="col-sm-3 {{ $errors->get('category_code') ? 'has-error' : '' }}">
                                            <input type="text" class="form-control" name="category_code" maxlength="6">
                                            @foreach($errors->get('category_code') as $error)
                                            <span class="help-block">{{ $error }}</span>
                                            @endforeach
                                        </div>

                                        <label class="col-sm-1 control-label" for="number">{{ trans('cruds.category.fields.name') }}</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="category_name" maxlength="50">
                                        </div>

                                        <label class="col-sm-1 control-label" for="number">{{ trans('cruds.category.fields.description') }}</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="description" maxlength="50">
                                        </div>
                                    </div>
                                </div>

                                <div class=" form-group row">
                                    <label class="col-sm-1 control-label" for="number">Inventory</label>
                                    <div class="col-sm-3">
                                        <select name="inventory_account_code" id="inventory_account_code" class="form-control select2" required>
                                            <option value="0000000">00000000</option>
                                            @foreach($acc as $row)
                                            <option value="{{ $row->account_code }}  {{ in_array($row->account_code, old('account_code', [])) ? 'selected' : '' }}">{{$row->account_code}} {{$row->description}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('account_code'))
                                        <p class="help-block">
                                            {{ $errors->first('account_code') }}
                                        </p>
                                        @endif
                                        <p class="helper-block">
                                        </p>
                                    </div>
                                    <label class="col-sm-1 control-label" for="number">Payable</label>
                                    <div class="col-sm-3">
                                        <select name="payable_account_code" id="payable_account_code" class="form-control select2" required>
                                            <option value="0000000">00000000</option>
                                            @foreach($acc as $row)
                                            <option value="{{ $row->account_code }}  {{ in_array($row->account_code, old('account_code', [])) ? 'selected' : '' }}">{{$row->account_code}} {{$row->description}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('account_code'))
                                        <p class="help-block">
                                            {{ $errors->first('account_code') }}
                                        </p>
                                        @endif
                                        <p class="helper-block">
                                        </p>
                                    </div>
                                    <label class="col-sm-1 control-label" for="number">Receive</label>
                                    <div class="col-sm-3">
                                        <select name="receivable_account_code" id="receivable_account_code" class="form-control select2" required>
                                            <option value="0000000">00000000</option>
                                            @foreach($acc as $row)
                                            <option value="{{ $row->account_code }}  {{ in_array($row->account_code, old('account_code', [])) ? 'selected' : '' }}">{{$row->account_code}} {{$row->description}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('account_code'))
                                        <p class="help-block">
                                            {{ $errors->first('account_code') }}
                                        </p>
                                        @endif
                                        <p class="helper-block">
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-1 control-label" for="number">{{ trans('cruds.category.fields.salescode') }}</label>
                                    <div class="col-sm-3">
                                        <select name="attribute1" id="attribute1" class="form-control select2" required>
                                            <option value="0000000">00000000</option>
                                            @foreach($acc as $row)
                                            <option value="{{ $row->account_code }}  {{ in_array($row->account_code, old('account_code', [])) ? 'selected' : '' }}">{{$row->account_code}} {{$row->description}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('account_code'))
                                        <p class="help-block">
                                            {{ $errors->first('account_code') }}
                                        </p>
                                        @endif
                                        <p class="helper-block">
                                        </p>
                                    </div>
                                    <label class="col-sm-1 control-label" for="number">{{ trans('cruds.category.fields.cogscode') }}</label>
                                    <div class="col-sm-3">
                                        <select name="consumption_account_code" id="consumption_account_code" class="form-control select2" required>
                                            <option value="0000000">00000000</option>
                                            @foreach($acc as $row)
                                            <option value="{{ $row->account_code }}  {{ in_array($row->account_code, old('account_code', [])) ? 'selected' : '' }}">{{$row->account_code}} {{$row->description}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('account_code'))
                                        <p class="help-block">
                                            {{ $errors->first('account_code') }}
                                        </p>
                                        @endif
                                        <p class="helper-block">
                                        </p>
                                    </div>
                                    <label class="col-sm-1 control-label" for="number">{{ trans('cruds.category.fields.note') }}</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="account_type" class="form-control" name="Attribute2" placeholder="">
                                        <input type="hidden" class="form-control" name="Attribute2" value='{{Auth::user()->org_id}}' name='org_id' placeholder="">
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="d-flex justify-content-between mb-1 mt-1">
                                    <button type="reset" class="btn btn-danger pull-left">Reset</button>
                                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
                                </div>
                            </div>
                    </form> <!-- /.box-body -->
                </div>
            </div>
        </div>
</section>
<!-- /.content -->
@endsection

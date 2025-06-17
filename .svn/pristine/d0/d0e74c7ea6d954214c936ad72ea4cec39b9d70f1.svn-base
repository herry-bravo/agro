@extends('layouts.admin')
@section('content')
@section('breadcrumbs')
    <a href="#" class="breadcrumbs__item">Setting</a>
    <a href="#" class="breadcrumbs__item">Chart Of Account</a>
@endsection
<!-- Main content -->
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
				<div class="card-header">
                    <h4 class="card-title mb-2">COA</h4>
                </div>
                <hr>
                <div class="card-body">
                    <form action="{{ route("admin.accountCode.update", [$accountCode->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-1 col-md-4">
                                <label class="form-label" for="account_payable">{{ trans('cruds.coa.fields.parent') }}</label>
                                <select name="parent_code" id="parent_code" class="form-control select2"  required>
                                    <option hidden disabled selected>{{$accountCode ->parent_code}}</option>
                                        @foreach($parent as $key =>$row)
                                            <option value="{{$row->id}}"  {{old('parent_code') ? 'selected' : '' }}>	{{$row->parent_code}} </option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="mb-1 col-md-4">
                                <label class="form-label" for="account_receivable">{{ trans('cruds.coa.fields.code') }}</label>
                                <input type="text" name="account_receivable" value="{{ $accountCode->account_code }}" id="account_receivable" class="form-control" required/>
                            </div>
                            <div class="mb-1 col-md-4">
                                <label class="form-label" for="description">{{ trans('cruds.coa.fields.description') }}</label>
                                <input type="text" name="description" id="description" value="{{ $accountCode->description }}" class="form-control" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-1 col-md-4">
                                <label class="form-label" for="account_payable">{{ trans('cruds.coa.fields.parent') }}</label>
                                <select name="type" id="type" class="form-control select2"  required>
                                    <option hidden disabled selected></option>
                                    @if (($accountCode->type)== "p")
                                        <option selected value="P" >Parent</option>
                                        <option value="C" >Child</option>
                                    @else
                                        <option selected value="C" >Child</option>
                                        <option  value="P" >Parent</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mb-1 col-md-4">
                                <label class="form-label" for="account_receivable">{{ trans('cruds.coa.fields.level') }}</label>
                            <select name="level" id="type"class="form-control select2" required>
                                    <option hidden disabled selected value="{{ $accountCode->level }}">{{ $accountCode->level }}</option>
                                    <option value="1" >1</option>
                                    <option value="2" >2</option>
                                    <option value="3" >3</option>
                                    <option value="4" >4</option>
                                    <option value="5" >5</option>
                                </select>
                            </div>
                            <div class="mb-1 col-md-4">
                                <label class="form-label" for="account_inventory">{{ trans('cruds.coa.fields.group') }}</label>
                                <select name="gruop" id="type" class="form-control select2"  required>
                                    <option hidden disabled selected>{{ $accountCode->group }}</option>
                                            <option value="1" >BM(222)</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success pull-left btn-submit"><i data-feather='save'></i> {{ trans('global.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

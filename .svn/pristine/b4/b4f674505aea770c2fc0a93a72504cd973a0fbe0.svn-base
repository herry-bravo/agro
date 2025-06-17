@extends('layouts.admin')
@section('content')
@section('breadcrumbs')

        <a href="{{ route("admin.accountCode.index") }}" class="breadcrumbs__item">Settings</a>
        <a href="{{ route("admin.accountCode.index") }}" class="breadcrumbs__item">Chart Of Account</a>
        <a href="" class="breadcrumbs__item active">Create</a>

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
    <form action="{{ route("admin.accountCode.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="account_payable">{{ trans('cruds.coa.fields.parent') }}</label>
                            <select name="parent_code" id="parent_code" class="form-control select2"  required>
                                <option hidden disabled selected></option>
                                    @foreach($accountCode as $row)
                                        <option value="{{$row->parent_code}}"  {{old('parent_code') ? 'selected' : '' }}>	{{$row->parent_code}} </option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="account_code">{{ trans('cruds.coa.fields.code') }}</label>
                            <input type="text" name="account_code" id="account_code" class="form-control"  maxlength="8" required/>
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="description">{{ trans('cruds.coa.fields.description') }}</label>
                            <input type="text" name="description" id="description" class="form-control" required/>
                        </div>
            </div>
			<div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="type">{{ trans('cruds.coa.fields.type') }}</label>
                            <select name="type" id="type" class="form-control select2"  required>
                                <option hidden disabled selected></option>
                                        <option value="P" >Parent</option>
                                        <option value="C" >Child</option>
                            </select>
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="lvl">{{ trans('cruds.coa.fields.level') }}</label>
                           <select name="level" id="level" class="form-control select2"  required>
                                <option hidden disabled selected></option>
                                        <option value="1" >1</option>
                                        <option value="2" >2</option>
                                        <option value="3" >3</option>
                                        <option value="4" >4</option>
                                        <option value="5" >5</option>
                            </select>
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="account_inventory">{{ trans('cruds.coa.fields.group') }}</label>
                            <select name="account_group" id="account_group" class="form-control select2"  required>
                                <option hidden disabled selected></option>
                                @foreach ($group as $row )
                                <option value="{{$row->account_group}}" >{{$row->account_group}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="org_id" value="{{Auth::user()->org_id}}">
            </div>
           <div class="d-flex justify-content-between">
            <button type="reset" class="btn btn-warning pull-left btn-submit"><i data-feather='save'></i> {{ trans('global.save') }}</button>
            <button type="submit" class="btn btn-success pull-left btn-submit"><i data-feather='save'></i> {{ trans('global.save') }}</button>
			</div>
        </form>
        </div>
        </div>
    </div>
</div>
@endsection

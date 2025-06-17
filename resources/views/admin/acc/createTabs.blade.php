@extends('layouts.admin')
@section('content')
<link href="{{ asset('css/tabs.min.css') }}" rel="stylesheet" id="bootstrap-css" />
<!------ Include the above in your HEAD tag ---------->
<style>
    .wizard {
    background: #fff;
}
.wizard .nav-tabs {
        position: relative;
        margin-bottom: 0;
        border-bottom-color: #e0e0e0;
    }

    .wizard > div.wizard-inner {
        position: relative;
    }

.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width: 48%;
    margin: 0 auto;
    left: 0;
    right: 42%;
    top: 50%;
    z-index: 1;
}
form-horizontal .radio, .form-horizontal .checkbox, .form-horizontal .radio-inline, .form-horizontal .checkbox-inline{
    padding-top:1px;
}
.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}
label:not(.form-check-label):not(.custom-file-label){
    font-weight: 400;
    color: black;
}
span.round-tab {
    width: 70px;
    height: 70px;
    line-height: 70px;
    border-radius: 102px;
    background: #ffffff;
    border: 3px solid #6a8559;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    color: #0f1110;
}
span.round-tab i{
    color:#555555;
}
.wizard li.active span.round-tab {
    background: #fff;
    border: 2px solid #5bc0de;
    
}
.wizard li.active span.round-tab i{
    color: #5bc0de;
}

span.round-tab:hover {
    color: #eae707;
    border: 2px solid #eae707;
}

.wizard .nav-tabs > li {
    width: 25%;
}

.wizard li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #5bc0de;
    transition: 0.1s ease-in-out;
}

.wizard li.active:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #5bc0de;
}

.wizard .nav-tabs > li a {
    width: 70px;
    height: 70px;
    border-radius: 100%;
    padding: 0;
}

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

.wizard .tab-pane {
    position: relative;
    padding-top: 1%;
}

.wizard h3 {
    margin-top: 0;
}
@media( max-width : 585px ) {

    .wizard {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
       
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
 
}
.pull-right {
    float: right!important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 21px;
}
.content-header>.breadcrumb {
	    margin-top: -4px;
}
</style>
<section class="content-header">
  <h1>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">{{ trans('global.create') }} {{ trans('cruds.itemMaster.item_master') }}</li>
  </ol>
 
</section>
<section class="content">
<div class="row">
  <div class="col-sm-12">
    <div class="box box-primary">
<div class="card">
  <div class="box-header with-border">
      <h3 class="box-title">  {{ trans('global.create') }} {{ trans('cruds.itemMaster.item_master') }}</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>	
<div class="card-body">
	<div class="box box-default">
       <div class="box-body">
        <div class="table-responsive">
        <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" >
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Item Master">
                            <span class="round-tab"> Items
                               
                            </span>
                        </a>
                    </li>

                    <li role="presentation" >
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Detail">
                            <span class="round-tab">
                                Detail
                            </span>
                        </a>
                    </li>
                    <li role="presentation" >
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Chart Of Account">
                            <span class="round-tab">
                                COA
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
           
            <div class="card-body">
                    <form action="{{ route("admin.item-master.store") }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    @csrf   
                    <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                        <div class="form-group">
                                        <input type="hidden" id="created_by" name="created_by" value="{{auth()->user()->id}}">
                                            <label for="item_code" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.item_code') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" class="form-control" name='item_code' id="item_code" value="{{ old('item_code', isset($item_code) ? $role->item_code : '') }}" autocomplete="off" >
                                            @if($errors->has('item_code'))
                                                <p class="help-block">
                                                    {{ $errors->first('item_code') }}
                                                </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('cruds.itemMaster.fields.item_helper') }}
                                            </p>    
                                        </div>                                     
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.description') }}</label>
                                            <div class="col-sm-6">
                                            <input type="text" id="description" name="description" class="form-control" value="{{ old('description', isset($description) ? $role->description : '') }}" autocomplete="off" required>
                                             @if($errors->has('description'))
                                                <p class="help-block">
                                                    {{ $errors->first('description') }}
                                                </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('cruds.itemMaster.fields.item_helper') }}
                                            </p>
											</div>
                                            <div class="col-sm-1">
                                                    <label class="radio-inline">
                                                    <input type="radio" name="organization_id" id="inlineRadio1" value="222"> Master
                                                    </label>
                                                </div>       
                                        </div>
                                <hr style="border-top: 1px solid #d5b4b4;">
                                        <div class="form-group">
                                            <label for="primary_uom_code" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.uom') }}</label>
                                            <div class="col-sm-3">
                                                    <select name="primary_uom_code" id="primary_uom_code" class="form-control select2"  required>
                                                    <option hidden disabled selected></option>
                                                    @foreach($uom as $row)
                                                            <option  value="{{ $row->uom_code }}  {{ in_array($row->uom_code, old('uom_code', [])) ? 'selected' : '' }}">{{ $row->uom_code }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('uom_code'))
                                                        <p class="help-block">
                                                            {{ $errors->first('uom_code') }}
                                                        </p>
                                                    @endif
                                                    <p class="helper-block">
                                                    </p>
                                            </div>
                                            <label for="type_code" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.item_type') }}</label>
                                            <div class="col-sm-3">
                                                <select name="type_code" id="type_code" class="form-control "   required>
                                                        <option value=""></option>
                                                        @foreach($ItemType as $row)
                                                            <option value="{{ $row->type_code }}">{{ $row->type_name }}</option>
                                                        @endforeach
                                                </select>
                                                @if($errors->has('type_code'))
                                                    <p class="help-block">
                                                        {{ $errors->first('type_code') }}
                                                    </p>
                                                @endif
                                                <p class="helper-block">  
                                                </p>
                                            </div>
                                            <label for="status_id" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.status') }}</label>
                                            <div class="col-sm-3">
                                            <select name="status_id" id="status_id" class="form-control"  required>
                                                   <option value=""></option>
                                                   <option value="1">Active</option>
                                                   <option value="0">In Active</option>
                                                   <option value="3">Hold</option>
                                           </select>
                                           @if($errors->has('status_id'))
                                               <p class="help-block">
                                                   {{ $errors->first('status_id') }}
                                               </p>
                                           @endif
                                           <p class="helper-block">  
                                           </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="buyer_id" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.buyer') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="buyer_id" name="buyer_id" class="form-control" autocomplete="off" value="">
                                            </div>
                                            <label for="planner_code" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.planner') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="planner_code" name="planner_code" class="form-control" value="" autocomplete="off">
                                            </div>
                                            <label for="mapping_item" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.barcode') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="mapping_item" name="mapping_item" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="item_brand" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.brand') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="item_brand" name="item_brand" class="form-control" value="">
                                            </div>
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.makeOrbuy') }}</label>
                                            <div class="col-sm-3">
                                            <select name="make_buy_code" id="type_code" class="form-control "   required>
                                                   
                                                   <option value=""></option>
                                                   <option value="1">Make</option>
                                                   <option value="0">Buy</option>
                                               
                                           </select>
                                           @if($errors->has('type_code'))
                                               <p class="help-block">
                                                   {{ $errors->first('type_code') }}
                                               </p>
                                           @endif
                                           <p class="helper-block">  
                                           </p>
                                            </div>
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.purchaseItem') }}</label>
                                            <div class="col-sm-3">
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" name="purchasing_item_flag" type="checkbox" value="1" id="flexCheckDefault">
                                                <label class="form-label" for="inlineRadio1">Purchased Item</label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                        <label for="item_note"  class="col-sm-1 control-label">Notes</label>
                                        <div class="col-sm-11">
                                        <input type="text" class="form-control" name="item_note" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        <small id="emailHelp" class="form-text text-muted">This Note Only For Internal Purposes</small>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="tab-pane" role="tabpanel" id="step2">
                                    <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.category') }}</label>
                                            <div class="col-sm-5">
                                            <select name="category_code" id="category_code" class="form-control"  required>
                                                    <option hidden disabled selected></option>
                                                        @foreach($Category as $row)
                                                            <option value="{{$row->category_code}}"  {{old('category_code') ? 'selected' : '' }}>{{$row->category_name}} - {{$row->description}} </option>
                                                        @endforeach
                                                </select>
                                                @if($errors->has('category_code'))
                                                    <p class="help-block">
                                                        {{ $errors->first('category_code') }}
                                                    </p>
                                                @endif
                                                <p class="helper-block">  
                                                </p>
                                            </div>  
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.subcat') }}</label>
                                            <div class="col-sm-2">
                                            <input type="text" id="last_name" name="item_subcat" class="form-control" value="" disabled>
                                            </div>
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.asset') }}</label>
                                            <div class="col-sm-2">
                                            <label class="radio-inline">
                                                    <input type="radio" name="asset" id="inlineRadio1" value="1"> Asset 
                                                    </label>
                                                    <label class="radio-inline">
                                                    <input type="radio" name="asset" id="inlineRadio2" value="2"> Non Asset
                                                    </label>
                                            </div>
                                        </div> 
                                        <hr style="border-top: 1px solid #d5b4b4;">  
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.weight') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="last_name" name="item_weight" class="form-control" value="">
                                            </div>
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.volume') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="last_name" name="item_volume" class="form-control" value="">
                                            </div>
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.lta') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="last_name" name="lta" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.ltp') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="last_name" name="ltp" class="form-control" value="">
                                            </div>
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.hscode') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="last_name" name="item_hscode" class="form-control" value="">
                                            </div>
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.packingqty') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="last_name" name="item_pack_qty" class="form-control" value="">
                                            </div>
                                        </div>
                                        <hr style="border-top: 1px solid #d5b4b4;">
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.itemcost') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="last_name" name="item_cost" class="form-control" value="">
                                            </div>
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.bomflag') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="last_name" name="bomflag" class="form-control" value="">
                                            </div>
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.subre') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="last_name" name="receiving_inventory" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                           
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.subshi') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="last_name" name="shipping_inventory" class="form-control" value="">
                                            </div>
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.location') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="last_name" name="attribute1" class="form-control" value="">
                                            </div>
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.ref') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="last_name" name="shipping_inventory" class="form-control" value="">
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="step3">
                                    <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.payable') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="account_payable" name="account_payable" class="form-control" value="">
                                            </div>
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.receivable') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="account_receivable" name="account_receivable" class="form-control" value="">
                                            </div>
											<label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.inventory') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="account_inventory" name="account_inventory" class="form-control" value="">
                                            </div>
											
                                    </div>
                                    <div class="form-group">
                                            
                                            <label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.usage') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="account_consumption" name="account_consumption" class="form-control" value="">
                                            </div>
											<label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.salescc') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="attribute1" name="attribute1" class="form-control" value="">
                                            </div>
											<label for="inputPassword3" class="col-sm-1 control-label">{{ trans('cruds.itemMaster.fields.other') }}</label>
                                            <div class="col-sm-3">
                                            <input type="text" id="last_name" name="attribute2" class="form-control" value="" disabled>
                                            </div>
                                    </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                                <div class=" pull-right">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
            </form>
            
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
@endsection
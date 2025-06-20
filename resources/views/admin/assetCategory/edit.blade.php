@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/jquery-ui.js') }}"></script>
@endpush
    @section('breadcrumbs')
    <a href="{{route('admin.asset-category.index')}}" class="breadcrumbs__item">{{ trans('cruds.assetMng.title') }}</a>
    <a href="{{route('admin.asset-category.index')}}" class="breadcrumbs__item">{{ trans('cruds.assetMng.category') }}</a>
    <a href="" class="breadcrumbs__item active">Edit</a>
@endsection
@section('content')
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <br>
                    <div class="card-body">
                        <form action="{{ route('admin.asset-category.update',$assetcategory->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="mb-3">
                                        <div class="form-group row">
                                            <div class="col-sm-5">
                                                <label class="control-label label-primary" for="number"><b >Asset Category</b></label>
                                                <input type="text" class="form-control" name="name" value="{{$assetcategory->name}}">
                                                <input type="hidden" class="form-control" name="type" value="Purchase">
                                            </div>
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-5">
                                                <label class="control-label" for="number"><b>Company</b></label>
                                                <input type="text" class="form-control" name="company_id"value="{{$assetcategory->company_id}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 control-label" for="number"><b style='color:green !important;'>Journal Entries</b>
                                                <hr></label>
                                            <label class="col-sm-6 control-label" for="number"><b style='color:green !important;'>Periodicity</b>
                                                <hr></label>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-group row">
                                            <div class="col-sm-1"></div>
                                            <!-- <label class="col-sm-2 control-label"for="number">{{ trans('cruds.assetMng.cat.journal') }}</label>
                                            <div class="col-sm-3">
                                                <select name="journal_id" id="journal" class="form-control select2" required>
                                                    <option hidden selected></option>
                                                    @foreach($category as $row)
                                                        <option value="{{ $row->category_code }}"{{ $assetcategory->journal_id == $row->category_code ? 'selected' : '' }}>{{$row->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div> -->
                                            <div class="col-sm-6"></div>
                                            <label class="col-sm-2 control-label" for="number">{{ trans('cruds.assetMng.cat.time') }}</label>
                                            <div class="col-sm-3">
                                                @if ($assetcategory->method_time=='Number')
                                                    <div class=" form-check-inline">
                                                        <input class="form-check-input" type="radio" name="method_time" id="inlineRadio1" value="Number" checked="">
                                                        <label class="form-check-label" for="inlineRadio1">&nbsp Number of Entries</label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <input class="form-check-input" type="radio" name="method_time" id="inlineRadio2" value="Date">
                                                        <label class="form-check-label" for="inlineRadio2">&nbsp Ending Date</label>
                                                    </div>
                                                @else
                                                    <div class=" form-check-inline">
                                                        <input class="form-check-input" type="radio" name="method_time" id="inlineRadio1" value="Number" >
                                                        <label class="form-check-label" for="inlineRadio1">&nbsp Number of Entries</label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <input class="form-check-input" type="radio" name="method_time" id="inlineRadio2" value="Date" checked="">
                                                        <label class="form-check-label" for="inlineRadio2">&nbsp Ending Date</label>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-group row ">
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label"for="number">{{ trans('cruds.assetMng.cat.asset_acc') }}</label>
                                            <div class="col-sm-3">
                                                <select name="account_asset_id" id="acc" class="form-control select2" required>
                                                    <option hidden selected></option>
                                                    @foreach($acc as $row)
                                                        <option value="{{ $row->account_code }}"{{ $assetcategory->account_asset_id == $row->account_code ? 'selected' : '' }}>{{ $row->account_code }} - {{$row->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label" for="number">{{ trans('cruds.assetMng.cat.number') }}</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="method_number" class="form-control" value="{{$assetcategory->method_number}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-group row ">
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label"for="number">{{ trans('cruds.assetMng.cat.depr') }} : {{ trans('cruds.assetMng.cat.asset_acc') }}</label>
                                            <div class="col-sm-3">
                                                <select name="account_depreciation_id" id="depr1" class="form-control select2" required>
                                                    <option hidden selected></option>
                                                    @foreach($acc as $row)
                                                        <option value="{{ $row->account_code }}"{{ $assetcategory->account_depreciation_id == $row->account_code ? 'selected' : '' }}>{{ $row->account_code }} - {{$row->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label" for="number">{{ trans('cruds.assetMng.cat.one_entry') }}</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="method_period" class="form-control" value="{{$assetcategory->method_period}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-group row ">
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label"for="number">{{ trans('cruds.assetMng.cat.depr') }} : {{ trans('cruds.assetMng.cat.expense_acc') }}</label>
                                            <div class="col-sm-3">
                                                <select name="account_depreciation_expense_id" id="depr2" class="form-control select2" required>
                                                    <option hidden selected></option>
                                                    @foreach($acc as $row)
                                                        <option value="{{ $row->account_code }}"{{ $assetcategory->account_depreciation_expense_id == $row->account_code ? 'selected' : '' }}>{{ $row->account_code }} - {{$row->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group row ">
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label"for="number">{{ trans('cruds.assetMng.cat.analytic') }}</label>
                                            <div class="col-sm-3">
                                                <select name="account_analytic_id" id="analytic" class="form-control select2" required>
                                                    <option hidden selected></option>
                                                    @foreach($acc as $row)
                                                        <option value="{{ $row->account_code }}"{{ $assetcategory->account_analytic_id == $row->account_code ? 'selected' : '' }}>{{ $row->account_code }} - {{$row->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-group row">
                                            <label class="col-sm-6 control-label" for="number"><b style='color:green !important;'>Additional Options</b>
                                                <hr></label>
                                            <label class="col-sm-6 control-label" for="number"><b style='color:green !important;'>Depreciation Method</b>
                                                <hr></label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-group row">
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label"for="number">{{ trans('cruds.assetMng.cat.auto_confirm') }}</label>
                                            <div class="col-sm-3">
                                                <div class="">
                                                    <input class="form-check-input" type="checkbox" name="logo" id="inlineRadio1" value="True" >
                                                    <label class="form-check-label" for="inlineRadio1"></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label" for="number">{{ trans('cruds.assetMng.cat.method') }}</label>
                                            <div class="col-sm-3">
                                                @if ($assetcategory->method=='Linear')
                                                    <div class=" form-check-inline">
                                                        <input class="form-check-input" type="radio" name="method" id="inlineRadio3" value="Linear" checked="">
                                                        <label class="form-check-label" for="inlineRadio3">&nbsp &nbsp Linear</label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <input class="form-check-input" type="radio" name="method" id="inlineRadio4" value="Digressive">
                                                        <label class="form-check-label" for="inlineRadio4">&nbsp &nbsp Digressive</label>
                                                    </div>
                                                @else
                                                    <div class=" form-check-inline">
                                                        <input class="form-check-input" type="radio" name="method" id="inlineRadio3" value="Linear">
                                                        <label class="form-check-label" for="inlineRadio3">&nbsp &nbsp Linear</label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <input class="form-check-input" type="radio" name="method" id="inlineRadio4" value="Digressive"checked="">
                                                        <label class="form-check-label" for="inlineRadio4">&nbsp &nbsp Digressive</label>
                                                    </div>
                                                @endif

                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="form-group row">
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label"for="number">{{ trans('cruds.assetMng.cat.group') }}</label>
                                            <div class="col-sm-3">
                                                @if ($assetcategory->group_entries=='True')
                                                    <div class="">
                                                        <input class="form-check-input" type="checkbox" name="group_entries" id="inlineRadio1" value="True" checked="">
                                                        <label class="form-check-label" for="inlineRadio1"></label>
                                                    </div>
                                                @else
                                                    <div class="">
                                                        <input class="form-check-input" type="checkbox" name="group_entries" id="inlineRadio1" value="True" >
                                                        <label class="form-check-label" for="inlineRadio1"></label>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-2 control-label" for="number">{{ trans('cruds.assetMng.cat.temporis') }}</label>
                                            <div class="col-sm-3">
                                                @if ($assetcategory->group_entries=='True')
                                                    <div class="">
                                                        <input class="form-check-input" type="checkbox" name="prorata" id="inlineRadio1" value="True" checked="">
                                                        <label class="form-check-label" for="inlineRadio1"></label>
                                                    </div>
                                                @else
                                                    <div class="">
                                                        <input class="form-check-input" type="checkbox" name="prorata" id="inlineRadio1" value="True" >
                                                        <label class="form-check-label" for="inlineRadio1"></label>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="d-flex justify-content-between">
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

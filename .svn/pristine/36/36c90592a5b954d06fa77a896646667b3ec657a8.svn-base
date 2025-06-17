@extends('layouts.admin')
@section('content')
@push('script')
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
@endpush
@section('breadcrumbs')
    <a href="{{route('admin.journalTypes.index')}}" class="breadcrumbs__item">{{ trans('cruds.journal.title') }}</a>
    <a href="" class="breadcrumbs__item">Edit</a>
@endsection
@section('content')
<div class="card" >
    <div class="card-header">
        <h4 class="card-title mb-2">{{ trans('cruds.journal.title_singular') }} Types</h4>
    </div>
    <hr>
    <br>
    <div class="card-body">
        <form  action="{{route("admin.journalTypes.update",$category->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{ csrf_field() }}
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="number">Journal Name</label>
                                <input type="text" class="form-control calculate" value="{{$category->description}}" name="description" autocomplete="off">
                            </div>
                        </div>
                    </div><br>
                    <div class="form-group row">
                        <label class="col-sm-1 control-label" for="number" style="margin-top: 0%;">Journal Type</label>

                                <div class="col-sm-3 {{ $errors->get('category_code') ? 'has-error' : '' }}">
                                    <select name="category_name" id="category_name" class="form-control select2" required>
                                        @foreach($cat as $row)
                                        @if ($row->trx_source_types==$category->category_name)
                                        <option value="{{$category->category_name}}" selected>{{$category->category_name}}</option>
                                        @else
                                        <option value="{{$row->trx_source_types}}">{{$row->trx_source_types}}</option>
                                        @endif
                                        @endforeach
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <label class="col-sm-1 control-label" for="number" style="margin-top: 0%;">Short Code</label>

                                <div class="col-sm-3 {{ $errors->get('category_code') ? 'has-error' : '' }}">
                                    <input type="text" class="form-control" name="category_code" value='{{$category->category_code}}' required>
                                </div>
                                <label class="col-sm-1 control-label" for="number" style="margin-top: 0%;">Company</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="" value='PT. Buana Megah Paper Mills' readonly>
                                </div>
                     </div>
                     <br>
                      <div class="form-group row">
                                <label class="col-sm-1 control-label" for="number" style="margin-top: 0%;">Currency</label>
                                <div class="col-sm-3">
                                    <select name="attribute2" id="journal" class="form-control select2" required>
                                        @foreach($curr as $row)
                                        @if ( $row->currency_code ==$category->attribute2)
                                        <option value="{{$category->attribute2 }}  {{ in_array($category->attribute2, old('trx_source_types', [])) ? 'selected' : '' }}">{{$category->attribute2}}</option>
                                        @else
                                        <option value="{{ $row->currency_code }}  {{ in_array($row->currency_code, old('trx_source_types', [])) ? 'selected' : '' }}">{{$row->currency_code}}</option>
                                        @endif

                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-sm-1 control-label" for="number" style="margin-top: 0%;">Account Types</label>
                                <div class="col-sm-3 {{ $errors->get('account_type') ? 'has-error' : '' }}">
                                    <select name="account_type" id="account_type" class="form-control select2" >
                                        @foreach($acc_group as $row)
                                        @if ($row->account_group==$category->account_type)
                                        <option value="{{ $category->account_type }}" selected>{{$category->account_type}}</option>
                                        @else
                                        <option value="{{ $row->account_group }}  {{ in_array($row->account_group, old('account_code', [])) ? 'selected' : '' }}">{{$row->account_group}}</option>
                                        @endif
                                        @endforeach

                                    </select>
                                </div>

                                <label class="col-sm-1 control-label" for="number" style="margin-top: 0%;">Allowed Accounts</label>
                                <div class="col-sm-3">
                                    <select name="attribute1" id="attribute1" class="form-control select2" required>
                                        @foreach($acc as $row)
                                        @if ($row->account_code==$category->attribute1)
                                        <option value="{{$category->attribute1}}" selected>{{$category->attribute1}} - {{$category->acc->description}}</option>
                                        @else
                                        <option value="{{ $row->account_code }} ">{{$row->account_code}} {{$row->description}}</option>
                                        @endif
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
                     <br>
                     <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-danger pull-left">Reset</button>
                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Save</button>
                    </div>
                </div>
                </div>
        </form>
    </div>
</div>
@endsection
@push('script')
<script>
</script>
@endpush

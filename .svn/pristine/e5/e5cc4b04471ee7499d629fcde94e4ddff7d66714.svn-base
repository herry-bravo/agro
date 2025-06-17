@extends('layouts.admin')
@section('content')
@section('breadcrumbs')
        <a href="" class="breadcrumbs__item">Settings</a>
        <a href="" class="breadcrumbs__item">Global Terms</a>
        <a href="" class="breadcrumbs__item">Edit Global Terms</a>
@endsection
<!-- Main content -->
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-2">{{ trans('global.edit') }} {{ trans('cruds.terms.title') }}</h4>
                </div>
                <hr>
                    <div class="card-body">
                        <form action="{{ route("admin.terms.update", [$terms->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        <input type="hidden" id="updated_by" name="updated_by" value="{{auth()->user()->id}}">
                        <div class="box-body">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="col-sm-0 form-label" for="number">{{ trans('cruds.terms.fields.term_category') }}</label>
                                    <select type="text" id="term_category" name="term_category" class="form-control select2" required>
                                        @if (($terms->term_category) == "PAYMENT")
                                            <option value="PAYMENT" selected>PAYMENT</option>
                                            <option value="FREIGHT" >FREIGHT</option>
                                            <option value="CARRIER" >CARRIER</option>
                                        @elseif (($terms->term_category) == "FREIGHT")
                                            <option value="FREIGHT" selected>FREIGHT</option>
                                            <option value="PAYMENT" >PAYMENT</option>
                                            <option value="CARRIER" >CARRIER</option>
                                        @elseif (($terms->term_category) == "CARRIER")
                                            <option value="CARRIER" selected>CARRIER</option>
                                            <option value="PAYMENT" >PAYMENT</option>
                                            <option value="FREIGHT" >FREIGHT</option>
                                        @endif
                                    </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="col-sm-0 form-label" for="number">{{ trans('cruds.terms.fields.term_code') }}</label>
                                    <input type="text" class="form-control" name="term_code" value="{{ $terms->term_code}}" placeholder="Terms Code" required="required" maxlength="6" minlength="6">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-sm-0 form-label" for="number">{{ trans('cruds.terms.fields.terms_name') }}</label>
                                        <input type="text" class="form-control" name="terms_name" value="{{ $terms->terms_name}}" placeholder="Term Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="col-sm-0 form-label" for="number">{{ trans('cruds.terms.fields.attribute1') }}</label>
                                    <input type="text" class="form-control" name="attribute1" value="{{ $terms->attribute1  }}" placeholder="Attribute">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="reset" class="btn btn-danger pull-left">Reset</button>
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>
</section>
<!-- /.content -->
@endsection

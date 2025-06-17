@extends('layouts.admin')
@section('content')
@push('script')
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/currency.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endpush
@section('content')
<div class="card" >
    <div class="card-header">
        <h6 class="card-title">
            <a href="{{ route('admin.opunit.index') }}" class="breadcrumbs__item">{{ trans('cruds.OpUnit.title') }}
            </a>
            <a href="{{ route('admin.opunit.index') }}"
                class="breadcrumbs__item">{{ trans('cruds.OpUnit.title_singular') }}</a>
        </h6>
    </div>
    <hr>
    <br>
    <div class="card-body">
        <form id = "formship" action="{{ route("admin.opunit.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">

                <div class="form-group row">
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.OpUnit.fields.short_name') }}</label>
                            <input type="text" id="short_name" name="short_name" class="form-control" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label class="form-label"for="segment1">{{ trans('cruds.OpUnit.fields.name') }}</label>
                            <input type="text" id="name" name="name" class="form-control" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label class="form-label"
                                for="segment1">{{ trans('cruds.OpUnit.fields.capacity') }}</label>
                            <input required id="capacity" name="capacity"type="text" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.OpUnit.fields.range_capacity_min') }}</label>
                            <input type="text" id="range_capacity_min" name="range_capacity_min" class="form-control" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.OpUnit.fields.range_capacity_max') }}</label>
                            <input type="text" id="range_capacity_max" name="range_capacity_max" class="form-control" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label"
                                for="segment1">{{ trans('cruds.OpUnit.fields.range_gsm_min') }}</label>
                            <input type="text" id="range_gsm_min" name="range_gsm_min" class="form-control" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label"
                                for="segment1">{{ trans('cruds.OpUnit.fields.range_gsm_max') }}</label>
                            <input type="text" id="range_gsm_max" name="range_gsm_max" class="form-control" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.OpUnit.fields.machine_status') }}</label>
                            <select name="machine_status" id="mechine_status" class="form-control select2" required>
                                <option value="1"> Ready </option>
                                <option value="2"> Off </option>
                                <option value="0"> Maintenance </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div></div>
                <button class="btn btn-primary btn-submit"name='action' value="create" id="add_all" type="submit"><i data-feather='save'></i> {{ trans('global.save') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection

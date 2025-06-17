@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
<style>
    .card-body {
        padding-bottom: 0em;
    }

</style>
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/currency.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endpush

@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.faktur.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">
                            <a href="{{ route("admin.salesorder.index") }}" class="breadcrumbs__item">{{ trans('cruds.OrderManagement.title') }} </a>
                            <a href="{{ route("admin.salesorder.index") }}" class="breadcrumbs__item">{{ trans('cruds.OrderManagement.faktur') }} </a>
                            <a href="" class="breadcrumbs__item">Create </a>
                        </h6>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row mb-25">
                            <div class="col-md-12">
                                <div class="row mb-25">
                                    <div class="col-md-4">
                                        <label class="form-label" for="order_number">Faktur Code</label>
                                        <input type="number" hidden id="created_by" name="created_by" value="{{ auth()->user()->id }}" class="form-control">
                                        <input type="text" id="faktur_code" name="faktur_code" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-50 mt-1">
                            <div></div>
                            <button class="btn btn-primary btn-submit" type="submit"><i data-feather='save'></i>
                            {{ trans('global.save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

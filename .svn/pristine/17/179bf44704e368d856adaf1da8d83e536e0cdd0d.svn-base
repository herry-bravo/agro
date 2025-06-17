@extends('layouts.admin')
@section('content')
@push('script')
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/currency.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endpush
@section('breadcrumbs')
    <a href="{{route('admin.bankaccount.index')}}" class="breadcrumbs__item">{{ trans('cruds.clientManagementSetting.title') }}</a>
    <a href="{{route('admin.bankaccount.index')}}" class="breadcrumbs__item">{{ trans('cruds.bankaccount.title') }}</a>
    <a href="{{route('admin.bankaccount.create')}}" class="breadcrumbs__item active">{{ trans('cruds.bankaccount.fields.create') }}</a>
@endsection
@section('content')
<div class="card" >
    <div class="card-header">
        <h4 class="card-title mb-2">{{ trans('cruds.bankaccount.title') }}</h4>
    </div>
    <hr>
    <br>
    <div class="card-body">
        <form id = "formship" action="{{ route("admin.bankaccount.update", $bank->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="form-group row">
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.bankaccount.fields.acombinations') }}</label>
                            <select type="text" id="bank_acct_use_id" name="bank_acct_use_id" class="form-control select2" value=""  >
                                @foreach($acccode as $row)
                                    <option value="{{$row->account_code}}">{{$row->account_code}} - {{$row->description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.bankaccount.fields.baid') }}</label>
                            <input  value="{{$bank->bank_account_id}}" type="text" id="bank_account_id" name="bank_account_id" class="form-control" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label class="form-label"
                                for="segment1">{{ trans('cruds.bankaccount.fields.category') }}</label>
                            <input type="text" value="{{$bank->attribute_category}}" id="attribute_category" name="attribute_category" class="form-control" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.bankaccount.fields.acc') }}</label>
                            <input type="text"value="{{$bank->attribute1}}"  id="attribute1" name="attribute1" class="form-control" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label form-check-label mb-50 text-end" for="flag">AR Flag</label>
                        <div class="form-check form-switch form-check-primary text-end">
                            <input name="ar_use_enable_flag" type="checkbox" class="form-check-input" id="arflag" value="1" checked="">
                            <label class="form-check-label" for="arflag">
                                <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                </span>
                                <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                        <line x1="20" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label class="form-label" for="segment1">{{ trans('cruds.bankaccount.fields.ban') }}</label>
                            <input type="text" id="attribute2" name="attribute2" class="form-control" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label class="form-label"for="segment1">{{ trans('cruds.bankaccount.fields.rparties') }}</label>
                            <select type="text" id="org_party_id" name="org_party_id" class="form-control select2" value=""  >
                                @foreach($cust as $row)
                                    <option value="{{$row->cust_party_code}}">{{$row->party_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-2">
                            <label class="form-label"
                                for="segment1">{{ trans('cruds.bankaccount.fields.ndate') }}</label>
                            <input required id="end_date" name="end_date"type="text" class="form-control flatpickr-basic flatpickr-input text-end">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label form-check-label mb-50 text-end" for="flag">AP Flag</label>
                        <div class="form-check form-switch form-check-primary text-end">
                            <input name="ap_use_enable_flag" type="checkbox" class="form-check-input" id="apflag" value="1" checked="">
                            <label class="form-check-label" for="apflag">
                                <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                </span>
                                <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                        <line x1="20" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </span>
                            </label>
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

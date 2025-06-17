@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
@endpush
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header ">
                    <h6 class="card-title">
                        <a href="" class="breadcrumbs__item">{{ trans('cruds.OrderManagement.title') }} </a>
                        <a href="{{ route("admin.shipment.index") }}" class="breadcrumbs__item"> {{ trans('cruds.shiping.title_singular') }} </a>
                    </h6>
                    
                </div>
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th>{{ trans('cruds.shiping.modaltable.sonumb') }}</th>
                                <th>{{ trans('cruds.shiping.modaltable.ponumb') }}</th>
                                <th>{{ trans('cruds.shiping.modaltable.sales_order') }}</th>
                                <th>{{ trans('cruds.shiping.modaltable.cs') }}</th>
                                <th>{{ trans('cruds.shiping.modaltable.suratjalan') }}</th>
                                <th>{{ trans('cruds.shiping.modaltable.note') }}</th>
                                {{-- <th>{{ trans('cruds.shiping.modaltable.curenci') }}</th> --}}
                                {{-- <th>Amount</th> --}}
                                <th>Shipment Date</th>
                                <!-- <th>{{ trans('cruds.shiping.modaltable.next_step') }}</th> -->
                                <!-- <th class="text-start">
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{ trans('global.action') }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deliveryorder as $key =>$row)
                                <tr>
                                    <td>{{$row->order_number}}</td>
                                    <td>{{$row->detail->sales->cust_po_number}}</td>
                                    <td>{{$row->customer->cust_party_code}}</td>
                                    <td>{{$row->customer->party_name}}</td>
                                    <td>{{$row->delivery_name}}</td>
                                    <td>{{$row->attribute2??'-'}}</td>
                                    <td>{{date('d-M-Y',strtotime($row->created_at))}}</td>
                                    <!-- <td>{{$row->status}}</td> -->
                                    <!-- <td>{{$row->order_number}}</td> -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
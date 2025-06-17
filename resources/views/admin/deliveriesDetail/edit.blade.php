
@extends('layouts.admin')
@section('content')
    @push('script')
        <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
        <script src="{{ asset('app-assets/js/scripts/currency.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    @endpush
    @section('breadcrumbs')
        <a href="{{route('admin.home')}}" class="breadcrumbs__item">{{ trans('cruds.OrderManagement.title') }}</a>
        <a href="{{route('admin.deliveries.index')}}" class="breadcrumbs__item">Delivery</a>
        <a href="" class="breadcrumbs__item">Add Weight</a>
    @endsection
    <div class="card" >
        <div class="card-header">
            <h4 class="card-title mb-2">{{ trans('cruds.Delivery.title_singular') }} Add Weight</h4>
        </div>
        <div class="card-body">
            <form id = "formship" action="{{ route("admin.deliveriesdetail.update",$deliveryDetail->id,$deliveryDetail->delivery_detail_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label class="form-label" for="segment1">{{ trans('cruds.Delivery.fields.pjg') }}</label>
                                    <input autocomplete="off" type="number" id="panjang" name="panjang" class="form-control" value="{{$deliveryDetail->intattribute1}}" required>
                                    <input type="hidden" id="id" name="id[]" class="form-control" value="{{$deliveryDetail->id}}" required>
                                    <input type="hidden" id="headid" name="headid" class="form-control" value="{{$deliveryDetail->delivery_detail_id}}" required>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label class="form-label" for="segment1">{{ trans('cruds.Delivery.fields.lbr') }}</label>
                                    <input autocomplete="off" type="number" id="lebar" name="lebar" class="form-control" value="{{$deliveryDetail->intattribute2}}" required>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label class="form-label" for="segment1">{{ trans('cruds.Delivery.fields.brt') }}</label>
                                    <input autocomplete="off" type="number" id="xnet_weight" name="xnet_weight" class="form-control" value="{{$deliveryDetail->net_weight}}" required>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label class="form-label" for="segment1">{{ trans('cruds.Delivery.fields.gsm') }}</label>
                                    <input autocomplete="off" type="number" id="gsm" name="gsm" class="form-control" value="{{$deliveryDetail->intattribute3}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="mb-1">
                                <label class="form-label" for="segment1">{{ trans('cruds.Delivery.fields.sub') }}</label>
                                <input type="hidden" class="id" id="id_1" name="id[]" value="1">
                                <input autocomplete="off" type="text" class="form-control search_subinventory" value="{{$deliveryDetail->subinventory}}" name="subinventory_from[]" id="subinventoryfrom_1">
                                <input type="hidden" class="form-control subinvfrom_1" name="shipping_inventory" id="subinvfrom_1" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    @if ($DeliveryHeader->lvl==6)
                        <button class="btn btn-warning resetbtn" type="button"><i data-feather='refresh-ccw'></i> Reset</button>
                        <button class="btn btn-primary btn-submit adddata" id="add_all" type="submit"><i data-feather='save'></i> {{ trans('global.save') }}</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
    <script>
         $(document).ready( function () {

        ///////////// RESET BUTTON//////////////
        $(".resetbtn").click(function(){
            $("#formship").trigger("reset");
        });
        ///////////// RESET BUTTON//////////////
    });
    </script>
@endpush

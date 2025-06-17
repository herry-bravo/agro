@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
<style>
    /* @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100,300&display=swap'); */
*{
  padding:0;
  margin:0;
}
.container{
  margin:10px;
  display:grid;
  grid-template-columns: repeat(auto-fit,  minmax(300px, 1fr) );
  /* grid-auto-rows: 150px; */
  /* grid-gap:10px; */
}
.container div{
  display:flex;
  justify-content: center;
  align-items:center;
  width:100%;
  height: 100%;
  color:#fff;
  font-size:30px;
  overflow:hidden;
  font-wieght:100;
}

.wide{
    grid-column: auto;
  }
  .tall{
    grid-row: auto;
  }
  .big{
    grid-column: auto;
    grid-row:auto;
  }

/* Media Query Start for Mobile phones */
</style>
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/currency.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endpush
@section('breadcrumbs')

<a href="" class="breadcrumbs__item">Quality Management</a>
<a href="" class="breadcrumbs__item">{{ trans('cruds.quality_management.material') }}</a>

@endsection
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <form action="{{ route("admin.qm-material.update",[$qm->id]) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header mb-4">
                        <h4 class="card-title">Edit Material Quality Management</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-12">

                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">{{ trans('cruds.quality_management.fields.date') }}</label>
                                        <input type="text" id="" class="form-control text-end" class="form-control" value="{{$qm->created_at->format('d-M-Y')}}" >
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">{{ trans('cruds.quality_management.fields.aju') }}</label>
                                        <input type="text" id="" name="attribute_aju" class="form-control" value="{{$qm->attribute_aju}}" >
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">{{ trans('cruds.quality_management.fields.supplier') }}</label>
                                        <input type="text" id="" class="form-control text-end" class="form-control" value="{{$qm->rcvheader->vendor_id ?? ''}} - {{$qm->rcvheader->vendor->vendor_name ?? ''}}" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label class="form-label" for="">{{ trans('cruds.quality_management.fields.item') }}</label>
                                        <input type="text" id="" class="form-control" class="form-control" value="{{$qm->itemmaster->item_code}} - {{$qm->itemmaster->description}}" >
                                        <input type="hidden" id="" name="inventory_item_id" class="form-control" value="{{$qm->inventory_item_id}} " >
                                        <input type="hidden" id="" name="id" class="form-control" value="{{$qm->id}} ">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="">{{ trans('cruds.quality_management.fields.qty') }}</label>
                                        <input type="text" id="" name="quantity" class="form-control" value="{{number_format((float)$qm->quantity,3, '.', '')}}" >
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- </div> --}}

                    {{-- Body --}}
                    {{-- <div class="card"> --}}
                    <div class="card-header">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-sales-tab" data-bs-toggle="tab" data-bs-target="#nav-sales" type="button" role="tab" aria-controls="nav-sales" aria-selected="true">
                                    <span class="bs-stepper-box">
                                        <i data-feather="inbox" class="font-medium-3"></i>
                                    </span>
                                    WH - Quality
                                </button>
                                <button class="nav-link" id="nav-priceList-tab" data-bs-toggle="tab" data-bs-target="#nav-priceList" type="button" role="tab" aria-controls="nav-priceList" aria-selected="false">
                                    <span class="bs-stepper-box">
                                        <i data-feather="droplet" class="font-medium-3"></i>
                                    </span>
                                    Lab - Quality
                                </button>
                                <button class="nav-link" id="nav-priceList-tab" data-bs-toggle="tab" data-bs-target="#nav-images" type="button" role="tab" aria-controls="nav-images" aria-selected="false">
                                    <span class="bs-stepper-box">
                                        <i data-feather="image" class="font-medium-3"></i>
                                    </span>
                                    Images
                                </button>
                            </div>
                        </nav>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="tab-content" id="nav-tabContent">
                            {{-- Tab sales --}}
                            <div class="tab-pane fade show active" id="nav-sales" role="tabpanel" aria-labelledby="nav-sales-tab">
                                <div class="box-body " style="height: 300px;">
                                    <div class="col-md-12 mt-2">
                                        <div class="row mb-2">
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.long') }}</label>
                                                <input type="text" id="" name="attribute_long" class="form-control text-end" value="{{number_format($qm->attribute_long,1,'.')}}" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.short') }}</label>
                                                <input type="text" id="" name="attribute_short" class="form-control text-end" value="{{number_format($qm->attribute_short,1,'.')}}" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.out_throw') }}</label>
                                                <input type="text" id="" name="attribute_outtrhow" class="form-control text-end" value="{{number_format($qm->attribute_outtrhow,1,'.')}}" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.prohibitive') }}</label>
                                                <input type="text" id="" name="attribute_prohibitive" class="form-control text-end" value="{{number_format($qm->attribute_prohibitive,1,'.')}}" >
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.moisture') }}</label>
                                                <input type="text" id="" name="attribute_moisture" class="form-control text-end" value="{{number_format($qm->attribute_moisture,1,'.')}}" >
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.grade') }}</label>
                                                <input type="text" id="" name="attribute_grade" class="form-control text-end" value="{{number_format($qm->attribute_grade,1,'.')}}" >
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.keterangan') }}</label>
                                                <input type="text" id="" name="attribute_note" class="form-control" value="{{$qm->attribute_note}}" >
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Tab priceList --}}
                            <div class="tab-pane fade" id="nav-priceList" role="tabpanel" aria-labelledby="nav-priceList-tab">
                                <div class="box-body" style="height: 300px;">
                                    <div class="col-md-12 mt-2">
                                        <div class="row mb-2">
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.hasil1') }}</label>
                                                <input type="text" id="" name="intattribute1" class="form-control text-end" value="{{number_format($qm->intattribute1,1,'.')}}" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.hasil2') }}</label>
                                                <input type="text" id="" name="intattribute2" class="form-control text-end" value="{{number_format($qm->intattribute2,1,'.')}}" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.hasil3') }}</label>
                                                <input type="text" id="" name="intattribute3" class="form-control text-end" value="{{number_format($qm->intattribute3,1,'.')}}" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.hasil4') }}</label>
                                                <input type="text" id="" name="intattribute4" class="form-control text-end" value="{{number_format($qm->intattribute4,1,'.')}}" >
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.total') }}</label>
                                                <input type="text" id="" name="intattribute5" class="form-control text-end" value="{{number_format($qm->intattribute5,1,'.')}}" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.waktu') }}</label>
                                                <input type="text" id="" name="date_time" class="form-control text-end" value="{{number_format($qm->date_time,1,'.')}}" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.free') }}</label>
                                                <input type="text" id="" name="attribute_free" class="form-control text-end" value="{{number_format($qm->attribute_free,1,'.')}}" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.gsm') }}</label>
                                                <input type="text" id="" name="attribute_gsm" class="form-control text-end" value="{{number_format($qm->attribute_gsm,1,'.')}}" >
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.thick') }}</label>
                                                <input type="text" id="" name="attribute_thick" class="form-control text-end" value="{{number_format($qm->attribute_thick,1,'.')}}" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.bright') }}</label>
                                                <input type="text" id="" name="attribute_bright" class="form-control text-end" value="{{number_format($qm->attribute_bright,1,'.')}}" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.light') }}</label>
                                                <input type="text" id="" name="attribute_light" class="form-control text-end" value="{{number_format($qm->attribute_light,1,'.')}}" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.ash') }}</label>
                                                <input type="text" id="" name="attribute_ash" class="form-control text-end" value="{{number_format($qm->attribute_ash,1,'.')}}" >
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.bst') }}</label>
                                                <input type="text" id="" name="attribute_bst" class="form-control text-end" value="{{number_format($qm->attribute_bst,1,'.')}}" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.rct') }}</label>
                                                <input type="text" id="" name="attribute_rct" class="form-control text-end" value="{{number_format($qm->attribute_rct,1,'.')}}" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.density') }}</label>
                                                <input type="text" id="" name="attribute_density" class="form-control text-end" value="{{number_format($qm->attribute_density,1,'.')}}" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.strength') }}</label>
                                                <input type="text" id="" name="attribute_strength" class="form-control text-end" value="{{number_format($qm->attribute_strength,1,'.')}}" >
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.hydra') }}</label>
                                                <input type="text" id="" name="attribute_hydra" class="form-control text-end" value="{{number_format($qm->attribute_hydra,1,'.')}}" >
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.tutup') }}</label>
                                                <input type="text" id="" class="form-control text-end" class="form-control text-end" value="" >
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.tgl_tutup') }}</label>
                                                <input type="text" id="" class="form-control text-end" class="form-control text-end" value="" >
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{--Images--}}
                            <div class="tab-pane fade" id="nav-images" role="tabpanel" aria-labelledby="nav-images-tab">
                                <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                    <div class="container">
                                        @foreach ( $img as $key => $img)
                                            <div><img src="{{ asset($img->path) }}" width="100%" ></div>
                                        @endforeach
                                    </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-between mt-1">
                            <button class="btn btn-warning" type="reset"><i data-feather='refresh-ccw'></i>
                                Reset</button>
                            <button class="btn btn-primary btn-submit" type="submit"><i data-feather='save'></i>
                                {{ trans('global.save') }}</button>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>


            </form>
        </div>
    </div>
</section>
@endsection

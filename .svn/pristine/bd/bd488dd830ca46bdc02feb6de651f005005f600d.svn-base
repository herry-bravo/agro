@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/drop-image.css') }}">
@endsection
@push('script')

@endpush
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.qm-material.store') }}" class="imgUploader" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card">

                    <div class="card-header">
                        <h6 class="card-title mb-25 mt-1">
                            <a href="{{ route('admin.qm-material.index') }}"
                                class="breadcrumbs__item">{{ trans('cruds.quality_management.title') }} </a>
                            <a href="{{ route('admin.qm-material.index') }}" class="breadcrumbs__item">
                                {{ trans('cruds.quality_management.material') }} </a>
                            <a href="{{ route('admin.qm-material.create') }}" class="breadcrumbs__item">
                                Create</a>
                        </h6>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-12">

                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">{{ trans('cruds.quality_management.fields.date') }}</label>
                                        <input type="text" id="" name="" class="form-control" value="{{$rcv_detail->rcvheader->gl_date->format('d-M-y') }}" >
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">{{ trans('cruds.quality_management.fields.aju') }}</label>
                                        <input type="text" id="" name="attribute_aju" class="form-control" value="{{$aju}}" >
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">{{ trans('cruds.quality_management.fields.supplier') }}</label>
                                        <input type="text" id="" name="" class="form-control" value="{{$rcv_detail->rcvheader->vendor_id}} - {{$rcv_detail->rcvheader->vendor->vendor_name}}" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label class="form-label" for="">{{ trans('cruds.quality_management.fields.item') }}</label>
                                        <input type="text" id="" name="" class="form-control" value="{{$rcv_detail->itemmaster->item_code}} - {{$rcv_detail->item_description}}" >
                                        <input type="hidden" id="" name="inventory_item_id" class="form-control" value="{{$rcv_detail->item_id}} " >
                                        <input type="hidden" id="" name="item_type" class="form-control" value="{{$rcv_detail->itemmaster->type_code}} " >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="">{{ trans('cruds.quality_management.fields.qty') }}</label>
                                        <input type="text" id="" name="quantity1" class="form-control" value="{{number_format($qty->qty, 3,'.') ?? ''}}" >
                                        <input type="hidden" id="" name="quantity" class="form-control" value="{{$qty->qty}}" >
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
                                                <input type="text" id="" name="attribute_long" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.short') }}</label>
                                                <input type="text" id="" name="attribute_short" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.out_throw') }}</label>
                                                <input type="text" id="" name="attribute_outtrhow" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.prohibitive') }}</label>
                                                <input type="text" id="" name="attribute_prohibitive" class="form-control" value="" >
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.moisture') }}</label>
                                                <input type="text" id="" name="attribute_moisture" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.grade') }}</label>
                                                <input type="text" id="" name="attribute_grade" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.keterangan') }}</label>
                                                <input type="text" id="" name="attribute_note" class="form-control" value="" >
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Tab priceList --}}
                            <div class="tab-pane fade" id="nav-priceList" role="tabpanel" aria-labelledby="nav-priceList-tab">
                                <div class="box-body " style="height: 300px;">
                                    <div class="col-md-12 mt-2">
                                        <div class="row mb-2">
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.hasil1') }}</label>
                                                <input type="text" id="" name="intattribute1" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.hasil2') }}</label>
                                                <input type="text" id="" name="intattribute2" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.hasil3') }}</label>
                                                <input type="text" id="" name="intattribute3" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.hasil4') }}</label>
                                                <input type="text" id="" name="intattribute4" class="form-control" value="" >
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.total') }}</label>
                                                <input type="text" id="" name="intattribute5" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.waktu') }}</label>
                                                <input type="text" id="" name="date_time" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.free') }}</label>
                                                <input type="text" id="" name="attribute_free" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.gsm') }}</label>
                                                <input type="text" id="" name="attribute_gsm" class="form-control" value="" >
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.thick') }}</label>
                                                <input type="text" id="" name="attribute_thick" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.bright') }}</label>
                                                <input type="text" id="" name="attribute_bright" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.light') }}</label>
                                                <input type="text" id="" name="attribute_light" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.ash') }}</label>
                                                <input type="text" id="" name="attribute_ash" class="form-control" value="" >
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.bst') }}</label>
                                                <input type="text" id="" name="attribute_bst" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.rct') }}</label>
                                                <input type="text" id="" name="attribute_rct" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.density') }}</label>
                                                <input type="text" id="" name="attribute_density" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.strength') }}</label>
                                                <input type="text" id="" name="attribute_strength" class="form-control" value="" >
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.hydra') }}</label>
                                                <input type="text" id="" name="attribute_hydra" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.tutup') }}</label>
                                                <input type="text" id="" name="" class="form-control" value="" >
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="">{{ trans('cruds.quality_management.fields.tgl_tutup') }}</label>
                                                <input type="text" id="" name="" class="form-control" value="" >
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{--Images--}}
                            <div class="tab-pane fade" id="nav-images" role="tabpanel" aria-labelledby="nav-images-tab">
                                <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                    <div id="dropBox">
                                        {{-- <form class="" enctype="multipart/form-data"> --}}
                                            <input type="file" id="imgUpload" class="imgUpload" name="path[]" multiple accept="image/*" onchange="filesManager(this.files)">
                                            <label class="btn btn-primary" for="imgUpload">Upload From Your Computer</label>
                                        {{-- </form> --}}
                                        <p>or   Drag & Drop Images Here...</p>
                                        <div id="gallery"></div>
                                    </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-between mb-1 mt-1">
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


@push('script')
{{-- image --}}
<script>
    let dropBox = document.getElementById('dropBox');

	['dragenter', 'dragover', 'dragleave', 'drop'].forEach(evt => {
		dropBox.addEventListener(evt, prevDefault, false);
	});
	function prevDefault (e) {
		e.preventDefault();
		e.stopPropagation();
	}

	// remove and add the hover class, depending on whether something is being
	// actively dragged over the box area
	['dragenter', 'dragover'].forEach(evt => {
		dropBox.addEventListener(evt, hover, false);
	});
	['dragleave', 'drop'].forEach(evt => {
		dropBox.addEventListener(evt, unhover, false);
	});
	function hover(e) {
		dropBox.classList.add('hover');
	}
	function unhover(e) {
		dropBox.classList.remove('hover');
	}

	dropBox.addEventListener('drop', mngDrop, false);
	function mngDrop(e) {
		let dataTrans = e.dataTransfer;
		let files = dataTrans.files;

        document.querySelector('.imgUpload').files = e.dataTransfer.files; // Transfer dragged type file to form input file
		filesManager(files);
	}

	function previewFile(file) { // ------------ Untuk menampilkan preview images ----------
		let imageType = /image.*/;
		if (file.type.match(imageType)) {
			let fReader = new FileReader();
			let gallery = document.getElementById('gallery');

			fReader.readAsDataURL(file);

			fReader.onloadend = function() {
				let wrap = document.createElement('div');
				let img = document.createElement('img');
				let imgCapt = document.createElement('p');

				img.src = fReader.result;

				let fSize = (file.size / 1000) + ' KB';
				imgCapt.innerHTML = `<span class="fName">${file.name}</span><span class="fSize">${fSize}</span><span class="fType">${file.type}</span>`;
				gallery.appendChild(wrap).appendChild(img);
				gallery.appendChild(wrap).appendChild(imgCapt);
			}
		} else {
			alert("Only images are allowed!", file);
		}
	}

	function filesManager(files) {
		files = [...files];
		files.forEach(previewFile);
	}

</script>
@endpush

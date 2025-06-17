@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush
@section('breadcrumbs')
<a href="{{route('admin.completion.index')}}" class="breadcrumbs__item">{{ trans('cruds.bom.manufacture') }}</a>
<a href="{{route('admin.completion.index')}}" class="breadcrumbs__item">{{ trans('cruds.workorder.completion') }} {{ trans('global.list') }}</a>
<a href="#" class="breadcrumbs__item active">{{ trans('cruds.workorder.fields.edit') }}</a>
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    {{ $error }}
    @endforeach
</div>
@endif
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.completion.quality') }}" method="POST" enctype="multipart/form-data" novalidate>
                {{-- @csrf
                @method('PUT') --}}
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header" style="height: 40px">
                        <div class="row col-12">
                            <div class="col-md-8 mt-1">Detail Completion</div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body mt-2">
                        <div class="row mb-2">
                            <div class="col-md-1">
                                <b><p class="text-end">Roll :<p></b>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="uniq_attribute_roll" class="form-control" readonly value="{{$roll->uniq_attribute_roll}}" autocomplete="off" required>
                                <input type="hidden" name="inventory_item_id" class="form-control" readonly value="{{$roll->inventory_item_id}}" autocomplete="off" required>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-1">
                                <b><p class="text-end">Jumbo :</p></b>
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="reference" value="{{$roll->attribute_roll}}" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-1">
                                <b><p class="text-end">Quantity :<p></b>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="" class="form-control" value="{{$roll->primary_quantity}}" required>
                                <input type="date" hidden name="transaction_date" class="form-control" value="{{date('Y-m-d')}}" required>
                                <input type="text" hidden name="id" class="form-control" value="{{$quality->id ?? 0}}" required>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-1">
                                <b><p class="text-end">Quality :</p></b>
                            </div>
                            <div class="col-md-5">
                                <input type="text"   class="form-control datepicker" id="" value="{{$roll->attribute_num_quality}}" autocomplete="off" required>
                                <input type="number" hidden id="created_by" name="" value="{{ auth()->user()->id }}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-1">
                                <b><p class="text-end">GSM :<p></b>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="" class="form-control" value="{{$roll->attribute_number_gsm}}" required>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-1">
                                <b><p class="text-end">Width :</p></b>
                            </div>
                            <div class="col-md-5">
                                <input type="text"   class="form-control datepicker" value="{{$roll->attribute_number_w}}" autocomplete="off" required>
                            </div>
                        </div>

                    <!-- /.box-body -->
                    </div>
                {{-- </div>

                <div class="card"> --}}
                    <div class="card-header">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-component-tab" data-bs-toggle="tab" data-bs-target="#nav-component" type="button" role="tab" aria-controls="nav-component" aria-selected="true">
                                <span class="bs-stepper-box">
                                    <i data-feather="tool" class="font-medium-3"></i>
                                </span>
                                Quality Control
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">

                        {{-- Quality Management --}}
                        <div class="row mt-2">
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">Jumbo</label>
                                    <input type="text" name="" class="form-control"  value="0" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">Roll</label>
                                    <input type="text"  class="form-control"  value="0" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">Width</label>
                                    <input class="form-control" type="text" value='0'>
                                </div>
                            </div>

                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="site">Ø</label>
                                    <input type="number" class="form-control" name="attribute_number_25" value="{{$quality->attribute_number_25 ?? 0}}">
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">Weight</label>
                                    <input type="text" name="attribute_number_26" class="form-control"  value="{{$quality->attribute_number_26 ?? 0}}" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">Quality</label>
                                    <select name="attribute_number_9" id="quality" class="form-control select2" required>
                                        <option hidden selected>  </option>
                                        <option value="1"> Q1 </option>
                                        <option value="2"> Q2 </option>
                                        <option value="3"> Q3 </option>
                                        <option value="4"> Q4 </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">GSM</label>
                                    <input class="form-control" name="attribute_number_1" type="text" value='{{$quality->attribute_number_1 ?? 0}}'>
                                </div>
                            </div>

                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="site">RCT</label>
                                    <input type="number" name="attribute_number_10" class="form-control" name="" value="{{$quality->attribute_number_10 ?? 0}}">
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">BST</label>
                                    <input type="text"  name="attribute_number_11" class="form-control"  value="{{$quality->attribute_number_11 ?? 0}}" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">COBB</label>
                                    <input type="text"  class="form-control"  name="attribute_number_7" value="{{$quality->attribute_number_7 ?? 0}}" autocomplete="off" required>
                                    <input type="hidden"  class="form-control"  name="attribute_number_8" value="0" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">Smooth Top</label>
                                    <input class="form-control"  name="attribute_number_12" type="text" value='{{$quality->attribute_number_12 ?? 0}}'>
                                </div>
                            </div>

                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="site">Smooth Buttom</label>
                                    <input type="number" class="form-control"  name="attribute_number_13" value="{{$quality->attribute_number_13 ?? 0}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">Folding CD</label>
                                    <input type="text" name="attribute_number_14" class="form-control"  value="{{$quality->attribute_number_14 ?? 0}}" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">Busted</label>
                                    <input type="text"  class="form-control"  name="attribute_number_4" value="{{$quality->attribute_number_4 ?? 0}}" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">Length</label>
                                    <input class="form-control"  name="attribute_number_15" type="text" value='{{$quality->attribute_number_15 ?? 0}}'>
                                </div>
                            </div>

                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="site">Hard</label>
                                    <input type="number" class="form-control"  name="attribute_number_16" value="{{$quality->attribute_number_16 ?? 0}}">
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">SRC</label>
                                    <input type="text"  name="attribute_number_17" class="form-control"  value="{{$quality->attribute_number_17 ?? 0}}" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">Export</label>
                                    <input type="text"  name="attribute_number_18" class="form-control"  value="{{$quality->attribute_number_18 ?? 0}}" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">Coating</label>
                                    <input class="form-control"  name="attribute_number_19" type="text" value='{{$quality->attribute_number_19 ?? 0}}'>
                                </div>
                            </div>

                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="site">Label</label>
                                    <select  name="attribute_number_20" id="label" class="form-control select2" required>
                                        <option hidden selected>  </option>
                                        <option value="1"> Kecil </option>
                                        <option value="2"> Besar </option>
                                        <option value="3"> Polos </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">Color</label>
                                    <select name="attribute_number_21" id="color" class="form-control select2" required>
                                        <option hidden selected>  </option>
                                        <option value="1"> Green </option>
                                        <option value="2"> Blue </option>
                                        <option value="3"> Red </option>
                                        <option value="4"> Brown </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">Config</label>
                                    <select name="attribute_number_22" id="config" class="form-control select2" required>
                                        <option hidden selected>  </option>
                                        <option value="1"> 1 </option>
                                        <option value="2"> 2 </option>
                                        <option value="3"> 3 </option>
                                        <option value="4"> 4 </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">BP</label>
                                    <select name="attribute_number_23" id="bp" class="form-control select2" required>
                                        <option hidden selected>  </option>
                                        <option value="1"> 1 </option>
                                        <option value="2"> 2 </option>
                                        <option value="3"> 3 </option>
                                        <option value="4"> 4 </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-1 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="site">Broke</label>
                                    <input type="number" class="form-control" name="attribute_number_24" value="{{$quality->attribute_number_24 ?? 0}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">Status</label>
                                    <select name="roll_status" id="status" class="form-control select2" required>
                                        <option hidden selected>  </option>
                                        <option value="1"> Produksi </option>
                                        <option value="2"> Chainsaw </option>
                                        <option value="3"> Penyesuaian </option>
                                        <option value="4"> Retur </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">Description</label>
                                    <input type="text" name="description" class="form-control"  value="{{$quality->description ?? ''}}" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-5 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="number">Problem</label>
                                    <input class="form-control" name="problem" type="text" value='{{$quality->problem ?? ''}}'>
                                    <input class="form-control" name="roll_type" type="hidden" value='Roll'>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="mb-2">
                                    <label class="col-sm-0 control-label" for="site">Condition</label>
                                    <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple" required>
                                        <option value="Alur">Alur</option>
                                        <option value="Belang">Belang</option>
                                        <option value="Blorok">Blowing</option>
                                        <option value="Bercak">Bercak</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-between ">
                            <div></div>
                            <button type="submit"  value="save" class="btn btn-primary pull-right "><i class="fa fa-plus"></i> Add</button>
                        </div>

                    </div>
                    <!-- /.box-body -->

                </div>

            </form>
        </div>
</section>
<!-- /.content -->
@endsection

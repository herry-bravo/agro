@extends('layouts.admin')
@section('styles')
@endsection
@push('script')
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
@endpush
@section('breadcrumbs')
<nav class="breadcrumbs">
    <a href="" class="breadcrumbs__item">{{ trans('cruds.OrderManagement.title') }}</a>
    <a href="" class="breadcrumbs__item active">Invoice</a>
</nav>
@endsection
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-2">{{ trans('cruds.Invoice.title') }}</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary" href="" data-bs-toggle="modal" data-bs-target="#modaladd">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg></span>
                                {{ trans('global.add') }} {{ trans('cruds.shiping.button.add_record') }}
                            </a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="mb-1">
                                <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.nama_pelanggan') }}</label>
                                <input type="text" id="segment1" name="segment1" class="form-control" value="" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-1">
                                <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.no_faktur') }}</label>
                                <input type="text" id="segment1" name="segment1" class="form-control" value="" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-1">
                                <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.nomor_so') }}</label>
                                <input type="text" id="segment1" name="segment1" class="form-control" value="" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-1">
                                <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.tanggal_faktur') }}</label>
                                <input type="date" id="segment1" name="segment1" class="form-control datepicker" value="" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="mb-1">
                                <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.proyek') }}</label>
                                <input type="text" id="segment1" name="segment1" class="form-control" value="" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="mb-1">
                                <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.mata_uang') }}</label>
                                <input type="text" id="segment1" name="segment1" class="form-control datepicker" value="" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="mb-1">

                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="mb-2">
                            <label class="form-label" for="segment1"></label>

                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                {{ trans('cruds.Invoice.field.jasa') }}
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="mb-1">
                                <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.keluar_dari_gudang') }}</label>
                                <input type="text" id="segment1" name="segment1" class="form-control" value="" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-1">
                                <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.ket') }}</label>
                                <input type="text" id="segment1" name="segment1" class="form-control" value="" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-1">
                                <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.dep') }}</label>
                                <input type="text" id="segment1" name="segment1" class="form-control" value="" required>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-3">
                            <div class="mb-1">

                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="mb-1">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                {{ trans('cruds.Invoice.field.tunai') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="box box-default">
                            {{-- <div class="box-body scrollx" style="height: 450px;overflow: scroll;"> --}}
                                <table class="table table-bordered table-striped table-hover datatable inv_datatable" id="inv_datatable">
                                    <thead>
                                        <tr>
                                            <th>
                                            </th>
                                            <th scope="col">
                                                {{ trans('cruds.Delivery.table.no_barang') }}
                                            </th>
                                            <th scope="col">
                                                {{ trans('cruds.Delivery.table.desc_barang') }}
                                            </th>
                                            <th scope="col">
                                                {{ trans('cruds.Delivery.table.jumlah') }}
                                            </th>
                                            <th scope="col">
                                                {{ trans('cruds.Delivery.table.satuan') }}
                                            </th>
                                            <th scope="col">
                                                {{ trans('cruds.Delivery.table.job') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($DeliveryDetail as $row)
                                            <tr>
                                                <td style="width: 0%">

                                                </td>
                                                <td>
                                                    {{ $row->delivery_id ?? '' }}
                                                </td>
                                                <td>
                                                    {{ $row->delivery_name ?? '' }}

                                                </td>
                                                <td>
                                                    {{ $row->status_code ?? '' }}

                                                </td>
                                                <td>
                                                    {{ $row->gross_weight ?? '' }}

                                                </td>
                                                <td>
                                                    {{ $row->attribute2 ?? '' }}

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <footer>
                                        <tr>
                                            <th>
                                                Total
                                            </th>
                                            <th>

                                            </th>
                                            <th>

                                            </th>
                                            <th>

                                            </th>
                                            <th class="text-center">
                                                {{-- {{$totalgross_weight}} --}}
                                            </th>
                                            <th>

                                            </th>
                                        </tr>
                                    </footer>
                                </table>
                                <br>
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">home</div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">profil</div>
                                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">contact</div>
                                </div>
                                    <br>
                                <form>
                                    <div class="form-group row">
                                    <div class="col-md-8">
                                        <div class="mb-1">

                                        </div>
                                    </div>
                                    <label for="" class="col-sm-1 col-form-label">{{ trans('cruds.Invoice.field.biayalain') }}</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                    <div class="col-md-8">
                                        <div class="mb-1">

                                        </div>
                                    </div>
                                    <label for="" class="col-sm-1 col-form-label">{{ trans('cruds.Invoice.field.disc_fin') }}</label>
                                    <div class="col-sm-1">
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    %
                                    <!-- <button class="btn btn-space" type="submit">%</button> -->

                                    <!-- <label for="" class="col-sm-1 col-form-label">%</label> -->

                                    <div class="col-sm-1">
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">

                                    <div class="col-md-8">
                                        <div class="mb-1">

                                        </div>
                                    </div>
                                        <label for="" class="col-sm-1 col-form-label">{{ trans('cruds.Invoice.field.tot') }}</label>
                                        <div class="col-sm-3">
                                        <input type="text" class="form-control" id="">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                    <div class="col-md-2">
                                        <div class="mb-1">
                                            <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.tgl_peng') }}</label>
                                            <input type="date" id="segment1" name="segment1" class="form-control datepicker" value="" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-2">
                                        <div class="mb-1">
                                            <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.sales') }}</label>
                                            <input type="text" id="segment1" name="segment1" class="form-control " value="" required>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <div class="col-md-8">
                                        <div class="mb-1">
                                        </div>
                                    </div>

                                    <label for="" class="col-sm-1 col-form-label">{{ trans('cruds.Invoice.field.tot_paj') }} </label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="">
                                    </div>
                                    </div>
                                </form>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        // $('#inv_datatable').DataTable({
        //     ajax:'./../invoices/store',
        //     columns:[
        //         { data:'id',name:'id'},
        //         { data:'unique_no',name:'unique_no'},
        //         { data: 'name', name: 'name' },
        //         { data: 'created_at', name:'created_at'}
        //     ],
        // });
    </script>
@endpush

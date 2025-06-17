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
        <form action="{{ route('admin.invoices.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{ csrf_field() }}
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-2">{{ trans('cruds.Invoice.title') }}</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit"  class="btn btn-sm btn-primary pull-right" onclick="myFunction()"> <i data-feather="corner-down-right" class="font-medium-3"></i> Submit</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-1">
                                <label class="form-label" for="bill_to">{{ trans('cruds.Invoice.field.cust') }}</label>
                                <select name="bill_to" id="customer" class="form-control select2" required>
                                    <option readonly value="{{$sales->customer->party_name}}" {{old('customer_name') ? 'selected' : '' }} selected> {{$sales->customer->party_name}} - {{$sales->customer->address1}}, {{$sales->customer->city}} </option>
                                </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.faktur_no') }}</label>
                                    <select id="tax" name="tax" class="form-control select2" required>
                                        @foreach($faktur as $row)
                                            <option value="{{$row->faktur_code}}" {{old('customer_name') ? 'selected' : '' }} selected> {{$row->faktur_code}}</option>
                                        @endforeach
                                    </select>
                                    
                                    <input autocomplete="off" type="text" id="segment1" name="segment1" class="form-control" value="" required>
                                    <input type="number" hidden id="created_by" name="created_by" value="{{ auth()->user()->id }}" class="form-control">
                                    <input type="number" hidden id="last_updated_by" name="last_updated_by" value="{{ auth()->user()->id }}" class="form-control">
                                    <input type="number" hidden id="status " name="status" value="0" class="form-control">
                                    <input type="number" hidden id="status " name="je_batch_id" value="{{random_int(0, 999999)}}" class="form-control">
                                    <input type="number" hidden id="status " name="organization_id" value="222" class="form-control">
                                    <input type="number" hidden id="status " name="je_batch_id" value="{{random_int(0, 999999)}}" class="form-control">
                                </div>
                            </div> -->
                            <!-- <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.faktur_no') }}</label>

                                    <select id="faktur" name="faktur" class="form-control select2" required>
                                        @foreach($faktur as $row)
                                            <option value="{{$row->faktur_code}}" {{old('customer_name') ? 'selected' : '' }}> {{$row->faktur_code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.so_number') }}</label>
                                    <input type="text" readonly id="segment1" name="so_number" class="form-control" value="{{$sales->order_number}}" required>
                                    <input type="hidden" readonly id="term" name="term" class="form-control" value="{{$sales->attribute3}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.tax_date') }}</label>
                                    <input type="date" id="segment1" name="segment1" class="form-control datepicker" value="" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.tax') }}</label>
                                    <select id="tax" name="tax" class="form-control select2" >
                                        @foreach($tax as $row)
                                            @if (($row->tax_rate)== $sales->tax_exempt_flag))
                                                <option value="{{$row->tax_rate}}" {{old('customer_name') ? 'selected' : '' }}> {{$row->tax_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.currency') }}</label>
                                    <select name="customer_currency" id="customer_currency" class="form-control select2" required value="{{$sales->attribute1}}">
                                    <option value="{{$sales->attribute1}}" {{old('customer_name') ? 'selected' : '' }} selected> {{$sales->attribute1}}</option>
                                    </select>
                                </div>
                            </div>
                           
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.journal') }}</label>
                                    <select name="je_category" id="je_category" class="form-control select2" >
                                        @foreach($trx as $row)
                                            <option value="{{$row->trx_source_types}}"> {{$row->trx_source_types}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.noinv') }}</label>
                                    <input type="text" id="noinv" name="noinv" class="form-control" value="INV-{{$sales->order_number}}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.invdate') }}</label>
                                    <input type="date" id="tgl_invoice" name="tgl_invoice" class="form-control" required>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-3">
                                <div class="mb-1">

                                </div>
                            </div>
                        </div>
                        <br>
                       

                        <!-- tab jurnal -->
                        <div class="card-header">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-sales-tab" data-bs-toggle="tab" data-bs-target="#nav-sales" type="button" role="tab" aria-controls="nav-sales" aria-selected="true">
                                        <span class="bs-stepper-box">
                                            <i data-feather="file-text" class="font-medium-3"></i>
                                        </span>
                                        {{ trans('cruds.Invoice.field.invlines') }}
                                    </button>
                                   
                                    <button class="nav-link" id="nav-shipment-tab" data-bs-toggle="tab" data-bs-target="#nav-shipment" type="button" role="tab" aria-controls="nav-shipment" aria-selected="false">
                                        <span class="bs-stepper-box">
                                            <i data-feather="book-open" class="font-medium-3"></i>
                                        </span>
                                        {{ trans('cruds.Invoice.field.journalitm') }}
                                    </button>
                                </div>
                            </nav>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="tab-content" id="nav-tabContent">
                                {{-- Tab Invoice Lines --}}
                                <div class="tab-pane fade show active" id="nav-sales" role="tabpanel" aria-labelledby="nav-sales-tab">
                                    <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                        <table class="table table-bordered table-striped table-hover datatable inv_datatable" id="inv_datatable">
                                            <thead>
                                                <tr>
                                                    <th>
                                                    </th>
                                                    <th scope="col">
                                                        {{ trans('cruds.Invoice.field.desc') }}
                                                    </th>
                                                    <th scope="col">
                                                        {{ trans('cruds.Invoice.field.qty') }}
                                                    </th>
                                                    <th scope="col">
                                                        {{ trans('cruds.Invoice.field.price') }}
                                                    </th>
                                                    <th scope="col">
                                                        {{ trans('cruds.Invoice.field.shpdate') }}
                                                    </th>
                                                    <th scope="col">
                                                        {{ trans('cruds.Invoice.field.up') }}
                                                    </th>
                                                    <th scope="col">
                                                        {{ trans('cruds.Invoice.field.subtotal') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $unitprice = 0; // Variabel untuk menyimpan total
                                                    $total = 0; // Variabel untuk menyimpan total
                                                    $tax = 0; // Variabel untuk menyimpan total
                                                @endphp
                                                @foreach($so_detil as $row)
                                                    <tr>
                                                        <td>

                                                        </td>
                                                        <td>
                                                            {{ $row->user_description_item ?? '' }}
                                                        </td>
                                                        <td>
                                                            {{ number_format($row->ordered_quantity ?? '') }}

                                                        </td>
                                                        <td>
                                                            {{ number_format($row->unit_selling_price ?? '') }}

                                                        </td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($row->schedule_ship_date)->format('d-m-Y') ?? '' }}
                                                        </td>
                                                        <td>
                                                            {{ number_format($row->unit_percent_base_price ?? '') }}
                                                        </td>
                                                        <td>
                                                            {{ number_format($row->unit_list_price ?? '') }}
                                                        </td>
                                                        @php
                                                            // Tambahkan hasil perkalian ke total
                                                            $unitprice += $row->unit_percent_base_price ?? 0;
                                                            $total += $row->unit_list_price ?? 0;
                                                            $tax = $unitprice - $total;
                                                        @endphp
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
                                                    <th>
                                                    </th>
                                                    <th >
                                                        {{ number_format($unitprice) }}
                                                    </th>
                                                    <th>
                                                        {{ number_format($total) }}
                                                    </th>
                                                </tr>
                                            </footer>
                                        </table>
                                    </div>
                                </div>
                                <br>
                               
                                {{-- Tab Journal items --}}
                                <div class="tab-pane fade" id="nav-shipment" role="tabpanel" aria-labelledby="nav-shipment-tab">
                                    <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                        <table class="table table-striped tableFixHead" id="tab_logic">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th scope="col">{{ trans('cruds.Invoice.field.account')}}</th>
                                                    <th scope="col">{{ trans('cruds.Invoice.field.label') }}</th>
                                                    <th scope="col">{{ trans('cruds.Invoice.field.debit')}}</th>
                                                    <th scope="col">{{ trans('cruds.Invoice.field.credit')}}</th>
                                                </tr>
                                            </thead>
                                            @php
                                                $totalDr = 0;
                                                $totalCr = 0;
                                            @endphp

                                            <tbody class="sales_order_shipment_container">
                                                @foreach($so_detil as $row)
                                                    @php
                                                        $drValue = 0; // Karena DR pada loop pertama selalu 0
                                                        $crValue = $row->unit_list_price;
                                                        $totalDr += $drValue;
                                                        $totalCr += $crValue;
                                                    @endphp
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            {{ $row->products->category->acc->account_code ?? '' }} - {{ $row->products->category->acc->description ?? '' }}
                                                            <input type="hidden" name="accDes[]" value="{{ $row->products->category->acc->account_code ?? '' }}">
                                                            <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_1" autocomplete="off">
                                                        </td>
                                                        <td>
                                                            {{ $row->user_description_item ?? '' }}
                                                            <input type="hidden" name="desc[]" value="{{ $row->user_description_item ?? '' }}">
                                                        </td>
                                                        <td>
                                                            {{ number_format($drValue) }}
                                                            <input type="hidden" name="dr[]" value="{{ $drValue }}">
                                                        </td>
                                                        <td>
                                                            {{ number_format($crValue) }}
                                                            <input type="hidden" name="cr[]" value="{{ $crValue }}">
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                @foreach($so_detil as $row)
                                                    @php
                                                        $drValue = $row->products->item_cost*$row->ordered_quantity;
                                                        $crValue = 0; // CR pada loop kedua selalu 0
                                                        $totalDr += $drValue;
                                                        $totalCr += $crValue;
                                                    @endphp
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <input type="hidden" name="accDes[]" value="{{ $row->products->category->cogs->account_code ?? '' }}">
                                                            <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_1" autocomplete="off">
                                                            {{ $row->products->category->cogs->account_code ?? '' }} - {{ $row->products->category->cogs->description ?? '' }}
                                                        </td>
                                                        <td>
                                                            {{ $row->user_description_item ?? '' }}
                                                            <input type="hidden" name="desc[]" value="{{ $row->user_description_item ?? '' }}">
                                                        </td>
                                                        <td>
                                                            {{ number_format($drValue) }}
                                                            <input type="hidden" name="dr[]" value="{{ $drValue }}">
                                                        </td>
                                                        <td>
                                                            {{ number_format($crValue) }}
                                                            <input type="hidden" name="cr[]" value="{{ $crValue }}">
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                @foreach($so_detil as $row)
                                                    @php
                                                        $drValue = 0; // DR pada loop ketiga selalu 0
                                                        $crValue = $row->products->item_cost *$row->ordered_quantity;
                                                        $totalDr += $drValue;
                                                        $totalCr += $crValue;
                                                    @endphp
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_1" autocomplete="off">
                                                            <input type="hidden" name="accDes[]" value="{{ $row->products->category->cogs->account_code ?? '' }}">
                                                            {{ $row->products->category->inventory->account_code ?? '' }} - {{ $row->products->category->inventory->description ?? '' }}
                                                        </td>
                                                        <td>
                                                            {{ $row->user_description_item ?? '' }}
                                                            <input type="hidden" name="desc[]" value="{{ $row->user_description_item ?? '' }}">
                                                        </td>
                                                        <td>
                                                            {{ number_format($drValue) }}
                                                            <input type="hidden" name="dr[]" value="{{ $drValue }}">
                                                        </td>
                                                        <td>
                                                            {{ number_format($crValue) }}
                                                            <input type="hidden" name="cr[]" value="{{ $crValue }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                

                                                <!-- Account PPN -->
                                                @php
                                                    $drValue = 0; // DR untuk PPN selalu 0
                                                    $crValue = $tax ?? 0;
                                                    $totalDr += $drValue;
                                                    $totalCr += $crValue;
                                                @endphp
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_1" autocomplete="off">
                                                        <input type="hidden" name="accDes[]" value="{{ $ppn->account_code ?? '' }}">
                                                        {{ $ppn->account_code ?? '' }} - {{ $ppn->description ?? '' }}
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="desc[]" value="{{ $ppn->account_group ?? '' }}">
                                                        {{ $ppn->account_group ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($drValue) }}
                                                        <input type="hidden" name="dr[]" value="{{ $drValue }}">
                                                    </td>
                                                    <td>
                                                        {{ number_format($crValue) }}
                                                        <input type="hidden" name="cr[]" value="{{ $crValue }}">
                                                    </td>
                                                </tr>

                                                @foreach($so_detil as $row)
                                                    @php
                                                        $drValue = $row->unit_percent_base_price; // DR pada loop ketiga selalu 0
                                                        $crValue = 0;
                                                        $totalDr += $drValue;
                                                        $totalCr += $crValue;
                                                    @endphp
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_1" autocomplete="off">
                                                            <input type="hidden" name="accDes[]" value="{{ $row->products->category->cogs->account_code ?? '' }}">
                                                            @if($sales->attribute3 == 'cash')
                                                                {{ $row->products->category->cash->account_code ?? '' }} - {{ $row->products->category->acccash->description ?? '' }}
                                                            @else
                                                                {{ $row->products->category->arTax->account_code ?? '' }} - {{ $row->products->category->accReceivable->description ?? '' }}
                                                            @endif

                                                            <!-- {{ $row->products->category->cash->account_code ?? '' }} - {{ $row->products->category->accReceivable->description ?? '' }}
                                                            {{ $row->products->category->arTax->account_code ?? '' }} - {{ $row->products->category->accReceivable->description ?? '' }} -->
                                                        </td>
                                                        <td>
                                                            INV-{{$sales->order_number}}
                                                            <input type="hidden" name="desc[]" value="{{ $row->user_description_item ?? '' }}">
                                                        </td>
                                                        <td>
                                                            {{ number_format($drValue) }}
                                                            <input type="hidden" name="dr[]" value="{{ $drValue }}">
                                                        </td>
                                                        <td>
                                                            {{ number_format($crValue) }}
                                                            <input type="hidden" name="cr[]" value="{{ $crValue }}">
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                <!-- Total DR dan CR -->
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td>
                                                        {{$sales->attribute1}} {{ number_format($totalDr) }}
                                                        <input type="hidden" name="total_dr" value="{{ $totalDr }}">
                                                    </td>
                                                    <td>
                                                        {{$sales->attribute1}} {{ number_format($totalCr) }}
                                                        <input type="hidden" name="total_cr" value="{{ $totalCr }}">
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-document" role="tabpanel" aria-labelledby="nav-document-tab">
                                    <div class="box-body scrollx" style="height: 300px;overflow: scroll;">

                                        <div class="d-flex justify-content-center" style="margin-top: 5%;">
                                            <a href="#imgModal" data-bs-toggle="modal" class="link-info">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="75" height="60" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                                    <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z" />
                                                </svg>
                                                {{ trans('cruds.itemMaster.fields.img') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-2 mt-2">
                            <div></div>
                            <!-- <button type="submit"  class="btn btn-sm btn-primary pull-right" onclick="myFunction()"> <i data-feather="corner-down-right" class="font-medium-3"></i> Submit</button> -->
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
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

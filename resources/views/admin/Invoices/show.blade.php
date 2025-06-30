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
                    <div class="card-header ">
                        <h6 class="card-title ">
                            <a href="{{ route('admin.invoices.index') }}"
                                class="breadcrumbs__item">Accounting & GL</a>
                            <a href="{{ route('admin.invoices.index') }}"
                                class="breadcrumbs__item">{{ trans('cruds.OrderManagement.inv') }} </a>
                            <a href="{{ route('admin.invoices.index') }}"
                                class="breadcrumbs__item"> {{$sales->inv_number}}</a>
                                
                        </h6>

                        <div class="row">
                            <div class="col-lg-12">
                                <a class="btn btn-primary" href="#" id="printButton">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-50 font-small-4">
                                            <path d="M19 8h-2V5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v3H5a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2zM9 5h6v3H9V5zM5 10h14v9H5v-9z"></path>
                                        </svg>
                                    </span>
                                    Print Invoice
                                </a>
                                <a class="btn btn-primary" href="#" id="printStruk">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-50 font-small-4">
                                            <path d="M19 8h-2V5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v3H5a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2zM9 5h6v3H9V5zM5 10h14v9H5v-9z"></path>
                                        </svg>
                                    </span>
                                    Struk
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-1">
                                <label class="form-label" for="bill_to">{{ trans('cruds.Invoice.field.cust') }}</label>
                                <select name="bill_to" id="customer" class="form-control select2" required>
                                    <option readonly value="{{$sales->customer->party_name}}" {{old('customer_name') ? 'selected' : '' }} selected> {{$sales->customer->party_name}} - {{$sales->customer->address1}}, {{$sales->customer->city}} </option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.faktur_no') }}</label>
                                    <select name="faktur" id="faktur" class="form-control select2" required value="{{$sales->faktur}}">
                                    <option value="{{$sales->faktur}}" {{old('customer_name') ? 'selected' : '' }} selected> {{$sales->faktur}}</option>
                                    </select>
                                    <!-- <input autocomplete="off" type="text" id="segment1" name="segment1" class="form-control" value="" required> -->
                                    <input type="number" hidden id="created_by" name="created_by" value="{{ auth()->user()->id }}" class="form-control">
                                    <input type="number" hidden id="last_updated_by" name="last_updated_by" value="{{ auth()->user()->id }}" class="form-control">
                                    <input type="number" hidden id="status " name="status" value="0" class="form-control">
                                    <input type="number" hidden id="status " name="je_batch_id" value="{{random_int(0, 999999)}}" class="form-control">
                                    <input type="number" hidden id="status " name="organization_id" value="222" class="form-control">
                                    <input type="number" hidden id="status " name="je_batch_id" value="{{random_int(0, 999999)}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.so_number') }}</label>
                                    <input type="text" readonly id="segment1" name="so_number" class="form-control" value="{{$sales->order_number}}" required>
                                </div>
                            </div>
                           
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.currency') }}</label>
                                    <select name="customer_currency" id="customer_currency" class="form-control select2" required value="{{$sales->attribute1}}">
                                    <option value="{{$sales->attribute1}}" {{old('customer_name') ? 'selected' : '' }} selected> {{$sales->attribute1}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.tax') }}</label>
                                    <select id="tax" name="tax" class="form-control select2" required>
                                        @foreach($tax as $row)
                                            @if (($row->tax_rate)== $sales->tax_exempt_flag))
                                                <option value="{{$row->tax_rate}}" {{old('customer_name') ? 'selected' : '' }}> {{$row->tax_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.journal') }}</label>
                                    <select name="je_category" id="je_category" class="form-control select2" required>
                                        @foreach($trx as $row)
                                            <option value="{{$row->trx_source_types}}"> {{$row->trx_source_types}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1">{{ trans('cruds.Invoice.field.noinv') }}</label>
                                    <input type="text" id="noinv" name="noinv" class="form-control" value="{{$sales->inv_number}}" readonly required>
                                </div>
                            </div>
                            
                            <br>
                            <div class="col-md-3">
                                <div class="mb-1">

                                </div>
                            </div>
                            <!-- <div class="col-md-1">
                                <div class="mb-1">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                    {{ trans('cruds.Invoice.field.tunai') }}
                                    </label>
                                </div>
                            </div> -->
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
                                                    $disc = 0; // Variabel untuk menyimpan total
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
                                                            $disc += $row->disc ?? 0;
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
                                                            {{ $row->products->category->arTax->account_code ?? '' }} - {{ $row->products->category->inventory->description ?? '' }}
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
    {{-- Include jsPDF dan plugin autoTable --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

    {{-- Kirim data invoice dari server ke JS --}}
    <script>
        const invoiceItems = @json($so_detil);
    </script>

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
  
 
    <script>
        document.getElementById('printStruk').addEventListener('click', function (e) {
            e.preventDefault();

            const { jsPDF } = window.jspdf;

            // Data toko
            const storeName = "TOKO PERTANIAN SURYA";
            const storeAddress = "DESA SEGODOREJO - SUMOBITO JOMBANG";
            const cashierName = "Cashier: {{$user}}";
            const transactionId = "{{$sales->order_number}}";
            const purchaseDate = new Date().toLocaleDateString();

            // Data produk dari Laravel Blade
            const items = [
                @foreach($so_detil as $row)
                {
                    name : "{{ $row->user_description_item ?? '' }}",
                    qty  : "{{ number_format($row->ordered_quantity ?? 0) }}",
                    price: "{{ number_format($row->unit_selling_price ?? 0) }}",
                    total: "{{ number_format($unitprice ?? 0) }}"
                },
                @endforeach
            ];


            // Menghitung total harga
            let totalAmount = 0;
            items.forEach(item => {
                totalAmount += parseFloat(item.total.replace(/,/g, '')) || 0;
            });

            // Menghitung tinggi dokumen secara dinamis
            const baseHeight = 50; // Tinggi minimum
            const rowHeight = 12;  // Tinggi per item
            const totalHeight = baseHeight + (items.length * rowHeight);

            // Membuat dokumen dengan tinggi dinamis
            const doc = new jsPDF('p', 'mm', [57, totalHeight]);

            // Layout pengaturan margin dan font
            const margin = 2;
            let y = 7; // Posisi awal vertikal

            doc.setFont("helvetica");

            // Nama Toko (Besar & Tengah)
            doc.setFontSize(12);
            doc.setFont("helvetica", "bold");
            const textWidth = doc.getTextWidth(storeName);
            doc.text(storeName, (57 - textWidth) / 2, y);
            y += 3;

            // Alamat Toko
            doc.setFontSize(6);
            doc.setFont("helvetica", "normal");
            const addrWidth = doc.getTextWidth(storeAddress);
            doc.text(storeAddress, (57 - addrWidth) / 2, y);
            y += 4;

            const labelX = margin;         // posisi label kiri
            const valueX = margin + 14;    // posisi nilai rata setelah titik dua

            doc.setFontSize(6);
            doc.setFont("helvetica", "normal");

            doc.text('Cashier', labelX, y);
            doc.text(':', labelX + 12, y);
            doc.text(cashierName.replace('Cashier: ', ''), valueX, y);
            y += 3;

            doc.text('Transaction', labelX, y);
            doc.text(':', labelX + 12, y);
            doc.text(transactionId, valueX, y);
            y += 3;

            doc.text('Date', labelX, y);
            doc.text(':', labelX + 12, y);
            doc.text(purchaseDate, valueX, y);
            y += 4;

            // Garis pemisah
            doc.line(margin, y, 55, y);
            y += 3;

            // **Format tabel vertikal**
            let maxHeight = 200; // Maksimal tinggi sebelum pindah halaman
            function wrapText(doc, text, maxWidth) {
                return doc.splitTextToSize(text, maxWidth);
            }

            items.forEach(item => {
                doc.setFontSize(6);

                const labelX = margin;
                const valueX = margin + 13;

                // Hitung max width yang tersedia
                const pageWidth = doc.internal.pageSize.getWidth();
                const maxWidth = pageWidth - valueX - margin;

                // Bungkus teks jika terlalu panjang
                const wrappedName = doc.splitTextToSize(item.name, maxWidth);

                // Product
                doc.text("Product", labelX, y);
                doc.text(":", labelX + 12, y);
                doc.text(wrappedName, valueX, y);
                y += (wrappedName.length * 3); // naikkan Y sesuai baris

                // Qty
                doc.text("Qty", labelX, y);
                doc.text(":", labelX + 12, y);
                doc.text(item.qty, valueX, y);
                y += 3;

                // Price
                doc.text("Price", labelX, y);
                doc.text(":", labelX + 12, y);
                doc.text(item.price, valueX, y);
                y += 5;
            });

            // Update tinggi dokumen bila perlu
            const finalY = y + 20;
            if (finalY > doc.internal.pageSize.getHeight()) {
                doc.internal.pageSize.setHeight(finalY);
            }
            // Garis pemisah
            doc.line(margin, y, 55, y);
            y += 4;

            // **Total Harga**
            doc.setFontSize(8);
            doc.setFont("helvetica", "bold");
            doc.text('Total: ' + totalAmount.toLocaleString(), margin, y);

            // Cetak struk
            doc.autoPrint();
            const pdfData = doc.output('blob');
            const pdfWindow = window.open('', '', 'width=600,height=400');
            const iframe = pdfWindow.document.createElement('iframe');
            iframe.style.position = 'absolute';
            iframe.style.top = '0';
            iframe.style.left = '0';
            iframe.style.width = '100%';
            iframe.style.height = '100%';
            iframe.style.border = 'none';
            pdfWindow.document.body.appendChild(iframe);

            const blobURL = URL.createObjectURL(pdfData);
            iframe.src = blobURL;

            iframe.onload = function () {
                pdfWindow.print();
            };
        });
    </script>
    <script>
        document.getElementById('printButton').addEventListener('click', async function (e) {
            e.preventDefault();

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('p', 'mm', 'a4'); // portrait
            const pageWidth = doc.internal.pageSize.getWidth();
            const margin = 15;
            const contentWidth = pageWidth - margin * 2;
            const lineHeight = 6;

            const companyName = "CV SURYA AGRO PRADHANA";
            const companyAddress = "Jl. Peterongan-Sumobito, Jombang";

            const customerName = `{!! $sales->customer->party_name ?? '' !!}`;
            const customerAddress = `{!! $sales->customer->address1 ?? '' !!}, {!! $sales->customer->city ?? '' !!}`;
            const invoiceNumber = "{{ $sales->inv_number ?? '' }}";
            const invoiceDate = "{{ $sales->updated_at ?? '' }}";
            const paymentTerm = "{{ isset($sales->payment_due_date) ? date('d/m/Y', strtotime($sales->payment_due_date)) : '' }}";
            const cashier = "{{ $cashier->name ?? '' }}";

            const subTotal = {{ $total ?? 0 }};
            const totalDiscount = {{ $disc ?? 0 }};
            const tax = {{ $tax ?? 0 }};
            const total = {{ $unitprice ?? 0 }};

            function formatDate(dateStr) {
                if (!dateStr) return '';
                const date = new Date(dateStr);
                return date.toLocaleDateString('id-ID');
            }

            // Header
            doc.setFont('helvetica', 'bold');
            doc.setFontSize(12);
            doc.text(companyName, margin, 15);
            doc.setFont('helvetica', 'normal');
            doc.text(companyAddress, margin, 21);

            // Info Customer
            let infoY = 20;
            const infoX = pageWidth - 95;
            doc.setFontSize(10);
            doc.text("Kepada :", infoX, infoY);
            infoY += lineHeight;
            doc.text(customerName, infoX, infoY);
            infoY += lineHeight;

            const splitAddress = doc.splitTextToSize(customerAddress, 80);
            splitAddress.forEach(line => {
                doc.text(line, infoX, infoY);
                infoY += lineHeight;
            });

            // Format paragraf info
            infoY += 2;
            doc.setFont('helvetica', 'normal');
            const labelWidth = 35;

            doc.text(`Tanggal Inv`, infoX, infoY);
            doc.text(`: ${formatDate(invoiceDate)}`, infoX + labelWidth, infoY);
            infoY += lineHeight;

            doc.text(`Tgl tempo / Tunai`, infoX, infoY);
            doc.text(`: ${paymentTerm}`, infoX + labelWidth, infoY);
            infoY += lineHeight;

            doc.text(`Kasir`, infoX, infoY);
            doc.text(`: ${cashier}`, infoX + labelWidth, infoY);

            // Invoice Number
            let y = 55;
            doc.setFont('helvetica', 'bold');
            doc.text("NO INVOICE", margin, y);
            y += lineHeight;
            doc.text(invoiceNumber, margin, y);

            // Tabel
            doc.autoTable({
                startY: y + 5,
                head: [['No', 'Item', 'Qty', 'Price', 'Disc', 'Total']],
                body: invoiceItems.map((item, index) => [
                    index + 1,
                    item.user_description_item || '',
                    item.ordered_quantity || '',
                    item.unit_selling_price || '',
                    item.disc || '',
                    item.unit_percent_base_price || ''
                ]),
                styles: {
                    fontSize: 10,
                    cellPadding: 3,
                    halign: 'center',
                    fillColor: false,
                    textColor: [0, 0, 0],
                    lineColor: [0, 0, 0],
                    lineWidth: 0.2
                },
                headStyles: {
                    fillColor: [255, 255, 255],
                    textColor: [0, 0, 0],
                    lineColor: [0, 0, 0],
                    lineWidth: 0.5
                },
                columnStyles: {
                    0: { cellWidth: contentWidth * 0.08 }, // No
                    1: { cellWidth: contentWidth * 0.37, halign: 'left' }, // Item
                    2: { cellWidth: contentWidth * 0.15 },
                    3: { cellWidth: contentWidth * 0.13 },
                    4: { cellWidth: contentWidth * 0.13 },
                    5: { cellWidth: contentWidth * 0.14 },
                },
                tableLineColor: [0, 0, 0],
            });

            const tableEnd = doc.lastAutoTable.finalY;

            // Note
            doc.setFontSize(10);
            doc.setFont('helvetica', 'normal');
            doc.text('Note : Barang yang sudah dibeli tidak dapat dikembalikan', margin, tableEnd + 5);

            // Total info
            const labelX = pageWidth - 70;
            const valueX = pageWidth - 15;
            let tY = tableEnd + 5;

            doc.setFont('helvetica', 'bold');
            doc.text('SUB TOTAL', labelX, tY += lineHeight);
            doc.text(subTotal.toLocaleString('id-ID'), valueX, tY, { align: 'right' });

            doc.text('TOTAL DISKON', labelX, tY += lineHeight);
            doc.text(totalDiscount.toLocaleString('id-ID'), valueX, tY, { align: 'right' });

            doc.text('PPN', labelX, tY += lineHeight);
            doc.text(tax.toLocaleString('id-ID'), valueX, tY, { align: 'right' });

            doc.text('TOTAL', labelX, tY += lineHeight);
            doc.text(total.toLocaleString('id-ID'), valueX, tY, { align: 'right' });

            // Signature
            let footerY = tY + 25;
            doc.text('Mengetahui', margin, footerY);
            doc.text('Penerima', pageWidth / 2 - 20, footerY);
            doc.text('Pengirim', pageWidth - 50, footerY);

            doc.text('(............................)', margin, footerY + 20);
            doc.text('(............................)', pageWidth / 2 - 25, footerY + 20);
            doc.text('(............................)', pageWidth - 55, footerY + 20);

            // Show and Print
            const pdfData = doc.output('blob');
            const blobURL = URL.createObjectURL(pdfData);
            const pdfWindow = window.open('', '', 'width=600,height=400');
            const iframe = pdfWindow.document.createElement('iframe');
            iframe.style.position = 'absolute';
            iframe.style.top = '0';
            iframe.style.left = '0';
            iframe.style.width = '100%';
            iframe.style.height = '100%';
            iframe.style.border = 'none';
            pdfWindow.document.body.appendChild(iframe);
            iframe.src = blobURL;

            iframe.onload = function () {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
            };
        });
    </script>


@endpush

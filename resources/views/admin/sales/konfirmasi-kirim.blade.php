@extends('layouts.admin')
@section('content')
<section id="konfirmasi-kirim">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-12">

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="card" style="border-left: 4px solid #0d6efd;">
                <div class="card-header d-flex justify-content-between align-items-center py-2">
                    <h6 class="mb-0">Shipment Confirmation</h6>
                    <a href="{{ route('admin.salesorder.show', $sales->id) }}" class="btn btn-sm btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>

                <div class="card-body pb-2">
                    {{-- SO Info --}}
                    <div class="row mb-3" style="font-size:13px;">
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless mb-0">
                                <tr><td class="fw-bold" style="width:130px">SO Number</td><td>: {{ $sales->order_number }}</td></tr>
                                <tr><td class="fw-bold">Customer</td><td>: {{ optional($sales->customer)->party_name ?? 'Walk-in Customer' }}</td></tr>
                                <tr><td class="fw-bold">SO Date</td><td>: {{ $sales->ordered_date }}</td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless mb-0">
                                <tr><td class="fw-bold" style="width:130px">Ship To</td><td>: {{ optional($sales->party_site)->id ?? '-' }}</td></tr>
                                <tr><td class="fw-bold">Payment Term</td><td>: {{ is_numeric($sales->attribute3) ? (optional($sales->term)->terms_name ?? '-') : '-' }}</td></tr>
                            </table>
                        </div>
                    </div>

                    <form action="{{ route('admin.salesorder.proses-kirim') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sales_id" value="{{ $sales->id }}">

                        {{-- Items Table --}}
                        <div class="table-responsive mb-3">
                            <table class="table table-sm table-bordered" style="font-size:13px;">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th class="text-center">Order Qty</th>
                                        <th class="text-center">Ship Qty</th>
                                        <th>UOM</th>
                                        <th>Warehouse</th>
                                        <th class="text-center">Available Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($detail as $key => $line)
                                    <tr>
                                        <td>
                                            {{ $key + 1 }}
                                            <input type="hidden" name="line_id[{{ $key }}]" value="{{ $line->id }}">
                                            <input type="hidden" name="qty[{{ $key }}]" value="{{ $line->ordered_quantity }}">
                                        </td>
                                        <td>{{ $line->user_description_item }}</td>
                                        <td class="text-center">{{ number_format($line->ordered_quantity, 0, ',', '.') }}</td>
                                        <td class="text-center" style="width:90px">
                                            <span class="fw-bold">{{ number_format($line->ordered_quantity, 0, ',', '.') }}</span>
                                        </td>
                                        <td>{{ $line->order_quantity_uom }}</td>
                                        <td style="min-width:140px">
                                            <span class="fw-bold small">{{ $line->shipping_inventory ?? '-' }}</span>
                                            <input type="hidden" name="warehouse[{{ $key }}]" value="{{ $line->shipping_inventory }}">
                                            @if(!$line->shipping_inventory)
                                                <div class="text-danger" style="font-size:11px">
                                                    <i class="fa fa-exclamation-triangle"></i> Warehouse belum di-set
                                                </div>
                                            @endif
                                        </td>
                                        @php $oh = $stock[$line->id] ?? null; @endphp
                                        <td class="text-center" style="width:100px; font-size:12px; color:#555;">
                                            @if($oh)
                                                {{ number_format($oh->primary_transaction_quantity, 0, ',', '.') }}
                                                {{ $line->order_quantity_uom }}
                                                @if($oh->primary_transaction_quantity < $line->ordered_quantity)
                                                    <div class="text-danger" style="font-size:11px; font-weight:bold;">Stok kurang!</div>
                                                @endif
                                            @else
                                                <span class="text-danger">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Invoice Details --}}
                        <div class="card mb-3" style="display:none; border-left: 4px solid #0d6efd; font-size:13px;">
                            <div class="card-header py-2">
                                <h6 class="mb-0 fw-bold">Invoice Details</h6>
                            </div>
                            <div class="card-body py-2">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Invoice Date</label>
                                        <input type="date" name="tgl_invoice" class="form-control form-control-sm"
                                               value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Faktur</label>
                                        <select name="faktur_code" class="form-select form-select-sm">
                                            <option value="">-- Pilih Faktur --</option>
                                            @foreach($fakturs as $f)
                                                <option value="{{ $f->faktur_code }}" @if($loop->first) selected @endif>{{ $f->faktur_code }}</option>
                                            @endforeach
                                        </select>
                                        @if($fakturs->isEmpty())
                                            <div class="text-danger mt-1" style="font-size:11px">
                                                <i class="fa fa-exclamation-triangle"></i> Tidak ada faktur tersedia
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Invoice Number</label>
                                        <input type="text" class="form-control form-control-sm bg-light" readonly
                                               value="INV-{{ $sales->order_number }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Footer Form --}}
                        <div class="row align-items-end g-3">
                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Ship Date</label>
                                <input type="date" name="ship_date" class="form-control form-control-sm"
                                       value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-4 d-flex align-items-center" style="padding-top:22px">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="buat_sj" id="buat_sj" value="1">
                                    <label class="form-check-label small fw-bold" for="buat_sj">
                                        Create Delivery Order
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5 text-end">
                                <a href="{{ route('admin.salesorder.show', $sales->id) }}" class="btn btn-sm btn-secondary me-1">Cancel</a>
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-send me-50">
                                        <line x1="22" y1="2" x2="11" y2="13"></line>
                                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                    </svg></span>
                                    Process Shipment
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection


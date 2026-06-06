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

            <div class="card" style="border-left: 4px solid #28a745;">
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
                                        <td style="min-width:160px">
                                            @if(isset($stock[$line->inventory_item_id]) && $stock[$line->inventory_item_id]->count() > 0)
                                            <select name="warehouse[{{ $key }}]" class="form-select form-select-sm warehouse-select" data-key="{{ $key }}" required>
                                                @foreach($stock[$line->inventory_item_id] as $oh)
                                                <option value="{{ $oh->subinventory_code }}"
                                                        data-qty="{{ $oh->primary_transaction_quantity }}"
                                                        {{ $line->shipping_inventory == $oh->subinventory_code ? 'selected' : '' }}>
                                                    {{ $oh->subinventory_code }} ({{ number_format($oh->primary_transaction_quantity, 0, ',', '.') }})
                                                </option>
                                                @endforeach
                                            </select>
                                            @else
                                            <span class="text-danger small"><i class="fa fa-exclamation-triangle"></i> No stock available</span>
                                            <input type="hidden" name="warehouse[{{ $key }}]" value="">
                                            @endif
                                        </td>
                                        @php
                                            $selectedStock = null;
                                            if (isset($stock[$line->inventory_item_id])) {
                                                $selectedStock = $stock[$line->inventory_item_id]
                                                    ->firstWhere('subinventory_code', $line->shipping_inventory)
                                                    ?? $stock[$line->inventory_item_id]->first();
                                            }
                                        @endphp
                                        <td class="text-center stok-display-{{ $key }}" style="width:100px; font-size:12px; color:#555;">
                                            @if($selectedStock)
                                                {{ number_format($selectedStock->primary_transaction_quantity, 0, ',', '.') }}
                                                {{ $line->order_quantity_uom }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fa fa-check"></i> Process Shipment
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

@push('script')
<script>
document.querySelectorAll('.warehouse-select').forEach(function(sel) {
    sel.addEventListener('change', function() {
        var key  = this.dataset.key;
        var opt  = this.options[this.selectedIndex];
        var qty  = opt ? opt.dataset.qty : '-';
        var cell = document.querySelector('.stok-display-' + key);
        if (cell) cell.textContent = qty ? Number(qty).toLocaleString('id') + ' ' + cell.dataset.uom : '-';
    });
});
</script>
@endpush

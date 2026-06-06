@extends('layouts.admin')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">POS Z-Report</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.pos.index') }}">POS Sessions</a></li>
                        <li class="breadcrumb-item active">{{ $session->session_number }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="d-flex align-items-center justify-content-end flex-wrap gap-1">
            <a href="{{ route('admin.pos.export.pdf', $session->id) }}"
               class="btn btn-sm fw-semibold"
               style="background:#dc2626;color:#fff;border:none;border-radius:8px;font-size:.82rem;padding:6px 14px;text-decoration:none;display:inline-flex;align-items:center;gap:5px;">
                <i data-feather="file-text" style="width:13px;height:13px;"></i> PDF
            </a>
            <a href="{{ route('admin.pos.export.excel', $session->id) }}"
               class="btn btn-sm fw-semibold"
               style="background:#059669;color:#fff;border:none;border-radius:8px;font-size:.82rem;padding:6px 14px;text-decoration:none;display:inline-flex;align-items:center;gap:5px;">
                <i data-feather="grid" style="width:13px;height:13px;"></i> Excel
            </a>
            <button onclick="window.print()" class="btn btn-outline-secondary btn-sm" style="font-size:.82rem;border-radius:8px;">
                <i data-feather="printer" style="width:13px;height:13px;"></i> Print
            </button>
            <a href="{{ route('admin.pos.index') }}" class="btn btn-secondary btn-sm" style="font-size:.82rem;border-radius:8px;">
                <i data-feather="arrow-left" style="width:13px;height:13px;"></i> Back
            </a>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="row">

        {{-- ── Summary Cards ── --}}
        <div class="col-12 mb-1">
            <div class="row">
                @php
                    $stats = [
                        ['label'=>'Total Revenue',      'value'=>'Rp '.number_format($totalRevenue,0,',','.'),  'color'=>'#3b82f6'],
                        ['label'=>'Total Transactions', 'value'=>$orders->count().' trx',                        'color'=>'#10b981'],
                        ['label'=>'Cash',               'value'=>'Rp '.number_format($totalCash,0,',','.'),     'color'=>'#f59e0b'],
                        ['label'=>'Transfer',           'value'=>'Rp '.number_format($totalTransfer,0,',','.'), 'color'=>'#8b5cf6'],
                    ];
                @endphp
                @foreach($stats as $s)
                <div class="col-md-3 col-6 mb-2">
                    <div style="background:#fff;border:1px solid #e2e8f0;border-left:3px solid {{ $s['color'] }};border-radius:8px;padding:10px 14px;">
                        <div style="font-size:.7rem;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:.4px;margin-bottom:3px;">{{ $s['label'] }}</div>
                        <div style="font-size:.92rem;font-weight:700;color:#0f172a;">{{ $s['value'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ── Session Info & Payment Summary ── --}}
        <div class="col-md-6 mb-2">
            <div class="card h-100 mb-0" style="border:1px solid #e2e8f0;border-radius:10px;box-shadow:none;">
                <div class="card-header py-2 px-3" style="background:#f8fafc;border-bottom:1px solid #e2e8f0;border-radius:10px 10px 0 0;">
                    <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;">
                        <i data-feather="info" style="width:12px;height:12px;" class="mr-1"></i> Session Info
                    </span>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm table-borderless mb-0" style="font-size:.82rem;">
                        <tbody>
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td class="px-3 py-2 text-muted" style="width:40%;font-size:.78rem;">Session No.</td>
                                <td class="px-3 py-2 font-weight-bold">{{ $session->session_number }}</td>
                            </tr>
                            <tr style="background:#fafafa;border-bottom:1px solid #f1f5f9;">
                                <td class="px-3 py-2 text-muted" style="font-size:.78rem;">Opened By</td>
                                <td class="px-3 py-2">{{ $session->cashier->name ?? '-' }}</td>
                            </tr>
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td class="px-3 py-2 text-muted" style="font-size:.78rem;">Opened At</td>
                                <td class="px-3 py-2">{{ \Carbon\Carbon::parse($session->opened_at)->format('d M Y H:i') }}</td>
                            </tr>
                            <tr style="background:#fafafa;border-bottom:1px solid #f1f5f9;">
                                <td class="px-3 py-2 text-muted" style="font-size:.78rem;">Closed At</td>
                                <td class="px-3 py-2">{{ $session->closed_at ? \Carbon\Carbon::parse($session->closed_at)->format('d M Y H:i') : '—' }}</td>
                            </tr>
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td class="px-3 py-2 text-muted" style="font-size:.78rem;">Opening Cash</td>
                                <td class="px-3 py-2">Rp {{ number_format($session->opening_cash, 0, ',', '.') }}</td>
                            </tr>
                            <tr style="background:#fafafa;border-bottom:1px solid #f1f5f9;">
                                <td class="px-3 py-2 text-muted" style="font-size:.78rem;">Closing Cash</td>
                                <td class="px-3 py-2">{{ $session->closing_cash !== null ? 'Rp '.number_format($session->closing_cash,0,',','.') : '—' }}</td>
                            </tr>
                            <tr>
                                <td class="px-3 py-2 text-muted" style="font-size:.78rem;">Status</td>
                                <td class="px-3 py-2">
                                    @if($session->status === 'open')
                                        <span class="badge badge-success" style="font-size:.7rem;">Open</span>
                                    @else
                                        <span class="badge badge-secondary" style="font-size:.7rem;">Closed</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-2">
            <div class="card h-100 mb-0" style="border:1px solid #e2e8f0;border-radius:10px;box-shadow:none;">
                <div class="card-header py-2 px-3" style="background:#f8fafc;border-bottom:1px solid #e2e8f0;border-radius:10px 10px 0 0;">
                    <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;">
                        <i data-feather="credit-card" style="width:12px;height:12px;" class="mr-1"></i> Payment Summary
                    </span>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0" style="font-size:.82rem;">
                        <thead>
                            <tr style="background:#f8fafc;">
                                <th class="px-3 py-2 border-0" style="font-size:.72rem;color:#94a3b8;font-weight:600;text-transform:uppercase;">Method</th>
                                <th class="px-3 py-2 border-0 text-right" style="font-size:.72rem;color:#94a3b8;font-weight:600;text-transform:uppercase;">Amount</th>
                                <th class="px-3 py-2 border-0 text-right" style="font-size:.72rem;color:#94a3b8;font-weight:600;text-transform:uppercase;">%</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td class="px-3 py-2">
                                    <span style="background:#d1fae5;color:#065f46;border-radius:4px;padding:2px 8px;font-size:.72rem;font-weight:700;">CASH</span>
                                </td>
                                <td class="px-3 py-2 text-right">Rp {{ number_format($totalCash, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-right text-muted">{{ $totalRevenue > 0 ? number_format($totalCash / $totalRevenue * 100, 1) : 0 }}%</td>
                            </tr>
                            <tr style="background:#fafafa;border-bottom:1px solid #f1f5f9;">
                                <td class="px-3 py-2">
                                    <span style="background:#dbeafe;color:#1e40af;border-radius:4px;padding:2px 8px;font-size:.72rem;font-weight:700;">TRANSFER</span>
                                </td>
                                <td class="px-3 py-2 text-right">Rp {{ number_format($totalTransfer, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-right text-muted">{{ $totalRevenue > 0 ? number_format($totalTransfer / $totalRevenue * 100, 1) : 0 }}%</td>
                            </tr>
                            <tr style="border-top:1px solid #e2e8f0;">
                                <td class="px-3 py-2 font-weight-bold" style="font-size:.78rem;color:#0f172a;">TOTAL</td>
                                <td class="px-3 py-2 font-weight-bold text-right" style="color:#0f172a;">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 font-weight-bold text-right" style="color:#0f172a;">100%</td>
                            </tr>
                            <tr style="background:#fafafa;border-top:1px solid #e2e8f0;">
                                <td class="px-3 py-2 text-muted" style="font-size:.75rem;">Base (DPP)</td>
                                <td class="px-3 py-2 text-right text-muted" style="font-size:.78rem;">Rp {{ number_format($totalRevenue - $totalTax, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td class="px-3 py-2 text-muted" style="font-size:.75rem;">VAT 11%</td>
                                <td class="px-3 py-2 text-right text-muted" style="font-size:.78rem;">Rp {{ number_format($totalTax, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ── Transaction List ── --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header py-3 d-flex align-items-center justify-content-between"
                     style="background:#f8fafc;border-bottom:2px solid #e2e8f0;">
                    <h5 class="card-title mb-0 fw-bold" style="color:#0f172a;">
                        <i data-feather="list" style="width:16px;height:16px;" class="mr-1"></i>
                        Transaction List
                    </h5>
                    <span style="background:#eff6ff;color:#1e40af;border-radius:20px;padding:3px 14px;font-size:.78rem;font-weight:700;">
                        {{ $orders->count() }} transactions
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="font-size:.84rem;">
                            <thead style="background:#0f172a;">
                                <tr>
                                    <th class="py-3 px-3" style="color:#94a3b8;font-size:.72rem;font-weight:600;letter-spacing:.5px;text-transform:uppercase;border:none;white-space:nowrap;">Invoice No.</th>
                                    <th class="py-3 px-3" style="color:#94a3b8;font-size:.72rem;font-weight:600;letter-spacing:.5px;text-transform:uppercase;border:none;">Customer</th>
                                    <th class="py-3 px-3" style="color:#94a3b8;font-size:.72rem;font-weight:600;letter-spacing:.5px;text-transform:uppercase;border:none;">Cashier</th>
                                    <th class="py-3 px-3" style="color:#94a3b8;font-size:.72rem;font-weight:600;letter-spacing:.5px;text-transform:uppercase;border:none;white-space:nowrap;">Time</th>
                                    <th class="py-3 px-3" style="color:#94a3b8;font-size:.72rem;font-weight:600;letter-spacing:.5px;text-transform:uppercase;border:none;">Items</th>
                                    <th class="py-3 px-3 text-right" style="color:#94a3b8;font-size:.72rem;font-weight:600;letter-spacing:.5px;text-transform:uppercase;border:none;white-space:nowrap;">Subtotal</th>
                                    <th class="py-3 px-3 text-right" style="color:#94a3b8;font-size:.72rem;font-weight:600;letter-spacing:.5px;text-transform:uppercase;border:none;white-space:nowrap;">VAT</th>
                                    <th class="py-3 px-3 text-right" style="color:#94a3b8;font-size:.72rem;font-weight:600;letter-spacing:.5px;text-transform:uppercase;border:none;white-space:nowrap;">Total</th>
                                    <th class="py-3 px-3 text-center" style="color:#94a3b8;font-size:.72rem;font-weight:600;letter-spacing:.5px;text-transform:uppercase;border:none;white-space:nowrap;">Payment</th>
                                    <th class="py-3 px-3" style="color:#94a3b8;font-size:.72rem;font-weight:600;letter-spacing:.5px;text-transform:uppercase;border:none;white-space:nowrap;">SO#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr style="border-bottom:1px solid #f1f5f9;">
                                    <td class="py-3 px-3">
                                        <span style="font-weight:700;color:#1e293b;font-size:.85rem;">{{ $order->order_number }}</span>
                                    </td>
                                    <td class="py-3 px-3" style="color:#475569;max-width:160px;">
                                        {{ $order->customer_name }}
                                    </td>
                                    <td class="py-3 px-3">
                                        <span style="background:#d1fae5;color:#065f46;border-radius:20px;padding:3px 10px;font-size:.75rem;font-weight:700;white-space:nowrap;display:inline-flex;align-items:center;gap:4px;">
                                            <i data-feather="user" style="width:10px;height:10px;"></i>
                                            {{ $order->cashier_name }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-3" style="color:#64748b;white-space:nowrap;">
                                        {{ \Carbon\Carbon::parse($order->order_date)->format('H:i') }}
                                    </td>
                                    <td class="py-3 px-3" style="max-width:200px;">
                                        @foreach($order->lines as $line)
                                            <div style="font-size:.78rem;line-height:1.6;color:#334155;">
                                                <span style="font-weight:600;">{{ $line->item_code }}</span>
                                                <span style="color:#64748b;">&times; {{ $line->quantity }}</span>
                                                <span style="color:#94a3b8;font-size:.72rem;">@ Rp {{ number_format($line->unit_price, 0, ',', '.') }}</span>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="py-3 px-3 text-right" style="color:#475569;white-space:nowrap;">
                                        Rp {{ number_format($order->subtotal, 0, ',', '.') }}
                                    </td>
                                    <td class="py-3 px-3 text-right" style="color:#64748b;white-space:nowrap;">
                                        Rp {{ number_format($order->tax_amount, 0, ',', '.') }}
                                    </td>
                                    <td class="py-3 px-3 text-right" style="white-space:nowrap;">
                                        <span style="font-weight:700;color:#1e293b;font-size:.9rem;">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="py-3 px-3 text-center" style="white-space:nowrap;">
                                        @foreach($order->payments->unique('payment_method') as $pay)
                                            <span style="background:{{ $pay->payment_method === 'cash' ? '#d1fae5' : '#dbeafe' }};color:{{ $pay->payment_method === 'cash' ? '#065f46' : '#1e40af' }};border-radius:20px;padding:3px 10px;font-size:.75rem;font-weight:700;display:inline-block;">
                                                {{ strtoupper($pay->payment_method) }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="py-3 px-3" style="color:#94a3b8;font-size:.78rem;white-space:nowrap;">
                                        {{ $order->so_number }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center py-5" style="color:#94a3b8;">
                                        <div style="font-size:2rem;opacity:.3;margin-bottom:8px;">&#128203;</div>
                                        No transactions found in this session.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                            @if($orders->count() > 0)
                            <tfoot style="background:#f8fafc;border-top:2px solid #e2e8f0;">
                                <tr>
                                    <td colspan="5" class="py-3 px-3 text-right font-weight-bold" style="color:#475569;font-size:.82rem;">GRAND TOTAL</td>
                                    <td class="py-3 px-3 text-right font-weight-bold" style="color:#1e293b;">Rp {{ number_format($orders->sum('subtotal'), 0, ',', '.') }}</td>
                                    <td class="py-3 px-3 text-right font-weight-bold" style="color:#1e293b;">Rp {{ number_format($orders->sum('tax_amount'), 0, ',', '.') }}</td>
                                    <td class="py-3 px-3 text-right" style="font-size:1rem;font-weight:700;color:#1e40af;">Rp {{ number_format($orders->sum('total'), 0, ',', '.') }}</td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('script')
<script>feather.replace();</script>
@endpush

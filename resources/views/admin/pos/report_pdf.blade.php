<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Sesi POS — {{ $session->session_number }}</title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: 'DejaVu Sans', Arial, sans-serif;
    font-size: 10pt;
    color: #1a1a2e;
    background: #fff;
    padding: 20px 28px;
  }

  /* ── Header ── */
  .report-header {
    border-bottom: 3px solid #0f172a;
    padding-bottom: 12px;
    margin-bottom: 16px;
  }
  .report-header .company { font-size: 16pt; font-weight: bold; color: #0f172a; }
  .report-header .title   { font-size: 11pt; color: #475569; margin-top: 2px; }
  .report-header .meta    { font-size: 8.5pt; color: #64748b; margin-top: 4px; }
  .badge-status {
    display: inline-block;
    padding: 2px 10px;
    border-radius: 20px;
    font-size: 8pt;
    font-weight: bold;
  }
  .badge-open   { background: #d1fae5; color: #059669; }
  .badge-closed { background: #f1f5f9; color: #64748b; }

  /* ── Summary cards row ── */
  .summary-row { width: 100%; margin-bottom: 16px; }
  .summary-row td {
    width: 25%;
    padding: 4px;
    vertical-align: top;
  }
  .card {
    border-radius: 8px;
    padding: 10px 14px;
  }
  .card-blue   { background: #1e40af; color: #fff; }
  .card-green  { background: #059669; color: #fff; }
  .card-yellow { background: #d97706; color: #fff; }
  .card-cyan   { background: #0284c7; color: #fff; }
  .card .card-label { font-size: 7.5pt; opacity: .85; margin-bottom: 4px; }
  .card .card-value { font-size: 13pt; font-weight: bold; }

  /* ── Section title ── */
  .section-title {
    background: #0f172a;
    color: #fff;
    font-size: 9pt;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 4px;
    margin-bottom: 8px;
    margin-top: 14px;
  }

  /* ── Info table ── */
  .info-table { width: 100%; border-collapse: collapse; font-size: 9pt; }
  .info-table td { padding: 4px 8px; vertical-align: top; }
  .info-table td:first-child { width: 38%; color: #64748b; }
  .info-table td:last-child  { font-weight: bold; color: #1e293b; }
  .info-table tr:nth-child(even) td { background: #f8fafc; }

  /* ── Payment table ── */
  .pay-table { width: 100%; border-collapse: collapse; font-size: 9pt; }
  .pay-table th {
    background: #1e3a5f;
    color: #fff;
    padding: 5px 10px;
    text-align: left;
    font-size: 8.5pt;
  }
  .pay-table th.text-right, .pay-table td.text-right { text-align: right; }
  .pay-table td { padding: 5px 10px; border-bottom: 1px solid #f1f5f9; }
  .pay-table tr:last-child td { font-weight: bold; background: #dbeafe; }
  .pay-table .badge-cash     { background: #fef3c7; color: #92400e; padding: 2px 8px; border-radius: 10px; font-size: 7.5pt; }
  .pay-table .badge-transfer { background: #e0f2fe; color: #075985; padding: 2px 8px; border-radius: 10px; font-size: 7.5pt; }

  /* ── Breakdown row ── */
  .breakdown-row { width: 100%; border-collapse: collapse; margin-top: 8px; }
  .breakdown-row td { width: 33.33%; padding: 4px 6px; }
  .breakdown-card {
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 8px 12px;
    text-align: center;
  }
  .breakdown-card .lbl { font-size: 7.5pt; color: #64748b; margin-bottom: 4px; }
  .breakdown-card .val { font-size: 11pt; font-weight: bold; color: #1e293b; }
  .breakdown-card.highlight .val { color: #1e40af; }

  /* ── Transaction blocks ── */
  .trx-block { margin-bottom: 10px; page-break-inside: avoid; }
  .trx-head {
    width: 100%; border-collapse: collapse;
    background: #1e3a5f; border-radius: 4px 4px 0 0;
  }
  .trx-head td { padding: 5px 8px; color: #fff; font-size: 8pt; font-weight: bold; }
  .trx-head .sub  { color: #cbd5e1; font-weight: normal; font-size: 7.5pt; }
  .trx-head .muted { color: #94a3b8; font-size: 7pt; }

  .item-table { width: 100%; border-collapse: collapse; border: 1px solid #e2e8f0; border-top: none; }
  .item-table th {
    background: #f1f5f9; color: #475569; font-size: 7.5pt; font-weight: 600;
    padding: 4px 7px; text-align: left; border-bottom: 1px solid #e2e8f0;
  }
  .item-table th.r, .item-table td.r { text-align: right; white-space: nowrap; }
  .item-table th.c, .item-table td.c { text-align: center; }
  .item-table td { padding: 4px 7px; font-size: 8pt; border-bottom: 1px solid #f1f5f9; vertical-align: top; }
  .item-table .odd { background: #f8fafc; }
  .item-table tfoot td {
    padding: 5px 7px; font-size: 8pt; background: #eff6ff;
    border-top: 1px solid #bfdbfe;
  }
  .disc-val { color: #dc2626; }
  .disc-nil { color: #94a3b8; }

  .grand-total-bar {
    width: 100%; border-collapse: collapse;
    background: #0f172a; border-radius: 6px;
    margin-top: 12px;
  }
  .grand-total-bar td { padding: 8px 12px; }
  .badge-cash-sm     { background: #fef3c7; color: #92400e; padding: 1px 6px; border-radius: 8px; font-size: 7pt; }
  .badge-transfer-sm { background: #e0f2fe; color: #075985; padding: 1px 6px; border-radius: 8px; font-size: 7pt; }

  /* ── Footer ── */
  .report-footer {
    margin-top: 18px;
    border-top: 1px solid #e2e8f0;
    padding-top: 8px;
    font-size: 7.5pt;
    color: #94a3b8;
    text-align: center;
  }
</style>
</head>
<body>

{{-- ── HEADER ── --}}
<div class="report-header">
  <div class="company">AGRO Point of Sale</div>
  <div class="title">Z-Report / Laporan Sesi POS</div>
  <div class="meta">
    Sesi: <strong>{{ $session->session_number }}</strong> &nbsp;|&nbsp;
    Kasir: <strong>{{ $session->cashier->name ?? '-' }}</strong> &nbsp;|&nbsp;
    Lokasi: <strong>{{ $session->subinventory_code ?? '-' }}</strong> &nbsp;|&nbsp;
    Dicetak: {{ now()->format('d M Y H:i') }} &nbsp;|&nbsp;
    <span class="badge-status {{ $session->status === 'open' ? 'badge-open' : 'badge-closed' }}">
      {{ strtoupper($session->status) }}
    </span>
  </div>
</div>

{{-- ── SUMMARY CARDS ── --}}
<table class="summary-row">
  <tr>
    <td><div class="card card-blue"><div class="card-label">Total Penjualan</div><div class="card-value">Rp {{ number_format($totalRevenue,0,',','.') }}</div></div></td>
    <td><div class="card card-green"><div class="card-label">Total Transaksi</div><div class="card-value">{{ $orders->count() }} transaksi</div></div></td>
    <td><div class="card card-yellow"><div class="card-label">Total Cash</div><div class="card-value">Rp {{ number_format($totalCash,0,',','.') }}</div></div></td>
    <td><div class="card card-cyan"><div class="card-label">Total Transfer</div><div class="card-value">Rp {{ number_format($totalTransfer,0,',','.') }}</div></div></td>
  </tr>
</table>

{{-- ── INFO SESI & PAYMENT BREAKDOWN ── --}}
<table style="width:100%;border-collapse:collapse;">
  <tr>
    <td style="width:38%;vertical-align:top;padding-right:10px;">
      <div class="section-title">Info Sesi</div>
      <table class="info-table">
        <tr><td>No. Sesi</td><td>{{ $session->session_number }}</td></tr>
        <tr><td>Kasir</td><td>{{ $session->cashier->name ?? '-' }}</td></tr>
        <tr><td>Lokasi</td><td>{{ $session->subinventory_code ?? '-' }}</td></tr>
        <tr><td>Dibuka</td><td>{{ \Carbon\Carbon::parse($session->opened_at)->format('d M Y H:i') }}</td></tr>
        <tr><td>Ditutup</td><td>{{ $session->closed_at ? \Carbon\Carbon::parse($session->closed_at)->format('d M Y H:i') : '-' }}</td></tr>
        <tr><td>Kas Awal</td><td>Rp {{ number_format($session->opening_cash,0,',','.') }}</td></tr>
        <tr><td>Kas Akhir</td><td>{{ $session->closing_cash !== null ? 'Rp '.number_format($session->closing_cash,0,',','.') : '-' }}</td></tr>
        <tr><td>Status</td><td>{{ strtoupper($session->status) }}</td></tr>
      </table>
    </td>
    <td style="width:62%;vertical-align:top;">
      <div class="section-title">Rekapitulasi Pembayaran</div>
      <table class="pay-table">
        <thead>
          <tr>
            <th>Metode</th>
            <th class="text-right">Jumlah (Rp)</th>
            <th class="text-right">Persentase</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><span class="badge-cash">Cash</span></td>
            <td class="text-right">Rp {{ number_format($totalCash,0,',','.') }}</td>
            <td class="text-right">{{ $totalRevenue > 0 ? number_format($totalCash/$totalRevenue*100,1) : 0 }}%</td>
          </tr>
          <tr>
            <td><span class="badge-transfer">Transfer</span></td>
            <td class="text-right">Rp {{ number_format($totalTransfer,0,',','.') }}</td>
            <td class="text-right">{{ $totalRevenue > 0 ? number_format($totalTransfer/$totalRevenue*100,1) : 0 }}%</td>
          </tr>
          <tr>
            <td>TOTAL</td>
            <td class="text-right">Rp {{ number_format($totalRevenue,0,',','.') }}</td>
            <td class="text-right">100%</td>
          </tr>
        </tbody>
      </table>

      {{-- Breakdown DPP / PPN / Total --}}
      @php $dpp = $totalRevenue - $totalTax; @endphp
      <table class="breakdown-row">
        <tr>
          <td><div class="breakdown-card"><div class="lbl">Subtotal / DPP</div><div class="val">Rp {{ number_format($dpp,0,',','.') }}</div></div></td>
          <td><div class="breakdown-card"><div class="lbl">PPN 11%</div><div class="val">Rp {{ number_format($totalTax,0,',','.') }}</div></div></td>
          <td><div class="breakdown-card highlight"><div class="lbl">Total Bruto</div><div class="val">Rp {{ number_format($totalRevenue,0,',','.') }}</div></div></td>
        </tr>
      </table>
    </td>
  </tr>
</table>

{{-- ── TRANSACTION LIST ── --}}
<div class="section-title" style="margin-top:18px;">Daftar Transaksi ({{ $orders->count() }} transaksi)</div>

@forelse($orders as $i => $order)
<div class="trx-block">

  {{-- Order header bar --}}
  <table class="trx-head">
    <tr>
      <td style="width:3%;">#{{ $i + 1 }}</td>
      <td style="width:18%;"><strong>{{ $order->order_number }}</strong></td>
      <td style="width:24%;" class="sub">{{ $order->customer_name }}</td>
      <td style="width:18%;" class="sub">
        &#128100; {{ $order->cashier_name }}
      </td>
      <td style="width:8%;" class="sub" style="text-align:center;">
        {{ \Carbon\Carbon::parse($order->order_date)->format('H:i') }}
      </td>
      <td style="width:14%;text-align:center;">
        @foreach($order->payments->unique('payment_method') as $pay)
          <span class="{{ $pay->payment_method === 'cash' ? 'badge-cash-sm' : 'badge-transfer-sm' }}">
            {{ strtoupper($pay->payment_method) }}
          </span>
        @endforeach
      </td>
      <td style="width:15%;text-align:right;" class="muted">{{ $order->so_number }}</td>
    </tr>
  </table>

  {{-- Item lines --}}
  <table class="item-table">
    <thead>
      <tr>
        <th style="width:13%;">Kode Item</th>
        <th>Nama Item</th>
        <th class="c" style="width:8%;">Qty</th>
        <th class="c" style="width:7%;">Satuan</th>
        <th class="r" style="width:16%;">Harga Satuan</th>
        <th class="r" style="width:13%;">Diskon</th>
        <th class="r" style="width:16%;">Total Baris</th>
      </tr>
    </thead>
    <tbody>
      @foreach($order->lines as $j => $line)
      <tr class="{{ $j % 2 === 1 ? 'odd' : '' }}">
        <td style="font-weight:bold;color:#1e293b;">{{ $line->item_code }}</td>
        <td style="color:#334155;">{{ $line->item_description }}</td>
        <td class="c">{{ $line->quantity }}</td>
        <td class="c" style="color:#64748b;">{{ $line->uom }}</td>
        <td class="r">Rp {{ number_format($line->unit_price,0,',','.') }}</td>
        <td class="r {{ $line->discount > 0 ? 'disc-val' : 'disc-nil' }}">
          {{ $line->discount > 0 ? 'Rp '.number_format($line->discount,0,',','.') : '—' }}
        </td>
        <td class="r" style="font-weight:bold;">Rp {{ number_format($line->total_line,0,',','.') }}</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4" class="r" style="color:#64748b;font-size:7.5pt;">
          DPP: Rp {{ number_format($order->subtotal,0,',','.') }}
          &nbsp;&nbsp;|&nbsp;&nbsp;
          PPN: Rp {{ number_format($order->tax_amount,0,',','.') }}
        </td>
        <td colspan="2" class="r" style="color:#1e40af;font-weight:bold;font-size:8.5pt;">TOTAL ORDER</td>
        <td class="r" style="color:#1e40af;font-weight:bold;font-size:9pt;">
          Rp {{ number_format($order->total,0,',','.') }}
        </td>
      </tr>
    </tfoot>
  </table>

</div>
@empty
<div style="text-align:center;color:#94a3b8;padding:20px;border:1px dashed #e2e8f0;border-radius:6px;">
  Belum ada transaksi pada sesi ini.
</div>
@endforelse

{{-- Grand Total Bar --}}
@if($orders->count() > 0)
@php
  $allLines = $orders->flatMap(fn($o) => $o->lines);
@endphp
<table class="grand-total-bar">
  <tr>
    <td style="color:#94a3b8;font-size:8pt;width:35%;">
      GRAND TOTAL &mdash; {{ $orders->count() }} transaksi &mdash; {{ $allLines->count() }} baris item
    </td>
    <td style="color:#93c5fd;font-size:8pt;text-align:right;width:20%;">
      Total Diskon: Rp {{ number_format($allLines->sum('discount'),0,',','.') }}
    </td>
    <td style="color:#93c5fd;font-size:8.5pt;text-align:right;width:20%;">
      DPP: Rp {{ number_format($orders->sum('subtotal'),0,',','.') }}
      &nbsp;|&nbsp;
      PPN: Rp {{ number_format($orders->sum('tax_amount'),0,',','.') }}
    </td>
    <td style="color:#fff;font-size:11pt;font-weight:bold;text-align:right;width:25%;">
      Rp {{ number_format($orders->sum('total'),0,',','.') }}
    </td>
  </tr>
</table>
@endif

<div class="report-footer">
  Laporan ini digenerate secara otomatis oleh sistem AGRO POS &mdash; {{ now()->format('d M Y H:i:s') }}
</div>
</body>
</html>

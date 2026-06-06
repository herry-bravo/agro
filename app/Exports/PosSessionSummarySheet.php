<?php

namespace App\Exports;

use App\PosOrder;
use App\PosPayment;
use App\PosSession;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PosSessionSummarySheet implements FromArray, WithTitle, WithStyles
{
    protected $session;
    protected $totalCash;
    protected $totalTransfer;
    protected $totalRevenue;
    protected $totalTax;
    protected $orderCount;

    public function __construct($sessionId)
    {
        $session   = PosSession::with('cashier')->findOrFail($sessionId);
        $orders    = PosOrder::with('payments')->where('session_id', $sessionId)->where('status', 'paid')->get();
        $orderIds  = $orders->pluck('id');

        $this->session       = $session;
        $this->totalCash     = PosPayment::whereIn('pos_order_id', $orderIds)->where('payment_method', 'cash')->sum('amount');
        $this->totalTransfer = PosPayment::whereIn('pos_order_id', $orderIds)->where('payment_method', 'transfer')->sum('amount');
        $this->totalRevenue  = $orders->sum('total');
        $this->totalTax      = $orders->sum('tax_amount');
        $this->orderCount    = $orders->count();
    }

    public function title(): string
    {
        return 'Ringkasan';
    }

    public function array(): array
    {
        $s          = $this->session;
        $dpp        = $this->totalRevenue - $this->totalTax;
        $cashPct    = $this->totalRevenue > 0 ? round($this->totalCash / $this->totalRevenue * 100, 1) : 0;
        $trfPct     = $this->totalRevenue > 0 ? round($this->totalTransfer / $this->totalRevenue * 100, 1) : 0;

        $fmt = fn($n) => number_format($n, 0, ',', '.');

        return [
            ['LAPORAN SESI POS — AGRO', '', '', ''],
            ['', '', '', ''],
            ['INFO SESI', '', '', ''],
            ['No. Sesi',          $s->session_number,                                   '', ''],
            ['Kasir',             $s->cashier->name ?? '-',                              '', ''],
            ['Lokasi',            $s->subinventory_code ?? '-',                          '', ''],
            ['Tanggal Buka',      $s->opened_at ? \Carbon\Carbon::parse($s->opened_at)->format('d/m/Y H:i') : '-', '', ''],
            ['Tanggal Tutup',     $s->closed_at ? \Carbon\Carbon::parse($s->closed_at)->format('d/m/Y H:i') : '-', '', ''],
            ['Status',            strtoupper($s->status),                                '', ''],
            ['Jumlah Transaksi',  $this->orderCount . ' transaksi',                      '', ''],
            ['', '', '', ''],
            ['REKAPITULASI PEMBAYARAN', '', '', ''],
            ['Metode',            'Jumlah (Rp)',           'Persentase', ''],
            ['Cash',              'Rp ' . $fmt($this->totalCash),     $cashPct . '%', ''],
            ['Transfer',          'Rp ' . $fmt($this->totalTransfer), $trfPct . '%', ''],
            ['TOTAL',             'Rp ' . $fmt($this->totalRevenue),  '100%',         ''],
            ['', '', '', ''],
            ['BREAKDOWN PENDAPATAN', '', '', ''],
            ['Subtotal / DPP',    'Rp ' . $fmt($dpp),                 '', ''],
            ['PPN 11%',           'Rp ' . $fmt($this->totalTax),      '', ''],
            ['Total Bruto',       'Rp ' . $fmt($this->totalRevenue),  '', ''],
            ['', '', '', ''],
            ['Kas Awal',          'Rp ' . $fmt($s->opening_cash ?? 0), '', ''],
            ['Kas Akhir',         $s->closing_cash !== null ? 'Rp ' . $fmt($s->closing_cash) : '-', '', ''],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Title row
        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0F172A']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // Section headers
        foreach ([3, 12, 18] as $row) {
            $sheet->mergeCells("A{$row}:D{$row}");
            $sheet->getStyle("A{$row}")->applyFromArray([
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1E3A5F']],
            ]);
        }

        // Table header row (payment)
        $sheet->getStyle('A13:C13')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E2E8F0']],
        ]);

        // TOTAL row
        $sheet->getStyle('A16:C16')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'DBEAFE']],
        ]);

        // Column widths
        $sheet->getColumnDimension('A')->setWidth(22);
        $sheet->getColumnDimension('B')->setWidth(28);
        $sheet->getColumnDimension('C')->setWidth(14);
        $sheet->getColumnDimension('D')->setWidth(10);

        return [];
    }
}

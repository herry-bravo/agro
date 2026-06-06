<?php

namespace App\Exports;

use App\PosOrder;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PosSessionDetailSheet implements FromArray, WithTitle, WithStyles
{
    protected $sessionId;

    public function __construct($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    public function title(): string
    {
        return 'Detail Transaksi';
    }

    public function array(): array
    {
        $orders = PosOrder::with(['lines', 'payments', 'cashier', 'createdBy'])
            ->where('session_id', $this->sessionId)
            ->where('status', 'paid')
            ->orderBy('order_date')
            ->get();

        $rows = [[
            'No',
            'No. Invoice',
            'Customer',
            'Kasir',
            'Waktu',
            'Kode Item',
            'Nama Item',
            'Qty',
            'Satuan',
            'Harga Satuan (Rp)',
            'Diskon (Rp)',
            'Total Baris (Rp)',
            'DPP Order (Rp)',
            'PPN Order (Rp)',
            'Total Order (Rp)',
            'Metode Bayar',
            'No. SO',
        ]];

        $no              = 1;
        $grandDiscount   = 0;
        $grandTotalBaris = 0;

        foreach ($orders as $order) {
            $methods = $order->payments->map(fn($p) => strtoupper($p->payment_method))->unique()->implode(' + ');
            $isFirst = true;

            foreach ($order->lines as $line) {
                $rows[] = [
                    $isFirst ? $no         : '',
                    $isFirst ? $order->order_number           : '',
                    $isFirst ? $order->customer_name          : '',
                    $isFirst ? $order->cashier_name : '',
                    $isFirst ? \Carbon\Carbon::parse($order->order_date)->format('H:i') : '',
                    $line->item_code,
                    $line->item_description,
                    (float) $line->quantity,
                    $line->uom,
                    (float) $line->unit_price,
                    (float) $line->discount,
                    (float) $line->total_line,
                    $isFirst ? (float) $order->subtotal   : '',
                    $isFirst ? (float) $order->tax_amount : '',
                    $isFirst ? (float) $order->total      : '',
                    $isFirst ? $methods    : '',
                    $isFirst ? $order->so_number : '',
                ];

                $grandDiscount   += (float) $line->discount;
                $grandTotalBaris += (float) $line->total_line;
                $isFirst          = false;
            }
            $no++;
        }

        // Grand total row
        $rows[] = [
            '',
            'GRAND TOTAL',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            $grandDiscount,
            $grandTotalBaris,
            (float) $orders->sum('subtotal'),
            (float) $orders->sum('tax_amount'),
            (float) $orders->sum('total'),
            '',
            '',
        ];

        return $rows;
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow  = $sheet->getHighestRow();
        $lastCol  = 'Q'; // 17 columns (added Kasir)

        // Header row
        $sheet->getStyle("A1:{$lastCol}1")->applyFromArray([
            'font'      => ['bold' => true, 'size' => 10, 'color' => ['rgb' => 'FFFFFF']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0F172A']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'wrapText' => true, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Grand total row
        $sheet->getStyle("A{$lastRow}:{$lastCol}{$lastRow}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 10],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'DBEAFE']],
        ]);

        // Number format for currency columns (J, K, L, M, N, O = cols 10-15)
        $currencyFormat = '#,##0';
        foreach (['J', 'K', 'L', 'M', 'N', 'O'] as $col) {
            $sheet->getStyle("{$col}2:{$col}{$lastRow}")
                ->getNumberFormat()->setFormatCode($currencyFormat);
        }

        // Qty column (H) number format
        $sheet->getStyle("H2:H{$lastRow}")
            ->getNumberFormat()->setFormatCode('#,##0.####');

        // Alternating row colors for data rows
        for ($r = 2; $r < $lastRow; $r++) {
            $color = $r % 2 === 0 ? 'F8FAFC' : 'FFFFFF';
            $sheet->getStyle("A{$r}:{$lastCol}{$r}")->applyFromArray([
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $color]],
            ]);
        }

        // Text alignment
        $sheet->getStyle("A2:A{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E2:E{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("H2:H{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("I2:I{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Right-align currency columns
        foreach (['J', 'K', 'L', 'M', 'N', 'O'] as $col) {
            $sheet->getStyle("{$col}1:{$col}{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        }

        // Column widths
        $sheet->getColumnDimension('A')->setWidth(5);   // No
        $sheet->getColumnDimension('B')->setWidth(14);  // No. Invoice
        $sheet->getColumnDimension('C')->setWidth(22);  // Customer
        $sheet->getColumnDimension('D')->setWidth(18);  // Kasir
        $sheet->getColumnDimension('E')->setWidth(8);   // Waktu
        $sheet->getColumnDimension('F')->setWidth(14);  // Kode Item
        $sheet->getColumnDimension('G')->setWidth(30);  // Nama Item
        $sheet->getColumnDimension('H')->setWidth(8);   // Qty
        $sheet->getColumnDimension('I')->setWidth(8);   // Satuan
        $sheet->getColumnDimension('J')->setWidth(18);  // Harga Satuan
        $sheet->getColumnDimension('K')->setWidth(14);  // Diskon
        $sheet->getColumnDimension('L')->setWidth(18);  // Total Baris
        $sheet->getColumnDimension('M')->setWidth(16);  // DPP Order
        $sheet->getColumnDimension('N')->setWidth(14);  // PPN Order
        $sheet->getColumnDimension('O')->setWidth(18);  // Total Order
        $sheet->getColumnDimension('P')->setWidth(14);  // Metode Bayar
        $sheet->getColumnDimension('Q')->setWidth(14);  // No. SO

        // Wrap text for item description
        $sheet->getStyle("G2:G{$lastRow}")->getAlignment()->setWrapText(true);

        // Freeze header row
        $sheet->freezePane('A2');

        return [];
    }
}

<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InvoicesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $invoices;

    public function __construct(Collection $invoices)
    {
        $this->invoices = $invoices;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Mengembalikan koleksi data yang sudah di-query dari controller
        return $this->invoices;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Menentukan nama kolom (header) di file Excel
        return [
            'Date',
            'No Invoice',
            'Customer',
            'Product',
            'Category',
            'Faktur',
            'Qty',
            'Price',
            'Discount',
            'Total',
            'Created',
        ];
    }

    /**
     * @param mixed $invoice
     *
     * @return array
     */
    public function map($invoice): array
    {
        // Memetakan data dari setiap baris collection ke kolom yang diinginkan
        // Pastikan nama properti ($invoice->updated_at, $invoice->inv_number)
        // sesuai dengan nama kolom yang di-select di query Anda.
        return [
            $invoice->updated_at,
            $invoice->inv_number,
            $invoice->salesheader->customer->party_name,
            $invoice->user_description_item,
            $invoice->products->category->category_name,
            $invoice->faktur,
            $invoice->ordered_quantity,
            $invoice->unit_percent_base_price,
            $invoice->disc,
            $invoice->unit_list_price,
            $invoice->updated_by,
        ];
    }
}
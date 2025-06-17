<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesOrder;
use PDF;

class InvoicesprintController extends Controller
{
    public function show($id)
    {
        // Ambil data Sales Order berdasarkan header_id
        $sales = SalesOrder::where('header_id', $id)->first();

        if (!$sales) {
            return abort(404, 'Sales Order tidak ditemukan');
        }

        // Load view invoice dan kirim data ke PDF
        $pdf = PDF::loadView('admin.invoices.pdf', compact('sales'));

        // Set nama file saat diunduh
        $fileName = "Invoice_{$sales->order_number}.pdf";

        // Tampilkan atau download PDF
        return $pdf->stream($fileName);
    }
}

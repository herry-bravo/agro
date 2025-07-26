<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PurchaseOrder;
use App\PurchaseOrderDet;
use App\Vendor;
use App\Terms;
use App\ItemMaster;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use DB;
use PDF;
use App\Exports\PoReport;
use Maatwebsite\Excel\Facades\Excel;

class poController extends Controller
{
    public function index(Request $request){
        $purchase = PurchaseOrder::whereBetween('created_at', [$request->createFrom, $request->createTo])
        ->get();
        // dd($purchase);

        $data_arr = [];
        foreach ($purchase as $row) {
            $items = $row->purchaseOrderDet; // asumsi hasMany

            $isFirst = true;
            foreach ($items as $item) {
                $data_arr[] = [
                    "po_number" => $isFirst ? ($row->segment1 ?? '-') : '',
                    "vendor"    => $isFirst ? ($row->Vendor->vendor_name ?? '-') : '',
                    "currency"  => $isFirst ? ($row->currency_code ?? '-') : '',
                    "date"  => $isFirst ? ($row->created_date ?? '-') : '',
                    "item"      => $item->item_description ?? '-',
                    "uom"      => $item->po_uom_code ?? '-',
                    "qty"      => number_format($item->po_quantity, 0, ',', '.'),
                    "price"      => number_format($item->unit_price, 0, ',', '.'),
                    "total"      => number_format($item->attribute1, 0, ',', '.'),
                    "needbydate"      => $item->need_by_date ?? '-',
                ];
                $isFirst = false;
            }
        }
        // dd($data_arr);
            
        // Baris ini akan langsung memicu unduhan file 
        return Excel::download(new PoReport($data_arr), 'PurchaseOrders.xlsx');


    }
    
}

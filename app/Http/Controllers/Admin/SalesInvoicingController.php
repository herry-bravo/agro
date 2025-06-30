<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DeliveryDetail;
use App\DeliveryHeader;
use App\ArCustomerTrx;
use App\SalesOrderDetail;
use App\ArCustomerTrxLines;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class SalesInvoicingController extends Controller
{
    //

    public function index(Request $request){
        /* //OLD CODE */
        $lg = $request->logo;
        $psFrom = $request->input('psFrom');
        $psTo = $request->input('psTo');
        $deliveryFrom = $request->input('from');
        $deliveryTo = $request->input('to');
        // $header = ArCustomerTrx::whereBetween('trx_number',[$deliveryFrom,$deliveryTo])
        // ->get();
        // $header = DeliveryHeader::whereBetween('created_at',[$deliveryFrom,$deliveryTo])->get();
        // foreach($header as $key => $value)
        // {
        //     $qry[$key] = $value->customer_trx_id;

        // }

        // if(empty($qry)){
        //     return back()->with('error', 'Field (From / To) is required');
        // }

        // $data = DeliveryDetail::rightJoin('bm_ra_customer_trx_lines_all as ard',function($join){
        //                                 $join->on('bm_wsh_delivery_details.source_header_number','=','ard.sales_order');
        //                                 $join->on('bm_wsh_delivery_details.source_line_id','=','ard.sales_order_line');
        //                             })
        //                             ->select('ard.inventory_item_id','ard.description','ard.unit_selling_price',
        //                             'ard.quantity_invoiced','ard.amount_due_original','ard.customer_trx_id','bm_wsh_delivery_details.id','bm_wsh_delivery_details.lot_number')
        //                             ->whereIn('ard.customer_trx_id',$qry)->where('ard.line_type',0)
        //                             ->get();
        // $counter = DB::table('bm_ra_customer_trx_lines_all')
        //             ->select('customer_trx_id',DB::raw('count(customer_trx_id) as pgs'))
        //             ->whereIn('customer_trx_id',$qry)
        //             ->groupBy('customer_trx_id')
        //             ->get();
        $header = SalesOrderDetail::join('bm_order_headers_all', 'bm_order_headers_all.header_id', '=', 'bm_order_lines_all.header_id')
        ->whereBetween('bm_order_lines_all.created_at', [$deliveryFrom, $deliveryTo])
        ->whereNotNull('bm_order_headers_all.inv_number')
        ->select('bm_order_lines_all.*', 'bm_order_headers_all.*')
        ->get();
        // dd($header);

            
        // Baris ini akan langsung memicu unduhan file Excel
        return Excel::download(new InvoicesExport($header), 'Invoices.xlsx');
    }
}

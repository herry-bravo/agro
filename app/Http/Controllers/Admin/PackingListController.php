<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DeliveryDetail;
use App\DeliveryHeader;
use App\DeliveryDistrib;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use DB;

class PackingListController extends Controller
{
    //
    public function index(Request $request){
        // $image = base64_encode(file_get_contents(public_path('/app-asset/images/logo/bm.png')));
        // $spl = PurchaseOrder::all();

        /* //OLD CODE */
        $lg = $request->logo;
        $psFrom = $request->input('psFrom');
        $psTo = $request->input('psTo');
        $deliveryFrom = $request->input('deliveryFrom');
        $deliveryTo = $request->input('deliveryTo');
        $customer = $request->input('custmer_code');
        $header = DeliveryHeader::whereBetween('packing_slip_number',[$psFrom,$psTo])
                                ->orWhere('sold_to_party_id',$customer)
                                ->where('delivery_id',"!=",1)
                                ->get();
        foreach($header as $key => $value)
        {
            $qry[$key] = $value->delivery_id;
        }

        $data = DeliveryDetail::whereIn('delivery_detail_id',$qry)->get();

        $line = DeliveryDistrib::whereIn('header_id',$qry)->get();


        $counter = DB::table('bm_wsh_delivery_details')
                    ->select('delivery_detail_id',DB::raw('count(delivery_detail_id) as pgs'))
                    ->whereIn('delivery_detail_id',$qry)
                    ->groupBy('delivery_detail_id')
                    ->get();
        $pdf = \PDF::loadview('admin.stdReports.packingList',compact('header','data','counter','lg','line'))->setPaper('A4');
        return $pdf->stream('Packing List'.$psFrom.'-'.$psTo.'.pdf');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DeliveryDetail;
use App\DeliveryHeader;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use DB;

class SuratJalanController extends Controller
{
    //
    public function index(Request $request){
        // $image = base64_encode(file_get_contents(public_path('/app-asset/images/logo/bm.png')));
        // $spl = PurchaseOrder::all();

        /* //OLD CODE */
        // dd($request->logo);
        $lg = $request->logo;
        $psFrom = $request->input('psFrom');
        $psTo = $request->input('psTo');
        $deliveryFrom = $request->input('deliveryFrom');
        $deliveryTo = $request->input('deliveryTo');
        $header = DeliveryHeader::whereBetween('packing_slip_number',[$psFrom,$psTo])
                                ->where('delivery_id',"!=",1)
                                ->get();
        // dd($header);
        foreach($header as $key => $value)
        {
            $qry[$key] = $value->delivery_id;
        }

        if(empty($qry)){
            return back()->with('error', 'Field (From / To) is required');
        }

        $data = DeliveryDetail::leftJoin('bm_wsh_delivery_distb_items as roll','roll.line_id','=','bm_wsh_delivery_details.id')
                            ->select('bm_wsh_delivery_details.inventory_item_id','bm_wsh_delivery_details.item_description','bm_wsh_delivery_details.requested_quantity_uom','bm_wsh_delivery_details.picked_quantity',
                            'bm_wsh_delivery_details.lot_number','bm_wsh_delivery_details.delivery_detail_id',DB::raw('count(container_item_id) as roll, sum(attribute_number1) as qty'))
                            ->whereIn('delivery_detail_id',$qry)
                            ->groupBy('bm_wsh_delivery_details.inventory_item_id','bm_wsh_delivery_details.item_description','bm_wsh_delivery_details.requested_quantity_uom','bm_wsh_delivery_details.picked_quantity',
                            'bm_wsh_delivery_details.lot_number','bm_wsh_delivery_details.delivery_detail_id')
                            ->get();
        $counter = DB::table('bm_wsh_delivery_details')
                    ->select('delivery_detail_id',DB::raw('count(delivery_detail_id) as pgs'))
                    ->whereIn('delivery_detail_id',$qry)
                    ->groupBy('delivery_detail_id')
                    ->get();

        $pdf = \PDF::loadview('admin.stdReports.suratJalan',compact('header','data','counter','lg'))->setPaper('A4');
        return $pdf->stream('Surat Jalan'.$psFrom.'-'.$psTo.'.pdf');
    }
}

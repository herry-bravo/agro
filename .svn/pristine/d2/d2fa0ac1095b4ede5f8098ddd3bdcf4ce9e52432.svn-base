<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MaterialTxns;
use App\Onhand;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use DB;

class InventoryReportController extends Controller
{
    //
    public function index(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $from = $request->input('datefrom');
        $to=$request->input('dateto');

        $trans_in = [1,38,11,12,31,23];
        $trans_out = [2,4,27,32,9,];

        $txns = MaterialTxns::whereBetween('transaction_date',[$from, $to])
                            ->leftJoin('bm_inv_onhand_quantities_detail as o',function($join){
                                    $join->on('o.inventory_item_id','=','bm_inv_material_txns.inventory_item_id');
                                    $join->on('o.subinventory_code','=','bm_inv_material_txns.subinventory_code');
                            })
                            ->select('bm_inv_material_txns.subinventory_code','bm_inv_material_txns.inventory_item_id',
                                    DB::raw('SUM (CASE WHEN transaction_action_id IN (23) THEN bm_inv_material_txns.transaction_quantity ELSE 0 END) as beg_stock'),
                                    DB::raw('SUM (CASE WHEN transaction_action_id IN (1,32,38,12,11) THEN bm_inv_material_txns.transaction_quantity ELSE 0 END) as in_item'),
                                    DB::raw('SUM (CASE WHEN transaction_action_id IN  (2,4,9,27,31) THEN bm_inv_material_txns.transaction_quantity ELSE 0 END) as out_item'),
                                    DB::raw('AVG (actual_cost) as harga')
                                    )
                            ->groupBy('bm_inv_material_txns.subinventory_code','bm_inv_material_txns.inventory_item_id')
                            ->get();
        // dd($txns);

        return view('admin.stdReports.invReport',compact('txns'));
    }

    public function pdf($from, $to)
    {
        //
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            // $from = 0;
            if(is_numeric($from))
            {
                // dd($from);
                $header = RcvHeader::whereBetween('receipt_num',[$from,$to])->get();
                foreach($header as $key => $value)
                {
                    $qry[$key] = $value->shipment_header_id;
                    $qry2[$key]= $value->receipt_num;
                }
                $data = RcvDetail::whereIn('shipment_header_id',$qry)->get();
                $counter = DB::table('bm_c_rcv_transactions_id as t')
                                ->leftJoin('bm_c_rcv_shipment_header_id as h','h.shipment_header_id','=','t.shipment_header_id')
                                ->select('t.shipment_header_id',DB::raw('count(t.shipment_header_id) as pgs'))
                                ->whereIn('h.receipt_num',$qry2)
                                ->groupBy('t.shipment_header_id')
                                ->get();
                // dd($counter);
            }
            else
            {
                $header = RcvHeader::whereBetween('gl_date',[$from,$to])->get();
                foreach($header as $key => $value)
                {
                    $qry[$key] = $value->shipment_header_id;
                }
                $data = RcvDetail::whereIn('shipment_header_id',$qry)->get();
                $counter = DB::table('bm_c_rcv_transactions_id as t')
                                ->leftJoin('bm_c_rcv_shipment_header_id as h','h.shipment_header_id','=','t.shipment_header_id')
                                ->select('t.shipment_header_id',DB::raw('count(t.shipment_header_id) as pgs'))
                                ->whereIn('h.receipt_num',$qry2)
                                ->groupBy('t.shipment_header_id')
                                ->get();
            }

         $pdf = \PDF::loadview('admin.grn.show',compact('header','data','counter'))->setPaper('A5','landscape');
         return $pdf->stream('GRN'.$from.'-'.$to.'.pdf');
    }

}

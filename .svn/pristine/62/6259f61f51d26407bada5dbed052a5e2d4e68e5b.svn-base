<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AccPayTrxLines;
use PDF;
use DB;

class apController extends Controller
{
    public function index(Request $request){
        $voucher_from = $request->voucher_from;
        $voucher_to = $request->voucher_to;
        $ap = \App\AccPayHeader::whereBetween('voucher_num',[$voucher_from,$voucher_to])->get();
        // dd($ap);
        $data_arr = array();
        foreach($ap as $key => $value)
        {
            $qry[$key] = $value->invoice_id;
            $qry1[$key]= 1;
        }
        if(empty($qry)){
            return back()->with('error', 'Field (From / To) is required | Or Purchase dont Exist');
        }
        $ap_lines = AccPayTrxLines::whereIn('invoice_id',$qry)->where('deleted_at',NULL)->get();
        // dd($ap_lines);
        $lines = AccPayTrxLines::whereIn('invoice_id',$qry)->where('deleted_at',NULL)->first();
        $counter = DB::table('bm_ap_invoice_lines_all')->select('invoice_id',DB::raw('count(invoice_id) as pgs' ))
        ->whereIn('invoice_id',$qry)
        ->where('deleted_at',NULL)
        ->groupBy('invoice_id')
        ->get();
        $pdf = PDF::loadview('admin.stdReports.apReport',compact('ap','ap_lines','counter','lines'))->setPaper('A5','landscape');
        return $pdf->stream('AP Report'.$voucher_from.'-'.$voucher_to.'.pdf');
    }
}

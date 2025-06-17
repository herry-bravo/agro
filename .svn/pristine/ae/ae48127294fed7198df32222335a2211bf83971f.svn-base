<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PurchaseRequisition;
use App\PurchaseRequisitionDet;
use App\Vendor;
use App\ItemMaster;
use App\Comments;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use DB;
use PDF;

class prReportController extends Controller
{
    //
    public function index(Request $request){
        $lg = $request->logo;
        $aprv = $request->aprv;
        $wait_aprv = $request->wait_aprv;
        $prFrom = $request->input('prFrom');
        $prTo = $request->input('prTo');
        $createFrom = $request->input('createFrom');
        $createTo = $request->input('createTo');

        // $header = PurchaseRequisition::whereBetween('segment1',[$prFrom,$prTo])
        //                         ->get();

        // foreach($header as $key => $value)
        // {
        //     $qry[$key] = $value->id;
        //     $qry1[$key]= 1;
        // }
        // $data = PurchaseRequisitionDet::whereIn('header_id',$qry)->get();
        // dd($data);

        return view('admin.stdReports.pr_report');
    }

    public function pdf(Request $request){
        $lg = $request->logo;
        $aprv = $request->aprv;
        $wait_aprv = $request->wait_aprv;
        $prFrom = $request->input('prFrom');
        $prTo = $request->input('prTo');
        $createFrom = $request->input('createFrom');
        $createTo = $request->input('createTo');

        $header = PurchaseRequisition::whereBetween('segment1',[$prFrom,$prTo])
                                ->get();

        foreach($header as $key => $value)
        {
            $qry[$key] = $value->id;
            $qry1[$key]= 1;
        }
        $data = PurchaseRequisitionDet::whereIn('header_id',$qry)->get();
        // dd($data);

        $comment=Comments::whereIn('app_header_id',$qry)->get();

        $counter = DB::table('bm_req_det_all')
                    ->select('header_id',DB::raw('count(header_id) as pgs' ))
                    ->whereIn('header_id',$qry)
                    ->groupBy('header_id')
                    ->get();
        $pdf = PDF::loadview('admin.stdReports.prReport', compact('data','header','comment','counter','lg'))->setPaper('A5','landscape');
        return $pdf->stream('PR Report'.$prFrom.'-'.$prTo.'.pdf');
    }
}

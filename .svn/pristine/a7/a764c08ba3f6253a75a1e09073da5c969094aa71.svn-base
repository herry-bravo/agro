<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class paymentController extends Controller
{
    public function index(Request $request){
        $voucher_from = $request->voucher_from;
        $voucher_to = $request->voucher_to;
        $payment = \App\ApPayment::whereBetween('attribute1',[$voucher_from,$voucher_to])->where('deleted_at',NULL)->get();

        $data_arr = array();
        foreach($payment as $key => $value)
        {
            $qry[$key] = $value->id;
            $qry1[$key]= 1;
        }

        if(empty($qry)){
            return back()->with('error', 'Field (From / To) is required | Or Purchase dont Exist');
        }
        // dd($payment);
        $pdf = PDF::loadview('admin.stdReports.paymentReport',compact('payment'))->setPaper('A5','landscape');
        return $pdf->stream('AP Report'.$voucher_from.'-'.$voucher_to.'.pdf');
    }

    public function glReport (Request $request)
    {
        $date = Carbon::parse($request->period);
        $period = $date->format('M y');
        $data = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
                            ->whereBetween('effective_date',[$request->from, $request->to])
                            ->groupBy('code_combination_id','currency_code')
                            ->orderBy('code_combination_id')
                            ->get();
        $lines = \App\GlLines::whereBetween('effective_date',[$request->from, $request->to])->orderBy('effective_date')->get();
        return view('admin.stdReports.glReport',compact('data','lines','period'));
    }

    public function bankReport (Request $request)
    {
        $from =Carbon::parse($request->from);
        $to =Carbon::parse($request->to);
        $data = \App\GlLines::select('bm_gl_lines.*','p.attribute_category')
                            ->leftJoin('bm_gl_je_headers as gl','gl.je_header_id','=','bm_gl_lines.je_header_id')
                            ->leftJoin('bm_ap_invoice_payments_id as p','gl.je_batch_id', '=','p.payment_num')
                            ->where(['gl.posted'=>1,'gl.je_category'=>'bank'])
                            ->whereBetween('effective_date',[$from, $to])
                            ->orderBy('effective_date','asc')
                            ->get();
        return view('admin.stdReports.bankReport',compact('data','from','to'));
    }

    public function cashReport (Request $request)
    {
        $from =Carbon::parse($request->from);
        $to =Carbon::parse($request->to);
        $data = \App\GlLines::select('bm_gl_lines.*','p.attribute_category')
                            ->leftJoin('bm_gl_je_headers as gl','gl.je_header_id','=','bm_gl_lines.je_header_id')
                            ->leftJoin('bm_ap_invoice_payments_id as p','gl.je_batch_id', '=','p.payment_num')
                            ->where(['gl.posted'=>1,'gl.je_category'=>'cash'])
                            ->whereBetween('effective_date',[$from, $to])
                            ->orderBy('effective_date','asc')
                            ->get();
        return view('admin.stdReports.cashReport',compact('data','from','to'));
    }
}

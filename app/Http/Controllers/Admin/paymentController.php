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
    public function balancesheet (Request $request)
    {
        $date = Carbon::parse($request->period);
        $period = $date->format('M y');
        // ASET LANCAR
            $asetLancar = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
                                ->whereBetween('effective_date',[$request->period, $request->voucher_to])
                                ->whereBetween('code_combination_id', [1000, 1405])
                                ->groupBy('code_combination_id','currency_code')
                                ->orderBy('code_combination_id')
                                ->get();
            $totalAsetLancar = $asetLancar->sum(function($item) {
                return $item->entered_dr - $item->entered_cr;
            });
        // ASET LANCAR
               
        // ASET TETAP
            $asetTetap = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
            ->whereBetween('effective_date',[$request->period, $request->voucher_to])
            ->whereBetween('code_combination_id', [2100, 2500])
            ->groupBy('code_combination_id','currency_code')
            ->orderBy('code_combination_id')
            ->get();
            $totalAsetTetap = $asetTetap->sum(function($item) {
                return $item->entered_dr - $item->entered_cr;
            });
        // ASET TETAP
        $totalAset = $totalAsetLancar + $totalAsetTetap; 

        // Liabilitas Jangka Pendek
            $ljangkapendek = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
            ->whereBetween('effective_date',[$request->period, $request->voucher_to])
            ->whereBetween('code_combination_id', [3100, 3400])
            ->groupBy('code_combination_id','currency_code')
            ->orderBy('code_combination_id')
            ->get();
            $totalljangkapendek = $ljangkapendek->sum(function($item) {
                return $item->entered_cr - $item->entered_dr;
            });
        // Liabilitas Jangka Pendek
        
        // Liabilitas Jangka Panjang
            $ljangkapanjang = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
                ->whereBetween('effective_date',[$request->period, $request->voucher_to])
                ->whereBetween('code_combination_id', [4100, 4200])
                ->groupBy('code_combination_id','currency_code')
                ->orderBy('code_combination_id')
                ->get();
            $totalljangkapanjang = $ljangkapanjang->sum(function($item) {
                return  $item->entered_cr - $item->entered_dr;
            });
        // Liabilitas Jangka Panjang
        
       
            $pendapatan = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
                ->whereBetween('effective_date',[$request->period, $request->voucher_to])
                ->whereBetween('code_combination_id', [6000, 6999])
                ->groupBy('code_combination_id','currency_code')
                ->orderBy('code_combination_id')
                ->get();
            $totalPendapatan = $pendapatan->sum(function($item) {
                return $item->entered_cr - $item->entered_dr ;
            });
            $beban1 = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
                ->whereBetween('effective_date',[$request->period, $request->voucher_to])
                ->whereBetween('code_combination_id', [7000, 7999])
                ->groupBy('code_combination_id','currency_code')
                ->orderBy('code_combination_id')
                ->get();
            $totalbeban1 = $beban1->sum(function($item) {
                return $item->entered_dr-$item->entered_cr  ;
            });

            $beban2 = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
                ->whereBetween('effective_date',[$request->period, $request->voucher_to])
                ->whereBetween('code_combination_id', [8000, 8999])
                ->groupBy('code_combination_id','currency_code')
                ->orderBy('code_combination_id')
                ->get();
            $totalbeban2 = $beban2->sum(function($item) {
                return  $item->entered_dr  - $item->entered_cr ;
            });
            
            $labaDiTahan = $totalPendapatan-$totalbeban1-$totalbeban2;
             // Modal Pemilik
            $modalPemilik = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
                ->whereBetween('effective_date',[$request->period, $request->voucher_to])
                ->whereBetween('code_combination_id', [5100, 5400])
                ->groupBy('code_combination_id','currency_code')
                ->orderBy('code_combination_id')
                ->get();
            $jumlahmodalPemilik = $modalPemilik->sum(function($item) {
                return $item->entered_cr - $item->entered_dr ;
            });
            $totalmodalPemilik = $labaDiTahan+$jumlahmodalPemilik;
            // dd($jumlahmodalPemilik);
        // Modal Pemilik
            $codelabatahunberjalan = \App\AccountCode :: where('account_code',5300)->first();
        // dd($codelabatahunberjalan);

        $lines = \App\GlLines::whereBetween('effective_date',[$request->from, $request->to])->orderBy('effective_date')->get();
        return view('admin.stdReports.balancesheetReport',compact('codelabatahunberjalan','totalmodalPemilik','modalPemilik','totalljangkapanjang','ljangkapanjang','totalljangkapendek','ljangkapendek','totalAset','totalAsetTetap','asetTetap','totalAsetLancar','asetLancar','lines','period','labaDiTahan'));
    }
    public function pnlReport (Request $request)
    {
        // dd('masuk pnl');
        $date = Carbon::parse($request->period);
        $period = $date->format('M y');
        // Pendapatan Usaha Kotor (Sales Revenue)
            $pendapatanUsahaKotor = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
            ->whereBetween('effective_date',[$request->from, $request->to])
            ->whereBetween('code_combination_id', [6100, 6200])
            ->groupBy('code_combination_id','currency_code')
            ->orderBy('code_combination_id')
            ->get();
            $totalpendapatanUsahaKotor = $pendapatanUsahaKotor->sum(function($item) {
                return $item->entered_cr - $item->entered_dr;
            });
        // Pendapatan Usaha Kotor (Sales Revenue)
        // Retur Penjualan 
            $returPenjualan = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
            ->whereBetween('effective_date',[$request->from, $request->to])
            ->whereBetween('code_combination_id', [6300, 6300])
            ->groupBy('code_combination_id','currency_code')
            ->orderBy('code_combination_id')
            ->get();
            $totalreturPenjualan = $returPenjualan->sum(function($item) {
                return $item->entered_cr-$item->entered_dr;
            });
        // Retur Penjualan 
            $totalpenjualanBersih =  $totalpendapatanUsahaKotor - $totalreturPenjualan;

        // Beban Pokok Penjualan (COGS)
            $bebanPokokPenjualan = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
                ->whereBetween('effective_date',[$request->from, $request->to])
                ->whereBetween('code_combination_id', [7100, 7100])
                ->groupBy('code_combination_id','currency_code')
                ->orderBy('code_combination_id')
                ->get();
            $totalbebanPokokPenjualan = $bebanPokokPenjualan->sum(function($item) {
                return $item->entered_dr - $item->entered_cr;
            });
            $totalpendapatankotor = $totalpenjualanBersih - $totalbebanPokokPenjualan;
        // Beban Pokok Penjualan (COGS)

        // Beban Pemasaran  
            $bebanPemasaran = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
            ->whereBetween('effective_date',[$request->from, $request->to])
            ->whereBetween('code_combination_id', [7200, 7200])
            ->groupBy('code_combination_id','currency_code')
            ->orderBy('code_combination_id')
            ->get();
            $totalbebanPemasaran = $bebanPemasaran->sum(function($item) {
                return $item->entered_cr-$item->entered_dr;
            });
        // Beban Pemasaran  
        // Beban  Administrasi & Umum
            $bebanAdministrasiUmum = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
            ->whereBetween('effective_date',[$request->from, $request->to])
            ->whereBetween('code_combination_id', [8000, 8900])
            ->groupBy('code_combination_id','currency_code')
            ->orderBy('code_combination_id')
            ->get();
            $totalbebanAdministrasiUmum = $bebanAdministrasiUmum->sum(function($item) {
                return  $item->entered_dr - $item->entered_cr;
            });
        // Beban  Administrasi & Umum
        // Total Beban Pemasaran & Administrasi umum 
            $totalBebanPemasarandanadministrasiumum = $totalbebanPemasaran + $totalbebanAdministrasiUmum;
        // Total Beban Pemasaran & Administrasi umum 

        // Laba Bersih Sebelum Pajak 
            $totalLabaBersihSebelumPajak = $totalpendapatankotor - $totalBebanPemasarandanadministrasiumum;
        // Laba Bersih Sebelum Pajak 


        $lines = \App\GlLines::whereBetween('effective_date',[$request->from, $request->to])->orderBy('effective_date')->get();
        return view('admin.stdReports.pnlReport',compact('totalLabaBersihSebelumPajak','totalBebanPemasarandanadministrasiumum','totalbebanAdministrasiUmum','bebanAdministrasiUmum','bebanPemasaran','totalbebanPemasaran','totalpendapatankotor','totalbebanPokokPenjualan','bebanPokokPenjualan','totalpenjualanBersih','totalreturPenjualan','returPenjualan','totalpendapatanUsahaKotor','pendapatanUsahaKotor','lines','period'));
    }
    public function glReport (Request $request)
    {
        $date = Carbon::parse($request->period);
        $period = $date->format('M y');
        $data = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
                            ->whereBetween('effective_date',[$request->from, $request->to])
                            ->whereBetween('code_combination_id', [1000, 2500])
                            ->groupBy('code_combination_id','currency_code')
                            ->orderBy('code_combination_id')
                            ->get();
        $lines = \App\GlLines::whereBetween('effective_date',[$request->from, $request->to])->whereBetween('code_combination_id', [1000, 2500])->orderBy('effective_date')->get();
        $data2 = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
                            ->whereBetween('effective_date',[$request->from, $request->to])
                            ->whereBetween('code_combination_id', [3000, 6300])
                            ->groupBy('code_combination_id','currency_code')
                            ->orderBy('code_combination_id')
                            ->get();
        $lines2 = \App\GlLines::whereBetween('effective_date',[$request->from, $request->to])->whereBetween('code_combination_id', [3000, 6300])->orderBy('effective_date')->get();
        $data3 = \App\GlLines::select('code_combination_id','currency_code',\DB::raw('sum(entered_dr) as entered_dr,sum(entered_cr) as entered_cr'))
                            ->whereBetween('effective_date',[$request->from, $request->to])
                            ->whereBetween('code_combination_id', [7000, 8900])
                            ->groupBy('code_combination_id','currency_code')
                            ->orderBy('code_combination_id')
                            ->get();
           
        $lines3 = \App\GlLines::whereBetween('effective_date',[$request->from, $request->to])->whereBetween('code_combination_id', [7000, 8900])->orderBy('effective_date')->get();
        return view('admin.stdReports.glReport',compact('lines3','data3','lines2','data2','data','lines','period'));
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

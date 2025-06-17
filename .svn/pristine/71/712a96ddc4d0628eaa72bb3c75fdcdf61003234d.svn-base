<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AccPayHeader;
use App\AccPayTrxLines;
use App\Terms;
use App\Currency;
use App\CurrencyGlobal;
use App\Vendor;
use App\GlHeader;
use App\GlLines;
use App\AccountCode;
use App\ApPayment;
use DB;

class CreditMemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.creditMemo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $terms = Terms::where('term_category','PAYMENT')->get();
        $currency = CurrencyGlobal::where('currency_status', 1)->get();
        $vendor = Vendor::all()->take(3);

        $header_id = DB::table('bm_ap_invoices_all')->get()->last();
        $header_id = $header_id->invoice_id + 1;
        $voucher_num = str_pad($header_id,6,"0",STR_PAD_LEFT);

        $tax =\App\Tax::where(['type_tax_use'=>'Purchase', 'tax_code'=>'TAX-11'])->first();
        return view('admin.creditMemo.create',compact('terms','currency','vendor','tax','voucher_num'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        switch ($request->input('action')) {
            case 'save':
                try {
                    \DB::beginTransaction();
                        /* Header */
                        $header_id = DB::table('bm_ap_invoices_all')->get()->last();
                        $header_id = $header_id->invoice_id + 1;
                        $line_number = 1;

                        $voucher_num = str_pad($header_id,6,"0",STR_PAD_LEFT);

                        $ap = AccPayHeader::where('invoice_id',$request->invoice_id)->first();
                        // dd($ap);
                        $rate = \App\CurrencyRate::where('currency_id', $ap->invoice_currency_code)->select('rate','rate_date','currency_id')->latest('rate_date')->first();
                        // dd($request->all());

                        $head =AccPayHeader::findorNew($request->id);
                        $head->invoice_id =$header_id;
                        $head->voucher_num =$voucher_num;
                        $head->invoice_num =$ap->invoice_num;
                        $head->po_header_id =$ap->po_header_id;
                        $head->vendor_id =$ap->vendor_id;
                        $head->remit_to_supplier_id =$ap->remit_to_supplier_id; //
                        $head->remit_to_supplier_name =$ap->remit_to_supplier_name; //
                        $head->invoice_amount =$ap->invoice_amount;
                        $head->payment_amount_total =$ap->payment_amount_total;
                        $head->invoice_currency_code =$ap->invoice_currency_code;
                        $head->invoice_type_lookup_code =$ap->invoice_type_lookup_code;
                        $head->invoice_date =$ap->invoice_date;
                        $head->gl_date =$ap->gl_date;
                        $head->invoice_received_date =$ap->invoice_received_date;
                        $head->terms_id =$ap->terms_id;
                        $head->org_id =$ap->org_id;
                        $head->exchange_rate_type =$ap->exchange_rate_type;
                        $head->exchange_rate =$ap->exchange_rate;
                        $head->exchange_date =$ap->exchange_date;
                        $head->job_definition_name='Credit Memo';
                        $head->total_tax_amount =$ap->tax_amount;
                        $head->supplier_tax_invoice_number =$ap->tax_code ?? 'TAX-00';
                        $head->supplier_tax_exchange_rate =$ap->tax_rate ?? 0;
                        $head->created_by =auth()->user()->id;
                        $head->approval_status =0;
                        $head->posting_status =0;
                        $head->last_update_login =date('Y-m-d H:i:s');
                        // dd($head);
                        $head->save();

                        $ap_line = AccPayTrxLines::where('invoice_id',$request->invoice_id)->get();
                        foreach($ap_line as $key => $ap_line){

                            if($ap_line->line_type_lookup_code == false){
                                $data = array(
                                        'invoice_id'=>$header_id,
                                        'line_id'=> $line_number,
                                        'inventory_item_id'=>$ap_line->inventory_item_id,
                                        'po_header_id'=>$ap_line->po_header_id ?? '',
                                        'po_line_id'=>$ap_line->po_line_id ?? '',
                                        'item_description'=>$ap_line->item_description,
                                        'rcv_transaction_id'=>$ap_line->rcv_transaction_id ?? '',
                                        'receipt_currency_code'=>$ap_line->receipt_currency_code?? '',
                                        'quantity_invoiced'=>$ap_line->quantity_invoiced,
                                        'unit_price'=>$ap_line->unit_price,
                                        'account_segment'=>$ap_line->account_segment,
                                        'stat_amount'=>$ap_line->stat_amount,
                                        'original_amount'=>$ap_line->stat_amount,
                                        'amount'=>$ap_line->amount,
                                        'total_rec_tax_amount'=>$ap_line->total_nrec_tax_amount,
                                        'total_nrec_tax_amount'=>$ap_line->total_rec_tax_amount,
                                        'tax'=>$ap_line->tax,
                                        'line_type_lookup_code'=>$ap_line->line_type_lookup_code,
                                        'unit_meas_lookup_code'=>$ap_line->unit_meas_lookup_code,
                                        'tax_rate'=>$ap_line->tax_rate,
                                        'tax_rate_code'=>$ap_line->tax_rate_code,
                                        'job_definition_name'=>'Credit Memo',
                                        'created_at'=>date('Y-m-d H:i:s'),
                                        'updated_at'=>date('Y-m-d H:i:s'),
                                    );
                                AccPayTrxLines::create($data);
                            }else{
                                // dd("masuk");
                                $acc = array(
                                    'invoice_id'=>$header_id,
                                    'line_id'=> $line_number,
                                    'item_description'=>$ap_line->item_description,
                                    'account_segment'=>$ap_line->account_segment,
                                    'total_rec_tax_amount'=>$ap_line->total_nrec_tax_amount,
                                    'total_nrec_tax_amount'=>$ap_line->total_rec_tax_amount,
                                    'line_type_lookup_code'=>$ap_line->line_type_lookup_code,
                                    'job_definition_name'=>$ap_line->job_definition_name,
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s'),
                                );
                                AccPayTrxLines::create($acc);
                            }
                            $line_number++;
                        }


                        $id = DB::table('bm_ap_invoices_all')->get()->last();
                        $id = $id->invoice_id;
                        \DB::commit();

                    }catch (Throwable $e){
                        \DB::rollback();
                    }
                    return redirect()->route('admin.credit-memo.edit',$id)->with('success', 'Data Is Inputed');
            break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ap = AccPayHeader::where('invoice_id',$id)->get()->first();
        $terms = Terms::where('term_category','PAYMENT')->get();
        $currency = CurrencyGlobal::where('currency_status', 1)->get();
        $vendor = Vendor::all()->take(3);
        $ap_lines = AccPayTrxLines::where('invoice_id','=',$id)->get();
        $lines = AccPayTrxLines::where('invoice_id','=',$id)->first();

        $payment = ApPayment::where('invoice_id','=',$id)->first();

        $acc = AccountCode::all();
        $ba = \App\BankAccount::all();
        $curr = Currency::All();
        $journal = \App\Category::orderBy('id','desc')->where('account_type','Bank & Cash')->get();

        return view('admin.creditMemo.edit',compact('ap','ap_lines','terms','currency','vendor','acc','ba','journal','lines','payment','curr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

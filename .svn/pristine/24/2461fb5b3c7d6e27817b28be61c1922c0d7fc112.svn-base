<?php

namespace App\Http\Controllers\Admin;
use App\Category;
use App\Customer;
use App\Currency;
use App\BankAccount;
use App\ApPayment;
use App\GlHeader;
use App\GlLines;
use App\AccountCode;
use App\MaterialTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArPaymentController extends Controller
{
    public function index()
    {
        return view('admin.arPayment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $journal = MaterialTransaction::whereIn('trx_code', [40,39,34,4,1,41,42,43])->select('trx_code','trx_source_types')->get();
        $acc = AccountCode::All();
        $customer = Customer::All();
        $curr = Currency::All();
        $ba = BankAccount::All();
       return view('admin.arPayment.create',compact('journal','customer','curr','ba','acc'));

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

        try {
            \DB::beginTransaction();

            //Status update
            $date = date('M y');
            $invoice_payment_id = ApPayment::latest()->first('invoice_payment_id');
            $payment=ApPayment::findorNew($request->id);
            $invoice_payment_id = ($invoice_payment_id->invoice_payment_id ?? 0)+1;


            $rate = \App\CurrencyRate::where('currency_id', $request->payment_currency_code)->select('rate','rate_date','currency_id')->latest('rate_date')->first();
            $acc = Category::where('category_code',$request->attribute_category)->first();
            $customer = Customer::where('cust_party_code',$request->customer)->first();

            $payment->accounting_date = $request->accounting_date;
            $payment->amount = $request->amount;
            $payment->invoice_id = '';
            $payment->invoice_payment_id = $invoice_payment_id;
            $payment->last_updated_by = $request->created_by;
            $payment->payment_num = $request->je_batch_id;
            $payment->period_name = $date;
            $payment->posted_flag = 4;
            $payment->set_of_books_id = $request->acc;
            $payment->created_by = $request->created_by;
            $payment->bank_account_num = BankAccount::where('bank_account_id',$request->bank_num)->first()->bank_acct_use_id ; //
            $payment->bank_account_type = BankAccount::where('bank_account_id',$request->bank_num)->first()->attribute_category; //
            $payment->bank_num = $request->bank_num;
            $payment->payment_base_amount = $request->amount;
            $payment->invoice_payment_type = $request->invoice_payment_type;
            $payment->invoicing_vendor_site_id = $request->vendor;
            $payment->payment_currency_code = $request->payment_currency_code;
            $payment->global_attribute1 = $request->global_attribute1;
            $payment->attribute1 = $request->memo;
            $payment->attribute_category = $request->attribute_category;
            $payment->exchange_date=$rate->rate_date;
            $payment->exchange_rate=$rate->rate;
            $payment->created_at = date('Y-m-d H:i:s');
            $payment->updated_at = date('Y-m-d H:i:s');
            // dd($payment);
            $payment->save();

            //GL Create
            $header_id = GlHeader::latest()->first();
            $id=$header_id->je_header_id+1;
            $head = GlHeader::findorNew($id);
            $head->je_header_id =$id;
            $head->name=$customer->party_name.' Payment Rp.'.$request->amount; //
            $head->created_by=$request->created_by;
            $head->last_updated_by=$request->created_by;
            $head->je_source='Import'; //
            $head->status=$request->paid_status ?? 4;
            $head->je_batch_id=$request->je_batch_id ;
            $head->default_effective_date=$request->accounting_date;
            $head->period_name=$date;
            $head->external_reference=$invoice_payment_id;
            $head->je_category=$request->attribute_category;
            $head->currency_code=$request->payment_currency_code;
            $head->running_total_dr=$request->amount;
            $head->running_total_cr=$request->amount;
            $head->save();
            // dd($head);

            foreach($request->payment as $key =>$label){
                if($request->payment[$key] ==11020100 ){
                    $entered_dr= 0;
                    $entered_cr= $request->amount;
                }else{
                    $entered_cr= 0;
                    $entered_dr= $request->amount;
                }
                $data = array(
                    'je_header_id'=>$id,
                    'je_line_num'=> $key+1,
                    'last_updated_by'=>auth()->user()->id,
                    'ledger_id'=>$request->je_batch_id ,
                    'code_combination_id'=>$request->payment[$key],
                    'period_name'=>$date,
                    'effective_date'=>$request->accounting_date ,
                    'status'=>$request->paid_status ?? 4,
                    'created_by'=>$request->created_by,
                    'entered_dr'=>$entered_dr,
                    'entered_cr'=>$entered_cr,
                    'description'=>'Customer Payment - Rp.'.$request->amount.' - '.$customer->party_name.' - '.$request->accounting_date,
                    'reference_1'=>$customer->party_name,
                    'tax_code'=>$request->tax ?? 0,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                );
                GlLines::create($data);
            }

            \DB::commit();
            return redirect()->route('admin.gl.edit',$id)->with('success', 'Data Stored');
        }catch (Throwable $e){
            \DB::rollback();
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
        //
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

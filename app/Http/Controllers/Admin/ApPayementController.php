<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Vendor;
use App\Currency;
use App\BankAccount;
use App\ApPayment;
use App\GlHeader;
use App\GlLines;
use App\MaterialTransaction;
use App\AccountCode;
use App\PurchaseOrder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApPayementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.apPayment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $journal = MaterialTransaction::select('trx_code','trx_source_types')->get();
        $journal = AccountCode::whereRaw('LOWER(description) like ?', ['kas%'])
        ->orWhereRaw('LOWER(description) like ?', ['bank%'])
        ->get();
        $acc = AccountCode::where('description', 'like', '%hutang%')->get();
        $vendor = Vendor::All();
        $curr = Currency::All();
        $ba = BankAccount::All();
        $invoice = PurchaseOrder::where('source',1)->get();
        // $invoice = PurchaseOrder::whereRaw("
        //     ISNULL(LTRIM(RTRIM(LOWER(attribute1))), '') 
        //     <> 
        //     ISNULL(LTRIM(RTRIM(LOWER(attribute2))), '')
        // ")->get();

        return view('admin.apPayment.create',compact('invoice','journal','vendor','curr','ba','acc'));

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
            // $searchInv =PurchaseOrder::where($request->id)->first();
            $salesOrder = PurchaseOrder::where('segment1',$request->invoice)->first();
            $amountpayment = $salesOrder->attribute2 + $request->paid_off;
            // dd($amountpayment);
            $lastHeader = DB::table('bm_gl_je_headers')->latest('id')->first(); // Lebih efisien daripada get()->last()
            $newId = $lastHeader ? $lastHeader->id + 1 : 1;

            $head = new GlHeader(); // Buat instance baru
            $head->je_header_id = $newId;
            $head->name = $request->invoice;
            $head->created_by = auth()->user()->id;
            $head->last_updated_by = auth()->user()->id;
            $head->je_batch_id = $request->je_batch_id;
            $head->default_effective_date = $request->accounting_date;
            $head->period_name = Carbon::parse($request->accounting_date)->format('M-y');
            $head->external_reference = $request->invoice;
            $head->currency_code =  $salesOrder->currency_code;
            $head->running_total_dr = $request->paid_off;
            $head->running_total_cr = $request->paid_off;
            
            // Create new GlLines - child1
            $child1 = new GlLines();
            $child1->je_header_id = $newId;
            $child1->je_line_num = 2;
            $child1->last_updated_by = auth()->user()->id;
            $child1->ledger_id = $newId;
            $child1->code_combination_id = $request->attribute_category;
            $child1->period_name = Carbon::parse($request->accounting_date)->format('M-y');
            $child1->effective_date = $request->accounting_date;
            $child1->created_by = auth()->user()->id;
            $child1->entered_dr = $request->paid_off; // NULL bukan string
            $child1->entered_cr = null;
            $child1->description = DB::table('bm_acc_all_id')->where('account_code',  $request->attribute_category)->value('description');
            $child1->currency_code = $salesOrder->currency_code;
            $child1->created_at = $request->accounting_date;
            $child1->updated_at = $request->accounting_date;
    
            // Create new GlLines - child2
            $child2 = new GlLines();
            $child2->je_header_id = $newId;
            $child2->je_line_num = 2;
            $child2->last_updated_by = auth()->user()->id;
            $child2->ledger_id = $newId;
            $child2->code_combination_id = $request->acc;
            $child2->period_name = Carbon::parse($request->accounting_date)->format('M-y');
            $child2->effective_date = $request->accounting_date;
            $child2->created_by = auth()->user()->id;
            $child2->entered_dr = null; // NULL bukan string
            $child2->entered_cr = $request->paid_off;
            $child2->description = DB::table('bm_acc_all_id')->where('account_code',  $request->acc)->value('description');
            $child2->currency_code = $salesOrder->currency_code;
            $child2->created_at = $request->accounting_date;
            $child2->updated_at = $request->accounting_date;
            // dd($request->attribute_category);
            $trx = MaterialTransaction::where('trx_code',$request->attribute_category)->first();
            // dd($trx);
            $head->save();
            $child1->save();
            $child2->save();
            //Status update
            // dd($trx);
            ApPayment::create([
                'invoice_id' => $salesOrder->id,
                'accounting_date' => $request->accounting_date,
                'attribute1' => $request->invoice,
                'amount' => $request->paid_off, // atau bisa $request->payment_date
                'payment_numstatus' => $request->bank_num,
                'posted_flag' => 4,
                'invoice_payment_type' => $trx->trx_types,
                'payment_currency_code' => $salesOrder->currency_code,
                'global_attribute_category' => 'PURCHASE',
                'invoice_payment_id' => $request->je_batch_id,
                // tambahkan field lain sesuai kolom di tabel kamu
            ]);
            
            if($request->paid_off==null){
                return redirect()->back()->with('error','Amount Can Not be Empty');
            }elseif($salesOrder->attribute1 < $amountpayment){
                return redirect()->back()->with('error','Payment Can Not be Higher');
            }else{
                $salesOrder->update([
                    'attribute2' => $amountpayment
                ]);
            }

            \DB::commit();
            return redirect()->route('admin.gl.index')->with('success', 'Data Stored');
        }catch (Throwable $e){
            \DB::rollback();
        }
    }
    // public function store(Request $request)
    // {
    //     //

    //     try {
    //         \DB::beginTransaction();

    //         //Status update
    //         $date = date('M y');
    //         $invoice_payment_id = ApPayment::latest()->first('invoice_payment_id');
    //         $payment=ApPayment::findorNew($request->id);
    //         $invoice_payment_id = ($invoice_payment_id->invoice_payment_id ?? 0)+1;


    //         $rate = \App\CurrencyRate::where('currency_id', $request->payment_currency_code)->select('rate','rate_date','currency_id')->latest('rate_date')->first();
    //         $vendor = Vendor::where('vendor_id',$request->vendor)->first();

    //         $payment->accounting_date = $request->accounting_date;
    //         $payment->amount = $request->amount;
    //         $payment->invoice_id = '';
    //         $payment->invoice_payment_id = $invoice_payment_id;
    //         $payment->last_updated_by = $request->created_by;
    //         $payment->payment_num = $request->je_batch_id;
    //         $payment->period_name = $date;
    //         $payment->posted_flag = 4;
    //         $payment->set_of_books_id = $request->acc;
    //         $payment->created_by = $request->created_by;
    //         $payment->bank_account_num = BankAccount::where('bank_account_id',$request->bank_num)->first()->bank_acct_use_id ; //
    //         $payment->bank_account_type = BankAccount::where('bank_account_id',$request->bank_num)->first()->attribute_category; //
    //         $payment->bank_num = $request->bank_num;
    //         $payment->payment_base_amount = $request->amount;
    //         $payment->invoice_payment_type = $request->invoice_payment_type;
    //         $payment->invoicing_vendor_site_id = $request->vendor;
    //         $payment->payment_currency_code = $request->payment_currency_code;
    //         $payment->global_attribute1 = $request->global_attribute1;
    //         $payment->attribute1 = $request->memo;
    //         $payment->attribute_category = $request->attribute_category;
    //         $payment->exchange_date=$rate->rate_date;
    //         $payment->exchange_rate=$rate->rate;
    //         $payment->created_at = date('Y-m-d H:i:s');
    //         $payment->updated_at = date('Y-m-d H:i:s');
    //         $payment->save();

    //         //GL Create
    //         $header_id = GlHeader::latest()->first();
    //         $id=$header_id->je_header_id+1;
    //         $head = GlHeader::findorNew($id);
    //         $head->je_header_id =$id;
    //         $head->name=$vendor->vendor_name.' Payment Rp.'.$request->amount; //
    //         $head->created_by=$request->created_by;
    //         $head->last_updated_by=$request->created_by;
    //         $head->je_source='Import'; //
    //         $head->status=$request->paid_status ?? 4;
    //         $head->je_batch_id=$request->je_batch_id ;
    //         $head->default_effective_date=$request->accounting_date;
    //         $head->period_name=$date;
    //         $head->external_reference=$invoice_payment_id;
    //         $head->je_category=$request->attribute_category;
    //         $head->currency_code=$request->payment_currency_code;
    //         $head->running_total_dr=$request->amount;
    //         $head->running_total_cr=$request->amount;
    //         $head->save();
    //         // dd($head);

    //         foreach($request->payment as $key =>$label){
    //             if($request->payment[$key] == 21010000){
    //                 $entered_dr= 0;
    //                 $entered_cr= $request->amount;
    //             }else{
    //                 $entered_cr= 0;
    //                 $entered_dr= $request->amount;
    //             }
    //             $data = array(
    //                 'je_header_id'=>$id,
    //                 'je_line_num'=> $key+1,
    //                 'last_updated_by'=>auth()->user()->id,
    //                 'ledger_id'=>$request->je_batch_id ,
    //                 'code_combination_id'=>$request->payment[$key],
    //                 'period_name'=>$date,
    //                 'effective_date'=>$request->accounting_date ,
    //                 'status'=>$request->paid_status ?? 4,
    //                 'created_by'=>$request->created_by,
    //                 'entered_dr'=>$entered_dr,
    //                 'entered_cr'=>$entered_cr,
    //                 'description'=>'Vendor Payment - Rp.'.$request->amount.' - '.$vendor->vendor_name.' - '.$request->accounting_date,
    //                 'reference_1'=>$vendor->vendor_name,
    //                 'tax_code'=>$request->tax ?? 0,
    //                 'created_at'=>date('Y-m-d H:i:s'),
    //                 'updated_at'=>date('Y-m-d H:i:s'),
    //             );
    //             GlLines::create($data);
    //         }

    //         \DB::commit();
    //         return redirect()->route('admin.gl.edit',$id)->with('success', 'Data Stored');
    //     }catch (Throwable $e){
    //         \DB::rollback();
    //     }
    // }

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
        $payment = \App\ApPayment::where('id',$id)->get()->first();
        $journal = Category::orderBy('id','desc')->get();
        $vendor = Vendor::All();
        $curr = Currency::All();
        $bankaccount = BankAccount::All();
        // dd($payment);
// dd($payment);
        return view('admin.apPayment.edit',compact('payment','journal','vendor','curr','bankaccount'));

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
        // dd($request->accounting_date);
        $payment= ApPayment::where('id',$id)->first();
        $payment->attribute_category=$request->attribute_category;
        $payment->invoicing_vendor_site_id=$request->vendor;
        $payment->bank_account_num=$request->vendor_bank_account;
        $payment->amount=$request->amount;
        $payment->payment_currency_code=$request->payment_currency_code;
        $payment->accounting_date=$request->accounting_date;
        $payment->attribute1=$request->memo;
        $payment->save();
        return back()->with('success', 'Payment Modified');
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

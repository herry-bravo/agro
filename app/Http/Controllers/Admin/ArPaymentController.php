<?php

namespace App\Http\Controllers\Admin;
use App\Category;
use App\Customer;
use App\Currency;
use App\BankAccount;
use App\ApPayment;
use App\GlHeader;
use App\SalesOrder;
use App\GlLines;
use App\AccountCode;
use App\MaterialTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


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
        // $journal = MaterialTransaction::whereIn('trx_code', [40,39,34,4,1,41,42,43])->select('trx_code','trx_source_types')->get();
        // $journal = MaterialTransaction::select('trx_code','trx_source_types')->get();
        $journal = AccountCode::whereRaw('LOWER(description) like ?', ['kas%'])
        ->orWhereRaw('LOWER(description) like ?', ['bank%'])
        ->get();

        $acc = AccountCode::where('description', 'like', '%piutang%')->get();
        $customer = Customer::All();
        $curr = Currency::All();
        $ba = BankAccount::All();
        // dd($ba);
        $invoice = SalesOrder::whereNotNull('inv_number')->whereNotNull('payment_due_date')->get();
       return view('admin.arPayment.create',compact('invoice','journal','customer','curr','ba','acc'));

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
            $searchInv =SalesOrder::where($request->id)->first();

            $salesOrder = SalesOrder::where('inv_number',$request->invoice)->first();
            $amountpayment = $salesOrder->paid_off + $request->paid_off;
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
            $head->currency_code =  $salesOrder->attribute1;
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
            $child1->currency_code = $salesOrder->attribute1;
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
            $child2->currency_code = $salesOrder->attribute1;
            $child2->created_at = $request->accounting_date;
            $child2->updated_at = $request->accounting_date;
            $trx = AccountCode::where('account_code',$request->attribute_category)->first();

            $head->save();
            $child1->save();
            $child2->save();
            //Status update
            ApPayment::create([
                'invoice_id' => $salesOrder->id,
                'accounting_date' => $request->accounting_date,
                'attribute1' => $request->invoice,
                'amount' => $request->paid_off, // atau bisa $request->payment_date
                'payment_numstatus' => $request->bank_num,
                'posted_flag' => 4,
                'invoice_payment_type' => $trx->description,
                'payment_currency_code' => $salesOrder->attribute1,
                'global_attribute_category' => 'SALES',
                'invoice_payment_id' => $request->je_batch_id,
                // tambahkan field lain sesuai kolom di tabel kamu
            ]);
            
            if($request->paid_off==null){
                return redirect()->back()->with('error','Amount Can Not be Empty');
            }elseif($salesOrder->total_payment < $amountpayment){
                return redirect()->back()->with('error','Payment Can Not be Higher');
            }else{
                $salesOrder->update([
                    'paid_off' => $amountpayment
                ]);
            }

            \DB::commit();
            return redirect()->route('admin.gl.index')->with('success', 'Data Stored');
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

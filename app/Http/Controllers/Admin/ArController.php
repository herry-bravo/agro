<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ArCustomerTrx;
use App\Terms;
use App\Currency;
use App\Customer;
use App\Site;
use App\CurrencyGlobal;
use App\GlHeader;
use App\GlLines;
use App\ArCustomerTrxLines;
use App\ArReceivableApplications;
use DB;

class ArController extends Controller
{

    public function index()
    {
        $cust = ArCustomerTrx::where('bill_template_name','!=','Credit Note')->get();
        return view('admin.arReceivable.index',compact('cust'));
    }

    public function create()
    {
        $terms = Terms::where('term_category','PAYMENT')->get();
        $currency = CurrencyGlobal::where('currency_status', 1)->get();
        $customer = Customer::All();
        $site = Site::where('site_type','=','Shipto')->get();

        $tax =\App\Tax::where(['type_tax_use'=>'Sales', 'tax_code'=>'TAX-11'])->first();
        return view('admin.arReceivable.create',compact('customer','terms','currency','site','tax'));
    }

    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();

                $id_cust_head = DB::table('bm_ra_customer_trx_all')->get()->last();
                $id_cust_head = $id_cust_head->customer_trx_id +1;
                $trx_number = 'INV'.str_pad($id_cust_head,8,"0",STR_PAD_LEFT);

                $cust_head = ArCustomerTrx::findorNew($request->id);
                $cust_head->customer_trx_id = $id_cust_head;
                $cust_head->trx_number = $trx_number;
                $cust_head->bill_template_name = $request->bill_template_name;
                $cust_head->trx_date = date('Y-m-d');
                $cust_head->bill_to_customer_id = $request->bill_to_customer_id;
                $cust_head->ship_to_customer_id = $request->ship_to_customer_id;
                $cust_head->term_id = $request->term_id;
                // $cust_head->delivery_method_code = $request->delivery_method_code;
                $cust_head->invoice_currency_code = $request->invoice_currency_code;
                $cust_head->attribute1 = $request->attribute1;
                $cust_head->attribute2 = $request->attribute2;
                $cust_head->created_by = $request->created_by;
                $cust_head->org_id = $request->org_id;
                $cust_head->exchange_date = \App\CurrencyRate::where('currency_id',$request->invoice_currency_code)->latest()->first()->rate_date;
                $cust_head->exchange_rate = \App\CurrencyRate::where('currency_id',$request->invoice_currency_code)->latest()->first()->rate;
                $cust_head->status_trx = 0;
                $cust_head->created_at = date('Y-m-dH:i:s');
                $cust_head->updated_at = date('Y-m-dH:i:s');
                $cust_head->save();

                $amount = 0;
                $tax_amount =0;
                $total_amount =0;
                $line_number = 1;

                foreach($request->code_combinations as $key => $line){
                    if($request->line_type[$key] == 0){
                        $subtotal = ($request->quantity_invoiced[$key] ?? 0) * ($request->unit_selling_price[$key] ?? 0);
                        $tax = $request->tax * $subtotal;
                        $total = $subtotal+$tax;

                        $amount += $subtotal;
                        $tax_amount += $tax;
                        $total_amount +=$amount;
                    }

                    $id_cust_line = DB::table('bm_ra_customer_trx_lines_all')->get()->last();
                    $cust_line = array(
                        'customer_trx_line_id'=>$id_cust_line->customer_trx_line_id+1,
                        'customer_trx_id'=>$id_cust_head,
                        'line_number'=>$line_number,
                        'line_type'=>$request->line_type[$key],
                        'code_combinations'=>$request->code_combinations[$key],
                        'sales_order_line'=>$request->source_line_id ?? 0,
                        'inventory_item_id'=>$request->inventory_item_id[$key] ?? null,
                        'description'=>$request->description[$key],
                        'quantity_ordered'=>$request->quantity_invoiced[$key] ?? null,
                        'quantity_invoiced'=>$request->quantity_invoiced[$key] ?? null,
                        'unit_selling_price'=>$request->unit_selling_price[$key] ?? null,
                        'sales_order'=>$request->sales_order_number ?? 0,
                        'taxable_amount'=>$tax ?? null,
                        'amount_due_original'=>$subtotal ?? null,
                        'gross_extended_amount'=>$subtotal ?? null,
                        'amount_includes_tax_flag'=>$total ?? null,
                        'frt_ed_amount'=>$request->frt_ed_amount[$key] ?? 0,
                        'frt_uned_amount'=>$request->frt_uned_amount[$key] ?? 0,
                        'tax_rate'=>$request->tax ?? null,
                        'sales_tax_id'=>$request->tax_code  ?? null,
                        'uom_code'=>$request->uom_code[$key] ?? null,
                        'org_id'=>$request->organization_id,
                        'created_by'=>$request->created_by,
                        'creation_date'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s')
                    );
                    ArCustomerTrxLines::create($cust_line);
                    $line_number++;

                }
                foreach ($request->inventory_item_id as $key => $row){
                    $item = \App\ItemMaster::where('inventory_item_id',$request->inventory_item_id[$key])->first();
                    if ($item->category_code == 'FG_ALL' || $item->category_code == 'FG_LCL'){

                        $amount_inv =$item->item_cost *  $request->quantity_invoiced[$key];
                        $ar_inv = array(
                            'customer_trx_line_id'=>$id_cust_line->customer_trx_line_id+1,
                            'customer_trx_id'=>$id_cust_head,
                            'line_number'=>$line_number,
                            'line_type'=>true,
                            'code_combinations'=>$item->category->inventory_account_code,
                            'sales_order_line'=>$request->source_line_id ?? 0,
                            'description'=>$item->category->inventory->description,
                            'sales_order'=>$request->sales_order_number ?? 0,
                            'gross_extended_amount'=>$amount_inv,
                            'amount_due_original'=>$amount_inv,
                            'frt_ed_amount'=>0,
                            'frt_uned_amount'=>$amount_inv,
                            'org_id'=>$request->organization_id,
                            'created_by'=>$request->created_by,
                            'creation_date'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s')
                        );
                        ArCustomerTrxLines::create($ar_inv);

                        $line_number = $line_number;
                        $ar_cogs = array(
                            'customer_trx_line_id'=>$id_cust_line->customer_trx_line_id+1,
                            'customer_trx_id'=>$id_cust_head,
                            'line_number'=>$line_number+1,
                            'line_type'=>true,
                            'code_combinations'=>$item->category->consumption_account_code,
                            'sales_order_line'=>$request->source_line_id ?? 0,
                            'description'=>$item->category->cogs->description,
                            'sales_order'=>$request->sales_order_number ?? 0,
                            'gross_extended_amount'=>$amount_inv,
                            'amount_due_original'=>$amount_inv,
                            'frt_ed_amount'=>$amount_inv,
                            'frt_uned_amount'=>0,
                            'org_id'=>$request->organization_id,
                            'created_by'=>$request->created_by,
                            'creation_date'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s')
                        );
                        ArCustomerTrxLines::create($ar_cogs);
                        $line_number++;
                    }
                }

                $id_ar_head =  DB::table('bm_ar_receivable_applications_all')->get()->last();
                $ar_head = array(
                    'receivable_application_id'=>$id_ar_head->receivable_application_id+1,
                    'amount_applied'=>$total_amount,
                    'gl_date'=>$request->gl_date,
                    'attribute1'=>$trx_number,
                    'application_rule'=>$request->bill_template_name,
                    'customer_trx_id'=>$id_cust_head,
                    'freight_applied'=>$request->term_id,
                    'status'=>0,
                    'tax_code'=>$request->tax_code?? 'TAX-00',
                    'tax_applied'=>$tax_amount,
                    'created_by'=>$request->created_by,
                    'org_id'=>isset($request->organization_id)?$request->organization_id:182,
                    'creation_date'=>date('Y-m-d H:i:s'),
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                );
                ArReceivableApplications::create($ar_head);

                $id = DB::table('bm_ra_customer_trx_all')->get()->last();
                $id = $id->id;

            \DB::commit();
        }catch (Throwable $e){
            \DB::rollback();
        }

        if($request->bill_template_name == 'Receivable'){
            return redirect()->route('admin.ar.edit',$id)->with('success', 'Data Stored');
        }else{
            return redirect()->route('admin.credit-note.edit',$id)->with('success', 'Data Stored');
        }
    }

    public function edit($id)
    {
        $cust = ArCustomerTrx::find($id);
        $line = ArCustomerTrxLines::where('customer_trx_id',$cust->customer_trx_id)->get();
        // dd($line);
        $data = ArCustomerTrxLines::where('customer_trx_id',$cust->customer_trx_id)->first();

        $ar = ArReceivableApplications::where('customer_trx_id',$cust->customer_trx_id)->first();
        $terms = Terms::where('term_category','PAYMENT')->get();
        $currency = CurrencyGlobal::where('currency_status', 1)->get();
        $payment = \App\ApPayment::where('invoice_id','=',$id)->first();
        $ba = \App\BankAccount::all();
        $journal = \App\Category::orderBy('id','desc')->where('account_type','Bank & Cash')->get();
        $acc = \App\AccountCode::all();
        // dd($cust);
        return view('admin.arReceivable.edit',compact('cust','terms','currency','line','data','ba','journal','payment','ar','acc'));
    }

    public function update(Request $request, $id)
    {

        switch ($request->input('action')) {
            case 'save':
                $head = ArCustomerTrx::find($id);
                $head->trx_date = date('Y-m-d');
                $head->bill_to_customer_id = $request->bill_to_customer_id;
                $head->ship_to_customer_id = $request->ship_to_party_id;
                $head->term_id = $request->term_id;
                // $head->delivery_method_code = $request->delivery_method_code;
                $head->invoice_currency_code = $request->invoice_currency_code;
                $head->attribute1 = $request->attribute1;
                $head->attribute2 = $request->attribute2;
                $head->created_by = $request->created_by;
                $head->org_id = $request->organization_id;
                $head->br_amount = $request->ar_amount;
                $head->updated_at = date('Y-m-d H:i:s');


                $ar_head = ArReceivableApplications::where('customer_trx_id',$head->customer_trx_id)->first();
                $ar_head->amount_applied=$request->ar_amount;
                $ar_head->gl_date=$request->gl_date;
                $ar_head->tax_applied=floatval($request->pajak);
                $ar_head->tax_code=\App\Tax::where(['tax_rate'=>floatval($request->pajak),'type_tax_use'=>'Sales'])->first()->tax_code;
                $ar_head->last_update_date = date('Y-m-d H:i:s');
                $ar_head->last_updated_by = auth()->user()->id;
                $ar_head->updated_at = date('Y-m-d H:i:s');

                try {
                    \DB::beginTransaction();
                    $head->save();
                    $ar_head->save();

                    // dd($array);
                    foreach($request->code_combinations as $key =>$row){

                        $tax = $request->entered_cr[$key] * $request->pajak;
                        $subtotal = $request->entered_cr[$key] + $tax;
                        $tax_code = \App\Tax::where(['tax_rate'=>floatval($request->pajak),'type_tax_use'=>'Sales'])->first()->tax_code;

                        if(empty($request->lineId[$key])){

                            $sales_local = array(
                                'customer_trx_line_id'=>isset(DB::table('bm_ra_customer_trx_lines_all')->get()->last()->customer_trx_line_id)? DB::table('bm_ra_customer_trx_lines_all')->get()->last()->customer_trx_line_id+1 :1,
                                'customer_trx_id'=>$head->customer_trx_id,
                                'line_number'=>DB::table('bm_ra_customer_trx_lines_all')->get()->last()->line_number+1,
                                'line_type'=>False,
                                'org_id'=>$request->organization_id,
                                'code_combinations'=>$request->code_combinations[$key],
                                'sales_order_line'=>0,
                                'inventory_item_id'=>$request->inventory_item_id[$key],
                                'description'=>$request->description[$key],
                                'quantity_ordered'=>$request->quantity_ordered[$key],
                                'quantity_invoiced'=>$request->quantity_ordered[$key],
                                'unit_selling_price'=>$request->unit_selling_price[$key],
                                'sales_order'=>$request->sales_order_number[$key] ?? '',
                                'taxable_amount'=>$tax,
                                'amount_due_original'=>$request->entered_cr[$key],
                                'gross_extended_amount'=>$request->entered_cr[$key],
                                'amount_includes_tax_flag'=>$subtotal,
                                'frt_ed_amount'=>0,
                                'frt_uned_amount'=>$request->entered_cr[$key],
                                'tax_rate'=>$request->pajak,
                                'sales_tax_id'=>$tax_code,
                                'uom_code'=>$request->unit_meas_lookup_code[$key]??'KG',
                                'created_by'=> auth()->user()->id,
                                'creation_date'=>date('Y-m-d H:i:s'),
                                'updated_at'=>date('Y-m-d H:i:s')
                            );
                            // dd($sales_local);
                            ArCustomerTrxLines::create($sales_local);

                            $item = \App\ItemMaster::where('inventory_item_id',$request->inventory_item_id[$key])->first();
                            if ($item->category_code == 'FG_ALL' ||  'FG_LCL'){

                                $amount =$item->item_cost *  $request->quantity_ordered[$key];
                                // Inventory
                                $ar_inv = array(
                                    'customer_trx_line_id'=>isset(DB::table('bm_ra_customer_trx_lines_all')->get()->last()->customer_trx_line_id)? DB::table('bm_ra_customer_trx_lines_all')->get()->last()->customer_trx_line_id+1 :1,
                                    'customer_trx_id'=>$head->customer_trx_id,
                                    'line_number'=>DB::table('bm_ra_customer_trx_lines_all')->get()->last()->line_number+1,
                                    'line_type'=>TRUE,
                                    'org_id'=>$request->organization_id,
                                    'code_combinations'=>$item->category->inventory_account_code,
                                    'description'=>$item->category->inventory->description." - ".$request->item_code[$key],
                                    'gross_extended_amount'=>$amount,
                                    'amount_due_original'=>$amount,
                                    'frt_ed_amount'=>0,
                                    'frt_uned_amount'=>$amount,
                                    'created_by'=>auth()->user()->id,
                                    'creation_date'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s')
                                );
                                ArCustomerTrxLines::create($ar_inv);

                                // COGS
                                $ar_cogs = array(
                                    'customer_trx_line_id'=>isset(DB::table('bm_ra_customer_trx_lines_all')->get()->last()->customer_trx_line_id)? DB::table('bm_ra_customer_trx_lines_all')->get()->last()->customer_trx_line_id+1 :1,
                                    'customer_trx_id'=>$head->customer_trx_id,
                                    'line_number'=>DB::table('bm_ra_customer_trx_lines_all')->get()->last()->line_number+1,
                                    'line_type'=>TRUE,
                                    'org_id'=>$request->organization_id,
                                    'code_combinations'=>$item->category->consumption_account_code,
                                    'description'=>$item->category->cogs->description." - ".$request->item_code[$key],
                                    'gross_extended_amount'=>$amount,
                                    'amount_due_original'=>$amount,
                                    'frt_ed_amount'=>$amount,
                                    'frt_uned_amount'=>0,
                                    'created_by'=>auth()->user()->id,
                                    'creation_date'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s')
                                );
                                ArCustomerTrxLines::create($ar_cogs);
                            }
                        }else{
                            $data = ArCustomerTrxLines::find($request->lineId[$key]);
                            $data->code_combinations = $request->code_combinations[$key] ?? '';
                            $data->gross_extended_amount =($request->entered_dr[$key] > 0 ? $request->entered_dr[$key] : $request->entered_cr[$key]);
                            $data->amount_due_original = ($request->entered_dr[$key] > 0 ? $request->entered_dr[$key] : $request->entered_cr[$key]);
                            $data->frt_ed_amount = $request->entered_dr[$key] ?? '';
                            $data->frt_uned_amount = $request->entered_cr[$key] ?? '';
                            if($data->line_type == false){
                                $data->tax_rate = $request->pajak;
                                $data->sales_tax_id = $tax_code;
                                $data->amount_includes_tax_flag = $subtotal;
                                $data->taxable_amount = $tax;
                            }
                            $data->last_update_login = auth()->user()->id;
                            $data->updated_at = date('Y-m-d H:i:s');
                            $data->save();
                        };
                    }

                    // dd ($request->ar_amount);
                    ArReceivableApplications::where('customer_trx_id',$head->customer_trx_id)->update(['amount_applied'=>$request->ar_amount,'tax_applied'=>$request->tax_amount,'tax_code'=>$tax_code]);

                    \DB::commit();
                    }catch (Throwable $e){
                        \DB::rollback();
                    }

            break;
            case 'status':
                    $cust = ArCustomerTrx::find($id);
                    $cust->update(['status_trx'=>$request->status]);

                    if($request->status == 3){
                        ArCustomerTrx::where('id',$id)->update(['attribute1'=>NULL,'status_trx'=>$request->status]);
                        ArCustomerTrxLines::where('customer_trx_id',$cust->customer_trx_id)->delete();
                        $cust->delete();

                        return redirect()->route('admin.ar.index')->with('success', 'Data Deleted');
                    }else if($request->status==2){
                        // dd($request->calculate_credit);

                        ArReceivableApplications::where('customer_trx_id',$cust->customer_trx_id)->update(['gl_posted_date'=>date('Y-m-d')]);

                        $date = date('M y');
                        $header_id = DB::table('bm_gl_je_headers')->get()->last();
                        $head = GlHeader::findorNew($request->id);
                        $id=$header_id->id+1;
                        $head->je_header_id =$id;
                        $head->name=$cust->bill_template_name.' '.$request->customer_name.' - '.$date;
                        $head->created_by=$request->created_by;
                        $head->last_updated_by=$request->created_by;
                        $head->je_source='Import';
                        $head->status=$request->status;
                        $head->je_batch_id=$request->je_batch_id ;
                        $head->default_effective_date=$request->trx_date;
                        $head->period_name=$date;
                        $head->external_reference=$request->invoice_num;
                        $head->je_category='Sales order';
                        $head->currency_code=$request->invoice_currency_code;
                        $head->currency_conversion_date=$request->exchange_date; //
                        $head->currency_conversion_rate=$request->exchange_rate; //
                        $head->running_total_dr=$request->calculate_debit ;
                        $head->running_total_cr=$request->calculate_credit;
                        try {
                            \DB::beginTransaction();

                            $head->save();

                            foreach($request->code_combinations as $key =>$label){
                                $data = array(
                                    'je_header_id'=>$id,
                                    'je_line_num'=> $key+1,
                                    'last_updated_by'=>auth()->user()->id,
                                    'ledger_id'=>$request->je_batch_id ,
                                    'code_combination_id'=>$request->code_combinations[$key] ?? '',
                                    'period_name'=>$date,
                                    'effective_date'=>$request->trx_date ,
                                    'status'=>$request->status,
                                    'created_by'=>$request->created_by,
                                    'entered_dr'=>$request->entered_dr[$key],
                                    'entered_cr'=>$request->entered_cr [$key],
                                    'description'=>$request->label [$key],
                                    'currency_conversion_date'=>$request->exchange_date, //
                                    'currency_conversion_rate'=>$request->exchange_rate, //
                                    'reference_1'=>$request->customer_name,
                                    'tax_code'=>\App\Tax::where(['tax_rate'=>floatval($request->pajak),'type_tax_use'=>'Sales'])->first()->tax_code,
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s'),
                                );
                                GlLines::create($data);
                            }
                            // dd($data);

                            \DB::commit();
                        }catch (Throwable $e){
                            \DB::rollback();
                        }

                        return redirect()->route('admin.gl.edit',$id)->with('success', 'Data Stored');
                    }

                return back()->with('success','Account Receivale is Updated');

            break;
            case 'payment':
                try {
                    \DB::beginTransaction();

                        $amount_paid = floatval(preg_replace('/[^\d.]/', '', $request->amount_paid));
                        if($amount_paid != $request->amount){
                            $paid_status = 'Partial';
                        }

                        //Status update
                        $arCust = ArCustomerTrx::find($id);
                        $arCust->status_trx = $request->paid_status ;
                        $arCust->payment_attributes = $paid_status ?? 'Full Paid';
                        $arCust->save();

                        $arUpdate = ArReceivableApplications::where('customer_trx_id',$arCust->customer_trx_id)->first();
                        $arUpdate->status = $request->paid_status ;
                        $arUpdate->amount_applied =  $arUpdate->amount_applied;
                        $arUpdate->amount_applied_from =$arUpdate->amount_applied_from + $amount_paid;
                        $arUpdate->application_type = $paid_status ?? 'Full Paid';
                        $arUpdate->attribute_category = $request->attribute_category;
                        $arUpdate->save();

                        $date = date('M y');
                        $invoice_payment_id = DB::table('bm_ap_invoice_payments_id')->get()->last();
                        $invoice_payment_id = ($invoice_payment_id->invoice_payment_id ?? 0)+1;
                        $payment=\App\ApPayment::findorNew($id);
                        
                        $payment->accounting_date = $request->accounting_date;
                        $payment->amount = $amount_paid;
                        $payment->invoice_id = $request->invoice_id;
                        $payment->invoice_payment_id = $invoice_payment_id;
                        $payment->last_updated_by = auth()->user()->id;
                        $payment->payment_num = $request->je_batch_id;
                        $payment->period_name = $date;
                        $payment->posted_flag = 4;
                        $payment->set_of_books_id = \App\Category::where('category_code',$request->attribute_category)->first()->attribute1;
                        $payment->accts_pay_code_combination_id = $request->accts_pay_code_combination_id;
                        $payment->created_by = $request->created_by;
                        $payment->bank_account_num = \App\BankAccount::where('bank_account_id',$request->bank_num)->first()->bank_acct_use_id ; //
                        $payment->bank_account_type = \App\BankAccount::where('bank_account_id',$request->bank_num)->first()->attribute_category; //
                        $payment->bank_num = $request->bank_num; //
                        $payment->payment_base_amount = $request->amount;
                        $payment->invoice_payment_type = $request->invoice_payment_type;
                        $payment->payment_type =  $request->payment_type;
                        $payment->invoicing_vendor_site_id = $request->bill_to_customer_id;
                        $payment->invoice_currency_code = $request->invoice_currency_code;
                        $payment->payment_currency_code = $request->payment_currency_code;
                        $payment->global_attribute1 = $request->global_attribute1;
                        $payment->attribute1 = $request->memo;
                        $payment->attribute_category = $request->attribute_category;
                        $payment->exchange_date=$request->exchange_date;
                        $payment->exchange_rate=$request->exchange_rate;
                        $payment->created_at = date('Y-m-d H:i:s');
                        $payment->updated_at = date('Y-m-d H:i:s');
                        $payment->save();

                        //GL Create
                        $header_id = DB::table('bm_gl_je_headers')->get()->last();
                        $id=$header_id->je_header_id+1;
                        $head = GlHeader::findorNew($request->id);
                        $head->je_header_id =$id;
                        $head->name=$request->customer_name.' Payment Rp.'.$amount_paid; //
                        $head->created_by=$request->created_by;
                        $head->last_updated_by=$request->created_by;
                        $head->je_source='Import'; //
                        $head->status=$request->paid_status;
                        $head->je_batch_id=$request->je_batch_id ;
                        $head->default_effective_date=$request->accounting_date;
                        $head->period_name=$date;
                        $head->external_reference=$request->invoice_id;
                        $head->je_category='Bank';
                        $head->currency_code=$request->payment_currency_code;
                        $head->running_total_dr=$amount_paid;
                        $head->running_total_cr=$amount_paid;
                        $head->currency_conversion_date=$request->exchange_date;
                        $head->currency_conversion_rate=$request->exchange_rate;
                        $head->save();

                        foreach($request->payment as $key =>$label){
                            if($request->payment[$key] == 11020000){
                                $entered_dr= $amount_paid;
                                $entered_cr= 0;
                                $label = 'Outstanding Payment';
                            }else{
                                $entered_dr= 0;
                                $entered_cr= $amount_paid;
                                $label = 'Trade AR';
                            }
                            $data = array(
                                'je_header_id'=>$id,
                                'je_line_num'=> $key+1,
                                'last_updated_by'=>auth()->user()->id,
                                'ledger_id'=>$request->je_batch_id ,
                                'code_combination_id'=>$request->payment[$key] ?? '', //
                                'period_name'=>$date,
                                'effective_date'=>$request->accounting_date ,
                                'status'=>$request->paid_status,
                                'created_by'=>$request->created_by,
                                'entered_dr'=>$entered_dr,
                                'entered_cr'=>$entered_cr,
                                'description'=>$label,
                                'reference_1'=>$request->customer_name,
                                'currency_conversion_date'=>$request->exchange_date,
                                'currency_conversion_rate'=>$request->exchange_rate,
                                'tax_code'=>\App\Tax::where(['tax_rate'=>floatval($request->pajak),'type_tax_use'=>'Sales'])->first()->tax_code, //
                                'currency_code'=>$request->payment_currency_code, //
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

            break;
        }
        return back()->with('success','Account Receivale is Updated');
    }
}

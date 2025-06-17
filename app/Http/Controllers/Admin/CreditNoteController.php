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

class CreditNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cust = ArCustomerTrx::where('bill_template_name','Credit Note')->get();
        return view('admin.creditNote.index',compact('cust'));
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
        $customer = Customer::All();
        $site = Site::where('site_type','=','Shipto')->get();
        $tax =\App\Tax::where(['type_tax_use'=>'Sales', 'tax_code'=>'TAX-11'])->first();
        return view('admin.creditNote.create',compact('customer','terms','currency','site','tax'));
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
                        $id_cust_head = DB::table('bm_ra_customer_trx_all')->get()->last();
                        $id_cust_head = ($id_cust_head->customer_trx_id ?? 0)+1;
                        $trx_number = 'INV'.str_pad($id_cust_head,8,"0",STR_PAD_LEFT);

                        $cust = ArCustomerTrx::where('customer_trx_id',$request->ar_id)->first();

                        $cust_head = array(
                            'customer_trx_id'=>$id_cust_head,
                            'trx_number'=>$trx_number,
                            'bill_template_name'=>'Credit Note',
                            'trx_date'=>$cust->trx_date,
                            'bill_to_customer_id'=>$cust->bill_to_customer_id,
                            'ship_to_customer_id'=>$cust->ship_to_customer_id,
                            'term_id'=>$cust->term_id,
                            'delivery_method_code'=>$cust->delivery_method_code,
                            'invoice_currency_code'=>$cust->invoice_currency_code,
                            'attribute1' => $cust->attribute1,
                            'attribute2' => $cust->attribute2,
                            'created_by'=> auth()->user()->id,
                            'org_id'=>$cust->org_id,
                            'exchange_date'=>$cust->exchange_date,
                            'exchange_rate'=>$cust->exchange_rate,
                            'status_trx'=>0,
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s'),
                        );
                        ArCustomerTrx::create($cust_head);
                        // dd($cust_head);

                        $id_ar_head =  DB::table('bm_ar_receivable_applications_all')->get()->last();
                        $head = ArReceivableApplications::where('customer_trx_id',$request->ar_id)->first();
                        $ar_head = array(
                            'receivable_application_id'=>$id_ar_head->receivable_application_id+1,
                            'amount_applied'=>$head->amount_applied,
                            'gl_date'=>$head->gl_date,
                            'attribute1'=>$head->attribute1,
                            'application_rule'=>'Credit Note',
                            'customer_trx_id'=>$id_cust_head,
                            'freight_applied'=>$head->freight_applied,
                            'status'=>$head->status,
                            'tax_code'=>$head->tax_code,
                            'tax_applied'=>$head->tax_applied,
                            'created_by'=>auth()->user()->id,
                            'org_id'=>$head->org_id,
                            'creation_date'=>date('Y-m-d H:i:s'),
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s'),
                        );
                        ArReceivableApplications::create($ar_head);

                        $id_cust_line = DB::table('bm_ra_customer_trx_lines_all')->get()->last();
                        $id_cust_line = ($id_cust_line->customer_trx_line_id ?? 0)+1;

                        $ar_data = ArCustomerTrxLines::where('customer_trx_id',$request->ar_id)->get();

                        $amount = 0;
                        $tax_amount =0;
                        $total_amount =0;
                        $line_number = 1;

                        foreach ($ar_data as $key => $ar_data){
                            if($ar_data->line_type == 0){
                                $subtotal = ($ar_data->quantity_invoiced ?? 0) * ($ar_data->unit_selling_price ?? 0);
                                $tax = $ar_data->tax * $subtotal;
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
                                'line_type'=>$ar_data->line_type,
                                'code_combinations'=>$ar_data->code_combinations,
                                'description'=>$ar_data->description,
                                'sales_order_line'=>$ar_data->sales_order_line ?? 0,
                                'inventory_item_id'=>$ar_data->inventory_item_id ?? null,
                                'quantity_ordered'=>$ar_data->quantity_ordered ?? null,
                                'quantity_invoiced'=>$ar_data->quantity_invoiced ?? null,
                                'unit_selling_price'=>$ar_data->unit_selling_price ?? null,
                                'sales_order'=>$ar_data->sales_order ?? 0,
                                'taxable_amount'=>$ar_data->taxable_amount ?? null,
                                'amount_due_original'=>$ar_data->amount_due_original ?? null,
                                'gross_extended_amount'=>$ar_data->gross_extended_amount ?? null,
                                'amount_includes_tax_flag'=>$ar_data->amount_includes_tax_flag ?? null,
                                'frt_ed_amount'=>$ar_data->frt_uned_amount ?? 0,
                                'frt_uned_amount'=>$ar_data->frt_ed_amount ?? 0,
                                'tax_rate'=>$ar_data->tax_rate ?? null,
                                'sales_tax_id'=>$ar_data->sales_tax_id  ?? null,
                                'uom_code'=>$ar_data->uom_code ?? null,
                                'org_id'=>$ar_data->org_id,
                                'created_by'=>$ar_data->created_by,
                                'creation_date'=>date('Y-m-d H:i:s'),
                                'updated_at'=>date('Y-m-d H:i:s')
                            );
                            ArCustomerTrxLines::create($cust_line);
                            $line_number++;
                        }


                        $id = DB::table('bm_ra_customer_trx_all')->get()->last();
                        $id = $id->id;
                    \DB::commit();
                }catch (Throwable $e){
                    \DB::rollback();
                }

                return redirect()->route('admin.credit-note.edit',$id)->with('success', 'Data Stored');
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
        //
        $cust = ArCustomerTrx::find($id);
        $line = ArCustomerTrxLines::where('customer_trx_id',$cust->customer_trx_id)->get();
        $data = ArCustomerTrxLines::where('customer_trx_id',$cust->customer_trx_id)->first();

        $ar = ArReceivableApplications::where('customer_trx_id',$cust->customer_trx_id)->first();
        // dd($ar);
        $terms = Terms::where('term_category','PAYMENT')->get();
        $currency = CurrencyGlobal::where('currency_status', 1)->get();
        $payment = \App\ApPayment::where('invoice_id','=',$id)->first();
        $ba = \App\BankAccount::all();
        $journal = \App\Category::orderBy('id','desc')->where('account_type','Bank & Cash')->get();
        $acc = \App\AccountCode::all();
        return view('admin.creditNote.edit',compact('cust','terms','currency','line','data','ba','journal','payment','ar','acc'));
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

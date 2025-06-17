<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DeliveryDetail;
use App\DeliveryHeader;
use App\SalesOrder;
use App\SalesOrderDetail;
use App\Customer;
use App\MaterialTransaction;
use App\AccountCode;
use App\GlHeader;
use App\GlLines;
use App\Faktur;
use App\Terms;
use DB;
use Carbon\Carbon;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class InvoicesController extends Controller
{
    //
    public function index()
    {
        abort_if(Gate::denies('sales_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cust = \App\Customer::get();
        return view('admin.invoices.index',compact('cust'));
    }
    public function create()
    {
        $header_id = request()->get('header_id');
        $so = SalesOrder::where('header_id','=',$header_id)->get();
        $sales = SalesOrder::where('header_id','=',$header_id)->first();
        $paymentmethode = SalesOrder::where('order_number','=',$sales->order_number)->get();
        // dd($sales->attribute3);
        $terms = Terms::where('term_category','PAYMENT')->get();

        $so_detil = SalesOrderDetail::where('header_id','=',$header_id)->get();
        $customer = Customer::get();
        $tax = \App\Tax::where('type_tax_use','Sales')->get();
        $faktur = Faktur::get();
        $trx = MaterialTransaction::whereIn('trx_code', [4])->select('trx_code','trx_source_types')->get();
        $ppn= AccountCode::where('account_code','3202')->first();
// dd($ppn);
        return view('admin.invoices.create',compact('terms','faktur','so','so_detil','customer','sales','trx','ppn','tax'));

    }
    public function store(Request $request)
    {
        // dd('masuk');
        // dd($request->term);
        if($request->total_dr!=$request->total_cr){
            return back()->with('error','Sorry value is not balance');
        }
        // $if($request->){

        // }
        $termMaster = Terms::where('id',$request->term)->get()->first();
        
        if($termMaster->term_code==0){
            $soupdate = SalesOrder::where('order_number', '=', $request->so_number)->update(['inv_number' => $request->noinv,'faktur'=>$request->faktur,'updated_at'=>date('Y-m-d H:i:s')]);
        }
        $dueDate = Carbon::now()->addDays($termMaster->term_code)->format('Y-m-d H:i:s');
        // dd($dueDate);
        $soupdate = SalesOrder::where('order_number', '=', $request->so_number)->update(['inv_number' => $request->noinv,'faktur'=>$request->faktur,'updated_at'=>date('Y-m-d H:i:s'),'payment_due_date'=>$dueDate]);
        
        $fakturdelete = Faktur::where('faktur_code', '=', $request->faktur)
        ->update(['deleted_at' => date('Y-m-d H:i:s')]);
        // dd($soupdate);
        $header_id = DB::table('bm_gl_je_headers')->get()->last();
        $head = GlHeader::findorNew($request->id);
        $id=$header_id->id+1;
        $head->je_source=$request->je_category.''.$request->noinv ;
        $head->default_effective_date=Carbon::parse($request->tgl_invoice)->format('Y-m-d');
        $head->period_name=Carbon::parse($request->tgl_invoice)->format('M y');
        $head->external_reference=$request->noinv;
        $head->je_category=$request->je_category;
        $head->currency_code=$request->customer_currency;
        $head->je_header_id =$id;
        $head->name=$request->je_category.' - '.$request->bill_to;
        $head->created_by=auth()->user()->id;
        $head->last_updated_by=auth()->user()->id;
        $head->status=$request->status;
        $head->je_batch_id=$request->je_batch_id;
        $head->running_total_dr=$request->running_total_dr;
        $head->running_total_cr=$request->running_total_cr;

// dd($id);
        try {
			\DB::beginTransaction();
            // dd($request->all());

		    $head->save();
            foreach($request->code_combinations as $key =>$code_combinations){
                $data = array(
                    'je_header_id'=>$id,
                    'je_line_num'=> $key+1,
                    'last_updated_by'=>(int) auth()->user()->id,
                    'ledger_id'=>$request->je_batch_id ?? '',
                    'code_combination_id'=>$request->accDes[$key],
                    'period_name'=>Carbon::parse($request->tgl_invoice)->format('M y'),
                    'effective_date'=>Carbon::parse($request->tgl_invoice)->format('Y-m-d'),
                    'status'=>(int)$request->status,
                    'created_by'=>(int)auth()->user()->id,
                    'entered_dr'=>(int) str_replace(',', '', $request->dr[$key]),
                    'entered_cr'=>(int) str_replace(',', '', $request->cr[$key]),
                    'description'=>$request->desc [$key],
                    'reference_1'=>$request->bill_to,
                    'tax_code'=>(int)$request->tax,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                );
                // dd($data);
            GlLines::create($data);
          }
           \DB::commit();
        }catch (Throwable $e){
            \DB::rollback();
		}
        return view('admin.glmanual.index')->with('success', 'Data Stored');
    

    }
    public function edit()
    {
        return view('admin.invoices.edit');

    }
    public function show($header_id)
    {
        // dd($header_id);
        // $header_id = request()->get('header_id');
        $so = SalesOrder::where('header_id','=',$header_id)->get();
        $sales = SalesOrder::where('header_id','=',$header_id)->first();
        $so_detil = SalesOrderDetail::where('header_id','=',$header_id)->get();
        $customer = Customer::get();
        $tax = \App\Tax::where('type_tax_use','Sales')->get();
        $trx = MaterialTransaction::whereIn('trx_code', [4])->select('trx_code','trx_source_types')->get();
        $ppn= AccountCode::where('account_code','21050800')->first();
        $user=Auth::user()->name;
        // dd($so);
// dd($ppn);
        return view('admin.invoices.show',compact('user','so','so_detil','customer','sales','trx','ppn','tax'));

    }

    public function update()
    {
        return view('admin.invoices.index');

    }
    public function printInvoice($header_id)
    {
        // Ambil data Sales Order berdasarkan header_id
        $sales = SalesOrder::where('header_id', $header_id)->first();

        if (!$sales) {
            return abort(404, 'Sales Order tidak ditemukan');
        }

        // Load view invoice dan kirim data
        $pdf = PDF::loadView('admin.invoices.pdf', compact('sales'));

        // Set nama file saat diunduh
        $fileName = "Invoice_{$sales->order_number}.pdf";

        // Tampilkan atau download PDF
        return $pdf->stream($fileName);
    }
}

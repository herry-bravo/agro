<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Grn;
use App\User;
use App\PurchaseOrderDet;
use App\SalesOrder;
use App\RcvHeader;
use App\RcvDetail;
use App\Onhand;
use App\MaterialTxns;
use App\MaterialTransaction;
use App\Customer;
use App\SalesOrderDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreRcvRequest;
use Illuminate\Support\Facades\Auth;

class ReceivesCustomerController extends Controller
{
    public function index()
    {
    }
    public function create(){
        Grn::create();
		$grn = Grn::latest('id')->first();
		$users = User::all();
		$orders = PurchaseOrderDet::where('line_status','=',2)->get();
		$sales_order = SalesOrder::where('order_number', 'like','6%')->get();
		$sales_orderdetil = SalesOrderDetail::get();
        // dd($sales_orderdetil);
        $customer = Customer::all();
        return view('admin.rcvcustomer.create',compact('sales_orderdetil','users','orders','sales_order','grn','customer'));
    }
    public function store(StoreRcvRequest $request)
    {
        if($request->line_number==null){
            return back()->with('error','Please select row');
        };
        $id = RcvHeader::latest('id')->first();
        $head =RcvHeader::findorNew($request->id);
        $head->shipment_header_id=str_pad($id->id+1, 6, "0", STR_PAD_LEFT);
        try {
            \DB::beginTransaction();
                $checked_array=$request->line_number;
                $line_id=1;
                foreach ($request->checkid as $key => $value){

                    if(in_array($request->checkid[$key],$checked_array)){
                        $header_id = $request->header_id[$key];
                        $data = array(
                            'po_header_id'=>isset($request->header_id[$key])? $request->header_id[$key] :'',
                            'attribute1'=>isset($request->unit_selling_price[$key])? $request->unit_selling_price[$key] :'',
                            'quantity_received'=>abs($request->ordered_quantity[$key]),
                            'uom_code'=>isset($request->order_quantity_uom[$key])? $request->order_quantity_uom[$key] :'',
                            'item_description'=>isset($request->user_description_item[$key])? $request->user_description_item[$key] :'',
                            'item_id'=>isset($request->inventory_item_id[$key])? $request->inventory_item_id[$key] :'',
                            'shipment_header_id'=> $head->shipment_header_id,
                            'shipment_line_id'=>isset($request->line_id[$key])? $request->line_id[$key] :'',
                            'to_subinventory'=>isset($request->shipping_inventory[$key])? $request->shipping_inventory[$key] :'',
                            'line_num'=>isset($request->line_number[$key])? $request->line_number[$key] :'',
                            'created_at'=> date('Y-m-d H:i:s'),
                            'updated_at'=> date('Y-m-d H:i:s'),
                        );
                        RcvDetail::create($data);
                        SalesOrderDetail::where('id',$request->checkid[$key])->update(["flow_status_code" => 12]);
                            /* Onhand Transaction*/
                        $onhand=Onhand::where(['inventory_item_id'=>$request->inventory_item_id[$key],'subinventory_code'=>$request->shipping_inventory[$key]])->first();
                        if(!$onhand){
                            $stock = array(
                                'inventory_item_id'=>$request->inventory_item_id[$key],
                                'subinventory_code'=>$request->shipping_inventory[$key],
                                'primary_transaction_quantity'=>$request->ordered_quantity[$key],
                                'transaction_uom_code'=>$request->order_quantity_uom[$key],
                                'created_by'=>$request->created_by,
                                'created_at'=> date('Y-m-d H:i:s'),
                                'updated_at'=> date('Y-m-d H:i:s'),
                            );
                            Onhand::create($stock);
                        }else{
                            $update_stock=$onhand->primary_transaction_quantity+abs($request->ordered_quantity[$key]);
                            $onhand=Onhand::where(['inventory_item_id'=>$request->inventory_item_id[$key],'subinventory_code'=>$request->shipping_inventory[$key]])->update(["primary_transaction_quantity"=>$update_stock]);
                        }
                        $trx = array(
                            'transaction_id'=>MaterialTxns::all()->count()+1,
                            'last_updated_by'=>$request->updated_by,
                            'created_by'=>$request->created_by,
                            'inventory_item_id'=>$request->inventory_item_id[$key],
                            'organization_id'=>'222',
                            'subinventory_code'=>$request->shipping_inventory[$key],
                            'transaction_type_id'=>25,
                            'transaction_action_id'=>25,
                            'transaction_source_type_id'=>25,
                            'transaction_source_name'=>MaterialTransaction::where('trx_code',25)->first()->trx_types,
                            'transaction_quantity'=>$data['quantity_received'],
                            'transaction_uom'=>$data['uom_code'],
                            'primary_quantity'=>$data['quantity_received'],
                            'transaction_date'=>date('Y-m-d H:i:s'),
                            'currency_code'=>$request->attribute1,
                            'source_line_id'=>$data['shipment_line_id'],
                            'attribute_category'=>$request->grn,
                        );
                        MaterialTxns::	create($trx);
                    }
                    $line_id++;
                }
            \DB::commit();
        }catch (Throwable $e){
            \DB::rollback();
        }
		$head->vendor_id=DB::table('bm_order_headers_all')->join('bm_cust_site_uses_all','bm_cust_site_uses_all.id','=','bm_order_headers_all.invoice_to_org_id')->where('header_id',$header_id)->first()->id;
		$head->organization_id=DB::table('bm_order_headers_all')->where('header_id',$header_id)->first()->org_id;
		$head->receipt_num=$request->grn;
	    $head->currency_code=DB::table('bm_order_headers_all')->join('bm_currencies_id_all','bm_currencies_id_all.id','=','bm_order_headers_all.attribute1')->where('header_id',$header_id)->first()->currency_code;
        $head->conversion_date=date('Y-m-d H:i:s');
		$head->ship_to_location_id=DB::table('bm_order_headers_all')->where('header_id',$header_id)->first()->deliver_to_org_id;
		$head->freight_terms=DB::table('bm_order_headers_all')->where('header_id',$header_id)->first()->freight_terms_code;
		$head->transaction_type="RETURN";
		$head->attribute1=DB::table('bm_order_headers_all')->where('header_id',$header_id)->first()->attribute1;
		$head->created_by=DB::table('bm_order_headers_all')->where('header_id',$header_id)->first()->created_by;
		$head->last_updated_by=Auth::user()->id;
		$head->gl_date=date('Y-m-d H:i:s');
		$head->created_at=date('Y-m-d H:i:s');
		$head->updated_at=date('Y-m-d H:i:s');
        // dd($head);
        $head->save();
        return redirect()->route('admin.rcv.index');
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

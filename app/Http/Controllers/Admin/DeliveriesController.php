<?php

namespace App\Http\Controllers\Admin;
use App\DeliveryDetail;
use App\DeliveryHeader;
use App\SalesOrderDetail;
use App\SalesOrder;
use App\Customer;
use App\CurrencyGlobal;
use App\Http\Requests\MassDestroyDeliveryRequest;
use App\Site;
use App\Onhand;
use App\Terms;
use App\MaterialTxns;
use App\MaterialTransaction;
use App\DeliveryDistrib;
use App\Subinventories;
use App\TrxStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use db;
use Gate;
use Symfony\Component\HttpFoundation\Response;


class DeliveriesController extends Controller
{
    public function index(){

        $deliveryHeader = DeliveryHeader::select(\DB::raw('bm_wsh_new_deliveries.lvl,bm_wsh_new_deliveries.ship_to_party_id,bm_wsh_new_deliveries.delivery_id,bm_wsh_new_deliveries.sold_to_party_id,bm_wsh_new_deliveries.packing_slip_number,bm_wsh_new_deliveries.attribute2,bm_wsh_new_deliveries.currency_code,bm_wsh_new_deliveries.on_or_about_date, SUM(bm_wsh_delivery_details.requested_quantity) as req_qty'))
         ->leftJoin('bm_wsh_delivery_details', 'bm_wsh_delivery_details.delivery_detail_id', '=', 'bm_wsh_new_deliveries.delivery_id')
         ->groupBy('bm_wsh_new_deliveries.lvl','bm_wsh_new_deliveries.ship_to_party_id','bm_wsh_new_deliveries.sold_to_party_id','bm_wsh_new_deliveries.delivery_id','bm_wsh_new_deliveries.packing_slip_number','bm_wsh_new_deliveries.attribute2','bm_wsh_new_deliveries.currency_code','bm_wsh_new_deliveries.on_or_about_date')
         ->orderBy('bm_wsh_new_deliveries.delivery_id','DESC')
         ->get();

        return view('admin.deliveries.index',compact('deliveryHeader'))->with('no',1);
    }
    public function create(Request $request){
        abort_if(Gate::denies('delivery_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $DeliveryHeader=DeliveryHeader::select('bm_wsh_new_deliveries.*','bm_trx_statuses.trx_name')
        ->leftJoin('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_wsh_new_deliveries.status_code')
        ->where('delivery_id',$request->delivery_form)
        ->Orwhere('delivery_name',$request->delivery_form)
        ->whereNotNull('bm_wsh_new_deliveries.packing_slip_number')
        ->first();
        // dd($DeliveryHeader->delivery_id);
        if($DeliveryHeader==null){
            return back()->with('error', 'Data Not Found' );
        }
        $DeliveryDetail=DeliveryDetail::select(['bm_wsh_delivery_details.*','bm_mtl_system_item.item_code','bm_trx_statuses.trx_name',
        \DB::raw('(SELECT sum(attribute_number1) FROM bm_wsh_delivery_distb_items where bm_wsh_delivery_distb_items.line_id = bm_wsh_delivery_details.id) as roll_qty')])
        ->leftJoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_wsh_delivery_details.inventory_item_id')
        ->leftJoin('bm_wsh_new_deliveries','bm_wsh_new_deliveries.delivery_id','=','bm_wsh_delivery_details.delivery_detail_id')
        ->leftJoin('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_wsh_new_deliveries.status_code')
        ->where ('bm_wsh_delivery_details.delivery_detail_id','=',$request->delivery_form)
        ->Orwhere ('bm_wsh_new_deliveries.delivery_name','=',$request->delivery_form)
        ->orderBy('bm_wsh_delivery_details.created_at','DESC')
        ->get();

        $deliverydisturb=DeliveryDistrib::where('header_id',$DeliveryHeader->delivery_id)
        ->get();
        // dd($deliverydisturb);
        $customers=Customer::all();
        $global = CurrencyGlobal::where('currency_status', 1)->get();
        $customershiipto=Site::all();
        $freight_terms=Terms::all();
        $Subinventories=Subinventories::all();

        return view('admin.deliveries.create', compact('DeliveryHeader','DeliveryDetail','customers','global','customershiipto','freight_terms','Subinventories','deliverydisturb'))->with('no', 1);
    }
    public function store(Request $request){
        $xhead =DeliveryDetail::where('delivery_id','=',$request->delivery_id);
    }


    public function show($delivery_id){
        abort_if(Gate::denies('delivery_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $DeliveryHeader=DeliveryHeader::select('bm_wsh_new_deliveries.*','users.name')
        ->join('users','users.id','=','bm_wsh_new_deliveries.created_by')
        ->where('bm_wsh_new_deliveries.delivery_id',$delivery_id)->first();
        $DeliveryDetail=DeliveryDetail::where ('bm_wsh_delivery_details.delivery_detail_id','=',$delivery_id)
        ->get();

        return view('admin.deliveries.show', compact('DeliveryHeader','DeliveryDetail'))->with('no', 1);
    }

    public function edit($id, Request $request){
        abort_if(Gate::denies('delivery_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deliveryId = DeliveryHeader::where('delivery_id',$id)->get()->first();
        $DeliveryHeader=DeliveryHeader::select('bm_wsh_new_deliveries.*','bm_trx_statuses.trx_name','bm_currencies_id_all.currency_code','bm_currencies_id_all.currency_name',
        'bm_cust_site_uses_all.cust_party_code','bm_cust_site_uses_all.party_name')
        ->leftJoin('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_wsh_new_deliveries.status_code')
        ->leftJoin('bm_cust_site_uses_all','bm_cust_site_uses_all.cust_party_code','=','bm_wsh_new_deliveries.sold_to_party_id')
        ->leftJoin('bm_currencies_id_all','bm_currencies_id_all.currency_code','=','bm_wsh_new_deliveries.currency_code')
        ->where('bm_wsh_new_deliveries.delivery_id',$id)->get()->first();

        $DeliveryDetail = DeliveryDetail::select('bm_wsh_delivery_details.*','bm_mtl_system_item.item_code')
        ->join('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_wsh_delivery_details.inventory_item_id')
        ->orderBy('bm_wsh_delivery_details.created_at','ASC')
        ->get();

        $roll = DeliveryDistrib::where([['line_id',$request->get('id')]])->select(\DB::raw('count(container_item_id) as roll, sum(attribute_number1) as qty'))->first();
        $customers=Customer::all();
        $global = CurrencyGlobal::where('currency_status', 1)->get();
        $customershiipto=Site::all();
        $freight_terms=Terms::all();

        if($DeliveryHeader==null){
            return back()->with('error', 'Data Not Found' );
        }
        return view('admin.deliveries.edit',compact('DeliveryHeader','DeliveryDetail','customers','global','customershiipto','freight_terms'))->with('no',1);
    }

    public function update(Request $request, DeliveryHeader $DeliveryHeader, DeliveryDetail $DeliveryDetail){
        // dd('tes return');
        
        switch ($request->input('action')) {
            case 'return':
                $id = $request->delivery_id;
                $dlvr = DeliveryHeader::where('id', $id)->first();
                // $dlvr->update(['status_code' => 15]);
                
                $dlvrdetail = DeliveryDetail::where('delivery_detail_id', $dlvr->delivery_id)->get();
                dd($dlvr);
                try {
                    \DB::beginTransaction();
                    $details = [];
                    $id = is_array($id) ? $id : [$id];
                    foreach ($dlvrdetail as $key => $value) {
                        // Debugging awal untuk memastikan nilai tidak null
                        dump("Processing Inventory Item ID: " . $value->inventory_item_id);
                        
                        $onhandupdate = Onhand::where('inventory_item_id', $value->inventory_item_id)
                            ->where('subinventory_code', $value->subinventory)
                            ->first();
                    
                        // Pastikan data ditemukan sebelum mengakses propertinya
                        if ($onhandupdate) {
                            // Pastikan key `$key` ada dalam `$request->requested_quantity`
                            if (isset($request->requested_quantity[$key])) {
                                // Update primary_transaction_quantity
                                $onhandupdate->primary_transaction_quantity += $request->requested_quantity[$key];
                                $onhandupdate->save();
                    
                                dump("Updated Onhand ID: " . $onhandupdate->id . " | New Qty: " . $onhandupdate->primary_transaction_quantity);
                            } else {
                                dump("Warning: requested_quantity[$key] tidak ditemukan!");
                            }
                        } else {
                            dump("Warning: Onhand data tidak ditemukan untuk Inventory Item ID: " . $value->inventory_item_id);
                        }
                    }
                    
                    // Debugging akhir untuk memastikan proses berjalan
                    dd("Update selesai!");
                    
                    $check_status=SalesOrderDetail::where([['header_id',$dlvrdetail->header],['flow_status_code','!=',12]])->count('id');
                    if($check_status == 0){
                        SalesOrder::where('order_number',$dlvrdetail->source_header_number)->update(['open_flag'=>12]);
                    }
                    \DB::commit();
                }catch (Throwable $e) {
                    \DB::rollback();
                }
                DeliveryHeader::where('id',$request->id)->update([
                    'accepted_by'=>Auth::user()->id,
                    'accepted_date'=>date('Y-m-d H:i:s'),
                    'status_code'=>12,
                    'acceptance_flag'=>1,
                    'lvl'=>12,
                ]);
                return redirect()->route('admin.deliveries.index')->with('success', 'Fullfillment Successed');
            
            break;
            case 'pick':
                dd('masuk pice');
                $xhead =DeliveryHeader::where('delivery_id','=',$request->delivery_id)
                ->where('delivery_id','=',$request->delivery_id)->first();
                $alert=$request->customer;
                    $xhead->lvl=7;
                    $xhead->status_code=7;
                if($request->inventory_item_id==null){
                    return back()->with('error','Please add your shipping item');
                }
                try {
                \DB::beginTransaction();
                    foreach ($request->inventory_item_id as $key => $value){
                        $update = SalesOrderDetail::where('header_id',$request->source_header_id[$key])
                            ->where('split_line_id',$request->source_line_id[$key])
                            ->update([
                            "flow_status_code"=>7,
                        ]);
                        $data = array(
                            'inventory_item_id'=>isset($request->inventory_item_id[$key])? $request->inventory_item_id[$key] :'',
                            'subinventory'=>isset($request->subinventory[$key])? $request->subinventory[$key] :'',
                            'requested_quantity'=>isset($request->roll_qty[$key])? $request->requested_quantity[$key] :'',
                            'requested_quantity_uom'=>isset($request->requested_quantity_uom[$key])? $request->requested_quantity_uom[$key] :'',
                            'source_line_id'=>isset($request->source_line_id[$key])? $request->source_line_id[$key] :'',
                            'attribute1'=>isset($request->attribute1[$key])? $request->attribute1[$key] :'',
                        );
                        dd($data);
                        $req = $data['requested_quantity'];
                        $intreq = (int)$req;

                        $onhand=Onhand::where(['inventory_item_id'=>$data['inventory_item_id'],'subinventory_code'=>$data['subinventory']])
                        ->first();
                        if($onhand){
                            if((float)$onhand->primary_transaction_quantity >= $data['requested_quantity']){
                                $hasil_stock=(float)$onhand->primary_transaction_quantity-$data['requested_quantity'];
                                $onhand=Onhand::where(['inventory_item_id'=>$data['inventory_item_id'],'subinventory_code'=>$data['subinventory']])
                                ->update(["primary_transaction_quantity"=>$hasil_stock]);
                            }else{
                                return back()->with('error', 'Stock Not Enough');
                            }
                        }
                        else{
                            return back()->with('error', 'Not Exist');
                        }
                        $onhandtwo=Onhand::where(['inventory_item_id'=>$data['inventory_item_id'],'subinventory_code'=>'9STG'])
                        ->first();

                        if(!$onhandtwo){
                            $onheng = array(
                                'inventory_item_id'=>$data['inventory_item_id'],
                                'created_by'=>Auth::user()->id,
                                'primary_transaction_quantity'=>$data['requested_quantity'],
                                'subinventory_code'=>'9STG',
                                'transaction_uom_code'=>$data['requested_quantity_uom'],
                                'created_at'=>date('Y-m-d H:i:s'),
                                'updated_at'=>date('Y-m-d H:i:s')
                            );
                            Onhand::create($onheng);
                        }else{
                            $update=(float)$onhandtwo->primary_transaction_quantity+$data['requested_quantity'];
                            $onhandtwo=Onhand::where(['inventory_item_id'=>$data['inventory_item_id'],'subinventory_code'=>'9STG'])->update(["primary_transaction_quantity"=>$update]);
                        }
                        $stg = array(
                            'transaction_id'=>MaterialTxns::all()->count()+1,
                            'last_updated_by'=>Auth::user()->id,
                            'created_by'=>$request->created_by,
                            'inventory_item_id'=>$data['inventory_item_id'],
                            'organization_id'=>'222',
                            'subinventory_code'=>$data['subinventory'],
                            'transaction_type_id'=>38,
                            'transaction_action_id'=>38,
                            'transaction_source_type_id'=>38,
                            'transaction_source_name'=>MaterialTransaction::where('trx_code',38)->first()->trx_types,
                            'attribute1'=>$data['attribute1'],
                            'transaction_quantity'=>$data['requested_quantity'],
                            'primary_quantity'=>$data['requested_quantity'],
                            'transaction_uom'=>$data['requested_quantity_uom'],
                            'transaction_date'=>date('Y-m-d H:i:s'),
                            'currency_code'=>CurrencyGlobal::where('id',$request->currency_code)->first()->currency_code,
                            'transaction_source_id'=>$request->delivery_id,
                            'transaction_reference'=>$request->packing_slip_number,
                            'source_line_id'=>$data['source_line_id'],
                            'transfer_subinventory'=>'9STG',
                        );
                        MaterialTxns::create($stg);
                        $xhead->save();
                    }
                    \DB::commit();
                }catch (Throwable $e){
                    \DB::rollback();
                }
                return back()->with('success', 'Stock is picked release');
            break;
            case 'shipconfirmanddelete':
                // dd($request['radio']);

                if ($request->actualdate==null){
                    return back()->with('error','Please insert actual date');
                }
                // CONFIRM
                if($request['radio']=='confirm'){
                    try {
                    \DB::beginTransaction();
                    $xhead =DeliveryHeader::where('delivery_id','=',$request->delivery_id)->first();
                    $xhead->lvl=8;
                    $xhead->status_code=8;
                    $xhead->actual_ship_date=$request->actualdate;
                    $xdetil = DeliveryDetail::where('delivery_detail_id',$request->delivery_id)->first();
                    foreach ($request->inventory_item_id as $key => $value){
                        $qty=$request->roll_qty[$key];
                        $data = array(
                            'inventory_item_id'=>$request->inventory_item_id[$key],
                            'subinventory'=>$request->subinventory[$key],
                            'requested_quantity'=>$request->requested_quantity[$key],
                            'requested_quantity_uom'=>$request->requested_quantity_uom[$key],
                            'source_line_id'=>$request->source_line_id[$key],
                            'attribute1'=>$request->attribute1[$key],
                        );
                        // $result diganti looping data roll sesuai yang di scan
                        // dd($data);
                        // $result =DeliveryDistrib::where([['line_id',$request->id[$key]]])->select('line_id','load_item_id',DB::raw("(sum(attribute_number1)) as req_qty"))
                        // ->groupBy('load_item_id','line_id')
                        // ->get()->first();

                        // if (!$result){
                        //     return back()->with('error',"Data doesnt exist ");
                        // }else{
                        //     $onhand=Onhand::where(['inventory_item_id'=>$result['load_item_id'],'subinventory_code'=>$data['subinventory']])
                        //     ->first();
                        //     if($onhand){
                        //         if((float)$onhand->primary_transaction_quantity >= $data['requested_quantity']){
                        //             $hasil_stock=(float)$onhand->primary_transaction_quantity-$data['requested_quantity'];
                        //             $onhand=Onhand::where(['inventory_item_id'=>$result['load_item_id'],'subinventory_code'=>'9000'])
                        //             ->update(["primary_transaction_quantity"=>$hasil_stock]);
                        //         }else{
                        //             return back()->with('error', 'Stock Not Enough');
                        //         }
                        //     }else{
                        //         return back()->with('error', 'Stock Not Exist');
                        //     }
                        // }
                        $onhandupdate = Onhand::where('inventory_item_id', $data['inventory_item_id'])
                        ->where('subinventory_code', $data['subinventory'])->first();
                        // dd($onhandupdate->primary_transaction_quantity);
                        // dd($data['requested_quantity']);
                        if($onhandupdate->primary_transaction_quantity<$data['requested_quantity']){
                            return back()->with('error', 'Stock Not Enough for ' . $onhandupdate->itemmaster->item_brand);
                        }
                        
                        // dd($condition);
                        // $condition->primary_transaction_quantity;
                        $stg = array(
                            'transaction_id'=>MaterialTxns::all()->count()+1,
                            'last_updated_by'=>Auth::user()->id,
                            'created_by'=>$xhead->created_by,
                            'inventory_item_id'=>$data['inventory_item_id'],
                            'organization_id'=>'222',
                            'subinventory_code'=>$data['subinventory'],
                            'transaction_type_id'=>4,
                            'transaction_action_id'=>4,
                            'transaction_source_type_id'=>4,
                            'transaction_source_name'=>MaterialTransaction::where('trx_code',4)->first()->trx_types,
                            'attribute1'=>$data['attribute1'],
                            'transaction_quantity'=>$data['requested_quantity'],
                            'primary_quantity'=>$data['requested_quantity'],
                            'transaction_uom'=>$data['requested_quantity_uom'],
                            'transaction_date'=>date('Y-m-d H:i:s'),
                            'currency_code'=>CurrencyGlobal::where('currency_code',$xhead->currency_code)->first()->currency_code,
                            'transaction_source_id'=>$xhead->delivery_id,
                            'transaction_reference'=>$xhead->packing_slip_number,
                            'source_line_id'=>$data['source_line_id'],
                            // 'transfer_subinventory'=>'9000',
                        );

                        DeliveryDetail::where('id',$request->id[$key])->update([
                            'shipped_quantity'=>$request->roll_qty[$key],
                        ]);
                        MaterialTxns::create($stg);
                        $xhead->save();
                        $update = SalesOrderDetail::where('header_id',$request->source_header_id[$key])
                        ->where('split_line_id',$request->source_line_id[$key])
                        ->update(["flow_status_code"=>8,]);
                    }
                        \DB::commit();
                    }catch (Throwable $e){
                        \DB::rollback();
                    }
                return back()->with('success', 'Stock was confirmed');
                // CONFIRM
                // DELETE
                }else{
                    $xhead =DeliveryHeader::where('delivery_id','=',$request->delivery_id)->first();
                    $xhead->actual_ship_date=$request->actualdate;
                    $headhead=$request->source_header_id;
                    $lineline=$request->source_line_id;
                    $id=$request->id;
                    $sourceline=array_unique($lineline);
                    $deliveridetilId = $request->delivery_detail_id;
                    foreach($request->id as $key => $value){
                        $data = array(
                            'inventory_item_id'=>$request->inventory_item_id[$key],
                            'subinventory'=>$request->subinventory[$key],
                            'requested_quantity'=>$request->requested_quantity[$key],
                            'requested_quantity_uom'=>$request->requested_quantity_uom[$key],
                            'source_line_id'=>$request->source_line_id[$key],
                            'attribute1'=>$request->attribute1[$key],
                        );
                        $onhand=Onhand::where(['inventory_item_id'=>$data['inventory_item_id'],'subinventory_code'=>'9STG'])
                        ->first();
                        if($onhand){
                            if((float)$onhand->primary_transaction_quantity = $data['requested_quantity']){
                                $cancel=11;
                            }
                        }

                        if(in_array($request->id[$key],$id)){
                            $SalesOrderDetail = SalesOrderDetail::where('header_id',$headhead[$key])
                            ->where('split_line_id',$lineline[$key])
                            ->update([
                                'shipping_interfaced_flag'=>NULL,
                                'flow_status_code'=>6,
                            ]);
                            $xhead->save();
                        }
                    }
                    $DeliveryHeader=DeliveryHeader::where('delivery_id',$request->delivery_id)->update([
                        'status_code'=>11,
                        'lvl'=>11
                    ]);

                    $deliveryHeader=DeliveryHeader::select('bm_wsh_new_deliveries.*','bm_trx_statuses.trx_name','bm_cust_site_uses_all.cust_party_code',
                    'bm_party_site.site_code','bm_cust_site_uses_all.party_name','bm_currencies_id_all.currency_code','bm_global_terms_all.term_code')
                    ->Join('bm_cust_site_uses_all','bm_cust_site_uses_all.id','=','bm_wsh_new_deliveries.ship_to_party_id')
                    ->join('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_wsh_new_deliveries.status_code')
                    ->join('bm_party_site','bm_party_site.id','=','bm_wsh_new_deliveries.ship_to_party_id')
                    ->join('bm_currencies_id_all','bm_currencies_id_all.currency_code','=','bm_wsh_new_deliveries.currency_code')
                    ->join('bm_global_terms_all','bm_global_terms_all.id','=','bm_wsh_new_deliveries.freight_terms_code')
                    ->get();
                    return redirect()->route('admin.deliveries.index')->with('success','Data has been return to sales order');
                }
                // DELETE
            break;
            case 'fullfillment':
                // dd('fullfillment');

                if($request->accepted_date==null)
                {
                    return back()->with('error','Please input accepted date');
                }
                $id = $request->ids;
                try {
                    \DB::beginTransaction();
                    foreach ($request->checkid as $key => $value){
                        if($id==null){
                            return back()->with('error','Please select data');
                        }
                        if(in_array($request->checkid[$key],$id)){
                            // dd($request);
                            DeliveryDetail::where('id',$request->checkid[$key])->update([
                                'delivered_quantity'=>$request->qty[$key],
                            ]);
                            $sale=SalesOrderDetail::where('header_id',$request->header[$key])
                            ->where('split_line_id',$request->line[$key])
                            ->update([
                                'fulfilled_quantity'=>$request->qty[$key],
                                'flow_status_code'=>12,
                                'fulfillment_date'=>date('Y-m-d H:i:s')
                            ]);

                            $onhandupdate = Onhand::where('inventory_item_id', $request->inventory_item_id[$key])
                            ->where('subinventory_code',$request->subinventory[$key])->first();
                            // dd($data['requested_quantity']);
                            $onhandupdate->primary_transaction_quantity -= $request->qty[$key];
                            $onhandupdate->save();
                            
                        // if($condition->primary_transaction_quantity>$data['requested_quantity']){
                        //     $condition->primary_transaction_quantity - $data['requested_quantity'];
                        // }else{
                        //     return back()->with('error',"Quantity is not enought");
                        // }

                        }else{
                            $sale=SalesOrderDetail::where('header_id',$request->header[$key])
                            ->where('split_line_id',$request->line[$key])
                            ->update([
                                'flow_status_code'=>12
                            ]);
                        }
                    }
                    $check_status=SalesOrderDetail::where([['header_id',$request->header],['flow_status_code','!=',12]])->count('id');
                    if($check_status == 0){
                        SalesOrder::where('header_id',$request->header)->update(['open_flag'=>12]);
                    }
                    \DB::commit();
                }catch (Throwable $e) {
                    \DB::rollback();
                }
                DeliveryHeader::where('id',$request->id)->update([
                    'accepted_by'=>Auth::user()->id,
                    'accepted_date'=>date('Y-m-d H:i:s'),
                    'status_code'=>12,
                    'acceptance_flag'=>1,
                    'lvl'=>12,
                ]);
                return redirect()->route('admin.deliveries.index')->with('success', 'Fullfillment Successed');
            break;
        }


    }

    public function destroy(Request $request){
        abort_if(Gate::denies('shipment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $deliveryHeader=DeliveryHeader::where([["id","=",$request->id],['lvl','=',6],['packing_slip_number','=',NULL]]);

        if (  $deliveryHeader->delete()){
            $response = ['status' => 'success', 'success' => true, 'message' => 'Deleted success'];
            }else{
                $response = ['status' => 'error', 'success' => false, 'message' => 'Unable to delete data'];
            }
            return $response;
    }
    public function massDestroy(MassDestroyDeliveryRequest  $request)
    {
        DeliveryHeader::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}

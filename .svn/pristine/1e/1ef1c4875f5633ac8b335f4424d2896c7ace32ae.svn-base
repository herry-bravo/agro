<?php

namespace App\Http\Controllers\Admin;

use App\SalesOrderDetail;
use App\SalesOrder;
use App\DeliveryDetail;
use App\DeliveryHeader;
use App\Customer;
use App\CurrencyGlobal;
use App\Site;
use App\Terms;
use App\DeliveryDistrib;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyShipmentRequest;
use App\Http\Requests\StoreShipmentRequest;
use Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ShipmentController extends Controller
{
    public function index(Request $request){
        abort_if(Gate::denies('shipment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $DeliveryHeader=DeliveryHeader::orderBy('created_at','DESC')->get();
        return view('admin.shipments.index', compact('DeliveryHeader'))->with('no',1);
    }
    public function show($header_id){
        abort_if(Gate::denies('shipment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $DeliveryHeader=DeliveryHeader::where('bm_wsh_new_deliveries.id',$header_id)->get()->first();
        $DeliveryDetail = DeliveryDetail::where('bm_wsh_delivery_details.delivery_detail_id','bm_wsh_new_deliveries.delivery_id')->get();
        $customers=Customer::all();
        $global = CurrencyGlobal::where('currency_status', 1)->get();
        $customershiipto=Site::all();
        $freight_terms=Terms::all();

        if($DeliveryHeader==null){
            return back()->with('error', 'Data yang anda cari tidak valid' );
        }
        return view('admin.shipments.show',compact('DeliveryHeader','DeliveryDetail','customers','global','customershiipto','freight_terms'))->with('no',1);
    }
    public function create(Request $request){
        abort_if(Gate::denies('shipment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $DeliveryHeader=DeliveryHeader::select('bm_wsh_new_deliveries.*','bm_trx_statuses.trx_name','bm_cust_site_uses_all.party_name',
        'bm_cust_site_uses_all.cust_party_code')
        ->join('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_wsh_new_deliveries.status_code')
        ->join('bm_cust_site_uses_all','bm_cust_site_uses_all.cust_party_code','=','bm_wsh_new_deliveries.sold_to_party_id')
        ->where('bm_wsh_new_deliveries.delivery_id',$request->id)
        ->latest()->first();

        $DeliveryDetail = DeliveryDetail::select('bm_wsh_delivery_details.*','bm_mtl_system_item.item_code')
        ->join('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_wsh_delivery_details.inventory_item_id')
        ->get();

        $customers=Customer::get();
        $global = CurrencyGlobal::where('currency_status', 1)->get();
        $customershiipto=Site::all();
        $freight_terms=Terms::all();
        if($DeliveryHeader==null){
            return back()->with('error', 'Data yang anda cari tidak valid' );
        }
        return view('admin.shipments.create', compact('DeliveryHeader','DeliveryDetail','customers','global','customershiipto','freight_terms'))->with('no', 1);
    }

    public function store(Request $request){
        switch ($request->input('action')) {
            case 'add_item_first':
                $xhead=$request->header_id;
                $id = DB::table('bm_wsh_new_deliveries')->latest('delivery_id')->first();
                $id = $id->delivery_id ?? 0;
                $head = DeliveryHeader::findorNew($id+1);
                $deliverynumber=str_pad($id+1, 4, "0", STR_PAD_LEFT);
                // DD($id);
                $id_check = $request->id;
                if($request->id==null){
                    return back()->with('error','Please select data');
                }
                try {
                    \DB::beginTransaction();
                    foreach ($request->checkid as $key => $value)
                    {
                        if(in_array($request->checkid[$key],$id_check)){
                            $headhead=$request->header_id[$key];
                            if('delivery_detail_id'&&'source_header_id'&&'source_line_id'&&'inventory_item_id'&&'item_description'&&'requested_quantity_uom'&&'cust_po_number'==null){
                                return back()->with('error','Has No data');
                            }
                            if($request->attribute_number_l[$key] !=0 ){

                                $l=$request->attribute_number_l[$key];
                            }else{
                                $l="";
                            }
                            $data = array(
                                'delivery_detail_id'=>$deliverynumber,
                                'source_header_id'=>($request->header_id[$key])? $request->header_id[$key] :'',
                                'source_line_id'=>(float)$request->split_line_id[$key],
                                'inventory_item_id'=>isset($request->inventory_item_id[$key])?$request->inventory_item_id[$key] :'',
                                'item_description'=>isset($request->user_description_item[$key])?$request->user_description_item[$key]."  ".(float)$request->attribute_number_gsm[$key]." GSM  ".$l." ".(float)$request->attribute_number_w[$key]." CM":'',
                                'requested_quantity_uom'=>isset($request->order_quantity_uom[$key])?$request->order_quantity_uom[$key] :'',
                                'source_header_number'=>isset($request->order_number[$key])?$request->order_number[$key] :'',
                                'requested_quantity'=>isset($request->ordered_quantity[$key])?$request->ordered_quantity[$key] :'',
                                'created_by'=>Auth::user()->id,
                                'cust_po_number'=>$request->cust_po_number[$key],
                                'intattribute1'=>isset($request->attribute_number_l[$key])?(float)$request->attribute_number_l[$key]:'',
                                'intattribute2'=>isset($request->attribute_number_w[$key])?(float)$request->attribute_number_w[$key]:'',
                                'intattribute3'=>isset($request->attribute_number_gsm[$key])?(float)$request->attribute_number_gsm[$key]:'',
                                // 'attribute1'=>isset($request->attribute1[$key])?$request->attribute1[$key] :'',
                                'attribute2'=>isset($request->attribute2[$key])?$request->attribute2[$key] :'',
                                'unit_price'=>(int)$request->unit_selling_price[$key],
                                'conversion_rate'=>(float)$request->conversion_rate[$key],
                                // 'conversion_date'=>$request->conversion_date[$key],
                                'currency_code'=>isset($request->attribute1[$key])?$request->attribute1[$key] :'',
                                'picked_quantity'=>$request->ordered_quantity[$key],
                                'sales_order_number'=>$request->order_number[$key],
                                'subinventory'=>$request->shipping_inventory[$key],
                                // 'org_id'=>Auth::user()->org_id,
                                'lot_number'=>$request->packing_style[$key],
                            );
                            // dd($data);
                            $detil=DeliveryDetail::create($data);
                            $update = SalesOrderDetail::where('id',$request->checkid[$key])->update([
                                "shipping_interfaced_flag"=>1
                            ]);
                        }
                    }
                $ids = SalesOrder::where('header_id','=',$headhead)->first();
                $currenci = CurrencyGlobal::where('currency_status',1)->first();
                $deliveryhead=DeliveryHeader::updateOrCreate([
                    'delivery_id'=>$deliverynumber,
                    'delivery_name'=>date('ym').$deliverynumber,
                    'lvl'=>6,
                    'description'=>$ids->user_item_description,
                    'attribute1'=>$ids->attribute1,
                    'attribute2'=>'',
                    'confirm_date'=>$ids->ordered_date,
                    'freight_terms_code'=> $ids->freight_terms_code,
                    'ship_to_party_id'=>$ids->deliver_to_org_id,
                    'sold_to_party_id'=>$ids->invoice_to_org_id,
                    'created_by'=>Auth::user()->id,
                    'status_code'=>14,
                    'organization_id'=>$ids->org_id,
                    'gross_weight'=>0,
                    'currency_code'=>$ids->attribute1,
                ]);

                    $a= \DB::commit();
                    return redirect()->route('admin.shipment.create',['id'=>$deliverynumber]);
                }catch (Throwable $e) {
                    \DB::rollback();
                }
            break;
            case 'add_item_second':
                if($request->id==null){
                    return back()->with('error','Please select data');
                }
                $id_check = $request->id;
                $deliveryheader = DeliveryHeader::where('id',$request->input('idhead'))->get()->first();
                try {
                    \DB::beginTransaction();
                    foreach ($request->checkid as $key => $value)
                    {
                        if(in_array($request->checkid[$key],$id_check)){
                            if('delivery_detail_id'&&'source_header_id'&&'source_line_id'&&'inventory_item_id'&&'item_description'&&'requested_quantity_uom'&&'cust_po_number'==null){
                                return back()->with('error','Datanya Kemana Bambang');
                            }
                            $data = array(
                                'delivery_detail_id'=>$deliveryheader->delivery_detail_id,
                                'source_header_id'=>$request->header_id[$key],
                                'source_line_id'=>(float)$request->split_line_id[$key],
                                'inventory_item_id'=>$request->inventory_item_id[$key],
                                'item_description'=>isset($request->user_description_item[$key])?$request->user_description_item[$key]." GSM ".(float)$request->attribute_number_gsm[$key]."  ".(float)$request->attribute_number_w[$key]." X ".(float)$request->attribute_number_l[$key]." CM":'',
                                'requested_quantity_uom'=>$request->order_quantity_uom[$key],
                                'source_header_number'=>$request->order_number[$key],
                                'requested_quantity'=>$request->ordered_quantity[$key],
                                'created_by'=>Auth::user()->id,
                                'cust_po_number'=>$request->cust_po_number[$key],
                                'attribute1'=>$request->attribute1[$key],
                                'attribute2'=>$request->attribute2[$key],
                                'unit_price'=>(int)$request->unit_selling_price[$key],
                                'picked_quantity'=>$request->ordered_quantity[$key],
                                'sales_order_number'=>$request->order_number[$key],
                                'subinventory'=>$request->shipping_inventory[$key],
                                'intattribute1'=>isset($request->attribute_number_l[$key])?(float)$request->attribute_number_l[$key]:'',
                                'intattribute2'=>isset($request->attribute_number_w[$key])?(float)$request->attribute_number_w[$key]:'',
                                'intattribute3'=>isset($request->attribute_number_gsm[$key])?(float)$request->attribute_number_gsm[$key]:'',
                            );
                            $detil=DeliveryDetail::create($data);
                            $update = SalesOrderDetail::where('id',$request->checkid[$key])->update([
                                "shipping_interfaced_flag"=>1
                            ]);
                        }
                    }
                    \DB::commit();
                }catch (Throwable $e) {
                    \DB::rollback();
                }
                return back()->with('success','Item Data has been added');
            break;
        }
    }

    public function update(Request $request, DeliveryHeader $deliveryHeader, DeliveryDetail $DeliveryDetail){
        switch ($request->input('action')) {
            case 'create':
                if($request->delivery_detail_id==null){
                    return back()->with('error','Please add Item for Shipping');
                }
                $create=Auth::user()->id;
                $xhead =DeliveryHeader::where('delivery_id','=',$request->delivery_id)
                ->where('delivery_id','=',$request->delivery_id)->first();
                $xhead->packing_slip_number=$request->invoice_no;
                $xhead->dock_code=$request->invoice_no;
                $xhead->on_or_about_date=$request->invoice_date;
                // $xhead->currency_code=$request->currencies;
                $xhead->ship_to_party_id=$request->customer_shipto;
                $xhead->attribute2=$request->note;
                // $xhead->freight_terms_code=$request->freight_term;
                $xhead->gross_weight=$request->gross_weight;
                $xhead->created_by=$create;
                try {
                    \DB::beginTransaction();
                    $xhead->save();
                    foreach($request->id as $key =>$id){
                        if(empty($request->id[$key])){
                            $datadetil = array(
                                'delivery_detail_id'=>$request->delivery_detail_id[$key],
                                'source_header_id'=>$request->source_header_id[$key],
                                'source_line_id'=>$request->source_line_id[$key],
                                'sold_to_contact_id'=>$request->sold_to_contact_id[$key],
                                'created_at'=>date('Y-m-d H:i:s'),
                                'updated_at'=>date('Y-m-d H:i:s')
                            );
                            DeliveryDetail::create($datadetil);
                        }else{
                            $update = DeliveryDetail::find($request->id[$key]);
                            // $update -> currency_code=CurrencyGlobal::where('id',$request->currencies)->first()->currency_code;
                            $update->updated_at=date('Y-m-d H:i:s');

                            $update->save();
                        };
                    }
                    \DB::commit();
                }catch (Throwable $e){
                    \DB::rollback();
                }
            break;
            case 'edit':
                if($request->delivery_detail_id==null){
                    return back()->with('error','Please add Item for Shipping');
                }
                $create=Auth::user()->id;
                $xhead =DeliveryHeader::where('delivery_id','=',$request->delivery_id)
                ->where('delivery_id','=',$request->delivery_id)->first();
                $xhead->packing_slip_number=$request->invoice_no;
                $xhead->dock_code=$request->invoice_no;
                $xhead->on_or_about_date=$request->invoice_date;
                $xhead->ship_to_party_id=$request->customer_shipto;
                $xhead->attribute2=$request->note;
                // $xhead->freight_terms_code=$request->freight_term;
                $xhead->gross_weight=$request->gross_weight;
                $xhead->created_by=$create;
                try {
                    \DB::beginTransaction();
                    $xhead->save();
                    foreach($request->id as $key =>$id){
                        if(empty($request->id[$key])){
                            $datadetil = array(
                                'delivery_detail_id'=>$request->delivery_detail_id[$key],
                                'source_header_id'=>$request->source_header_id[$key],
                                'source_line_id'=>$request->source_line_id[$key],
                                'sold_to_contact_id'=>$request->sold_to_contact_id[$key],
                                'created_at'=>date('Y-m-d H:i:s'),
                                'updated_at'=>date('Y-m-d H:i:s')
                            );
                            DeliveryDetail::create($datadetil);
                        }else{
                            $update = DeliveryDetail::find($request->id[$key]);
                            $update -> updated_at=date('Y-m-d H:i:s');
                            $update->cycle_count_quantity=isset($request->uniqID[$key])? $request->uniqID[$key]:'';
                            $update->save();
                        };
                    }
                    \DB::commit();
                }catch (Throwable $e){
                    \DB::rollback();
                }
            break;
            case 'add_item_second':
                if($request->id==null){
                    return back()->with('error','Please select data');
                }
                $id_check = $request->id;
                $deliveryheader = DeliveryHeader::where('id',$request->idhead)->get()->first();
                try {
                    \DB::beginTransaction();
                    foreach ($request->checkid as $key => $value)
                    {
                        if(in_array($request->checkid[$key],$id_check)){
                            if('delivery_detail_id'&&'source_header_id'&&'source_line_id'&&'inventory_item_id'&&'item_description'&&'requested_quantity_uom'&&'cust_po_number'==null){
                                return back()->with('error','Datanya Kemana Bambang');
                            }
                            $data = array(
                                'delivery_detail_id'=>$deliveryheader->id,
                                'source_header_id'=>$request->header_id[$key],
                                'source_line_id'=>$request->line_id[$key],
                                'inventory_item_id'=>$request->inventory_item_id[$key],
                                'item_description'=>$request->user_description_item[$key],
                                'requested_quantity_uom'=>$request->order_quantity_uom[$key],
                                'source_header_number'=>$request->order_number[$key],
                                'requested_quantity'=>$request->ordered_quantity[$key],
                                'created_by'=>Auth::user()->id,
                                'cust_po_number'=>$request->cust_po_number[$key],
                                'attribute1'=>$request->attribute1[$key],
                                'attribute2'=>$request->attribute2[$key],
                                'unit_price'=>(int)$request->unit_selling_price[$key],
                                'picked_quantity'=>$request->ordered_quantity[$key],
                                'sales_order_number'=>$request->order_number[$key],
                            );
                            $detil=DeliveryDetail::create($data);
                            $update = SalesOrderDetail::where('id',$request->checkid[$key])->update([
                                "flow_status_code"=>7,
                            ]);
                        }
                    }
                    \DB::commit();
                }catch (Throwable $e) {
                    \DB::rollback();
                }
                return back()->with('success','Item Data has been added');
            break;
            case 'delete':
                DeliveryDetail::where('id',$request->id)->update(['deleted_at'=>date('Y-m-d H:i:s')]);
                SalesOrderDetail::where('header_id',$request->header_id)->where('split_line_id',(float)$request->line_id)->update(["shipping_interfaced_flag"=>NULL]);
                return back()->with('success','Your data has been deleted');
            break;
            case 'deleteAll':
                if($request->iddelete==null){
                    return back()->with('error','Please select row');
                }
                DeliveryDetail::whereIn('id',$request->iddelete)
                    ->update(['deleted_at'=>date('Y-m-d H:i:s')]);
                return back()->with('success','Your data has been deleted');
            break;

        }
        return redirect()->route('admin.shipment.edit',$request->delivery_id)->with('success', 'Updated');
    }

    public function destroy(Request $request){
        abort_if(Gate::denies('shipment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $DeliveryDetail=DeliveryDetail::find($request->id);
        $devheadid=$DeliveryDetail->delivery_detail_id;

        $DeliveryDetail->delete();
        SalesOrderDetail::where('header_id',$DeliveryDetail->source_header_id)
        ->where('line_id',$DeliveryDetail->source_line_id)
        ->update(["flow_status_code"=>6]);
        return back()->with('success','Your data has been deleted');
    }

    public function massDestroy(MassDestroyShipmentRequest $request){
        DeliveryDetail::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function edit($id){
        abort_if(Gate::denies('shipment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $DeliveryHeader=DeliveryHeader::select('bm_wsh_new_deliveries.*','bm_trx_statuses.trx_name',
        'bm_cust_site_uses_all.cust_party_code','bm_cust_site_uses_all.party_name')
        ->leftJoin('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_wsh_new_deliveries.status_code')
        ->leftJoin('bm_cust_site_uses_all','bm_cust_site_uses_all.cust_party_code','=','bm_wsh_new_deliveries.sold_to_party_id')
        // ->leftJoin('bm_currencies_id_all','bm_currencies_id_all.id','=','bm_wsh_new_deliveries.currency_code')
        ->where('bm_wsh_new_deliveries.delivery_id',$id)->get()->first();

        $DeliveryDetail = DeliveryDetail::select('bm_wsh_delivery_details.*','bm_mtl_system_item.item_code')
        ->join('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_wsh_delivery_details.inventory_item_id')
        ->orderBy('bm_wsh_delivery_details.created_at')
        ->get();

        $customers=Customer::all();
        $global = CurrencyGlobal::where('currency_status', 1)->get();
        $customershiipto=Site::all();
        $freight_terms=Terms::all();

        if($DeliveryHeader==null){
            return back()->with('error', 'Data is not exist');
        }
        return view('admin.shipments.edit',compact('DeliveryHeader','DeliveryDetail','customers','global','customershiipto','freight_terms'))->with('no',1);
    }

	public function deliveryOrders($id){

        // return view('admin.stdReports.suratJalan',compact('header','data'));
        // dd($id);
        $head = DeliveryHeader::where('delivery_id',$id)->first();

        $line = DeliveryDistrib::where('header_id',$id)
                                ->leftJoin('bm_inv_onhand_fg_detail as comp','comp.uniq_attribute_roll','=','bm_wsh_delivery_distb_items.container_item_id')   // get roll location
                                ->get();

        $totalRoll = DeliveryDistrib::where('header_id',$id)->count('container_item_id'); //count roll

        $roll = DeliveryDistrib::where('header_id',$id)
                                ->select('load_item_id','attribute1', 'attribute3', DB::raw('count(load_item_id) as roll')) // roll per item
                                ->groupBy('load_item_id','attribute1', 'attribute3')
                                ->get();
                                // dd($roll);

        $pdf = \PDF::loadview('admin.shipments.deliveryOrders',compact('head','line','roll','totalRoll'))->setPaper('A4');
        return $pdf->stream('Packing List'.'.pdf');
	}

    public function rollDestroy(DeliveryDistrib $DeliveryDistrib, Request $request){
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $DeliveryDistrib->delete();

        return back();
    }


}


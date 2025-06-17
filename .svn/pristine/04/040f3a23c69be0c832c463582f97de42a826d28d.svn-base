<?php

namespace App\Http\Controllers\Admin;
use App\DeliveryDetail;
use Illuminate\Http\Request;
use App\DeliveryHeader;
use App\Customer;
use App\CurrencyGlobal;
use App\Subinventories;
use App\SalesOrderDetail;
use App\Site;
use App\Terms;
use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class DeliveriesDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($id=$request->id);
        echo('masuk deliveriesdetail store');
        $DeliveryDetail=DeliveryDetail::find('delivery_detail_id',$request->id);
        dd($DeliveryDetail->source_header_id);
        foreach ($request->id as $key => $value){
            if(in_array($request->id[$key],$id)){
                $data = array(
                    'source_header_id'=>isset($request->source_header_id[$key])? $request->source_header_id[$key] :'',
                    'source_line_id'=>isset($request->source_line_id[$key])? $request->source_line_id[$key] :'',
                    'source_header_number'=>isset($request->source_header_number[$key])? $request->source_header_number[$key] :'',
                    'inventory_item_id'=>isset($request->inventory_item_id[$key])? $request->inventory_item_id[$key] :'',
                    'item_item_description'=>isset($request->item_item_description[$key])? $request->item_item_description[$key] :'',
                    'requested_quantity'=>isset($request->requested_quantity[$key])? $request->requested_quantity[$key] :'',
                    'requested_quantity_uom'=>isset($request->requested_quantity_uom[$key])? $request->requested_quantity_uom[$key] :'',
                    'subinventory'=>isset($request->subinventory[$key])? $request->subinventory[$key] :'',
                    'net_weight'=>isset($request->net_weight[$key])? $request->net_weight[$key] :'',
                    'last_updated_by'=>isset($request->last_updated_by[$key])? $request->last_updated_by[$key] :'',
                    'attribute1'=>isset($request->attribute1[$key])? $request->attribute1[$key] :'',
                    'attribute2'=>isset($request->attribute2[$key])? $request->attribute2[$key] :'',
                    'intattribute1'=>isset($request->intattribute1[$key])? $request->intattribute1[$key] :'',
                    'intattribute2'=>isset($request->intattribute2[$key])? $request->intattribute2[$key] :'',
                    'intattribute3'=>isset($request->intattribute3[$key])? $request->intattribute3[$key] :'',
                );

                $onHand=Onhand::where(['inventory_item_id'=>$data['inventory_item_id'],'subinventory_code'=>$data['subinventory']])->first();
                if($onHand){
                    $Stok = $onhand->primary_transaction_quantity;
                    if($Stok > $data['requested_quantity']){
                        /*Update Onhand */
                        $update_stock=$onhand->primary_transaction_quantity-$data['requested_quantity'];
                        $onhand=Onhand::where(['inventory_item_id'=>$data['inventory_item_id'],'subinventory_code'=>$data['subinventory']])
                        ->update(["primary_transaction_quantity"=>$update_stock]);
                    }else{
                        return back()->with('error', 'Stock Not Enough');
                    }
                }else{
                    return back()->with('error', 'Not Exist');
                }
            }
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
        // dd('masuk rana delivery detil');
        abort_if(Gate::denies('delivery_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        // // dd($id);
        $deliveryDetail = DeliveryDetail::where('id',$id)->get()->first();
        // dd($deliveryDetail);
        // // dd($deliveryDetail->delivery_detail_id);
        $DeliveryHeader = DeliveryHeader::join('bm_wsh_delivery_details','bm_wsh_delivery_details.delivery_detail_id','=','bm_wsh_new_deliveries.delivery_id')
            ->where('delivery_id',$deliveryDetail->delivery_detail_id)
            ->get()
            ->first();
        // dd($DeliveryHeader);
        // // dd($DeliveryDetail);
        // return view('admin.deliveries.edit',compact('deliveryDetail','DeliveryHeader'));
        return view('admin.deliveriesdetail.edit',compact('deliveryDetail','DeliveryHeader'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,DeliveryDetail $DeliveryDetail)
    {
        // dd($request->source_header,$request->source_line);
        // dd('test');
        // dd($request);
        // dd($request->shipping_inventory);
        // dd($request->id);
        // dd($request->shipping_inventory);
        // dd($request->input('headid'));
        abort_if(Gate::denies('delivery_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $devdet=DeliveryDetail::where('id',$request->id)->update([
            "net_weight"=>$request->input('xnet_weight'),
            "subinventory"=>$request->shipping_inventory,
            "intattribute1"=>$request->input('panjang'),
            "intattribute2"=>$request->input('lebar'),
            "intattribute3"=>$request->input('gsm'),
        ]);
        $salesdetil=SalesOrderDetail::where('header_id',$request->source_header)->where('split_line_id',$request->source_line)
            ->update(["shipping_inventory"=>$request->shipping_inventory]);
        // dd($salesdetil);
        // return back()->with('success','Inventory has been added');

        // dd('test');
        // dd($devdet);
        // $DeliveryHeader=DeliveryHeader::select('bm_wsh_new_deliveries.*','bm_trx_statuses.trx_name')
        // ->join('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_wsh_new_deliveries.status_code')
        // ->where('delivery_id',$request->input('headid'))->first();

        // $DeliveryDetail=DeliveryDetail::select('bm_wsh_delivery_details.*','bm_mtl_system_item.item_code')
        // ->join('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_wsh_delivery_details.inventory_item_id')
        // ->join('bm_wsh_new_deliveries','bm_wsh_new_deliveries.delivery_id','=','bm_wsh_delivery_details.delivery_detail_id')
        // ->where ('bm_wsh_delivery_details.delivery_detail_id','=',$request->input('headid'))
        // ->get();

        // $customers=Customer::all();
        // $global = CurrencyGlobal::where('currency_status', 1)->get();
        // $customershiipto=Site::all();
        // $freight_terms=Terms::all();
        // $Subinventories=Subinventories::all();

        return back()->with('success','Add Weight was updated');
        // return view('admin.deliveries.create', compact('DeliveryHeader','DeliveryDetail','customers','global','customershiipto','freight_terms','Subinventories'))->with('no', 1);

    }
    public function destroy($id)
    {
        //
    }
    public function massDestroy()
    {
        return response(null, Response::HTTP_NO_CONTENT);
    }
}

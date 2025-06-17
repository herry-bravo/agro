<?php

namespace App\Http\Controllers\Admin;
use App\DeliveryDetail;
use App\DeliveryHeader;
use App\Customer;
use App\Subinventories;
use App\CurrencyGlobal;
use App\Site;
use App\Terms;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveriesTermsController extends Controller
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
        //
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
    public function update(Request $request,DeliveryHeader $DeliveryHeader)
    {
        // dd('test');
        $update_by=Auth::user()->name;
        // dd($update_by);
        // dd($request->id);
        abort_if(Gate::denies('delivery_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $dev=DeliveryHeader::where('id',$request->id)
        ->update([
            // "created_by"=>$request->input('created_by'),
            "last_updated_by"=>$update_by,
            "ship_method_code"=>$request->input('ship_method_code'),
            "fob_code"=>$request->input('fob_code')
        ]);
        // dd($dev);
        // $DeliveryHeader=DeliveryHeader::select('bm_wsh_new_deliveries.*','bm_trx_statuses.trx_name')
        // ->leftJoin('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_wsh_new_deliveries.status_code')
        // ->where('delivery_id',$request->id)->first();
        // // dd($request->delivery_form);

        // // dd($DeliveryHeader);
        // $DeliveryDetail=DeliveryDetail::select('bm_wsh_delivery_details.*','bm_mtl_system_item.item_code','bm_trx_statuses.trx_name')
        // ->leftJoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_wsh_delivery_details.inventory_item_id')
        // ->leftJoin('bm_wsh_new_deliveries','bm_wsh_new_deliveries.delivery_id','=','bm_wsh_delivery_details.delivery_detail_id')
        // ->leftJoin('bm_trx_statuses','bm_trx_statuses.trx_code','=','bm_wsh_new_deliveries.status_code')
        // ->where ('bm_wsh_delivery_details.delivery_detail_id','=',$request->id)
        // ->get();
        // $customers=Customer::all();
        // $global = CurrencyGlobal::where('currency_status', 1)->get();
        // $customershiipto=Site::all();
        // $freight_terms=Terms::all();
        // $Subinventories=Subinventories::all();

        return back()->with('success','Update Term successfull');

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
    public function massDestroy()
    {
        return response(null, Response::HTTP_NO_CONTENT);
    }
}

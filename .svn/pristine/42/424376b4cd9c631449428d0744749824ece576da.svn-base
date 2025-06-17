<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\PurchaseOrder;
use App\PurchaseOrderDet;
use App\TrxStatuses;
use App\RcvHeader;
use App\RcvDetail;
use App\MissExpenses;
use App\MaterialTxns;
use Symfony\Component\HttpFoundation\Response;

class MissExpenseController extends Controller
{
    public function index()
    {
     //   abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

		$order_head = PurchaseOrder::where('type_lookup_code',1)->orderBy('segment1','desc')->get();
		$return = RcvHeader::All();
        $missExpenses = MissExpenses::All();
        return view('admin.missExpense.index', compact('order_head','return','missExpenses'));
    }

    public function create(Request $request)
    {
      //  abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order = $request->po;
        $aju = $request->aju;
        $rate = $request->rate;

        $miss = MissExpenses::where('attributenumber','=',$aju)->first();

        if($miss){
            return back()->with('error', 'Miscellaneous Expenses Already Entered in This Document');
        }

        $rcv_detail = RcvDetail::leftJoin('bm_c_rcv_shipment_header_id as rh','rh.shipment_header_id','=','bm_c_rcv_transactions_id.shipment_header_id')
                            ->leftJoin('bm_po_header_all as p','p.id','=','bm_c_rcv_transactions_id.po_header_id')
                            ->select('bm_c_rcv_transactions_id.*', 'p.segment1')
                            ->where('rh.attribute1',$aju)
                            ->get();
        // dd($rcv_detail);
        $miss =MissExpenses::all()->last();

        return view('admin.missExpense.create', compact('order','aju','rcv_detail','rate','miss'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            \DB::beginTransaction();
            //auto id
                foreach($request->inventory_item_id as $key =>$inventory_item_id){
                    $data = array(
                        'order_number'=>$request->order_number [$key],
                        'po_line_id'=>$request->po_line_id [$key],
                        'shipment_unit_price'=>$request->shipment_unit_price[$key],
                        'po_line_location_id'=>$request->po_line_location_id [$key],
                        'inventory_item_id'=>$request->inventory_item_id [$key],
                        'item_description'=>$request->item_description [$key],
                        'attributenumber'=>$request->attributenumber,
                        'intattribute1'=>$request->intattribute1,
                        'intattribute2'=>$request->intattribute2 [$key],
                        'intattribute3'=>$request->intattribute3 [$key],
                        'intattribute4'=>$request->intattribute4 [$key],
                        'intattribute5'=>$request->intattribute5 [$key],
                        'intattribute6'=>$request->intattribute6 [$key],
                        'intattribute7'=>$request->intattribute7 [$key],
                        'intattribute8'=>$request->intattribute8 [$key],
                        'rcv_price'=>$request->rcv_price [$key],
                        'intattribute9'=>$request->container,
                        'intattribute10'=>floatval(preg_replace('/[^\d.]/', '', $request->intattribute10)), // Trucking
                        'intattribute11'=>$request->intattribute11, // Doc Fee !*
                        'intattribute12'=>$request->intattribute12, // Adm Cont
                        'intattribute13'=>$request->intattribute13, // Service !*
                        'intattribute14'=>$request->intattribute14, // Cleaning
                        'intattribute15'=>$request->intattribute15, // Chanel Fee
                        'intattribute16'=>$request->intattribute16, // EMKL !*
                        'intattribute17'=>$request->intattribute17, // Lift On / Off
                        'intattribute18'=>$request->intattribute18, // PIB
                        'intattribute19'=>$request->intattribute19, // Miss
                        'created_by'=>$request->created_by,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                    );
                    // dd($data);
                    MissExpenses::create($data);

                    //PO Price Update
                    $po_lines=PurchaseOrderDet::where('id','=',$request->po_line_location_id [$key])->update(['base_model_price'=>$request->rcv_price[$key]]);

                    //get rcv detail by aju
                    $aju = RcvDetail::leftJoin('bm_c_rcv_shipment_header_id','bm_c_rcv_transactions_id.shipment_header_id','=','bm_c_rcv_shipment_header_id.shipment_header_id')
                                ->select('bm_c_rcv_transactions_id.id')
                                ->where('bm_c_rcv_shipment_header_id.attribute1',$request->attributenumber)->get();

                    //update rcv price in every aju
                    foreach($aju as $key => $aju){
                        $aju =RcvDetail::find($aju->id);
                        $aju->transportation_cost = $request->rcv_price2;
                        $aju->save();
                    }

                    //Material trans
                    $trx = MaterialTxns::where('shipment_number','=',$request->attributenumber)->update(['actual_cost'=>$request->rcv_price2]);

                }
            \DB::commit();
            }catch (Throwable $e){
                \DB::rollback();
            }
        return redirect()->route('admin.missExpense.index')->with('success', 'Miscellaneous Expenses Successfull Inputed');
    }

    public function edit($id)
    {
        $miss = MissExpenses::where('attributenumber','=',$id)->first();
        // dd($miss);
        $data = MissExpenses::where('attributenumber','=',$id)->get();
        return view('admin.missExpense.edit', compact('miss','data'));

    }

    public function update(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            \DB::beginTransaction();
            //auto id
                foreach($request->inventory_item_id as $key =>$inventory_item_id){
                    $data = MissExpenses::find($request->id[$key]);
                    $data-> order_number = $request->order_number[$key];
                    $data-> po_line_id = $request->po_line_id[$key];
                    $data-> shipment_unit_price = $request->shipment_unit_price[$key];
                    $data-> po_line_location_id = $request->po_line_location_id[$key];
                    $data-> inventory_item_id = $request->inventory_item_id[$key];
                    $data-> item_description = $request->item_description[$key];
                    $data-> attributenumber = $request->attributenumber;
                    $data-> rcv_price = $request->rcv_price[$key];
                    $data-> intattribute1 = $request->intattribute1;
                    $data-> intattribute2 = $request->intattribute2[$key];
                    $data-> intattribute3 = $request->intattribute3[$key];
                    $data-> intattribute4 = $request->intattribute4[$key];
                    $data-> intattribute5 = $request->intattribute5[$key];
                    $data-> intattribute6 = $request->intattribute6[$key];
                    $data-> intattribute7 = $request->intattribute7[$key];
                    $data-> intattribute8 = $request->intattribute8[$key];
                    $data-> intattribute9 = $request->container;
                    $data-> intattribute10 = $request->intattribute10;
                    $data-> intattribute11 = $request->intattribute11;
                    $data-> intattribute12 = $request->intattribute12;
                    $data-> intattribute13 = $request->intattribute13;
                    $data-> intattribute14 = $request->intattribute14;
                    $data-> intattribute15 = $request->intattribute15;
                    $data-> intattribute16 = $request->intattribute16;
                    $data-> intattribute17 = $request->intattribute17;
                    $data-> intattribute18 = $request->intattribute18;
                    $data-> intattribute19 = $request->intattribute19;
                    $data ->updated_at = date('Y-m-d H:i:s');
                    $data->save();
                    // dd($data);

                    //PO Price Update
                    $po_lines=PurchaseOrderDet::where('id','=',$request->po_line_location_id [$key])->update(['base_model_price'=>$request->rcv_price[$key]]);

                    //get rcv detail by aju
                    $aju = RcvDetail::leftJoin('bm_c_rcv_shipment_header_id','bm_c_rcv_transactions_id.shipment_header_id','=','bm_c_rcv_shipment_header_id.shipment_header_id')
                                ->select('bm_c_rcv_transactions_id.id')
                                ->where('bm_c_rcv_shipment_header_id.attribute1',$request->attributenumber)->get();

                    //update rcv price in every aju
                    foreach($aju as $key => $aju){
                        $aju =RcvDetail::find($aju->id);
                        $aju->transportation_cost = $request->rcv_price2;
                        $aju->save();
                    }

                    //Material trans
                    $trx = MaterialTxns::where('shipment_number','=',$request->attributenumber)->update(['actual_cost'=>$request->rcv_price2]);

                }
            \DB::commit();
            }catch (Throwable $e){
                \DB::rollback();
            }
        return redirect()->route('admin.missExpense.index')->with('success', 'Miscellaneous Expenses Successfull Inputed');
    }
}

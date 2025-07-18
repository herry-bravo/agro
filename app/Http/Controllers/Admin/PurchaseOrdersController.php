<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\PurchaseOrder;
use SearchtController;
use App\PurchaseOrderDet;
use App\RequisitionDetail;
use App\ItemMaster;
use App\Terms;
use App\UomConversion;
use App\TrxStatuses;
use App\comment;
use App\Tax;
use App\HPCount;
use App\User;
use App\Product;
use App\PoAgent;
use Carbon\Carbon;
use Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PurchaseOrdersController extends Controller
{
    public function index()
    {
       abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.purchase.index');
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $terms = Terms::get();
        $tax = \App\Tax::get();
		$users = User::all();
		$status =TrxStatuses::whereIn('trx_code', [1, 2, 13])->get();
        HPCount::create();
        $id = HPCount::latest('id')->first();
        $head = HPCount::findorNew($id->id+1);
        $po_number='2'.str_pad($id->id+1, 7, "0", STR_PAD_LEFT);
        return view('admin.purchase.create',compact('users','status','po_number','terms','tax'));
    }

    public function store(StoreOrderRequest $request)
    {

        // dd("enter new");
        // $header_id =DB::table('bm_po_header_all')->get()->last();
        // $head = PurchaseOrder::findorNew($request->id);
        // $head->po_head_id = $header_id->id+1;
        $max_id = DB::table('bm_po_header_all')->max('id');
        $head = PurchaseOrder::findOrNew($request->id);
        $head->po_head_id = ($max_id ?? 0) + 1;

        $head->segment1=$request->segment1;
        $head->status=1;
        $head->agent_id=auth()->user()->id;
        $head->organization_id=isset($request->organization_id)? $request->organization_id :182;
        $head->created_by=$request->created_by;
        $head->vendor_id=$vendor=$request->vendor_id;
        $vendor_id=$vendor=$request->vendor_id;
        $head->vendor_site_id=$vendor_site=$request->vendor_site_id;
        $head->type_lookup_code=$request->type_lookup_code;
        $head->ship_to_location=$request->ship_to_location;
        $head->currency_code=$request->currency_code;
        $head->rate_date=$request->rate_date ?? Null;
        // $head->rate=$request->rate ?? Null;
        $head->notes=$request->checked;
        $head->rate=intval($request->select_tax);
        $head->term_id=$request->payment_method;
        $termMaster = Terms::where('id',$request->payment_method)->get()->first();
        if($termMaster->term_code!=0){
            $head->payment_due_date=Carbon::now()->addDays($termMaster->term_code)->format('Y-m-d H:i:s');
        }
        // dd(intval($request->purchase_total + ($request->purchase_total * ($request->select_tax / 100))));
        if ($isChecked = $request->has('checked')==true){
            $head->attribute1 = intval($request->purchase_total + ($request->purchase_total * ($request->select_tax / 100)));
        }else{
            $head->attribute1 = intval($request->purchase_total / (1 + ($request->select_tax / 100)));
        }
        switch ($request->input('action')) {
        case 'new':
		try {
			\DB::beginTransaction();
            dd($head);
		   $head->save();
		   $line_number=1;

            foreach($request->lines as $key =>$lines){
                $lines=RequisitionDetail::find($request->lines[$key]);
                $uom_conversion = UomConversion::where('inventory_item_id', $lines->inventory_item_id)->first();
                if ($uom_conversion){
                    if( $lines->pr_uom_code == $uom_conversion->interior_unit_code){
                        $base_uom = $uom_conversion->uom_code;
                        $base_qty = $lines->quantity / $uom_conversion->conversion_rate;
                        // dd("masuk");
                    }else{
                        $base_uom = $lines->pr_uom_code;
                        $base_qty = $lines->quantity;
                    }
                }
                $pr_uom = $lines->pr_uom_code;
                // dd($pr_uom);
                $item_id=$lines->inventory_item_id;
                $unit_price=app(\App\Http\Controllers\SearchController::class)->purchase_price($vendor_id,$item_id,$pr_uom,$vendor_site);

                $data = array(
                            'po_header_id'=>$head->po_head_id,
                            'line_id'=> $line_number,
                            'inventory_item_id'=>$lines->inventory_item_id,
                            'po_uom_code'=>$lines->pr_uom_code,
                            'unit_price'=>$unit_price,
                            'need_by_date'=>$lines->requested_date,
                            'po_quantity'=>$lines->quantity,
                            'base_uom'=>$base_uom ?? $lines->pr_uom_code,
                            'base_qty'=>$base_qty ?? $lines->quantity,
                            'attribute2'=>$lines->attribute2 ?? '',
                            'line_type_id'=>1,
                            'line_status'=>1,
                            'quantity_receive'=>0,
                          
                            'organization_id'=>222,
                            'source_line_id'=>$lines->id,
                            'item_description'=>$lines->attribute1,
                            'attribute1'=>$lines->PurchaseRequisition->segment1,
                            'line_number'=>(float)$lines->split_line_id,
                            'created_by_id'=>$request->created_by,
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s'),
                        );
                PurchaseOrderDet::create($data);
                RequisitionDetail::where('id',$lines->id)->update(['purchase_status'=>3]);
                $line_number++;
            }

        \DB::commit();
        }catch (Throwable $e){
            \DB::rollback();
		}
        break;

        case 'manual':try {
		\DB::beginTransaction();
            // dd($head);
		   $head->save();
		   $line_number=1;

            foreach($request->inventory_item_id as $key =>$value){
                $uom_conversion = UomConversion::where('inventory_item_id', $request->inventory_item_id)->first();
                if ($uom_conversion){
                    if( $request->po_uom_code == $uom_conversion->interior_unit_code){
                        $base_uom = $uom_conversion->uom_code;
                        $base_qty = $request->quantity / $uom_conversion->conversion_rate;
                        // dd("masuk");
                    }else{
                        $base_uom = $request->po_uom_code;
                        $base_qty = $request->quantity;
                    }
                }
                if ($isChecked = $request->has('checked')==true) {
                    $cost =$request->purchase_cost[$key];
                    $qty = $request->purchase_quantity[$key];
                    $subtot = $cost * $qty;
                    $attribute2 = $subtot + ($subtot * ($request->select_tax / 100));
                } else {
                    $cost = $request->purchase_cost[$key];
                    $qty = $request->purchase_quantity[$key];
                    $subtot = $cost * $qty;

                    // DPP dari subtotal yang sudah termasuk PPN
                    $attribute2 = intval($subtot / (1 + ($request->select_tax / 100)));

                }
                
                $data = array(
                    'po_header_id'=>$head->po_head_id,
                    'line_id'=> $line_number,
                    'inventory_item_id'=>$request->inventory_item_id[$key],
                    'po_uom_code'=>$request->po_uom_code[$key],
                    'unit_price'=>$request->purchase_cost[$key],
                    'need_by_date'=>$request->need_by_date[$key],
                    'po_quantity'=>$request->purchase_quantity[$key],
                    'base_uom'=>$base_uom[$key] ?? $request->po_uom_code[$key],
                    'base_qty'=>$base_qty[$key] ?? $request->purchase_quantity[$key],
                    'attribute2'=>$request->attribute2[$key] ?? '',
                    'line_type_id'=>1,
                    'line_status'=>1,
                    'attribute1' => $subtot,
                    'attribute2' => $attribute2,
                    'quantity_receive'=>0,
                    'organization_id'=>222,
                    'source_line_id'=>$line_number,
                    'item_description'=>$request->description_item[$key],
                    'line_number'=>$line_number,
                    'created_by_id'=>$request->created_by,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                );
                // dd($data);
                PurchaseOrderDet::create($data);
                $line_number++;
            }

        \DB::commit();
        }catch (Throwable $e){
            \DB::rollback();
		}
        break;

        case 'existing':
            // dd("enter existing");
            $head = PurchaseOrder::where('id',$request->segment1)->first();
            $vendor = $head->vendor_id;
            foreach($request->lines as $key =>$lines){
                $lines=RequisitionDetail::find($request->lines[$key]);
                $line_number = DB::table('bm_po_lines_all ')->where('po_header_id',$head->po_head_id)->latest()->first();
                // dd($line_number->line_id );
                $uom_conversion = UomConversion::where('inventory_item_id', $lines->inventory_item_id)->first();
                if ($uom_conversion){
                    if( $lines->pr_uom_code == $uom_conversion->interior_unit_code){
                        $base_uom = $uom_conversion->uom_code;
                        $base_qty = $lines->quantity / $uom_conversion->conversion_rate;
                        // dd($base_qty);
                    }else{
                        $base_uom = $lines->pr_uom_code;
                        $base_qty = $lines->quantity;
                    }
                }else{
                    $base_uom = $lines->pr_uom_code;
                    $base_qty = $lines->quantity;
                }
                $pr_uom = $lines->pr_uom_code;
                $item_id=$lines->inventory_item_id;
                $unit_price=app(\App\Http\Controllers\SearchController::class)->purchase_price($vendor,$item_id,$pr_uom,$vendor_site);
                $data = array(
                        'po_header_id'=>$head->po_head_id,
                        'line_id'=> $line_number->line_id +1,
                        'inventory_item_id'=>$lines->inventory_item_id,
                        'po_uom_code'=>$lines->pr_uom_code,
                        'unit_price'=>$unit_price,
                        'need_by_date'=>$lines->requested_date,
                        'po_quantity'=>$lines->quantity,
                        'base_uom'=>$base_uom,
                        'base_qty'=>$base_qty,
                        'attribute2'=>$lines->itemMaster->category_code,
                        'line_type_id'=>1,
                        'line_status'=>1,
                        'quantity_receive'=>0,
                        'organization_id'=>$line_number->organization_id,
                        'source_line_id'=>$lines->id,
                        'item_description'=>$lines->attribute1,
                        'tax_name'=>$lines->tax_name,
                        'line_status'=>$lines->line_status,
                        'attribute1'=>$head->segment1,
                        'line_number'=>(float)$lines->split_line_id,
                        'created_by_id'=>$request->created_by,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                    );
                    // dd($data);
                    PurchaseOrderDet::create($data);
                    RequisitionDetail::where('id',$lines->id)->update(['purchase_status'=>3]);
            }
            break;
        }
		return back();
    }
    public function edit($id)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		$purchaseorder=PurchaseOrder::where('po_head_id','=',$id)->get()->first();
        // dd($purchaseorder->status);
		$agent =PoAgent::all();
		$purchaseOrderDet=PurchaseOrderDet::where('po_header_id','=',$id)->whereNull('deleted_at')->get();
		$total = PurchaseOrder::with('PurchaseOrderDet')->find($id);
		$status =TrxStatuses::whereIn('trx_code', [1, 2, 13])->get();
		$term =Terms::all();
        $tax =Tax::where('type_tax_use','=','Purchase')->get();
        // dd($purchaseorder);
		return view('admin.purchase.edit',compact('purchaseorder','agent','purchaseOrderDet','status','term','tax'));
    }

    public function update(Request $request, PurchaseOrder $purchaseorder)
    {
        // dd($request);
        $head = PurchaseOrder::find($request->id);
        $head->segment1=$request->segment1;
        $head->status=$request->status;
        $head->agent_id=auth()->user()->id;
        $head->organization_id=$request->organization_id;
        $head->created_by=$request->created_by;
        $head->vendor_id=$request->vendor_id;
        $head->vendor_site_id=$request->vendor_site_id;
        $head->type_lookup_code=$request->type_lookup_code;
        $head->ship_to_location=$request->ship_to_location;
        $head->bill_to_location=$request->bill_to_location;
        $head->currency_code=$request->currency_code;
        $head->description=$request->description;
        $head->rate_date=$request->rate_date;
        $head->attribute2=$request->attribute2;
        $head->attribute_number1=$request->istructions;
        $head->notes=$request->notes;
        $head->attribute3=$request->attribute3;
        $head->freight=$request->freight;
        $head->term_id=$request->term_id;
        $head->ship_via_code=$request->ship_via_code;
		try {
			\DB::beginTransaction();
		    $head->save();
			foreach($request->inventory_item_id as $key =>$inventory_item_id){
				if(empty($request->line_id[$key])){
					  $data = array(
                            'po_header_id'=>$head->po_head_id,
							'line_id'=>PurchaseOrderDet::where('po_header_id','=',$head->po_head_id)->get()->count()+1,
                            'inventory_item_id'=>$request->inventory_item_id[$key],
                            'po_uom_code'=>$request->po_uom_code[$key],
                            'unit_price'=>$request->purchase_cost[$key],
                            'need_by_date'=>$request->need_by_date[$key],
                            'po_quantity'=>$request->purchase_quantity[$key],
                            'tax_name'=>$request->tax_id,
                            'line_type_id'=>1,
                            'organization_id'=>222,
							'line_status'=>1,
                            'item_description'=>$request->description_item[$key],
                            'attribute2'=>$request->category[$key],
							'created_by_id'=>$request->created_by,
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s'),
                        );
				        PurchaseOrderDet::create($data);
				}else{
                    $uom_conversion = UomConversion::where('inventory_item_id', $request->inventory_item_id[$key])->first();

                    $price = floatval(preg_replace('/[^\d.]/', '', $request->purchase_cost[$key]));
                    if ($uom_conversion){
                        if( $request->po_uom_code[$key] == $uom_conversion->interior_unit_code){
                            $base_uom = $uom_conversion->uom_code;
                            $base_qty = $request->purchase_quantity[$key] / $uom_conversion->conversion_rate;
                            $base_model_price = $price * $uom_conversion->conversion_rate;
                        }else{
                            $base_uom = $request->pr_uom_code;
                            $base_qty = $request->quantity;
                            $base_model_price = $price;
                        }
                    }else{
                        $base_uom = $request->pr_uom_code;
                        $base_qty = $request->quantity;
                        $base_model_price = $price;
                    }
				     $data = PurchaseOrderDet::find($request->po_line_id[$key]);
                     $data->id=$request->po_line_id[$key];
                     $data->inventory_item_id=$request->inventory_item_id[$key];
                     $data->po_quantity=$request->purchase_quantity[$key];
                     $data->po_uom_code=$request->po_uom_code[$key];
                     $data->base_model_price=$base_model_price;
                     $data->tax_name=$request->tax_id;
                     $data->unit_price=(float) str_replace('.', '',$request->purchase_cost[$key]);
                     $data->need_by_date=$request->need_by_date[$key];
					 $data->line_status=$request->status;
					 $data->attribute2=$request->category[$key];
					 $data->item_description=$request->description_item[$key];
                     $data->updated_at=date('Y-m-d H:i:s');
					 $data->save();
				}
			}
        \DB::commit();
			}catch (Throwable $e){
				\DB::rollback();
			}
	return back();
    }

    public function show($id)
    {
        // dd('why');
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $header = PurchaseOrder::where('type_lookup_code',1)
                                ->where('id','=',$id)
                                ->get();
        $data = PurchaseOrderDet::where('po_header_id','=',$id)
                                ->get();
        // $dompdf = new PDF();
        return view('admin.purchase.view',compact('header','data'));
    }

    public function destroy($id,Request $request)
    {

        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $process=PurchaseOrder::find($id)->delete();
       if ($process) {
        $response = ['status' => 'success', 'success' => true, 'message' => 'Record Has Been Deleted'];
    } else {
        $response = ['status' => 'error', 'success' => false, 'message' => 'Error'];
    }
       return $response;
    }

    public function massDestroy(PurchaseOrder $request)
    {
        PurchaseOrder::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function data(PurchaseOrder $purchaseorder)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $purchase_report = PurchaseOrderDet::where("line_status" ,"!=",11 )->orderBy('id','desc')->get();
        return view('admin.purchase.report', compact('purchase_report'));
    }
}

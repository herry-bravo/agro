<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionTypeRequest;
use App\Http\Requests\StoreRequisitionRequest;
use App\Http\Requests\UpdateTransactionTypeRequest;
use App\PurchaseOrder;
use App\RequisitionDetail;
use App\TrxStatuses;
use Gate;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequisitionDetailController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

         $purchaseRequisitionDet = PurchaseRequisitionDet::whereNotNull('authorized_status')->get();

		return view('admin.PurchaseRequisitionDet.index', compact('PurchaseRequisitionDet'));

      //return view('admin.itemMaster.createTabs', compact('itemMaster','uom','ItemType','Category'));
      
    }

    public function create()
    {
		$id = PurchaseRequisitionDet::latest('id')->first();
		$head = PurchaseRequisitionDet::findorNew($id->id+1);
		$head->segment1='PR'.str_pad($id->id+1, 6, "0", STR_PAD_LEFT);
		$number=$head->segment1;
		$head_id=$id->id+1;
        $head->created_by=auth()->user()->id;
		$head->transaction_date=date('d-M-Y');
        $head->updated_by=auth()->user()->id;
		//PurchaseRequisitionDet::where('id',$id->id)->whereNull('authorized_status')->delete();
		try {
			\DB::beginTransaction();
			$head->save();
			\DB::commit();
			} catch (Throwable $e) {
				\DB::rollback();
			}
		$users = User::all();
       return view('admin.PurchaseRequisitionDet.create',compact('users','number','head_id'));
    }

    public function store(StoreRequisitionRequest $request)
    {
		$head =PurchaseRequisitionDet::find($request->id);
		$head->segment1=$request->segment1;
        $head->authorized_status=$request->authorized_status;
        $head->transaction_date=$request->transaction_date;
        $head->created_by=$request->created_by;
        $head->updated_by=$request->updated_by;
        $head->requested_by=$request->requested_by;
        $head->attribute1=$request->attribute1;
        $head->description=$request->description;
			try {
			\DB::beginTransaction();
				$head->save();
				foreach($request->inventory_item_id as $key =>$inventory_item_id){
				$data = array(
                            'header_id'=>$request->id,
                            'line_id'=>$key+1 ,
                            'split_line_id'=>$key+1 ,
                            'inventory_item_id'=>$request->inventory_item_id[$key],
                            'quantity'=>$request->quantity[$key],
                            'pr_uom_code'=>$request->pr_uom_code[$key],
                            'estimated_cost'=>$request->estimated_cost[$key],
                            'created_by'=>$request->created_by,
                            'updated_by'=>$request->updated_by,
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s'),
                );
             PurchaseRequisitionDet::create($data); 
            }
			\DB::commit();
			}catch (Throwable $e){
				\DB::rollback();
			}
     return redirect()->route('admin.purchase-requisition.index');
    }
    public function edit(PurchaseRequisitionDet $purchaseRequisitionDet)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		$users =User::all();
		$PurchaseRequisitionDet=PurchaseRequisitionDet::where('header_id','=',$PurchaseRequisitionDet->id)->whereNull('deleted_at')->get();
	    return view('admin.PurchaseRequisitionDet.edit', compact('PurchaseRequisitionDet','users','PurchaseRequisitionDet'));
    }

    public function update(UpdateTransactionTypeRequest $request, TransactionType $transactionType)
    {
        $transactionType->update($request->all());

        return redirect()->route('admin.transaction-types.index');
    }

    public function show(PurchaseRequisitionDet $purchaseRequisitionDet)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

     //   return view('admin.purchaseRequisition.show', compact('purchaseRequisition'));
    }

    public function destroy(RequisitionDetail $requisitionDetail)
    {
       abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisitionDetail->delete();
        return back();
    }

    public function massDestroy(MassDestroyTransactionTypeRequest $request)
    {
        TransactionType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

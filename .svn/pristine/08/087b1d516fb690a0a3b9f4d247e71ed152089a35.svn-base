<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionTypeRequest;
use App\Http\Requests\StoreRequisitionRequest;
use App\Http\Requests\UpdateTransactionTypeRequest;
use App\PurchaseOrder;
use App\PurchaseRequisition;
use App\RequisitionDetail;
use App\ItemMaster;
use App\TrxStatuses;
use App\Comments;
use Gate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class PurchaseRequisitionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('purchaseOrder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //  $purchaseRequisition = PurchaseRequisition::whereNotNull('authorized_status')
        //  ->join('users AS usr', 'usr.id', '=', 'bm_req_header_all.created_by')
        //  ->select('bm_req_header_all.*', 'usr.id as uid','usr.user_manager as usrmgr')
        //  ->OrderBy('created_at','asc')->get();
	 return view('admin.purchaseRequisition.index');

    }
    public function create()
    {
		//$id = PurchaseRequisition::latest('id')->first();
        $id =DB::table('bm_req_header_all')->get('id')->last();
		$head = PurchaseRequisition::findorNew($id->id+1);
		$head->segment1='PR'.str_pad($id->id+1, 6, "0", STR_PAD_LEFT);
		$number=$head->segment1;
		$head_id=$id->id+1;
        $head->created_by=auth()->user()->id;
		$head->transaction_date=date('d-M-Y');
        $head->updated_by=auth()->user()->id;
		//PurchaseRequisition::where('id',$id->id)->whereNull('authorized_status')->delete();
		try {
			\DB::beginTransaction();
			$head->save();
			\DB::commit();
			} catch (Throwable $e) {
				\DB::rollback();
			}
		$users = User::all();
        $auth = Auth::user();
        // dd($users);
       return view('admin.purchaseRequisition.create',compact('users','number','head_id','auth'));
    }

    public function store(StoreRequisitionRequest $request)
    {

        $header_id =DB::table('bm_req_header_all')->get()->last();
        // $header_id = $header_id->id;
        $head =PurchaseRequisition::findOrNew($request->id);
        $head->req_header_id = $header_id->id;
		$head->segment1=$request->segment1;
        $head->authorized_status=$request->authorized_status;
        $head->transaction_date=$request->transaction_date;
        $head->created_by=$request->created_by;
        $head->reference=$request->ref;
        $head->updated_by=$request->updated_by;
        $head->requested_by=$request->requested_by;
        $head->attribute1=$request->attribute1;
        $head->app_lvl=$request->ref;
        $head->description=$request->description;

			try {
			\DB::beginTransaction();
				$head->save();
				foreach($request->inventory_item_id as $key =>$inventory_item_id){

                //image
                $image = $request->img_path[$key] ?? NULL;
                if($image != NULL){
                    $input['imagename'] =$request->segment1.'-'.$key+1 .'.'.$image->extension();
                    $filePath2 = public_path('/images/container');
                    $image->move($filePath2, $input['imagename']);
                    $path = '/images/container/'.$input['imagename'];
                }else{
                    $path = '';
                }

				$data = array(
                            'header_id'=>$request->id,
                            'line_id'=>$key+1 ,
                            'split_line_id'=>$key+1 ,
                            'inventory_item_id'=>$request->inventory_item_id[$key],
                            'quantity'=>$request->quantity[$key],
                            'attribute1'=>$request->description_item[$key],
                            'pr_uom_code'=>$request->pr_uom_code[$key],
                            'requested_date'=>$request->requested_date[$key],
                            'attribute2'=>$request->sub_category[$key],
                            'estimated_cost'=>$request->estimated_cost[$key],
                            'img_path'=>$path,
                            'created_by'=>$request->created_by,
                            'updated_by'=>$request->updated_by,
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s'),
                );
                RequisitionDetail::create($data);
            }
			\DB::commit();
			}catch (Throwable $e){
				\DB::rollback();
			}
     return redirect()->route('admin.purchase-requisition.index');
    }
    public function edit(PurchaseRequisition $purchaseRequisition,Request $request)
    {


      //  abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		$users =User::all();
		$status =TrxStatuses::whereIn('trx_code', [1, 2, 13])->get();
		$requisitionDetail=RequisitionDetail::where('header_id','=',$purchaseRequisition->id)->whereNull('deleted_at')->get();
        switch ($request->input('action')) {
            case 'mgr':
	     return view('admin.purchaseRequisition.appMgr', compact('purchaseRequisition','users','requisitionDetail','status'));
            case '' :
         return view('admin.purchaseRequisition.edit', compact('purchaseRequisition','users','requisitionDetail','status'));
            }
    }

    public function update(Request $request, PurchaseRequisition $purchaseRequisition,RequisitionDetail $requisitionDetail)
    {

        switch ($request->input('action')) {
        case 'save':
        $head =PurchaseRequisition::findorNew($request->id);
		$head->segment1=$request->segment1;
        $head->authorized_status=$request->authorized_status;
        $head->transaction_date=$request->transaction_date;
        $head->created_by=$request->created_by;
        $head->updated_by=$request->updated_by;
        $head->reference=$request->ref;
        $head->requested_by=$request->requested_by;
        $head->attribute1=$request->attribute1;
        $head->description=$request->description;
        // dd($head);
		try {
			\DB::beginTransaction();
             $head->save();
			count($request->inventory_item_id);
			foreach($request->inventory_item_id as $key =>$inventory_item_id){

				if(empty($request->lineId[$key])){

					$data = array(
                            'header_id'=>$request->id,
                            'line_id'=>RequisitionDetail::where('header_id',$request->id)->get()->count()+1 ,
                            'split_line_id'=>$key+1 ,
                            'inventory_item_id'=>$request->inventory_item_id[$key],
                            'quantity'=>$request->quantity[$key],
                            'pr_uom_code'=>$request->pr_uom_code[$key],
                            'estimated_cost'=>$request->estimated_cost[$key],
                            'attribute1'=>$request->description_item[$key],
                            'attribute2'=>$request->sub_category[$key],
                            'requested_date'=>$request->requested_date[$key],
							'purchase_status'=>$request->authorized_status,
                            'created_by'=>$request->created_by,
                            'updated_by'=>$request->updated_by,
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s'),
                );
				RequisitionDetail::create($data);
				}else{

				  $data = RequisitionDetail::find($request->lineId[$key]);
                     $data->inventory_item_id=$request->inventory_item_id[$key];
                     $data->quantity=$request->quantity[$key];
                     $data->pr_uom_code=$request->pr_uom_code[$key];
                     $data->estimated_cost=$request->estimated_cost[$key];
                     $data->attribute1=$request->description_item[$key];
                     $data->attribute2=$request->sub_category[$key];
                     $data->requested_date=$request->requested_date[$key];
					// $data->purchase_status=$request->authorized_status;
                     $data->created_by=$request->created_by;
                     $data->updated_by=$request->updated_by;
                     $data->created_at=date('Y-m-d H:i:s');
                     $data->updated_at=date('Y-m-d H:i:s');
					 $data->save();
				}
			}
			\DB::commit();
			}catch (Throwable $e){
				\DB::rollback();
			}
            break;
            case 'add_lines':
                $new_split_lines = RequisitionDetail::find( $request->req_line_id);
                if($request->split_quantity >$new_split_lines->quantity){
                    return back()->with('error','Quantity Not Enought');
                }else{
                    $new_lines = array(
                        'header_id'=> $new_split_lines->header_id,
                        'line_id'=> $new_split_lines->line_id,
                        'split_line_id'=> RequisitionDetail::where(['header_id'=>$new_split_lines->header_id,'line_id'=>$new_split_lines->line_id])->latest()->first()->split_line_id+0.1,
                        'inventory_item_id'=>$new_split_lines->inventory_item_id,
                        'quantity'=>$request->split_quantity,
                        'pr_uom_code'=>$new_split_lines->pr_uom_code,
                        'estimated_cost'=>$new_split_lines->estimated_cost,
                        'attribute1'=>$new_split_lines->attribute1,
                        'attribute2'=>$new_split_lines->attribute2,
                        'requested_date'=>$new_split_lines->requested_date,
                        'purchase_status'=>$new_split_lines->purchase_status,
                        'created_by'=>$new_split_lines->created_by,
                        'updated_by'=>$new_split_lines->updated_by,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                    );
                    RequisitionDetail::create($new_lines);
                    RequisitionDetail::where(['id'=>$request->req_line_id])->update(["quantity"=>  $new_split_lines->quantity-$request->split_quantity]);
                    break;
                }
        }
	return back();
	}

    public function show(Request $request,$id)
    {
        abort_if(Gate::denies('requisition_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->post('action')=="pr"){
            $purchaseRequisition=PurchaseRequisition::whereBetween('segment1',[$request->post('prfrom'),$request->post('prto')])->whereNotNull('authorized_status')->get();
            foreach ($purchaseRequisition as $key => $value)
            {
                $qry[$key]= $value->id;
            }
            $comment=Comments::whereIn('app_header_id',$qry)->get();
           $requisitionDetail = RequisitionDetail::whereIn('header_id',$qry)->get();

         return view('admin.purchaseRequisition.show', compact('purchaseRequisition', 'requisitionDetail','comment'));
        }else{
            $purchaseRequisition=PurchaseRequisition::whereBetween('id',[$id,$id])->whereNotNull('authorized_status')->get();
            $head=PurchaseRequisition::where('id',$id)->first()->updated_by;
            $user=User::where('id',$head)->first()->name;
            foreach ($purchaseRequisition as $key => $value)
            {
                $qry[$key]= $value->id;
            }
           $requisitionDetail = RequisitionDetail::whereIn('header_id',$qry)->get();
           $comment=Comments::whereIn('app_header_id',$qry)->get();
        return view('admin.purchaseRequisition.show', compact('purchaseRequisition', 'requisitionDetail','comment','user'));
      }
    }

    public function destroy(PurchaseRequisition $purchaseRequisition)
    {
       abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $process=$purchaseRequisition->delete();

        if ($process) {
            $response = ['status' => 'success', 'success' => true, 'message' => 'Record Has Been Deleted'];
        } else {
            $response = ['status' => 'error', 'success' => false, 'message' => 'Error'];
        }
           return $response;
    }

    public function massDestroy(MassDestroyTransactionTypeRequest $request)
    {
        TransactionType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

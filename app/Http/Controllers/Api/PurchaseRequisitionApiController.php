<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Helper\responapi\responapi;
use Illuminate\Http\Request;
use App\PurchaseRequisition;
use App\User;
use App\Comments;
use App\RequisitionDetail;

class PurchaseRequisitionApiController extends Controller
{
    public function purchaserequisition(Request $request){
        try{
            $api_token =  User::where('api_token', $request->header('apitoken'))->first();
            // if($api_token) {
                $records = PurchaseRequisition::orderBy('bm_req_header_all.created_at','desc')
                ->join('users','users.id','=','bm_req_header_all.updated_by')
                ->whereNotNull('app_lvl')
                ->select('bm_req_header_all.*','users.name')->get();
                $data_arr = array();
                foreach ($records as $raw) {
                    $data_arr[] = array(
                        "id" =>$raw->id,
                        "pr_number" => $raw->segment1,
                        "user" =>$raw->user->name ??'',
                        "status" => $raw->authorized_status ?? '' ,
                        "created_at" => $raw->created_at->format('d-m-Y'),
                        "updated_at" =>$raw->updated_at->format('d-m-Y'),
                        "action" =>$raw->user->name ?? '',
                        "intattribute1" =>$raw->intattribute1,
                        "created_by" =>$raw->created_by,
                        "app_lvl" =>$raw->app_lvl,
                        "updatedby" =>$raw->name,
                        "next_approve" =>User::where('user_status','=',$raw->app_lvl)->first()->name ??'',
                        // "login" =>auth()->user()->id,
                    //     "user_manager" =>auth()->user()->userManager->name ?? '',
                    //     "usrmgr" =>(int)$raw->getAppMgr->user_manager ?? '',
                    //     "userstatus" =>auth()->user()->user_status ?? '',
                    );
                }
                // dd($data_arr);
                return responapi::success([
                    'message' => 'Data is Loaded',
                    'porequisation' =>$data_arr,
                ],'Success Boss', 200);
            // }else{
            //     return responapi::error([
            //         'message' => 'Di mana tokennya?',
            //     ],'Authentication Failed', 401);
            // }
        }catch(Exception $error){
            return responapi::error([
                'message' => 'Something went wrong',
                'error' => $error->getMessage(),
            ],'Authentication Failed', 401);
        }
    }
    public function purchaserequisitionDetail(Request $request){
        try{
            $api_token =  User::where('api_token', $request->header('apitoken'))->first();
            if($api_token){
                $requisitionDetail = RequisitionDetail::where('header_id',$request->detail)->orderBy('created_at','desc')->get();
                $array = array();
                foreach ($requisitionDetail as $raw) {
                    $array[] = array(
                        "id" =>$raw->id,
                        "header"=>$raw->header_id,
                        "attribute1"=>$raw->attribute1,
                        "pr_uom_code"=>$raw->pr_uom_code,
                        "quantity"=>$raw->quantity,
                        "estimated_cost"=>$raw->estimated_cost,
                        "created_at"=>$raw->created_at,
                    );
                }
                return responapi::success([
                    'message' => 'Data is Loaded',
                    'porequisationDetail' =>$array,
                ],'Success Boss', 200);
            }else{
                return responapi::error([
                    'message' => 'Di mana tokennya?',
                ],'Authentication Failed', 401);
            }
        }catch(Exception $error){
            return responapi::error([
                'message' => 'Something went wrong',
                'error' => $error->getMessage(),
            ],'Authentication Failed', 401);
        }
    }
    public function purchaseorderReqApproval(Request $request){
        try{
            $validated = $request->validate([
                'authorized_status' => 'required',
                'app_lvl_id' => 'required',
                'api_token' => 'required',
                'comments'=>'required',
            ]);
            // dd($validated);
            if($request->api_token){
                $getUserID = User::where('api_token',$request->api_token)->first();
                // dd($getUserID->userID);
                $createnote = array(
                    'app_header_id'=>$request->id,
                    'comments'=>$request->comments,
                    'app_lvl_id'=>$request->app_lvl_id,
                    'userID'=>$getUserID->userID,
                );
                $noted = Comments::create($createnote);

                if($request->app_lvl_id == 1){
                    $case1=PurchaseRequisition::where(['id'=>$request->id])
                    ->update(["app_lvl"=>$request->app_lvl_id+1,"intattribute1"=>$request->app_lvl_id+1]);
                    return responapi::success([
                        'message' => 'Data is Loaded 1',
                        'apitoken'=>$request->api_token,
                        'poreqApprovalcase' =>$case1,
                    ],'Success Boss', 200);
                }elseif($request->app_lvl_id == 2){
                    $case2 = PurchaseRequisition::where(['id'=>$request->id])
                    ->update(["app_lvl"=>$request->app_lvl_id+1,"intattribute2"=>$request->app_lvl_id]);
                    return responapi::success([
                        'message' => 'Data is Loaded 2',
                        'apitoken'=>$request->api_token,
                        'poreqApprovalcase' =>$case2,
                    ],'Success Boss', 200);
                }elseif($request->app_lvl_id == 3){
                    $case3=PurchaseRequisition::where(['id'=>$request->id])
                    ->update(["app_lvl"=>12,"authorized_status"=>$request->authorized_status]);
                    RequisitionDetail::where(['header_id'=>$request->id])
                    ->update(["purchase_status"=>$request->authorized_status]);
                    return responapi::success([
                        'message' => 'Data is Loaded 3',
                        'apitoken'=>$request->api_token,
                        'poreqApprovalcase' =>$case3,
                    ],'Success Boss', 200);
                }elseif($request->app_lvl_id == 4){
                    $case4=PurchaseRequisition::where(['id'=>$request->id])
                    ->update(["app_lvl"=>12,"authorized_status"=>$request->authorized_status]);
                    RequisitionDetail::where(['header_id'=>$id])->update(["purchase_status"=>$request->authorized_status]);
                    return responapi::success([
                        'message' => 'Data is Loaded 4',
                        'apitoken'=>$request->api_token,
                        'poreqApprovalcase' =>$case4,
                    ],'Success Boss', 200);
                }else{
                    $process=PurchaseRequisition::where(['id'=>$request->id])->update(["app_lvl"=>$request->app_lvl_id]);
                    return responapi::success([
                        'message' => 'Data is Loaded 12',
                        'apitoken'=>$request->api_token,
                        'poreqApprovalcase' =>$process,
                    ],'Success Boss', 200);
                }
            }else{
                return responapi::error([
                    'message' => 'Di mana tokennya?',
                ],'Authentication Failed', 401);
            }
        }catch(Exception $error){
            return responapi::error([
                'message' => 'Something went wrong',
                'error' => $error->getMessage(),
            ],'Authentication Failed', 401);
        }
    }
    public function purchaseorderReqRejected(Request $request){
        try{
            $validated = $request->validate([
                'authorized_status' => 'required',
                'app_lvl_id' => 'required',
                'api_token' => 'required',
                'comments'=>'required',
            ]);
            // dd($validated);
            if($request->api_token){
                $getUserID = User::where('api_token',$request->api_token)->first();
                $createnote = array(
                    'app_header_id'=>$request->id,
                    'comments'=>$request->comments,
                    'app_lvl_id'=>$request->app_lvl_id,
                    'userID'=>$getUserID->userID,
                );
                $noted = Comments::create($createnote);

                $rejected=PurchaseRequisition::where(['id'=>$request->id])
                ->update(["app_lvl"=>$request->app_lvl_id,"intattribute1"=>$request->app_lvl_id,
                "updated_by"=>$getUserID->id,"authorized_status"=>$request->authorized_status]);

                return responapi::success([
                    'message' => 'Data is Loaded',
                    'apitoken'=>$request->api_token,
                    'poreqApprovalcase' =>$rejected,
                ],'Rejected Success Boss', 200);
            }else{
                return responapi::error([
                    'message' => 'Di mana tokennya?',
                ],'Authentication Failed', 401);
            }
        }catch(Exception $error){
            return responapi::error([
                'message' => 'Something went wrong',
                'error' => $error->getMessage(),
            ],'Authentication Failed', 401);
        }
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\InvOnhandFG;
use App\Helper\responapi\responapi;
use Carbon\Carbon;

class AllocationApiController extends Controller
{
    public function search(Request $request){
        try{
        $data = InvOnhandFG::select('bm_inv_onhand_fg_detail.attribute_char as product_id','item.item_code as item_code',
                            'bm_inv_onhand_fg_detail.uniq_attribute_roll as product_code','bm_inv_onhand_fg_detail.attribute_location as location',
                            'bm_inv_onhand_fg_detail.reference as warehouse','bm_inv_onhand_fg_detail.primary_quantity as product_qty',
                            'bm_inv_onhand_fg_detail.attribute_number_gsm as product_gsm','bm_inv_onhand_fg_detail.attribute_number_w as product_width',
                            'bm_inv_onhand_fg_detail.attribute_number as updated_by','bm_inv_onhand_fg_detail.updated_at')
                            ->leftJoin('bm_mtl_system_item as item', 'bm_inv_onhand_fg_detail.inventory_item_id','=','item.inventory_item_id')
                            // ->whereYear('bm_inv_onhand_fg_detail.created_at', Carbon::now()->year)
                            ->where('bm_inv_onhand_fg_detail.wip_status_flag',1);
        $data = $data->get();
        // foreach ($data as $row){
        //     $update =InvOnhandFG::where('attribute_char',$row->product_id)->update(["wip_status_flag"=>2]);
        // }
        return $data;
        }catch(Exception $error){
            return responapi::error([
                'message' => 'Something went wrong',
                'error' => $error->getMessage(),
            ],'Authentication Failed', 401);
        }
    }
    public function update(Request $request){
        $data = json_decode($request->data);
        // dd($data);
        $save = true;
           $product = InvOnhandFG::where('attribute_char',$data->product_id)->first();
            if($product){
                $save =InvOnhandFG::where('attribute_char',$data->product_id)->update(['wip_status_flag'=>2]);
            }
        if($save){
            $response = ['status' => 'success', 'success' => true, 'message' => 'Saved'];
        }else{
            $response = ['status' => 'error', 'success' => false, 'message' => 'Failure'];
        }

        return $response;
    }
    public function sync(Request $request)
    {
        // dd($request->data);

       $data = json_decode($request->data);
        $save = true;
           $product = InvOnhandFG::where('attribute_char',$data->product_id)->first();
            if($product){
                $save =InvOnhandFG::where('attribute_char',$data->product_id)->update(['attribute_location'=>$data->location]);
            }
        if($save){
            $response = ['status' => 'success', 'success' => true, 'message' => 'Saved'];
        }else{
            $response = ['status' => 'error', 'success' => false, 'message' => 'Failure'];
        }

        return $response;
    }
}

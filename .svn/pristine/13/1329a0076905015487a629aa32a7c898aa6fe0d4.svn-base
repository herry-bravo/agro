<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Helper\responapi\responapi;
use Illuminate\Http\Request;
use Gate;
use Exception;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Throwable;
class TransferController extends Controller
{
    public function transfer(Request $request){
        try{
            $itemcode=$request->header('itemcode');
            if($itemcode==null){
                $transfer = \App\MaterialTxns::orderBy('created_at','desc')->get();
                $trfarray = array();
                foreach ($transfer as $raw) {
                    $trfarray[] = array(
                        "id" =>$raw->inventory_item_id,
                        "item_code" => $raw->itemmaster->item_code?? '',
                        "description" =>$raw->itemmaster->description??'',
                        "category" =>$raw->itemmaster->attribute2??'',
                        "type_code" =>$raw->transaction_uom??'',
                        "transaction_reference" => $raw->transaction_reference??'',
                        "subinventory_code" =>$raw->subinventory->description??'',
                        "subinv_code"=>$raw->subinventory_code??'',
                        "transfer_subinventory" => $raw->tfsubinventory->description??'',
                        "trf_subinv"=>$raw->transfer_subinventory??'',
                        "transaction_quantity" => number_format($raw->transaction_quantity,0),
                        "primary_uom_code" => $raw->transaction_uom,
                        "transaction_date" => $raw->transaction_date->format('d-M-Y'),
                    );
                }
                return responapi::success([
                    'message' => 'Data is Loaded',
                    'transfer' =>$trfarray,
                ],'Success Boss', 200);
            }
            else{
                $transfer = \App\MaterialTxns::orderBy('bm_inv_material_txns.created_at','desc')
                ->leftjoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_inv_material_txns.inventory_item_id')
                ->where('bm_mtl_system_item.item_code','LIKE','%'.$itemcode.'%')->get();
                foreach ($transfer as $raw) {
                    $trfarray[] = array(
                        "id" =>$raw->inventory_item_id,
                        "item_code" => $raw->itemmaster->item_code?? '',
                        "description" =>$raw->itemmaster->description??'',
                        "category" =>$raw->itemmaster->attribute2??'',
                        "type_code" =>$raw->transaction_uom??'',
                        "transaction_reference" => $raw->transaction_reference??'',
                        "subinventory_code" =>$raw->subinventory->description??'',
                        "subinv_code"=>$raw->subinventory_code??'',
                        "transfer_subinventory" => $raw->tfsubinventory->description??'',
                        "trf_subinv"=>$raw->transfer_subinventory??'',
                        "transaction_quantity" => number_format($raw->transaction_quantity,0),
                        "primary_uom_code" => $raw->transaction_uom,
                        "transaction_date" => $raw->transaction_date->format('d-M-Y'),
                    );
                }
                return responapi::success([
                    'message' => 'Data is Loaded',
                    'transfer' =>$trfarray,
                ],'Success Boss', 200);
            }
        }catch(Exception $error){
            return responapi::error([
                'message' => 'Something went wrong',
                'error' => $error->getMessage(),
            ],'Authentication Failed', 401);
        }

    }
    public function searchtransfer(Request $request){
        try{
            $api_token =  \App\User::where('api_token', $request->apitoken)->first();
            if($api_token){
                $transfer = \App\MaterialTxns::orderBy('bm_inv_material_txns.created_at','desc')
                ->leftjoin('bm_mtl_system_item','bm_mtl_system_item.inventory_item_id','=','bm_inv_material_txns.inventory_item_id')
                ->where('bm_mtl_system_item.item_code','=',$request->item_code)->get();
                foreach ($transfer as $raw) {
                    $trfarray[] = array(
                        "id" =>$raw->inventory_item_id,
                        "item_code" => $raw->itemmaster->item_code?? '',
                        "description" =>$raw->itemmaster->description??'',
                        "category" =>$raw->itemmaster->attribute2??'',
                        "type_code" =>$raw->transaction_uom??'',
                        "transaction_reference" => $raw->transaction_reference??'',
                        "subinventory_code" =>$raw->subinventory->description??'',
                        "subinv_code"=>$raw->subinventory_code??'',
                        "transfer_subinventory" => $raw->tfsubinventory->description??'',
                        "trf_subinv"=>$raw->transfer_subinventory??'',
                        "transaction_quantity" => number_format($raw->transaction_quantity,0),
                        "primary_uom_code" => $raw->transaction_uom,
                        "transaction_date" => $raw->transaction_date->format('d-M-Y'),
                    );
                }
                return responapi::success([
                    'message' => 'Data is Loaded',
                    'transfer' =>$trfarray,
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
}

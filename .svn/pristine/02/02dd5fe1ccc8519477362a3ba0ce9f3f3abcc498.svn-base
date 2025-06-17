<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Vendor;
use App\Helper\responapi\responapi;

class VendorApiController extends Controller
{
    public function vendor(Request $request){
        try{
            $api_token =  User::where('api_token', $request->header('apitoken'))->first();
            if($api_token) {
                $vendor =Vendor::orderBy('id','desc')->get();
                // dd($vendor);
                $data_arr = array();
                foreach ($vendor as $raw) {
                    $data_arr[] = array(
                        "id" =>$raw->id,
                        "vendor_name" =>$raw->vendor_name,
                        "email" =>$raw->email,
                        "address1" =>$raw->address1,
                        "city" =>$raw->city,
                        "province" =>$raw->province,
                        "country" =>$raw->country,
                    );
                }
                return responapi::success([
                    'message' => 'Data is Loaded',
                    'vendor' =>$data_arr,
                ],'Success Boss', 200);
                return $vendor;
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

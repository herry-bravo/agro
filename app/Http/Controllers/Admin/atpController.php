<?php

namespace App\Http\Controllers\admin;
use App\User;
use App\AtpReply;
use Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class atpController extends Controller
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

        $checked_array=$request->line_number;
        $line_id=1;
        foreach ($request->check as $key => $value){
            if(in_array($request->check[$key],$checked_array)){
                $data = array(
                        'po_header_id'=>isset($request->po_header_id[$key])? $request->po_header_id[$key] :'',
                        'po_line_id'=>isset($request->check[$key])? $request->check[$key] :'',
                        'atp_price'=>isset($request->price[$key])? $request->price[$key] :'',
                        'item_description'=>isset($request->description[$key])? $request->description[$key] :'',
                        'inventory_item_id'=>isset($request->inventory_item_id[$key])? $request->inventory_item_id[$key] :'',
                        'atp_qty'=>isset($request->qty[$key])? $request->qty[$key] :'',
                        'order_number'=>isset($request->orderno)? $request->orderno:'',
                        'reference'=>isset($request->reference)? $request->reference:'',
                        'reference'=>isset($request->reference)? $request->reference:'',
                        'etd_atp'=>isset($request->etd)? $request->etd:'',
                        'eta_atp'=>isset($request->eta)? $request->eta:'',
                        'created_at'=> date('Y-m-d H:i:s'),
                        'updated_at'=> date('Y-m-d H:i:s'),
                );
                $process= AtpReply::create($data);
            }


        }

        if ($process) {
            $response = ['status' => 'success', 'success' => true, 'message' => 'Record Has Been Deleted'];
        } else {
            $response = ['status' => 'error', 'success' => false, 'message' => 'Error'];
        }
           return $response;


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
    public function update(Request $request, $id)
    {
        //
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
}

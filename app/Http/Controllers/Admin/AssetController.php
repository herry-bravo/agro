<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Asset;
use App\AssetLineDepreciation;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.asset.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $acc = \App\AccountCode::All();
         $category = \App\AssetCatagory::All();
         $curr = \App\Currency::where('currency_status',1)->get();
         return view('admin.asset.create',compact('acc','category','curr'));
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
        // dd($request->depreciation_date);
        $head = Asset::findorNew($request->id);
        $head->name=$request->name;
        $head->value=$request->value;
        $head->currency_id=$request->currency_id;
        $head->company_id=$request->company_id;
        $head->category_id=$request->category_id;
        $head->method=$request->method;
        $head->method_number=$request->method_number;
        $head->method_period=$request->method_period;
        $head->method_end=$request->method_end;
        $head->method_progress_factor=$request->method_progress_factor;
        $head->method_time=$request->method_time;
        $head->prorata=$request->prorata;
        $head->salvage_value=$request->salvage_value;
        $head->invoice_id=$request->invoice_id;
        $head->create_date=$request->create_date;
        $head->note=$request->note;
        $head->create_uid=auth()->user()->id;

		try {
			\DB::beginTransaction();
			$head->save();
            $asset_id = Asset::latest()->first()->id;
            foreach ($request->depreciation_date as $key => $depreciation_date){
                $data = array(
                    'sequence'=>$key+1,
                    'asset_id'=>$asset_id,
                    'amount'=>$request->amount[$key],
                    'remaining_value'=>$request->remaining_value[$key],
                    'depreciated_value'=>$request->depreciated_value[$key],
                    'depreciation_date'=>$request->depreciation_date[$key],
                    'create_date'=>$request->create_date,
                    'create_uid'=> auth()->user()->id,
                );
                // dd($data);
                AssetLineDepreciation::create($data);
            }
        \DB::commit();
        }catch (Throwable $e){
            \DB::rollback();
        }

        // dd($asset_id);
        return redirect()->route('admin.asset.index')->with('success', 'Data Is Inputed');
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
         $asset = Asset::find($id);
         $acc = \App\AccountCode::All();
         $category = \App\AssetCatagory::All();
         $curr = \App\Currency::where('currency_status',1)->get();
         $line = AssetLineDepreciation::where('asset_id',$id)->get();
         return view('admin.asset.edit',compact('acc','category','curr','asset', 'line'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {
        //
        // $asset->update($request->all());
        $head = Asset::find($request->id);
        $head->name=$request->name;
        $head->value=$request->value;
        $head->currency_id=$request->currency_id;
        $head->company_id=$request->company_id;
        $head->category_id=$request->category_id;
        $head->method=$request->method;
        $head->method_number=$request->method_number;
        $head->method_period=$request->method_period;
        $head->method_end=$request->method_end;
        $head->method_progress_factor=$request->method_progress_factor;
        $head->method_time=$request->method_time;
        $head->prorata=$request->prorata;
        $head->salvage_value=$request->salvage_value;
        $head->invoice_id=$request->invoice_id;
        $head->create_date=$request->create_date;
        $head->create_uid=auth()->user()->id;

		try {
			\DB::beginTransaction();
			$head->save();
            // dd($request->line_id);
                if(empty($request->line_id)){
                    AssetLineDepreciation::where('asset_id',$request->id)
                                         ->where('created_at','!=',date('Y-m-d H:i:s'))->forceDelete();
                    foreach ($request->depreciation_date as $key => $depreciation_date){
                        $data = array(
                            'sequence'=>$key+1,
                            'asset_id'=>$request->id,
                            'amount'=>$request->amount[$key],
                            'remaining_value'=>$request->remaining_value[$key],
                            'depreciated_value'=>$request->depreciated_value[$key],
                            'depreciation_date'=>$request->depreciation_date[$key],
                            'create_date'=>$request->create_date,
                            'create_uid'=> auth()->user()->id,
                        );
                        // dd($data);
                        AssetLineDepreciation::create($data);
                    }
                }else{
                    foreach ($request->lineId as $key => $line){
                        $data = AssetLineDepreciation::find($request->lineId[$key]);
                        $data->amount =floatval(preg_replace('/[^\d.]/', '', $request->amount[$key]));
                        $data->remaining_value =floatval(preg_replace('/[^\d.]/', '', $request->remaining_value[$key]));
                        $data->depreciated_value =floatval(preg_replace('/[^\d.]/', '', $request->depreciated_value[$key]));
                        $data->depreciation_date =$request->depreciation_date[$key];
                        $data->updated_at =date('Y-m-d H:i:s');
                        // dd($data);
                        $data->save();
                    }
                }
        \DB::commit();
        }catch (Throwable $e){
            \DB::rollback();
        }
        return redirect()->route('admin.asset.index')->with('success', 'Data Is Updated');
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

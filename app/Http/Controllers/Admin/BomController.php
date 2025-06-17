<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreBOMRequest;
use App\ItemMaster;
use App\Bom;
use DB;
use Gate;

class BomController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $bom = Bom::All();
        // $rowSpan = DB::table('bm_bom_bill_of_mtl_interface')
        //         ->select(DB::raw('count(parent_inventory_it)'))
        //         ->groupBy('parent_inventory_it')
        //         ->get();
        return view('admin.bom.index', compact('bom'));

    }

    public function create()
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $bom = Bom::All();
		return view('admin.bom.create',compact('bom'));
    }

    public function store(StoreBOMRequest $request)
    {
        // dd($request->subinventory);
		try {
			\DB::beginTransaction();
            // dd($request->supply_subinventory);
            foreach($request->child_inventory_id as $key =>$child_inventory_id){
                    $chilItem = Bom::where(['child_inventory_id'=>$request->child_inventory_id[$key],'parent_inventory_it'=>$request->parent_inventory_it])->first();
                    // dd($chilItem);
                    if($chilItem){
                        return back()->with('error', 'Duplicate Entry Of Child Item');
                    }else{
                        $data = array(
                            'parent_inventory_it'=>$request->parent_inventory_it,
                            'parent_item'=>$request->parent_item,
                            'parent_item_type'=>$request->parent_item_type,
                            'parent_description'=>$request->parent_description,
                            'substitute_quantity'=>$request->substitute_quantity,
                            'effectivity_date'=>$request->effectivity_date,
                            'completion_subinventory'=>$request->completion_subinventory,
                            'item_num'=>$key+1,
                            'child_inventory_id'=>isset($request->child_inventory_id[$key])? $request->child_inventory_id[$key] :'',
                            'child_item'=>isset($request->child_item[$key])? $request->child_item[$key] :'',
                            'child_item_type'=>isset($request->child_item_type[$key])? $request->child_item_type[$key] :'',
                            'child_description'=>isset($request->child_description[$key])? $request->child_description[$key] :'',
                            'uom'=>isset($request->uom[$key])? $request->uom[$key] :'',
                            'usage'=>isset($request->usage[$key])? $request->usage[$key] :'',
                            'standard_cost'=>isset($request->standard_cost[$key])? $request->standard_cost[$key] :'',
                            'supply_subinventory'=>$request->supply_subinventory[$key] ,
                            'created_by'=>$request->created_by,
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s'),
                            );
                            // dd($data);
                            Bom::create($data);
                    }

			}
            // dd ($data);
			\DB::commit();
			}catch (Throwable $e){
				\DB::rollback();
			}
       return redirect()->route('admin.bom.index');
    }

    public function edit($id){
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $bom = Bom::find($id);
        $child = Bom::All();
		return view('admin.bom.edit',compact('bom','child'));
    }

    public function update(Request $request){

		try {
			\DB::beginTransaction();
            foreach($request->child_inventory_id as $key =>$child_inventory_id){

                if(empty($request->item_num[$key])){
                    $item_num = bom::where(['parent_inventory_it'=>$request->parent_inventory_it,'item_num'=>$request->item_num])
                    ->latest()->first()->item_num+1;
                    $chilItem = Bom::where(['child_inventory_id'=>$request->child_inventory_id[$key],'parent_inventory_it'=>$request->parent_inventory_it])->first();
                    if($chilItem){
                        return back()->with('error', 'Duplicate Entry Of Child Item');
                    }else{
                        $data = array(
                            'parent_inventory_it'=>$request->parent_inventory_it,
                            'parent_item'=>$request->parent_item,
                            'parent_item_type'=>$request->parent_item_type,
                            'parent_description'=>$request->parent_description,
                            'substitute_quantity'=>$request->substitute_quantity,
                            'effectivity_date'=>$request->efectivity_date,
                            'completion_subinventory'=>$request->completion_subinventory,
                            'item_num'=>$item_num,
                            'child_inventory_id'=>isset($request->child_inventory_id[$key])? $request->child_inventory_id[$key] :'',
                            'child_item'=>isset($request->child_item[$key])? $request->child_item[$key] :'',
                            'child_item_type'=>isset($request->child_item_type[$key])? $request->child_item_type[$key] :'',
                            'child_description'=>isset($request->child_description[$key])? $request->child_description[$key] :'',
                            'uom'=>isset($request->uom[$key])? $request->uom[$key] :'',
                            'usage'=>isset($request->usage[$key])? $request->usage[$key] :'',
                            'standard_cost'=>isset($request->standard_cost[$key])? $request->standard_cost[$key] :'',
                            'supply_subinventory'=>isset($request->supply_subinventory[$key])? $request->supply_subinventory[$key] :'',
                            'created_by'=>$request->created_by,
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s'),
                            );
                            // dd($data);
                            Bom::create($data);
                    }
                    // dd("masuk");
                }else{
                    $data = Bom::where(['child_inventory_id'=>$request->child_inventory_id[$key],'parent_inventory_it'=>$request->parent_inventory_it])->first();
                    $data->parent_inventory_it = $request->parent_inventory_it;
                    $data->parent_item = $request->parent_item;
                    $data->parent_item_type = $request->parent_item_type;
                    $data->parent_description = $request->parent_description;
                    $data->substitute_quantity = $request->substitute_quantity;
                    $data->effectivity_date = $request->effectivity_date;
                    $data->completion_subinventory = $request->completion_subinventory;
                    $data->item_num = $request->item_num[$key];
                    $data->child_inventory_id = $request->child_inventory_id[$key];
                    $data->child_item = $request->child_item[$key];
                    $data->child_item_type = $request->child_item_type[$key];
                    $data->child_description = $request->child_description[$key];
                    $data->uom = $request->uom[$key];
                    $data->usage = $request->usage[$key];
                    $data->standard_cost = $request->standard_cost[$key];
                    $data->supply_subinventory = $request->supply_subinventory[$key];
                    $data->updated_at = date('Y-m-d H:i:s');
                    $data->save();
                }

			}
            // dd ($data);
			\DB::commit();
			}catch (Throwable $e){
				\DB::rollback();
			}
       return redirect()->route('admin.bom.index');
    }

}

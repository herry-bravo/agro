<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\ItemMaster;
use App\Category;
use App\AccountCode;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
		 $category = Category::where('attribute2','=',NULL)->get();
         return view('admin.category.index',compact('category'));
    }
    public function create()
    {
		 $acc = AccountCode::all();
        return view('Admin.category.create',compact('acc'));
    }
    public function store(StoreCategoryRequest $request)
    {
		$this->validate($request, [
			'category_code'=>'required|max:50|unique:bm_category,category_code',
			]);
		$category=Category::create($request->all());
// dd($category);
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
		 $acc = Category::all();
        return view('admin.category.show',compact('category','acc'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
		$acc = AccountCode::all();
        return view('admin.category.edit',compact('category','acc'));

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
        try {
            $category = Category::find($id);
            $category->update(['category_name' => $request['category_name'],'category_code'=>$request['note']
            ,'inventory_account_code'=>$request['inventory_account_code'],'payable_account_code'=>$request['payable_account_code']
            ,'receivable_account_code'=>$request['receivable_account_code'],'attribute1'=>$request['attribute1'],'consumption_account_code'=>$request['consumption_account_code']]);

            // foreach ($request['measure_id'] as $key => $value) {
            //     $data[$key]['category_id'] = $category->id;
            //     $data[$key]['measure_id'] = $value;
            //     $data[$key]['uom_id'] = $request['uom_id_'.$value];
            //     $data[$key]['created_at'] = \Carbon\Carbon::now();

            // }

            // \App\Models\CategoryUnitsMaster::where('category_id',$id)->delete();

            // \App\Models\CategoryUnitsMaster::insert($data);

            $messageType = 1;
            $message = "Category ".$category->category_name." details updated successfully !";

        } catch(\Illuminate\Database\QueryException $ex){
            $messageType = 2;
            $message = "Category updation failed !";
        }

        return redirect(url("admin/category"))->with('messageType',$messageType)->with('message',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $category = \App\Models\CategoryDetail::find($id);

            $category->delete();

            \App\Models\CategoryUnitsMaster::where('category_id',$id)->delete();

            $messageType = 1;
            $message = "Category ".$category->category_name." details deleted successfully !";

        } catch(\Illuminate\Database\QueryException $ex){
            $messageType = 2;
            $message = "Category deletion failed !";
        }

        return redirect(url("/category/view"))->with('messageType',$messageType)->with('message',$message);
    }
}

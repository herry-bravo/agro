<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAccRequest;
use Illuminate\Http\Request;
use App\AccountCode;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class AccountCodeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('acc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
         return view('admin.acc.index');
    }
    public function create()
    {
		 $accountCode = AccountCode::GroupBy('parent_code')->select('parent_code')->get();
		 $type = AccountCode::GroupBy('type')->select('type')->get();
// dd($accountCodes);
		 $group = AccountCode::GroupBy('account_group')->select('account_group')->get();
        return view('admin.acc.create',compact('accountCode','group','type'));
    }
    public function store(Request $request)
    {
        AccountCode::create($request->all());
        return redirect()->route('admin.accountCode.index')->with('Success', 'Account Stored');
        // try {

        //     $category =\App\Models\CategoryDetail::create( ['category_name' => $request['category_name']] );

        //     foreach ($request['measure_id'] as $key => $value) {
        //         $data[$key]['category_id'] = $category->id;
        //         $data[$key]['measure_id'] = $value;
        //         $data[$key]['uom_id'] = $request['uom_id_'.$value];
        //         $data[$key]['created_at'] = \Carbon\Carbon::now();

        //     }

        //     \App\Models\CategoryUnitsMaster::insert($data);

        //     $messageType = 1;
        //     $message = "Category created successfully !";

        // } catch(\Illuminate\Database\QueryException $ex){
        //     $messageType = 2;
        //     $message = "Category creation failed !";
        // }

        // return redirect(url("/category/view"))->with('messageType',$messageType)->with('message',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coa = AccountCode::find($id);
        return view('admin.acc.show', compact('coa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('acc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accountCode = AccountCode::find($id);
        $parent = AccountCode::where('type','P')->get();
        return view('admin.acc.edit', compact('accountCode','parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccRequest $request, $id)
    {

        $data = AccountCode::firstOrNew(['id' => $request->id]);
        $data->account_code =$request->account_code;
        $data->parent_code =$request->parent_code;
        $data->description =$request->description;
        $data->level =$request->level;
        $data->type =$request->type;
        $data->updated_at =date('Y-m-d H:i:s');
        if ($data->save()){
        $response = ['status' => 'success', 'success' => true, 'message' => 'Save success'];
        }else{
            $response = ['status' => 'error', 'success' => false, 'message' => 'Unable to save data'];
        }
        return $response;
    }



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

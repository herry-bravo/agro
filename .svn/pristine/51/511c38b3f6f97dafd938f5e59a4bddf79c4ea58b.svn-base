<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class OpUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.opunit.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.opunit.create');

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
        $operation = \DB::table('bm_operation_unit')->get()->last()->unit_id+1;
        $data = array(
            'unit_id' => $operation,
            'short_name'=>$request->short_name,
            'name'=>$request->name,
            'capacity'=>$request->capacity,
            'range_capacity_max'=>$request->range_capacity_max,
            'range_capacity_min'=>$request->range_capacity_min,
            'range_gsm_min'=>$request->range_gsm_min,
            'range_gsm_max'=>$request->range_gsm_max,
            'machine_status'=>$request->machine_status,
        );
        \App\OperationUnit::create($data);
         return redirect()->route('admin.opunit.index');
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
        $operation = \App\OperationUnit::find($id);
        return view('admin.opunit.edit', compact('operation'));
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
        \App\OperationUnit::find($id)->update($request->all());
        return back()->with('success','Data Edited');
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

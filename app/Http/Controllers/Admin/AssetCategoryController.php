<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Vendor;
use App\Currency;
use App\BankAccount;
use App\AssetCatagory;

class AssetCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.assetCategory.index');
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
         $category = \App\Category::whereNotNull('attribute2')->get();
        return view('admin.assetCategory.create',compact('acc','category'));
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
        AssetCatagory::create($request->all());
        return redirect()->route('admin.asset-category.index')->with('success', 'Data Is Inputed');
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
        $assetcategory = AssetCatagory::find($id);
        $acc = \App\AccountCode::All();
        $category = \App\Category::whereNotNull('attribute2')->get();
       return view('admin.assetCategory.edit',compact('acc','category','assetcategory'));
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
        $asstcategory =AssetCatagory::find($id);
        $asstcategory->name=$request->name;
        $asstcategory->company_id=$request->company_id;
        $asstcategory->journal_id=$request->journal_id;
        $asstcategory->method_time=$request->method_time;
        $asstcategory->account_asset_id=$request->account_asset_id;
        $asstcategory->method_number=$request->method_number;
        $asstcategory->account_depreciation_id=$request->account_depreciation_id;
        $asstcategory->method_period=$request->method_period;
        $asstcategory->account_depreciation_expense_id=$request->account_depreciation_expense_id;
        $asstcategory->account_analytic_id=$request->account_analytic_id;
        $asstcategory->method=$request->method;
        $asstcategory->group_entries=$request->group_entries;
        $asstcategory->prorata=$request->prorata;
        // dd($asstcategory);
        $asstcategory->save();
        return redirect()->route('admin.asset-category.index')->with('success', 'Data Is Inputed');

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

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use \App\Category;
use Symfony\Component\HttpFoundation\Response;

class JournalTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = \App\Category::whereNotNull('attribute2')->get();
        return view('admin.journalTypes.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = \App\MaterialTransaction::whereIN('trx_code',[43,42,34,32,4,3])->get();
        $curr = \App\CurrencyGlobal::all();
        $acc = \App\AccountCode::all();
        $acc_group=\App\AccountCode::whereNotNull('account_group')->groupBy('account_group')->select('account_group')->get();
        return view('admin.journalTypes.create',compact('cat','curr','acc','acc_group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category= \App\Category::create($request->all());
        return redirect()->route('admin.journalTypes.index')->with('success', 'Journal Types Stored');
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
        $category = \App\Category::find($id);
		$cat = \App\MaterialTransaction::whereIN('trx_code',[43,42,27,32,4,3])->get();
        $curr = \App\CurrencyGlobal::all();
        $acc = \App\AccountCode::all();
        $acc_group=\App\AccountCode::whereNotNull('account_group')->groupBy('account_group')->select('account_group')->get();
        return view('admin.journalTypes.edit',compact('category','acc','curr','cat','acc_group'));
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
        $category = Category::where('id', '=', $id)->first();

        $category->update($request->all());
        return back();
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

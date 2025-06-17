<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\BankAccount;

class AddBankAccountController extends Controller
{
    public function index()
    {
        $addbank= \App\BankAccount::all();

        return view('admin.bankaccount.index');
    }

    public function create()
    {
        $cust = \App\Customer::all();
        $acccode = \App\AccountCode::all();
        return view('admin.bankaccount.create',compact('acccode','cust'));
    }

    public function store(Request $request)
    {
        $create = \App\BankAccount::updateOrCreate([
            'bank_acct_use_id'=>$request->bank_acct_use_id,
            'bank_account_id'=>$request->bank_account_id,
            'attribute_category'=>$request->attribute_category,
            'attribute1'=>$request->attribute1,
            'attribute2'=>$request->attribute2,
            'org_party_id'=>$request->org_party_id,
            'ap_use_enable_flag'=>$request->ap_use_enable_flag,
            'ar_use_enable_flag'=>$request->ar_use_enable_flag,
            'end_date'=>$request->end_date,
        ]);
        return view('admin.bankaccount.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $bank = \App\BankAccount::where('id',$id)->get()->first();
        $cust = \App\Customer::all();
        $acccode = \App\AccountCode::all();
        return view('admin.bankaccount.edit',compact('bank','acccode','cust'));

    }

    public function update(Request $request, $id)
    {
        $bankaccount = BankAccount::where('id',$id)->first();
        $bankaccount->bank_acct_use_id=$request->bank_acct_use_id;
        $bankaccount->bank_account_id=$request->bank_account_id;
        $bankaccount->attribute_category=$request->attribute_category;
        $bankaccount->attribute1=$request->attribute1;
        $bankaccount->ar_use_enable_flag=$request->ar_use_enable_flag;
        $bankaccount->attribute2=$request->attribute2;
        $bankaccount->org_party_id=$request->org_party_id;
        $bankaccount->end_date=$request->end_date;
        $bankaccount->ap_use_enable_flag=$request->ap_use_enable_flag;
        $bankaccount->save();
        // dd($bankaccount);

        return back()->with('success', 'Work Order Modified');

    }

    public function destroy($id)
    {
        //
    }
}

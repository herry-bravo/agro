<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ArCustomerTrx;

class ArCustTransController extends Controller
{

    public function index()
    {
        $cust = ArCustomerTrx::All();
        return view('admin.arCustTrans.index',compact('cust'));
    }
}

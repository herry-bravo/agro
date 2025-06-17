<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DeliveryDetail;
use App\DeliveryHeader;
class InvoicesController extends Controller
{
    //
    public function index()
    {
        $DeliveryDetail=DeliveryHeader::get();

        return view('admin.invoices.index',compact('DeliveryDetail'));

    }
    public function create()
    {
        return view('admin.invoices.create');

    }
    public function edit()
    {
        return view('admin.invoices.edit');

    }

    public function update()
    {
        return view('admin.invoices.index');

    }
}

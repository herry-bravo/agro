<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionTypeRequest;
use App\PurchaseRequisition;
use Gate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class PurchaseRequisitionDetailController extends Controller
{
    public function index()
    {
	    return view('admin.purchaserequisitiondetail.index');
    }
}

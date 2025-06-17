<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MissExpenses;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use DB;

class MissExpensesReportController extends Controller
{
    //
    public function index(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $from = $request->input('datefrom');
        $to=$request->input('dateto');

        $missExpenses = MissExpenses::whereBetween('created_at',[$from, $to])
                            ->orderBy('created_at')
                            ->get();
        // dd($txns);
        if(empty($request->input('datefrom') && $request->input('dateto'))){
            return back()->with('error', 'Field (From / To) is required');
        }

        return view('admin.stdReports.missExpensesReport',compact('missExpenses'));
    }
}

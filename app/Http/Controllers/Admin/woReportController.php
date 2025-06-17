<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\WorkOrder;
use App\WorkOrderDetail;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class woReportController extends Controller
{
    //
    public function index(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $from = $request->input('datefrom');
        $to = $request->input('dateto');
        $header = WorkOrder::whereBetween('need_by_date',[$from,$to])->get();
        foreach($header as $key => $value)
        {
            $qry[$key] = $value->work_order_id;
            $planning[$key] = $value->source_header_ref;

        }

        $data = WorkOrderDetail::whereIn('work_order_id',$qry)->get();
        $planHead = \App\ProdPlanning::whereIn('prod_planning_id',$planning)->get();
        $planDet = \App\PlanningDetail::whereIn('header_id',$planning)->get();

        $pdf = \PDF::loadview('admin.stdReports.workOrderDoc',compact('header','data','planHead','planDet'))->setPaper('A4');
        return $pdf->stream('Work Order'.$from.'-'.$to.'.pdf');

    }
}

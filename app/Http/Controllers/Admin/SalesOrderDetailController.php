<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SalesOrder;
use App\SalesOrderDetail;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class SalesOrderDetailController extends Controller
{
    //

    public function destroy($id)
    {
       abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $SalesOrderDetail->delete();
        $SalesOrderDetail = SalesOrderDetail::find($id);
        if($SalesOrderDetail->flow_status_code == 5 ||  $SalesOrderDetail->flow_status_code == 6){
            // dd("masuk");
            $SalesOrderDetail->delete();
        }else{
            return back()->with('error', 'Not Allow to Delete');
        }
        return back();
    }

    public function massDestroy(MassDestroyTransactionTypeRequest $request)
    {
        TransactionType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

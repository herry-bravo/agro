<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\RcvHeader;
use App\RcvDetail;
use App\Vendor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;

class GrnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($request->input('grnfrom') && $request->input('grnto'))
        {
            $from = $request->input('grnfrom');
            $to=$request->input('grnto');
            // dd($from);
            $header = RcvHeader::whereBetween('receipt_num',[$from,$to])->get();

            foreach($header as $key => $value)
            {
                $qry[$key] = $value->shipment_header_id;
            }

            $data = RcvDetail::whereIn('shipment_header_id',$qry)->get();
            // dd($data);
            return view('admin.grn.view', compact('data','header','from','to'));
        }
        elseif($request->input('transaction_datefrom') && $request->input('transaction_dateto'))
        {
            $from =$request->input('transaction_datefrom');
            $to =  $request->input('transaction_dateto');
            $header = RcvHeader::whereBetween('gl_date',[$from,$to])->get();

            foreach($header as $key => $value)
            {
                $qry[$key] = $value->shipment_header_id;
            }

            $data = RcvDetail::whereIn('shipment_header_id',$qry)->get();
            return view('admin.grn.view', compact('data','header','from','to'));
        }else{
            return back()->with('error', 'Field (From / To) is required');
        }
    }

    public function pdf($from, $to)
    {
        //
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            // $from = 0;
            if(is_numeric($from))
            {
                // dd($from);
                $header = RcvHeader::whereBetween('receipt_num',[$from,$to])->get();
                foreach($header as $key => $value)
                {
                    $qry[$key] = $value->shipment_header_id;
                    $qry2[$key]= $value->receipt_num;
                }
                $data = RcvDetail::whereIn('shipment_header_id',$qry)->get();
                $counter = DB::table('bm_c_rcv_transactions_id as t')
                                ->leftJoin('bm_c_rcv_shipment_header_id as h','h.shipment_header_id','=','t.shipment_header_id')
                                ->select('t.shipment_header_id',DB::raw('count(t.shipment_header_id) as pgs'))
                                ->whereIn('h.receipt_num',$qry2)
                                ->groupBy('t.shipment_header_id')
                                ->get();
                // dd($counter);
            }
            else
            {
                $header = RcvHeader::whereBetween('gl_date',[$from,$to])->get();
                foreach($header as $key => $value)
                {
                    $qry[$key] = $value->shipment_header_id;
                }
                $data = RcvDetail::whereIn('shipment_header_id',$qry)->get();
                $counter = DB::table('bm_c_rcv_transactions_id as t')
                                ->leftJoin('bm_c_rcv_shipment_header_id as h','h.shipment_header_id','=','t.shipment_header_id')
                                ->select('t.shipment_header_id',DB::raw('count(t.shipment_header_id) as pgs'))
                                ->whereIn('h.receipt_num',$qry2)
                                ->groupBy('t.shipment_header_id')
                                ->get();
            }

         $pdf = \PDF::loadview('admin.grn.show',compact('header','data','counter'))->setPaper('A5','landscape');
         return $pdf->stream('GRN'.$from.'-'.$to.'.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Request $request)
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

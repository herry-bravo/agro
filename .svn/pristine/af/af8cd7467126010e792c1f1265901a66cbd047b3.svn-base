<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Gate;
use App\RcvHeader;
use App\QualityManagement;
use App\RcvDetail;
use App\ImgPath;
use Symfony\Component\HttpFoundation\Response;

class MaterialQualityController extends Controller
{
    //
    public function index()
    {
		$rcv = RcvHeader::select('attribute1','transaction_type',DB::raw('count(attribute1)'))
                        ->groupBy('attribute1','transaction_type')
                        ->get();
        $qm = QualityManagement::All();
        // dd($qm);
        return view('admin.materialQuality.index', compact('rcv','qm'));
    }

    public function create(Request $request)
    {
        $aju = $request->aju;

        $qm = QualityManagement::where('attribute_aju','=',$aju)->first();

        if($qm){
            return back()->with('error', 'Material Quality Already Entered in This Document');
        }

        $rcv_detail = RcvDetail::leftJoin('bm_c_rcv_shipment_header_id as rh','rh.shipment_header_id','=','bm_c_rcv_transactions_id.shipment_header_id')
                            ->where('rh.attribute1',$aju)
                            ->first();

        $qty =  RcvDetail::leftJoin('bm_c_rcv_shipment_header_id as rh','rh.shipment_header_id','=','bm_c_rcv_transactions_id.shipment_header_id')
                ->select(DB::raw('sum(quantity_received) as qty'))
                ->where('rh.attribute1',$aju)
                ->first();
        return view('admin.materialQuality.create', compact('aju','rcv_detail','qty'));
    }

    public function store(Request $request)
    {

        $number = 1;
        foreach($request->path as $key => $value)
        {
            // dd($request->path[$key]);

            $image = $request->path[$key];
            $input['imagename'] =$request->attribute_aju.'_'.$number.'.'.$image->extension();

            $filePath2 = public_path('/images/container');

            $image->move($filePath2, $input['imagename']);
            $data = array(
                'aju' => $request->attribute_aju,
                'path' => '/images/container/'.$input['imagename'],
            );
            // dd($data);
            ImgPath::create($data);
            // dd($data);

            $number++;


        }

        QualityManagement::create($request->All());



        return redirect()->route('admin.qm-material.index');
    }

    public function edit($id)
    {
        $qm = QualityManagement::find($id);
        // dd($qm);
        $img = ImgPath::where('aju',$qm->attribute_aju)->select('path')->get();
        // dd($img);
        return view('admin.materialQuality.edit', compact('qm','img'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $qm = QualityManagement::find($id)->update($request->all());

        return back()->with('success','Material Quality Edited');
    }
}

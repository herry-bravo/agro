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
use App\WorkOrderSerial;
use App\FgQuality;
use Symfony\Component\HttpFoundation\Response;

class FinishGoodQualityController extends Controller
{
    //
    public function index()
    {
		$roll = WorkOrderSerial::All();
        $qm = QualityManagement::All();
        // dd($qm);
        return view('admin.finishGoodQuality.index', compact('roll','qm'));
    }

    public function create(Request $request)
    {
        $roll = $request->roll;
		$serial = WorkOrderSerial::where('job_definition_name',$roll)->first();

        return view('admin.finishGoodQuality.create', compact('roll','serial'));
    }

    public function store(Request $request)
    {
        foreach($request->attribute_num_quality as $key => $value)
        {
            $data = array(
                'inventory_item_id' => $request->inventory_item_id,
                'uniq_attribute_roll' => $request->uniq_attribute_roll,
                'attribute_number_1' => $request->attribute_number_1[$key],
                'attribute_number_2' => $request->attribute_number_2[$key],
                'attribute_number_3' => $request->attribute_number_3[$key],
                'attribute_number_4' => $request->attribute_number_4[$key],
                'attribute_number_5' => $request->attribute_number_5[$key],
                'attribute_number_6' => $request->attribute_number_6[$key],
                'attribute_number_7' => $request->attribute_number_7[$key],
                'attribute_number_8' => $request->attribute_number_8[$key],
                'attribute_num_quality' => $request->attribute_num_quality[$key],
                'attribute_char' => $request->attribute_char,
                'reference' => $request->reference,
                'transaction_date' => $request->transaction_date,
            );
            FgQuality::create($data);
        }


        return redirect()->route('admin.qm-finsihGood.index')->with('success','Finish Good Quality Inputed');
    }

    public function edit($id)
    {
        $qm = FgQuality::where('uniq_attribute_roll',$id)->get();
        $head = FgQuality::where('uniq_attribute_roll',$id)->first();
        // dd($qm);

        return view('admin.finishGoodQuality.edit', compact('qm','head'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        try {
            \DB::beginTransaction();

            // dd($request->id);
            foreach($request->attribute_num_quality as $key => $value)
            {
                if(empty($request->id[$key])){
                    $data = array(
                        'inventory_item_id' => $request->inventory_item_id,
                        'uniq_attribute_roll' => $request->uniq_attribute_roll,
                        'attribute_number_1' => $request->attribute_number_1[$key],
                        'attribute_number_2' => $request->attribute_number_2[$key],
                        'attribute_number_3' => $request->attribute_number_3[$key],
                        'attribute_number_4' => $request->attribute_number_4[$key],
                        'attribute_number_5' => $request->attribute_number_5[$key],
                        'attribute_number_6' => $request->attribute_number_6[$key],
                        'attribute_number_7' => $request->attribute_number_7[$key],
                        'attribute_number_8' => $request->attribute_number_8[$key],
                        'attribute_num_quality' => $request->attribute_num_quality[$key],
                        'attribute_char' => $request->attribute_char,
                        'reference' => $request->reference,
                        'transaction_date' => $request->transaction_date,
                    );
                    FgQuality::create($data);
                }else{
                    $data = FgQuality::find($request->id[$key]);
                    $data->inventory_item_id = $request->inventory_item_id;
                    $data->uniq_attribute_roll = $request->uniq_attribute_roll;
                    $data->attribute_number_1 = $request->attribute_number_1[$key];
                    $data->attribute_number_2 = $request->attribute_number_2[$key];
                    $data->attribute_number_3 = $request->attribute_number_3[$key];
                    $data->attribute_number_4 = $request->attribute_number_4[$key];
                    $data->attribute_number_5 = $request->attribute_number_5[$key];
                    $data->attribute_number_6 = $request->attribute_number_6[$key];
                    $data->attribute_number_7 = $request->attribute_number_7[$key];
                    $data->attribute_number_8 = $request->attribute_number_8[$key];
                    $data->attribute_num_quality = $request->attribute_num_quality[$key];
                    $data->attribute_char = $request->attribute_char;
                    $data->reference = $request->reference;
                    $data->transaction_date = $request->transaction_date;
                    $data->save();
                }
            }
        \DB::commit();
        }catch (Throwable $e){
            \DB::rollback();
        }
        return back()->with('success','Finish Good Quality Edited');
    }
}

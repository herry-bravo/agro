<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CurrencyGlobal;
use App\Http\Requests\StoreGlRequest;
use App\GlHeader;
use App\GlLines;
use App\MaterialTransaction;
use Illuminate\Validation\Rule;
use DB;

class GlmanualsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.glmanual.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currency = CurrencyGlobal::where('currency_status', 1)->get();
        $trx = MaterialTransaction::whereIn('trx_code', [40,39,34,4,1,41,42,43])->select('trx_code','trx_source_types')->get();
        return view('admin.glmanual.create',compact('currency','trx'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGlRequest $request)
    {
        // dd($request);
        $header_id = DB::table('bm_gl_je_headers')->get()->last();
        $head = GlHeader::findorNew($request->id);
        $id=$header_id->id+1;
        $head->je_header_id =$id;
        $head->name=$request->name;
        $head->created_by=$request->created_by;
        $head->last_updated_by=$request->last_updated_by;
        $head->je_source=$request->je_source;
        $head->status=$request->status;
        $head->je_batch_id=$request->je_batch_id;
        $head->default_effective_date=$request->default_effective_date;
        $head->period_name=$request->period_name;
        $head->external_reference=$request->external_reference;
        $head->je_category=$request->je_category;
        $head->currency_code=$request->currency_code;
        $head->running_total_dr=$request->running_total_dr;
        $head->running_total_cr=$request->running_total_cr;

        try {
			\DB::beginTransaction();
		    $head->save();
            foreach($request->code_combinations as $key =>$code_combinations){
                $data = array(
                    'je_header_id'=>$id,
                    'je_line_num'=> $key+1,
                    'last_updated_by'=>auth()->user()->id,
                    'ledger_id'=>$request->je_batch_id ?? '',
                    'code_combination_id'=>$request->code_combinations[$key] ?? '',
                    'period_name'=>$request->period_name,
                    'effective_date'=>$request->default_effective_date ?? '',
                    'status'=>$request->status?? '',
                    'created_by'=>$request->created_by,
                    'entered_dr'=>$request->dr [$key],
                    'entered_cr'=>$request->cr [$key],
                    'description'=>$request->desc [$key],
                    'reference_1'=>$request->party_name [$key],
                    'tax_code'=>$request->tax [$key],
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                );
                // dd($data);
            GlLines::create($data);
          }
           \DB::commit();
        }catch (Throwable $e){
            \DB::rollback();
		}
        return redirect()->route('admin.gl.edit',$id)->with('success', 'Data Stored');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $currency = CurrencyGlobal::where('currency_status', 1)->get();
        $trx = MaterialTransaction::whereIn('trx_code', [40,39,34,4,1,41,42,43])->select('trx_code','trx_source_types')->get();
        $data=GlHeader::where('je_header_id',$id)->first();
        $data_lines=GlLines::where('je_header_id',$id)->get();
        return view('admin.glmanual.edit',compact('currency','trx','data','data_lines'));
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
        switch ($request->input('action')) {
            case 'submit':
            $head = GlHeader::where('je_header_id',$id)->first();
            $head->name=$request->name;
            $head->created_by=$request->created_by;
            $head->last_updated_by=$request->last_updated_by;
            $head->je_source=$request->je_source;
            $head->status=$request->status;
            $head->je_batch_id=$request->je_batch_id;
            $head->default_effective_date=$request->default_effective_date;
            $head->period_name=$request->period_name;
            $head->external_reference=$request->external_reference;
            $head->je_category=$request->je_category;
            $head->currency_code=$request->currency_code;
            $head->running_total_dr=$request->running_total_dr;
            $head->running_total_cr=$request->running_total_cr;

            try {
                \DB::beginTransaction();
            $head->save();
                foreach($request->je_line_number as $key =>$line_number){
                    if(empty($request->je_line_number[$key])){
                        $data = array(
                            'je_header_id'=>$id,
                            'je_line_num'=> $key+1,
                            'last_updated_by'=>auth()->user()->id,
                            'ledger_id'=>$request->je_batch_id ?? '',
                            'code_combination_id'=>$request->code_combinations[$key] ?? '',
                            'period_name'=>$request->period_name,
                            'effective_date'=>$request->default_effective_date ?? '',
                            'status'=>$request->status?? '',
                            'created_by'=>$request->created_by,
                            'entered_dr'=>$request->dr [$key],
                            'entered_cr'=>$request->cr [$key],
                            'description'=>$request->desc [$key],
                            'reference_1'=>$request->party_name [$key],
                            'tax_code'=>$request->tax [$key],
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s'),
                        );
                    GlLines::create($data);
                    }else {
                        $data=GlLines::where([['je_header_id',$id],['je_line_num',$request->je_line_number[$key]]])->first();
                        $data->reference_1= isset($request->party_name[$key])? $request->party_name[$key] : '';
                        $data->code_combination_id=$request->code_combinations [$key];
                        $data->description=$request->desc [$key];
                        $data->entered_dr=$request->dr [$key];
                        $data->entered_cr=$request->cr [$key];
                        $data->updated_at=date('Y-m-d H:i:s');
                        $data->save();
                    }

                }
                \DB::commit();
            }catch (Throwable $e){
                dd($e);
                \DB::rollback();
                return back()->with('error','Data Cant be empty '.$e.'');
            }
            return redirect()->route('admin.gl.edit',$id)->with('success', 'Data Stored');
            break;
            case 'status':
                $head = GlHeader::where('je_header_id',$id)->first();
                // dd($request->flex);
                // dd($head->posted);
                $head->posted = $request->flex;
                $head->save();
                // dd($head);
                return back()->with('success', 'Data Is Updated');
            break;


        }
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
    public function gl_entries()
    {
       return  view('admin.glmanual.entriesIndex');

    }

    public function bank()
    {
        return  view('admin.glmanual.bank');
    }
    public function cash()
    {
        return  view('admin.glmanual.cash');
    }
}

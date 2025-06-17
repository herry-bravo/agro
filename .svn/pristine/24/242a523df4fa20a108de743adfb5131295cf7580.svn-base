<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Terms;
use App\Currency;
use App\CurrencyGlobal;
use App\Vendor;
use App\ArCalendar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class arCalendarController extends Controller
{

    public function index()
    {
        $cal = ArCalendar::All();
        return view('admin.arCalendar.index',compact('cal'));
    }

    public function create()
    {
        return view('admin.arCalendar.create');
    }

    public function store(Request $request)
    {
        try {
			\DB::beginTransaction();
            foreach($request->startdate as $key =>$startdate){
                    $calendar = ArCalendar::where(['startdate'=>$request->startdate[$key],'enddate'=>$request->enddate])->first();
                    if($calendar){
                        return back()->with('error', 'Duplicate Entry Calendar');
                    }else{
                        $data = array(
                            'num'=>isset($request->num[$key])? $request->num[$key] :'',
                            'setname'=>isset($request->setname[$key])? $request->setname[$key] :'',
                            'year'=>isset($request->year[$key])? $request->year[$key] :'',
                            'startdate'=>isset($request->startdate[$key])? $request->startdate[$key] :'',
                            'enddate'=>isset($request->enddate[$key])? $request->enddate[$key] :'',
                            'createdby'=>$request->created_by,
                            'confirmationstatus'=>0,
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s'),
                            );
                            ArCalendar::create($data);
                    }

			}
            // dd ($data);
			\DB::commit();
			}catch (Throwable $e){
				\DB::rollback();
			}
        return redirect()->route('admin.arCalendar.index');
    }

    public function edit($id)
    {
        $cal = ArCalendar::find($id);
        return view('admin.arCalendar.edit',compact('cal'));
    }

    public function update(Request $request)
    {
        try {
			\DB::beginTransaction();
            // foreach($request->startdate as $key =>$startdate){
                $data = ArCalendar::where('id',$request->id)->first();
                $data->id = $request->id;
                $data->setname = $request->setname;
                $data->year = $request->year;
                $data->startdate = $request->startdate;
                $data->enddate = $request->enddate;
                $data->createdby = $request->created_by;
                $data->confirmationstatus = $request->status;
                $data->updated_at = date('Y-m-d H:i:s');
                // dd($data);
                $data->save();

			// }
            // dd ($data);
			\DB::commit();
			}catch (Throwable $e){
				\DB::rollback();
			}
        return redirect()->route('admin.arCalendar.index');
    }

}

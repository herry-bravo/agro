<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Gate;
use App\UomConversion;
use App\Uom;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UomConversionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $uomCon = UomConversion::All();

        return view('admin.uomConversion.index', compact('uomCon'));
    }

    public function create(){
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $uom = Uom::All();
        return view('admin.uomConversion.createTabs', compact('uom'));
    }

    public function store(Request $request){

        $id = UomConversion::latest()->first();
        $id = $id->conversion_id + 1;
        // dd($request->interior_unit_code);
        $exist = UomConversion::where(['inventory_item_id'=>$request->inventory_item_id,'interior_unit_code'=>$request->interior_unit_code])->first();
        if($exist){
            return back()->with('error', 'Conversion rate already exist!');
        }else{
            // dd('salah!');
            $data =array(
                'conversion_id'=>$id,
                'inventory_item_id'=>$request->inventory_item_id,
                'uom_code'=>$request->uom_code,
                'conversion_rate'=>$request->conversion_rate,
                'interior_unit_code'=>$request->interior_unit_code,
                'interior_unit_qty'=>''
            );
            UomConversion::create($data);
        }


        return redirect()->route('admin.uom-conversion.index');
    }

    public function edit ($id){
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $uomCon = UomConversion::find($id);
        $uom = Uom::All();
        return view('admin.uomConversion.edit', compact('uomCon','uom'));
    }

    public function update(Request $request, $id)
    {
        $uomCon = UomConversion::find($id)->update($request->all());

        return redirect()->route('admin.uom-conversion.index');
    }


    public function show($id)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $client->load('status');
        // $uom = Uom::find($id);

        // return view('admin.uom.show', compact('uom'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $uom = Uom::find($id)->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        Uom::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

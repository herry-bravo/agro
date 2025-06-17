<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use App\MaterialTransaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaterialTrnTypeController extends Controller
{
    //
    public function index()
    {
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mtrl = MaterialTransaction::All();

        return view('admin.materialTrnTypes.index', compact('mtrl'));
    }

    public function create(){
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.materialTrnTypes.createTabs');
    }

    public function store(Request $request){

        MaterialTransaction::create($request->All());

        return redirect()->route('admin.materialTrnTypes.index');
    }

    public function edit ($id){
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $mtrl = MaterialTransaction::find($id);

        return view('admin.materialTrnTypes.edit', compact('mtrl'));
    }

    public function update(Request $request, $id)
    {
        $mtrl = MaterialTransaction::find($id)->update($request->all());

        return redirect()->route('admin.materialTrnTypes.index');
    }


    public function show($id)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $client->load('status');
        $mtrl = MaterialTransaction::find($id);

        return view('admin.materialTrnTypes.show', compact('mtrl'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mtrl = MaterialTransaction::find($id)->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        Subinventories::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

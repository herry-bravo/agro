<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use App\Subinventories;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubInventoryRequest;
use Symfony\Component\HttpFoundation\Response;

class SubInventoryController extends Controller
{
    //
    public function index()
    {
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sub = Subinventories::All();

        return view('admin.subinventory.index', compact('sub'));
    }

    public function create(){
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.subinventory.createTabs');
    }

    public function store(StoreSubInventoryRequest $request){

        Subinventories::create($request->All());

        return redirect('admin/subInventory/');
    }

    public function edit ($id){
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sub = Subinventories::find($id);

        return view('admin.subinventory.edit', compact('sub'));
    }

    public function update(Request $request, $id)
    {
        $sub = Subinventories::find($id)->update($request->all());

        return redirect('admin/subInventory/');
    }


    public function show($id)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $client->load('status');
        $sub = Subinventories::find($id);

        return view('admin.subinventory.show', compact('sub'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sub = Subinventories::find($id)->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        Subinventories::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TrxStatuses;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class TrxStatusesController extends Controller
{
    //
    public function index()
    {
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = TrxStatuses::All();

        return view('admin.trxStatuses.index', compact('status'));
    }

    public function create(){
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.trxStatuses.create');
    }

    public function store(Request $request){

        TrxStatuses::create($request->All());

        return redirect()->route('admin.trx-statuses.index');
    }

    public function edit ($id){
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $status = TrxStatuses::find($id);

        return view('admin.trxStatuses.edit', compact('status'));
    }

    public function update(Request $request, $id)
    {
        $status = TrxStatuses::find($id)->update($request->all());

        return redirect()->route('admin.trx-statuses.index');
    }


    public function show($id)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $client->load('status');
        $status = TrxStatuses::find($id);

        return view('admin.trxStatuses.show', compact('status'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = TrxStatuses::find($id)->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        Subinventories::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

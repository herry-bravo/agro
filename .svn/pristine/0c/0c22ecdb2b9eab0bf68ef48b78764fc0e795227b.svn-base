<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use App\Uom;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UomController extends Controller
{
    //
    public function index()
    {
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $uom = Uom::All();

        return view('admin.uom.index', compact('uom'));
    }

    public function create(){
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.uom.createTabs');
    }

    public function store(Request $request){

        Uom::create($request->All());

        return redirect()->route('admin.uom.index');
    }

    public function edit ($id){
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $uom = Uom::find($id);

        return view('admin.uom.edit', compact('uom'));
    }

    public function update(Request $request, $id)
    {
        $uom = Uom::find($id)->update($request->all());

        return redirect()->route('admin.uom.index');
    }


    public function show($id)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $client->load('status');
        $uom = Uom::find($id);

        return view('admin.uom.show', compact('uom'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $uom = Uom::find($id)->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        Uom::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

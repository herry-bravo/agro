<?php

namespace App\Http\Controllers\Admin;

use App\Terms;
use App\Http\Controllers\Controller;
use App\transaction;
use App\Http\Requests\MassDestroyClientRequest;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TermsController extends Controller
{
    //
    public function index()
    {
        abort_if(Gate::denies('vendor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $terms = Terms::All();
        return view('admin.terms.index', compact('terms'));
    }

    public function create()
    {
        abort_if(Gate::denies('vendor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       // $statuses = ClientStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.terms.create');
    }

    public function store(Request $request)
    {
        $terms = Terms::create($request->all());

        return redirect()->route('admin.terms.index');
    }

    public function edit($id)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $statuses = ClientStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // $client->load('status');

        $terms = Terms::find($id);

        return view('admin.terms.edit', compact('terms'));
    }

    public function update(Request $request, $id)
    {
        $terms = Terms::find($id)->update($request->all());

        return redirect()->route('admin.terms.index');
    }

    public function show($id)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $client->load('status');
        $terms = Terms::find($id);

        return view('admin.terms.show', compact('terms'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $terms = Terms::find($id)->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        Client::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

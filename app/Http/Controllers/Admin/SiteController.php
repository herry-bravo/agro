<?php

namespace App\Http\Controllers\Admin;

use App\Site;
use App\Vendor;
use App\transaction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClientRequest;
use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\UpdateClientRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vendor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $site = Site::all();
        $vendor = Vendor::all();
        return view('admin.site.index', compact('site','vendor'));
    }

    public function create()
    {
        abort_if(Gate::denies('vendor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       // $statuses = ClientStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.site.create');
    }

    public function store(StoreSiteRequest $request)
    {
		Site::create($request->all());

		return redirect()->route('admin.site.index');
    }

    public function edit ($id)
    {
        abort_if(Gate::denies('vendor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $site = Site::find($id);
        return view('admin.site.edit',compact('site'));
    }

    public function update(Request $request, Site $site)
    {
        $site->update($request->all());

        return redirect()->route('admin.site.index');
    }

    public function show($id)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $site = Site::find($id);

        return view('admin.site.show', compact('site'));
    }

    public function destroy(Site $site)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $site->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        Site::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

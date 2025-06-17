<?php

namespace App\Http\Controllers\Admin;

use App\Vendor;
use App\Site;
use App\Tax;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendorController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vendor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vendor = Vendor::all();
        return view('admin.vendor.index', compact('vendor'));
    }

    public function create()
    {
        abort_if(Gate::denies('vendor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $max = Vendor::latest()->first();
        $vendor = Vendor::All();
         $site = Site::all();
        $tax = Tax::all();
        return view('admin.vendor.create',compact( 'site', 'max', 'vendor','tax'));
    }

    public function store(Request $request)
    {
        Vendor::create($request->all());
        return redirect()->route('admin.vendor.index');
    }

    public function edit($id)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $curr= Currency::all();
        $vendor = Vendor::find($id);
        $tax = Tax::all();

        return view('admin.vendor.edit', compact('vendor','tax','curr'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $vendor ->update($request->all());

        return redirect()->route('admin.vendor.index');
    }

    public function show($id)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $client->load('status');
        $vendor = Vendor::find($id);

        return view('admin.vendor.show', compact('vendor'));
    }

    public function destroy(Vendor $vendor)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendor->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        Client::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

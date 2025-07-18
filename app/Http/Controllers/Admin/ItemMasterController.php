<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionTypeRequest;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateTransactionTypeRequest;
use App\ItemMaster;
use App\ItemType;
use App\Category;
use App\ItemStatuses;
use App\MakeOrBuy;
use App\Role;
use App\PoAgent;
use App\Uom;
use App\AccountCode;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemMasterController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            return view('admin.itemMaster.index');

    }

    public function create()
    {
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $uom = Uom::all();
        $ItemType = ItemType::all();
        $Category = Category::all();
        $itemstatus = ItemStatuses::all();
        $makeorbuy = MakeOrBuy::all();
        $agent = PoAgent::all();
       return view('admin.itemMaster.createTabs', compact('uom','ItemType','Category','itemstatus','makeorbuy','agent'));
    }

    public function store(StoreItemRequest $request)
    {
        $this->validate($request, [
			'item_code'=>'required|max:50|unique:bm_mtl_system_item,item_code',
			]);
			 $itemMaster = ItemMaster::create($request->all());
      return redirect()->route('admin.item-master.index')->with('success',"Stored !!");
    }

    public function edit(itemMaster $itemMaster)
    {
        abort_if(Gate::denies('item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
		$Category = Category::all();
        $itemstatus = ItemStatuses::all();
        $makeorbuy = MakeOrBuy::all();
        $agent = PoAgent::all();
        $coa = AccountCode::all();
        return view('admin.itemMaster.edit', compact('coa','itemMaster','Category','itemstatus','makeorbuy','agent'));
    }

    public function update(Request $request)
    {
        $item = ItemMaster::findOrFail($request->id);

    // Update field-field yang diizinkan
        $item->update($request->all());
        return back()->with('success',"Updated !!");
    }

    public function show(TransactionType $transactionType)
    {
        abort_if(Gate::denies('transaction_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.transactionTypes.show', compact('transactionType'));
    }

    public function destroy(TransactionType $transactionType)
    {
        abort_if(Gate::denies('transaction_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransactionTypeRequest $request)
    {
        TransactionType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

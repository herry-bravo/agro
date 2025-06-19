<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionTypeRequest;
use App\Http\Requests\StoreTransactionTypeRequest;
use App\Http\Requests\UpdateTransactionTypeRequest;
use App\Inventory;
use App\Onhand;
use App\Subinventories;
use App\ItemMaster;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InventoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('inventory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subinv=Subinventories::get();
        $item=ItemMaster::get();
        return view('admin.inventory.index',compact('subinv','item'));
    }

    public function create()
    {
        abort_if(Gate::denies('transaction_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
         $subinv=Subinventories::get();
        $item=ItemMaster::get();
        return view('admin.inventory.create',compact('subinv','item'));
        // return view('admin.transactionTypes.create');
    }

    public function store(Request $request)
    {
        $uom=ItemMaster::where('inventory_item_id',$request->item_code)->first()->primary_uom_code;
        if ((float)$request->quantities > 0) {
            $onhand = Onhand::where('inventory_item_id', $request->item_code)
                ->where('subinventory_code', $request->warehouse)
                ->first();

            if ($onhand) {
                $onhand->primary_transaction_quantity = (int)$request->quantities;
                $onhand->save();
            } else {
                Onhand::create([
                    'inventory_item_id' => $request->item_code,
                    'subinventory_code' => $request->warehouse,
                    'primary_transaction_quantity' => (int)$request->quantities,
                    'transaction_uom_code' => $uom,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        // $transactionType = TransactionType::create($request->all());

        return redirect()->route('admin.inventory.index')->with('success', 'Data Stored');
    }

    public function edit(TransactionType $transactionType)
    {
        abort_if(Gate::denies('transaction_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.transactionTypes.edit', compact('transactionType'));
    }

    public function update(UpdateTransactionTypeRequest $request, TransactionType $transactionType)
    {
        $transactionType->update($request->all());

        return redirect()->route('admin.transaction-types.index');
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

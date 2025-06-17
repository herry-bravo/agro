<?php

namespace App\Http\Requests;

use App\Subinventories;
use Gate;
use Validator;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreSubInventoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('itemMaster_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'sub_inventory_name' => 'required|unique:bm_mtl_item_sub_inventories',
        ];
    }

    public function messages() {
        return [
            'sub_inventory_name.unique' => 'No Must be Unique',
        ];
    }

}

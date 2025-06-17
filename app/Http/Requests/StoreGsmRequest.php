<?php

namespace App\Http\Requests;

use App\Gramatur;
use Exception;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

class StoreGsmRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'inventory_item_id' => [
                'required',
                 Rule::unique('bm_gsm_std_id')->where(function ($query) {
                     $query->where('inventory_item_id', $this->inventory_item_id)
                        ->where([['gsm', $this->gsm],['operation',$this->operation]]);
                 })
            ],
        ];
    }
    public function messages() {
        return [
            'inventory_item_id.unique' => 'Duplicated Entry',
        ];
    }

}
